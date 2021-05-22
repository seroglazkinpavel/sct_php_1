<?php
session_start();
require_once 'module_global.php';
global $connect;
if (isset($_GET['do']) && $_GET['do'] == 'exit') unset($_SESSION['auth']);
editing_employee();
if (!empty($_SESSION['auth']['user']) && $_SESSION['auth']['role'] == 1 || $_SESSION['auth']['role'] == 2):
    ?>
    <div class="reader_system">
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
                <a href="/?do=exit">Выход</a>
            </div>
        </div>
        <div class="container_reader">
            <p class="user_staff">Редактирование</p>
            <div class="form">
                <div class="staff_reader">
                    <div id="employee_profile">
                        <p class="edit_data"><b>Изменить логин</b></p>
                        <div class="container_form">
                            <div class="form">
                                <div id="change_name">
                                    <form name="change_name" action="" method="post">
                                        <div>
                                            <label for="name">Ваш логин</label>
                                            <input id="name" type="text" name="login" value="">
                                        </div>
                                        <div class="submit">
                                            <input type="submit" name="change_username" value="Сохранить">
                                        </div>
                                        <?php if (isset($_SESSION['list_staff']['errors'])): ?>
                                            <div style="color:red;">
                                                <?= $_SESSION['list_staff']['errors'] ?>
                                            </div>
                                            <?php unset($_SESSION['list_staff']['errors']); ?>
                                        <?php endif; ?>
                                        <?php if (isset($_SESSION['list_staff']['username_changed'])): ?>
                                            <p class="positive_outcome">
                                                <b><?= htmlspecialchars($_SESSION['list_staff']['username_changed']) ?></b>
                                            </p>
                                            <?php unset($_SESSION['list_staff']['username_changed']); ?>
                                        <?php endif; ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <p class="edit_data"><b>Изменить пароль</b></p>
                        <div class="container_form">
                            <div class="form">
                                <div id="change_password">
                                    <form name="change_password" action="" method="post">
                                        <div>
                                            <label for="password">Новый пароль:</label>
                                            <input id="password" type="password" name="password">
                                        </div>
                                        <div>
                                            <label for="password_conf">Повторите пароль:</label>
                                            <input id="password_conf" type="password" name="password_conf">
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
                                        <?php if (isset($_SESSION['mes']['change_password'])): ?>
                                            <p class="positive_outcome">
                                                <b><?= htmlspecialchars($_SESSION['mes']['change_password']) ?></b>
                                            </p>
                                            <?php unset($_SESSION['mes']['change_password']); ?>
                                        <?php endif; ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <p class="edit_data"><b>Изменить Фамилию</b></p>
                        <div class="container_form">
                            <div class="form">
                                <div id="change_name">
                                    <form name="change_name" action="" method="post">
                                        <div>
                                            <label for="name">Новая фамилия:</label>
                                            <input id="name" type="text" name="name">
                                        </div>
                                        <div class="submit">
                                            <input type="submit" name="change_name" value="Сохранить">
                                        </div>
                                        <?php if (isset($_SESSION['name']['errors'])): ?>
                                            <div style="color:red;">
                                                <?= $_SESSION['name']['errors'] ?>
                                            </div>
                                            <?php unset($_SESSION['name']['errors']); ?>
                                        <?php endif; ?>
                                        <?php if (isset($_SESSION['name']['change_name'])): ?>
                                            <p class="positive_outcome">
                                                <b><?= htmlspecialchars($_SESSION['name']['change_name']) ?></b>
                                            </p>
                                            <?php unset($_SESSION['name']['change_name']); ?>
                                        <?php endif; ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <p class="edit_data"><b>Изменить имя</b></p>
                        <div class="container_form">
                            <div class="form">
                                <div id="change_firstname">
                                    <form name="change_firstname" action="" method="post">
                                        <div>
                                            <label for="firstname">Новое имя:</label>
                                            <input id="firstname" type="text" name="firstname">
                                        </div>
                                        <div class="submit">
                                            <input type="submit" name="change_firstname" value="Сохранить">
                                        </div>
                                        <?php if (isset($_SESSION['firstname']['errors'])): ?>
                                            <div style="color:red;">
                                                <?= $_SESSION['firstname']['errors'] ?>
                                            </div>
                                            <?php unset($_SESSION['firstname']['errors']); ?>
                                        <?php endif; ?>
                                        <?php if (isset($_SESSION['firstname']['change_firstname'])): ?>
                                            <p class="positive_outcome">
                                                <b><?= htmlspecialchars($_SESSION['firstname']['change_firstname']) ?></b>
                                            </p>
                                            <?php unset($_SESSION['firstname']['change_firstname']); ?>
                                        <?php endif; ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <p class="edit_data"><b>Изменить Отчество</b></p>
                        <div class="container_form">
                            <div class="form">
                                <div id="change_lastname">
                                    <form name="change_lastname" action="" method="post">
                                        <div>
                                            <label for="lastname">Новое отчество:</label>
                                            <input id="lastname" type="text" name="lastname">
                                        </div>
                                        <div class="submit">
                                            <input type="submit" name="change_lastname" value="Сохранить">
                                        </div>
                                        <?php if (isset($_SESSION['lastname']['errors'])): ?>
                                            <div style="color:red;">
                                                <?= $_SESSION['lastname']['errors'] ?>
                                            </div>
                                            <?php unset($_SESSION['lastname']['errors']); ?>
                                        <?php endif; ?>
                                        <?php if (isset($_SESSION['lastname']['change_lastname'])): ?>
                                            <p class="positive_outcome">
                                                <b><?= htmlspecialchars($_SESSION['lastname']['change_lastname']) ?></b>
                                            </p>
                                            <?php unset($_SESSION['lastname']['change_lastname']); ?>
                                        <?php endif; ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <p class="edit_data"><b>Изменить серию</b></p>
                        <div class="container_form">
                            <div class="form">
                                <div id="change_series">
                                    <form name="change_series" action="" method="post">
                                        <div>
                                            <label for="series">Новая серия:</label>
                                            <input id="series" type="text" name="series">
                                        </div>
                                        <div class="submit">
                                            <input type="submit" name="change_series" value="Сохранить">
                                        </div>
                                        <?php if (isset($_SESSION['series']['errors'])): ?>
                                            <div style="color:red;">
                                                <?= $_SESSION['series']['errors'] ?>
                                            </div>
                                            <?php unset($_SESSION['series']['errors']); ?>
                                        <?php endif; ?>
                                        <?php if (isset($_SESSION['series']['change_series'])): ?>
                                            <p class="positive_outcome">
                                                <b><?= htmlspecialchars($_SESSION['series']['change_series']) ?></b>
                                            </p>
                                            <?php unset($_SESSION['series']['change_series']); ?>
                                        <?php endif; ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php else : ?>
    <?php header("Location: /"); ?>
<?php endif; ?>
