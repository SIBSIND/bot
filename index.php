<?php
$host = 'localhost'; // адрес сервера 
$database = 'a0160954_baza'; // имя базы данных
$user = 'a0160954_baza'; // имя пользователя
$password = 'Ghjcnjq2'; // пароль
$connect = mysqli_connect($host, $user, $password, $database) 
    or die();
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
        $message = 'Привет, Хон! Кто пидор больше?';
        sendMessage($token, $id, $message.KeyboardMenu());
        break;
    case 'Паша':
        $message = 'Правильно, Хон!';
        sendMessage($token, $id, $message);
        break;
    case 'Ниджат':
        $message = 'Иди нахуй, Хон!';
        sendMessage($token, $id, $message);
        break;
    default:
        $message = 'Ну и в пизду';
        sendMessage($token, $id, $message);
}




file_put_contents("logs.txt",$id);


function KeyboardMenu(){
    $buttons = [['Паша'],['Ниджат']];
    $keyboard =json_encode($keyboard = ['keyboard' => $buttons,
        'resize_keyboard' => true,
        'one_time_keyboard' => false,
        'selective' => true]);
    $reply_markup = '&reply_markup=' . $keyboard . '';

    return $reply_markup;
}
