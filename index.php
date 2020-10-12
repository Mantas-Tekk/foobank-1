<?php
session_start();
define('INSTALL_DIR', '/project_01/uzd-bank/bank-1/');
define('FUNCTION_DIR', __DIR__);

define('FRONT_1', true);
define('FRONT_2', true);

$route = str_replace(INSTALL_DIR, '', $_SERVER['REQUEST_URI']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>


  <link rel="icon" type="image/png" href="img/logo.png" />

  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/register.css">
  <link rel="stylesheet" href="css/accounts.css">
</head>

<body>
  <div class="bg"></div>

  <header>
    <div style="flex-basis:200px">
      <h1>Foo Bank</h1>
    </div>
    <!-- <div>
      <a href="<?php echo INSTALL_DIR . 'index' ?>">Pagrindinis</a>
    </div> -->
    <div style="flex-basis:200px">
      <a href="<?php echo INSTALL_DIR . 'register' ?>">Saskaitos registracija</a>
    </div>
    <div>
      <a href="<?php echo INSTALL_DIR . 'accounts' ?>">Saskaitos</a>
    </div>
  </header>



  <?php
  if( '' == $route ) {
    require __DIR__ . '/pages/register.php';
  }
  if('index' == $route ) {
    require __DIR__ . '/pages/register.php';
  }
  if ('register' == $route) {
    require __DIR__ . '/pages/register.php';
  }
  if ('accounts' == $route) {
    require __DIR__ . '/pages/accounts.php';
  }
  if ('balance-add' == $route) {
    require __DIR__ . '/pages/balance-add.php';
  }
  ?>
</body>

</html>