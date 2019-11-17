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

  /** Проверка password **/
  if(!isset($_SESSION['current_error']))
  {
    if(password_verify ($_POST['current'], $_SESSION['password'])) // Если текущий пароль совпадает
    {
      if($_POST['password'] == $_POST['password_confirmation'])
      {
        /** Хэширование пароля **/
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        /** Обновление паролья в БД **/
        $sql = "UPDATE users SET password = :password WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':password', $_POST['password'], PDO::PARAM_STR);
        $statement->bindValue(':id', $_SESSION['id'], PDO::PARAM_INT);

        if($statement->execute())
        {
          $_SESSION['password'] = $_POST['password'];
          $_SESSION['password_success'] = "Пароль успешно обновлен";
          redirect("/profile.php");
        }
        else
        {
          $_SESSION['password_error'] = "Что-то пошло не так";
          $error = true;
        }
      }
      else
      {
        $_SESSION['password_error'] = 'Пароли на совпадают';
        $error = true;
      }
    }
    else
    {
      $_SESSION['current_error'] = 'Не верный пароль';
      $error = true;
    }
  }

  if($error)
  {
    redirect("/profile.php");
  }

}
?>
