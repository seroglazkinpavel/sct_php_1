<?php
session_start();
global $connect;
if(isset($_GET['do']) && $_GET['do'] == 'exit' ) {
	unset($_SESSION['auth']);
	unset($_SESSION['connection']);
	unset($_SESSION['book_distribution']);
	unset($_SESSION['reader']);
	unset($_SESSION['search']);
}	
if(!empty($_SESSION['auth']['user']) && $_SESSION['auth']['role'] == 1 || $_SESSION['auth']['role'] == 2):
?>
<div class="reader_system">								
	<div class="menu">
		<div class="item_menu"><a href="?page=main">Главная</a></div>
		<div class="item_menu"><a href="?page=book_distribution">Выдача книг</a></div>
		<div class="item_menu"><a href="?page=return_book">Возврат книг</a></div>
		<div class="item_menu"><a href="">Книги в библиотеке</a></div>
		<div class="item_menu"><a href="?page=reader">Читатели</a></div>
		<div class="item_menu"><a href="/?do=exit">Выход</a></div>
	</div>														
	<div class="container_search">			
		<p class="user_staff">Выдача книг</p>
		<div class="form">
			<fieldset>
				<legend>Выдача книг</legend>
				<form action="function.php" method="post"  class="book_distribution_form">					
					<div class="book_distribution_search">
						<label for="search">Название книги:</label>
						<input id="search" type="search" name="search">
						<input class="input_search" type="submit" name="book_distribution_search" value="Поиск">
					</div>				
				</form>
				<?php if(isset($_SESSION['search']['errors'])): ?>
					<div style="color:red;"><?=$_SESSION['search']['errors']?></div>
					<?php unset($_SESSION['search']['errors']); ?>
				<?php endif; ?>
				<table class="book_distribution_table">
					<tr><th>Название книги</th><th>Автор</th><th>Жанр</th><th>Выдача</th></tr>
					<?php  if(!empty($_SESSION['search']['title'] || $_SESSION['search']['autor'])): ?>
						<tr><td><?=$_SESSION['search']['title']?></td><td><?=$_SESSION['search']['autor']?></td><td><?=$_SESSION['search']['genre']?></td><td><a href="/?page=book_distribution&book=book">Выдать</a></td></tr>
						
					<?php endif; ?>	
				</table>
			</fieldset>			
		</div>
	</div>	
</div>
<?php  if(!empty($_GET['book'] && $_GET['book'] == 'book')): ?>
	<div class="container_decoration">	
		<p class="user_staff">Оформление выдачи книг</p>
		<div class="form_decoration">
			<div class="produce">
				<fieldset>
				<legend>Выдать книгу</legend>
					<form action="function.php" method="post"  class="book_distribution_form">					
						<div class="book_distribution_search">
							<p>Даты выдачи</p>
							<p id="datetime"><?php echo date("d/m/Y");?></p>
						</div>
						<div class="book_distribution_search">
							<p>Сотрудник </p>
							<p id="text_staff"><?php echo $_SESSION['auth']['user'];?></p>
						</div>
						<div class="book_distribution_search">
							<p>Читатель </p>
							<p id="text_reader"><?=$_SESSION['reader']['Name']?> <?=$_SESSION['reader']['FirstName']?> <?=$_SESSION['reader']['LastName']?></p>
						</div>
						<div class="book_distribution_search">
							<p>Читательский билет</p>
							<p id="number"><?=$_SESSION['reader']['idReader']?></p>
						</div>
						<div class="book_distribution_search">
							<p>Название книги</p>
							<p id="text_book"><?=$_SESSION['search']['title']?></p>
						</div>
						<div class="book_distribution_search">
							<p>Автор</p>
							<p id="text_author"><?=$_SESSION['search']['autor']?></p>
						</div>
						<div class="book_distribution_search">
							<label for="number">Количество книг </label>
							<input id="number_quantity" type="number" name="count">
						</div>
						<div class="book_distribution_search">
							<label for="date">Срок выдачи до </label>
							<input id="date" type="date" name="date">
						</div>
						<div class="book_distribution_search">
							<input class="input_decoration" type="submit" name="decoration" value="Выдать">
						</div>
					</form>
					<?php if(isset($_SESSION['connection']['errors'])): ?>
						<div style="color:red;"><?=$_SESSION['connection']['errors']?></div>
						<?php unset($_SESSION['connection']); ?>
					<?php endif; ?>
					<?php  if(isset($_SESSION['connection']['client'])): ?>
						<p class="positive_outcome"><b><?=htmlspecialchars($_SESSION['connection']['client'])?></b></p>
						<?php unset($_SESSION['connection']); ?>
						<?php unset($_SESSION['book_distribution']); ?>
						<?php unset($_SESSION['reader'])?>
						<?php unset($_SESSION['search'])?>
					<?php endif; ?>
				</fieldset>
			</div>
			<div class="produce">
				<fieldset>
				<legend>Выбрать читателя</legend>
					<form action="function.php" method="post"  class="book_distribution_form">					
						<div class="book_reader">
							<label>Читательский билет </label>
							<input id="book_reader_search" type="number" name="number">
							<input class="input_reader" type="submit" name="book_reader" value="Поиск">
						</div>
						<?php if(isset($_SESSION['reader']['errors'])): ?>
							<div style="color:red;"><?=$_SESSION['reader']['errors']?></div>
							<?php unset($_SESSION['reader']); ?>
						<?php endif; ?>
					</form>
					<table class="table_reader">
						<tr><th>Фамилия Имя Отчество</th><th>№ билет</th></tr>
						<?php  if(!empty($_SESSION['reader']['idReader'])): ?>
							<tr><td><?=$_SESSION['reader']['Name']?> <?=$_SESSION['reader']['FirstName']?> <?=$_SESSION['reader']['LastName']?></td><td><?=$_SESSION['reader']['idReader']?></td></tr>							
						<?php endif; ?>	
					</table>
				</fieldset>
				<div class="">
					<fieldset>
					<legend>Список книг на руках</legend>
						<table class="table_reader">
						<tr><th>Автор</th><th>Название</th><th>Кол-во</th></tr>
						<?php  if(isset($_SESSION['book_distribution']['error'])): ?>
							<div style="color:red;"><?=$_SESSION['book_distribution']['errors']?></div>
							<?php unset($_SESSION['book_distribution']); ?>
						<?php endif; ?>
						<?php  if(!empty($_SESSION['book_distribution']['autor'])): ?>
							<tr><td><?=$_SESSION['book_distribution']['autor']?></td><td><?=$_SESSION['book_distribution']['title']?></td><td><?=$_SESSION['book_distribution']['Sum']?></td></tr>
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
<?php header("Location: /");?>
<?php endif; ?>	