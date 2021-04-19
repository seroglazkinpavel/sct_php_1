<?php
session_start();
global $connect;
if(isset($_GET['do']) && $_GET['do'] == 'exit' ) unset($_SESSION['auth']['user']);
//if(!empty($_SESSION['auth']['user'])): 
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
		<p class="user_staff">Читатели</p>
		<div class="form">
			<div class="staff_reader">
				<div class="addendum_search">
					<p class="user_reader"><b>Добавить читателя</b></p>
					<form action="function.php" method="post">
						<p><label>Фамилия:</label><input type="text" name="Name"></p>
						<p><label>Имя:</label><input type="text" name="FirstName"></p>
						<p><label>Отчество:</label><input type="text" name="LastName"></p>
						<p><label>Серия паспорта:</label><input type="text" name="series"></p>
						<p><label>Номер паспорта:</label><input type="text" name="room"></p>
						<p><label>Логин:</label><input type="text" name="login"></p>
						<p><label>Пароль:</label><input type="password" name="password"></p>				
						<button type="submit" name="add_reader">добавить</button>								
						<?php if(isset($_SESSION['reader']['errors'])): ?>
							<div style="color:red;"><?=$_SESSION['reader']['errors']?></div>
							<?php unset($_SESSION['reader']); ?>
						<?php endif; ?>
						<?php  if(isset($_SESSION['reader']['client'])): ?>
							<p class="positive_outcome"><b><?=htmlspecialchars($_SESSION['reader']['client'])?></b></p>
							<?php unset($_SESSION['reader']); ?>
						<?php endif; ?>
					</form>							
				</div>
				<div class="addendum_search">					
					<form action="function.php" method="post" class="search">						
						<input type="text" name="number" placeholder="читательский билет №">				
						<input class="input_search" type="submit" name="search" value="Поиск">							
					</form>
					<p class="information"><b>Список читателей</b></p>
					<?php 
						$query = "SELECT * FROM reader";
						$res = mysqli_query($connect, $query);
						$data = [];
						while ($row = mysqli_fetch_assoc($res)) {						
							$data[$row['idReader']] = $row;
						}
						echo '<table>
						<tr><th>ФИО</th><th>Читательскмй билет №</th><th>Удалить</th><th>Редоктировать</th></tr>';
						foreach ($data as $item) {
						echo
						"<tr><td>{$item['Name']} {$item['FirstName']} {$item['LastName']}</td><td>{$item['idReader']}</td><td><a href='/?page=reader&idReader={$item['idReader']}'>Удалить</a></td><td>Редоктировать</td></tr>"; 						
						}						
						echo '</table>';
						$idReader = $_GET['idReader']?? false;							
						$query_1 = "DELETE FROM `reader` WHERE `reader`.`idReader` = {$idReader}";
						mysqli_query($connect, $query_1);						
					?>					
				</div>				
			</div>

		</div>			
	</div>	
</div>
<?php else : ?>
<?php header("Location: /");?>
<?php endif; ?>
