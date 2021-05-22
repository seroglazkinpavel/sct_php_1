<?php
session_start();
require_once 'module_global.php';
global $connect;
if (isset($_GET['do']) && $_GET['do'] == 'exit') unset($_SESSION['auth']);
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
            <div class="item_menu"><a href="/?do=exit">Выход</a></div>
        </div>
        <div class="container_reader">
            <p class="user_staff">Читатели</p>
            <div class="form">
                <div class="staff_reader">
                    <div class="addendum_search">
                        <p class="user_reader"><b>Добавить читателя</b></p>
                        <form action="handler.php" method="post">
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
                                <label for="series">Серия паспорта:</label>
                                <input id="series" type="text" name="series">
                            </p>
                            <p>
                                <label for="room">Номер паспорта:</label>
                                <input id="room" type="text" name="room">
                            </p>
                            <p>
                                <label for="login">Логин:</label>
                                <input id="login" type="text" name="login">
                            </p>
                            <p>
                                <label for="password">Пароль:</label>
                                <input id="password" type="password" name="password">
                            </p>
                            <button type="submit" name="add_reader">добавить</button>
                            <?php if (isset($_SESSION['reader']['errors'])): ?>
                                <div style="color:red;">
                                    <?= $_SESSION['reader']['errors'] ?>
                                </div>
                                <?php unset($_SESSION['reader']); ?>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['reader']['client'])): ?>
                                <p class="positive_outcome">
                                    <b><?= htmlspecialchars($_SESSION['reader']['client']) ?></b>
                                </p>
                                <?php unset($_SESSION['reader']); ?>
                            <?php endif; ?>
                        </form>
                    </div>
                    <div class="addendum_search">
                        <p class="information"><b>Список читателей</b></p>
                        <?php
                        information();
                        ?>
                    </div>
                </div>
                <div class="list_book_reader">
                    <fieldset>
                        <legend>Список книг на руках у читателя
                            <b><? if (isset($_SESSION['list_book_reader'])) echo $_SESSION['list_book_reader']['Name'] . ' ' . $_SESSION['list_book_reader']['FirstName'] . ' ' . $_SESSION['list_book_reader']['LastName']; else echo $_SESSION['list_book']['Name'] . ' ' . $_SESSION['list_book']['FirstName'] . ' ' . $_SESSION['list_book']['LastName']; ?></b>
                        </legend>
                        <form action="handler.php" method="GET" class="search">
                            <input type="text" name="num" placeholder="читательский билет №"
                                   value="<? $number = $_GET['num'] ?? false;
                                   echo $number; ?>">
                            <input class="input_search" type="submit" value="Поиск">
                        </form>
                        <table class="table_list_reader">
                            <?php if (!empty($_SESSION['list_book_reader'])): ?>
                                <tr>
                                    <th>Автор</th>
                                    <th>Название</th>
                                    <th>Срок</th>
                                    <th>Дата выдачи</th>
                                    <th>Кол-во</th>
                                </tr>
                                <tr>
                                    <td><?= $_SESSION['list_book_reader']['autor'] ?></td>
                                    <td><?= $_SESSION['list_book_reader']['title'] ?></td>
                                    <td><?= $_SESSION['list_book_reader']['Time'] ?></td>
                                    <td><?= $_SESSION['list_book_reader']['Data'] ?></td>
                                    <td><?= $_SESSION['list_book_reader']['count'] ?></td>
                                </tr>
                                <?php unset($_SESSION['list_book_reader']); ?>
                            <?php else : ?>
                                <div style="color:red;">
                                    <b><?= $_SESSION['list_book']['errors'] ?></b>
                                </div>
                                <?php unset($_SESSION['list_book']); ?>
                            <?php endif; ?>
                        </table>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <?php header("Location: /"); ?>
<?php endif; ?>
