<?php 
session_start();
	 include ("dbconnect.php");
		$r = mysql_query("SELECT * FROM usersperson WHERE `id_user`='".$_SESSION['id_user']."'");
		$a = mysql_fetch_array($r);
		$map = mysql_query("SELECT * FROM useritems WHERE `id_item`='".$a['type_weapon']."'");
		$Item = mysql_fetch_array($map);
		if($Item) echo "<div id='div_itemb' onmouseover=\"tooltip.show('<span style=\'color:white;\'><strong>".$Item['name_item']."[".$Item['lvl_item']."]</strong></span><br><span style=\'color:red;\'><strong>Описание</strong><br><span style=\'color:black;\'>".$Item['char']."</span><br><span style=\'color:red;\'><strong>Характеристики</strong></span><br><center><span style=\'color:black;\'>".$Item['chara']."</span></center><br>');\" onmouseout='tooltip.hide();'>
			<img style='margin-top:25%;'; src='".$Item['pic']."' width=100px; height=auto;></div>"; 
?>