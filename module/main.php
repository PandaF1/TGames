<?php
$Exp_first = $User['exp']/$User['exp_lvl']*100;$Exp_second = ($User['exp_lvl']-$User['exp'])/$User['exp_lvl']*100;

# But = "<tr><td><center><form method='post'><input type='hidden' value='".$row['id_item']."' name='id_item'><input type='hidden' value='".$row['type']."' name='type_item'><input style='padding:0px;margin:0px;width:90px;height:25px;' class='btn_submit' type='submit' value='Надеть' name='up'></form></center></td></tr>";
# But_2 = "<tr><td><form method='post'><input type='hidden' value='".$row['id_item']."' name='id_items'><input type='hidden' value='".$row['type']."' name='type_item'><a href='game.php?a=main'><input style='margin-bottom:0px;width:100px;' class='btn_submit' type='submit' value='Снять' name='down'></a></form></td></tr>";
								        	
if (!empty($_POST['up'])) {
		if (!empty($_POST['id_item'])){
			$id = preg_replace("/[^0-9]/","",$_POST['id_item']);
			$type = $_POST['type_item'];
         	if ($id == '') go2page("game.php");
			$PlusItem = $db->q("SELECT * FROM useritems WHERE `id_item`='".$id."'");
			$PlusItemChars = mysql_fetch_array($db->q("SELECT * FROM itemsshops WHERE `id_itemshop`='".$id."'"));
	        $row_item = mysql_fetch_array($PlusItem);
			if($type == 'head') {$db->q("UPDATE `usersperson` SET `type_head` = '".$row_item['id_item']."', `id_head` = '".$row_item['id']."' WHERE `id_user`='".$_SESSION['id_user']."'");}
			if($type == 'body') {$db->q("UPDATE `usersperson` SET `type_body` = '".$row_item['id_item']."', `id_body` = '".$row_item['id']."' WHERE `id_user`='".$_SESSION['id_user']."'");}
			if($type == 'gloves') {$db->q("UPDATE `usersperson` SET `type_gloves` = '".$row_item['id_item']."', `id_gloves` = '".$row_item['id']."' WHERE `id_user`='".$_SESSION['id_user']."'");}
			if($type == 'falderal') {$db->q("UPDATE `usersperson` SET `type_falderal` = '".$row_item['id_item']."', `id_falderal` = '".$row_item['id']."' WHERE `id_user`='".$_SESSION['id_user']."'");}
			if($type == 'weapon') {$db->q("UPDATE `usersperson` SET `type_weapon` = '".$row_item['id_item']."', `id_weapon` = '".$row_item['id']."' WHERE `id_user`='".$_SESSION['id_user']."'");}
			if($type == 'pants') {$db->q("UPDATE `usersperson` SET `type_pants` = '".$row_item['id_item']."', `id_pants` = '".$row_item['id']."' WHERE `id_user`='".$_SESSION['id_user']."'");}
			if($type == 'bag') {$db->q("UPDATE `usersperson` SET `type_head` = '".$row_item['id_item']."', `id_head` = '".$row_item['id']."' WHERE `id_user`='".$_SESSION['id_user']."'");}
			if($type == 'boots') {$db->q("UPDATE `usersperson` SET `type_boots` = '".$row_item['id_item']."', `id_boots` = '".$row_item['id']."' WHERE `id_user`='".$_SESSION['id_user']."'");}

$db->q("UPDATE `characters` SET `streangth`= `streangth` + ".$PlusItemChars['streangth'].",`health`= `health` + ".$PlusItemChars['health'].",`luck`=`luck` + ".$PlusItemChars['luck'].",`agility`=`agility` + ".$PlusItemChars['agility'].",`armor`=`armor` + ".$PlusItemChars['armor'].",`armorpnt`=`armorpnt` + ".$PlusItemChars['armorpnt'].",`streangth_clothes`= `streangth_clothes` + ".$PlusItemChars['streangth'].",`health_clothes`=`health_clothes` + ".$PlusItemChars['health'].",`luck_clothes`=`luck_clothes` + ".$PlusItemChars['luck'].",`agility_clothes`=`agility_clothes` + ".$PlusItemChars['agility'].",`armor_clothes`=`armor_clothes` + ".$PlusItemChars['armor'].",`armorpnt_clothes`=`armorpnt_clothes` + ".$PlusItemChars['armorpnt']." WHERE `id_user`='".$_SESSION['id_user']."'");		
}}
											
