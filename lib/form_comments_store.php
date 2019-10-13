<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $name = trim(strip_tags($_POST["name"]));
  $comment = trim(strip_tags($_POST["comment"]));

  $sql = "INSERT INTO `comments` (`name`, `comment`) VALUES (:name, :comment)";
  $statement = $pdo->prepare($sql);
  $statement->execute(['name' => $name, 'comment' => $comment]);
  //header("Location: /");
  //exit;
}
