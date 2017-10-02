<?php
///////////////////////////////////////////

$host = 'localhost'; // адрес сервера 
$database = 'a0160954_baza'; // имя базы данных
$user = 'a0160954_baza'; // имя пользователя
$password = 'Ghjcnjq2'; // пароль

$connect = mysqli_connect($host, $user, $password, $database);
///////////////////////////////////////////

$output = json_decode(file_get_contents('php://input'),true);
$id = $output['message']['chat']['id'];
$message = $output['message']['text'];
$token = "332809777:AAHjqELf5LmeTgrqxWIp5BxtsTIi9upLsl4";

if($message == 'олень')
{
  mysqli_query($connect, "INSERT INTO users (email,pass) VALUES('$message','$id') ");  
  $message = "ящерица";  
  sendMessage($token, $id, $message)
}





file_put_contents("logs.txt",$id);

function sendMessage($token, $id, $message)
{
    file_get_contents("https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $id . "&text=" . $message);
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
