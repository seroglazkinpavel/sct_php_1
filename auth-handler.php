<?php
session_start();

define('ADMIN', 'Admin');
define('PASSWORD', '121121');

if(!empty($_POST['login']) && !empty($_POST['password'])){
	if(trim($_POST['login']) === ADMIN && trim($_POST['password']) === PASSWORD){
		$admin = $_SESSION['use'] = ADMIN;
		$_SESSION['res'] = '<span style="color:green;"><b>Добро пожаловать, <b>'."$admin".'!</b> <a href="3.php?do=exit">Logout</a></b></span>';	
	}else $_SESSIO['res'] = '<p style="color:#ff0000;"><b>Неверный логин или пароль!</b></p><a href="3.php">Logout</a>';
				
}
if(empty($_POST['login']) || empty($_POST['password'])){
	$_SESSION['res'] = '<p style="color:#ff0000;"><b>Заполните логин или пароль!</b></p><a href="3.php">Logout</a>'
}
if(isset($_SESSION['res'])){
	echo $_SESSION['res'];
	unset($_SESSION['res']);
}