if (!empty($_POST['down'])) {
		if (!empty($_POST['id_item'])){
		$PlusItemChars = mysql_fetch_array($db->q("SELECT * FROM users WHERE `id_user`='".$_SESSION['id_user']."'"));
		if($PlusItemChars['inventory'] < 30){
			$id = preg_replace("/[^0-9]/","",$_POST['id_item']);
			$type = $_POST['type_item'];
			$PlusItemChars = mysql_fetch_array($db->q("SELECT * FROM itemsshops WHERE `id_itemshop`='".$id."'"));
         	if ($id == '') go2page("game.php");
				if($type == 'head') {$db->q("UPDATE `usersperson` SET `type_head` = 0, `id_head` = 0 WHERE `id_user`='".$_SESSION['id_user']."'");}
				if($type == 'body') {$db->q("UPDATE `usersperson` SET `type_body` = 0, `id_body` = 0 WHERE `id_user`='".$_SESSION['id_user']."'");}
				if($type == 'gloves') {$db->q("UPDATE `usersperson` SET `type_gloves` = 0, `id_gloves` = 0 WHERE `id_user`='".$_SESSION['id_user']."'");}
				if($type == 'falderal') {$db->q("UPDATE `usersperson` SET `type_falderal` = 0, `id_falderal` = 0 WHERE `id_user`='".$_SESSION['id_user']."'");}
				if($type == 'weapon') {$db->q("UPDATE `usersperson` SET `type_weapon` = 0, `id_weapon` = 0 WHERE `id_user`='".$_SESSION['id_user']."'");}
				if($type == 'pants') {$db->q("UPDATE `usersperson` SET `type_pants` = 0, `id_pants` = 0 WHERE `id_user`='".$_SESSION['id_user']."'");}
				if($type == 'bag') {$db->q("UPDATE `usersperson` SET `type_bag` = 0, `id_bag` = 0 WHERE `id_user`='".$_SESSION['id_user']."'");}
				if($type == 'boots') {$db->q("UPDATE `usersperson` SET `type_boots` = 0, `id_boots` = 0 WHERE `id_user`='".$_SESSION['id_user']."'");}			

$db->q("UPDATE `characters` SET `streangth`= `streangth` - ".$PlusItemChars['streangth'].", `health` = `health` - ".$PlusItemChars['health'].",`luck`=`luck` - ".$PlusItemChars['luck'].",`agility`=`agility` - ".$PlusItemChars['agility'].",`armor`=`armor` - ".$PlusItemChars['armor'].",`armorpnt`=`armorpnt` - ".$PlusItemChars['armorpnt'].",`streangth_clothes`= `streangth_clothes` -".$PlusItemChars['streangth'].",`health_clothes`=`health_clothes` - ".$PlusItemChars['health'].",`luck_clothes`=`luck_clothes` - ".$PlusItemChars['luck'].",`agility_clothes`=`agility_clothes` - ".$PlusItemChars['agility'].",`armor_clothes`=`armor_clothes` - ".$PlusItemChars['armor'].",`armorpnt_clothes`=`armorpnt_clothes` - ".$PlusItemChars['armorpnt']." WHERE `id_user`='".$_SESSION['id_user']."'");
}
else $downwe = "<center>Освободите место в инвентаре!</center>";
}}
$TestMlife = 30/100*$User['life'];
$day = mysql_fetch_array($db->q("SELECT * FROM `server` WHERE `id`=1"));
if (!empty($_POST['dmg'])){if($User['mlife'] < $TestMlife) {$ttt = "Низя так, убиться хочешь???";} else {$db->q("UPDATE `users` SET `mlife` = `mlife` - (30/100*`life`) WHERE `id_user`='".$_SESSION['id_user']."'");}}
if (!empty($_POST['upday'])) { if($day['day']  > 30 ) $db->q("UPDATE `server` SET `day` = 1 WHERE `id`=1");  else {$db->q("UPDATE `server` SET `day` = `day`+1 WHERE `id`=1");} }
if (!empty($_POST['downday'])) { if($day['day'] < 2) $db->q("UPDATE `server` SET `day` = 31 WHERE `id`=1");  else { $db->q("UPDATE `server` SET `day` = `day`-1 WHERE `id`=1");} }
?>
<script>
    function head(){
      $.ajax({
        url: "../Ajax/item_head.php",
        cache: false,
        success: function(html){
          $("#head").html(html);
        }
      });}
    function body(){
      $.ajax({
        url: "../Ajax/item_body.php",
        cache: false,
        success: function(html){
          $("#body").html(html);
        }
      });}
    function boots(){
      $.ajax({
        url: "../Ajax/item_boots.php",
        cache: false,
        success: function(html){
          $("#boots").html(html);
        }
      });}
    function pants(){
      $.ajax({
        url: "../Ajax/item_pants.php",
        cache: false,
        success: function(html){
          $("#pants").html(html);
        }
      });}
    function gloves(){
      $.ajax({
        url: "../Ajax/item_gloves.php",
        cache: false,
        success: function(html){
          $("#gloves").html(html);
        }
      });}
    function falderal(){
      $.ajax({
        url: "../Ajax/item_falderal.php",
        cache: false,
        success: function(html){
          $("#falderal").html(html);
        }
      });}
    function bag(){
      $.ajax({
        url: "../Ajax/item_bag.php",
        cache: false,
        success: function(html){
          $("#bag").html(html);
        }
      });}
	function weapon(){
      $.ajax({
        url: "../Ajax/item_weapon.php",
        cache: false,
        success: function(html){
          $("#weapon").html(html);
        }
      });}
    function characters(){
      $.ajax({
        url: "../Ajax/characters.php",
        cache: false,
        success: function(html){
          $("#characters").html(html);
        }
      });}
    function inventory(){
      $.ajax({
        url: "../Ajax/inventory.php",
        cache: false,
        success: function(html){
          $("#inventory-Ajax").html(html);
        }
      });}
  
    $(document).ready(function(){ head(); characters(); inventory(); body(); boots(); pants(); gloves(); falderal(); bag(); weapon();});
