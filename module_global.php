<?php
/**
 * Распечатка массива
 **/
function print_arr($array)
{
    echo "<pre>" . print_r($array, true) . "</pre>";
}

/**
 * соединение с бд
 **/
function instance()
{
    static $connect;
    if ($connect === null) {
        $connect = @mysqli_connect('127.0.0.1', 'root', 'root', 'library') or die('Ошибка соединения с БД');
        if (!$connect) die(mysqli_connect_error());
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
function redirect()
{
    $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : index . php;
    header("Location: $redirect");
    exit;
}

/**
 * авторизация
 **/
function authorization()
{
    global $connect;
    $login = trim(mysqli_real_escape_string($connect, $_POST['login']));
    $password = trim($_POST['password']);
    if (empty($login) or empty($password)) {
        $_SESSION['auth']['errors'] = 'Поля логин/пароль обязательны к заполнению';
    } else {
        $query = "SELECT * FROM users					
					WHERE users.login = '$login' AND users.password = '$password' 
					LIMIT 1";
        $res = mysqli_query($connect, $query);
        if (mysqli_num_rows($res) == 1) {
            $row = mysqli_fetch_assoc($res);
            $_SESSION['auth']['users_id'] = $row['users_id'];
            $_SESSION['auth']['user'] = $row['login'];
            $_SESSION['auth']['password'] = $row['password'];

            $_SESSION['auth']['role'] = $row['role'];
            $_SESSION['auth']['avatar'] = $row['avatar'];
        } else {
            $_SESSION['auth']['errors'] = 'Логин/пароль введены неверно';
        }
    }
}

/**
 * регистрация сотрудника
 **/
function registration()
{
    global $connect;
    $Name = trim(mysqli_real_escape_string($connect, $_POST['Name']));
    $FirstName = trim(mysqli_real_escape_string($connect, $_POST['FirstName']));
    $LastName = trim(mysqli_real_escape_string($connect, $_POST['LastName']));
    $post = trim(mysqli_real_escape_string($connect, $_POST['post']));
    $login = trim(mysqli_real_escape_string($connect, $_POST['login']));
    $password = trim(mysqli_real_escape_string($connect, $_POST['password']));
    if (empty($Name) or empty($FirstName) or empty($LastName) or empty($post) or empty($login) or empty($password)) {
        $_SESSION['regist']['errors'] = 'Поля обязательны к заполнению';
    } else {
        $query = "SELECT * FROM users WHERE login = '$login'";
        $res = mysqli_query($connect, $query);
        if (mysqli_num_rows($res) == 0) {
            $query_2 = "INSERT INTO users (login, password, role) VALUES ('$login', '$password', 2)";
            mysqli_query($connect, $query_2);
            $query_3 = "SELECT users_id FROM users ORDER BY users_id DESC LIMIT 1";
            $result = mysqli_query($connect, $query_3);
            $row = mysqli_fetch_assoc($result);
            $_SESSION['regist']['users_id'] = $row['users_id'];
            $users_id = $_SESSION['regist']['users_id'] ?? false;
            $query_1 = "INSERT INTO staff (Name, FirstName, LastName, post, data, users_id) VALUES ('$Name', '$FirstName', '$LastName', '$post', CURRENT_DATE(), '$users_id')";
            mysqli_query($connect, $query_1);
            $_SESSION['regist']['employee'] = 'Сотрудник принят';
        } else {
            $_SESSION['regist']['errors'] = 'Логин уже существует';
        }
    }
}

/**
 * Добавление читателя
 **/
function adding_reader()
{
    global $connect;
    $Name = trim(mysqli_real_escape_string($connect, $_POST['Name']));
    $FirstName = trim(mysqli_real_escape_string($connect, $_POST['FirstName']));
    $LastName = trim(mysqli_real_escape_string($connect, $_POST['LastName']));
    $series = trim(mysqli_real_escape_string($connect, $_POST['series']));
    $room = trim(mysqli_real_escape_string($connect, $_POST['room']));
    $login = trim(mysqli_real_escape_string($connect, $_POST['login']));
    $password = trim(mysqli_real_escape_string($connect, $_POST['password']));
    if (empty($Name) or empty($FirstName) or empty($LastName) or empty($series) or empty($room) or empty($login) or empty($password)) {
        $_SESSION['reader']['errors'] = 'Поля обязательны к заполнению';
    } else {

        $query = "SELECT * FROM users WHERE login = '$login'";
        $res = mysqli_query($connect, $query);
        if (mysqli_num_rows($res) == 0) {
            $query_2 = "INSERT INTO users (users_id, login, password, role) VALUES (NULL, '$login', '$password', 3)";
            mysqli_query($connect, $query_2);
            $query_3 = "SELECT users_id FROM users ORDER BY users_id DESC LIMIT 1";
            $result = mysqli_query($connect, $query_3);
            $row = mysqli_fetch_assoc($result);
            $_SESSION['reader']['users_id'] = $row['users_id'];
            $users_id = $_SESSION['reader']['users_id'] ?? false;
            $query_1 = "INSERT INTO reader (Name, FirstName, LastName, series, room, data, users_id) VALUES ('$Name', '$FirstName', '$LastName', '$series', '$room', CURRENT_DATE(), '$users_id')";
            mysqli_query($connect, $query_1);

            $_SESSION['reader']['client'] = 'Читатель принят';
        } else {
            $_SESSION['reader']['errors'] = 'Логин уже существует';
        }
    }
}

// Поиск читателя
function list_book_reader()
{
    global $connect;
    $number = trim(mysqli_real_escape_string($connect, $_GET['num']));
    $sql = "SELECT * 
	            FROM book_distribution
					JOIN reader ON book_distribution.idReader = reader.idReader
					JOIN books ON book_distribution.idBook = books.idBook
						WHERE reader.idReader = '$number'";
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    if (mysqli_num_rows($result) > 0) {
        $line = mysqli_fetch_assoc($result);
        $_SESSION['list_book_reader']['count'] = $line['count'];
        $_SESSION['list_book_reader']['Data'] = $line['Data'];
        $_SESSION['list_book_reader']['Time'] = $line['Time'];
        $_SESSION['list_book_reader']['idBook'] = $line['idBook'];
        $_SESSION['list_book_reader']['autor'] = $line['autor'];
        $_SESSION['list_book_reader']['title'] = $line['title'];
        $_SESSION['list_book_reader']['Name'] = $line['Name'];
        $_SESSION['list_book_reader']['FirstName'] = $line['FirstName'];
        $_SESSION['list_book_reader']['LastName'] = $line['LastName'];
    } else {
        $query = "SELECT Name, FirstName, LastName FROM reader WHERE reader.idReader = '$number'";
        $result = mysqli_query($connect, $query);
        $line = mysqli_fetch_assoc($result);
        $_SESSION['list_book']['Name'] = $line['Name'];
        $_SESSION['list_book']['FirstName'] = $line['FirstName'];
        $_SESSION['list_book']['LastName'] = $line['LastName'];
        $_SESSION['list_book']['errors'] = 'Книг на руках нет';
    }
}

/**
 * Поиск книги
 **/
function search_book_distribution()
{
    global $connect;
    $inputSearch = trim(mysqli_real_escape_string($connect, $_GET['search']));
    $query = "SELECT * FROM books WHERE title = '$inputSearch' || autor = '$inputSearch'";
    $res = mysqli_query($connect, $query);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $_SESSION['search']['idBook'] = $row['idBook'];
        $_SESSION['search']['title'] = $row['title'];
        $_SESSION['search']['autor'] = $row['autor'];

        $_SESSION['search']['file'] = $row['file'];
        $file = $_SESSION['search']['file'] ?? false;

    } else {
        $_SESSION['search']['errors'] = 'Ничего не найдено';
    }
}

/**
 * Выдача книг
 **/

// Поиск читателя
function search_reader()
{
    global $connect;
    $number = trim(mysqli_real_escape_string($connect, $_GET['number']));
    if (empty($number)) {
        $_SESSION['reader']['errors'] = 'Поля обязательны к заполнению';
    } else {
        $sql = "SELECT * FROM reader WHERE idReader = '$number'";
        $result = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result) > 0) {
            $line = mysqli_fetch_assoc($result);
            $_SESSION['reader']['idReader'] = $line['idReader'];
            $_SESSION['reader']['Name'] = $line['Name'];
            $_SESSION['reader']['FirstName'] = $line['FirstName'];
            $_SESSION['reader']['LastName'] = $line['LastName'];
        } else {
            $_SESSION['reader']['errors'] = 'Такого читателя нет';
        }
        $query = "SELECT book_distribution.idReader, book_distribution.idBook, book_distribution.count, books.autor, books.title  
					FROM book_distribution						
						JOIN books ON book_distribution.idBook = books.idBook
							WHERE idReader = '$number'";
        $res = mysqli_query($connect, $query);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            $_SESSION['book_distribution']['count'] = $row['count'];
            $_SESSION['book_distribution']['idBook'] = $row['idBook'];
            $_SESSION['book_distribution']['autor'] = $row['autor'];
            $_SESSION['book_distribution']['title'] = $row['title'];

        } else {
            $_SESSION['book_distribution']['errors'] = 'Книг на руках нет';
        }
    }
}

