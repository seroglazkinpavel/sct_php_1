<?php
session_start();
require_once 'module_global.php';
if (isset($_GET['do']) && $_GET['do'] == 'exit') unset($_SESSION['auth']['user']);
global $connect;
if (!empty($_SESSION['auth']['user']) && $_SESSION['auth']['role'] == 1):
    ?>
    <div class="content_staff">
        <div class="menu">
            <div class="item_menu">
                <a href="?page=main">Главная</a>
            </div>
            <div class="item_menu">
                <a href="?page=book_distribution">Выдача книг</a>
            </div>
            <div class="item_menu">
                <a href="?page=return_book">Возврат книг</a>
            </div>
            <div class="item_menu">
                <a href="?page=add_book">Книги в библиотеке</a>
            </div>
            <div class="item_menu">
                <a href="?page=reader">Читатели</a>
            </div>
            <div class="item_menu">
                <a href="?page=staff">Сотрудники</a>
            </div>
            <div class="item_menu">
                <a href="/?do=exit">Выход</a>
            </div>
        </div>
        <div class="employee">
            <div class="container_staff">
                <p class="user_staff">Окно для добавления, увольнентя и редактирования сотрудников</p>
                <div class="form">
                    <div class="staff">
                        <div class="addendum">
                            <p class="user_form"><b>Добавление</b></p>
                            <form action="handler.php" method="post" class="authorize">
                                <p>
                                    <label for="Name">Фамилия:</label>
                                    <input id="Name" type="text" name="Name">
                                </p>
                                <p>
                                    <label for="FirstName">Имя:</label>
                                    <input id="FirstName" type="text" name="FirstName">
                                </p>
                                <p>
                                    <label for="LastName">Отчество:</label>
                                    <input id="LastName" type="text" name="LastName">
                                </p>
                                <p>
                                    <label for="post">Должность:</label>
                                    <input id="post" type="text" name="post">
                                </p>
                                <p>
                                    <label for="login">Логин:</label>
                                    <input id="login" type="text" name="login">
                                </p>
                                <p>
                                    <label for="password">Пароль:</label>
                                    <input id="password" type="password" name="password">
                                </p>
                                <button type="submit" name="add">добавить</button>
                                <?php if (isset($_SESSION['regist']['errors'])): ?>
                                    <div style="color:red;">
                                        <?= $_SESSION['regist']['errors'] ?>
                                    </div>
                                    <?php unset($_SESSION['regist']); ?>
                                <?php endif; ?>
                                <?php if (isset($_SESSION['regist']['employee'])): ?>
                                    <b><?= htmlspecialchars($_SESSION['regist']['employee']) ?></b>
                                    <?php unset($_SESSION['regist']); ?>
                                <?php endif; ?>
                            </form>
                        </div>
                        <div class="addendum">
                            <p class="user_form"><b>Список сотрудников</b></p>
                            <?php list_employees(); ?>
                        </div>
                    </div>
                    <?php editing_employee(); ?>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <?php header("Location: /"); ?>
<?php endif; ?>
