<?php
session_start();
global $connect;
if (isset($_GET['do']) && $_GET['do'] == 'exit') unset($_SESSION['auth']['user']);
$arr = $_SESSION['return_volume'];
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
            <p class="user_staff">Забрать книгу</p>
            <div class="form">
                <div class="staff_return">
                    <div class="addendum_return">
                        <form action="handler.php" method="GET" class="search">
                            <input type="text" name="give_book" placeholder="читательский билет №"
                                   value="<?= $_SESSION['return_book']['idReader'] ?>">
                            <input class="input_search" type="submit" value="Поиск">
                            <?php if (isset($_SESSION['return_book']['errors'])): ?>
                                <div style="color:red;">
                                    <?= $_SESSION['return_book']['errors'] ?>
                                </div>
                                <?php unset($_SESSION['return_book']); ?>
                            <?php endif; ?>
                        </form>
                        <?php if (isset($_GET['give_book'])): ?>
                            <table>
                                <tr>
                                    <th>Срок</th>
                                    <th>Дата выдачи</th>
                                    <th>Сотрудник</th>
                                    <th>Читатель</th>
                                    <th>Читательский билет</th>
                                    <th>Название книги</th>
                                    <th>Автор</th>
                                    <th>Кол-во</th>
                                    <th>Вернуть книгу</th>
                                </tr>
                                <?php foreach ($arr as $elemen): ?>
                                    <tr>
                                        <td><?= $elemen['Time'] ?></td>
                                        <td><?= $elemen['Data'] ?></td>
                                        <td><?= $_SESSION['auth']['user'] ?></td>
                                        <td><?= $elemen['Name'] ?> <?= $elemen['FirstName'] ?> <?= $elemen['LastName'] ?></td>
                                        <td><?= $elemen['idReader'] ?></td>
                                        <td><?= $elemen['title'] ?></td>
                                        <td><?= $elemen['autor'] ?></td>
                                        <td><?= $elemen['count'] ?></td>
                                        <td><a href="/?page=return_book&idReader=<?php echo $elemen['idReader'] ?>">Вернуть
                                                книгу</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                            <?php if (!isset($elemen['id'])): ?>
                                <div style="color:red;margin-left:30px;margin-bottom:10px;">
                                    <b>У такого читателя книг нет.</b>
                                </div>
                            <?php endif; ?>
                        <?php else : ?>
                            <div class="list_book">
                                <fieldset>
                                    <legend>Последние выданные книги</legend>
                                    <table class="table_list_reader">
                                        <tr>
                                            <th>Автор</th>
                                            <th>Название</th>
                                            <th>Дата</th>
                                        </tr>
                                        <?php
                                        $query_1 = "SELECT * 
														FROM book_distribution
															JOIN books ON book_distribution.idBook = books.idBook
																ORDER BY book_distribution.id ASC LIMIT 10";
                                        $res = mysqli_query($connect, $query_1);
                                        $date = [];
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $date[] = $row;
                                        }
                                        ?>
                                        <?php foreach ($date as $item): ?>
                                            <tr>
                                                <td><?= $item['autor'] ?></td>
                                                <td><?= $item['title'] ?></td>
                                                <td><?= $item['Data'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </fieldset>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($_GET['idReader'])) {
                            $idReader = $_GET['idReader'];
                            $query = "DELETE FROM `book_distribution` WHERE `book_distribution`.`idReader` = {$idReader}";
                            mysqli_query($connect, $query);
                            unset($_SESSION['return_book']);
                        } else $idReader = false;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <?php header("Location: /"); ?>
<?php endif; ?>
	