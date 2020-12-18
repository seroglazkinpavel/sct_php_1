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
      <h2>Файл 2.php<h2>
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
          $a = (int)"456 dfghj";
          $b = (int)"969294233720368754775807 mhlgvtro";  //(int) приводит строку к целочисленному числу 969294233720368754775807
          echo "$a".'<br>';
          echo "$b";
          ?>
        </section>
    </main>
  </body>
</html>
