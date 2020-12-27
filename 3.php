<?php
  $page = 3;
  $x = 23;
  $y = 0;
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">     
    <title>Урок 7</title>
	<style>
      a {
        text-decoration: none; /*убираем подчеркивание текста ссылок*/  
        color:#000; /*цвет ссылок*/  
        font-family: arial;  
      }
    </style>
  </head>
  <body>
    <main>
      <h2>Файл 3.php</h2>
      <nav>
        <ul>
          <?php if($page == 1){?>
            <li><a style="font-weight: bold;" href="/sct_php_1/1.php">Файл 1.php</a></li>
            <li><a href="/sct_php_1/2.php">Файл 2.php</a></li>
	        <li><a href="/sct_php_1/3.php">Файл 3.php</a></li>
	      <?php }?>
	      <?php if($page == 2){?>			  
            <li><a href="/sct_php_1/1.php">Файл 1.php</a></li>
            <li><a style="font-weight: bold;" href="/sct_php_1/2.php">Файл 2.php</a></li>
	        <li><a href="/sct_php_1/3.php">Файл 3.php</a></li>
	      <?php }?>
	      <?php if($page == 3){?>			  
            <li><a href="/sct_php_1/1.php">Файл 1.php</a></li>
            <li><a href="/sct_php_1/2.php">Файл 2.php</a></li>
	        <li><a style="font-weight: bold;" href="/sct_php_1/3.php">Файл 3.php</a></li>
	      <?php }?>					  		  
        </ul>
      </nav>
	  <?php
	    if($x >= 0 && $y >= 0){
	      $z = $x + $y;
	      echo 'Сумма чисел равна:'." $z";
	    
	    }
	    else if ($x > 0 || $y < 0 || $x < 0 || $y > 0){
	  	$z = $x + $y;  
	  	echo 'Сумма чисел равна :'." $z";  
	    }
	  ?>
    </main>
  </body>
</html>