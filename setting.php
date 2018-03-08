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

print '<table>';
print '<tr><th>Название</th><th>Адрес</th><th>Время работы</th><th>****</th><th>****</th></tr>';

while ($row = $q->fetch()) {

    printf("<tr><td>%s</td><td>%s</td><td>%s - %s</td><td>%s</td><td>%s</td></tr>",
    htmlentities($row[fullname]),
    htmlentities($row[adres]),
    htmlentities($row[opentime]),
    htmlentities($row[closetime]),
    '<a href="#openModal" class="modal" onclick="mmmoooddd">Выбрать</a>',
    '<a href="#openModal" class="modal" onclick="mmmoooddd">Редактировать</a>');
}

print '</table>';



//// Если запущен процесс авторизации, но она не была успешной,
//// или же авторизация еще не запущена, отображаем форму авторизации
//if($auth !== true) {
?>
      
<!--<section class="container">
    <div class="login">  
    <h1>Войти в систему</h1>
	<form action="" method="post">
            <p><input type="text" name="login" value="" placeholder="Логин:"></p>
            <p><input type="password" name="password" value="" placeholder="Пароль"></p>
            <p class="remember_me">
          <label>
                 Блок для вывода сообщений об ошибках 
                //<?php
//                echo $errors['full_error'].' ';
//                ?>
          </label>
            </p>
            <p class="submit"><input type="submit" name="submit" value="Войти"></p>    
	</form>
    </div>
</section>-->
//<?php
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

