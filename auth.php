<?php

	require "db.php";

	$data = $_POST;
	
		$errors = array();
		$user = R::findOne('users', 'login = ?', array($data['login']));
		if ($user)
		{
			if ( password_verify($data['password'], $user->password) )
			{
				$status = 1;
				$_SESSION['logged_user'] = $user;
				$answer = '<div style="color: #32ef05; text-align: center;"> Добро пожаловать, '.$user->login.'!
				<a href="logout.php" title="Выход">Выйти</a></div><hr>';
				
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
			$status = 0;
			$answer = '<div style="color: #ef3405; text-align: center; margin: 10px;">'.array_shift($errors).'</div><hr>';
		}
	
	echo $answer;

?>

<script>

var answerstatus = "<?php echo $status; ?>";

</script>