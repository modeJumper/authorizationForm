<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Topface test-task</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<!--

Реализуйте форму входа/регистрации нового пользователя при помощи PHP, MySQL/Redis или обоих, а так же jQuery. Продумайте самостоятельно необходимые поля. В результате заполнения формы пользователь должен предоставить информацию о себе.
1. Форма должна быть выполнена способом, понятным пользователю, содержать необходимые инструкции, комментарии и т.п.
2. Код должен быть написан понятно и аккуратно, с соблюдением отступов (мы используем 4 пробела) и прочих элементов написания, без лишних элементов и функций, не имеющих отношения к функционалу тестового задания, снабжен понятными комментариями.
3. Пожалуйста, выполняя тестовое задание, обратите особое внимание на качество и безопасность кода.
4. Реализуйте класс, который будет предотвращать повторные регистрации с одного и того же ip адреса за определенный промежуток времени

Примечание: использование готовых фреймворков и плагинов для jQuery не допускается

Тестовое задание должно быть представлено в виде ссылки на репозиторий на GitHub.
Наличие рабочего демо онлайн - приветствуется.

	-->


<?php
	require "db.php";
	?>

	<div class="header">
		<div class="container"> 
			<h1>Тестовое задание Topface</h1>
		</div>
	</div>

	<div class="wrapper">
	
		<?php if ( isset($_SESSION['logged_user']) ) : ?>

		<div class="container success">
			<div>Добро пожаловать,  <?php echo $_SESSION['logged_user']->login; ?>! <a href="logout.php" title="Выход">Выйти</a></div>
			<div><img src="img/success.jpg" alt="Успех!"></div>
		</div>

		<?php else : ?>

		<div class="container">
			<div class="login-block">
			<h3>Форма авторизации</h3>
				<form id="form-auth" action="auth.php" method="post">
					<div class="form-group">
						<label for="login">Логин</label>
						<input type="text" required name="login">
					</div>
					<div class="form-group">
						<label for="password">Пароль</label>
						<input type="password" required name="password">
					</div>
					<div class="form-group">
						<a href="signup.php" title="Регистрация">Нет аккаунта?</a>
						<input type="submit" class="submit" name="auth_submit" value="Войти">
					</div>
				</form>
			</div>
		</div>
		<div class="container">
			<div id="user-log">
				
			</div>
		</div>
		<?php endif; ?>
		
	</div>


	<script src="https://yastatic.net/jquery/3.1.0/jquery.min.js"></script>
	<script>
	$(function(){

		$( "#form-auth" ).submit(function( event ) {

			event.preventDefault();

			var $form = $( this ),
			serialdata = $form.serialize(),
			url = $form.attr( "action" );

			$.post( url, serialdata, function(data) {
				$( "#user-log" ).empty().append( data );
				if ( answerstatus === '1') {
					$(".login-block").slideUp();
					console.log('Ошибка при авторизации');
				}
			} );
		});
	});
	</script>
</body>
</html>