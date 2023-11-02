<?php
$Time = mysql_fetch_array($db->q("SELECT * FROM server WHERE id=1"));
if (!empty($_POST['buy'])) { # Покупка
        # Покупка предмета
        if (!empty($_POST['item_id']))
        {
         # Фильтрация данных
         $id = preg_replace("/[^0-9]/","",$_POST['item_id']);
         if ($id == '') go2page("game.php");
         # Проверка на существование предмета
         $map = $db->q("SELECT * FROM itemsshops WHERE `id_itemshop`='".$id."'");
         if (mysql_num_rows($map) == 1) {
            $row_item = mysql_fetch_array($map);
                if ($row_item['cost'] <= $User['money']) {
                       # Если хватает денег и места, то добавляем игроку карту, отнимаем деньги
                       if ($User['inventory'] < 30){
                          $chara;
                          if($row_item['streangth'] > 0) $chara .= "<span><br>Сила +".$row_item['streangth']."</span>"; 
                          if($row_item['health'] > 0)    $chara .= "<span><br>Здоровье +".$row_item['health']."</span>";
                          if($row_item['luck'] > 0)    $chara .= "<span><br>Удача +".$row_item['luck']."</span>";
                          if($row_item['agility'] > 0)   $chara .= "<span><br>Подвижность +".$row_item['agility']." </span>";
                          if($row_item['armor'] > 0)     $chara .= "<span><br>Броня +".$row_item['armor']." </span>";
                          if($row_item['armorpnt'] > 0)  $chara .= "<span><br>Пробивание Брони +".$row_item['armorpnt']."</span>";

                       $db->q("INSERT INTO useritems (`id_user`,`id_item`,`name_item`,`type`,`pic`,`char`,`chara`,`streangth`, `health`, `luck`, `agility`, `armor`, `armorpnt`,`lvl_user`,`lvl_item`,`servertime`) VALUES ('".$_SESSION['id_user']."','".$row_item['id_itemshop']."','".$row_item['name']."','".$row_item['type']."','".$row_item['pic']."','".$row_item['char']."','".$chara."','".$row_item['streangth']."','".$row_item['health']."','".$row_item['luck']."','".$row_item['agility']."','".$row_item['armor']."','".$row_item['armorpnt']."','".$User['lvl']."','".$row_item['lvl']."','".$Time['servertime']."')");
                       # Изменяем количество монет у игрока, т.к. количество монет мы получили раньше (строка 2), затем изменили их (строка 21), но данные полученные раньше не изменились, поэтому изменяются в данной строке
                       $db->q("UPDATE `users` SET `money` = `money` - '".$row_item['cost']."' WHERE `id_user`='".$_SESSION['id_user']."'");
                       $db->q("UPDATE `users` SET `inventory` = `inventory` + 1 WHERE `id_user`='".$_SESSION['id_user']."'");
                       $resuls = "<div style='top:10px;text-align:center;color:green;'>Спасибо за покупку</div>";
                       unset($chara);
                      }
                      else {echo "<div style='text-align:center;color:red;'>Инвентарь переполнен!</div>";}
                      }
                  }
              }
        }
