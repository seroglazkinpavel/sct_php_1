<?php
session_start();
global $connect;
if(isset($_GET['do']) && $_GET['do'] == 'exit' ) unset($_SESSION['auth']['user']); 
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
	<div class="container_reader">			
		<p class="user_staff">Забрать книгу</p>
		<div class="form">
			<div class="staff_return">				
				<div class="addendum_return">					
					<form action="function.php" method="post" class="search">						
						<input type="text" name="give_book" placeholder="читательский билет №">				
						<input class="input_search" type="submit" name="return_book" value="Поиск">
						<?php if(isset($_SESSION['return_book']['errors'])): ?>
							<div style="color:red;"><?=$_SESSION['return_book']['errors']?></div>
							<?php unset($_SESSION['return_book']); ?>
						<?php endif; ?>
					</form>					 
					<table>
						<tr><th>Срок до</th><th>Дата выдачи</th><th>Сотрудник</th><th>Читатель</th><th>Читательский билет</th><th>Название книги</th><th>Автор</th><th>Кол-во</th></tr>
						<?php  if(!empty($_SESSION['return_book']['Time'] && $_SESSION['return_book']['Data'] && $_SESSION['auth']['user'] && $_SESSION['return_book']['Name'] && $_SESSION['return_book']['idReader'] && $_SESSION['return_book']['title'] && $_SESSION['return_book']['autor'] && $_SESSION['return_book']['Sum'])): ?>
							<tr><td><?=$_SESSION['return_book']['Time']?></td><td><?=$_SESSION['return_book']['Data']?></td><td><?=$_SESSION['auth']['user']?></td><td><?=$_SESSION['return_book']['Name']?> <?=$_SESSION['return_book']['FirstName']?> <?=$_SESSION['return_book']['LastName']?></td><td><?=$_SESSION['return_book']['idReader']?></td><td><?=$_SESSION['return_book']['title']?></td><td><?=$_SESSION['return_book']['autor']?></td><td><?=$_SESSION['return_book']['Sum']?></td></tr>							
						<?php endif; ?>											
					</table>
					<form action="" method="post" class="search">																
						<input class="input_search" type="submit" name="deliver" value="Вернуть книгу">				
					</form>
					<?php if(isset($_POST['deliver'])){
							$idReader = $_SESSION['return_book']['idReader']?? false;								
							$query = "DELETE FROM `book_distribution` WHERE `book_distribution`.`idReader` = {$idReader}";
							mysqli_query($connect, $query); 
							unset($_SESSION['return_book']);
						}
					?>
				</div>				
			</div>
		</div>			
	</div>	
</div>
<?php else : ?>
<?php header("Location: /");?>
<?php endif; ?>
	