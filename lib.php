<?php
if(isset($_GET['submit'])){
	$string = $_GET['string']?? false; 
}
$search = ['а', 'б', 'в', 'г', 'д', 'е', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'ы', 'э', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Ы', 'Э'];
$replace = ['a', 'b', 'v', 'g', 'd', 'e', 'g', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'i', 'e', 'A', 'B', 'V', 'G', 'D', 'E', 'G', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'I', 'E'];
$str = str_replace($search, $replace, $string);
$str = strtr($str, ['ё'=>"yo",'х'=>"h",'ц'=>"ts",'ч'=>"ch",'ш'=>"sh",'щ'=>"shch",'ъ'=>'','ь'=>'','ю'=>"yu",'я'=>"ya",'Ё'=>"Yo",'Х'=>"H",'Ц'=>"Ts",'Ч'=>"Ch",'Ш'=>"Sh",'Щ'=>"Shch",'Ъ'=>'','Ь'=>'','Ю'=>"Yu",'Я'=>"Ya"]);

echo $str;

$page = !empty($_GET['page']) ? $_GET['page'] : null;

function getFile($page = null){													
	switch($page){
		case 1:
			require_once '1.php';
			break;
		case 2:
			require_once 'page/2.php';
			break;
		default:
       	    require_once '1.php';
			
	}	
}

getFile($page);

function setDate($page){ 
	$date = date('d.m.Y H:i:s');
	switch($page){
		case 1:
			$record = $date.'-'.'Форма';
			break;
	    case 2:
		    $record = $date.'-'.'Приветствие пользователя';
			break;
		default:
       	    $record = $date.'-'.'Такой страницы нет.';	
	}		
	$rec = file_put_contents('log.php', $record);
	return $rec;
}
	
