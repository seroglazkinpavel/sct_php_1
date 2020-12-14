<?php
	$main = '/sct_php_1/';
	$about_us = '/sct_php_1/pages/1.php';
	$pictures = '/sct_php_1/pages/2.php';
	$a = '../images/1.png';
	$b = '../images/2.png';
	$c = '../images/3.png';
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
				<?='<h2>Файл 2.php!</h2>'; ?>
				<nav>
					<ul>
						<li><a href="<?=$main;?>">Главная</a></li>
						<li><a href="<?=$about_us;?>">О нас</a></li>
						<li><a href="<?=$pictures;?>">Картинки</a></li>
					</ul>
					<br class="clear">
				</nav>
			</header>
			<section>
				<div class="content">
					<div class="content__block">
						<div class="content__element">
							 <img src="<?=$a;?>" alt="Картинка">
						</div>
						<div class="content__element">
							<img src="<?=$b;?>" alt="Картинка">
						</div>
						<div class="content__element">
							<img src="<?=$c;?>" alt="Картинка">
						</div>
						<div class="content__element">
							<?php $b = '../images/4.png';?>
							<img src="<?=$b;?>" alt="Картинка">
						</div>
						<div class="content__element">
							<?php $c = '../images/5.png';?>
							<img src="<?=$c;?>" alt="Картинка">
						</div>
					</div>
				</div>
			</section>
		</main>	
    </body>
</html>
