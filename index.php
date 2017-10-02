<?php
$output = json_decode(file_get_contents('php://input'),true);
$id = $output['message']['chat']['id'];
$message = $output['message']['text'];
$token = "332809777:AAHjqELf5LmeTgrqxWIp5BxtsTIi9upLsl4";


switch ($message)
{
    case 'белово':
        $message = 'ты выбрал белово, выбери гашиш';
        sendMessage($token, $id, $message);
        
            switch ($message) 
            {
                case 'гашиш':
                $message = 'пизда рублю';
                sendMessage($token, $id, $message);
            }
        
        break;
    default:
        $message = 'Говно';
        sendMessage($token, $id, $message);
}

//sendMessage($token, $id, $message);



function sendMessage($token, $id, $message)
{
    file_get_contents("https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $id . "&text=" . $message);
}

file_put_contents("logs.txt",$id);
