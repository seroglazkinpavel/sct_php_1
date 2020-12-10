<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Урок 4</title>
    </head>
    <body>
        <?='<h1>Привет мир!</h1>' ?>
        <?="<p>Тема урока:'Базовый синтаксис php'.</p>" ?>
        <?="<p>Необходимо выполнить задание.</p>" ?>
        <a href="<?='php/1.php';?>">Переход на 1.php файл</a><br>
        <a href="<?='php/2.php';?>">Переход на 2.php файл</a><br>
        <a href="<?='/sct_php_1';?>">Переход на index.php файл</a><br>
        <div style="margin-top:10px;"><img src="<? echo 'images/cats.gif';?>" alt="Картинка"></div>
    </body>
</html>