if (!empty($_POST['sells'])) { # Продажа
        # Покупка предмета
        if (!empty($_POST['item_id']))
        {
         # Фильтрация данных
         $id = preg_replace("/[^0-9]/","",$_POST['item_id']);
         if ($id == '') go2page("game.php");
         # Проверка на существование предмета
         $map = $db->q("SELECT * FROM useritems WHERE `id_user`='".$_SESSION['id_user']."'");
         if (!mysql_num_rows($map) == 0) {
            $row_item = mysql_fetch_array($map);
            $cost_day2 = $row_item['cost'];
            $db->q("UPDATE `users` SET `money` = `money` + '".$cost_day2."' WHERE `id_user`='".$_SESSION['id_user']."'");
            $db->q("UPDATE `users` SET `inventory` = `inventory` - 1 WHERE `id_user`='".$_SESSION['id_user']."'");
            $db->q("DELETE FROM useritems WHERE id = '".$id."'");
            $resuls = "<div style='text-align:center;color:green;'>Предмет продан</div>";
            }
    }
}
if (!empty($_POST['drop'])) { # Снятие
    # Покупка предмета
  if (!empty($_POST['id']))
    {
      $PlusItemChars = mysql_fetch_array($db->q("SELECT * FROM users WHERE `id_user`='".$_SESSION['id_user']."'"));
      if($PlusItemChars['inventory'] < 30){
         # Фильтрация данных
         $id = preg_replace("/[^0-9]/","",$_POST['id_item']);
         if ($id == '') go2page("game.php");
         $type = $_POST['type_item'];
         $PlusItemChar = $db->q("SELECT * FROM itemsshops WHERE `id_itemshop`='".$id."'");
         $PlusItemChars = mysql_fetch_array($PlusItemChar);
         $map = $db->q("SELECT * FROM useritems WHERE `id_user`='".$_SESSION['id_user']."'");
            $row_item = mysql_fetch_array($map);
            if($type == 'head') {$db->q("UPDATE `usersperson` SET `type_head` = 0, `id_head` = 0 WHERE `id_user`='".$_SESSION['id_user']."'");}
            if($type == 'body') {$db->q("UPDATE `usersperson` SET `type_body` = 0, `id_body` = 0 WHERE `id_user`='".$_SESSION['id_user']."'");}
            if($type == 'gloves') {$db->q("UPDATE `usersperson` SET `type_gloves` = 0, `id_gloves` = 0 WHERE `id_user`='".$_SESSION['id_user']."'");}
            if($type == 'falderal') {$db->q("UPDATE `usersperson` SET `type_falderal` = 0, `id_falderal` = 0 WHERE `id_user`='".$_SESSION['id_user']."'");}
            if($type == 'weapon') {$db->q("UPDATE `usersperson` SET `type_weapon` = 0, `id_weapon` = 0 WHERE `id_user`='".$_SESSION['id_user']."'");}
            if($type == 'pants') {$db->q("UPDATE `usersperson` SET `type_pants` = 0, `id_pants` = 0 WHERE `id_user`='".$_SESSION['id_user']."'");}
            if($type == 'bag') {$db->q("UPDATE `usersperson` SET `type_bag` = 0, `id_bag` = 0 WHERE `id_user`='".$_SESSION['id_user']."'");}
            if($type == 'boots') {$db->q("UPDATE `usersperson` SET `type_boots` = 0, `id_boots` = 0 WHERE `id_user`='".$_SESSION['id_user']."'");}
            
$db->q("UPDATE `characters` SET `streangth`= `streangth` - ".$PlusItemChars['streangth'].", `health` = `health` - ".$PlusItemChars['health'].",`luck`=`luck` - ".$PlusItemChars['luck'].",`agility`=`agility` - ".$PlusItemChars['agility'].",`armor`=`armor` - ".$PlusItemChars['armor'].",`armorpnt`=`armorpnt` - ".$PlusItemChars['armorpnt'].",`streangth_clothes`= `streangth_clothes` -".$PlusItemChars['streangth'].",`health_clothes`=`health_clothes` - ".$PlusItemChars['health'].",`luck_clothes`=`luck_clothes` - ".$PlusItemChars['luck'].",`agility_clothes`=`agility_clothes` - ".$PlusItemChars['agility'].",`armor_clothes`=`armor_clothes` - ".$PlusItemChars['armor'].",`armorpnt_clothes`=`armorpnt_clothes` - ".$PlusItemChars['armorpnt']." WHERE `id_user`='".$_SESSION['id_user']."'");
  $resuls = "<div style='text-align:center;color:green;'>Предмет снят</div>";
          }
          else $resuls = "<div style='text-align:center;color:red;'>Освободите место в инвентаре!</div>";;
        }
    }
