<?php

	require "db.php";

	$data = $_POST;
	
		$errors = array();
		$user = R::findOne('users', 'login = ?', array($data['login']));
		if ($user)
		{
			if ( password_verify($data['password'], $user->password) )
			{
				$_SESSION['logged_user'] = $user;
				$answer = '<div style="color: #32ef05; text-align: center;"> Добро пожаловать, '.$user->login.'!
				<a href="logout.php" title="Выход">Выйти</a></div><hr>';
				header('Location: /');
			} else
			{
				$errors[] = 'Неверно введён пароль';
			}
		} else
		{
			$errors[] = 'Пользователь с таким логином не найден';
		}

		if ( !empty($errors) )
		{
			$answer = '<div style="color: #ef3405; text-align: center; margin: 10px;">'.array_shift($errors).'</div><hr>';
			header('Location: /');
		}
	
	echo $answer;

?>