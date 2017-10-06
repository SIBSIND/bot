<?php
$connect = mysqli_connect('a0160954.xsph.ru:3306','a0160954_bazis','Ghjcnjq2','a0160954_bazis');
if(!$connect) exit();
$botid = 1;
$output = json_decode(file_get_contents('php://input'),true);
$id = $output['message']['chat']['id'];
$message = $output['message']['text'];
$token = "332809777:AAHjqELf5LmeTgrqxWIp5BxtsTIi9upLsl4";

function sendMessage($token, $id, $message)
{
    file_get_contents("https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $id . "&text=" . $message);
}
	////ГОРОДА////
	$query = mysqli_query($connect, "SELECT * FROM `settings` WHERE `botid` = $botid");
	$fetch = mysqli_fetch_assoc($query);
	$querys = mysqli_query($connect, "SELECT * FROM `city` WHERE `botid` = $botid");
	$fetchs = mysqli_fetch_assoc($querys);
	$welcome = $fetch['welcome'];
	$but1 = $fetchs['but1'];
	$but2 = $fetchs['but2'];
	$but3 = $fetchs['but3'];
	$but4 = $fetchs['but4'];
	$but5 = $fetchs['but5'];
	$but6 = $fetchs['but6'];
	$but7 = $fetchs['but7'];
	$but8 = $fetchs['but8'];
	$but9 = $fetchs['but9'];
	$but10 = $fetchs['but10'];
	$but11 = "В главное меню";
	$but12 = "Прайс";
	$but13 = "Помощь";

	////КАТЕГОРИИ////
	$queryc = mysqli_query($connect, "SELECT * FROM `cat` WHERE `botid` = $botid");
	$fetchc = mysqli_fetch_assoc($queryc);
	$cat1 = $fetchc['cat1'];
	$cat2 = $fetchc['cat2'];
	$cat3 = $fetchc['cat3'];
	$cat4 = $fetchc['cat4'];
	$cat5 = $fetchc['cat5'];

if( $message == "/start" or $message == "В главное меню"){
	$msg = $welcome . urlencode("\n\nОтзывы покупателей (нажмите 👉 /otzivi)\nОставить отзыв (нажмите 👉 /otziv)\n\nДля покупки нажмите на свой город внизу:");
	sendMessage($token, $id, $msg.KeyboardMenu($but1,$but2,$but3,$but4,$but5,$but6,$but7,$but8,$but9,$but10,$but11,$but12,$but13));
}

if($message == $but1)
{
	$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `city` = '$but1' limit 1");
	$row = mysqli_num_rows($query);
	if($row)
	{
	
		$msg = "Вы выбрали "  . "$but1" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but1 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat1' and `city` = '$but1' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat1 = $ass['cat'];
		}else{
		$cat1 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat2' and `city` = '$but1' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat2 = $ass['cat'];
		}else{
		$cat2 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat3' and `city` = '$but1' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat3 = $ass['cat'];
		}else{
		$cat3 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat4' and `city` = '$but1' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat4 = $ass['cat'];
		}else{
		$cat4 = "";
		}

		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat5' and `city` = '$but1' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat5 = $ass['cat'];
		}else{
		$cat5 = "";
		}
		sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
		$check = 228;
	}else
	{
		$cat1 = "";
		$cat2 = "";
		$cat3 = "";
		$cat4 = "";
		$cat5 = "";
		$msg = "В выбранном городе закончились товары, приходите чуть позже.";
		sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
	}
}

