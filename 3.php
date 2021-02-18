<?php
$page = $_GET['page'];
if(empty($page)){
	echo 'Я помню чудное мгновенье...<br>
			Евгений Онегин<br>
			Зимнее утро<br>
			Осень';
					
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



