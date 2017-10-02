<?php
$output = json_decode(file_get_contents('php://input'),true);
$id = $output['message']['chat']['id'];
$message = $output['message']['text'];
$token = "332809777:AAHjqELf5LmeTgrqxWIp5BxtsTIi9upLsl4";



sendMessage($token, $id, $message);



function sendMessage($token, $id, $message)
{
    file_get_contents("https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $id . "&text=" . $message);
}



switch ($message)
{
    case 'белово':
        $message = 'ты выбрал белово, выбери гашиш';
        sendMessage($token, $id, $message.KeyboardMenu());

    default:
        $message = 'Говно';
        sendMessage($token, $id, $message);
}




file_put_contents("logs.txt",$id);



function KeyboardMenu()
{
    $buttons = [['hi'], ['privet']];
    $keyboard = json_encode($keyboard =
        [
            'keyboard' => $buttons,
            'resize_keyboard' => true,
            'one_time_keyboard' => false,
            'selective' => true
        ]);
    $reply_markup = '&reply_markup = ' . $keyboard . '';
    return $reply_markup;
}
