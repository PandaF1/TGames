<?php
session_start(); # Подключается сессия
if (!empty($_POST['Entry'])) {
              include('module/bd.php'); # Подключается класс БД
              $db = new db; # Создается переменная для работы с классом БД

			  # Фильтруются входящие данные
              $login = $_POST['login'];
              $password = str_replace("'","\'",$_POST['password']);
              
			  # Проверяется существует ли запись в БД по таблице 'light' с получеными данными
              $sql = $db->q("SELECT * FROM users WHERE login='$login' AND password='$password'");
              $sql1 = $db->q("SELECT * FROM users WHERE email='$login' AND password='$password'");

			  # Если существует, то сохраняется сессия и переадресовывает в игру
			  if (mysql_num_rows($sql) == 1 || mysql_num_rows($sql1) == 1)
              # Извлекаем из базы все данные о пользователе с введенным логином
              {
                  if (mysql_num_rows($sql) == 1)$result = mysql_query("SELECT * FROM users WHERE login ='$login'");
                    else $result = mysql_query("SELECT * FROM users WHERE email ='$login'");
                  $myrow = mysql_fetch_array($result);
                  $_SESSION['login']=$myrow['login'];
                  $_SESSION['id_user']=$myrow['id_user'];
                  $_SESSION['side'] = $myrow['side'];
                  $err = '<div class="mess" style="color: blue;">Игрок Hайден</div>';
                  header("Location: game.php");
              }

			  # Если нет, то выводится ошибка
			  else { $err = '<div class="mess" style="color: red;">Игрок не найден</div>'; }
}
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Вход</title>
		<link rel="stylesheet" type="text/css" href="style/CONTENT.css">
        <link rel="stylesheet" type="text/css" href="style/Navigation.css">
	</head>
<body>
<div class="one">
    <div class="main">
        <center><br><br>
        <h1>Entry</h1>
        <br><br><?php echo $err; # Вывод ошибки
                      echo $_SESSION['err'];
                      unset($_SESSION['err']);
        ?><br><br>
		<form method="post">
				<label for="Login">Login or Email:</label>
					<input type="text" required id="Login" name="login" pattern="^[a-zA-Z0-9@_.-]*$" maxlength="50" placeholder = "Your's Login or Email"/>
                <label for="password">Password:</label>
					<input type="password" name="password" required id="password" pattern="^[a-zA-Z0-9]*$" maxlength="15" placeholder = "Your's Password"/>
                <div style="margin-left:-177px;margin-top:5px">
					<input style="width:150px" type="submit" name="Entry" id="but1" value="Войти" class="btn_submit"/>
				</div>
        </form>
            <div style="margin-left:178px; margin-top:-45px">
                <a href="reg.php"><input style="width:150px" id="but2" class="btn_submit" value="Registration"/></a>
            	</div>
		</center></div>
<br></div>
</body>
</html>


