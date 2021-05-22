<?php
session_start();
global $connect;
if (isset($_GET['do']) && $_GET['do'] == 'exit') unset($_SESSION['auth']['user']);
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
        <div class="container_search">
            <p class="user_staff">Выдача книг</p>
            <div class="form">
                <fieldset>
                    <legend>Выдача книг</legend>
                    <form action="handler.php" method="GET" class="book_distribution_form">
                        <div class="book_distribution_search">
                            <label for="search">Название книги:</label>
                            <input id="search" type="search" name="search" placeholder=" Введите название книги "
                                   value="<? if (isset($_GET['search'])) echo $_SESSION['search']['title']; else echo false ?>">
                            <input class="input_search" type="submit" value="Поиск">
                        </div>
                    </form>
                    <?php if (isset($_SESSION['search']['errors'])): ?>
                        <div style="color:red;">
                            <?= $_SESSION['search']['errors'] ?>
                        </div>
                        <?php unset($_SESSION['search']['errors']); ?>
                    <?php endif; ?>
                    <?php if (isset($_GET['search'])): ?>
                        <table class="book_distribution_table">
                            <?php if (!empty($_SESSION['search']['title'] || $_SESSION['search']['autor'])): ?>
                                <tr>
                                    <th>Название книги</th>
                                    <th>Автор</th>
                                    <th>Выдача</th>
                                </tr>
                                <tr>
                                    <td><?= $_SESSION['search']['title'] ?></td>
                                    <td><?= $_SESSION['search']['autor'] ?></td>
                                    <td><a href="/?page=book_distribution&book=book">Выдать</a></td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    <?php endif; ?>
                </fieldset>

            </div>
        </div>
    </div>
    <?php if (isset($_GET['book'])): ?>
    <div class="container_decoration">
        <p class="user_staff">Оформление выдачи книг</p>
        <div class="form_decoration">
            <div class="produce">
                <fieldset>
                    <legend>Выдать книгу</legend>
                    <form action="handler.php" method="post" class="book_distribution_form">
                        <div class="book_distribution_search">
                            <p>Даты выдачи</p>
                            <p id="datetime"><?php echo date("d/m/Y"); ?></p>
                        </div>
                        <div class="book_distribution_search">
                            <p>Сотрудник </p>
                            <p id="text_staff"><?php echo $_SESSION['auth']['user']; ?></p>
                        </div>
                        <div class="book_distribution_search">
                            <p>Читатель </p>
                            <p id="text_reader"><? if (isset($_GET['number'])) echo $_SESSION['reader']['Name'] ?><? if (isset($_GET['number'])) echo $_SESSION['reader']['FirstName'] ?><? if (isset($_GET['number'])) echo $_SESSION['reader']['LastName'] ?></p>
                        </div>
                        <div class="book_distribution_search">
                            <p>Читательский билет</p>
                            <p id="number"><? if (isset($_GET['number'])) echo $_SESSION['reader']['idReader'] ?></p>
                        </div>
                        <div class="book_distribution_search">
                            <p>Название книги</p>
                            <p id="text_book"><?= $_SESSION['search']['title'] ?></p>
                        </div>
                        <div class="book_distribution_search">
                            <p>Автор</p>
                            <p id="text_author"><?= $_SESSION['search']['autor'] ?></p>
                        </div>
                        <div class="book_distribution_search">
                            <label for="number">Количество книг </label>
                            <input id="number_quantity" type="number" name="count">
                        </div>
                        <div class="book_distribution_search">
                            <label for="date">Срок выдачи</label>
                            <input id="date" type="number" name="date">
                        </div>
                        <div class="book_distribution_search">
                            <input class="input_decoration" type="submit" name="decoration" value="Выдать">
                        </div>
                    </form>
                    <?php if (isset($_SESSION['connection']['errors'])): ?>
                        <div style="color:red;">
                            <?= $_SESSION['connection']['errors'] ?>
                        </div>
                        <?php unset($_SESSION['connection']); ?>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['connection']['client'])): ?>
                        <p class="positive_outcome">
                            <b><?= htmlspecialchars($_SESSION['connection']['client']) ?></b>
                        </p>
                        <?php unset($_SESSION['connection']); ?>
                    <?php endif; ?>
                </fieldset>
            </div>
            <div class="produce">
                <fieldset>
                    <legend>Выбрать читателя</legend>
                    <form action="handler.php" method="GET" class="book_distribution_form">
                        <div class="book_reader">
                            <label>Читательский билет </label>
                            <input id="book_reader_search" type="number" name="number" placeholder=" билет № ">
                            <input class="input_reader" type="submit" value="Поиск">
                        </div>
                        <?php if (isset($_SESSION['reader']['errors'])): ?>
                            <div style="color:red;">
                                <?= $_SESSION['reader']['errors'] ?>
                            </div>
                            <?php unset($_SESSION['reader']); ?>
                        <?php endif; ?>
                    </form>
                    <table class="table_reader">
                        <tr>
                            <th>Фамилия Имя Отчество</th>
                            <th>№ билет</th>
                        </tr>
                        <?php if (isset($_GET['number'])) : ?>
                            <tr>
                                <td><?= $_SESSION['reader']['Name'] ?> <?= $_SESSION['reader']['FirstName'] ?> <?= $_SESSION['reader']['LastName'] ?></td>
                                <td><?= $_SESSION['reader']['idReader'] ?></td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </fieldset>
                <div class="">
                    <fieldset>
                        <legend>Список книг на руках</legend>
                        <table class="table_reader">
                            <tr>
                                <th>Автор</th>
                                <th>Название</th>
                                <th>Кол-во</th>
                            </tr>
                            <?php if (isset($_SESSION['book_distribution']['error'])): ?>
                                <div style="color:red;">
                                    <?= $_SESSION['book_distribution']['errors'] ?>
                                </div>
                                <?php unset($_SESSION['book_distribution']); ?>
                            <?php endif; ?>
                            <?php if (!empty($_SESSION['book_distribution']['autor'])): ?>
                                <tr>
                                    <td><?= $_SESSION['book_distribution']['autor'] ?></td>
                                    <td><?= $_SESSION['book_distribution']['title'] ?></td>
                                    <td><?= $_SESSION['book_distribution']['count'] ?></td>
                                </tr>
                                <?php unset($_SESSION['book_distribution']); ?>
                            <?php endif; ?>
                        </table>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php else : ?>
    <?php header("Location: /"); ?>
