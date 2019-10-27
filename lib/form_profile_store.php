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
    $result_count = $statement->rowCount();

    if($result_count)
    {
      $_SESSION['email_error'] = 'Такой E-Mail уже зарегистрирован';
      $error = true;
    }
  }

  if($error)
  {
    redirect("/profile.php");
  }
    //dump($_POST);
    //dump($_FILES);

}