else if($message == $but2)
{
	$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `city` = '$but2' limit 1");
	$row = mysqli_num_rows($query);
	if($row)
	{
		$msg = "Вы выбрали "  . "$but2" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but2 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat1' and `city` = '$but2' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat1 = $ass['cat'];
		}else{
		$cat1 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat2' and `city` = '$but2' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat2 = $ass['cat'];
		}else{
		$cat2 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat3' and `city` = '$but2' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat3 = $ass['cat'];
		}else{
		$cat3 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat4' and `city` = '$but2' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat4 = $ass['cat'];
		}else{
		$cat4 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat5' and `city` = '$but2' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat5 = $ass['cat'];
		}else{
		$cat5 = "";
		}
		sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
	}else
	{
		$cat1 = "";
		$cat2 = "";
		$cat3 = "";
		$cat4 = "";
		$cat5 = "";
		$msg = "В выбранном городе закончились товары, приходите чуть позже.";
		sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
	}
}
else if($message == $but3)
{
	$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `city` = '$but3' limit 1");
	$row = mysqli_num_rows($query);
	if($row)
	{
		$msg = "Вы выбрали "  . "$but3" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but3 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat1' and `city` = '$but3' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat1 = $ass['cat'];
		}else{
		$cat1 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat2' and `city` = '$but3' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat2 = $ass['cat'];
		}else{
		$cat2 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat3' and `city` = '$but3' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat3 = $ass['cat'];
		}else{
		$cat3 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat4' and `city` = '$but3' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat4 = $ass['cat'];
		}else{
		$cat4 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat5' and `city` = '$but3' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat5 = $ass['cat'];
		}else{
		$cat5 = "";
		}
		sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
	}else
	{
		$cat1 = "";
		$cat2 = "";
		$cat3 = "";
		$cat4 = "";
		$cat5 = "";
		$msg = "В выбранном городе закончились товары, приходите чуть позже.";
		sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
	}
}
else if($message == $but4)
{
	$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `city` = '$but4' limit 1");
	$row = mysqli_num_rows($query);
	if($row)
	{
		$msg = "Вы выбрали "  . "$but4" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but4 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat1' and `city` = '$but4' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat1 = $ass['cat'];
		}else{
		$cat1 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat2' and `city` = '$but4' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat2 = $ass['cat'];
		}else{
		$cat2 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat3' and `city` = '$but4' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat3 = $ass['cat'];
		}else{
		$cat3 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat4' and `city` = '$but4' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat4 = $ass['cat'];
		}else{
		$cat4 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat5' and `city` = '$but4' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat5 = $ass['cat'];
		}else{
		$cat5 = "";
		}
		sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
	}else
	{
		$cat1 = "";
		$cat2 = "";
		$cat3 = "";
		$cat4 = "";
		$cat5 = "";
		$msg = "В выбранном городе закончились товары, приходите чуть позже.";
		sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
	}
}
if($message == $but5)
{
	$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `city` = '$but5' limit 1");
	$row = mysqli_num_rows($query);
	if($row)
	{
		$msg = "Вы выбрали "  . "$but5" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but5 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat1' and `city` = '$but5' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat1 = $ass['cat'];
		}else{
		$cat1 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat5' and `city` = '$but1' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat2 = $ass['cat'];
		}else{
		$cat2 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat3' and `city` = '$but5' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat3 = $ass['cat'];
		}else{
		$cat3 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat4' and `city` = '$but5' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat4 = $ass['cat'];
		}else{
		$cat4 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat5' and `city` = '$but5' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat5 = $ass['cat'];
		}else{
		$cat5 = "";
		}
		sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
	}else
	{
		$cat1 = "";
		$cat2 = "";
		$cat3 = "";
		$cat4 = "";
		$cat5 = "";
		$msg = "В выбранном городе закончились товары, приходите чуть позже.";
		sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
	}
}
else if($message == $but6)
{
	$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `city` = '$but6' limit 1");
	$row = mysqli_num_rows($query);
	if($row)
	{
		$msg = "Вы выбрали "  . "$but6" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but6 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat1' and `city` = '$but6' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat1 = $ass['cat'];
		}else{
		$cat1 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat2' and `city` = '$but6' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat2 = $ass['cat'];
		}else{
		$cat2 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat3' and `city` = '$but6' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat3 = $ass['cat'];
		}else{
		$cat3 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat4' and `city` = '$but6' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat4 = $ass['cat'];
		}else{
		$cat4 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat5' and `city` = '$but6' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat5 = $ass['cat'];
		}else{
		$cat5 = "";
		}
		sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
	}else
	{
		$cat1 = "";
		$cat2 = "";
		$cat3 = "";
		$cat4 = "";
		$cat5 = "";
		$msg = "В выбранном городе закончились товары, приходите чуть позже.";
		sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
	}
}
if($message == $but7)
{
	$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `city` = '$but7' limit 1");
	$row = mysqli_num_rows($query);
	if($row)
	{
		$msg = "Вы выбрали "  . "$but7" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but7 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat1' and `city` = '$but7' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat1 = $ass['cat'];
		}else{
		$cat1 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat2' and `city` = '$but7' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat2 = $ass['cat'];
		}else{
		$cat2 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat3' and `city` = '$but7' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat3 = $ass['cat'];
		}else{
		$cat3 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat4' and `city` = '$but7' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat4 = $ass['cat'];
		}else{
		$cat4 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat5' and `city` = '$but7' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat5 = $ass['cat'];
		}else{
		$cat5 = "";
		}
		sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
	}else
	{
		$cat1 = "";
		$cat2 = "";
		$cat3 = "";
		$cat4 = "";
		$cat5 = "";
		$msg = "В выбранном городе закончились товары, приходите чуть позже.";
		sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
	}
}
else if($message == $but8)
{
	$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `city` = '$but8' limit 1");
	$row = mysqli_num_rows($query);
	if($row)
	{
		$msg = "Вы выбрали "  . "$but8" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but8 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat1' and `city` = '$but8' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat1 = $ass['cat'];
		}else{
		$cat1 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat2' and `city` = '$but8' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat2 = $ass['cat'];
		}else{
		$cat2 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat3' and `city` = '$but8' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat3 = $ass['cat'];
		}else{
		$cat3 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat4' and `city` = '$but8' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat4 = $ass['cat'];
		}else{
		$cat4 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat5' and `city` = '$but8' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat5 = $ass['cat'];
		}else{
		$cat5 = "";
		}
		sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
	}else
	{
		$cat1 = "";
		$cat2 = "";
		$cat3 = "";
		$cat4 = "";
		$cat5 = "";
		$msg = "В выбранном городе закончились товары, приходите чуть позже.";
		sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
	}
}
else if($message == $but9)
{
	$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `city` = '$but9' limit 1");
	$row = mysqli_num_rows($query);
	if($row)
	{
		$msg = "Вы выбрали "  . "$but9" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but9 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat1' and `city` = '$but9' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat1 = $ass['cat'];
		}else{
		$cat1 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat2' and `city` = '$but9' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat2 = $ass['cat'];
		}else{
		$cat2 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat3' and `city` = '$but9' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat3 = $ass['cat'];
		}else{
		$cat3 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat4' and `city` = '$but9' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat4 = $ass['cat'];
		}else{
		$cat4 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat5' and `city` = '$but9' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat5 = $ass['cat'];
		}else{
		$cat5 = "";
		}
		sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
	}else
	{
		$cat1 = "";
		$cat2 = "";
		$cat3 = "";
		$cat4 = "";
		$cat5 = "";
		$msg = "В выбранном городе закончились товары, приходите чуть позже.";
		sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
	}
}
else if($message == $but10)
{
	$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `city` = '$but10' limit 1");
	$row = mysqli_num_rows($query);
	if($row)
	{
		$msg = "Вы выбрали "  . "$but10" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but10 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat1' and `city` = '$but10' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat1 = $ass['cat'];
		}else{
		$cat1 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat2' and `city` = '$but10' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat2 = $ass['cat'];
		}else{
		$cat2 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat3' and `city` = '$but10' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat3 = $ass['cat'];
		}else{
		$cat3 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat4' and `city` = '$but10' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat4 = $ass['cat'];
		}else{
		$cat4 = "";
		}
		$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat5' and `city` = '$but10' limit 1");
		$row = mysqli_num_rows($query);
		$ass = mysqli_fetch_assoc($query);
		if($row){
		$cat5 = $ass['cat'];
		}else{
		$cat5 = "";
		}
		sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
	}else
	{
		$cat1 = "";
		$cat2 = "";
		$cat3 = "";
		$cat4 = "";
		$cat5 = "";
		$msg = "В выбранном городе закончились товары, приходите чуть позже.";
		sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
	}
}