// Выдача книг
function book_distribution()
{
    global $connect;
    $date = trim(mysqli_real_escape_string($connect, $_POST['date']));
    $count = trim(mysqli_real_escape_string($connect, $_POST['count']));
    if (empty($date) or empty($count)) {
        $_SESSION['connection']['errors'] = 'Поля обязательны к заполнению';
    } else {
        $users_id = $_SESSION['auth']['users_id'] ?? false;
        $query = "SELECT * FROM staff WHERE users_id = '$users_id'";
        $res = mysqli_query($connect, $query);
        $row = mysqli_fetch_assoc($res);
        $_SESSION['connection']['idWorked'] = $row['idWorked'];
        $idWorked = $_SESSION['connection']['idWorked'] ?? false;
        $idReader = $_SESSION['reader']['idReader'] ?? false;
        $idBook = $_SESSION['search']['idBook'] ?? false;
        $sql = "INSERT INTO book_distribution (`id`, `idWorked`, `idReader`, `idBook`, `count`, `Time`, `Data`) VALUES (NULL, '$idWorked', '$idReader', '$idBook', '$count', '$date', CURRENT_DATE())";
        mysqli_query($connect, $sql);
        if (!empty($idReader)) $_SESSION['connection']['client'] = 'Операция прошла успешно';
        else $_SESSION['connection']['client'] = 'Выберите читателя';
    }
}

