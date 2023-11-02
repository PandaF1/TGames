<?php 
session_start();
	 include ("dbconnect.php");
	 	$Us = mysql_query("SELECT * FROM `users` WHERE `id_user`='".$_SESSION['id_user']."'");
	 	$User = mysql_fetch_array($Us);
	 	$rc = mysql_query("SELECT * FROM `characters` WHERE `id_user`='".$_SESSION['id_user']."'");
		$Characters = mysql_fetch_array($rc);

		$HP_first = $User['health']/$Characters['health']*100;$HP_second = $Characters['health_clothes']/$Characters['health']*100;
		$Str_first = $User['streangth']/$Characters['streangth']*100;$Str_second = $Characters['streangth_clothes']/$Characters['streangth']*100;
		$Lck_first = $User['luck']/$Characters['luck']*100;$Lck_second = $Characters['luck_clothes']/$Characters['luck']*100;
		$Agl_first = $User['agility']/$Characters['agility']*100;$Agl_second = $Characters['agility_clothes']/$Characters['agility']*100;
		$Arm_first = $User['armor']/$Characters['armor']*100;$Arm_second = $Characters['armor_clothes']/$Characters['armor']*100;
		$Pnt_first = $User['armorpnt']/$Characters['armorpnt']*100;$Pnt_second = $Characters['armorpnt_clothes']/$Characters['armorpnt']*100;

		$life = $Characters['health']*3.14+$Characters['streangth']*1.2;
		$info_life = "<span style=\'color:white;\'><strong>Жизни : ".$life."</strong></span>";

		$dmg = $Characters['streangth']*2+$Characters['armorpnt']*0.7;
		$dmg1 = $dmg - $dmg*0.2;
		$dmg2 = $dmg + $dmg*0.2;
		$info_dmg = "<span style=\'color:white;\'><strong>Урон : ".$dmg1." - ".$dmg2." </strong></span>";

		$luck = $Characters['luck']*$Characters['agility']*0.01;
		$info_luck = "<span style=\'color:white;\'><strong>Сила Крит.Удара : ".$luck."</strong></span>";

		$dodge = ($Characters['agility']*3+$Characters['luck']*0.75)*0.5;
		$info_dodge = "<span style=\'color:white;\'><strong>Внимательность : ".$dodge."</strong></span>";

		#$info_life = "<span style=\'color:white;\'><strong>Здоровье : ".$life."</strong></span>";
		#$info_life = "<span style=\'color:white;\'><strong>Здоровье : ".$life."</strong></span>";

	 	echo "<div id='frts_main_hr'>
				<span style='color:#FF1A1D;'>Характеристики</span><br>
			</div>
			<div class='char_meter' id='frts_main_hrp' onmouseover=\"tooltip.show('".$info_life."');\" onmouseout='tooltip.hide();'>
				<span style='color:White;'>Здоровье </span><span style='color:White;'>(+".$Characters['health'].")</span><br>
				<div class='meter'><span class='Sspan' id='orange' style='width:".$HP_first."%'></span><span class='Sspan' id='red'style='width:".$HP_second."%'></span></div>
			</div>
			<div id='frts_main_hrp' onmouseover=\"tooltip.show('".$info_dmg."');\" onmouseout='tooltip.hide();'>
				<span style='color:White;'>Сила </span><span style='color:White;'>(+".$Characters['streangth'].")</span><br>
				<div class='meter'><span class='Sspan' id='orange' style='width:".$Str_first."%'></span><span class='Sspan' id='red'style='width:".$Str_second."%'></span></div>
			</div>
			<div id='frts_main_hrp' onmouseover=\"tooltip.show('".$info_luck."');\" onmouseout='tooltip.hide();'>
				<span style='color:White;'>Удача </span><span style='color:White;'>(+".$Characters['luck'].")</span><br>
				<div class='meter'><span class='Sspan' id='orange' style='width:".$Lck_first."%'></span><span class='Sspan' id='red'style='width:".$Lck_second."%'></span></div>
			</div>
			<div id='frts_main_hrp' onmouseover=\"tooltip.show('".$info_dodge."');\" onmouseout='tooltip.hide();'>
				<span style='color:White;'>Умение</span><span style='color:White;'>(+".$Characters['agility'].")</span><br>
				<div class='meter'><span class='Sspan' id='orange' style='width:".$Agl_first."%'></span><span class='Sspan' id='red'style='width:".$Agl_second."%'></span></div>
			</div>
			<div id='frts_main_hrp'>
				<span style='color:White;'>Защита </span><span style='color:White;'>(+".$Characters['armor'].")</span><br>
				<div class='meter'><span class='Sspan' id='orange' style='width:".$Arm_first."%'></span><span class='Sspan' id='red'style='width:".$Arm_second."%'></span></div>
			</div>
			<div id='frts_main_hrp'>
				<span style='color:White;'>Пробивание </span><span style='color:White;'>(+".$Characters['armorpnt'].")</span><br>
				<div class='meter'><span class='Sspan' id='orange' style='width:".$Pnt_first."%'></span><span class='Sspan' id='red'style='width:".$Pnt_second."%'></span></div>
			</div>
				<div style='margin-top:10%'>
	                <a href='game.php?a=treining field'><input type='submit' style='width:150px' id='but2' class='btn_submit' value='Тренировка'/></a>
	            </div> ";
?>