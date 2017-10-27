<?php
$connect = mysqli_connect('a0160954.xsph.ru:3306','a0160954_bazis','Ghjcnjq2','a0160954_bazis');
if(!$connect) exit();
$botid = 1;
$nomer1 = "79654405539";


global $token = "6d0600a19121b7a5ff6ed03ab7016c93ef53992ec2c1533999c3046c1859bf604478094ba5d6da3733ee3";
$id = "400547697";

sendMessage($id);

function sendMessage($id)
{
    file_get_contents('https://api.vk.com/method/messages.send?user_id=' . $id . '&message=ТУТ%20РУССКИЕ%20БУВЫ%20И%20ПРОБЕЛЫ?&access_token=' . $token);
}

?>
