<?php
session_start(); # Подключается сессия 
if (!empty($_POST['reg'])) {
        include('module/bd.php'); # Подключается класс БД 
        $db = new db; # Создается переменная для работы с классом БД 
              
			  # Фильтруются входящие данные
        $login = $_POST['login'];
        $email = $_POST['email'];
        $email1 = $_POST['email1'];
        $email .= $email1;
        $password = $_POST['password'];
			  $side = $_POST['side'];

			  # Проверяется существует ли запись в БД с получеными данными
        $sql = $db->q("SELECT * FROM users WHERE `login`='".$login."' OR `email`='".$email."'");

			  # Если существует, то выводится ошибка
			  if (mysql_num_rows($sql) == 1)
			  { $err = '<div class="mess" style="color: red;">Такой логин/email уже существует </div>'; }

			  # Если нет, то создается запись в БД, сохраняется сессия и переадресовывает в игру
			  else {
               $db->q("INSERT INTO users (`login`,`password`,`email`,`side`) VALUES ('".$login."','".$password."','".$email."','".$side."')");
               $result = mysql_query("SELECT * FROM users WHERE login='$login'");
               $myrow = mysql_fetch_array($result);
               $_SESSION['id_user']=$myrow['id_user'];
               $_SESSION['login'] = $myrow['login'];
               $_SESSION['side'] = $myrow['side'];

               $sql = $db->q("SELECT * FROM users WHERE `login`='".$login."' OR `email`='".$email."'");
               if(mysql_num_rows($sql) == 1)
              {
               # Запись Характеристик в БД
               $User = mysql_fetch_array($db->q("SELECT * FROM `users` WHERE `id_user`='".$_SESSION['id_user']."'"));
               $db->q("INSERT INTO characters (`login`,`streangth`, `health`, `luck`, `agility`, `armor`) VALUES ('".$login."','".$User['streangth']."','".$User['health']."','".$User['luck']."','".$User['agility']."','".$User['armor']."')");
               $db->q("INSERT INTO usersperson (`id_user`) VALUES ('".$_SESSION['id_user']."')");
			         $_SESSION['err'] = '<div class="mess" style="color: blue;">Вы успешно зарегистрированы</div>';
              }
               header("Location: Entry.php");
              }
}
?>
<html  style:"overflow:  hidden;">
<head>
<meta charset="utf-8">
  <title>Регистрация</title>
  <link rel="stylesheet" type="text/css" href="style/CONTENT.css">
  <link rel="stylesheet" type="text/css" href="style/Navigation.css">
    <script>
            function checkPass() {
				if (document.getElementById('user_pass').value != document.getElementById('user_repass').value)
					{
						alert("Пароли не совпадают" )
						return false;
						}
				else return true;
					}
    </script>
</head>
<body>
<div class="one">
    <div class="main">
        <center>
        <br><br>
			<h1>Регистрация</h1>
            <br><br><?php echo $err; # Вывод ошибки ?><br>
                <?php $arr = array("@mail.ru", "@gmail.com", "@ukr.net");?>
				<form method="post">
					<label>Login:<input type="text" name="login" maxlength="15" pattern="^[a-zA-Z0-9_-]*$" required placeholder = "Your's Login?"/></label>
					<label style="margin-left:-5px">Email:<input style="width:145px;" type="text" name="email" maxlength="50" pattern="^[a-zA-Z0-9_-]*$" required placeholder = "Your's Email?"/>
                    <select name="email1">
                        <?php
                        foreach ($arr as $value) {
                            ?><option value="<?=$value?>"><?=$value?></option><?php
                        }
                    ?>
                    </select>
                    </label>
					<label>Password:<input type="password" name="password" style="margin-right:37px;" maxlength="15"pattern="^[a-zA-Z0-9]*$" required placeholder = "Your's Password?"/></label>
					<label>Password check:<input type="password" name="password" style="margin-right:103px;" maxlength="15"pattern="^[a-zA-Z0-9]*$" onchange="checkPass()" placeholder = "Check You Password?"/></label>
					<label style="margin-left:-60px;">Выберите<br>Cторону:</label>
					<div class="dib" >
						<label for="diab" class="labl" ><input type="radio" name="side" id="diab" checked style="margin-right:-110px;margin-top:15px;" value="Light">Light</label>
						<label for="los" class="labl" style="margin-left:-9px; margin-top:-2px;"><input type="radio" name="side" id="los" style="margin-right:-110px;" value="Dark">Dark</label>
					</div>
					<div style="margin-top:10px;margin-left:-150px;">
						<input type="submit" id="but1" name="reg" class="btn_submit" value="Зарегистрироваться"/>
					</div>
				</form>
				<div style="margin-left:220px; margin-top:-45px">
                <a href="Entry.php"><input style="width:150px" id="but2" class="btn_submit" value="Entry"/></a>
            	</div>
		</center>
    </div>
</div>
</body>
</html>