/**
 * Добавление книги
 **/
function add_book()
{
    global $connect;
    if (isset($_POST['add_file'])) {
        $autor = trim(mysqli_real_escape_string($connect, $_POST['autor']));
        $title = trim(mysqli_real_escape_string($connect, $_POST['title']));
        $series = trim(mysqli_real_escape_string($connect, $_POST['series']));
        $text = trim(mysqli_real_escape_string($connect, $_POST['text']));
        if (empty($autor) or empty($title) or empty($series) or empty($text)) {
            $_SESSION['add_book']['errors'] = 'Поля обязательны к заполнению';
        } else {
            $path = 'uploads/' . $_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], $path);
            if ($_FILES["filename"]["size"] > 1024 * 5 * 1024) {
                $_SESSION['add_book']['errors'] = 'Размер файла превышает пять мегабайта';
                exit;
            } else {
                $query = "INSERT INTO books (idBook, title, data, autor, description, file) VALUES (NULL, '$title', CURRENT_DATE(), '$autor', '$text', '$path')";
                mysqli_query($connect, $query);
            }
        }
    }
}

/**
 * Список читателей
 **/
function information()
{
    global $connect;
    $query = "SELECT * FROM reader";
    $res = mysqli_query($connect, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $data[$row['idReader']] = $row;
    }
    echo '<table>
	<tr><th>ФИО</th><th>Читательскмй билет №</th><th>Удалить</th><th>Редактировать</th></tr>';
    foreach ($data as $item) {
        echo
        "<tr><td>{$item['Name']} {$item['FirstName']} {$item['LastName']}</td><td>{$item['idReader']}</td><td><a href='/?page=reader&idReader={$item['idReader']}'>Удалить</a></td><td><a href='/?page=profile&users_id={$item['users_id']}'>Редактировать</a></td></tr>";
    }
    echo '</table>';
    if (isset($_GET['idReader'])) {
        $idReader = $_GET['idReader'];
        $query_2 = "SELECT users_id FROM reader WHERE idReader = {$idReader}";
        $result = mysqli_query($connect, $query_2);

        $line = mysqli_fetch_assoc($result);
        $_SESSION['list_readers']['users_id'] = $line['users_id'];
        $users_id = $_SESSION['list_readers']['users_id'] ?? false;

        $query_1 = "DELETE FROM `reader` WHERE `reader`.`idReader` = {$idReader}";
        mysqli_query($connect, $query_1);

        $query_3 = "DELETE FROM `users` WHERE `users`.`users_id` = {$users_id}";
        mysqli_query($connect, $query_3);
        unset($_SESSION['list_readers']);
    } else $idReader = false;
}


