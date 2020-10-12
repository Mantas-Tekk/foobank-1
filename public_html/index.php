<?php
ob_start();
session_start();
define('INSTALL_DIR', '/');
define('URL', 'https://foob4nk.000webhostapp.com');
define('FUNCTION_DIR', __DIR__);

//_c(INSTALL_DIR);
// _c($_SERVER['REQUEST_URI']);

define('FRONT_1', true);
define('FRONT_2', true);



$route = str_replace(INSTALL_DIR, '', $_SERVER['REQUEST_URI']);
//echo INSTALL_DIR.'<br>';
//echo $_SERVER['REQUEST_URI'].'<br>';
//echo $route.'<br>';


  if ('register' == $route) {
    require __DIR__ . '/pages/register.php';
  }
  if ('accounts' == $route) {
    require __DIR__ . '/pages/accounts.php';
  }
  if ('balance-add' == $route) {
    require __DIR__ . '/pages/balance-add.php';
  }

echo '</body>';
echo '</html>';
ob_end_flush();
