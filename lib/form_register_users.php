<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/functions.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  /** Валидация пришедших из формы данных **/
  $error = false;

  foreach($_POST as $key => $value)
  {
    $_POST[$key] = trim(strip_tags($value));

    if(strlen($value) == 0)
    {
      $_SESSION[$key.'_error'] = "Поле обязательно для заполнения";
      $error = true;
    }
  }

  /** Валидация email **/
  if(!isset($_SESSION['email_error']))
  {
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
      $_SESSION['email_error'] = "Не соответствующий формат E-Mail";
      $error = true;
    }
  }

  if($error)
  {
    header("Location: /register.php");
    die;
  }

  /** Хэширование пароля **/
  $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

  unset($_POST['password_confirmation']);

  /** Сохранение user в БД **/
  $sql = "INSERT INTO `users` (`name`, `email`, `password`) VALUES (:name, :email, :password)";
  $statement = $pdo->prepare($sql);
  $statement->execute($_POST);
}
