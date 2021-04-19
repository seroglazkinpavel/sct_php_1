<?php
/**
* Распечатка массива
**/
function print_arr($array){
	echo "<pre>" . print_r($array, true) . "</pre>";
}

/**
* соединение с бд
**/
function instance(){
	static $connect;
	if($connect === null){
		$connect = @mysqli_connect('127.0.0.1', 'root', 'root', 'library')or die('Ошибка соединения с БД');
		if(!$connect) die(mysqli_connect_error());
		mysqli_set_charset($connect, "utf8") or die('Не установлена кодировка');
	}
	return $connect;
	}
$connect = instance();

/**
 * Возвращает контент для вывода
 *
 * @return false|string
 */
function getContent()
{
    ob_start();
    include getPageName();
    return ob_get_clean();
}

/**
 * Возвращает полный путь до фыйла - контента
 *
 * @return string
 */
function getPageName()
{
    $mainPage = __DIR__ . '/pages/main.php';
    if (empty($_GET['page'])) {
         return $mainPage;
    }

    $pageName = __DIR__ . '/pages/' . trim($_GET['page']) . '.php';
    if (file_exists($pageName)) {
        return $pageName;
    }

    return $mainPage;
}


/**
* Редирект
**/
function redirect(){
	$redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : index.php;
	header("Location: $redirect");
	exit;
}

/**
* авторизация
**/
function authorization(){
	global $connect;
	$login = trim(mysqli_real_escape_string($connect, $_POST['login']));
	$password = trim($_POST['password']);
	if( empty($login) OR empty($password) ){
		$_SESSION['auth']['errors'] = 'Поля логин/пароль обязательны к заполнению';
	}else{
		//$password = md5($password);
		$query = "SELECT * FROM users 
					WHERE login = '$login' AND password = '$password' 
					LIMIT 1";
		$res = mysqli_query($connect, $query);
		if(mysqli_num_rows($res) == 1){
			$row = mysqli_fetch_assoc($res);
			$_SESSION['auth']['users_id'] = $row['users_id'];
			$_SESSION['auth']['user'] = $row['login'];
			$_SESSION['auth']['password'] = $row['password'];
			$_SESSION['auth']['name'] = $row['name'];
			$_SESSION['auth']['role'] = $row['role'];
			$_SESSION['auth']['avatar'] = $row['avatar'];
		}else{
			$_SESSION['auth']['errors'] = 'Логин/пароль введены неверно';
		}
	}
}

/**
* регистрация сотрудника
**/
function registration(){
	global $connect;
	$Name = trim(mysqli_real_escape_string($connect, $_POST['Name']));
	$FirstName = trim(mysqli_real_escape_string($connect, $_POST['FirstName']));
	$LastName = trim(mysqli_real_escape_string($connect, $_POST['LastName']));
	$post = trim(mysqli_real_escape_string($connect, $_POST['post']));
	$login = trim(mysqli_real_escape_string($connect, $_POST['login']));
	$password = trim(mysqli_real_escape_string($connect, $_POST['password']));
	if(empty($Name) OR empty($FirstName) OR empty($LastName) OR empty($post) OR empty($login) OR empty($password)){
		$_SESSION['regist']['errors'] = 'Поля обязательны к заполнению';
	}else{
		//$password = md5($password);
		$query = "SELECT * FROM users WHERE login = '$login'";
		$res = mysqli_query($connect, $query);
		if(mysqli_num_rows($res) == 0){			
			$query_2 = "INSERT INTO users (login, password, name, role) VALUES ('$login', '$password', '$FirstName', 2)";			
			$result= mysqli_query($connect, $query_2);
			
			$query_1 = "INSERT INTO staff (Name, FirstName, LastName, post, data) VALUES ('$Name', '$FirstName', '$LastName', '$post', CURRENT_DATE())";
			mysqli_query($connect, $query_1);			
			$_SESSION['regist']['employee'] = 'Сотрудник принят';			
		}else{
			$_SESSION['regist']['errors'] = 'Логин уже существует';
		}
	}
} 

