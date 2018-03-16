<?php
/**
  * Защищенная страница. К ней возможен доступ только авторизованным
  * пользователям. Если пользователь не авторизован, ему предлагается 
  * авторизоваться, и доступ к сайту ограничивается. 
  */

  // это небольшой проверочный скрипт, выясняющий,
  // включены ли cookies у пользователя  

  if(empty($_GET["cookie"]))
  {
    // посылаем заголовок переадресации на страницу,
    // с которой будет предпринята попытка установить cookie 
    header("Location: $_SERVER[PHP_SELF]?cookie=1");
    // устанавливаем cookie с именем "test"
    setcookie("test","1"); 
  }
  else
  {
    if(empty($_COOKIE["test"]))
    {
      echo("Для корректной работы приложения необходимо включить cookies");
    }
    else
    {
      // cookie включены, переходим на нужную страницу:
      header("Location: http://crm.sander5p.beget.tech/");
      // здесь посылается заголовок, содержащий адрес нужной страницы
    }
  }

require_once('checkAuth.php');

require_once('header.php');

require_once('worktime.php');

require_once('fooret.php');

