<?php

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