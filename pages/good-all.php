<h1>Каталог товаров</h1>
<?php

$db = @mysqli_connect('127.0.0.1', 'root', 'root', 'sct')or die('Ошибка соединения с БД');
if(!$db) die(mysqli_connect_error());
mysqli_set_charset($db, "utf8") or die('Не установлена кодировка');

$res = mysqli_query($db, "SELECT id, title, price FROM  product") or die(mysqli_error($db));

$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);

foreach ($rows as $row) {		
	echo "Название: <b><a href='?page=good-one&id={$row['id']}'>{$row['title']}</a></b> <br>";		
	echo "Цена: {$row['price']} <br>";
	echo '<hr>';
	
}
mysqli_close($db);
exit;
	
	


