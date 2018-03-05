<?php
/**
  * functions.php
  * Файл с пользовательскими функциями
  */
  
// Подключаем файл с параметрами подключения к СУБД
require_once('config.php');

// Проверка имени пользователя
function checkLogin($str) {
	// Инициализируем переменную с возможным сообщением об ошибке
	$error = '';	
	// Если отсутствует строка с логином, возвращаем сообщение об ошибке
	if(!$str) {
		$error = 'Вы не ввели имя пользователя';
		return $error;
	}	
	/**
	  * Проверяем имя пользователя с помощью регулярных выражений
	  * Логин должен быть не короче 4, не длинне 16 символов
	  * В нем должны быть символы латинского алфавита, цифры, 
	  * в нем могут быть символы '_', '-', '.'
	  */
	$pattern = '/^[-_.a-z\d]{4,16}$/i';	
	$result = preg_match($pattern, $str);	
	// Если проверка не прошла, возвращаем сообщение об ошибке
	if(!$result) {
		$error = 'Недопустимые символы в имени пользователя или имя пользователя слишком короткое (длинное)';
		return $error;
	}	
	// Если же всё нормально, вернем значение true
	return true;
}

// Проверка пароля пользователя
function checkPassword($str) {
	// Инициализируем переменную с возможным сообщением об ошибке
	$error = '';	
	// Если отсутствует строка с логином, возвращаем сообщение об ошибке
	if(!$str) {
		$error = 'Вы не ввели пароль';
		return $error;
	}	
	/**
	  * Проверяем пароль пользователя с помощью регулярных выражений
	  * Пароль должен быть не короче 6, не длинне 16 символов
	  * В нем должны быть символы латинского алфавита, цифры, 
	  * в нем могут быть символы '_', '!', '(', ')'
	  */
	$pattern = '/^[_!)(.a-z\d]{6,16}$/i';	
	$result = preg_match($pattern, $str);	
	// Если проверка не прошла, возвращаем сообщение об ошибке
	if(!$result) {
		$error = 'Недопустимые символы в пароле пользователя или пароль слишком короткий (длинный)';
		return $error;
	}	
	// Если же всё нормально, вернем значение true
	return true;
}

//// Функция регистрации пользователя
//function registration($login, $password) {
//	// Инициализируем переменную с возможным сообщением об ошибке
//	$error = '';	
//	// Если отсутствует строка с логином, возвращаем сообщение об ошибке
//	if(!$login) {
//		$error = 'Не указан логин';
//		return $error;
//	} 
//	elseif(!$password) {
//		$error = 'Не указан пароль';
//		return $error;
//	}
//	
//	// Проверяем не зарегистрирован ли уже пользователь
//	// Подключаемся к СУБД
//	database();
//	
//	// Пишем строку запроса
//	$sql = "SELECT `id` FROM `users` WHERE `login`='" . $login . "'";
//	// Делаем запрос к базе
//	$query = mysql_query($sql) or die("<p>Невозможно выполнить запрос: " . mysql_error() . ". Ошибка произошла в строке " . __LINE__ . "</p>");
//	// Смотрим на количество пользователей с таким логином, если есть хоть один,
//	// возвращаем сообщение об ошибке
//	if(mysql_num_rows($query) > 0) {
//		$error = 'Пользователь с указанным логином уже зарегистрирован';
//		return $error;
//	}
//	
//	// Если такого пользователя нет, регистрируем его
//	// Пишем строку запроса
//	$sql = "INSERT INTO `users` 
//			(`id`,`login`,`password`) VALUES 
//			(NULL, '" . $login . "','" . $password . "')";
//	// Делаем запрос к базе
//	$query = mysql_query($sql) or die("<p>Невозможно добавить пользователя: " . mysql_error() . ". Ошибка произошла в строке " . __LINE__ . "</p>");
//	
//	// Не забываем отключиться от СУБД
//	mysql_close();
//	
//	// Возвращаем значение true, сообщающее об успешной регистрации пользователя
//	return true;
//}

/**
  * Функция авторизации пользователя.
  * Авторизация пользователей у нас будет осуществляться
  * с помощью сессий PHP.
  */
