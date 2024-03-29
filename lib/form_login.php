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

  /** Валидация email **/
  if(!isset($_SESSION['email_error']))
  {
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
      $_SESSION['email_error'] = "Не соответствующий формат E-Mail";
      $error = true;
    }
  }

  if(!isset($_SESSION['email_error']) || !isset($_SESSION['password_error']))
  {
    /** Проверка существования email в БД **/
    $sql = "SELECT * FROM `users` WHERE `email` = :email";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
    $statement->execute();
    $result_count = $statement->rowCount();

    if($result_count == 1)
    {
      $result_data_user = $statement->fetch(PDO::FETCH_ASSOC);

      /** Проверка совпадения password **/
      if(password_verify ($_POST['password'], $result_data_user['password']))
      {
        /** Авторизация **/
        $_SESSION['id'] = $result_data_user['id'];
        $_SESSION['name'] = $result_data_user['name'];
        $_SESSION['email'] = $result_data_user['email'];
        $_SESSION['image'] = $result_data_user['image'];
        $_SESSION['password'] = $result_data_user['password'];

        /** Проверка remember **/
        if(isset($_POST['remember']) && $_POST['remember'] == 1)
        {
          if(!isset($_COOKIE['email']) || !isset($_COOKIE['password']))
          {
            setcookie("email", $result_data_user['email'], time() + 86400, '/');
            setcookie("password", $result_data_user['password'], time() + 86400, '/');
          }
        }
        else
        {
            setcookie('email', '', time() - 3600, '/');
            setcookie('password', '', time() - 3600, '/');
        }
        redirect($_SESSION['HTTP_REFERER']);
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
  }

  if($error)
  {
    redirect("/login.php");
  }

}
