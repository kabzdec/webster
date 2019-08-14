<?php
session_start();
require_once('classes/class_task.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  
  $user = $_POST['user'];
  $email = $_POST['email'];
  $some_text = $_POST['some_text'];

if (isset($user) && isset($email) && isset($some_text)){

	$task = new Task($user,$email,$some_text);
  
	if ($task->addToBase()){
		$message = "
<div class='alert alert-success'>
  <strong>Выполнено!</strong> Вы успешно добавили запись
</div>";
	} else 	$message = "
<div class='alert alert-danger'>
  <strong>Внимание!</strong> Ошибка добавления записи
</div>";
	}
}

if (isset($_GET['quit'])){
  unset($_SESSION['admin']);
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <title>Задание от BeeJee</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="./?admin">Администратор</a>
  <!-- Links -->
    <ul class="navbar-nav" i>
       <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Сортировать
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="./?page=1&sort=email">по email</a>
        <a class="dropdown-item" href="./?page=1&sort=user">по имени пользователя</a>
        <a class="dropdown-item" href="./?page=1&sort=cheked">по статусу</a>
      </div>
     <li class="nav-item">
      <a class="nav-link" href="./?quit">Выйти</a>
    </li>
  </ul>
</nav>

<body>
 

<?php
if (isset($_GET['admin'])){
include ('./pages/admin.php');
} else
include('./pages/main.php');
?>

</body>
</html>