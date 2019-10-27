<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/functions.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  /** Валидация пришедших из формы данных **/
/*
  foreach($_POST as $key => $value)
  {
    $_POST[$key] = trim($value);
  }
  */
  dump($_POST);
  dump($_FILES);
}
