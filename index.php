<?php

$output = file_get_contents('php://input');
file_put_contents('logs.txt',$output )