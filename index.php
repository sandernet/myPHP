<?php 
//Подключаем файл настроек
require_once 'config.php';
session_start();
// Подключаем шапку сайта
require 'header.php'; 
// Здесь предполагается, что исходный файл FormHelper.php
// находится в том же каталоге, где и данный файл
require 'FormHelper.php';


// Вход в систему
if (array_key_exists('username', $_SESSION)) {
    print "Hello, $_SESSION[username]";
} else {
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    list($errors, $input) = validate_users();
    if ($errors) {
        show_form($errors);
    } else {
        process_form($input);
    }
} else {
    show_form();
}
}


// Установить массивы с вариантами выбора из списка,
// размечаемого дескриптором <select>. Следующие массивы
// требуются в функциях display_form(), validate_form()
// и process_form(), и поэтому они объявляются в глобальной
// области действия
$sweets = array('puff' => 'Sesame Seed Puff',
                'square' => 'Coconut Milk Gelatin Square',
                'cake' => 'Brown Sugar Cake',
                'ricemeat' => 'Sweet Rice and Meat');
$main_dishes = array('cuke' => 'Braised Sea Cucumber',
                        'stomach' => "Sauteed Pig's Stomach",
                        'tripe' => 'Sauteed Tripe with Wine Sauce',
                        'taro' => 'Stewed Pork with Taro',
                        'giblets' => 'Baked Giblets with Salt',
                        'abalone' => 'Abalone with Marrow and Duck Feet');
// Основная логика функционирования страницы:
// - Если форма передана на обработку, проверить достоверность
// данных, обработать их и снова отобразить форму.
// - Если форма не передана на обработку, отобразить ее снова
//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//// Если функция validate_form() возвратит ошибки,
//// передать их функции show_form()
//list($errors, $input) = validate_form();
//if($errors) {
//show_form($errors);
//} else {
//// Переданные данные из формы достоверны, обработать их
//process_form($input);
//}
//} else {
//// Данные из формы не переданы, отобразить ее снова
//    show_form();
//}

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

//function show_form($errors = array()) {
//    $defaults = array('delivery' => 'yes', 'size' => 'medium');
//    // создать объект $form с надлежащими свойствами по умолчанию
//    $form = new FormHelper($defaults);
//    // Ради ясности весь код HTML-разметки и отображения
//    // формы вынесен в отдельный файл
//    include 'complete-form.php';
//}

//function show_table(){
//// получить доступ к глобальной переменной $db
//// в теле данной функции
//    global $db;
//// составить запрос к базе данных
//$sql = 'SELECT * FROM checks ORDER BY checks.id ASC';
// Если наименование блюда передано, ввести его в
// предложение WHERE. С помощью метода quote() и
// функции strtr() предотвращается действие вводимых
// пользователем подстановочных символов
//if (strlen($input['dish_name'])) {
//$dish = $base->quote($input['dish_name']);
//$dish = strtr($dish, array('_' => '\_', '%' => '\%'));
//$sql .= " AND dish_name LIKE $dish";
//}
// Если в элементе ввода is_spicy установлено значение
// 'yes' или 'no', ввести в запрос SQL соответствующее
// логическое условие. (Если же установлено значение "either",
// вводить логическое условие в предложение WHERE не нужно.)
//$spicy_choice = $GLOBALS['spicy_choices'][ $input['is_spicy'] ];
//if ($spicy_choice == 'yes') {
//$sql .= ' AND is_spicy = 1';
//} elseif ($spicy_choice == 'no') {
//$sql .= ' AND is_spicy = 0';
//}
// отправить запрос программе базы данных и получить
// в ответ все нужные строки из таблицы
//$stmt = $base->prepare($sql);
//$stmt->execute(array($input['min_price'], $input['max_price']));
//$dishes = $stmt->fetchAll();
//
//$cheking = $db->query($sql);
//if (count($cheking) == 0) {
//print 'No dishes matched.';
//} else {
//print '<table>';
//print
//'<tr><th>Dish Name</th><th>Price</th><th>Spicy?</th></tr>';
//foreach ($cheking as $dish) {
//if ($dish->late == 1) {
//$spicy = 'Опозал';
//} else {
//$spicy = '-';
//}
//printf('<tr><td>%s</td><td>$%.02f</td><td>%s</td></tr>',
//htmlentities($dish->dish_name),
//$dish->price, $spicy);
//}
//}    
//    
//}
function validate_input_ststem() {
$input = array();
$errors = array();
// Некоторые образцы имен пользователей и паролей
$users = array('alice' => 'dogl23', 'bob' => 'my^pwd', 'charlie' => '**fun**');
// убедиться в достоверности имени пользователя
$input['username'] = $_POST['username'] ?? '';
if (! array_key_exists($input['username'], $users)) {
    $errors[] = 'Please enter a valid username and password.';
}
// Оператор else означает, что проверка пароля пропускается,
// если введено недостоверное имя пользователя
else {
// проверить правильность введенного пароля
    $saved_password = $users[ $input['username'] ];
    $submitted_password = $_POST['password'] ?? '';
    if ($saved_password != $submitted_password) {
        $errors[] = 'Please enter a valid username and password.';
    }
}
return array($errors, $input);
}

