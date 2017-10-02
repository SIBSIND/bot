<?php
$output = json_decode(file_get_contents('php://input'),true);
$id = $output['message']['chat']['id'];
$message = $output['message']['text'];
$token = "332809777:AAHjqELf5LmeTgrqxWIp5BxtsTIi9upLsl4";



function sendMessage($token, $id, $message)
{
    file_get_contents("https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $id . "&text=" . $message);
}

$if = "привет";


sendIf($if, $text, $message, $id, $token)




file_put_contents("logs.txt",$id);


function sendIf($if, $message, $id, $token)
{
    if($message == $if){
        $message = "Пидорасы";
        sendMessage($token, $id, $message);
        return sendMessage($token, $id, $message);
    }
}

function KeyboardMenu(){
    $buttons = [['Паша'],['Ниджат']];
    $keyboard =json_encode($keyboard = ['keyboard' => $buttons,
        'resize_keyboard' => true,
        'one_time_keyboard' => false,
        'selective' => true]);
    $reply_markup = '&reply_markup=' . $keyboard . '';

    return $reply_markup;
}
