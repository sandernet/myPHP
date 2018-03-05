<?php
/**
  * Защищенная страница. К ней возможен доступ только авторизованным
  * пользователям. Если пользователь не авторизован, ему предлагается 
  * авторизоваться, и доступ к сайту ограничивается. 
  */
require_once('checkAuth.php');

require_once('header.php');

require_once('worktime.php');

require_once('fooret.php');