function process_form($input) {
$_SESSION['username'] = $input['username'];
print "Welcome, $_SESSION[username]";
}

//// Проверка формы на ввод всякой нечести
//function validate_form() {
//$input = array();
//$errors = array();
//// обязательное имя
//$input['name'] = trim($_POST['name'] ?? '');
//if (! strlen($input['name'])) {
//$errors[] = 'Please enter your name.';
//}
//// обязательный размер блюда
//$input['size'] = $_POST['size'] ?? '';
//if (! in_array($input['size'], ['small','medium','large'])) {
//$errors[] = 'Please select a size.';
//}
//// обязательное сладкое блюдо
//$input['sweet'] = $_POST['sweet'] ?? '';
//if (! array_key_exists($input['sweet'], $GLOBALS['sweets'])) {
//$errors[] = 'Please select a valid sweet item.';
//}
//// два обязательных блюда
//$input['main_dish'] = $_POST['main_dish'] ?? array();
//if(count($input['main_dish']) != 2) {
//$errors[] = 'Please select exactly two main dishes.';
//} else {
//// Если выбрано два основных блюда, убедиться в их
//// достоверности
//if (! (array_key_exists($input['main_dish'][0],
//$GLOBALS['main_dishes']) &&
//array_key_exists($input['main_dish'][1],
//$GLOBALS['main_dishes']))) {
//$errors[] =
//'Please select exactly two valid main dishes.';
//}
//}
//// Если выбрана доставка, то в комментариях должны быть
//// указаны ее подробности
//$input['delivery'] = $_POST['delivery'] ?? 'no';
//$input['comments'] = trim($_POST['comments'] ?? '');
//if (($input['delivery'] == 'yes') &&
//(! strlen($input['comments']))) {
//$errors[] = 'Please enter your address for delivery.';
//}
//return array($errors, $input);
//}
//function process_form($input) {
//// найти полные наименования основных и сладких блюд
//// в массивах $GLOBALS['sweets'] и $GLOBALS['main_dishes']
//$sweet = $GLOBALS['sweets'][ $input['sweet'] ];
//$main_dish_1 = $GLOBALS['main_dishes'][ $input['main_dish'][0] ];
//$main_dish_2 = $GLOBALS['main_dishes'][ $input['main_dish'][1] ];
//if (isset($input['delivery']) && ($input['delivery'] == 'yes')) {
//$delivery = 'do';
//} else {
//$delivery = 'do not';
//}
//// составить текст сообщения с заказом трапезы
//$message=<<<_ORDER_
//Thank you for your order, {$input['name']}.
//You requested the {$input['size']} size of $sweet,
//$main_dish_1, and $main_dish_2.
//You $delivery want delivery.
//_ORDER_;
//if (strlen(trim($input['comments']))) {
//$message .= 'Your comments: '.$input['comments'];
//}
//// отправить сообщение шеф-повару
//mail('chef@restaurant.example.com', 'New Order', $message);
//// вывести сообщение на экран, но закодировать его любыми
//// HTML-представлениями и преобразовать знаки перевода строки
//// в дескрипторы <br/>
//print nl2br(htmlentities($message, ENT_HTML5));
//}
// 
// Подключаем шапку сайта
require './fooret.php'; 
?>