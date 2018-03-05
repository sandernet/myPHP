<?php

// Подлючаем файл с пользовательскими функциями
require_once('functions.php');


// Заранее инициализируем переменную авторизации, присвоив ей ложное значение
$auth = false;

// Если была нажата кнопка авторизации
if(isset($_POST['submit'])) {
	// Делаем массив сообщений об ошибках пустым
	$errors['pin'] = '';
	
	// С помощью стандартной функции trim() удалим лишние пробелы
	// из введенных пользователем данных
	$pin = trim($_POST['pin']);
	
	// Авторизуем пользователя
	// Вызываем функцию регистрации, её результат записываем в переменную
	$auth = checkpin($pin);
	
	// Если проверка принкода прошла успешно, сообщаем об этом пользователю
	// И создаем заголовок страницы, который выполнит переадресацию на защищенную
	// от общего доступа страницу
	if($auth === true) {
		$message = '<p>Добрый день</p>';
		
	}
	// Иначе сообщаем пользователю об ошибке
	else {
		$errors['check_error'] = $auth;
	}
}
?>

<!--Форма для отметки сотрудников во время прихода и ухода на работу-->
<section class="container">
    <div class="login">  
    <h1>ОТМЕТИТЬСЯ</h1>
    
    <?php 
    if ($auth === true) {
        print $message;
    }
    ?>
    
    	<form action="" method="post">
        <p><input type="password" name="pin" value="" placeholder="ПИН код"></p>
        <p class="remember_me">
            <label>
                <!-- Блок для вывода сообщений об ошибках -->
                <?php echo $errors['check_error'].' '; ?>
            </label>
        </p>
        <p class="submit"><input type="submit" name="submit" value="Ok"></p>    
	</form>
    </div>
</section>

