<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/functions.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  /** Валидация пришедших из формы данных **/
  $error = false;

  foreach($_POST as $key => $value)
  {
    $_POST[$key] = trim($value);

    if(strlen($value) == 0)
    {
      $_SESSION[$key.'_error'] = "Поле обязательно для заполнения";
      $error = true;
    }
  }

  /** Валидация password **/
  if(!isset($_SESSION['password_error']))
  {
    if(strlen($_POST['password']) < 6)
    {
      $_SESSION['password_error'] = 'Пароль должен быть не менее 6 символов';
      $error = true;
    }
  }

  if(!isset($_SESSION['password_error']) && !isset($_SESSION['password_confirmation_error']))
  {
    if($_POST['password'] !== $_POST['password_confirmation'])
    {
      $_SESSION['password_error'] = 'Подтверждающий пароль не совпадает';
      $error = true;
    }
  }

  unset($_POST['password_confirmation']);

  /** Валидация email **/
  if(!isset($_SESSION['email_error']))
  {
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
      $_SESSION['email_error'] = "Не соответствующий формат E-Mail";
      $error = true;
    }
  }

  if(!isset($_SESSION['email_error']))
  {
    $sql = "SELECT `email` FROM `users` WHERE `email` = :email";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
    $statement->execute();
    $result_valid_email = $statement->rowCount();

    if($result_valid_email)
    {
      $_SESSION['email_error'] = 'Такой E-Mail уже зарегистрирован';
      $error = true;
    }
  }

  if($error)
  {
    redirect("/register.php");
  }

  /** Хэширование пароля **/
  $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

  /** Сохранение user в БД **/
  $sql = "INSERT INTO `users` (`name`, `email`, `password`) VALUES (:name, :email, :password)";
  $statement = $pdo->prepare($sql);

  if($statement->execute($_POST))
  {
    redirect("/login.php");
  }
  else
  {
      $_SESSION['email_error'] = "Что-то пошло не так";
      redirect("/register.php");
  }
}
