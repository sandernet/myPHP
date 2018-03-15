<?php
/**
  * Страница выбора места. Предполагается, 
  * что в вашей базе данных присутствует таблица locations,
  */
// Подлючаем файл с пользовательскими функциями
require_once('header.php');
require_once('functions.php');

// Заранее инициализируем переменную авторизации, присвоив ей ложное значение
$localauth = false;


//// Если была нажата кнопка авторизации
//if(isset($_POST['submit'])) {
//	// Делаем массив сообщений об ошибках пустым
//	$errors['login'] = $errors['password'] = $errors['password_again'] = '';
//	
//	// С помощью стандартной функции trim() удалим лишние пробелы
//	// из введенных пользователем данных
//	$login = trim($_POST['login']);
//	$password = trim($_POST['password']);
//	
//	// Авторизуем пользователя
//	// Вызываем функцию регистрации, её результат записываем в переменную
//	$auth = authorization($login, $password);
//	
//	// Если авторизация прошла успешно, сообщаем об этом пользователю
//	// И создаем заголовок страницы, который выполнит переадресацию на защищенную
//	// от общего доступа страницу
//	if($auth === true) {
//		$message = '<p>Вы успешно авторизовались в системе. Сейчас вы будете переадресованы на главную страницу сайта. Если это не произошло, перейдите на неё по <a href="/">прямой&nbsp;ссылке</a>.</p>';
//		header('location: index.php');
//	}
//	// Иначе сообщаем пользователю об ошибке
//	else {
//		$errors['full_error'] = $auth;
//	}
//}







function outlocal() {
    $db = database();
    $sql = "SELECT `id`, `fullname`, `opentime`, `closetime`, `adres` FROM `locations`";
    $q = $db->query($sql); 
    return $q;
}

// Вывод данных в таблицу
$q = outlocal();





print '<table class="table table-hover">';
print '<thead class="thead-default"><tr><th>Название</th><th>Адрес</th><th>Время работы</th><th>****</th><th>****</th></tr></thead>';
print '<tbody>';
while ($row = $q->fetch()) {

    printf("<tr class=\"table-success\"><td id=%s>%s</td><td>%s</td><td>%s - %s</td><td>%s</td><td>%s</td></tr>",
    htmlentities($row[id]),
    htmlentities($row[fullname]),
    htmlentities($row[adres]),
    htmlentities($row[opentime]),
    htmlentities($row[closetime]),
    '<a href="#openModal" onclick="f('.htmlentities($row[id]).')" >Выбрать</a>',
    '<a href="#openModal" class="modal" onclick="mmmoooddd">Редактировать</a>');
}
print '</tbody>';
print '</table>';

//// Если запущен процесс авторизации, но она не была успешной,
//// или же авторизация еще не запущена, отображаем форму авторизации
//if($auth !== true) {
?>

<div class="">
    <a class="btn btn-outline-primary">Добавить</a>
</div>

<div id="openModal" class="modalDialog">
<div>
    <a href="#close" title="Закрыть" class="close">X</a>
<!--        <section class="container">
        <div class="login">  -->
    
        <div class="input-group margin">
            <input class="form-control" type="text">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-info btn-flat">Go!</button>
                </span>
        </div>
    
<!--        <form action="setting.php" method="post">
                <p><input type="hidden" name="locid" value="" autocomplete="off"></p>
                <p><input type="password" name="pin" value="" placeholder="ПИН код"></p>
                <p class="submit"><input type="submit" name="submit" value="Выбрать"></p>    
            </form>-->
<!--        </div>
    </section>-->
</div>
</div>
<?php
//}	// Закрывающая фигурная скобка условного оператора проверки успешной авторизации
//// Иначе выводим сообщение об успешной авторизации
//else {
//	print $message;
//}
//
///**
//  * Если всё правильно, будет выведено сообщение об успешной авторизации,
//  * пользователь будет переадресован на защищенную страницу
//  */

 require_once 'fooret.php';
?>