/**
 * Книги на руках читателя
 **/
function list_book()
{
    global $connect;
    $users_id = $_SESSION['auth']['users_id'] ?? false;
    $sql = "SELECT * 
	            FROM book_distribution
					JOIN reader ON book_distribution.idReader = reader.idReader
					JOIN books ON book_distribution.idBook = books.idBook
						WHERE reader.users_id = '$users_id'";
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    if (mysqli_num_rows($result) > 0) {
        $line = mysqli_fetch_assoc($result);
        $_SESSION['list_book']['count'] = $line['count'];
        $_SESSION['list_book']['Data'] = $line['Data'];
        $_SESSION['list_book']['Time'] = $line['Time'];
        $_SESSION['list_book']['idBook'] = $line['idBook'];
        $_SESSION['list_book']['autor'] = $line['autor'];
        $_SESSION['list_book']['title'] = $line['title'];
    }
}

/**
 * Список сотрудников
 **/
function list_employees()
{
    global $connect;
    $query = "SELECT * FROM staff";
    $res = mysqli_query($connect, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($res)) {
        $data[$row['idWorked']] = $row;
    }
    echo '<table>
	<tr><th>ФИО</th><th>Номер сотрудника</th><th>Удалить</th><th>Редактировать</th></tr>';
    foreach ($data as $item) {
        echo
        "<tr><td>{$item['Name']} {$item['FirstName']} {$item['LastName']}</td><td>{$item['idWorked']}</td><td><a href='/?page=staff&idWorked={$item['idWorked']}'>Удалить</a></td><td><a href='/?page=profile&users_id={$item['users_id']}'>Редактировать</a></td></tr>";
    }
    echo '</table>';
    if (isset($_GET['idWorked'])) {
        $idWorked = $_GET['idWorked'];
        $query_2 = "SELECT users_id FROM staff WHERE idWorked = {$idWorked}";
        $result = mysqli_query($connect, $query_2);
        $line = mysqli_fetch_assoc($result);
        $_SESSION['list_staff']['users_id'] = $line['users_id'];
        $users_id = $_SESSION['list_staff']['users_id'] ?? false;

        $query_1 = "DELETE FROM `staff` WHERE `staff`.`idWorked` = {$idWorked}";
        mysqli_query($connect, $query_1);

        $query_3 = "DELETE FROM `users` WHERE `users`.`users_id` = {$users_id}";
        mysqli_query($connect, $query_3);
        unset($_SESSION['list_staff']);
    } else $idWorked = false;
}

