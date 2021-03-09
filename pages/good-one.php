<h1>Товар</h1>
<?php
/*function instance(){
	static $link;
	if($link === null){
		$link = @mysqli_connect('127.0.0.1', 'root', 'root', 'sct')or die('Ошибка соединения с БД');
		if(!$link) die(mysqli_connect_error());
		mysqli_set_charset($link, "utf8") or die('Не установлена кодировка');
	}
	return $link;
}*/
include 'lib.php';

$link = instance();

$id = $_GET['id']?? false;
$res = mysqli_query($link, "SELECT title, price FROM  product WHERE id =$id") or die(mysqli_error($db));

$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
foreach ($rows as $row) {		
	echo "Название: <b>{$row['title']}</b> <br>";		
	echo "Цена: {$row['price']} <br>";
	echo '<hr>';
}
mysqli_close($link);
exit;