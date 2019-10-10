<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/config.php');

function dump ( $var, $func = false )
{
  echo '<pre style="font-size:14px">';

  if ($func)
    var_dump($var);
  else
    print_r($var);

  echo '</pre>';
}
