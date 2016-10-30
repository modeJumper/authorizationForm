<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Topface test-task</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php

require "db.php";

$data = $_POST;
	if ( isset($data['signup_submit']) )
	{
		$errors = array();
		if ( trim($data['login']) == '' )
		{
			$errors[] = 'Введите логин';
		}
		if ( trim($data['email']) == '' )
		{
			$errors[] = 'Введите e-mail';
		}
		if ( $data['password'] == '' )
		{
			$errors[] = 'Введите пароль';
		}
		if ( $data['password_2'] != $data['password'] )
		{
			$errors[] = 'Пароли не совпадают';
		}
		if ( R::count('users', 'login = ?', array($data['login'])) > 0 )
		{
			$errors[] = 'Этот логин занят';
		}
		if ( R::count('users', 'email = ?', array($data['email'])) > 0 )
		{
			$errors[] = 'Этот e-mail уже используется';
		}

		if ( empty($errors) )
		{
			$user = R::dispense('users');
			$user->login =  $data['login'];
			$user->email = $data['email'];
			$user->password = password_hash($data['password'], PASSWORD_DEFAULT);
			$user->join_date = time();
			R::store($user);
			echo '<div style="color: #32ef05; text-align: center; margin: 10px;"> Вы успешно зарегистрировались! </div><hr>';
			header('Location: /');

		} else
		{
			echo '<div style="color: #ef3405; text-align: center; margin: 10px;">'.array_shift($errors).'</div><hr>';
		}
	}
?>

	<div class="header">
		<div class="container"> 
			<h1>Тестовое задание Topface</h1>
		</div>
	</div>

	<div class="wrapper">
		<div class="container">

			<div class="login-block">
			<h3>Форма регистрации</h3>
				<form action="/signup.php" method="POST">

					<div class="form-group">
						<label for="login">Логин</label>
						<input type="text" name="login" value="<?php echo @$data['login']; ?>">
					</div>
					<div class="form-group">
						<label for="email">e-mail</label>
						<input type="email" name="email" value="<?php echo @$data['email']; ?>">
					</div>
					<div class="form-group">
						<label for="password">Пароль</label>
						<input type="password" name="password">
					</div>
					<div class="form-group">
						<label for="password_2">Повторите пароль</label>
						<input type="password" name="password_2">
					</div>
					<div class="form-group">
						<a href="/" title="Главная">Есть аккаунт?</a>
						<input type="submit" class="submit" name="signup_submit" value="Войти">
					</div>

				</form>
			</div>
		</div>
	</div>
</body>
</html>