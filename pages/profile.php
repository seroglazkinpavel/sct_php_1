<?php
session_start();

if( isset($_GET['do']) && $_GET['do'] == 'exit' ) {
	unset($_SESSION['auth']['user']);
	header("Location: /");
}
if($_SESSION['auth']['user'] && $_SESSION['auth']['role'] === 2):
?>
<div class="content">
	<div class="panel">
		<div class="main_panel"><h2>Профиль сотрудника</h2></div>
		<div class="center">
			<img src="<? if(empty($_SESSION['auth']['avatar'])) echo 'images/avatar.jpg'; else echo $_SESSION['auth']['avatar'] ;?>" alt="Аватар">
		</div>
		<p class="panel_user"><a href="/?do=exit"> Выход</a></p>
		<nav>		
			<ul>
				<li><a href="?page=main">Главная</a></li>
				<li><a href="?page=book_distribution">Выдача книг</a></li>
				<li><a href="?page=return_book">Возврат книг</a></li>
				<li><a href="">Книги в библиотеке</a></li>
				<li><a href="?page=reader">Читатели</a></li>
				
			</ul>
		</nav>
	</div>
	<div class="entrance_system">
		<p class="panel_user">Добро пожаловать, <span><b><?=htmlspecialchars($_SESSION['auth']['name'])?>!</b></p>	
		<div id="profile">
			<h1>Изменить аватар</h1>
			<div class="avatar">
				<img src="<? if(empty($_SESSION['auth']['avatar'])) echo 'images/avatar.jpg'; else echo $_SESSION['auth']['avatar'] ;?>" alt="Аватар">
			</div>
			<div class="avatar_info">
				<p>Допустимые форматы - <b>GIF</b>, <b>JPG</b>, <b>PNG</b></p>
				<p>Размер изображения должен быть <b>не более 50 КБ</b>!</p>
				<p>Изображение должно быть квадратным (иначе могут не соблюдаться пропорции)!</p>
			</div>
			<div class="container_form">
				<div class="form">
					<div id="change_avatar">
						<form name="change_avatar" action="avatar.php" method="post" enctype="multipart/form-data">
							<p>
								<input type="file" name="avatar">
							</p>							
							<div class="submit">
								<input type="submit" name="change_avatar" value="Сохранить">													
							</div>
							<?php if(isset($_SESSION['message'])): ?>
									<div style="color:red;"><?=$_SESSION['message']?></div>
									<?php unset($_SESSION['message']); ?>
								<?php endif; ?>
						</form>
					</div>
				</div>
			</div>
			<h1>Изменить имя</h1>
			<div class="container_form">
				<div class="form">
					<div id="change_name">
						<form name="change_name" action="function.php" method="post">
							<div>
								<label for="name">Ваше имя</label>
								<input id="name" type="text" name="name" value="" placeholder="" data-type="name" data-minlen="" data-maxlen="100" data-tminlen="" data-tmaxlen="Имя слишком длинное!" data-tempty="Вы не ввели имя!" data-ttype="Некорректное имя!" data-fequal="" data-tequal="" />
							</div>							
							<div>
								<label for="password_current_name">Текущий пароль:</label>
								<input type="password" name="password_current_name" id="password_current_name" data-type="" data-minlen="" data-maxlen="100" data-tminlen="" data-tmaxlen="Пароль слишком длинный!" data-tempty="Вы не ввели текущий пароль!" data-ttype="" data-fequal="" data-tequal="" />
							</div>							
							<div class="submit">
								<input type="submit" name="change_name" value="Сохранить">
							</div>					
						</form>
					</div>
				</div>
			</div>
			<h1>Изменить пароль</h1>
			<div class="container_form">
				<div class="form">
					<div id="change_password">
						<form name="change_password" action="" method="post">
							<div>
								<label for="password">Новый пароль:</label>
								<input type="password" name="password" id="password" data-type="" data-minlen="6" data-maxlen="100" data-tminlen="Пароль слишком короткий!" data-tmaxlen="Пароль слишком длинный!" data-tempty="Вы не ввели пароль!" data-ttype="" data-fequal="password_conf" data-tequal="Пароли не совпадают!" />
							</div>							
							<div>
								<label for="password_conf">Повторите пароль:</label>
								<input type="password" name="password_conf" id="password_conf"  />
							</div>							
							<div>
								<label for="password_current">Текущий пароль:</label>
								<input type="password" name="password_current" id="password_current" data-type="" data-minlen="" data-maxlen="100" data-tminlen="" data-tmaxlen="Пароль слишком длинный!" data-tempty="Вы не ввели текущий пароль!" data-ttype="" data-fequal="" data-tequal="" />
							</div>							
							<div class="submit">
								<input type="submit" name="change_password" value="Сохранить"  />
							</div>					
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>
<?php else :?>
<?php header("Location: /");?>
<?php endif; ?>
