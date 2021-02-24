<!DOCTYPE html>
<html lang="ru">
	<head>		
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">	
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<a href="index.php?page=1">Калькулятор</a><br>
		<a href="index.php?page=2">Евгений Онегин</a><br>
		<a href="index.php?page=3">Зимнее утро</a><br>
		<?php
			echo '<br>';
			$page = $_GET['page'];
			if(empty($_GET['page']) && $_GET['page'] != 3 && $_GET['page'] != 2){
				require_once '1.php';
			}else{
				echo getFile($page);
			}
			
			function getFile($page){													
				switch($page){
					case 1:
						require_once '1.php';
						break;
					case 2:
						require_once '2.php';
						break;
					case 3:
						require_once '3.php';
						break;					
				}				
			}
		?>
	</body>
</html>