</script>
<div id="right">
	<center>
		<h1 style="margin-top:15px;margin-bottom:20px;"> <?php echo "".$_SESSION['login']."[".$User['lvl']."]"; ?> </h1>
	</center>
	<div id="dwn_main"> <!-- Верх -->
		<div id="frts_main"> <!-- Лево-Верх -->
			<center>
				<div id="characters"></div>
        	</center>
		</div>
		<div id="cntr_main"> <!-- Центр-Верх -->
			<div id="inventory">
				<div id="left_main">
					<div id="box_invet1"><div id="head"></div></div>
					<div id="box_invet2"><div id="body"></div></div>
				</div>
				<div id="hero">
				</div>
				<div id="centre_main">
						<div style="margin-left:0px;"id="box_invet3"><div id="boots"></div></div>
						<div id="box_invet3"><div id="pants"></div></div>
						<div id="box_invet3"><div id="gloves"></div></div>
						<div id="box_invet3"><div id="falderal"></div></div>
				</div>
				<div id="right_main">
					<div id="box_invet1"><div id="bag"></div></div>
					<div id="box_invet2"><div id="weapon"></div></div>
				</div>
			</div>
		</div>
		<div id="frts_main"> <!-- Право-Верх -->
			<center>
				<div id="frts_main_hrp">
					<?php echo "<span style='color:White;'>Уровень: ".$User['lvl']."</span><br>
					<div onmouseover=\"tooltip.show('<span>Опыт: ".$User['exp']."/".$User['exp_lvl']."</span>');\" onmouseout='tooltip.hide();' class='meter'>
					<span class='Sspan' id='orange' style='width:".$Exp_first."%'></span><span class='Sspan' id='red' style='width:".$Exp_second."%'></span>
					</div>";
					?>
					<form method="post"><input style="width:150px; margin-top:20px;" type="submit" name="dmg" id="but1" value="dmg -30%" class="btn_submit"/><div><?php echo $ttt; ?></div></form>
					<form method="post"><input style="width:150px; margin-top:20px;" type="submit" name="downday" id="but1" value="-День" class="btn_submit"/><input style="width:150px; margin-top:20px;" type="submit" name="upday" id="but1" value="+День" class="btn_submit"/></form>
				</div>
			</center>
		</div>
	</div>
	<div id="dwn_main"> <!-- Низ -->
		<div id="frts_main">
		</div>
		<div id="cntr_main"> <!-- Центр-Низ -->
				<div id="inventory">
						<div style="margin-left:3.5px;" >
							<?php echo $downwe;?>
							<div id="inventory-Ajax"></div>
						</div>
					</div>
			</div>
		<div id="frts_main">
		</div> 
	</div>