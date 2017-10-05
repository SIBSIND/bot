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

if( $message == "/start" or $message == "В главное меню")
{
	$msg = $welcome . urlencode("\n\nОтзывы покупателей (нажмите 👉 /otzivi)\nОставить отзыв (нажмите 👉 /otziv)\n\nДля покупки нажмите на свой город внизу:");
	sendMessage($token, $id, $msg.KeyboardMenu($but1,$but2,$but3,$but4,$but5,$but6,$but7,$but8,$but9,$but10,$but11,$but12,$but13));
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
