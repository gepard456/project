<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/functions.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  /** Подготовка пришедших из формы данных **/
  foreach($_POST as $key => $value)
  {
    $_POST[$key] = trim(strip_tags($value));
  }

  /** Сохранение данных в БД **/
  $sql = "INSERT INTO `comments` (`name`, `comment`) VALUES (:name, :comment)";
  $statement = $pdo->prepare($sql);
  $_SESSION['add_comment_error'] = $statement->execute($_POST);

  /** Проверка сохранения данных в БД **/
  if($_SESSION['add_comment_error'])
    $_SESSION['add_comment_message'] = 'Комментарий успешно добавлен';
  else
    $_SESSION['add_comment_message'] = 'Уупс, кажется что-то пошло не так';

  /** Переадресация **/
  header("Location: /");
  die;
}