if (!empty($_POST['head'])) $db->q("UPDATE `users` SET `shop` = 'head' WHERE `id_user`='".$_SESSION['id_user']."'"); 
if (!empty($_POST['boots'])) $db->q("UPDATE `users` SET `shop` = 'boots' WHERE `id_user`='".$_SESSION['id_user']."'");
if (!empty($_POST['body'])) $db->q("UPDATE `users` SET `shop` = 'body' WHERE `id_user`='".$_SESSION['id_user']."'");
if (!empty($_POST['gloves'])) $db->q("UPDATE `users` SET `shop` = 'gloves' WHERE `id_user`='".$_SESSION['id_user']."'"); 
if (!empty($_POST['falderal'])) $db->q("UPDATE `users` SET `shop` = 'falderal' WHERE `id_user`='".$_SESSION['id_user']."'");
if (!empty($_POST['pants'])) $db->q("UPDATE `users` SET `shop` = 'pants' WHERE `id_user`='".$_SESSION['id_user']."'");
if (!empty($_POST['bag'])) $db->q("UPDATE `users` SET `shop` = 'bag' WHERE `id_user`='".$_SESSION['id_user']."'");
if (!empty($_POST['weapon'])) $db->q("UPDATE `users` SET `shop` = 'weapon' WHERE `id_user`='".$_SESSION['id_user']."'");
if (!empty($_POST['sell'])) $db->q("UPDATE `users` SET `shop` = 'sell' WHERE `id_user`='".$_SESSION['id_user']."'");
if (!empty($_POST['eat'])) $db->q("UPDATE `users` SET `shop` = 'eat' WHERE `id_user`='".$_SESSION['id_user']."'");
$User = mysql_fetch_array($db->q("SELECT * FROM `users` WHERE `id_user`='".$_SESSION['id_user']."'"));

    if (!($Time['day_test'] == $Time['day']))
    {
        $sql1 = $db->q("SELECT * FROM useritems WHERE `id_user`='".$_SESSION['id_user']."'");
             while($rows = mysql_fetch_array($sql1)) {
                $sql = mysql_fetch_array($db->q("SELECT * FROM itemsshops WHERE `id_itemshop`='".$rows['id_item']."'"));
                $first = 3*$sql['cost'];
                $second = 0.1*$sql['cost'];
                $rowsa = rand($first, $second);
                $db->q("UPDATE `useritems` SET `cost` = ".$rowsa." WHERE `id_item`= ".$rows['id_item']."");
              }
          $db->q("UPDATE `server` SET `day_test` = ".$Time['day']." WHERE `id`= 1");
    }

?>
<div id="right">
<center> 
  <h1 style="margin-top:10px;margin-bottom:15px;">Магазин</h1>
  <?php echo $resuls;?>
</center>
<div class="shops"> 
        <form method='post'><input class='shop_submit' type='submit' value='Шлем' name='head'></input>
                            <input class='shop_submit' type='submit' value='Обувь'  name='boots'></input>
                            <input class='shop_submit' type='submit' value='Одежда'  name='body'></input>
                            <input class='shop_submit' type='submit' value='Перчатки' name='gloves'></input>
                            <input class='shop_submit' type='submit' value='Продать' name='sell'></input><br>
                            <input class='shop_submit' type='submit' value='Украшение'  name='falderal'></input>
                            <input class='shop_submit' type='submit' value='Штаны'  name='pants'></input>
                            <input class='shop_submit' type='submit' value='Сумки'  name='bag'></input>
                            <input class='shop_submit' type='submit' value='Оружие'  name='weapon'></input>
                            <input class='shop_submit' type='submit' value='Еда'  name='eat'></input>
        </form>
