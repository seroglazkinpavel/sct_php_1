<?php
  $page = 2;
  $a = 1;
  $b = 4;
  $c = 32;
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
      <h2>Файл 2.php</h2>
        <nav>
          <ul>            		  
           <?php
            if($page == 1){
              echo'<li><a style="font-weight: bold;" href="/sct_php_1/1.php">Файл 1.php</a></li> <!--вместо style="font-weight: bold;" можно использовать <b>Файл 1.php</b>-->';
              echo'<li><a href="/sct_php_1/2.php">Файл 2.php</a></li>';
		      echo'<li><a href="/sct_php_1/3.php">Файл 3.php</a></li>';
			}
			else if($page == 2){
             echo '<li><a href="/sct_php_1/1.php">Файл 1.php</a></li>';
             echo '<li><a style="font-weight: bold;" href="/sct_php_1/2.php">Файл 2.php</a></li>';
		     echo '<li><a href="/sct_php_1/3.php">Файл 3.php</a></li>';
			}
			else if($page == 3){
             echo '<li><a href="/sct_php_1/1.php">Файл 1.php</a></li>';
             echo '<li><a href="/sct_php_1/2.php">Файл 2.php</a></li>';
		     echo '<li><a style="font-weight: bold;" href="/sct_php_1/3.php">Файл 3.php</a></li>';
			}
			echo '<br>';
			if($a > $b && $a > $c && $b > $c) echo $c.' - '.$b.' - '.$a;
			if($a > $b && $a >$c && $c > $b) echo $b.' - '.$c.' - '.$a;
			if($b > $a && $b > $c && $a > $c) echo $c.' - '.$a.' - '.$b;
			if($b > $a && $b >$c && $c > $a) echo $a.' - '.$c.' - '.$b;
			if($c > $b && $c > $a && $b > $a) echo $a.' - '.$b.' - '.$c;
			if($c > $b && $c >$a && $a > $b) echo $b.' - '.$a.' - '.$c;
		   ?>
          </ul>
          <br class="clear">
        </nav>
    </main>
  </body>
</html>
