<?php
$token = "332809777:AAHjqELf5LmeTgrqxWIp5BxtsTIi9upLsl4";
$output = json_decode(file_get_contents('php://input'),true);

$id = $output['message']['chat']['id'];
$text = $output['message']['text'];

if($text == кто пидор?){
file_get_contents("https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$id."&text=ты пидор");
}

file_put_contents("logs.txt",$id);
