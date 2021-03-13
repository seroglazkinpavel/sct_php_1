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
	}else {
        $admin = $_SESSION['use'] = ADMIN;
	    echo '<span style="color:green;"><b>Добро пожаловать, <b>'."$admin".'!</b> <a href="3.php?do=exit">Logout</a></b></span>';
}	