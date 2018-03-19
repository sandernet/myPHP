<?php
/* 
 * 
 * http://www.lezhenkin.ru/examples/php/dynamic-select-mysql/
 * Все работающие пользователи.
SELECT id, name, status FROM users WHERE  users.active = 1
 */
require_once('functions.php');
require 'header.php'; 
?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('number', 'Неделя');
      data.addColumn('number', 'Продавец11');
      data.addColumn('number', 'Продавец22');
      data.addColumn('number', 'Продавец33');
      data.addColumn('number', 'Продавец44');

      data.addRows([
        [1,  37.8, 80.8, 41.8, 5],
        [2,  30.9, 69.5, 32.4, 5],
        [3,  25.4,   57, 25.7, 5],
        [4,  11.7, 18.8, 10.5, 5],
        [5,  11.9, 17.6, 10.4, 5],
        [6,   8.8, 13.6, 40.7, 5],
        [7,   7.6, 12.3,  9.6, 5],
        [8,  12.3, 29.2, 10.6, 5],
        [9,  16.9, 42.9, 14.8, 120],
        [10, 12.8, 30.9, 11.6, 30],
        [11,  5.3,  7.9,  4.7, 5],
        [12,  6.6,  8.4,  5.2, 5],
        [13,  4.8,  6.3,  3.6, 5],
        [14,  4.2,  6.2,  3.4, 5]
      ]);

      var options = {
        chart: {
          title: 'Личные статистики продавцов консультантов',
          subtitle: 'в руб за 1 неделю'
        },
        width: 1200,
        height: 500
      };

      var chart = new google.charts.Line(document.getElementById('linechart_material'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }
    </script>

    <div id="linechart_material" style="width: 900px; height: 500px"></div>




<?php

//$db = database();
////// установить исключения при ошибках в базе данных
////$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
////// установить режим извлечения строк таблицы в виде объектов
////$db->setAttribute(PDO::ATTR_DEFAULT_FEТCH_MODE, PDO::FETCH_OBJ);
//
//
//// задать варианты выбора из списка формы, определяющие
//// наличие специй в блюде
//$locations = array('Офис','Гермес','Юбилейный');
//$status = array('Работает','Уволен');
//
//// Основная логика функционирования страницы:
//// - Если форма передана на обработку, проверить достоверность
//// данных, обработать их и снова отобразить форму.
//// - Если форма не передана на обработку, отобразить ее снова
//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//    // Если функция validate_form() возвратит ошибки,
//    // передать их функции show_form()
//    list($errors, $input) = validate_form();
//    if ($errors) {
//        show_form($errors);
//    } else {
//        // Переданные данные из формы достоверны, обработать их
//        show_form($errors);
//        process_form($input);
//    }
//} else {
//    // Данные из формы не переданы, отобразить ее снова
//    show_form();
//}
//function show_form($errors = array()) {
//$defaults = array('status' => 'Продавец');
//$form = new FormHelper($defaults);
//// Ради ясности весь код HTML-разметки и отображения
//// формы вынесен в отдельный файл
//    include 'statistics_forms.php';
//}
//
//function validate_form() {
//$input = array();
//$errors = [];
//// удалить любые начальные и конечные пробелы из переданного
//// на обработку наименования блюда
//$input['name'] = trim($_POST['name'] ?? '');
//// Минимальная цена на блюдо должна быть
//// достоверным числом с плавающей точкой
////$input['min_price'] = filter_input(INPUT_POST,'min_price',FILTER_VALIDATE_FLOAT);
////if ($input['min_price'] === null || $input['min_price'] === false) {
////    $errors[] = 'Please enter a valid minimum price.';
////}
////// Максимальная цена на блюдо должна быть
////// достоверным числом с плавающей точкой
////$input['max_price'] = filter_input(INPUT_POST,'max_price',FILTER_VALIDATE_FLOAT);
////if ($input['max_price'] === null || $input['max_price'] === false) {
////    $errors[] = 'Please enter a valid maximum price.';
////}
////// Минимальная цена на блюдо должна быть меньше
////// максимальной цены
////if ($input['min_price'] >= $input['max_price']) {
////    $errors[] = 'The minimum price must be less than the maximum price.';
////}
//$input['locations'] = $_POST['locations'] ?? '';
//
//if(! array_key_exists($input['locations'], $GLOBALS['locations'])) {
//    $errors[] = 'Please choose a valid "spicy" option.';
//}
//return array($errors, $input);
//}
//
//function process_form($input) {
//// получить доступ к глобальной переменной $db
//// в теле данной функции
//global $db;
//// составить запрос к базе данных
//
//$sql = 'SELECT name, status, createdAt, active FROM users WHERE active = ? AND status = ?';
////$sql = 'SELECT dish_name, price, is_spicy FROM dishes WHERE price >= ? AND price <= ?';
//// Если наименование блюда передано, ввести его в
//// предложение WHERE. С помощью метода quote() и
//// функции strtr() предотвращается действие вводимых
//// пользователем подстановочных символов
//if (strlen($input['name'])) {
//    $name = $db->quote($input['name']);
//    $name = strtr($dish, array('_' => '\_', '%' => '\%'));
//    $sql .= " AND name LIKE $name";
//}
////// Если в элементе ввода is_spicy установлено значение
////// 'yes' или 'no', ввести в запрос SQL соответствующее
////// логическое условие. (Если же установлено значение "either",
////// вводить логическое условие в предложение WHERE не нужно.)
////$spicy_choice = $GLOBALS['spicy_choices'][ $input['is_spicy'] ];
////if ($spicy_choice == 'yes') {
////    $sql .= ' AND is_spicy = 1';
////} elseif ($spicy_choice == 'no') {
////    $sql .= ' AND is_spicy = 0';
////}
////saler
////$spicy_choice = $GLOBALS['spicy_choices'][ $input['is_spicy'] ];
////if ($spicy_choice == 'yes') {
////    $sql .= ' AND is_spicy = 1';
////} elseif ($spicy_choice == 'no') {
////    $sql .= ' AND is_spicy = 0';
////}
//
//
//
//// отправить запрос программе базы данных и получить
//// в ответ все нужные строки из таблицы
//$stmt = $db->prepare($sql);
//$stmt->execute(array(0, 'saler'));
////$stmt->execute(array($input['min_price'], $input['max_price']));
//$dishes = $stmt->fetchAll();
//if (count($dishes) == 0) {
//    print 'Работающие сотрудники';
//} else {
//    print '<table>';
//    print
//    '<tr><th>Имя сотрудника</th><th>Price</th><th>Spicy?</th></tr>';
//    foreach ($dishes as $dish) {
//        if ($dish->active == 1) {
//            $active = 'Работает ';
//        } else {
//            $active = 'Не работает';
//        }
//        printf('<tr><td>%s</td><td>$%.02f</td><td>%s</td></tr>',
//        htmlentities($dish->name),
//        $dish->status, $active);
//    }
//}
//}

// Подключаем подвал сайта
require 'fooret.php'; 

