<h1>Каталог товаров</h1>
<?php

/*function instance(){
	static $link = null;
	if($link === null){
		$link = @mysqli_connect('127.0.0.1', 'root', 'root', 'sct')or die('Ошибка соединения с БД');
		if(!$link) die(mysqli_connect_error());
		mysqli_set_charset($link, "utf8") or die('Не установлена кодировка');
	}
	return $link;
}*/
include 'lib.php';
		
$link = instance();

$res = mysqli_query($link, "SELECT id, title, price FROM  product") or die(mysqli_error($link));

$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);

foreach ($rows as $row) {		
	echo "Название: <b><a href='?page=good-one&id={$row['id']}'>{$row['title']}</a></b> <br>";		
	echo "Цена: {$row['price']} <br>";
	echo '<hr>';
	
}
mysqli_close($link);
exit;
