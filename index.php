<?php

$output = json_decode(file_get_contents('php://input'),true);

$id = $output['message']['chat']['id'];

sendMessage($id, "Пидорас ебаный");

file_put_contents("logs.txt",$id);
