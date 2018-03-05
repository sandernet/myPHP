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

function worktime() {
	$db = database();
	// Составляем строку запроса
	$sql = "SELECT `checks`.`id`, `users`.`name`, `locations`.`fullname` as locat, `late`, `io`, `rationale`, `checks`.`createdAt`, `checks`.`updatedAt` 
                FROM `checks`, `locations`, `users` 
                WHERE `checks`.`userId`=`users`.`id` and `checks`.`locationId` = `locations`.`id`
                ORDER BY `checks`.`id` DESC
                LIMIT 100";
        // Выполняем запрос
	$q = $db->query($sql); 
//	if (count($query) == 0)	{
//		$error = 'Вы ввели не верный пароль';
//		return $error;
//	}	
        // Возвращаем true для сообщения об успешной авторизации пользователя
	return $q;
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

<?php
$q = worktime();

print '<table>';
print '<tr><th>Имя</th><th>Место</th><th>Дата и время</th><th>Событие</th><th>Опоздание</th></tr>';

while ($row = $q->fetch()) {
    
 if ($row[io] = 1) {$text1 = 'пришел';} 
 else {{$text1 = 'ушел';}}
    
    printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",
    htmlentities($row[name]),
    htmlentities($row[locat]),
    date('d.m.Y h:m', strtotime($row[createdAt])),
    $text1,
    htmlentities($row[late]));
}
print '</table>';


//foreach ($dishes as $dish) {
//    if ($dish->is_spicy == 1) {
//        $spicy = 'Yes';
//    } else {
//        $spicy = 'No';
//    }
//    printf('<tr><td>%s</td><td>$%.02f</td><td>%s</td></tr>',
//    htmlentities($dish->dish_name),
//    $dish->price, $spicy);
?>
<!--
<table>
<tr>
  <th>Company</th>
  <th>Q1</th>
  <th>Q2</th>
  <th>Q3</th>
  <th>Q4</th>
  </tr>
 <tr>
  <td>Microsoft</td>
  <td>20.3</td>
  <td>30.5</td>
  <td>23.5</td>
  <td>40.3</td>
 </tr>
<tr>
  <td>Google</td>
  <td>50.2</td>
  <td>40.63</td>
  <td>45.23</td>
  <td>39.3</td>
</tr>
<tr>
  <td>Apple</td>
  <td>25.4</td>
  <td>30.2</td>
  <td>33.3</td>
  <td>36.7</td>
</tr>
<tr>
  <td>IBM</td>
  <td>20.4</td>
  <td>15.6</td>
  <td>22.3</td>
  <td>29.3</td>
</tr>
</table>-->

