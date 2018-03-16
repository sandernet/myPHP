<?php
/**
  * Страница авторизации пользователей. Предполагается, 
  * что в вашей базе данных присутствует таблица useradmin,
  * в которой существуют поля id, login и password
  */
// Подлючаем файл с пользовательскими функциями
require_once('functions.php');

// Заранее инициализируем переменную авторизации, присвоив ей ложное значение
$auth = false;

// Если была нажата кнопка авторизации
if(isset($_POST['submit'])) {
	// Делаем массив сообщений об ошибках пустым
	$errors['login'] = $errors['password'] = $errors['password_again'] = '';
	
	// С помощью стандартной функции trim() удалим лишние пробелы
	// из введенных пользователем данных
	$login = trim($_POST['login']);
	$password = trim($_POST['password']);
	
	// Авторизуем пользователя
	// Вызываем функцию регистрации, её результат записываем в переменную
	$auth = authorization($login, $password);
	
	// Если авторизация прошла успешно, сообщаем об этом пользователю
	// И создаем заголовок страницы, который выполнит переадресацию на защищенную
	// от общего доступа страницу
	if($auth === true) {
		$message = '<p>Вы успешно авторизовались в системе. Сейчас вы будете переадресованы на главную страницу сайта. Если это не произошло, перейдите на неё по <a href="/">прямой&nbsp;ссылке</a>.</p>';
		header('location: index.php');
	}
	// Иначе сообщаем пользователю об ошибке
	else {
		$errors['full_error'] = $auth;
	}
}

require_once 'header.php';

// Если запущен процесс авторизации, но она не была успешной,
// или же авторизация еще не запущена, отображаем форму авторизации
if($auth !== true) {
?>
<div class="d-flex p-4 justify-content-center">
    <p class="text-danger font-weight-bold"><?php echo $errors['full_error'].' '; ?></p>
</div>
<div class="d-flex justify-content-center">
    <form class="form-signin" action="" method="post">
        <img class="mb-4" src="images/logotip.png" alt="" width="200" height="100">
        <h1 class="h3 mb-3 font-weight-normal">Войти в систему</h1>
        
        <label for="inputEmail" class="sr-only">Логин</label>
        <input type="text" name="login" class="form-control" placeholder="Логин" required="" autofocus="" value="">
        
        <label for="inputPassword" class="sr-only">Пароль</label>
        <input type="password" name="password" class="form-control" placeholder="Пароль" required="" value="">
        
        <div class="checkbox mb-3">
            <label></label>
        </div>
        <input type="submit" name="submit" class="btn btn-lg btn-primary btn-block" value="Войти">
    </form>
</div>
<?php
}	// Закрывающая фигурная скобка условного оператора проверки успешной авторизации
// Иначе выводим сообщение об успешной авторизации
else {
	print $message;
}

/**
  * Если всё правильно, будет выведено сообщение об успешной авторизации,
  * пользователь будет переадресован на защищенную страницу
  */

 require_once 'fooret.php';
?>
