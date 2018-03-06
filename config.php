<?php
/**
  * Функция для подключения к СУБД MySQL.
  * Функция не принимает никаких параметров.
  * Функция предназначена для использования, в основном,
  * с одной базой данных
*/
//ftp сервер для размщения 
//sander5p.beget.tech
//sander5p_crm
//chmn3m&O


//$system_user = 'admin';
//$system_password = '$2y$10$qCczYRc7S011VRESMqUkGeWQT4V4OQ2qkSyhnxO0c.fk.LulKwUwW';
date_default_timezone_set('Asia/Irkutsk');
$site_name = 'http://crm.sander5p.beget.tech/';

// DataBase
//define('DB_DRIVER', 'mysql');
//define('DB_HOSTNAME', 'localhost');
//define('DB_USERNAME', 'root');
//define('DB_PASSWORD', '');
//define('DB_DATABASE', 'test');
//define('DB_PORT', '3306');

function database(){
try {
    $db = new PDO('mysql:host=localhost;dbname=sander5p_crm', 'sander5p_crm','ad901m');
    return $db;
} catch (PDOException $e) {
    print "Ошибка подключени к базе данных: " . $e->getMessage();
}
}












