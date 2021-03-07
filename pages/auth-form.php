<?php

session_start();
define('ADMIN', 'admin');

if(!empty($_POST['login'])){
	if($_POST['login'] === ADMIN){
		$_SESSION['admin'] = ADMIN;
		$_SESSION['res'] = '<span style="color:green;"><b>Вы успешно авторизовались. Зайдите в меню: "Добавление товаров"</b></span>';
	}else{
		$_SESSION['res'] = '<span style="color:#ff0000;"><b>Неверный логин!</b></span>';
	}
	header("Location: ?page=auth-form");
	die;
}
if(isset($_SESSION['res'])){
	echo $_SESSION['res'];
	unset($_SESSION['res']);
}
?>

<h1>Авторизация</h1>
<form action="" method="post">
    <input type="text" name="login">    
    <button>Авторизоваться</button>
</form>