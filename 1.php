<!DOCTYPE html>
<html lang="ru">
	<head>		
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">	
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<a href="1.php?login=Петя">логин</a>
		<a href="1.php?password=123">пароль</a>
		<a href="1.php?age=45">возраст</a>
		<a href="/">очистить</a>
		<?PHP
			echo '<br>';
			
			function getUserData($get){
				if(!empty(($_GET['login']) || ($_GET['password']) || ($_GET['age']))){
					if($_GET['login']) echo 'логин-'.$_GET['login'];
					elseif($_GET['password']) echo 'паспорт-'.$_GET['password'];
					elseif($_GET['age']) echo 'возраст-'.$_GET['age'];
				}else echo '<br>данных нет';
			}
			getUserData($_GET);
		?>
	</body>
</html>
