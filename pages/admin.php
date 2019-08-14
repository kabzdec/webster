<?php
require_once(__DIR__.'/../classes/class_login.php');

$login = $_POST['login'];
$password = $_POST['password'];

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	if (isset($_POST['login']) && isset($_POST['password'])){
		$auth = new Admin($login,$password);
		if ($auth->validate()){
			$_SESSION['admin'] = 1;
			header('Location: /');
			} else echo "Неправильный логин или пароль";
		} 
}

?>
<div class="auth">

<form method="post">
    <p>Имя пользователя: <input type="text" name="login" /></p>
    <p>Пароль: <input type="password" name="password" /></p>
    <p><input type="submit" value="Вход" /></p>
</form>

</div>