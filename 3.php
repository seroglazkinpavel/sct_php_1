<?php
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
      <title>Урок 6</title>
  </head>
  <body>
    <main>
      <h2>Файл 3.php<h2>
        <nav>
          <ul>
            <li><a href="<?=$main;?>">Главная</a></li>
            <li><a href="<?=$about_us;?>">Файл 1.php</a></li>
            <li><a href="<?=$pictures;?>">Файл 2.php</a></li>
			<li><a href="<?=$contacts;?>">Файл 3.php</a></li>
          </ul>
          <br class="clear">
        </nav>
        <section style="margin-top:20px;">
          <?php
          $a = 23;
          $b = 7;
		  $rem = $a % $b;
          echo "Результат целочисленного деления 3  и остатка от деления $rem";
          ?>
        </section>
    </main>
  </body>
</html>