<?php
session_start();
require_once 'module_global.php';

// Авторизация
if(isset($_POST['do_signup']))
{
	authorization();
	redirect();
}else{
	header("Location: index.php");
}

// Принятие сотрудников на работу
if(isset($_POST['add']))
{
	registration();
	redirect();
}else{	
	header("Location: /?page=staff");
}

// Добавление читателей
if(isset($_POST['add_reader']))
{	
	adding_reader();
	//header("Location: /?page=reader");
	redirect();
}else{
	header("Location: /");	
}

// Поиск читателей
if(isset($_POST['search']))
{	
	adding_reader();
	header("Location: /?page=reader");
}else{
	header("Location: /");	
}

// Поиск книги
if(isset($_POST['book_distribution_search']))
{	
	search_book_distribution();
	//header("Location: /?page=book_distribution");
	redirect();
}else{
	header("Location: /");	
}

/**
* Выдача книг
**/

// Поиск читателя
if(isset($_POST['book_reader']))
{	
	search_reader();
	//header("Location: /?page=book_distribution&book=book");
	redirect();
}else{
	header("Location: /");	
}

// Выдача книг
if(isset($_POST['decoration']))
{	
	book_distribution();
	redirect();
}else{
	header("Location: /");	
}

/**
* Забрать книгу
**/
if(isset($_POST['return_book']))
{	
	return_book();
	redirect();
}else{
	header("Location: /");	
}