/**
* Добавление читателя
**/
function adding_reader(){
	global $connect;
	$Name = trim(mysqli_real_escape_string($connect, $_POST['Name']));
	$FirstName = trim(mysqli_real_escape_string($connect, $_POST['FirstName']));
	$LastName = trim(mysqli_real_escape_string($connect, $_POST['LastName']));
	$series = trim(mysqli_real_escape_string($connect, $_POST['series']));
	$room = trim(mysqli_real_escape_string($connect, $_POST['room']));
	$login = trim(mysqli_real_escape_string($connect, $_POST['login']));
	$password = trim(mysqli_real_escape_string($connect, $_POST['password']));
	if(empty($Name) OR empty($FirstName) OR empty($LastName) OR empty($series) OR empty($room) OR empty($login) OR empty($password)){
		$_SESSION['reader']['errors'] = 'Поля обязательны к заполнению';
	}else{
		//$password = md5($password);
		$query = "SELECT * FROM users WHERE login = '$login'";
		$res = mysqli_query($connect, $query);
		if(mysqli_num_rows($res) == 0){
			$query = "INSERT INTO users (users_id, login, name, password, role) VALUES (NULL, '$login', '$FirstName', '$password', 3)";
			mysqli_query($connect, $query);
			
			$query_1 = "INSERT INTO reader (Name, FirstName, LastName, series, room, data) VALUES ('$Name', '$FirstName', '$LastName', '$series', '$room', CURRENT_DATE())";
			mysqli_query($connect, $query_1);
			
			$_SESSION['reader']['client'] = 'Читатель принят';
		}else{
			$_SESSION['reader']['errors'] = 'Логин уже существует';
		}
	}
}

/**
* Поиск книги
**/
function search_book_distribution(){
	global $connect;
	$inputSearch = trim(mysqli_real_escape_string($connect, $_POST['search']));
	$query = "SELECT * FROM books WHERE title = '$inputSearch' || autor = '$inputSearch'";
	$res = mysqli_query($connect, $query);
    if(mysqli_num_rows($res) > 0) {
       	$row = mysqli_fetch_assoc($res);
		$_SESSION['search']['idBook'] = $row['idBook'];
		$_SESSION['search']['title'] = $row['title'];			
		$_SESSION['search']['autor'] = $row['autor'];
		$_SESSION['search']['genre'] = $row['genre'];
		$_SESSION['search']['discription'] = $row['discription'];
	}else{
		$_SESSION['search']['errors'] = 'Ничего не найдено';
	}
}

/**
* Выдача книг
**/

