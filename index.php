<?php 
$connection = mysqli_connect('localhost','a0160954_bazis','Ghjcnjq2','a0160954_bazis');

if($connection == false)
{
	exit();
}


$output = json_decode(file_get_contents('php://input'),true);
$id = $output['message']['chat']['id'];
$message = $output['message']['text'];
$token = "332809777:AAHjqELf5LmeTgrqxWIp5BxtsTIi9upLsl4";

function sendMessage($token, $id, $message)
{
    file_get_contents("https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $id . "&text=" . $message);
}

switch ($message)
{
    case '/start':
        $message = 'Привет, Хон! Кто лучше?';
        sendMessage($token, $id, $message.KeyboardMenu());
        break;
    case 'Женя':
        $message = 'Правильно, Хон!';
        sendMessage($token, $id, $message);
        break;
    case 'Катя':
        $message = 'Ошибка, Хон!';
        sendMessage($token, $id, $message);
        break;
    default:
        $message = 'ни одна';
        sendMessage($token, $id, $message);
}




file_put_contents("logs.txt",$connection);


function KeyboardMenu(){
    $buttons = [['Женя'],['Катя']];
    $keyboard =json_encode($keyboard = ['keyboard' => $buttons,
        'resize_keyboard' => true,
        'one_time_keyboard' => false,
        'selective' => true]);
    $reply_markup = '&reply_markup=' . $keyboard . '';

    return $reply_markup;
}
