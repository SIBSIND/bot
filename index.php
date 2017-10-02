<?php

$output = json_decode(file_get_contents('php://input'),true);

$text = $output['message']['text'];
file_put_contents("logs.txt",$text);
