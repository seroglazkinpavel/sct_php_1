<?php
session_start();
require_once 'module_global.php';
// Изменение аватарки
if(isset($_POST['change_avatar']))
{	
	$path = 'uploads/'.time().$_FILES['avatar']['name'];
	if(!move_uploaded_file($_FILES['avatar']['tmp_name'], $path))
	{
		$_SESSION['message'] = 'Ошибка при загрузки сообщения';		
	}else
	{	
		$avatar = $_SESSION['auth']['users_id'];
		$query = "UPDATE `users` SET `avatar` = '$path' WHERE `users`.`users_id` = $avatar";
		$res = mysqli_query($connect, $query);
		/*if($res) 'OK';
		else $_SESSION['message'] = mysqli_error($connect);*/		
		redirect();
	}
	header("Location: /");
}

// Изменить имя
if(isset($_POST['change_name']))
{	
	$name = trim(mysqli_real_escape_string($connect, $_POST['name']));
	$password_current_name = trim($_POST['password_current_name']);
	
	if(empty($name) OR  empty($password_current_name)){
		$_SESSION['auth']['errors'] = 'Поля имя/пароль обязательны к заполнению';
	}elseif($password_current_name !== $_SESSION['auth']['password']){
		$_SESSION['auth']['errors'] = 'Не верный пароль';	
	}else{
		$login = $_SESSION['auth']['user'];
		$password = $_SESSION['auth']['password'];
		$query = "UPDATE `users` SET `name` = '$name' WHERE `users`.`login` = '$login' AND`users`.`password` = $password";
		$res = mysqli_query($connect, $query);
		redirect();
	}	
	header("Location: /");
}

// Изменить пароль
if(isset($_POST['change_password']))
{	
	$password = trim($_POST['password']);
	$password_conf = trim($_POST['password_conf']);
	$password_current = trim($_POST['password_current']);
	if(empty($password) OR  empty($password_conf) OR  empty($password_current)){
		$_SESSION['mes']['errors'] = 'Поля обязательны к заполнению';
	}elseif($password !== $password_conf && $password_current !== $_SESSION['auth']['password']){
		$_SESSION['mes']['errors'] = 'Не верный пароль';	
	}else{
		
		$login = $_SESSION['auth']['user']?? false;
		$password = $_SESSION['auth']['password']?? false;
		$query = "UPDATE `users` SET `password` = '$password_conf' WHERE `users`.`login` = '$login' AND `users`.`password` = $password_current";
		$res = mysqli_query($connect, $query)or die (mysqli_error($connect));
		redirect();
	}	
	header("Location: /");
}