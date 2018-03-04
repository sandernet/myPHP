<?php
/**
 *  Функция для получения перечня производителей автомобилей
 */
function getProducers() {
	// Подключаемся к СУБД MySQL
	connect();
	
	// Выбираем всех производителей из таблицы
	$sql = "SELECT * FROM `producers` ORDER BY `producer`";
	
	// Выполняем запрос
	$query = mysql_query( $sql ) or die ( mysql_error() );
	
	// Поместим данные, которые будет возвращать функция, в массив
	// Пока что он будет пустым
	$array = array();
	
	// Инициализируем счетчик
	$i = 0;
	
	while ( $row = mysql_fetch_assoc( $query ) ) {
		
		$array[ $i ][ 'id' ] = $row[ 'id' ];				// Идентификатор производителя
		$array[ $i ][ 'producer' ] = $row[ 'producer' ];	// Имя производителя
		
		// После каждой итерации цикла увеличиваем счетчик
		$i++;
		
	}
	
	// Возвращаем вызову функции массив с данными
	return $array;
	
}

// Функция, которая выбирает модели автомодилей по переданному
// ей идентификатору производителя
function getModels( array $array ) {
	
	// Сохраняем идентификатор производителя из переданного массива
	$sProducerId = htmlspecialchars( trim ( $array[ 'producer_id' ] ) );
	
	// Подключаемся к MySQL
	connect();
	
	// Строка запроса из базы данных
	$sql = "SELECT `id`, `model` FROM `models` WHERE `producer_id` = '" . $sProducerId . "' ORDER BY `model`";
	
	// Выполняем запрос
	$query = mysql_query( $sql ) or die ( mysql_error() );
	
	// Поместим данные, которые будет возвращать функция, в массив
	// Пока что он будет пустым
	$array = array();
	
	// Инициализируем счетчик
	$i = 0;
	
	while ( $row = mysql_fetch_assoc( $query ) ) {
		
		$array[ $i ][ 'id' ] = $row[ 'id' ];		// Идентификатор модели
		$array[ $i ][ 'model' ] = $row[ 'model' ];	// Наименование модели
		
		// После каждой итерации цикла увеличиваем счетчик
		$i++;
		
	}
	
	// Возвращаем вызову функции массив с данными
	return $array;
	
}
?>