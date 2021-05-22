<?php
session_start();
require_once 'module_global.php';
list_book();
if( isset($_GET['do']) && $_GET['do'] == 'exit' ) {
	unset($_SESSION['auth']);
	unset($_SESSION['list_book']);
	header("Location: /");
}
switch ($_SESSION['auth']['role']) {
    case 1:?>
        <div class="content">
            <div class="panel">
                <div class="main_panel"><h2>Профиль администратора</h2></div>
                <p class="panel_user"><a href="/?do=exit"> Выход</a></p>
                <nav>
                    <ul>
                        <li>
                            <a href="?page=main">Главная</a>
                        </li>
                        <li>
                            <a href="?page=book_distribution">Выдача книг</a>
                        </li>
                        <li>
                            <a href="?page=return_book">Возврат книг</a>
                        </li>
                        <li>
                            <a href="?page=add_book">Книги в библиотеке</a>
                        </li>
                        <li>
                            <a href="?page=reader">Читатели</a>
                        </li>
                        <li>
                            <a href="?page=staff">Сотрудники</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="entrance_system">
                <p class="panel_user">
                    Добро пожаловать, <span><b><?= htmlspecialchars($_SESSION['auth']['user']) ?>!</b></span>
                </p>
            </div>
        </div>
        <?php break;
    case 2:?>
        <div class="content">
            <div class="panel">
                <div class="main_panel">
                    <h2>Профиль сотрудника</h2>
                </div>
                <div class="center">
                    <img src="<? if (empty($_SESSION['auth']['avatar'])) echo 'images/avatar.jpg'; else echo $_SESSION['auth']['avatar']; ?>" alt="Аватар">
                </div>
                <p class="panel_user"><a href="/?do=exit"> Выход</a></p>
                <nav>
                    <ul>
                        <li>
                            <a href="?page=main">Главная</a>
                        </li>
                        <li>
                            <a href="?page=book_distribution">Выдача книг</a>
                        </li>
                        <li>
                            <a href="?page=return_book">Возврат книг</a>
                        </li>
                        <li>
                            <a href="?page=add_book">Книги в библиотеке</a>
                        </li>
                        <li>
                            <a href="?page=reader">Читатели</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="entrance_system">
                <p class="panel_user">
                    Добро пожаловать, <span><b><?= htmlspecialchars($_SESSION['auth']['user']) ?>!</b>
                </p>
                <div id="profile">
                    <h1>Изменить аватар</h1>
                    <div class="avatar">
                        <img src="<? if (empty($_SESSION['auth']['avatar'])) echo 'images/avatar.jpg'; else echo $_SESSION['auth']['avatar']; ?>"
                             alt="Аватар">
                    </div>
                    <div class="avatar_info">
                        <p>Допустимые форматы - <b>GIF</b>, <b>JPG</b>, <b>PNG</b></p>
                        <p>Размер изображения должен быть <b>не более 50 КБ</b>!</p>
                        <p>Изображение должно быть квадратным (иначе могут не соблюдаться пропорции)!</p>
                    </div>
                    <div class="container_form">
                        <div class="form">
                            <div id="change_avatar">
                                <form name="change_avatar" action="avatar.php" method="post"
                                      enctype="multipart/form-data">
                                    <p>
                                        <input type="file" name="avatar">
                                    </p>
                                    <div class="submit">
                                        <input type="submit" name="change_avatar" value="Сохранить">
                                    </div>
                                    <?php if (isset($_SESSION['message'])): ?>
                                        <div style="color:red;">
                                            <?= $_SESSION['message'] ?>
                                        </div>
                                        <?php unset($_SESSION['message']); ?>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                    <h1>Изменить имя</h1>
                    <div class="container_form">
                        <div class="form">
                            <div id="change_name">
                                <form name="change_name" action="avatar.php" method="post">
                                    <div>
                                        <label for="name">Ваше имя</label>
                                        <input id="name" type="text" name="name" value="">
                                    </div>
                                    <div>
                                        <label for="password_current_name">Текущий пароль:</label>
                                        <input id="password_current_name" type="password" name="password_current_name">
                                    </div>
                                    <div class="submit">
                                        <input type="submit" name="change_name" value="Сохранить">
                                    </div>
                                    <?php if (isset($_SESSION['auth']['errors'])): ?>
                                        <div style="color:red;">
                                            <?= $_SESSION['auth']['errors'] ?>
                                        </div>
                                        <?php unset($_SESSION['auth']['errors']); ?>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                    <h1>Изменить пароль</h1>
                    <div class="container_form">
                        <div class="form">
                            <div id="change_password">
                                <form name="change_password" action="avatar.php" method="post">
                                    <div>
                                        <label for="password">Новый пароль:</label>
                                        <input id="password" type="password" name="password">
                                    </div>
                                    <div>
                                        <label for="password_conf">Повторите пароль:</label>
                                        <input id="password_conf" type="password" name="password_conf">
                                    </div>
                                    <div>
                                        <label for="password_current">Текущий пароль:</label>
                                        <input id="password_current" type="password" name="password_current">
                                    </div>
                                    <div class="submit">
                                        <input type="submit" name="change_password" value="Сохранить">
                                    </div>
                                    <?php if (isset($_SESSION['mes']['errors'])): ?>
                                        <div style="color:red;">
                                            <?= $_SESSION['mes']['errors'] ?>
                                        </div>
                                        <?php unset($_SESSION['mes']['errors']); ?>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php break;
    case 3:?>
        <div class="content">
            <div class="panel">
                <div class="main_panel"><h2>Профиль Читателя</h2></div>
                <p class="panel_user"><a href="/?do=exit"> Выход</a></p>
            </div>
            <div class="entrance_system">
                <p class="panel_user">Добро пожаловать, <span><b><?= htmlspecialchars($_SESSION['auth']['user']) ?>!</b>
                </p>
                <div class="list_book">
                    <fieldset>
                        <legend>Список книг на руках</legend>
                        <?php if (!empty($_SESSION['list_book'])): ?>
                            <table class="table_list">
                                <tr>
                                    <th>Автор</th>
                                    <th>Название</th>
                                    <th>Срок</th>
                                    <th>Дата выдачи</th>
                                    <th>Кол-во</th>
                                </tr>
                                <tr>
                                    <td><?= $_SESSION['list_book']['autor'] ?></td>
                                    <td><?= $_SESSION['list_book']['title'] ?></td>
                                    <td><?= $_SESSION['list_book']['Time'] ?>
                                    <td><?= $_SESSION['list_book']['Data'] ?>
                                    <td><?= $_SESSION['list_book']['count'] ?></td>
                                </tr>
                            </table>
                            <?php unset($_SESSION['list_book']); ?>
                        <?php else : ?>
                            <div style="color:red;"><b>Книг на руках нет.</b></div>
                        <?php endif; ?>
                    </fieldset>
                </div>
            </div>
        </div>
        <?php break;
    default:?>
        <div class="system">
            <h1>Вход в систему учёта книг в библиотеке</h1>
            <div class="container">
                <p class="user"><img src="images/authorization.jpg"> Авторизация пользователя</p>
                <div class="form">
                    <form action="handler.php" method="post" id="authoriz">
                        <p>
                            <label for="login">Логин:</label>
                            <input type="text" id="login" name="login" placeholder="Введите свой логин">
                        </p>
                        <p>
                            <label for="password">Пароль:</label>
                            <input type="password" id="password" name="password" placeholder="Введите свой пароль">
                        </p>
                        <button type="submit" name="do_signup">Вход</button>
                        <span class="logout"><a href="/?do=exit">Выход</a></span>
                        <?php if (isset($_SESSION['auth']['errors'])): ?>
                            <div style="color:red;">
                                <?= $_SESSION['auth']['errors'] ?>
                            </div>
                            <?php unset($_SESSION['auth']); ?>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
<?php }	?>