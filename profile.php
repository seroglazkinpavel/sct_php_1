<?php
session_start();
require_once 'module_global.php';
global $connect;
if(isset($_GET['do']) && $_GET['do'] == 'exit' ) unset($_SESSION['auth']);
	
if(!empty($_SESSION['auth']['user']) && $_SESSION['auth']['role'] == 1 || $_SESSION['auth']['role'] == 2):
?>
<div class="reader_system">								
	<div class="menu">
		<div class="item_menu"><a href="?page=main">Главная</a></div>
		<div class="item_menu"><a href="?page=book_distribution">Выдача книг</a></div>
		<div class="item_menu"><a href="?page=return_book">Возврат книг</a></div>
		<div class="item_menu"><a href="?page=add_book">Книги в библиотеке</a></div>
		<div class="item_menu"><a href="?page=reader">Читатели</a></div>
		<div class="item_menu"><a href="/?do=exit">Выход</a></div>
	</div>														
	<div class="container_reader">			
		<p class="user_staff">Читатели</p>
		<div class="form">
			<div class="staff_reader">
				<div id="employee profile">
					<p class="edit_data"><b>Изменить логин</b></p>
					<div class="container_form">
						<div class="form">
							<div id="change_name">
								<form name="change_name" action="" method="post">
									<div>
										<label for="name">Ваш логин</label>
										<input id="name" type="text" name="login" value="">
									</div>							
									<div>
										<label for="password_current_name">Текущий пароль:</label>
										<input type="password" name="password_current_name">
									</div>							
									<div class="submit">
										<input type="submit" name="change_name" value="Сохранить">
									</div>
									<?php if(isset($_SESSION['list_staff']['errors'])): ?>
										<div style="color:red;"><?=$_SESSION['list_staff']['errors']?></div>
										<?php unset($_SESSION['list_staff']['errors']); ?>
									<?php endif; ?>
									<?php  if(isset($_SESSION['list_staff']['username_changed'])): ?>
											<p class="positive_outcome"><b><?=htmlspecialchars($_SESSION['list_staff']['username_changed'])?></b></p>
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
										<input type="password" name="password">
									</div>							
									<div>
										<label for="password_conf">Повторите пароль:</label>
										<input type="password" name="password_conf">
									</div>							
									<div>
										<label for="password_current">Текущий пароль:</label>
										<input type="password" name="password_current">
									</div>							
									<div class="submit">
										<input type="submit" name="change_password" value="Сохранить">
									</div>
									<?php if(isset($_SESSION['mes']['errors'])): ?>
										<div style="color:red;"><?=$_SESSION['mes']['errors']?></div>
										<?php unset($_SESSION['mes']['errors']); ?>
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
<?php header("Location: /");?>
<?php endif; ?>