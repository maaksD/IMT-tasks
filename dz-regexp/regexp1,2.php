<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		.field{
			/* clear: both; */
			text-align: right;
			margin-top: 5px;
		}
		label {
			float: left;
			margin-right: 10px;
		}
		.main{
			float: left;
			padding: 10px;
			background: lightgray;
		}
		.echo{
			clear: both;
		}
	</style>

</head>
<body>
<!-- Задача 1,2 -->
<form name="registr" method="POST">
	<div class="main">
		<div class="field">
			<label>Логин </label>
			<input type="text" name="login" required value="<?php echo $_POST['login'];?>">
		</div>
		<div class="field">
			<label>Имя</label>
			<input type="text" name="name" required value="<?php echo $_POST['name'];?>">
		</div>
		<div class="field">
			<label>E-mail</label>
			<input type="email" name="e-mail" required value="<?php echo $_POST['e-mail'];?>">
		</div>
		<div class="field">
			<label>Введите пароль: </label>
			<input type="password" name="password" required>
		</div>
		<div class="field">
			<label>Подтверждение пароля: </label>
			<input type="password" name="checkpass" required>
		</div>
		<div class="field">	
			<input type="submit" value="Отправить">
		</div>
	</div>
</form>
<div class="echo">

<?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){

		$user = new stdClass();
		$error = array();
		
		preg_match('/(^[-А-Яа-я0-9?]+$)/',preg_replace('/\s+/', '',  $_POST['login']), $match);
			if(empty($match[0])){
				$error[] = "Ошибка, логин должен быть только на кириллице, ни меньше чем 4 символа и может содержать цифры.";
			} else {
				$user->login = $match[0];
				unset($match);
			}
		
		preg_match('/[A-Za-z0-9?]{4,}/',preg_replace('/\s+/', '',  $_POST['name']), $match);
			if(empty($match[0])){
				$error[] = "Ошибка, имя может содержать только кирилицу (большие и маленькие), знак дефиса, и не должно содержать цифр.";
			} else {
				$user->name = $match[0];
				unset($match);
			}

		preg_match('/^[-?A-Za-z.?]+@[A-Za-z]+\.[A-Za-z]{2,6}$/',preg_replace('/\s+/', '',  $_POST['e-mail']), $match);
			if(empty($match[0])){
				$error[] = "Ошибка,	почта должна быть только на латинице, может содержать точки и дефисы";
			} else {
				$user->email = $match[0];
				unset($match);
			}

		preg_match('/^[A-Za-z0-9?\/\-\*\?]{4,}$/',preg_replace('/\s+/', '',  $_POST['password']), $match);
			if(empty($match[0])){
				$error[] = "Ошибка, пароль должен содержать не менее 4 символов, разрешены латиница, цифры, знаки /-*?";
			} else {
				$user->password = $match[0];
				unset($match);
			}

		preg_match('/^[A-Za-z0-9?\/\-\*\?]{4,}$/',preg_replace('/\s+/', '',  $_POST['checkpass']), $match);
			if(empty($match[0])){
				$error[] = "Ошибка, подтверждение пароля должно содержать не менее 4 символов, разрешены латиница, цифры, знаки /-*?";
			} else {
				$user->checkpass = $match[0];
				unset($match);
			}


	if($user->checkpass!=$user->password) {
		die('Пароли не совпадают');
	} else if(!empty($error)) {
		echo "<pre>";
		print_r($error);
	} else {
		echo "<pre>";
		print_r($user);
	}
		
}



	?>
	</div>


	
</body>
</html>