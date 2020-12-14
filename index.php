<?php
    $name = 'Урок 5';
	$main = '/sct_php_1/';
	$about_us = '/sct_php_1/pages/1.php';
	$pictures = '/sct_php_1/pages/2.php';
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
		<link rel="stylesheet" href="style.css">
        <title><?=$name ?></title>
    </head>
    <body>
		<main>
			<header>
				<h2><?=$name?></h2>
				<nav>
					<ul>
						<li><a href="<?=$main;?>">Главная</a></li>
						<li><a href="<?=$about_us;?>">О нас</a></li>
						<li><a href="<?=$pictures;?>">Картинки</a></li>
					</ul>
				</nav>
			</header>
		</main>	
    </body>
</html>



