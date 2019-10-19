<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/functions.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  /** Валидация пришедших из формы данных **/
  $error = false;

  foreach($_POST as $key => $value)
  {
    if($key != 'remember')
    {
      $_POST[$key] = trim($value);

      if(strlen($value) == 0)
      {
        $_SESSION[$key.'_error'] = "Поле обязательно для заполнения";
        $error = true;
      }
    }
  }

  /** Проверка существования email в БД **/
  $sql = "SELECT * FROM `users` WHERE `email` = :email";
  $statement = $pdo->prepare($sql);
  $statement->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
  $statement->execute();
  $result_data = $statement->rowCount();

  if($result_data)
  {
    $result_data_user = $statement->fetch(PDO::FETCH_ASSOC);

    /** Проверка совпадения password **/
    if(password_verify ($_POST['password'], $result_data_user['password']))
    {
      $_SESSION['name'] = $result_data_user['name'];
      $_SESSION['email'] = $result_data_user['email'];
      dump($_SESSION);
    }
    else
    {
      $_SESSION['password_error'] = 'Пароль не совпадает';
      $error = true;
    }
  }
  else
  {
    $_SESSION['email_error'] = 'E-Mail не зарегистрирован';
    $error = true;
  }

  if($error)
  {
    header("Location: /login.php");
    die;
  }

}
