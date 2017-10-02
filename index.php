<?php

$output = json_decode(file_get_contents('php://input'),true);
file_put_contents("logs.txt",$output);
