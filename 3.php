<?PHP
$page = $_GET[page];
switch($page){
	case 1:
	    echo '<a href="php/sct_php_1/1.php?page=1">Я помню чудное мгновенье...</a>';
	    break;
	case 2:
	    echo '<a href="php/sct_php_1/1.php?page=2">Евгений Онегин</a>';
	    break;
	case 3:
	    echo '<a href="php/sct_php_1/1.php?page=3">Зимнее утро</a>';
	    break;
	case 4:
	    echo '<a href="php/sct_php_1/1.php?page=4">Осень</a>';
	    break;
	default:
		echo '<a href="php/sct_php_1/1.php?page=1">Я помню чудное мгновенье...</a><br>
		     <a href="php/sct_php_1/1.php?page=2">Евгений Онегин</a></a><br>
			 <a href="php/sct_php_1/1.php?page=3">Зимнее утро</a><br>
			 <a href="php/sct_php_1/1.php?page=4">Осень</a>';
}




