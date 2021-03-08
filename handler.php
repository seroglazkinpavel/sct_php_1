<?php

session_start();
define('ADMIN', 'admin');

if(!empty($_POST['login'])){
	if($_POST['login'] === ADMIN){
		$_SESSION['admin'] = ADMIN;
		$_SESSION['res'] = '<span style="color:green;"><b>Вы успешно авторизовались. Зайдите в меню: <a href="/sct_php_1/?page=adding-products">Добавление товаров</a></b></span>';
		
	}else{
		$_SESSION['res'] = '<p style="color:#ff0000;"><b>Неверный логин!</b></p><p>Повторите еще раз: <a href="/sct_php_1/?page=auth-form">Авторизация</a></p>';
		
	}
	
}
if(isset($_SESSION['res'])){
	echo $_SESSION['res'];
	unset($_SESSION['res']);
}
