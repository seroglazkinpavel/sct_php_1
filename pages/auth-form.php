<?php

session_start();
define('ADMIN', 'admin');

if( isset($_GET['do']) && $_GET['do'] == 'exit' ) unset($_SESSION['admin']);


if(empty($_SESSION['admin'])){
echo '<h1>Авторизация</h1>
			<form action="" method="post">
				<input type="text" name="login">    
				<button>Авторизоваться</button>
			</form>';
}else {$admin = $_SESSION['admin'] = ADMIN;
 echo '<span style="color:green;"><b>Добро пожаловать, <b>'."$admin".'!</b> <a href="?page=auth-form&do=exit">Logout</a></b></span>';
}	
if(!empty($_POST['login'])){
	if($_POST['login'] === ADMIN){
		$admin = $_SESSION['admin'] = ADMIN;
		
		$_SESSION['res'] = '<span style="color:green;"><b>Добро пожаловать, <b>'."$admin".'!</b> <a href="?page=auth-form&do=exit">Logout</a></b></span>';
		
	}else{
		
		$_SESSION['res'] = '<p style="color:#ff0000;"><b>Неверный логин!</b></p><p>Повторите еще раз.</p>';
		
	}	
}

if(isset($_SESSION['res'])){
	echo $_SESSION['res'];
	unset($_SESSION['res']);
}

