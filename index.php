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

if($message == $but1){
	$msg = "Вы выбрали "  . "$but1" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but1 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
	$cats1 = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = $botid and `city` = '$but1' and `cat` = '$cat1' limit 1");
	$assoc1 = mysqli_fetch_assoc($cats1);
	$cats2 = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = $botid and `city` = '$but1' and `cat` = '$cat2' limit 1");
	$assoc2 = mysqli_fetch_assoc($cats2);
	$cats3 = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = $botid and `city` = '$but1' and `cat` = '$cat3' limit 1");
	$assoc3 = mysqli_fetch_assoc($cats3);
	$cats4 = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = $botid and `city` = '$but1' and `cat` = '$cat4' limit 1");
	$assoc4 = mysqli_fetch_assoc($cats4);
	$cats5 = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = $botid and `city` = '$but1' and `cat` = '$cat5' limit 1");
	$assoc5 = mysqli_fetch_assoc($cats5);
	$but1 = $assoc1['cat'];
	$but2 =	$assoc2['cat'];
	$but3 = $assoc3['cat'];
	$but4 = $assoc4['cat'];
	$but5 = $assoc5['cat'];
	$but6 = "";
	$but7 = "";
	$but8 = "";
	$but9 = "";
	$but10 = "";
	$but11 = "В главное меню";
	$but12 = "Прайс";
	$but13 = "Помощь";
	sendMessage($token, $id, $msg.KeyboardMenu($but1,$but2,$but3,$but4,$but5,$but6,$but7,$but8,$but9,$but10,$but11,$but12,$but13));
	$check = 1;
}
else if($message == $but2){
	$msg = "Вы выбрали "  . "$but2" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but2 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
	sendMessage($token, $id, $msg);
	$check = 2;
}
else if($message == $but3){
	$msg = "Вы выбрали "  . "$but3" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but3 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
	sendMessage($token, $id, $msg);
	$check = 3;
}
else if($message == $but4){
	$msg = "Вы выбрали "  . "$but4" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but4 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
	sendMessage($token, $id, $msg);
	$check = 4;
}
else if($message == $but5){
	$msg = "Вы выбрали "  . "$but5" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but5 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
	sendMessage($token, $id, $msg);
	$check = 5;
}
else if($message == $but6){
	$msg = "Вы выбрали "  . "$but6" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but6 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
	sendMessage($token, $id, $msg);
	$check = 6;
}
else if($message == $but7){
	$msg = "Вы выбрали "  . "$but7" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but7 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
	sendMessage($token, $id, $msg);
	$check = 7;
}
else if($message == $but8){
	$msg = "Вы выбрали "  . "$but8" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but8 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
	sendMessage($token, $id, $msg);
	$check = 8;
}
else if($message == $but9){
	$msg = "Вы выбрали "  . "$but9" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but9 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
	sendMessage($token, $id, $msg);
	$check = 9;
}
else if($message == $but10){
	$msg = "Вы выбрали "  . "$but10" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but10 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
	sendMessage($token, $id, $msg);
	$check = 10;
}
else if($message == $but11){
	$msg = "Вы выбрали "  . "$but11" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but11 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
	sendMessage($token, $id, $msg);
	$check = 11;
}
else if($message == $but12){
	$msg = "Вы выбрали "  . "$but12" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but12 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
	sendMessage($token, $id, $msg);
	$check = 12;
}
else if($message == $but13){
	$msg = "Вы выбрали "  . "$but13" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but13 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
	sendMessage($token, $id, $msg);
	$check = 13;
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

 function ReplyKeyboardRemove(){
        $removeKeyboard = json_encode($removeKeyboard = ['remove_keyboard' => true]);
        $reply_markup = '&reply_markup=' . $removeKeyboard . '';
        return $reply_markup;
    }
?>
