<?php
include('../module/bd.php'); # Подключается класс БД
if (!empty($_POST['create'])) { # Создание предмета
      $db = new db;

      if (!empty($_GET['id'])) { # Если существует id предмета, то он редактируется
       $sql = $db->q("SELECT * FROM `itemsshops` WHERE `name`='".$_GET['name']."'");
       if (mysql_num_rows($sql) == 1) {echo '<div style="color:green;">Такой предмет уже существует</div>';}
      } else { # Если не существует, то создается новая карта
      	      	// Проверяем файл
      	      	$imageinfo = getimagesize($_FILES['image']['tmp_name']);
 				if($imageinfo['mime'] != 'image/png') {
  				echo "Sorry, we only accept PNG images\n";
  				exit;}
  				else{
      	      	switch ($_POST['type']) {
      			case 'head': $uploaddir='Image/Items/head/';break;
      			case 'body': $uploaddir='Image/Items/body/';break;
      			case 'gloves': $uploaddir='Image/Items/gloves/';break;
            case 'falderal': $uploaddir='Image/Items/falderal/';break;
            case 'weapon': $uploaddir='Image/Items/weapon/';break;
            case 'pants': $uploaddir='Image/Items/pants/';break;
            case 'bag': $uploaddir='Image/Items/bag/';break;
            case 'boots': $uploaddir='Image/Items/boots/';break;
      			}
      	$_FILES['image']['name'] = translit($_POST['name']).".png";
    		$uploadfile = $uploaddir.basename($_FILES['image']['name'], $_POST['name']);
	  		if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile))
        {
			// Формируем запрос на добавление файла в базу данных
      		$sql = $db->q("INSERT INTO `itemsshops` (`name`,`type`,`pic`,`char`,`streangth`, `health`, `luck`, `agility`, `armor`, `armorpnt`,`lvl`,`cost`) VALUES ('".$_POST['name']."','".$_POST['type']."','".$uploadfile."','".$_POST['char']."','".$_POST['streanght']."','".$_POST['health']."','".$_POST['luck']."','".$_POST['agility']."','".$_POST['armor']."','".$_POST['armorpnt']."','".$_POST['lvl']."','".$_POST['cost']."')"); 	
      	}
      	else echo "<div style='color:red;'>Проверяем пришел ли файл</div>";
      	}
      }
       if ($sql) echo '<center><div style="color:green;">Предмет добавлен </div></center>';
       else echo "<div style='color:red;'>Ошибка</div>";
      }
?>
<div id="right">
  <center>
  <h1 style="margin-top:15px;margin-bottom:-30px;">Создание Предметов</h1>
	<form style="margin-left:-90px;" method="post" enctype="multipart/form-data">
	<?php $arr = array('head', 'body', 'gloves', 'falderal', 'weapon', 'pants', 'bag', 'boots');?>
	<table style="text-align:center;margin-top:50px;" border:3px>
		<tr>
			<td><label for="name">Name:</label>
				<input type="text" required  id="name" name="name" maxlength="20"/></td>
			<td><label for="lvl">Lvl:</label>
				<input type="text" required id="lvl" name="lvl" maxlength="15" pattern="^[0-9]*$"/></td></tr>
		<tr><td><label style="margin-left:73px;width:325px;" for="image">Изображение:</label>
			<input style="margin-left:73px;width:325px;" required  type="file" id="image" name="image"/></td>
			<td><label for="type" style="margin-left:95px;margin-top:-30px;width:98px;">Type:
                    <select style="margin-left:-1px;" id="type" name="type">
                        <?php
                        foreach ($arr as $value) {
                            ?><option value="<?=$value?>"><?=$value?></option><?php
                        }
                    ?>
                    </select></label></td></tr>
		<tr><td colspan="2"><label for="char">Описание:</label><textarea style="margin-left:75px;height:50px;width:615px;" id="char" name="char" pattern="^[a-zA-Z0-9_-]*$"></textarea></td></tr>
		<tr><td><label for="streanght">Streanght:</label><input type="text" id="streanght" name="streanght" maxlength="15" pattern="^[0-9]*$"/></td>
			<td><label for="health">Health:	 </label><input type="text" id="health" name="health" maxlength="15" pattern="^[0-9]*$"/></td></tr>
		<tr><td><label for="luck">Luck:	 </label><input type="text" id="luck" name="luck" maxlength="15" pattern="^[0-9]*$"/></td>
			<td><label for="agility">Agility:	 </label><input type="text" id="agility" name="agility" maxlength="15" pattern="^[0-9]*$"/></td></tr>
		<tr><td><label for="armor">Armor:	 </label><input type="text" id="armor" name="armor" maxlength="15" pattern="^[0-9]*$"/></td>
			<td><label for="armorpnt">Armorpnt: </label><input type="text" id="armorpnt" name="armorpnt" maxlength="15" pattern="^[0-9]*$"/></td></tr>
		<tr><td rowspan='2'><label for="cost">cost:	 </label><input type="text" required  id="cost" name="cost" maxlength="15" pattern="^[0-9]*$"/></td></tr>
		<td><div style="margin-top:20px;margin-left:20px;">
			<input type="submit" id="but1" name="create" class="btn_submit"/>
		</div></td></tr>
	</table>
</center>
	</form>