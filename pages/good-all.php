<h1>Каталог товаров</h1>
<?php

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
