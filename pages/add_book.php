<?php
session_start();
global $connect;
if(isset($_GET['do']) && $_GET['do'] == 'exit' ) unset($_SESSION['auth']['user']);
require_once 'module_global.php';
add_book();
change_address();
if(isset($_POST['books_search'])) {
	global $connect;
	$inputSearch = trim(mysqli_real_escape_string($connect, $_POST['search']));
	$query = "SELECT * FROM books WHERE title = '$inputSearch' || autor = '$inputSearch'";
	$res = mysqli_query($connect, $query);
	if(mysqli_num_rows($res) > 0) {
		$row = mysqli_fetch_assoc($res);
		$title = $row['title']?? false;
		$autor = $row['autor']?? false;						
		$file = $row['file']?? false;
	}else{
		$errors = 'Ничего не найдено';
	}
}	
if(!empty($_SESSION['auth']['user']) && $_SESSION['auth']['role'] == 1 || $_SESSION['auth']['role'] == 2):
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
			<p class="user_staff">Книги</p>
			<div class="form">
				<div class="staff_reader">
					<div class="addendum_search">
						<p class="user_reader"><b>Добавить книгу</b></p>
						<input type="hidden" name="MAX_FILE_SIZE" value="5242880">
						<form action="" method="post" enctype="multipart/form-data">
							<p>
                                <label for="autor">ФИО автора:</label>
                                <input id="autor" type="text" name="autor">
                            </p>
							<p>
                                <label for="title">Название книги:</label>
                                <input id="title" type="text" name="title">
                            </p>
							<p>
                                <label for="series">Артикул:</label>
                                <input id="series" type="text" name="series">
                            </p>
							<p>
                                <label for="file">PDF файл:</label>
                                <input id="file" type="file" name="file">
                            </p>
							<p>
                                <label>Описание:</label>
                            </p>
                            <textarea name="text"></textarea>
							<p>
                                <button type="submit" name="add_file">добавить</button>
                            </p>
							<?php if(isset($_SESSION['add_book']['errors'])): ?>
								<div style="color:red;">
                                    <?=$_SESSION['add_book']['errors']?>
                                </div>
								<?php unset($_SESSION['add_book']['errors']);?>
								<?php header("Location: /?page=add_book");?>
							<?php endif; ?>							
						</form>							
					</div>
					<div class="addendum_search">
						<p class="user_reader"><b>Поиск книги для скачивания</b></p>
						<form action="" method="post"  class="book_distribution_form">					
							<div class="book_distribution_search">
								<label for="search">Название книги:</label>
								<input id="search" type="search" name="search" placeholder=" название книги ">
								<input style="margin-top: 0;" class="input_search" type="submit" name="books_search" value="Поиск">
							</div>
							<?php if(isset($errors)): ?>
								<div style="color:red;"><?=$errors?></div>								
							<?php endif; ?>
						</form>
						<?php  if(!empty($title || $autor || $file)): ?>
							<div class="book_data">
								<p>
                                    Название книги: <b><span style="margin-left:10px;"><?=$title;?></span></b>
                                </p>
								<p>
                                    Автор: <b><span style="margin-left:82px;"><?=$autor;?></span></b>
                                </p>
								<?php  if(!empty($file)): ?>
									<a href="<? echo $file;?>" download="" style="font-size: 18px;text-decoration: none;">Скачать PDF-файл</a>							
								<?php else : ?>
									<?php echo false; ?>
								<?php endif; ?>
							</div>												
						<?php endif; ?>
						<fieldset>
							<legend>Редактирование книги (пример адреса:uploads/dog.pdf )</legend>
							<form name="change_name" action="" method="post" enctype="multipart/form-data">
								<div>
									<label for="address">Адрес файла</label>
									<input id="address" type="text" name="address">
								</div>							
								<div>
									<label for="name_book">Название книги:</label>
									<input id="name_book" type="text" name="name_book">
								</div>
								<div>
									<label for="files">PDF файл:</label>
									<input id="files" type="file" name="files">
								<div>
								<div class="submit">
									<input type="submit" name="change_address" value="Сохранить">
								</div>
								<?php if(isset($_SESSION['book_address']['errors'])): ?>
									<div style="color:red;">
                                        <?=$_SESSION['book_address']['errors']?>
                                    </div>
									<?php unset($_SESSION['book_address']['errors']); ?>
								<?php endif; ?>
								<?php if(isset($_SESSION['book_address']['change_address'])): ?>
									<p class="positive_outcome">
                                        <b><?=htmlspecialchars($_SESSION['book_address']['change_address'])?></b>
                                    </p>
									<?php unset($_SESSION['book_address']); ?>
								<?php endif; ?>
							</form>
						</fieldset>
						<fieldset>
							<legend>Редактирование описание книги</legend>
							<form name="change_descriptions" action="handler.php" method="post">
								<div>
									<label for="descriptions">Новое описание</label>
									<textarea id="descriptions" name="descriptions"></textarea>
								</div>							
								<div>
									<label for="name_book">Название книги:</label>
									<input id="name_book" type="text" name="name_book">
								</div>
								
								<div class="submit">
									<input type="submit" name="change_descriptions" value="Сохранить">
								</div>
								<?php if(isset($_SESSION['book_descriptions']['errors'])): ?>
									<div style="color:red;">
                                        <?=$_SESSION['book_descriptions']['errors']?>
                                    </div>
									<?php unset($_SESSION['book_descriptions']['errors']); ?>
								<?php endif; ?>
								<?php if(isset($_SESSION['book_descriptions']['change_descriptions'])): ?>
									<p class="positive_outcome">
                                        <b><?=htmlspecialchars($_SESSION['book_descriptions']['change_descriptions'])?></b>
                                    </p>
									<?php unset($_SESSION['book_descriptions']); ?>
								<?php endif; ?>
							</form>
						</fieldset>
					</div>									
				</div>
				<div class="list_book">
					<fieldset>
					<legend>Новое поступление книг</legend>
						<table class="table_list_reader">
							<tr>
                                <th>Автор</th>
                                <th>Название</th>
                                <th>Дата</th>
                            </tr>
							<?php							 							
								$res = mysqli_query($connect, "SELECT * FROM books ORDER BY data DESC LIMIT 10");
								$date = [];
								while($row = mysqli_fetch_assoc($res)) {
									$date[] = $row;
								}
							?>	
							<?php foreach ($date as $item): ?>
								<tr>
                                    <td><?=$item['autor']?></td>
                                    <td><?=$item['title']?></td>
                                    <td><?=$item['data']?></td>
                                </tr>
							<?php endforeach; ?>							
						</table>
					</fieldset>
				</div>
			</div>			
		</div>	
	</div>
<?php else : ?>
	<?php header("Location: /");?>
<?php endif; ?>