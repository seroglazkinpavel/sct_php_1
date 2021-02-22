<?php
$page = $_GET['page'];
if(empty($page)){
	 echo  '<a href="3.php?page=1">Я помню чудное мгновенье...</a><br>
		    <a href="3.php?page=2">Евгений Онегин</a><br>
			<a href="3.php?page=3">Зимнее утро</a><br>
			<a href="3.php?page=4">Осень</a>';
					
}else
	switch($page){
		case 1:
			echo 'Я помню чудное мгновенье...';
			break;
		case 2:
			echo 'Евгений Онегин';
			break;
		case 3:
			echo 'Зимнее утро';
			break;
		case 4:
			echo 'Осень';
			break;
		default:
			echo "Такого значения нет";
}
	