</div>
<div id="content"><table><tr>
<?php
  $i=1;
        if($User['shop'] == 'head' || $User['shop'] == 'boots' || $User['shop'] == 'body' || $User['shop'] == 'gloves' || $User['shop'] == 'falderal' || $User['shop'] == 'pants' || $User['shop'] == 'bag' || $User['shop'] == 'weapon'){
        $sql = $db->q("SELECT * FROM itemsshops ORDER BY 'id_itemshop' ASC");
          while($row = mysql_fetch_array($sql)) {
              if($row['type'] == $User['shop']){
          echo "
           <table style='width:719px;display:block;border:3px solid #00FF00;'>
           <tr>
            <td colspan='4' style='height:30px;text-align:center;width:180px;border:2px solid DarkViolet;'><b>".$row['name']."</b></td>
           </tr>
           <tr>
            <td rowspan='2' style='text-align:center;width:150px;border:2px solid DarkViolet;'><img src='".$row['pic']."' width=150px height=150px; alt=".$row['name']."/></td>
            <td rowspan='2' style='text-align:center;width:344px;border:2px solid DarkViolet;'>".$row['char']."</td>
            <td style='border:2px solid DarkViolet;width:200px;'>
            <center><table style='text-align:center;'>
            <tr><td style='text-align:center;'>Уровень</td><td>:</td><td>".$row['lvl']." Lvl</td></tr>";?>
           <?php if($row['streangth'] > 0) echo "<tr><td>Сила</td><td>:</td><td> +".$row['streangth']."<br></td></tr>"; ?>
           <?php if($row['health'] > 0) echo "<tr><td>Здоровье</td><td>:</td><td> +".$row['health']."<br></td></tr>"; ?>
           <?php if($row['luck'] > 0) echo "<tr><td>Удача</td><td>:</td><td> +".$row['luck']."<br></td></tr>"; ?>
           <?php if($row['agility'] > 0) echo "<tr><td>Подвижность</td><td>:</td><td> +".$row['agility']."<br></td></tr>"; ?>
           <?php if($row['armor'] > 0) echo "<tr><td>Броня</td><td>:</td><td> +".$row['armor']."<br></td></tr>"; ?>
           <?php if($row['armorpnt'] > 0) echo "<tr><td>Пробивание Брони</td><td>:</td><td> +".$row['armorpnt']."<br></td></tr>"; ?>
        <?php echo "<tr><th style='text-align:center;'>Цена Рынка</th><th>:</th><th> +".$row['cost']."</th></tr></tr>";
         if ($User['money'] >= $row['cost_day']) { # Хватает денег?
          echo "<tr style='text-align:center;'>
            <td colspan='3'>
              <form method='post'>
              <center>
               <input type='hidden' value='".$row['id_itemshop']."' name='item_id'>
               <input style='margin-top:10px;margin-bottom:9px;' class='btn_submit' type='submit' value='Купить за ".$row['cost']."' name='buy'>
              </center>
              </form>
            </td>
           </tr>";
         }
         echo "</table><br>";
         if (($i%1)==0) echo "</tr><tr>"; # По 1 штук в строку
         $i++;
        }
}}
if($User['shop'] == 'sell'){
    $sql = $db->q("SELECT * FROM useritems WHERE `id_user`='".$_SESSION['id_user']."'");
    $wow = mysql_fetch_array($db->q("SELECT * FROM usersperson WHERE `id_user`='".$_SESSION['id_user']."'"));
    while($row = mysql_fetch_array($sql)) {
      $buuy = "<tr style='text-align:center;'>
                <td colspan='2'>
                <form method='post'>
                 <input type='hidden' value='".$row['id']."' name='item_id'>
                 <input style='margin-top:10px;margin-bottom:9px;' class='btn_submit' type='submit' value='Продать за ".$row['cost']."' name='sells'>
                 </form>
                </td>
               </tr>";
      $but2 = "<tr style='text-align:center;'>
        <td>
          <center>
            <form method='post'>
              <input type='hidden' value='".$row['id']."' name='id'>
              <input type='hidden' value='".$row['id_item']."' name='id_item'>
              <input type='hidden' value='".$row['type']."' name='type_item'>
              <input style='padding:0px;margin:0px;width:90px;height:25px;' class='btn_submit' type='submit' value='Снять' name='drop'>
            </form>
            </center>
          </td>
        </tr>";
      echo "
           <table style='width:719px;display:block;border:3px solid #00FF00;'>
           <tr>
            <td colspan='4' style='height:30px;text-align:center;width:180px;border:2px solid DarkViolet;'><b>".$row['name']."</b></td>
           </tr>
           <tr>
            <td rowspan='2' style='text-align:center;width:150px;border:2px solid DarkViolet;'><img src='".$row['pic']."' width=150px height=150px; alt=".$row['name']."/></td>
            <td rowspan='2' style='text-align:center;width:324px;border:2px solid DarkViolet;'>".$row['char']."</td>
            <td style='border:2px solid DarkViolet;width:220px;'>
            <center><table style='text-align:center;'>
            <tr><td style='text-align:center;'>Уровень</td><td>:</td><td>".$row['lvl_item']." Lvl</td></tr>";?>
           <?php if($row['streangth'] > 0) echo "<tr><td>Сила</td><td>:</td><td> +".$row['streangth']."<br></td></tr>"; ?>
           <?php if($row['health'] > 0)    echo "<tr><td>Здоровье</td><td>:</td><td> +".$row['health']."<br></td></tr>"; ?>
           <?php if($row['luck'] > 0)      echo "<tr><td>Удача</td><td>:</td><td> +".$row['luck']."<br></td></tr>"; ?>
           <?php if($row['agility'] > 0)   echo "<tr><td>Подвижность</td><td>:</td><td> +".$row['agility']."<br></td></tr>"; ?>
           <?php if($row['armor'] > 0)     echo "<tr><td>Броня</td><td>:</td><td> +".$row['armor']."<br></td></tr>"; ?>
           <?php if($row['armorpnt'] > 0)  echo "<tr><td>Пробивание Брони</td><td>:</td><td> +".$row['armorpnt']."<br></td></tr>"; ?>
        <?php echo "<tr><th style='text-align:center;'>Дата покупки</th><th>:</th><th> ".$row['servertime']."</th></tr></tr>
                    <tr><th style='text-align:center;'>Цена прожажи</th><th>:</th><th> +".$row['cost']."</th></tr></tr></table></center>";
          if (!($row['servertime'] == $Time['servertime'])) {
          if($row['type'] == 'head')    {if($row['id'] == $wow['id_head'])     {echo $but2;} else echo $buuy;}
          if($row['type'] == 'body')    {if($row['id'] == $wow['id_body'])     {echo $but2;} else echo $buuy;}
          if($row['type'] == 'gloves')  {if($row['id'] == $wow['id_gloves'])   {echo $but2;} else echo $buuy;}
          if($row['type'] == 'falderal'){if($row['id'] == $wow['id_falderal']) {echo $but2;} else echo $buuy;}
          if($row['type'] == 'weapon')  {if($row['id'] == $wow['id_weapon'])   {echo $but2;} else echo $buuy;}
          if($row['type'] == 'pants')   {if($row['id'] == $wow['id_pants'])    {echo $but2;} else echo $buuy;}
          if($row['type'] == 'bag')     {if($row['id'] == $wow['id_bag'])      {echo $but2;} else echo $buuy;}
          if($row['type'] == 'boots')   {if($row['id'] == $wow['id_boots'])    {echo $but2;} else echo $buuy;} 
        }
        else echo "<center><span style='color:blue;'>Продать можно только через день, вы ещё не испробoвали её!</span></center>";
         echo "</table><br>";
         if (($i%1)==0) echo "</tr><tr>"; # По 1 штук в строку
         $i++;
        }
}
?>
</tr></table></div>