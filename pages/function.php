<?php

function instance(){
	static $link;
	if($link === null){
		$link = @mysqli_connect('127.0.0.1', 'root', 'root', 'sct')or die('Ошибка соединения с БД');
		if(!$link) die(mysqli_connect_error());
		mysqli_set_charset($link, "utf8") or die('Не установлена кодировка');
	}
	return $link;
}