/**
 * Редактирование сотруднтков и читателей
 **/
function editing_employee()
{
    global $connect;
    if (isset($_GET['users_id'])) {
        $users_id = $_GET['users_id'];

        $sql = "SELECT * 
						FROM users
							JOIN reader ON users.users_id = reader.users_id
								WHERE users.users_id = {$users_id}";
        $result_1 = mysqli_query($connect, $sql);

        $line_1 = mysqli_fetch_assoc($result_1);
        $_SESSION['list_staff']['users_id'] = $line_1['users_id'];
        $_SESSION['list_staff']['login'] = $line_1['login'];
        $_SESSION['list_staff']['password'] = $line_1['password'];
        $_SESSION['list_staff']['Name'] = $line_1['Name'];
        $_SESSION['list_staff']['FirstName'] = $line_1['FirstName'];
        $_SESSION['list_staff']['LastName'] = $line_1['LastName'];
        $_SESSION['list_staff']['series'] = $line_1['series'];
        $_SESSION['list_staff']['room'] = $line_1['room'];

        $users_id = $_SESSION['list_staff']['users_id'] ?? false;
        $login = $_SESSION['list_staff']['login'] ?? false;
        $password = $_SESSION['list_staff']['password'] ?? false;
        $Name = $_SESSION['list_staff']['Name'] ?? false;
        $FirstName = $_SESSION['list_staff']['FirstName'] ?? false;
        $LastName = $_SESSION['list_staff']['LastName'] ?? false;
        $series = $_SESSION['list_staff']['series'] ?? false;
        $room = $_SESSION['list_staff']['room'] ?? false;
        if (isset($_POST['change_username'])) {
            $login_1 = trim(mysqli_real_escape_string($connect, $_POST['login']));
            if (empty($login_1)) {
                $_SESSION['list_staff']['errors'] = 'Поле обязательно к заполнению';
            } else {
                $query = "UPDATE `users` SET `login` = '$login_1' WHERE `users`.`login` = '{$login}' AND`users`.`password` = '{$password}'";
                mysqli_query($connect, $query) or die (mysqli_error($connect));
                $_SESSION['list_staff']['username_changed'] = 'Логин изменен';
            }
        } elseif (isset($_POST['change_password'])) {
            $password_1 = trim($_POST['password']);
            $password_conf = trim($_POST['password_conf']);
            if (empty($password_1) or empty($password_conf)) {
                $_SESSION['mes']['errors'] = 'Поля обязательны к заполнению';
            } elseif ($password_1 !== $password_conf) {
                $_SESSION['mes']['errors'] = 'Не верный пароль';
            } else {
                $query = "UPDATE `users` SET `password` = '$password_conf' WHERE `users`.`login` = '{$login}'";
                mysqli_query($connect, $query) or die (mysqli_error($connect));
                $_SESSION['mes']['change_password'] = 'Пароль изменен';
            }
        } elseif (isset($_POST['change_name'])) {
            $name = trim($_POST['name']);
            if (empty($name)) {
                $_SESSION['name']['errors'] = 'Поля обязательны к заполнению';
            } else {
                $query = "UPDATE `reader` SET `Name` = '$name' WHERE `reader`.`users_id` = '{$users_id}'";
                mysqli_query($connect, $query) or die (mysqli_error($connect));
                $_SESSION['name']['change_name'] = 'Фамилия изменена';
            }
        } elseif (isset($_POST['change_firstname'])) {
            $firstname = trim($_POST['firstname']);
            if (empty($firstname)) {
                $_SESSION['firstname']['errors'] = 'Поля обязательны к заполнению';
            } else {
                $query = "UPDATE `reader` SET `FirstName` = '$firstname' WHERE `reader`.`users_id` = '{$users_id}'";
                mysqli_query($connect, $query) or die (mysqli_error($connect));
                $_SESSION['firstname']['change_firstname'] = 'Имя изменено';
            }
        } elseif (isset($_POST['change_lastname'])) {
            $lastname = trim($_POST['lastname']);
            if (empty($lastname)) {
                $_SESSION['lastname']['errors'] = 'Поля обязательны к заполнению';
            } else {
                $query = "UPDATE `reader` SET `LastName` = '$lastname' WHERE `reader`.`users_id` = '{$users_id}'";
                mysqli_query($connect, $query) or die (mysqli_error($connect));
                $_SESSION['lastname']['change_lastname'] = 'Отчество изменено';
            }
        } elseif (isset($_POST['change_series'])) {
            $series = trim($_POST['series']);
            if (empty($series)) {
                $_SESSION['series']['errors'] = 'Поля обязательны к заполнению';
            } else {
                $query = "UPDATE `reader` SET `series` = '$series' WHERE `reader`.`users_id` = '{$users_id}'";
                mysqli_query($connect, $query) or die (mysqli_error($connect));
                $_SESSION['series']['change_series'] = 'Серия изменена';
            }
        }
    }
}

