<?php

$output = json_decode(file_get_contents('php://input'),true);

$id = $output['message']['chat']['id'];

file_get_contents("https://api.telegram.org/bot332809777:AAHjqELf5LmeTgrqxWIp5BxtsTIi9upLsl4/sendMessage?chat_id=".$id."&text=ты пидор");
file_put_contents("logs.txt",$id);
