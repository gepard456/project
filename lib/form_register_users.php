<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/functions.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  unset($_POST['password_confirmation']);

  /** Подготовка пришедших из формы данных **/
  foreach($_POST as $key => $value)
  {
    $_POST[$key] = trim(strip_tags($value));
  }

  /** Хэширование пароля **/
  $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

  /** Сохранение user в БД **/
  $sql = "INSERT INTO `users` (`name`, `email`, `password`) VALUES (:name, :email, :password)";
  $statement = $pdo->prepare($sql);
  $statement->execute($_POST);

}