<?php endif; ?>
<?php if (!isset($_GET['search']) && !isset($_GET['book'])): ?>
    <div class="container_search">
        <p class="user_staff">Kниги</p>
        <div class="form">
            <fieldset>
                <legend>Новое поступление книг</legend>
                <table class="table_list_reader">
                    <tr>
                        <th>Автор</th>
                        <th>Название</th>
                        <th>Дата</th>
                        <th>Выдача</th>
                    </tr>
                    <?php
                    $res = mysqli_query($connect, "SELECT * FROM books ORDER BY data DESC LIMIT 10");
                    $date = [];
                    while ($row = mysqli_fetch_assoc($res)) {
                        $date[] = $row;
                    }
                    foreach ($date as $item) {
                        echo "<tr>
                                <td>{$item['autor']}</td>
                                <td>{$item['title']}</td>
                                <td>{$item['data']}</td>
                                <td><a href='/?page=book_distribution&idBook={$item['idBook']}'>Выдать</a></td>
                              </tr>";
                    }
                    ?>
                </table>
            </fieldset>
        </div>
    </div>
<?php endif; ?>
<?php if (isset($_GET['idBook'])): ?>
    <?php
    $idBook = $_GET['idBook'];
    $query_1 = "SELECT title, autor FROM books WHERE idBook = {$idBook}";
    $result = mysqli_query($connect, $query_1);
    $arr = [];
    while ($line = mysqli_fetch_assoc($result)) {
        $arr[] = $line;
    }
    foreach ($arr as $ar) {
        $ar['autor'];
        $ar['title'];
    }
    ?>
    <div class="container_decoration">
        <p class="user_staff">Оформление выдачи книг</p>
        <div class="form_decoration">
            <div class="produce">
                <fieldset>
                    <legend>Выдать книгу</legend>
                    <form action="handler.php" method="post" class="book_distribution_form">
                        <div class="book_distribution_search">
                            <p>Даты выдачи</p>
                            <p id="datetime">
                                <?php echo date("d/m/Y"); ?>
                            </p>
                        </div>
                        <div class="book_distribution_search">
                            <p>Сотрудник </p>
                            <p id="text_staff">
                                <?php echo $_SESSION['auth']['user']; ?>
                            </p>
                        </div>
                        <div class="book_distribution_search">
                            <p>Читатель </p>
                            <p id="text_reader">
                                <? if (isset($_GET['number'])) echo $_SESSION['reader']['Name'] ?><? if (isset($_GET['number'])) echo $_SESSION['reader']['FirstName'] ?><? if (isset($_GET['number'])) echo $_SESSION['reader']['LastName'] ?>
                            </p>
                        </div>
                        <div class="book_distribution_search">
                            <p>Читательский билет</p>
                            <p id="number">
                                <? if (isset($_GET['number'])) echo $_SESSION['reader']['idReader'] ?>
                            </p>
                        </div>
                        <div class="book_distribution_search">
                            <p>Название книги</p>
                            <p id="text_book"><?= $ar['title'] ?></p>
                        </div>
                        <div class="book_distribution_search">
                            <p>Автор</p>
                            <p id="text_author"><?= $ar['autor'] ?></p>
                        </div>
                        <div class="book_distribution_search">
                            <label for="number_quantity">Количество книг </label>
                            <input id="number_quantity" type="number" name="count">
                        </div>
                        <div class="book_distribution_search">
                            <label for="date">Срок выдачи</label>
                            <input id="date" type="number" name="date">
                        </div>
                        <div class="book_distribution_search">
                            <input class="input_decoration" type="submit" name="decoration" value="Выдать">
                        </div>
                    </form>
                    <?php if (isset($_SESSION['connection']['errors'])): ?>
                        <div style="color:red;">
                            <?= $_SESSION['connection']['errors'] ?>
                        </div>
                        <?php unset($_SESSION['connection']); ?>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['connection']['client'])): ?>
                        <p class="positive_outcome">
                            <b><?= htmlspecialchars($_SESSION['connection']['client']) ?></b>
                        </p>
                        <?php unset($_SESSION['connection']); ?>
                        <?php unset($_SESSION['search']); ?>
                    <?php endif; ?>
                </fieldset>
            </div>
            <div class="produce">
                <fieldset>
                    <legend>Выбрать читателя</legend>
                    <form action="handler.php" method="GET" class="book_distribution_form">
                        <div class="book_reader">
                            <label for="book_reader_search">Читательский билет </label>
                            <input id="book_reader_search" type="number" name="number" placeholder=" билет № ">
                            <input class="input_reader" type="submit" value="Поиск">
                        </div>
                        <?php if (isset($_SESSION['reader']['errors'])): ?>
                            <div style="color:red;">
                                <?= $_SESSION['reader']['errors'] ?>
                            </div>
                            <?php unset($_SESSION['reader']); ?>
                        <?php endif; ?>
                    </form>
                    <table class="table_reader">
                        <tr>
                            <th>Фамилия Имя Отчество</th>
                            <th>№ билет</th>
                        </tr>
                        <?php if (isset($_GET['number'])) : ?>
                            <tr>
                                <td><?= $_SESSION['reader']['Name'] ?> <?= $_SESSION['reader']['FirstName'] ?> <?= $_SESSION['reader']['LastName'] ?></td>
                                <td><?= $_SESSION['reader']['idReader'] ?></td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </fieldset>
                <div class="">
                    <fieldset>
                        <legend>Список книг на руках</legend>
                        <table class="table_reader">
                            <tr>
                                <th>Автор</th>
                                <th>Название</th>
                                <th>Кол-во</th>
                            </tr>
                            <?php if (isset($_SESSION['book_distribution']['error'])): ?>
                                <div style="color:red;">
                                    <?= $_SESSION['book_distribution']['errors'] ?>
                                </div>
                                <?php unset($_SESSION['book_distribution']); ?>
                            <?php endif; ?>
                            <?php if (!empty($_SESSION['book_distribution']['autor'])): ?>
                                <tr>
                                    <td><?= $_SESSION['book_distribution']['autor'] ?></td>
                                    <td><?= $_SESSION['book_distribution']['title'] ?></td>
                                    <td><?= $_SESSION['book_distribution']['count'] ?></td>
                                </tr>
                                <?php unset($_SESSION['book_distribution']); ?>
                            <?php endif; ?>
                        </table>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php
if (!empty($_POST['decoration'])) {
    unset($_SESSION['connection']);
    unset($_SESSION['book_distribution']);
    unset($_SESSION['reader']);
    unset($_SESSION['search']);
    header("Location: /?page=book_distribution");
}
?>
