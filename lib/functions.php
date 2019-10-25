<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/config.php');

session_start();

function dump ( $var, $func = false )
{
  echo '<pre style="font-size:14px">';

  if ($func)
    var_dump($var);
  else
    print_r($var);

  echo '</pre>';
}

function redirect($path)
{
  header("Location: $path");
  die;
}

/** Проверка remember **/
if( !isset($_SESSION['name']) && isset($_COOKIE['email']) )
{
  /** Проверка существования email в БД **/
  $sql_h = "SELECT * FROM `users` WHERE `email` = :email";
  $statement_h = $pdo->prepare($sql_h);
  $statement_h->bindValue(':email', $_COOKIE['email'], PDO::PARAM_STR);
  $statement_h->execute();
  $result_data_h = $statement_h->rowCount();

  if($result_data_h)
  {
      $result_data_user_h = $statement_h->fetch(PDO::FETCH_ASSOC);

      if($_COOKIE['email'] == $result_data_user_h['email'] && $_COOKIE['password'] == $result_data_user_h['password'])
      {
        /** Авторизация **/
        $_SESSION['name'] = $result_data_user_h['name'];
        $_SESSION['email'] = $result_data_user_h['email'];
      }
  }
}
