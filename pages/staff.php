<?php
session_start();
if(isset($_GET['do']) && $_GET['do'] == 'exit' ) unset($_SESSION['auth']['user']);
global $connect;
if(!empty($_SESSION['auth']['user']) && $_SESSION['auth']['role'] == 1): 
?>
<div class="content_staff">
	<div class="menu">
		<div class="item_menu"><a href="?page=main">Главная</a></div>
		<div class="item_menu"><a href="?page=book_distribution">Выдача книг</a></div>
		<div class="item_menu"><a href="?page=return_book">Возврат книг</a></div>
		<div class="item_menu"><a href="">Книги в библиотеке</a></div>
		<div class="item_menu"><a href="?page=reader">Читатели</a></div>
		<div class="item_menu"><a href="?page=staff">Сотрудники</a></div>
		<div class="item_menu"><a href="/?do=exit">Выход</a></div>
	</div>
	<div class="employee">		
			<div class="container_staff">			
				<p class="user_staff">Окно для добавления или увольнентя сотрудника</p>
				<div class="form">
					<div class="staff">
						<div class="addendum">
							<p class="user_form"><b>Добавление</b></p>
							<form action="function.php" method="post" class="authoriz">
								<p><label for="Name">Фамилия:</label><input type="text" name="Name"></p>
								<p><label for="FirstName">Имя:</label><input type="text" name="FirstName"></p>
								<p><label for="LastName">Отчество:</label><input type="text" name="LastName"></p>
								<p><label for="post">Должность:</label><input type="text" name="post"></p>
								<p><label for="login">Логин:</label><input type="text" name="login"></p>
								<p><label for="password">Пароль:</label><input type="password" name="password"></p>				
								<button type="submit" name="add">добавить</button>								
								<?php if(isset($_SESSION['regist']['errors'])): ?>
									<div style="color:red;"><?=$_SESSION['regist']['errors']?></div>
									<?php unset($_SESSION['regist']); ?>
								<?php endif; ?>
								<?php  if(isset($_SESSION['regist']['employee'])): ?>
									<b><?=htmlspecialchars($_SESSION['regist']['employee'])?></b>
									<?php unset($_SESSION['regist']); ?>
								<?php endif; ?>
							</form>							
						</div>
						<div class="addendum">
							<p class="user_form"><b>Список сотрудников</b></p>
							<?php 
								$query = "SELECT * FROM staff";
								$res = mysqli_query($connect, $query);
								$data = [];
								while ($row = mysqli_fetch_assoc($res)) {						
									$data[$row['idWorked']] = $row;
								}
								echo '<table>
								<tr><th>ФИО</th><th>Номер сотрудника</th><th>Удалить</th><th>Редоктировать</th></tr>';
								foreach ($data as $item) {
								echo
								"<tr><td>{$item['Name']} {$item['FirstName']} {$item['LastName']}</td><td>{$item['idWorked']}</td><td><a href='/?page=staff&idWorked={$item['idWorked']}'>Удалить</a></td><td>Редоктировать</td></tr>"; 						
								}						
								echo '</table>';
								$idWorked = $_GET['idWorked']?? false;							
								$query_1 = "DELETE FROM `staff` WHERE `staff`.`idWorked` = {$idWorked}";
								mysqli_query($connect, $query_1);						
							?>
						</div>
					</div>	
				</div>			
			</div>
	</div>
</div>
<?php else : ?>
<?php header("Location: /");?>
<?php endif; ?>