function authorization($login, $password) {
	// Инициализируем переменную с возможным сообщением об ошибке
	$error = '';	
	// Если отсутствует строка с логином, возвращаем сообщение об ошибке
	if(!$login) {
		$error = 'Не указан логин';
		return $error;
	} 
	elseif(!$password) {
		$error = 'Не указан пароль';
		return $error;
	}	
	// Проверяем не зарегистрирован ли уже пользователь
	// Подключаемся к СУБД
	$db = database();
	
	// Нам нужно проверить, есть ли такой пользователь среди зарегистрированных
	// Составляем строку запроса
	$sql = "SELECT `id` FROM `useradmin` WHERE `login`='".$login."' AND `password`='".$password."'";
       
        // Выполняем запрос
	$q = $db->query($sql); // mysql_query($sql) or die("<p>Невозможно выполнить запрос: " . mysql_error() . ". Ошибка произошла в строке " . __LINE__ . "</p>");
        
        $query = $q->fetchAll();
	// Если пользователя с такими данными нет, возвращаем сообщение об ошибке
        
	if (count($query) == 0)	{
		$error = 'Пользователь с указанными данными не зарегистрирован';
		return $error;
	}
	
	// Если пользователь существует, запускаем сессию
	session_start();
	// И записываем в неё логин и пароль пользователя
	// Для этого мы используем суперглобальный массив $_SESSION
	$_SESSION['login'] = $login;
	$_SESSION['password'] = $password;

        // Возвращаем true для сообщения об успешной авторизации пользователя
	return true;
}

function checkAuth($login, $password) {
    // Если нет логина или пароля, возвращаем false
    if(!$login || !$password)
        return false;
	
    // Проверяем зарегистрирован ли такой пользователь
    // Подключаемся к СУБД
    $db = database();

    // Составляем строку запроса
    $sql = "SELECT `id` FROM `useradmin` WHERE `login`='".$login."' AND `password`='".$password."'";
    // Выполняем запрос
    $q = $db->query($sql); 
    $query = $q->fetchAll();
    // Если пользователя с такими данными нет, возвращаем false;
    if (count($query) == 0)	{
            return false;
    }
    // Иначе возвращаем true
    return true;
}

function checkpin($pin) {
	// Инициализируем переменную с возможным сообщением об ошибке
	$error = '';	
	// Если отсутствует строка с логином, возвращаем сообщение об ошибке
	if(!$pin) {
		$error = 'Не введен ПИН код';
		return $error;
	} 
		
	// Проверяем не зарегистрирован ли уже пользователь
	// Подключаемся к СУБД
	$db = database();
	
	// Нам нужно проверить, есть ли такой пользователь среди зарегистрированных
	// Составляем строку запроса
	$sql = "SELECT `id`, `name`, `pin`, `status`, `active`, `createdAt`, `updatedAt` FROM `users` WHERE users.pin =$pin";
       
        // Выполняем запрос
	$q = $db->query($sql); // mysql_query($sql) or die("<p>Невозможно выполнить запрос: " . mysql_error() . ". Ошибка произошла в строке " . __LINE__ . "</p>");
        
        $query = $q->fetchAll();
	// Если пользователя с такими данными нет, возвращаем сообщение об ошибке
        
	if (count($query) == 0)	{
		$error = 'Вы ввели не верный пароль';
		return $error;
	}
	
        // Возвращаем true для сообщения об успешной авторизации пользователя
	return true;
}

function addworktime($pin, $locationid) {
   // $db = database();
    $qlocat = $db->query("SELECT `id`, `opentime`, `closetime` FROM `locations` WHERE `id` = '1'");
    $qlocatd = $qlocat->fetchAll();
//    $qlocat->execute($locationid);
    print $qlocatd['opentime'];

    $quser = $db->query("SELECT `id`, `name`, `pin`, `status`, `active`, `createdAt`, `updatedAt` FROM `users` WHERE `pin` = $pin");
    
    print $quser['name'];
    
    // Составляем строку запроса
    $stmt = $db->prepare('INSERT INTO `checks`(`userId`, `locationId`, `late`, `io`, `rationale`, `createdAt`, `updatedAt`) VALUES (?,?,?,?,?,?,?)');

   // $stmt = $db->prepare('INSERT INTO dishes (dish_name, price, is_spicy) VALUES (?,?,?)');
    //$stmt->execute(array($_POST['new_dish_name'], $_POST['new_price'], $_POST('is_spicy']));
    $date = date();
    $stmt->execute(array($qlocatd['id'], $quser['id'],1,1, $quser['name'],$date,$date));
        
	
        // Выполняем запрос
//	$q = $db->query($sql); 
//	if (count($query) == 0)	{
//		$error = 'Вы ввели не верный пароль';
//		return $error;
//	}	
        // Возвращаем true для сообщения об успешной авторизации пользователя
        //если опоздал выводим true, если нет выводим false
	return $q;
}
?>