/**
 *Книги
 **/
function books_search()
{
    if (isset($_POST['books_search'])) {
        global $connect;
        $inputSearch = trim(mysqli_real_escape_string($connect, $_POST['search']));
        $query = "SELECT * FROM books WHERE title = '$inputSearch' || autor = '$inputSearch'";
        $res = mysqli_query($connect, $query);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'] ?? false;
            $autor = $row['autor'] ?? false;
            $file = $row['file'] ?? false;
        } else {
            $errors = 'Ничего не найдено';
        }
    }
}

/**
 *Редактирование книги
 **/
//Редактирование файла
function change_address()
{
    global $connect;
    if (isset($_POST['change_address'])) {
        $address = trim(mysqli_real_escape_string($connect, $_POST['address']));
        $name_book = trim(mysqli_real_escape_string($connect, $_POST['name_book']));

        if (empty($address) or empty($name_book)) {
            $_SESSION['book_address']['errors'] = 'Поля обязательны к заполнению.';
        } elseif (!$name_book) {
            $_SESSION['book_address']['errors'] = 'Нет такой книги.';
        } else {

            $path = 'uploads/' . $_FILES['files']['name'];
            move_uploaded_file($_FILES['files']['tmp_name'], $path);
            if ($_FILES["filename"]["size"] > 1024 * 5 * 1024) {
                $_SESSION['book_address']['errors'] = 'Размер файла превышает пять мегабайта';
                exit;
            }
            $query = "UPDATE `books` SET `file` = '$address' WHERE `books`.`title` = '{$name_book}'";
            mysqli_query($connect, $query) or die (mysqli_error($connect));
            $_SESSION['book_address']['change_address'] = 'Файл изменен';
        }
    }
}

//Редактирование описания
function change_descriptions()
{
    global $connect;
    $descriptions = trim(mysqli_real_escape_string($connect, $_POST['descriptions']));
    $name_book = trim(mysqli_real_escape_string($connect, $_POST['name_book']));
    if (empty($descriptions) or empty($name_book)) {
        $_SESSION['book_descriptions']['errors'] = 'Поля обязательны к заполнению.';
    } elseif (!$name_book) {
        $_SESSION['book_descriptions']['errors'] = 'Нет такой книги.';
    } else {
        $query = "UPDATE `books` SET `description` = '$descriptions' WHERE `books`.`title` = '{$name_book}'";
        mysqli_query($connect, $query) or die (mysqli_error($connect));
        $_SESSION['book_descriptions']['change_descriptions'] = 'Файл изменен';
    }
}
	