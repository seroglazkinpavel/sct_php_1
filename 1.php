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
				if(!empty(($get['login']) || ($get['password']) || ($get['age']))){
					if(isset($get['login'])) echo 'логин-'.$get['login'];
					elseif(isset($get['password'])) echo 'паспорт-'.$get['password'];
					elseif(isset($get['age'])) echo 'возраст-'.$get['age'];
				}else echo '<br>данных нет';
			}
			getUserData($_GET);
		?>
	</body>
</html>
