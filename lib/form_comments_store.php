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
  $statement->execute($_POST);

  header("Location: /");
  die;
}
