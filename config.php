<?php
//ftp сервер для размщения 
//sander5p.beget.tech
//sander5p_crm
//chmn3m&O


$system_user = 'admin';
$system_password = '$2y$10$qCczYRc7S011VRESMqUkGeWQT4V4OQ2qkSyhnxO0c.fk.LulKwUwW';

$site_name = 'http://crm.sander5p.beget.tech';
// DataBase
define('DB_DRIVER', 'mysql');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'test');
define('DB_PORT', '3306');


function database(){
try {
    $db = new PDO('mysql:host=localhost;dbname=test', 'root','');
    // сделать что-нибудь с объектом в переменной $db
    return $db;
} catch (PDOException $e) {
    print "Ошибка подключени к базе данных: " . $e->getMessage();
}
}

