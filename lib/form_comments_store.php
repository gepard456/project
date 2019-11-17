<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/functions.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  /** Валидация пришедших из формы данных **/
  foreach($_POST as $key => $value)
  {
    $_POST[$key] = trim(strip_tags($value));
  }

  if(strlen($_POST['comment']) == 0)
  {
    if(strlen($_POST['comment']) == 0)
      $_SESSION['comment_empty'] = 'Введите cообщение';

    redirect("/");
  }
  /** Сохранение комментария в БД **/
  $sql = "INSERT INTO `comments` (`comment`, `user_id`) VALUES (:comment, :user_id)";
  $statement = $pdo->prepare($sql);

  /** Валидация сохранения комментария в БД **/
  if($statement->execute($_POST))
    $_SESSION['add_comment_success'] = 'Комментарий успешно добавлен';
  else
    $_SESSION['add_comment_error'] = 'Уупс, кажется что-то пошло не так';

  redirect("/");
}
