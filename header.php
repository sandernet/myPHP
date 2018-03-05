<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>crm система управления!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
        <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
        <link rel="stylesheet" href="css/style.css">
        <script src="//libs.raltek.ru/libs/jquery/1.8.3/js/jquery-1.8.3.js"></script>
        <script src="js/scripts.js"></script>
    </head>
<body>
<header>
  <nav>
    <div id="brand">
        <div id="logo"><a href="<?php print $site_name;?>"><img src="images/logotip.png"></a></div>
      <div id="word-mark"></div>
    </div>
    <div id="menu">
      <div id="menu-toggle">
        <div id="menu-icon">
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>
        </div>
      </div>
      <ul>
        <li><a href="#section00"><p>Добавить заказ</p></a></li>
        <li><a href="#section01"><p>Заказы</p></a></li>
        <li><a href="statistics.php"><p>СТАТИСТИКА</p></a></li>
        <li><a href="index.php"><p>Отметиться</p></a></li>
        <li><a href="logout.php"><p>Выйти</p></a></li>
      </ul>
    </div>
  </nav>
</header>
