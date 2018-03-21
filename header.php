<?php
ini_set("display_errors",1);
error_reporting(E_ALL); 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ЛюстраН - CRM</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
        <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
    </head>
<body>
<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-between cl-nav">
    <a class="navbar-brand" href="<?php print $site_name;?>">
        <img src="images/logotip.png" width="140" height="60" alt="">
    </a>
    <a class="navbar-brand btn btn-warning" href="setting.php">МЕСТО</a>
<!--    <div id="menu">
      <div id="menu-toggle">
        <div id="menu-icon">
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>
        </div>
      </div>-->
      <ul class="nav nav-pills">
        <li class="nav-item"><a class="nav-link" href="#section00"><p>ДОБОВИТЬ ЗАКАЗ</p></a></li>
        <li class="nav-item"><a class="nav-link" href="orders.php"><p>ЗАКАЗЫ</p></a></li>
        <li class="nav-item"><a class="nav-link" href="worktime.php"><p>ОТМЕТИТЬСЯ</p></a></li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">СТАТИСТИКА</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="statistics.php">Юбилейный</a>
                <a class="dropdown-item" href="statistics.php">Гермес</a>
                <a class="dropdown-item" href="statistics.php">Офис</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">НАСТРОЙКА</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="setting.php">Место</a>
                <a class="dropdown-item" href="#">Пользователи</a>
                <a class="dropdown-item" href="#">Ввод статистики</a>
                <a class="dropdown-item" href="#">Для администратора</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">Выйти</a>
            </div>
        </li>
      </ul>
    </div>
  </nav>
</header>
<!--общий контейнер-->
<div class="container-fluid">
    <div class="row justify-content-center">
    <div class="col-xl-10">