<?php 

//http://www.lezhenkin.ru/examples/php/reg-auth-users/
// Подключаем файл для соединения с СУБД MySQL
require_once 'config.php';
// Подключаем файл, в котором будем объявлять пользовательские функции
require_once 'functions.php';
session_start();
// Подключаем шапку сайта
require 'header.php'; 
// Здесь предполагается, что исходный файл FormHelper.php
// находится в том же каталоге, где и данный файл
require 'FormHelper.php';


// Вход в систему если сесии нету то регисрируемся
if (array_key_exists('username', $_SESSION)) {
    print "Привет, $_SESSION[username]";
} else {
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    list($errors, $input) = validate_input_system();
    if ($errors) {
        show_form($errors);
    } else {
        process_form($input);
    }
} else {
    show_form();
}
}

function show_form($errors = array()) {
// Собственные значения, устанавливаемые по умолчанию,
// отсутствуют, поэтому и нечего передавать конструктору
// класса FormHelper
$form = new FormHelper();
// построить HTML-таблицу из сообщений об ошибках для
// последующего применения
if ($errors) {
    $errorHtml = '<ul><li>';
    $errorHtml .= implode('</li><li>',$errors);
    $errorHtml .= '</li></ul>';
} else {
    $errorHtml = '';
}
// Это небольшая форма, поэтому ниже выводятся ее составляющие
print <<<_FORM_
<form method="POST" action="{$form->encode($_SERVER['PHP_SELF'])}">
$errorHtml
Username: {$form->input('text',['name' => 'username'])} <br/>
Password: {$form->input('password',['name' => 'password'])} <br/>
{$form->input('submit', ['value' => 'Log In'])}
</form>
_FORM_;
}

function validate_input_system() {
$input = array();
$errors = array();
// Некоторые образцы имен пользователей и паролей
$users = array('alice' => 'dogl23', 'bob' => 'my^pwd', 'charlie' => '**fun**');
// убедиться в достоверности имени пользователя
$input['username'] = $_POST['username'] ?? '';
if (! array_key_exists($input['username'], $users)) {
    $errors[] = 'Не верно введен логин и пароль.';
}
// Оператор else означает, что проверка пароля пропускается,
// если введено недостоверное имя пользователя
else {
// проверить правильность введенного пароля
    $saved_password = $users[ $input['username'] ];
    $submitted_password = $_POST['password'] ?? '';
    if ($saved_password != $submitted_password) {
        $errors[] = 'Не верно введен логин и пароль';
    }
}
return array($errors, $input);
}

function process_form($input) {
$_SESSION['username'] = $input['username'];
print "Добро пожаловать , $_SESSION[username]";
}


// Подключаем шапку сайта
require './fooret.php'; 
?>