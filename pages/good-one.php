<h1>Товар</h1>
<?php

$link = instance();

$id = $_GET['id']?? false;
$res = mysqli_query($link, "SELECT title, price FROM  product WHERE id =$id") or die(mysqli_error($link));

$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
foreach ($rows as $row) {		
	echo "Название: <b>{$row['title']}</b> <br>";		
	echo "Цена: {$row['price']} <br>";
	echo '<hr>';
}
mysqli_close($link);
exit;