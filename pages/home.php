<?php


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
    <div >
      <a href="<?php echo INSTALL_DIR . 'index' ?>">Pagrindinis</a>
    </div>
    <div style="flex-basis:200px">
      <a href="<?php echo INSTALL_DIR . 'register' ?>">Saskaitos registracija</a>
    </div>

    <div >
      <a href="<?php echo INSTALL_DIR . 'accounts' ?>">Saskaitos</a>
    </div>
  </header>