<?php
	$name = 'Павел';
	$address = 'г. Астрахань ул. Боевая д 23 кв 5';
	$registration = 'г. Астрахань ул. Боевая д 23 кв 5';
	$age = 57;
	$pol = 'мужской';
	$main = '/sct_php_1/';
	$about_us = '/sct_php_1/pages/1.php';
	$pictures = '/sct_php_1/pages/2.php';
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../style.css">
        <title>Урок 5</title>
    </head>
    <body>
		<main>
			<header>				
				<nav>
					<ul>
						<li><a href="<?=$main;?>">Главная</a></li>
						<li><a href="<?=$about_us;?>">О нас</a></li>
						<li><a href="<?=$pictures;?>">Картинки</a></li>
					</ul>
				</nav>
				<br class="clear">
			</header>
			<section>
				<div>
					<h2><?='О нас';?></h2>
					<p>Меня зовут <?="$name";?></p>
					<p>Проживаю <?="$address";?></p>
					<p>Прописан <?="$registration";?></p>
					<p>Возраст <?="$age";?> лет</p>
					<p>Пол <?="$pol";?></p>
				</div>
			</section>
		</main>	
   </body>
</html>
