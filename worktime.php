<?php

// Подлючаем файл с пользовательскими функциями
require_once('functions.php');

function worktime($wheresql = '') {
	$db = database();
	// Составляем строку запроса
	$sql = "SELECT `checks`.`id`, `users`.`name`, `locations`.`fullname` as locat, `late`, `io`, `rationale`, `checks`.`createdAt`, `checks`.`updatedAt` 
                FROM `checks`, `locations`, `users` 
                WHERE `checks`.`userId`=`users`.`id` and `checks`.`locationId` = `locations`.`id` $wheresql
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
                addworktime($pin, 1);
		
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

<?php

if (isset($_POST['date']) && isset($_POST['datestart']) && isset($_POST['dateend'])) {
    
    $datestart = date('Y-m-d h:i:s', strtotime($_POST['datestart'])); 
    print "\$datestart = " . $datestart . "\n";

    $dateend = date('Y-m-d h:i:s', strtotime($_POST['dateend']));
    print "\$dateend = " . $dateend . "\n";

    $wheresql = " and `checks`.`createdAt` >= '$datestart'  and `checks`.`createdAt` <= '$dateend' ";
    print "\$wheresql = " . $wheresql . "\n";
}
else {
    $wheresql = '';
}


$q = worktime($wheresql);

print '<table>';
print '<tr><th>Имя</th><th>Место</th><th>Дата и время</th><th>Событие</th><th>Опоздание</th></tr>';

while ($row = $q->fetch()) {
    
    if ($row[io] == 1) {$text1 = 'пришел';} 
    else {{$text1 = 'ушел';}}
 
    if ($row[late] == 1) {$text2 = 'опоздал';} 
    else {{$text2 = '-';}}
 
    
    printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",
    htmlentities($row[name]),
    htmlentities($row[locat]),
    date('d.m.Y h:i', strtotime($row[createdAt])),
    date('d.m.Y h:i', strtotime($row[updatedAt])),
    $text1, 
    $text2);
}
print '</table>';
?>

<div>
    <form action="" method="post">
            <p>
                <label for="date">Начало периода: </label>
                <input type="date" id="date" name="datestart"/>
            </p>
            <p>
                <label for="date">Конец периода: </label>
                <input type="date" id="date" name="dateend"/>
            </p>
            <p>
                <button type="submit" name="date" value="date">Выбрать</button>
            </p>
        </form>
</div>
        

<?php

require_once 'fooret.php';
