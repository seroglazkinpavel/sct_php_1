<?php
session_start();
require_once 'module_global.php';

// Авторизация
if (isset($_POST['do_signup'])) {
    authorization();
    redirect();
} else {
    header("Location: index.php");
}

// Принятие сотрудников на работу
if (isset($_POST['add'])) {
    registration();
    redirect();
} else {
    header("Location: /?page=staff");
}

/**
 * Читатели
 **/

// Добавление читателей
if (isset($_POST['add_reader'])) {
    adding_reader();
    redirect();
} else {
    header("Location: /");
}

// Поиск читателей (профиль читателя)
if (isset($_GET['num'])) {
    $number = $_GET['num'] ?? false;
    list_book_reader();
    header("Location: /?page=reader&num={$number}");
    exit;
    //redirect();
} else {
    header("Location: /");
}

/**
 * Выдача книг
 **/

// Поиск книги
if (isset($_GET['search'])) {
    search_book_distribution();
    //redirect();
    header("Location: /?page=book_distribution&search={$_SESSION['search']['title']}");
    exit;
} else {
    header("Location: /");
}

// Поиск читателя (профиль выдача книг)
if (isset($_GET['number'])) {
    search_reader();
    //redirect();
    header("Location: /?page=book_distribution&book=book&number={$_SESSION['reader']['idReader']}");
    exit;
} else {
    header("Location: /");
}

// Выдача книг
if (isset($_POST['decoration'])) {
    book_distribution();
    redirect();
} else {
    header("Location: /");
}

/**
 * Редактирование описания книги
 **/

if (isset($_POST['change_descriptions'])) {
    change_descriptions();
    redirect();
} else {
    header("Location: /");
}

/**
 * Забрать книгу
 **/

if (isset($_GET['give_book'])) {
    global $connect;
    $give_book = trim(mysqli_real_escape_string($connect, $_GET['give_book']));
    $query = "SELECT *  
				FROM book_distribution
					JOIN reader ON book_distribution.idReader = reader.idReader
					JOIN books ON book_distribution.idBook = books.idBook
						WHERE reader.idReader = '$give_book'";
    $res = mysqli_query($connect, $query);
    $date = [];
    while ($line = mysqli_fetch_assoc($res)) {
        $date[] = $line;
    }
    $_SESSION['return_volume'] = $date;
} else {
    $_SESSION['return_book']['errors'] = 'Поля обязательны к заполнению';
}
header("Location: /?page=return_book&give_book=$give_book");
exit;