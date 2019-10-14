<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  foreach ($_POST as $key => $value)
  {
    $_POST[$key] = trim(strip_tags($value));
  }

  $sql = "INSERT INTO `comments` (`name`, `comment`) VALUES (:name, :comment)";
  $statement = $pdo->prepare($sql);
  $_SESSION['add_comment_error'] = $statement->execute($_POST);

  if ($_SESSION['add_comment_error'])
    $_SESSION['add_comment_message'] = 'Комментарий успешно добавлен';
  else
    $_SESSION['add_comment_message'] = 'Уупс, кажется что-то пошло не так';

  header("Location: /");
  die;
}
