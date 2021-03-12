<?php
session_start();

define('ADMIN', 'Admin');
define('PASSWORD', '121121');
if( isset($_GET['do']) && $_GET['do'] == 'exit' ) unset($_SESSION['use']);


if(empty($_SESSION['use'])){
echo '<h1>Авторизация</h1>
			<form action="auth-handler.php" method="post">
				<input type="text" name="login">
				<input type="text" name="password">
				<button>Авторизоваться</button>
			</form>';
}else {$admin = $_SESSION['use'] = ADMIN;
echo '<span style="color:green;"><b>Добро пожаловать, <b>'."$admin".'!</b> <a href="3.php?do=exit">Logout</a></b></span>';
}	
/*if(!empty($_POST['login']) && !empty($_POST['password'])){
	if(trim($_POST['login']) === ADMIN && trim($_POST['password']) === PASSWORD){
		$admin = $_SESSION['use'] = ADMIN;
		
		$_SESSION['res'] = '<span style="color:green;"><b>Добро пожаловать, <b>'."$admin".'!</b> <a href="?page=auth-form&do=exit">Logout</a></b></span>';
		
	}else{
		
		$_SESSION['res'] = '<p style="color:#ff0000;"><b>Неверный логин или пароль!</b></p><p>Повторите еще раз.</p>';
		
	}	
}

if(isset($_SESSION['res'])){
	echo $_SESSION['res'];
	unset($_SESSION['res']);
}*/
