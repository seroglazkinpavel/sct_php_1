<h1>Товар</h1>
<?php
$db = @mysqli_connect('127.0.0.1', 'root', 'root', 'sct')or die('Ошибка соединения с БД');
if(!$db) die(mysqli_connect_error());
mysqli_set_charset($db, "utf8") or die('Не установлена кодировка');
//$id = !empty($_GET['id'] ? $_GET['id'] : null);
//$id = $_GET['id'];
$id = $_GET['id']?? false;
$res = mysqli_query($db, "SELECT title, price FROM  product WHERE id =$id") or die(mysqli_error($db));

$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
foreach ($rows as $row) {		
	echo "Название: <b>{$row['title']}</b> <br>";		
	echo "Цена: {$row['price']} <br>";
	echo '<hr>';
}