// Поиск читателя
function search_reader(){
	global $connect;
	$number = trim(mysqli_real_escape_string($connect, $_POST['number']));
	if(empty($number)){
		$_SESSION['reader']['errors'] = 'Поля обязательны к заполнению';
	}else{
		$sql = "SELECT * FROM reader WHERE idReader = '$number'";
		$result = mysqli_query($connect, $sql);
		if(mysqli_num_rows($result) > 0) {
			$line = mysqli_fetch_assoc($result);
			$_SESSION['reader']['idReader'] = $line['idReader'];
			$_SESSION['reader']['Name'] = $line['Name'];
			$_SESSION['reader']['FirstName'] = $line['FirstName'];
			$_SESSION['reader']['LastName'] = $line['LastName'];
		}else{
			$_SESSION['reader']['errors'] = 'Такого читателя нет';
		}	
		$query = "SELECT book_distribution.idReader, book_distribution.idBook, book_distribution.Sum, books.autor, books.title  
					FROM book_distribution						
						JOIN books ON book_distribution.idBook = books.idBook
							WHERE idReader = '$number'";			
		$res = mysqli_query($connect, $query);
		if(mysqli_num_rows($res) > 0) {
			$row = mysqli_fetch_assoc($res);
			$_SESSION['book_distribution']['Sum'] = $row['Sum'];
			$_SESSION['book_distribution']['idBook'] = $row['idBook'];
			$_SESSION['book_distribution']['autor'] = $row['autor'];
			$_SESSION['book_distribution']['title'] = $row['title'];
			
		}else{
			$_SESSION['book_distribution']['errors'] = 'Книг на руках нет';
		}
	}
}
// Выдача книг
function book_distribution(){
	global $connect;
	$date = trim(mysqli_real_escape_string($connect, $_POST['date']));
	$count = trim(mysqli_real_escape_string($connect, $_POST['count']));
	if(empty($date) OR empty($count)){
		$_SESSION['connection']['errors'] = 'Поля обязательны к заполнению';
	}else{
		$users_id = $_SESSION['auth']['users_id']?? false;
		$query = "SELECT * FROM connection WHERE users_id = '$users_id'";
		$res = mysqli_query($connect, $query);
		$row = mysqli_fetch_assoc($res);
		$_SESSION['connection']['idWorked'] = $row['idWorked'];
		$idWorked = $_SESSION['connection']['idWorked']?? false;
		$idReader = $_SESSION['reader']['idReader']?? false;
		$idBook = $_SESSION['search']['idBook']?? false;
		$sql = "INSERT INTO book_distribution (`id`, `idWorked`, `idReader`, `idBook`, `Sum`, `Time`, `Data`) VALUES (NULL, '$idWorked', '$idReader', '$idBook', '$count', '$date', CURRENT_DATE())";
		mysqli_query($connect, $sql);		
		$_SESSION['connection']['client'] = 'Операция прошла успешно';		
	}
}

/**
* Забрать книгу
**/

function return_book(){
	global $connect;
	$give_book = trim(mysqli_real_escape_string($connect, $_POST['give_book']));
	if(empty($give_book)){
		$_SESSION['return_book']['errors'] = 'Поля обязательны к заполнению';
	}else{
		$query = "SELECT *  
					FROM book_distribution
						JOIN reader ON book_distribution.idReader = reader.idReader
						JOIN books ON book_distribution.idBook = books.idBook
							WHERE reader.idReader = '$give_book'";
		$res = mysqli_query($connect, $query);
		$row = mysqli_fetch_assoc($res);
		$_SESSION['return_book']['idReader'] = $row['idReader'];
		$_SESSION['return_book']['Sum'] = $row['Sum'];
		$_SESSION['return_book']['Data'] = $row['Data'];
		$_SESSION['return_book']['Time'] = $row['Time'];
		$_SESSION['return_book']['autor'] = $row['autor'];
		$_SESSION['return_book']['title'] = $row['title'];
		$_SESSION['return_book']['Name'] = $row['Name'];
		$_SESSION['return_book']['FirstName'] = $row['FirstName'];
		$_SESSION['return_book']['LastName'] = $row['LastName'];
		$_SESSION['return_book']['impact'] = 'Операция прошла успешно';
		if(empty($_SESSION['return_book']['idReader'])){
			$_SESSION['return_book']['errors'] = 'У такого читателя книг нет.';
		}
	}
}

/*
* Список книг
*/

function list_book(){
	global $connect;
	$users_id = $_SESSION['auth']['users_id']?? false;
	$sql = "SELECT * 
	            FROM book_distribution
					JOIN connection ON book_distribution.idReader = connection.idReader
					JOIN books ON book_distribution.idBook = books.idBook
						WHERE connection.users_id = '$users_id'";							
	$result = mysqli_query($connect, $sql)or die(mysqli_error($connect));
	if(mysqli_num_rows($result) > 0) {
		$line = mysqli_fetch_assoc($result);
		$_SESSION['list_book']['Sum'] = $line['Sum'];
		$_SESSION['list_book']['Data'] = $line['Data'];
		$_SESSION['list_book']['Time'] = $line['Time'];
		$_SESSION['list_book']['idBook'] = $line['idBook'];
		$_SESSION['list_book']['autor'] = $line['autor'];
		$_SESSION['list_book']['title'] = $line['title'];
	}else{
		$_SESSION['list_book']['errors'] = 'Книг на руках нет';
	}
}