<?php
if (isset($_POST['myform'])) {
         $title = $_POST['title']?? false;
         $price = $_POST['price']?? false;

$db = @mysqli_connect('127.0.0.1', 'root', 'root', 'sct')or die('Ошибка соединения с БД');
if(!$db) die(mysqli_connect_error());
mysqli_set_charset($db, "utf8") or die('Не установлена кодировка');		
	
$query = "INSERT INTO `product` (`id`, `title`, `content`, `price`, `old_price`, `status`, `keywords`, `description`, `img`, `hit`)
				VALUES (NULL, '$title', NULL, '$price', '0', '1', NULL, NULL, 'no_image.jpg', '0')";
$res = mysqli_query($db, $query);
				
}		
?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">	
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<h1>Добавление товаров</h1>
		<form action="" method="post">
			<div>
				Название: <input type="text" name="title" value="" />
			</div><br>
			<div>
				Цена: <input style="margin-left:30px;" type="text" name="price" value="" />
			</div><br>
			<div>
				<input style="margin-left:75px;" type="submit" name="myform" value="ОТПРАВИТЬ" />
			</div>
		</form>
	</body>
</html>
