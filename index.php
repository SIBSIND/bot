<?php
$connect = mysqli_connect('a0160954.xsph.ru:3306','a0160954_bazis','Ghjcnjq2','a0160954_bazis');
if(!$connect) exit();

$output = json_decode(file_get_contents('php://input'),true);
$id = $output['message']['chat']['id'];
$message = $output['message']['text'];
$token = "353692369:AAG8oKq8id2URz9Xzr8RFGlYOAWFA30A0LI";

function sendMessage($token, $id, $message)
{
    file_get_contents("https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $id . "&text=" . $message);
}

if( $message == "/start" or $message == "В главное меню")
{
	$query = mysqli_query($connect, "SELECT * FROM `settings` WHERE `botid` = 1");
	$fetch = mysqli_fetch_assoc($query);
	$welcome = $fetch['welcome'];
	$msg = $welcome . "Отныне мир будет моим!";
	$but1 = "Пидорасы";
	$but2 = "Хуесосы";
    sendMessage($token, $id, $msg.KeyboardMenu($but1,$but2));
}


file_put_contents("logs.txt",$connection);


function KeyboardMenu($but1,$but2){
    $buttons = [[$but1],[$but2]];
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
