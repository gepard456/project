<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/functions.php');

if($_SERVER['REQUEST_METHOD'] == 'GET')
{
  /** Запретить **/
  if(isset($_GET['forbid']))
  {
      $sql = "UPDATE comments SET status = '1' WHERE id = :id";
      $statement = $pdo->prepare($sql);
      $statement->bindValue(':id', $_GET['forbid'], PDO::PARAM_INT);
      $statement->execute();
  }

  /** Разрешить **/
  if(isset($_GET['allow']))
  {
      $sql = "UPDATE comments SET status = '0' WHERE id = :id";
      $statement = $pdo->prepare($sql);
      $statement->bindValue(':id', $_GET['allow'], PDO::PARAM_INT);
      $statement->execute();
  }

  /** Удалить **/
  if(isset($_GET['delete']))
  {
      $sql = "DELETE FROM comments WHERE id = :id";
      $statement = $pdo->prepare($sql);
      $statement->bindValue(':id', $_GET['delete'], PDO::PARAM_INT);
      $statement->execute();
  }

  redirect("/admin.php");
}
?>
