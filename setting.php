<?php
/**
  * Страница выбора места. Предполагается, 
  * что в вашей базе данных присутствует таблица locations,
  */
// Подлючаем файл с пользовательскими функциями
require_once('header.php');
require_once('functions.php');

?>
<div style="text-align: center">
    <h1 class="font-weight-bold"> МЕСТА </h1>
    <div class="btn btn-primary adloc">Добавить</div>
</div> 
<!--Форма ввода пинкода-->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Выбрать место</h5>
            </div>
            <form action="setting.php" method="post">
                <div class="modal-body">
                    <input  type="hidden" name="locid" value="" autocomplete="off">
                    <input class="form-control form-control-lg" type="password" name="pin" value="" placeholder="ПИН код">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" name="submit" class="btn btn-primary" value="OK"> 
                </div>
            </form>
    </div>
  </div>
</div>

<?php
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

print '<table class="table table-bordered table-hover">';
print '<thead class="thead-light"><tr><th>Название</th><th>Адрес</th><th>Время работы</th><th>****</th><th>****</th></tr></thead>';
print '<tbody>';
while ($row = $q->fetch()) {

    printf("<tr class=\"table-light\"><td id=%s>%s</td><td>%s</td><td>%s - %s</td><td>%s</td><td>%s</td></tr>",
    htmlentities($row[id]),
    htmlentities($row[fullname]),
    htmlentities($row[adres]),
    htmlentities($row[opentime]),
    htmlentities($row[closetime]),
    '<a class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong" onclick="f('.htmlentities($row[id]).')" >Выбрать</a>',
    '<a class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong" onclick="mmmoooddd">Редактировать</a>');
}
print '</tbody>';
print '</table>';

//// Если запущен процесс авторизации, но она не была успешной,
//// или же авторизация еще не запущена, отображаем форму авторизации
//if($auth !== true) {
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

