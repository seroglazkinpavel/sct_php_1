<?php
	
$page = $_GET['page'];
/*if(empty($_GET['page']) && $_GET['page'] != 2){
	require_once '1.php';

}else{ 
	getFile($page);
}*/
function getFile($page){													
	switch($page){
		case 1:
			require_once '1.php';
			break;
		case 2:
			require_once 'page/2.php';
			break;
	}	
}

$content = getFile($page);

function setDate($content){	
	$date = date('d.m.Y H:i:s');
	$str = file_put_contents('log.php',[$date.PHP_EOL, $content]);
	return $str;
}	