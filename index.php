<?php
  $name = 'Урок 6';
  $main = '/sct_php_1/';
  $about_us = '/sct_php_1/1.php';
  $pictures = '/sct_php_1/2.php';
  $contacts = '/sct_php_1/3.php';
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
            <li><a href="<?=$about_us;?>">Файл 1.php</a></li>
            <li><a href="<?=$pictures;?>">Файл 2.php</a></li>
			<li><a href="<?=$contacts;?>">Файл 3.php</a></li>
          </ul>
        </nav>
      </header>
    </main>	
  </body>
</html>



