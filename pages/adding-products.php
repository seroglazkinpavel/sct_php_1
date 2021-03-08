<?php
session_start();

if( isset($_GET['do']) && $_GET['do'] == 'exit' ) unset($_SESSION['admin']);
if( !isset($_SESSION['admin']) ) die('Вы не авторизованы! <a  href="?page=auth-form"><b>Авторизуйтесь</b></a>');
echo "Добро пожаловать, <b>{$_SESSION['admin']}!</b> ";

$db = @mysqli_connect('127.0.0.1', 'root', 'root', 'sct')or die('Ошибка соединения с БД');
if(!$db) die(mysqli_connect_error());
mysqli_set_charset($db, "utf8") or die('Не установлена кодировка');		
	
if (isset($_POST['myform'])) {
    $title = mysqli_real_escape_string($db, trim($_POST['title']))?? false;
    $price = trim($_POST['price'])?? false;
	if(!empty($title) && !empty($title) && is_numeric($price)) {
		$query = "INSERT INTO `product` (`id`, `title`, `content`, `price`, `old_price`, `status`, `keywords`, `description`, `img`, `hit`)
							 VALUES (NULL, '$title', NULL, '$price', '0', '1', NULL, NULL, 'no_image.jpg', '0')";
		$res = mysqli_query($db, $query);
		if($res) echo 'Товар добавлен';
		mysqli_close($db);
		exit;
	}else		
		echo '<h2 style="color:red">Не правильно заполнена форма<h2>';				
}		
?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">	
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body><a href="?page=adding-products&do=exit">Logout</a>
		<h2>Добавление товаров</h2>
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

