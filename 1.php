<?php
  $page = 1;
  $int = -15;
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
	  .clear{
	    clear : both;
      }
    </style>
  </head>
  <body>
    <main>
      <h2>Файл 1.php</h2>
      <nav>
        <ul>
           <?php
            if($page == 1){
              echo'<li><a style="font-weight: bold;" href="/sct_php_1/1.php">Файл 1.php</a></li> <!--вместо style="font-weight: bold;" можно использовать <b>Файл 1.php</b>-->';
              echo'<li><a href="/sct_php_1/2.php">Файл 2.php</a></li>';
		      echo'<li><a href="/sct_php_1/3.php">Файл 3.php</a></li>';
			}
			else if($page == 2){			  
             echo'<li><a href="/sct_php_1/1.php">Файл 1.php</a></li>';
             echo '<li><a style="font-weight: bold;" href="/sct_php_1/2.php">Файл 2.php</a></li>';
		     echo '<li><a href="/sct_php_1/3.php">Файл 3.php</a></li>';
			}
			else if($page == 3){			  
             echo '<li><a href="/sct_php_1/1.php">Файл 1.php</a></li>';
             echo '<li><a href="/sct_php_1/2.php">Файл 2.php</a></li>';
		     echo '<li><a style="font-weight: bold;" href="/sct_php_1/3.php">Файл 3.php</a></li>';
			}
		  ?>
        </ul>
        <br class="clear">
      </nav>
	  <?php 
          if($int >= 0) echo "<h2>$int положительное число</h2>"; 		    
		  if($int < 0) echo "<h2>$int отрицательное число</h2>";		
	  ?>
    </main>
  </body>
</html>

