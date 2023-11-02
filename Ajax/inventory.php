<?php 
session_start();
	 include ("dbconnect.php");
	 $Us = mysql_query("SELECT * FROM `users` WHERE `id_user`='".$_SESSION['id_user']."'");
	 $User = mysql_fetch_array($Us);
	 $r = mysql_query("SELECT * FROM useritems WHERE `id_user`='".$_SESSION['id_user']."'");
	 $sea = mysql_query("SELECT * FROM usersperson WHERE `id_user`='".$_SESSION['id_user']."'");
	 $search = mysql_fetch_array($sea);
	 $Se = mysql_query("SELECT * FROM `server` WHERE `id`=1");
     $Server = mysql_fetch_array($Se);

     echo "<div id='InvetMaxMin'><center><h4>Заполнение Инвентаря : ".$User['inventory']." / 30</h4></center></div>";
	 echo "<div id='sinventory'><table><tr>";
	 while($row = mysql_fetch_array($r)) {
		$But = "<tr><td><center><form method='post' id='myForm'><input type='hidden' value='".$row['id_item']."' name='id_item'><input type='hidden' value='".$row['type']."' name='type_item'><input style='padding:0px;margin:0px;width:90px;height:25px;' class='btn_submit' type='submit' value='Надеть' name='up'></form></center></td></tr>";	
		$but2 = "<tr><td><center><form method='post' id='myForm'><input type='hidden' value='".$row['id_item']."' name='id_item'><input type='hidden' value='".$row['type']."' name='type_item'><input style='padding:0px;margin:0px;width:90px;height:25px;' class='btn_submit' type='submit' value='Снять' name='down'></form></center></td></tr>";
		$info = "<span style=\'color:white;\'><strong>".$row['name_item']."[".$row['lvl_item']."]</strong></span><br><span style=\'color:red;\'><strong>Описание</strong><br><span style=\'color:black;\'>".$row['char']."</span><br><span style=\'color:red;\'><strong>Характеристики</strong></span><br><center><span style=\'color:black;\'>".$row['chara']."</span><center><br><span style=\'color:blue; text-align:left;\'> Дата покупки: ".$row['servertime']."</span>";
		if (!($row['servertime'] == $Server['servertime'])) 
			{
				if($row['cost'] > 0) $info .= "<span style=\'color:blue; text-align:right;\'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Цена: ".$row['cost']."</span>";
				else $info .= "<br><br><span style=\'color:blue; text-align:right;\'>Что бы узнать цену продажи загляни в магизин</span>";
			}
		echo "<table class='table_main'><tr><td id='td'>
				<div onmouseover=\"tooltip.show('".$info."');\" onmouseout='tooltip.hide();'>
				<img src='".$row['pic']."' style='margin-top:10%;' width=80px height=80px;></div></td>";
	        	if($row['lvl_item'] == $User['lvl']){
	        	if($row['type']=='head') { if ($search['type_head'] == 0) echo $But; if ($search['id_head'] == $row['id']) echo $but2; }
	        	if($row['type']=='body') { if ($search['type_body'] == 0) echo $But; if ($search['id_body'] == $row['id']) echo $but2; }
	        	if($row['type']=='gloves') { if ($search['type_gloves'] == 0) echo $But; if ($search['id_gloves'] == $row['id']) echo $but2; }
	        	if($row['type']=='falderal') { if ($search['type_falderal'] == 0) echo $But; if ($search['id_falderal'] == $row['id']) echo $but2; }
	        	if($row['type']=='weapon') { if ($search['type_weapon'] == 0) echo $But; if ($search['id_weapon'] == $row['id']) echo $but2; }
	        	if($row['type']=='pants') { if ($search['type_pants'] == 0) echo $But; if ($search['id_pants'] == $row['id']) echo $but2; }
	        	if($row['type']=='bag') { if ($search['type_bag'] == 0) echo $But; if ($search['id_bag'] == $row['id']) echo $but2; }
	        	if($row['type']=='boots') { if ($search['type_boots'] == 0) echo $But; if ($search['id_boots'] == $row['id']) echo $but2; } }
       echo "</table>";
		}
		echo "</tr></table></div>";					
?>