$queryc = mysqli_query($connect, "SELECT * FROM `cat` WHERE `botid` = $botid");
$fetchc = mysqli_fetch_assoc($queryc);
$cat1 = $fetchc['cat1'];
if($message == $cat1)
{
	$msg = "Вы выбрали Яблоки";
	sendMessage($token, $id, $msg);	
}












file_put_contents("logs.txt",$connection);


function KeyboardMenu($but1,$but2,$but3,$but4,$but5,$but6,$but7,$but8,$but9,$but10,$but11,$but12,$but13){
	$buttons = [[$but1],[$but2],[$but3],[$but4],[$but5],[$but6],[$but7],[$but8],[$but9],[$but10],[$but11],[$but12],[$but13]];
	$keyboard = json_encode($keyboard = ['keyboard' => $buttons,
        'resize_keyboard' => true,
        'one_time_keyboard' => false,
        'selective' => true]);
    $reply_markup = '&reply_markup=' . $keyboard . '';

    return $reply_markup;
}

function KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13){
	$buttons = [[$cat1],[$cat2],[$cat3],[$cat4],[$cat5],[$but11],[$but12],[$but13]];
	$keyboard = json_encode($keyboard = ['keyboard' => $buttons,
        'resize_keyboard' => true,
        'one_time_keyboard' => false,
        'selective' => true]);
    $reply_markup = '&reply_markup=' . $keyboard . '';

    return $reply_markup;
}

 function ReplyKeyboardRemove(){
        $removeKeyboard = json_encode($removeKeyboard = ['remove_keyboard' => true]);
        $reply_markup = '&reply_markup=' . $removeKeyboard . '';
        return $reply_markup;
    }
?>
