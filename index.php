<?php
$output = json_decode(file_get_contents('php://input'),true);
$id = $output['message']['chat']['id'];
$message = $output['message']['text'];
$token = "332809777:AAHjqELf5LmeTgrqxWIp5BxtsTIi9upLsl4";


switch ($message)
{
    case "привет":
        sendMessage($token, $id, Ку!);
        break;
    case "пока":
        sendMessage($token, $id, Досвидос!);
        break;
    case "гыгы":
        sendMessage($token, $id, умри!);
        break;
    default:
        sendMessage($token, $id, Что ты несешь?!);
}

//sendMessage($token, $id, $message);



function sendMessage($token, $id, $message)
{
    file_get_contents("https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $id . "&text=" . $message);
}

file_put_contents("logs.txt",$id);
