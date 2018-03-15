<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>crm система управления!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
        <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
    </head>
<body>
<header>
  <nav class="navbar navbar-dark bg-primary fixed-top navbar-light">
<!--    <div id="brand">
        <div id="logo"><a href="<?php print $site_name;?>"><img src="images/logotip.png"></a></div>
      <div id="word-mark"></div>
    </div>-->
<a class="navbar-brand" href="<?php print $site_name;?>">
    <img src="images/logotip.png" width="140" height="70" alt="">
</a>

<!--    <div id="menu">
      <div id="menu-toggle">
        <div id="menu-icon">
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>
        </div>
      </div>-->
      <ul class="nav nav-pills justify-content-end">
          <li class="nav-item"><a class="nav-link active"  href="#section00"><p>ДОБОВИТЬ ЗАКАЗ</p></a></li>
        <li class="nav-item"><a class="nav-link" href="orders.php"><p>ЗАКАЗЫ</p></a></li>
        <li class="nav-item"><a class="nav-link" href="statistics.php"><p>СТАТИСТИКА</p></a></li>
        <li class="nav-item"><a class="nav-link" href="index.php"><p>ОТМЕТИТЬСЯ</p></a></li>
        <li class="nav-item"><a class="nav-link" href="#section00"><p>НАСТРОЙКА</p></a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php"><p>Выйти</p></a></li>
      </ul>
    </div>
  </nav>
</header>
<!--общий контейнер-->
<div class="container-fluid">
    <div class="row justify-content-md-center">
    <div class="col-xl-10">