<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/functions.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  /** Валидация пришедших из формы данных **/
  $error = false;

  /** Проверка полей на пустоту **/
  foreach($_POST as $key => $value)
  {
    $_POST[$key] = trim($value);

    if(strlen($value) == 0)
    {
      $_SESSION[$key.'_error'] = "Поле обязательно для заполнения";
      $error = true;
    }
  }

  /** Проверка было ли изменено поле name **/
  if($_POST["name"] == $_SESSION["name"])
  {
    unset($_POST["name"]);
  }

  /** Валидация email **/
  if($_POST["email"] == $_SESSION["email"]) // Проверка было ли изменено имя
  {
    unset($_POST["email"]);
  }
  else
  {
    if(!isset($_SESSION['email_error']))  // Проверка соответствует ли email формату
    {
      if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
      {
        $_SESSION['email_error'] = "Не соответствующий формат E-Mail";
        $error = true;
      }
    }

    if(!isset($_SESSION['email_error'])) // Проверка зарегистрирован ли такой email
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
  }

  if($error)
  {
    redirect("/profile.php");
  }

  // Cохранение данных пользователя

  if(!empty($_FILES["image"]["tmp_name"]) && $_FILES["image"]["size"] > 0) // Если файл был загружен и вес больше 0
  {
    $info_file = new SplFileInfo($_FILES["image"]["name"]);
    $name_file = uniqid().'.'.$info_file->getExtension();
    $_POST['image'] = $name_file;

    $path = '../'.PATH_DIR_UPLOAD.'/';

    if(move_uploaded_file($_FILES["image"]["tmp_name"], $path.$name_file))
    {
      if(!empty($_SESSION['image'])) // Если файл уже загружался
      {
        if(file_exists($path.$_SESSION['image']))
          unlink ($path.$_SESSION['image']);
      }
    }
    else
    {
      $_SESSION['image_error'] = 'Не удачная загрузка файла';
      redirect("/profile.php");
    }
  }

  if(!empty($_POST)) // Если есть что обновлять
  {
    /** Генерация запроса **/
    $sql = "UPDATE users SET";
    $cnt = true;

    foreach($_POST as $key => $value)
    {
      if($cnt)
      {
        $sql .= " {$key} = :{$key}";
        $cnt = false;
      }
      else
        $sql .= ", {$key} = :{$key}";
    }

    $sql .= " WHERE id = :id";

    $_POST['id'] = $_SESSION['id'];

    $statement = $pdo->prepare($sql);
    if($statement->execute($_POST)) // Если данные обновлены
    {
      unset($_POST['id']);

      foreach($_POST as $key => $value)
      {
        $_SESSION[$key] = $value;
      }

      $_SESSION['profile_form_success'] = 'Профиль успешно обновлен';
      redirect("/profile.php");

    }
    else
    {
      $_SESSION['profile_form_error'] = 'При сохранении данных произошла ошибка';
      redirect("/profile.php");
    }

  }
  else
  {
    $_SESSION['profile_form_error'] = 'Измените хотя бы одно поле';
    redirect("/profile.php");
  }
}
else
{
  $_SESSION['profile_form_error'] = 'Не верный метод отправки данных';
  redirect("/profile.php");
}
