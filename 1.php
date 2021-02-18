<!DOCTYPE html>
<html lang="ru">
	<head>		
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">	
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<a href="1.php?login=$login">логин</a>
		<a href="1.php?password=$password">пароль</a>
		<a href="1.php?age=$age">возраст</a>
		<a href="/">очистить</a>
		<?PHP
			echo '<br>';
			
			function getUserData($get){
				//$login = $_GET[login];
				//$password = $_GET[password];
				//$age = $_GET[age];
				if(!empty(($_GET[login]) || ($_GET[password]) || ($_GET[age]))){
					echo '<pre>';
					print_r($get);
					echo '</pre>';
				}else echo '<br>данных нет';
			}
			getUserData($_GET);
		?>
	</body>
</html>