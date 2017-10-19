<?php
$connect = mysqli_connect('a0160954.xsph.ru:3306','a0160954_bazis','Ghjcnjq2','a0160954_bazis');
if(!$connect) exit();
$botid = 1;
$nomer1 = "79832356445";
$output = json_decode(file_get_contents('php://input'),true);
$id = $output['message']['chat']['id'];
$message = $output['message']['text'];
$token = "353692369:AAG8oKq8id2URz9Xzr8RFGlYOAWFA30A0LI";

function sendMessage($token, $id, $message)
{
    file_get_contents("https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $id . "&text=" . $message);
}
    ////ГОРОДА////
    $query = mysqli_query($connect, "SELECT * FROM `settings` WHERE `botid` = $botid");
    $fetch = mysqli_fetch_assoc($query);
    $querys = mysqli_query($connect, "SELECT * FROM `city` WHERE `botid` = $botid");
    $fetchs = mysqli_fetch_assoc($querys);
    $welcome = $fetch['welcome'];
    $but1 = $fetchs['but1'];
    $but2 = $fetchs['but2'];
    $but3 = $fetchs['but3'];
    $but4 = $fetchs['but4'];
    $but5 = $fetchs['but5'];
    $but6 = $fetchs['but6'];
    $but7 = $fetchs['but7'];
    $but8 = $fetchs['but8'];
    $but9 = $fetchs['but9'];
    $but10 = $fetchs['but10'];
    $but11 = "В главное меню";
    $but12 = "Прайс";
    $but13 = "Помощь";

    ////КАТЕГОРИИ////
    $queryc = mysqli_query($connect, "SELECT * FROM `cat` WHERE `botid` = $botid");
    $fetchc = mysqli_fetch_assoc($queryc);
    $cat1 = $fetchc['cat1'];
    $cat2 = $fetchc['cat2'];
    $cat3 = $fetchc['cat3'];
    $cat4 = $fetchc['cat4'];
    $cat5 = $fetchc['cat5'];

    ////ТОВАРЫ////
    $tovar = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = $botid");
    $trow = mysqli_fetch_assoc($queryc);

if( $message == "/start" or $message == "В главное меню")
{
    $queryc = mysqli_query($connect, "SELECT * FROM `users` WHERE `chatid` = $id");
    $row = mysqli_num_rows($queryc);
    if(!$row)
    {
        $comment = rand(1000, 9999);
        mysqli_query($connect, "INSERT INTO `users` (`botid`, `chatid`, `comment`, `city`, `cat`, `tovid`, `fas`) VALUES ('$botid', '$id', '$comment', '0', '0', '0', '0')");
        $msg = $welcome . urlencode("\n\nОтзывы покупателей (нажмите 👉 /otzivi)\nОставить отзыв (нажмите 👉 /otziv)\n\nДля покупки нажмите на свой город внизу:");
        sendMessage($token, $id, $msg.KeyboardMenu($but1,$but2,$but3,$but4,$but5,$but6,$but7,$but8,$but9,$but10,$but11,$but12,$but13));
    }else
    {               
        mysqli_query($connect, "UPDATE `users` SET `cat` = '0', `tovid` = '0', `city` = '0',`region` = '0',`fas` = '0', `price` = '0', `pay` = '0' WHERE `users`.`chatid` = $id");
        $msg = $welcome . urlencode("\n\nОтзывы покупателей (нажмите 👉 /otzivi)\nОставить отзыв (нажмите 👉 /otziv)\n\nДля покупки нажмите на свой город внизу:");
        sendMessage($token, $id, $msg.KeyboardMenu($but1,$but2,$but3,$but4,$but5,$but6,$but7,$but8,$but9,$but10,$but11,$but12,$but13)); 
    }
}


if($message == $but1)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `city` = '$but1' and `sell` = '0' limit 1");
    $row = mysqli_num_rows($query);
    if($row)
    {
        mysqli_query($connect, "UPDATE `users` SET `city` = '1' WHERE `users`.`chatid` = $id ");
        $msg = "Вы выбрали "  . "$but1" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but1 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat1' and `city` = '$but1' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat1 = $ass['cat'];
        }else{
        $cat1 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat2' and `city` = '$but1' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat2 = $ass['cat'];
        }else{
        $cat2 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat3' and `city` = '$but1' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat3 = $ass['cat'];
        }else{
        $cat3 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat4' and `city` = '$but1' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat4 = $ass['cat'];
        }else{
        $cat4 = "";
        }

        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat5' and `city` = '$but1' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat5 = $ass['cat'];
        }else{
        $cat5 = "";
        }
        sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
    }else
    {
        $cat1 = "";
        $cat2 = "";
        $cat3 = "";
        $cat4 = "";
        $cat5 = "";
        $msg = "В выбранном городе закончились товары, приходите чуть позже.";
        sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
    }
}

else if($message == $but2)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid'  and `city` = '$but2' and `sell` = '0' limit 1");
    $row = mysqli_num_rows($query);
    if($row)
    {
        mysqli_query($connect, "UPDATE `users` SET `city` = '2' WHERE `users`.`chatid` = $id");
        $msg = "Вы выбрали "  . "$but2" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but2 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat1' and `city` = '$but2' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat1 = $ass['cat'];
        }else{
        $cat1 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat2' and `city` = '$but2' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat2 = $ass['cat'];
        }else{
        $cat2 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat3' and `city` = '$but2' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat3 = $ass['cat'];
        }else{
        $cat3 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat4' and `city` = '$but2' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat4 = $ass['cat'];
        }else{
        $cat4 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat5' and `city` = '$but2' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat5 = $ass['cat'];
        }else{
        $cat5 = "";
        }
        sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
    }else
    {
        $cat1 = "";
        $cat2 = "";
        $cat3 = "";
        $cat4 = "";
        $cat5 = "";
        $msg = "В выбранном городе закончились товары, приходите чуть позже.";
        sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
    }
}
else if($message == $but3)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `city` = '$but3' and `sell` = '0' limit 1");
    $row = mysqli_num_rows($query);
    if($row)
    {
        mysqli_query($connect, "UPDATE `users` SET `city` = '3' WHERE `users`.`chatid` = $id");
        $msg = "Вы выбрали "  . "$but3" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but3 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat1' and `city` = '$but3' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat1 = $ass['cat'];
        }else{
        $cat1 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat2' and `city` = '$but3' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat2 = $ass['cat'];
        }else{
        $cat2 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat3' and `city` = '$but3' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat3 = $ass['cat'];
        }else{
        $cat3 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat4' and `city` = '$but3' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat4 = $ass['cat'];
        }else{
        $cat4 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat5' and `city` = '$but3' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat5 = $ass['cat'];
        }else{
        $cat5 = "";
        }
        sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
    }else
    {
        $cat1 = "";
        $cat2 = "";
        $cat3 = "";
        $cat4 = "";
        $cat5 = "";
        $msg = "В выбранном городе закончились товары, приходите чуть позже.";
        sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
    }
}
else if($message == $but4)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `city` = '$but4' and `sell` = '0' limit 1");
    $row = mysqli_num_rows($query);
    if($row)
    {
        mysqli_query($connect, "UPDATE `users` SET `city` = '4' WHERE `users`.`chatid` = $id");
        $msg = "Вы выбрали "  . "$but4" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but4 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat1' and `city` = '$but4' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat1 = $ass['cat'];
        }else{
        $cat1 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat2' and `city` = '$but4' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat2 = $ass['cat'];
        }else{
        $cat2 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat3' and `city` = '$but4' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat3 = $ass['cat'];
        }else{
        $cat3 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat4' and `city` = '$but4' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat4 = $ass['cat'];
        }else{
        $cat4 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat5' and `city` = '$but4' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat5 = $ass['cat'];
        }else{
        $cat5 = "";
        }
        sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
    }else
    {
        $cat1 = "";
        $cat2 = "";
        $cat3 = "";
        $cat4 = "";
        $cat5 = "";
        $msg = "В выбранном городе закончились товары, приходите чуть позже.";
        sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
    }
}
if($message == $but5)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `city` = '$but5' and `sell` = '0' limit 1");
    $row = mysqli_num_rows($query);
    if($row)
    {
        mysqli_query($connect, "UPDATE `users` SET `city` = '5' WHERE `users`.`chatid` = $id");
        $msg = "Вы выбрали "  . "$but5" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but5 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat1' and `city` = '$but5' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat1 = $ass['cat'];
        }else{
        $cat1 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat5' and `city` = '$but1' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat2 = $ass['cat'];
        }else{
        $cat2 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat3' and `city` = '$but5' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat3 = $ass['cat'];
        }else{
        $cat3 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat4' and `city` = '$but5' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat4 = $ass['cat'];
        }else{
        $cat4 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat5' and `city` = '$but5' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat5 = $ass['cat'];
        }else{
        $cat5 = "";
        }
        sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
    }else
    {
        $cat1 = "";
        $cat2 = "";
        $cat3 = "";
        $cat4 = "";
        $cat5 = "";
        $msg = "В выбранном городе закончились товары, приходите чуть позже.";
        sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
    }
}
else if($message == $but6)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `city` = '$but6' and `sell` = '0' limit 1");
    $row = mysqli_num_rows($query);
    if($row)
    {
        mysqli_query($connect, "UPDATE `users` SET `city` = '6' WHERE `users`.`chatid` = $id");
        $msg = "Вы выбрали "  . "$but6" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but6 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat1' and `city` = '$but6' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat1 = $ass['cat'];
        }else{
        $cat1 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat2' and `city` = '$but6' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat2 = $ass['cat'];
        }else{
        $cat2 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat3' and `city` = '$but6' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat3 = $ass['cat'];
        }else{
        $cat3 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat4' and `city` = '$but6' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat4 = $ass['cat'];
        }else{
        $cat4 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat5' and `city` = '$but6' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat5 = $ass['cat'];
        }else{
        $cat5 = "";
        }
        sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
    }else
    {
        $cat1 = "";
        $cat2 = "";
        $cat3 = "";
        $cat4 = "";
        $cat5 = "";
        $msg = "В выбранном городе закончились товары, приходите чуть позже.";
        sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
    }
}
if($message == $but7)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `city` = '$but7' and `sell` = '0' limit 1");
    $row = mysqli_num_rows($query);
    if($row)
    {
        mysqli_query($connect, "UPDATE `users` SET `city` = '7' WHERE `users`.`chatid` = $id");
        $msg = "Вы выбрали "  . "$but7" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but7 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat1' and `city` = '$but7' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat1 = $ass['cat'];
        }else{
        $cat1 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat2' and `city` = '$but7' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat2 = $ass['cat'];
        }else{
        $cat2 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat3' and `city` = '$but7' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat3 = $ass['cat'];
        }else{
        $cat3 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat4' and `city` = '$but7' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat4 = $ass['cat'];
        }else{
        $cat4 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat5' and `city` = '$but7' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat5 = $ass['cat'];
        }else{
        $cat5 = "";
        }
        sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
    }else
    {
        $cat1 = "";
        $cat2 = "";
        $cat3 = "";
        $cat4 = "";
        $cat5 = "";
        $msg = "В выбранном городе закончились товары, приходите чуть позже.";
        sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
    }
}
else if($message == $but8)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `city` = '$but8' and `sell` = '0' limit 1");
    $row = mysqli_num_rows($query);
    if($row)
    {
        mysqli_query($connect, "UPDATE `users` SET `city` = '8' WHERE `users`.`chatid` = $id");
        $msg = "Вы выбрали "  . "$but8" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but8 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat1' and `city` = '$but8' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat1 = $ass['cat'];
        }else{
        $cat1 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat2' and `city` = '$but8' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat2 = $ass['cat'];
        }else{
        $cat2 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat3' and `city` = '$but8' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat3 = $ass['cat'];
        }else{
        $cat3 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat4' and `city` = '$but8' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat4 = $ass['cat'];
        }else{
        $cat4 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat5' and `city` = '$but8' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat5 = $ass['cat'];
        }else{
        $cat5 = "";
        }
        sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
    }else
    {
        $cat1 = "";
        $cat2 = "";
        $cat3 = "";
        $cat4 = "";
        $cat5 = "";
        $msg = "В выбранном городе закончились товары, приходите чуть позже.";
        sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
    }
}
else if($message == $but9)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `city` = '$but9' and `sell` = '0' limit 1");
    $row = mysqli_num_rows($query);
    if($row)
    {
        mysqli_query($connect, "UPDATE `users` SET `city` = '9' WHERE `users`.`chatid` = $id");
        $msg = "Вы выбрали "  . "$but9" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but9 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat1' and `city` = '$but9' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat1 = $ass['cat'];
        }else{
        $cat1 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat2' and `city` = '$but9' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat2 = $ass['cat'];
        }else{
        $cat2 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat3' and `city` = '$but9' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat3 = $ass['cat'];
        }else{
        $cat3 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat4' and `city` = '$but9' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat4 = $ass['cat'];
        }else{
        $cat4 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat5' and `city` = '$but9' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat5 = $ass['cat'];
        }else{
        $cat5 = "";
        }
        sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
    }else
    {
        $cat1 = "";
        $cat2 = "";
        $cat3 = "";
        $cat4 = "";
        $cat5 = "";
        $msg = "В выбранном городе закончились товары, приходите чуть позже.";
        sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
    }
}
else if($message == $but10)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `city` = '$but10' and `sell` = '0' limit 1");
    $row = mysqli_num_rows($query);
    if($row)
    {
        mysqli_query($connect, "UPDATE `users` SET `city` = '10' WHERE `users`.`chatid` = $id");
        $msg = "Вы выбрали "  . "$but10" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but10 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите категорию:");
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `cat` = '$cat1' and `city` = '$but10' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat1 = $ass['cat'];
        }else{
        $cat1 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat2' and `city` = '$but10' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat2 = $ass['cat'];
        }else{
        $cat2 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat3' and `city` = '$but10' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat3 = $ass['cat'];
        }else{
        $cat3 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat4' and `city` = '$but10' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat4 = $ass['cat'];
        }else{
        $cat4 = "";
        }
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `sell` = '0' and `cat` = '$cat5' and `city` = '$but10' limit 1");
        $row = mysqli_num_rows($query);
        $ass = mysqli_fetch_assoc($query);
        if($row){
        $cat5 = $ass['cat'];
        }else{
        $cat5 = "";
        }
        sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
    }else
    {
        $cat1 = "";
        $cat2 = "";
        $cat3 = "";
        $cat4 = "";
        $cat5 = "";
        $msg = "В выбранном городе закончились товары, приходите чуть позже.";
        sendMessage($token, $id, $msg.KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13));
    }
}

$queryuser = mysqli_query($connect, "SELECT `city` FROM `users` WHERE `chatid` = $id");
$rowuser = mysqli_fetch_assoc($queryuser);
$citypage = $rowuser['city'];
$catpage = $rowuser['cat'];
$tovpage = $rowuser['tovid'];

$queryc = mysqli_query($connect, "SELECT * FROM `cat` WHERE `botid` = $botid");
$fetchc = mysqli_fetch_assoc($queryc);
$cat1 = $fetchc['cat1'];
$cat2 = $fetchc['cat2'];
$cat3 = $fetchc['cat3'];
$cat4 = $fetchc['cat4'];
$cat5 = $fetchc['cat5'];
if($citypage == 1 and $message == $cat1)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `sell` = '0' and `botid` = '$botid' and `city`='$but1' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `sell` = '0' and `botid` = '$botid' and `city`='$but1' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `sell` = '0' and `botid` = '$botid' and `city`='$but1' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `sell` = '0' and `botid` = '$botid' and `city`='$but1' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `sell` = '0' and `botid` = '$botid' and `city`='$but1' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}


    mysqli_query($connect, "UPDATE `users` SET `cat` = '1' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat1" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but1 . urlencode("\nКАТЕГОРИЯ: ") . $cat1 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));  
}
else if($citypage == 1 and $message == $cat2)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `sell` = '0' and `botid` = '$botid' and `city`='$but1' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `sell` = '0' and `botid` = '$botid' and `city`='$but1' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `sell` = '0' and `botid` = '$botid' and `city`='$but1' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `sell` = '0' and `botid` = '$botid' and `city`='$but1' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `sell` = '0' and `botid` = '$botid' and `city`='$but1' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '2' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat2" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but1 . urlencode("\nКАТЕГОРИЯ: ") . $cat2 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));  
}
else if($citypage == 1 and $message == $cat3)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `sell` = '0' and `botid` = '$botid' and `city`='$but1' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `sell` = '0' and `botid` = '$botid' and `city`='$but1' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `sell` = '0' and `botid` = '$botid' and `city`='$but1' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `sell` = '0' and `botid` = '$botid' and `city`='$but1' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `sell` = '0' and `botid` = '$botid' and `city`='$but1' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '3' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat3" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but1 . urlencode("\nКАТЕГОРИЯ: ") . $cat3 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}
else if($citypage == 1 and $message == $cat4)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `sell` = '0' and `botid` = '$botid' and `city`='$but1' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `sell` = '0' and `botid` = '$botid' and `city`='$but1' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `sell` = '0' and `botid` = '$botid' and `city`='$but1' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `sell` = '0' and `botid` = '$botid' and `city`='$but1' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `sell` = '0' and `botid` = '$botid' and `city`='$but1' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '4' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat4" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but1 . urlencode("\nКАТЕГОРИЯ: ") . $cat4 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}
else if($citypage == 1 and $message == $cat5)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `sell` = '0' and `botid` = '$botid' and `city`='$but1' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `sell` = '0' and `botid` = '$botid' and `city`='$but1' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `sell` = '0' and `botid` = '$botid' and `city`='$but1' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `sell` = '0' and `botid` = '$botid' and `city`='$but1' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `sell` = '0' and `botid` = '$botid' and `city`='$but1' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '5' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat5" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but1 . urlencode("\nКАТЕГОРИЯ: ") . $cat5 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}



else if($citypage == 2 and $message == $cat1)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `sell` = '0' and `botid` = '$botid' and `city`='$but2' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `sell` = '0' and `botid` = '$botid' and `city`='$but2' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `sell` = '0' and `botid` = '$botid' and `city`='$but2' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `sell` = '0' and `botid` = '$botid' and `city`='$but2' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `sell` = '0' and `botid` = '$botid' and `city`='$but2' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '1' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat1" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but2 . urlencode("\nКАТЕГОРИЯ: ") . $cat1 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}
else if($citypage == 2 and $message == $cat2)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `sell` = '0' and `botid` = '$botid' and `city`='$but2' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `sell` = '0' and `botid` = '$botid' and `city`='$but2' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `sell` = '0' and `botid` = '$botid' and `city`='$but2' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `sell` = '0' and `botid` = '$botid' and `city`='$but2' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `sell` = '0' and `botid` = '$botid' and `city`='$but2' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '2' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat2" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but2 . urlencode("\nКАТЕГОРИЯ: ") . $cat2 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));  
}
else if($citypage == 2 and $message == $cat3)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `sell` = '0' and `botid` = '$botid' and `city`='$but2' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `sell` = '0' and `botid` = '$botid' and `city`='$but2' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `sell` = '0' and `botid` = '$botid' and `city`='$but2' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `sell` = '0' and `botid` = '$botid' and `city`='$but2' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `sell` = '0' and `botid` = '$botid' and `city`='$but2' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '3' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat3" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but2 . urlencode("\nКАТЕГОРИЯ: ") . $cat3 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}
else if($citypage == 2 and $message == $cat4)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `sell` = '0' and `botid` = '$botid' and `city`='$but2' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `sell` = '0' and `botid` = '$botid' and `city`='$but2' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `sell` = '0' and `botid` = '$botid' and `city`='$but2' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `sell` = '0' and `botid` = '$botid' and `city`='$but2' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `sell` = '0' and `botid` = '$botid' and `city`='$but2' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '4' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat4" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but2 . urlencode("\nКАТЕГОРИЯ: ") . $cat4 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}
else if($citypage == 2 and $message == $cat5)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `sell` = '0' and `botid` = '$botid' and `city`='$but2' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `sell` = '0' and `botid` = '$botid' and `city`='$but2' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `sell` = '0' and `botid` = '$botid' and `city`='$but2' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `sell` = '0' and `botid` = '$botid' and `city`='$but2' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `sell` = '0' and `botid` = '$botid' and `city`='$but2' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '5' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat5" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but2 . urlencode("\nКАТЕГОРИЯ: ") . $cat5 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}


else if($citypage == 3 and $message == $cat1)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but3' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but3' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but3' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but3' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but3' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '1' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat1" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but3 . urlencode("\nКАТЕГОРИЯ: ") . $cat1 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}
else if($citypage == 3 and $message == $cat2)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but3' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but3' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but3' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but3' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but3' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '2' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat2" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but3 . urlencode("\nКАТЕГОРИЯ: ") . $cat2 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}
else if($citypage == 3 and $message == $cat3)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but3' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but3' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but3' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but3' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but3' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '3' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat3" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but3 . urlencode("\nКАТЕГОРИЯ: ") . $cat3 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));  
}
else if($citypage == 3 and $message == $cat4)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but3' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but3' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but3' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but3' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but3' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '4' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat4" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but3 . urlencode("\nКАТЕГОРИЯ: ") . $cat4 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));  
}
else if($citypage == 3 and $message == $cat5)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but3' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but3' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but3' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but3' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but3' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '5' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat5" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but3 . urlencode("\nКАТЕГОРИЯ: ") . $cat5 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}


else if($citypage == 4 and $message == $cat1)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but4' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but4' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but4' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but4' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but4' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '1' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat1" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but4 . urlencode("\nКАТЕГОРИЯ: ") . $cat1 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}
else if($citypage == 4 and $message == $cat2)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but4' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but4' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but4' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but4' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but4' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '2' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat2" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but4 . urlencode("\nКАТЕГОРИЯ: ") . $cat2 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}
else if($citypage == 4 and $message == $cat3)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but4' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but4' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but4' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but4' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but4' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '3' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat3" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but4 . urlencode("\nКАТЕГОРИЯ: ") . $cat3 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));  
}
else if($citypage == 4 and $message == $cat4)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but4' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but4' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but4' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but4' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but4' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '4' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat4" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but4 . urlencode("\nКАТЕГОРИЯ: ") . $cat4 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));  
}
else if($citypage == 4 and $message == $cat5)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but4' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but4' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but4' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but4' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but4' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '5' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat5" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but4 . urlencode("\nКАТЕГОРИЯ: ") . $cat5 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}


else if($citypage == 5 and $message == $cat1)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but5' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but5' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but5' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but5' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but5' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '1' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat1" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but5 . urlencode("\nКАТЕГОРИЯ: ") . $cat1 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}
else if($citypage == 5 and $message == $cat2)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but5' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but5' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but5' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but5' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but5' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '2' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat2" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but5 . urlencode("\nКАТЕГОРИЯ: ") . $cat2 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}
else if($citypage == 5 and $message == $cat3)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but5' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but5' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but5' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but5' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but5' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '3' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat3" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but5 . urlencode("\nКАТЕГОРИЯ: ") . $cat3 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}
else if($citypage == 5 and $message == $cat4)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but5' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but5' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but5' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but5' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but5' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '4' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat4" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but5 . urlencode("\nКАТЕГОРИЯ: ") . $cat4 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}
else if($citypage == 5 and $message == $cat5)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but5' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but5' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but5' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but5' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but5' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '5' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat5" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but5 . urlencode("\nКАТЕГОРИЯ: ") . $cat5 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}


else if($citypage == 6 and $message == $cat1)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but6' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but6' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but6' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but6' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but6' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '1' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat1" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but6 . urlencode("\nКАТЕГОРИЯ: ") . $cat1 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}
else if($citypage == 6 and $message == $cat2)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but6' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but6' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but6' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but6' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but6' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '2' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat2" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but6 . urlencode("\nКАТЕГОРИЯ: ") . $cat2 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}
else if($citypage == 6 and $message == $cat3)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but6' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but6' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but6' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but6' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but6' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '3' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat3" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but6 . urlencode("\nКАТЕГОРИЯ: ") . $cat3 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}
else if($citypage == 6 and $message == $cat4)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but6' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but6' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but6' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but6' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but6' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '4' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat4" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but6 . urlencode("\nКАТЕГОРИЯ: ") . $cat4 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}
else if($citypage == 6 and $message == $cat5)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but6' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but6' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but6' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but6' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but6' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '5' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat5" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but6 . urlencode("\nКАТЕГОРИЯ: ") . $cat5 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));  
}


else if($citypage == 7 and $message == $cat1)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but7' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but7' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but7' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but7' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but7' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '1' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat1" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but7 . urlencode("\nКАТЕГОРИЯ: ") . $cat1 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}
else if($citypage == 7 and $message == $cat2)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but7' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but7' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but7' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but7' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but7' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '2' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat2" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but7 . urlencode("\nКАТЕГОРИЯ: ") . $cat2 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));  
}
else if($citypage == 7 and $message == $cat3)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but7' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but7' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but7' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but7' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but7' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '3' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat3" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but7 . urlencode("\nКАТЕГОРИЯ: ") . $cat3 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}
else if($citypage == 7 and $message == $cat4)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but7' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but7' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but7' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but7' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but7' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '4' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat4" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but7 . urlencode("\nКАТЕГОРИЯ: ") . $cat4 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}
else if($citypage == 7 and $message == $cat5)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but7' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but7' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but7' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but7' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but7' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '5' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat5" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but7 . urlencode("\nКАТЕГОРИЯ: ") . $cat5 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}


else if($citypage == 8 and $message == $cat1)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but8' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but8' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but8' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but8' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but8' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '1' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat1" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but8 . urlencode("\nКАТЕГОРИЯ: ") . $cat1 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}
else if($citypage == 8 and $message == $cat2)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but8' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but8' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but8' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but8' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but8' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '2' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat2" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but8 . urlencode("\nКАТЕГОРИЯ: ") . $cat2 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}
else if($citypage == 8 and $message == $cat3)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but8' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but8' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but8' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but8' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but8' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '3' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat3" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but9 . urlencode("\nКАТЕГОРИЯ: ") . $cat3 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));  
}
else if($citypage == 8 and $message == $cat4)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but8' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but8' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but8' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but8' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but8' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '4' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat4" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but9 . urlencode("\nКАТЕГОРИЯ: ") . $cat4 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));  
}
else if($citypage == 8 and $message == $cat5)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but8' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but8' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but8' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but8' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but8' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '5' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat5" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but9 . urlencode("\nКАТЕГОРИЯ: ") . $cat5 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}


else if($citypage == 9 and $message == $cat1)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but9' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but9' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but9' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but9' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but9' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '1' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat1" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but9 . urlencode("\nКАТЕГОРИЯ: ") . $cat1 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));  
}
else if($citypage == 9 and $message == $cat2)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but9' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but9' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but9' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but9' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but9' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '2' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat2" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but9 . urlencode("\nКАТЕГОРИЯ: ") . $cat2 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}
else if($citypage == 9 and $message == $cat3)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but9' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but9' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but9' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but9' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but9' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '3' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat3" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but9 . urlencode("\nКАТЕГОРИЯ: ") . $cat3 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));  
}
else if($citypage == 9 and $message == $cat4)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but9' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but9' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but9' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but9' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but9' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '4' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat4" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but9 . urlencode("\nКАТЕГОРИЯ: ") . $cat4 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}
else if($citypage == 9 and $message == $cat5)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but9' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but9' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but9' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but9' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but9' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '5' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat5" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but9 . urlencode("\nКАТЕГОРИЯ: ") . $cat5 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));  
}


else if($citypage == 10 and $message == $cat1)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but10' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but10' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but10' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but10' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat1' and `botid` = '$botid' and `city`='$but10' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '1' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat1" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but10 . urlencode("\nКАТЕГОРИЯ: ") . $cat1 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}
else if($citypage == 10 and $message == $cat2)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but10' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but10' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but10' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but10' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat2' and `botid` = '$botid' and `city`='$but10' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '2' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat2" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but10 . urlencode("\nКАТЕГОРИЯ: ") . $cat2 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}
else if($citypage == 10 and $message == $cat3)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but10' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but10' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but10' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but10' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat3' and `botid` = '$botid' and `city`='$but10' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '3' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat3" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but10 . urlencode("\nКАТЕГОРИЯ: ") . $cat3 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}
else if($citypage == 10 and $message == $cat4)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but10' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but10' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but10' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but10' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat4' and `botid` = '$botid' and `city`='$but10' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '4' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat4" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but10 . urlencode("\nКАТЕГОРИЯ: ") . $cat4 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));
}
else if($citypage == 10 and $message == $cat5)
{
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but10' and `tovid` = 1");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov1 = $row['name'];}else {$tov1 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but10' and `tovid` = 2");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov2 = $row['name'];}else {$tov2 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but10' and `tovid` = 3");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov3 = $row['name'];}else {$tov3 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but10' and `tovid` = 4");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov4 = $row['name'];}else {$tov4 = "";}
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `cat` = '$cat5' and `botid` = '$botid' and `city`='$but10' and `tovid` = 5");
    $rows = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    if($rows){$tov5 = $row['name'];}else {$tov5 = "";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `cat` = '5' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . "$cat5" . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $but10 . urlencode("\nКАТЕГОРИЯ: ") . $cat5 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите товар:");
    sendMessage($token, $id, $msg.KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13));  
}


$queryuser = mysqli_query($connect, "SELECT * FROM `users` WHERE `chatid` = $id");
$rowuser = mysqli_fetch_assoc($queryuser);
$city = $rowuser['city'];
$cat = $rowuser['cat'];
$tovid = $rowuser['tovid'];
$categ = $rowuser['cat'];
$fas = $rowuser['fas'];

$query = mysqli_query($connect, "SELECT * FROM `tovname` WHERE `tovid` = '1' and `botid` = '$botid'");
$rows = mysqli_fetch_assoc($query);
$tovname1 = $rows['name'];

$query = mysqli_query($connect, "SELECT * FROM `tovname` WHERE `tovid` = '2' and `botid` = '$botid'");
$rows = mysqli_fetch_assoc($query);
$tovname2 = $rows['name'];

$query = mysqli_query($connect, "SELECT * FROM `tovname` WHERE `tovid` = '3' and `botid` = '$botid'");
$rows = mysqli_fetch_assoc($query);
$tovname3 = $rows['name'];

$query = mysqli_query($connect, "SELECT * FROM `tovname` WHERE `tovid` = '4' and `botid` = '$botid'");
$rows = mysqli_fetch_assoc($query);
$tovname4 = $rows['name'];

$query = mysqli_query($connect, "SELECT * FROM `tovname` WHERE `tovid` = '5' and `botid` = '$botid'");
$rows = mysqli_fetch_assoc($query);
$tovname5 = $rows['name'];

$query1 = mysqli_query($connect, "SELECT * FROM `fas` WHERE `fasid` = 1 and `botid` = $botid");
$row = mysqli_fetch_assoc($query1);
$fasname1 = $row['fas'];
$query2 = mysqli_query($connect, "SELECT * FROM `fas` WHERE `fasid` = 2 and `botid` = $botid");
$row = mysqli_fetch_assoc($query2);
$fasname2 = $row['fas'];
$query3 = mysqli_query($connect, "SELECT * FROM `fas` WHERE `fasid` = 3 and `botid` = $botid");
$row = mysqli_fetch_assoc($query3);
$fasname3 = $row['fas'];

if($city == 1){$city = $but1;}
else if($city == 2){$city = $but2;}
else if($city == 3){$city = $but3;}
else if($city == 4){$city = $but4;}
else if($city == 5){$city = $but5;}
else if($city == 6){$city = $but6;}
else if($city == 7){$city = $but7;}
else if($city == 8){$city = $but8;}
else if($city == 9){$city = $but9;}
else if($city == 10){$city = $but10;}

if($cat == 1){$cat = $cat1;}
else if($cat == 2){$cat = $cat2;}
else if($cat == 3){$cat = $cat3;}
else if($cat == 4){$cat = $cat4;}
else if($cat == 5){$cat = $cat5;}



if($message == $tovname1 and $categ > 0)
{
    $query1 = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `city` = '$city' and `cat` = '$cat' and `name` = '$tovname1' and `botid` = '$botid' and `fas` = '$fasname1'");
    $row1 = mysqli_num_rows($query1);
    $fetch1 = mysqli_fetch_assoc($query1);
    $price1 = $fetch1['price'];
    if($row1){$fas1 = $fasname1 . " г за " . $price1 . " руб";}else {$fas1 = "";}
    
    $query2 = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `city` = '$city' and `cat` = '$cat' and `name` = '$tovname1' and `botid` = '$botid' and `fas` = '$fasname2'");
    $row2 = mysqli_num_rows($query2);
    $fetch2 = mysqli_fetch_assoc($query2);
    $price2 = $fetch2['price'];
    if($row2){$fas2 = $fasname2 . " г за " . $price2 . " руб";}else {$fas2 = "";}

    $query3 = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `city` = '$city' and `cat` = '$cat' and `name` = '$tovname1' and `botid` = '$botid' and `fas` = '$fasname3'");
    $row3 = mysqli_num_rows($query3);
    $fetch3 = mysqli_fetch_assoc($query3);
    $price3 = $fetch3['price'];
    if($row3){$fas3 = $fasname3 . " г за " . $price3 . " руб";}else {$fas3="";}
    
    mysqli_query($connect, "UPDATE `users` SET `tovid` = '1' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . $tovname1 . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $city . urlencode("\nКАТЕГОРИЯ: ") . $cat . urlencode("\nТОВАР: ") . $tovname1 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите фасовку:");
    $buytovar1 = $fas1;
    $buytovar2 = $fas2;
    $buytovar3 = $fas3;
    sendMessage($token, $id, $msg.KeyboardMenuFas($fas1, $fas2, $fas3, $but11, $but12, $but13));
}
if($message == $tovname2 and $categ > 0)
{   
    $query1 = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `city` = '$city' and `cat` = '$cat' and `name` = '$tovname2' and `botid` = '$botid' and `fas` = '$fasname1'");
    $row1 = mysqli_num_rows($query1);
    $fetch1 = mysqli_fetch_assoc($query1);
    $price1 = $fetch1['price'];
    if($row1){$fas1 = $fasname1 . " г за " . $price1 . " руб";}else {$fas1 = "";}
    
    $query2 = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `city` = '$city' and `cat` = '$cat' and `name` = '$tovname2' and `botid` = '$botid' and `fas` = '$fasname2'");
    $row2 = mysqli_num_rows($query2);
    $fetch2 = mysqli_fetch_assoc($query2);
    $price2 = $fetch2['price'];
    if($row2){$fas2 = $fasname2 . " г за " . $price2 . " руб";}else {$fas2 = "";}

    $query3 = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `city` = '$city' and `cat` = '$cat' and `name` = '$tovname2' and `botid` = '$botid' and `fas` = '$fasname3'");
    $row3 = mysqli_num_rows($query3);
    $fetch3 = mysqli_fetch_assoc($query3);
    $price3 = $fetch3['price'];
    if($row3){$fas3 = $fasname3 . " г за " . $price3 . " руб";}else {$fas3="";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `tovid` = '2' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . $tovname2 . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $city . urlencode("\nКАТЕГОРИЯ: ") . $cat . urlencode("\nТОВАР: ") . $tovname2 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите фасовку:");
    $buytovar4 = $fas1;
    $buytovar5 = $fas2;
    $buytovar6 = $fas3;
    sendMessage($token, $id, $msg.KeyboardMenuFas($fas1, $fas2, $fas3, $but11, $but12, $but13));
}
if($message == $tovname3 and $categ > 0)
{
    $query1 = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `city` = '$city' and `cat` = '$cat' and `name` = '$tovname3' and `botid` = '$botid' and `fas` = '$fasname1'");
    $row1 = mysqli_num_rows($query1);
    $fetch1 = mysqli_fetch_assoc($query1);
    $price1 = $fetch1['price'];
    if($row1){$fas1 = $fasname1 . " г за " . $price1 . " руб";}else {$fas1 = "";}
    
    $query2 = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `city` = '$city' and `cat` = '$cat' and `name` = '$tovname3' and `botid` = '$botid' and `fas` = '$fasname2'");
    $row2 = mysqli_num_rows($query2);
    $fetch2 = mysqli_fetch_assoc($query2);
    $price2 = $fetch2['price'];
    if($row2){$fas2 = $fasname2 . " г за " . $price2 . " руб";}else {$fas2 = "";}

    $query3 = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `city` = '$city' and `cat` = '$cat' and `name` = '$tovname3' and `botid` = '$botid' and `fas` = '$fasname3'");
    $row3 = mysqli_num_rows($query3);
    $fetch3 = mysqli_fetch_assoc($query3);
    $price3 = $fetch3['price'];
    if($row3){$fas3 = $fasname3 . " г за " . $price3 . " руб";}else {$fas3="";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `tovid` = '3' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . $tovname3 . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $city . urlencode("\nКАТЕГОРИЯ: ") . $cat . urlencode("\nТОВАР: ") . $tovname3 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите фасовку:");

    sendMessage($token, $id, $msg.KeyboardMenuFas($fas1, $fas2, $fas3, $but11, $but12, $but13));
}
if($message == $tovname4 and $categ > 0)
{
    $query1 = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `city` = '$city' and `cat` = '$cat' and `name` = '$tovname4' and `botid` = '$botid' and `fas` = '$fasname1'");
    $row1 = mysqli_num_rows($query1);
    $fetch1 = mysqli_fetch_assoc($query1);
    $price1 = $fetch1['price'];
    if($row1){$fas1 = $fasname1 . " г за " . $price1 . " руб" . "г за " . "";}else {$fas1 = "";}
    
    $query2 = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `city` = '$city' and `cat` = '$cat' and `name` = '$tovname4' and `botid` = '$botid' and `fas` = '$fasname2'");
    $row2 = mysqli_num_rows($query2);
    $fetch2 = mysqli_fetch_assoc($query2);
    $price2 = $fetch2['price'];
    if($row2){$fas2 = $fasname2 . " г за " . $price2 . " руб";}else {$fas2 = "";}

    $query3 = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `city` = '$city' and `cat` = '$cat' and `name` = '$tovname4' and `botid` = '$botid' and `fas` = '$fasname3'");
    $row3 = mysqli_num_rows($query3);
    $fetch3 = mysqli_fetch_assoc($query3);
    $price3 = $fetch3['price'];
    if($row3){$fas3 = $fasname3 . " г за " . $price3 . " руб";}else {$fas3="";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `tovid` = '4' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . $tovname4 . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $city . urlencode("\nКАТЕГОРИЯ: ") . $cat . urlencode("\nТОВАР: ") . $tovname4 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите фасовку:");

    sendMessage($token, $id, $msg.KeyboardMenuFas($fas1, $fas2, $fas3, $but11, $but12, $but13));
}
if($message == $tovname5 and $categ > 0)
{
    $query1 = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `city` = '$city' and `cat` = '$cat' and `name` = '$tovname5' and `botid` = '$botid' and `fas` = '$fasname1'");
    $row1 = mysqli_num_rows($query1);
    $fetch1 = mysqli_fetch_assoc($query1);
    $price1 = $fetch1['price'];
    if($row1){$fas1 = $fasname1 . " г за " . $price1 . " руб";}else {$fas1 = "";}
    
    $query2 = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `city` = '$city' and `cat` = '$cat' and `name` = '$tovname5' and `botid` = '$botid' and `fas` = '$fasname2'");
    $row2 = mysqli_num_rows($query2);
    $fetch2 = mysqli_fetch_assoc($query2);
    $price2 = $fetch2['price'];
    if($row2){$fas2 = $fasname2 . " г за " . $price2 . " руб";}else {$fas2 = "";}

    $query3 = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `city` = '$city' and `cat` = '$cat' and `name` = '$tovname5' and `botid` = '$botid' and `fas` = '$fasname3'");
    $row3 = mysqli_num_rows($query3);
    $fetch3 = mysqli_fetch_assoc($query3);
    $price3 = $fetch3['price'];
    if($row3){$fas3 = $fasname3 . " г за " . $price3 . " руб";}else {$fas3="";}
    
    
    mysqli_query($connect, "UPDATE `users` SET `tovid` = '5' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . $tovname5 . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $city . urlencode("\nКАТЕГОРИЯ: ") . $cat . urlencode("\nТОВАР: ") . $tovname5 . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите фасовку:");

    sendMessage($token, $id, $msg.KeyboardMenuFas($fas1, $fas2, $fas3, $but11, $but12, $but13));
}

$mes = (float)$message;




if($mes == $fasname1 and $tovid > 0 )
{   
$selectfas1 = $message;
$queryqq = mysqli_query($connect, "SELECT * FROM `users` WHERE `chatid` = $id");
$rowqq = mysqli_fetch_assoc($queryqq);
$tovid = $rowqq['tovid'];
if($tovid == 1){$tov = $tovname1;}
else if($tovid == 2){$tov = $tovname2;}
else if($tovid == 3){$tov = $tovname3;}
else if($tovid == 4){$tov = $tovname4;}
else if($tovid == 5){$tov = $tovname5;}
    
$msg = "Вы выбрали "  . $message . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $city . urlencode("\nКАТЕГОРИЯ: ") . $cat . urlencode("\nТОВАР: ") . $tov . urlencode("\nФАСОВКА: ") . $message . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите район:");
    
    
$query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 1");
$row = mysqli_fetch_assoc($query);
$regname1 = $row['reg'];
$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `region` = '$regname1' and `city` = '$city' and `fas` = '$fasname1' and `tovid` = '$tovid' and `cat` = '$cat' limit 1");   
$row = mysqli_num_rows($query);
if($row){$reg1 = $regname1;}else {$reg1 = "";}
    
$query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 2");
$row = mysqli_fetch_assoc($query);
$regname2 = $row['reg'];
$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `region` = '$regname2' and `city` = '$city' and `fas` = '$fasname1' and `tovid` = '$tovid' and `cat` = '$cat' limit 1");   
$row = mysqli_num_rows($query);
if($row){$reg2 = $regname2;}else {$reg2 = "";}

$query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 3");
$row = mysqli_fetch_assoc($query);
$regname3 = $row['reg'];
$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `region` = '$regname3' and `city` = '$city' and `fas` = '$fasname1' and `tovid` = '$tovid' and `cat` = '$cat' limit 1");   
$row = mysqli_num_rows($query);
if($row){$reg3 = $regname3;}else {$reg3 = "";}

$query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 4");
$row = mysqli_fetch_assoc($query);
$regname4 = $row['reg'];
$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `region` = '$regname4' and `city` = '$city' and `fas` = '$fasname1' and `tovid` = '$tovid' and `cat` = '$cat' limit 1");   
$row = mysqli_num_rows($query);
if($row){$reg4 = $regname4;}else {$reg4 = "";}

$query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 5");
$row = mysqli_fetch_assoc($query);
$regname5 = $row['reg'];
$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `region` = '$regname5' and `city` = '$city' and `fas` = '$fasname1' and `tovid` = '$tovid' and `cat` = '$cat' limit 1");   
$row = mysqli_num_rows($query);
if($row){$reg5 = $regname5;}else {$reg5 = "";}
    
mysqli_query($connect, "UPDATE `users` SET `fas` = '1' WHERE `users`.`chatid` = $id");
sendMessage($token, $id, $msg.KeyboardMenuReg($reg1, $reg2, $reg3, $reg4, $reg5, $but11, $but12, $but13));
}
else if($mes == $fasname2 and $tovid > 0)
{
$queryqq = mysqli_query($connect, "SELECT * FROM `users` WHERE `chatid` = $id");
$rowqq = mysqli_fetch_assoc($queryqq);
$tovid = $rowqq['tovid'];
if($tovid == 1){$tov = $tovname1;}
else if($tovid == 2){$tov = $tovname2;}
else if($tovid == 3){$tov = $tovname3;}
else if($tovid == 4){$tov = $tovname4;}
else if($tovid == 5){$tov = $tovname5;}
    
$msg = "Вы выбрали "  . $message . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $city . urlencode("\nКАТЕГОРИЯ: ") . $cat . urlencode("\nТОВАР: ") . $tov . urlencode("\nФАСОВКА: ") . $message . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите район:");
    
    
$query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 1");
$row = mysqli_fetch_assoc($query);
$regname1 = $row['reg'];
$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `region` = '$regname1' and `city` = '$city' and `fas` = '$fasname2' and `tovid` = '$tovid' and `cat` = '$cat' limit 1");   
$row = mysqli_num_rows($query);
if($row){$reg1 = $regname1;}else {$reg1 = "";}
    
$query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 2");
$row = mysqli_fetch_assoc($query);
$regname2 = $row['reg'];
$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `region` = '$regname2' and `city` = '$city' and `fas` = '$fasname2' and `tovid` = '$tovid' and `cat` = '$cat' limit 1");   
$row = mysqli_num_rows($query);
if($row){$reg2 = $regname2;}else {$reg2 = "";}

$query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 3");
$row = mysqli_fetch_assoc($query);
$regname3 = $row['reg'];
$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `region` = '$regname3' and `city` = '$city' and `fas` = '$fasname2' and `tovid` = '$tovid' and `cat` = '$cat' limit 1");   
$row = mysqli_num_rows($query);
if($row){$reg3 = $regname3;}else {$reg3 = "";}

$query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 4");
$row = mysqli_fetch_assoc($query);
$regname4 = $row['reg'];
$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `region` = '$regname4' and `city` = '$city' and `fas` = '$fasname2' and `tovid` = '$tovid' and `cat` = '$cat' limit 1");   
$row = mysqli_num_rows($query);
if($row){$reg4 = $regname4;}else {$reg4 = "";}

$query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 5");
$row = mysqli_fetch_assoc($query);
$regname5 = $row['reg'];
$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `region` = '$regname5' and `city` = '$city' and `fas` = '$fasname2' and `tovid` = '$tovid' and `cat` = '$cat' limit 1");   
$row = mysqli_num_rows($query);
if($row){$reg5 = $regname5;}else {$reg5 = "";}  

mysqli_query($connect, "UPDATE `users` SET `fas` = '2' WHERE `users`.`chatid` = $id");  
$selectfas2 = $message;
sendMessage($token, $id, $msg.KeyboardMenuReg($reg1, $reg2, $reg3, $reg4, $reg5, $but11, $but12, $but13));
}
else if($mes == $fasname3 and $tovid > 0)
{
$queryqq = mysqli_query($connect, "SELECT * FROM `users` WHERE `chatid` = $id");
$rowqq = mysqli_fetch_assoc($queryqq);
$tovid = $rowqq['tovid'];
if($tovid == 1){$tov = $tovname1;}
else if($tovid == 2){$tov = $tovname2;}
else if($tovid == 3){$tov = $tovname3;}
else if($tovid == 4){$tov = $tovname4;}
else if($tovid == 5){$tov = $tovname5;}
$msg = "Вы выбрали "  . $message . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $city . urlencode("\nКАТЕГОРИЯ: ") . $cat . urlencode("\nТОВАР: ") . $tov . urlencode("\nФАСОВКА: ") . $message . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите район:"); 

$query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 1");
$row = mysqli_fetch_assoc($query);
$regname1 = $row['reg'];
$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `region` = '$regname1' and `city` = '$city' and `fas` = '$fasname3' and `tovid` = '$tovid' and `cat` = '$cat' limit 1");   
$row = mysqli_num_rows($query);
if($row){$reg1 = $regname1;}else {$reg1 = "";}
    
$query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 2");
$row = mysqli_fetch_assoc($query);
$regname2 = $row['reg'];
$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `region` = '$regname2' and `city` = '$city' and `fas` = '$fasname3' and `tovid` = '$tovid' and `cat` = '$cat' limit 1");   
$row = mysqli_num_rows($query);
if($row){$reg2 = $regname2;}else {$reg2 = "";}

$query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 3");
$row = mysqli_fetch_assoc($query);
$regname3 = $row['reg'];
$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `region` = '$regname3' and `city` = '$city' and `fas` = '$fasname3' and `tovid` = '$tovid' and `cat` = '$cat' limit 1");   
$row = mysqli_num_rows($query);
if($row){$reg3 = $regname3;}else {$reg3 = "";}

$query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 4");
$row = mysqli_fetch_assoc($query);
$regname4 = $row['reg'];
$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `region` = '$regname4' and `city` = '$city' and `fas` = '$fasname3' and `tovid` = '$tovid' and `cat` = '$cat' limit 1");   
$row = mysqli_num_rows($query);
if($row){$reg4 = $regname4;}else {$reg4 = "";}

$query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 5");
$row = mysqli_fetch_assoc($query);
$regname5 = $row['reg'];
$query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `region` = '$regname5' and `city` = '$city' and `fas` = '$fasname3' and `tovid` = '$tovid' and `cat` = '$cat' limit 1");   
$row = mysqli_num_rows($query);
if($row){$reg5 = $regname5;}else {$reg5 = "";}      

mysqli_query($connect, "UPDATE `users` SET `fas` = '3' WHERE `users`.`chatid` = $id");  
sendMessage($token, $id, $msg.KeyboardMenuReg($reg1, $reg2, $reg3, $reg4, $reg5, $but11, $but12, $but13));
}

$query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 1");
$row = mysqli_fetch_assoc($query);
$regname1 = $row['reg'];
$query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 2");
$row = mysqli_fetch_assoc($query);
$regname2 = $row['reg'];
$query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 3");
$row = mysqli_fetch_assoc($query);
$regname3 = $row['reg'];
$query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 4");
$row = mysqli_fetch_assoc($query);
$regname4 = $row['reg'];
$query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 5");
$row = mysqli_fetch_assoc($query);
$regname5 = $row['reg'];

$queryqq = mysqli_query($connect, "SELECT * FROM `users` WHERE `chatid` = $id");
$rowqq = mysqli_fetch_assoc($queryqq);
$tovid = $rowqq['tovid'];
if($tovid == 1){$tov = $tovname1;}
else if($tovid == 2){$tov = $tovname2;}
else if($tovid == 3){$tov = $tovname3;}
else if($tovid == 4){$tov = $tovname4;}
else if($tovid == 5){$tov = $tovname5;}



if($message == $regname1 and $tovid > 0)
{
    $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `chatid` = $id");
    $row = mysqli_fetch_assoc($query);
    $fas = $row['fas'];
    
    $query = mysqli_query($connect, "SELECT * FROM `fas` WHERE `botid` = $botid and `fasid` = 1");
    $row = mysqli_fetch_assoc($query);
    $selfas = $row['fas'];
    $idfas = $row['fasid'];
    if($idfas == $fas) {$selectfas = $idfas;}
    
    $query = mysqli_query($connect, "SELECT * FROM `fas` WHERE `botid` = $botid and `fasid` = 2");
    $row = mysqli_fetch_assoc($query);
    $selfas = $row['fas'];
    $idfas = $row['fasid'];
    if($idfas == $fas) {$selectfas = $idfas;}
    
    $query = mysqli_query($connect, "SELECT * FROM `fas` WHERE `botid` = $botid and `fasid` = 3");
    $row = mysqli_fetch_assoc($query);
    $selfas = $row['fas'];
    $idfas = $row['fasid'];
    if($idfas == $fas) {$selectfas = $idfas;}

    mysqli_query($connect, "UPDATE `users` SET `region` = '1' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . $message . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $city . urlencode("\nКАТЕГОРИЯ: ") . $cat . urlencode("\nТОВАР: ") . $tov . urlencode("\nФАСОВКА: ") . $selectfas . " г" . urlencode("\nРАЙОН: ") . $message . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите способ оплаты: ");   
    $wall1 = "QIWI";
    $wall2 = "";
    sendMessage($token, $id, $msg.KeyboardMenuWall($wall1, $wall2, $but11, $but12, $but13));
}




if($message == $regname2 and $tovid > 0)
{
    $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `chatid` = $id");
    $row = mysqli_fetch_assoc($query);
    $fas = $row['fas'];
    
    $query = mysqli_query($connect, "SELECT * FROM `fas` WHERE `botid` = $botid and `fasid` = 1");
    $row = mysqli_fetch_assoc($query);
    $selfas = $row['fas'];
    $idfas = $row['fasid'];
    if($idfas == $fas) {$selectfas = $idfas;}
    
    $query = mysqli_query($connect, "SELECT * FROM `fas` WHERE `botid` = $botid and `fasid` = 2");
    $row = mysqli_fetch_assoc($query);
    $selfas = $row['fas'];
    $idfas = $row['fasid'];
    if($idfas == $fas) {$selectfas = $idfas;}
    
    $query = mysqli_query($connect, "SELECT * FROM `fas` WHERE `botid` = $botid and `fasid` = 3");
    $row = mysqli_fetch_assoc($query);
    $selfas = $row['fas'];
    $idfas = $row['fasid'];
    if($idfas == $fas) {$selectfas = $idfas;}

    mysqli_query($connect, "UPDATE `users` SET `region` = '2' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . $message . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $city . urlencode("\nКАТЕГОРИЯ: ") . $cat . urlencode("\nТОВАР: ") . $tov . urlencode("\nФАСОВКА: ") . $selectfas . " г" . urlencode("\nРАЙОН: ") . $message . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите способ оплаты: ");   
    $wall1 = "QIWI";
    $wall2 = "";
    sendMessage($token, $id, $msg.KeyboardMenuWall($wall1, $wall2, $but11, $but12, $but13));
}



if($message == $regname3  and $tovid > 0)
{
    $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `chatid` = $id");
    $row = mysqli_fetch_assoc($query);
    $fas = $row['fas'];
    
    $query = mysqli_query($connect, "SELECT * FROM `fas` WHERE `botid` = $botid and `fasid` = 1");
    $row = mysqli_fetch_assoc($query);
    $selfas = $row['fas'];
    $idfas = $row['fasid'];
    if($idfas == $fas) {$selectfas = $idfas;}
    
    $query = mysqli_query($connect, "SELECT * FROM `fas` WHERE `botid` = $botid and `fasid` = 2");
    $row = mysqli_fetch_assoc($query);
    $selfas = $row['fas'];
    $idfas = $row['fasid'];
    if($idfas == $fas) {$selectfas = $idfas;}
    
    $query = mysqli_query($connect, "SELECT * FROM `fas` WHERE `botid` = $botid and `fasid` = 3");
    $row = mysqli_fetch_assoc($query);
    $selfas = $row['fas'];
    $idfas = $row['fasid'];
    if($idfas == $fas) {$selectfas = $idfas;}

    mysqli_query($connect, "UPDATE `users` SET `region` = '3' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . $message . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД")  . $city . urlencode("\nКАТЕГОРИЯ: ") . $cat . urlencode("\nТОВАР: ") . $tov . urlencode("\nФАСОВКА: ") . $selectfas . " г" . urlencode("\nРАЙОН: ") . $message . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите способ оплаты: ");    
    $wall1 = "QIWI";
    $wall2 = "";
    sendMessage($token, $id, $msg.KeyboardMenuWall($wall1, $wall2, $but11, $but12, $but13));
}

 

if($message == $regname4 and $tovid > 0)
{
    $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `chatid` = $id");
    $row = mysqli_fetch_assoc($query);
    $fas = $row['fas'];
    
    $query = mysqli_query($connect, "SELECT * FROM `fas` WHERE `botid` = $botid and `fasid` = 1");
    $row = mysqli_fetch_assoc($query);
    $selfas = $row['fas'];
    $idfas = $row['fasid'];
    if($idfas == $fas) {$selectfas = $idfas;}
    
    $query = mysqli_query($connect, "SELECT * FROM `fas` WHERE `botid` = $botid and `fasid` = 2");
    $row = mysqli_fetch_assoc($query);
    $selfas = $row['fas'];
    $idfas = $row['fasid'];
    if($idfas == $fas) {$selectfas = $idfas;}
    
    $query = mysqli_query($connect, "SELECT * FROM `fas` WHERE `botid` = $botid and `fasid` = 3");
    $row = mysqli_fetch_assoc($query);
    $selfas = $row['fas'];
    $idfas = $row['fasid'];
    if($idfas == $fas) {$selectfas = $idfas;}

    mysqli_query($connect, "UPDATE `users` SET `region` = '4' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . $message . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $city . urlencode("\nКАТЕГОРИЯ: ") . $cat . urlencode("\nТОВАР: ") . $tov . urlencode("\nФАСОВКА: ") . $selectfas . " г" . urlencode("\nРАЙОН: ") . $message . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите способ оплаты: ");   
    $wall1 = "QIWI";
    $wall2 = "";
    sendMessage($token, $id, $msg.KeyboardMenuWall($wall1, $wall2, $but11, $but12, $but13));
}




if($message == $regname5 and $tovid > 0)
{
    $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `chatid` = $id");
    $row = mysqli_fetch_assoc($query);
    $fas = $row['fas'];
    
    $query = mysqli_query($connect, "SELECT * FROM `fas` WHERE `botid` = $botid and `fasid` = 1");
    $row = mysqli_fetch_assoc($query);
    $selfas = $row['fas'];
    $idfas = $row['fasid'];
    if($idfas == $fas) {$selectfas = $idfas;}
    
    $query = mysqli_query($connect, "SELECT * FROM `fas` WHERE `botid` = $botid and `fasid` = 2");
    $row = mysqli_fetch_assoc($query);
    $selfas = $row['fas'];
    $idfas = $row['fasid'];
    if($idfas == $fas) {$selectfas = $idfas;}
    
    $query = mysqli_query($connect, "SELECT * FROM `fas` WHERE `botid` = $botid and `fasid` = 3");
    $row = mysqli_fetch_assoc($query);
    $selfas = $row['fas'];
    $idfas = $row['fasid'];
    if($idfas == $fas) {$selectfas = $idfas;}

    mysqli_query($connect, "UPDATE `users` SET `region` = '5' WHERE `users`.`chatid` = $id");
    $msg = "Вы выбрали "  . $message . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nГОРОД: ") . $city . urlencode("\nКАТЕГОРИЯ: ") . $cat . urlencode("\nТОВАР: ") . $tov . urlencode("\nФАСОВКА: ") . $selectfas . " г" . urlencode("\nРАЙОН: ") . $message . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nВыберите способ оплаты: ");   
    $wall1 = "QIWI";
    $wall2 = "";
    sendMessage($token, $id, $msg.KeyboardMenuWall($wall1, $wall2, $but11, $but12, $but13));
}


if($message == "QIWI")
{
        // ДАННЫЕ ЮЗЕРА //
    $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `chatid` = '$id'");
    $row = mysqli_fetch_assoc($query);
    $tovid = $row['tovid'];
    $regid = $row['region'];
    $cat = $row['cat'];
    $fasid = $row['fas'];
    $comment = $row['comment'];
    
        // ФАСОВКА РЕИОНА //
    $query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 1");
    $row = mysqli_fetch_assoc($query);
    $regname1 = $row['reg'];
    $query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 2");
    $row = mysqli_fetch_assoc($query);
    $regname2 = $row['reg'];
    $query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 3");
    $row = mysqli_fetch_assoc($query);
    $regname3 = $row['reg'];
    $query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 4");
    $row = mysqli_fetch_assoc($query);
    $regname4 = $row['reg'];
    $query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 5");
    $row = mysqli_fetch_assoc($query);
    $regname5 = $row['reg'];
    
    if($regid == 1){$reg = $regname1;}
    else if($regid == 2){$reg = $regname2;}
    else if($regid == 3){$reg = $regname3;}
    else if($regid == 4){$reg = $regname4;}
    else if($regid == 5){$reg = $regname5;}
    
        // КАТЕГОРИИ //
    $query = mysqli_query($connect, "SELECT * FROM `cat` WHERE `botid` = $botid");
    $row = mysqli_fetch_assoc($query);
    $cat1 = $row['cat1'];
    $cat2 = $row['cat2'];
    $cat3 = $row['cat3'];
    $cat4 = $row['cat4'];
    $cat5 = $row['cat5'];
    
    if($cat == 1){$cat = $cat1;}
    else if($cat == 2){$cat = $cat2;}
    else if($cat == 3){$cat = $cat3;}
    else if($cat == 4){$cat = $cat4;}
    else if($cat == 5){$cat = $cat5;}
    
        //ФАСОВКА//
    $query = mysqli_query($connect, "SELECT * FROM `fas` WHERE `botid` = $botid and `fasid` = 1");
    $row = mysqli_fetch_assoc($query);
    $fasname1 = $row['fas'];
    $query = mysqli_query($connect, "SELECT * FROM `fas` WHERE `botid` = $botid and `fasid` = 2");
    $row = mysqli_fetch_assoc($query);
    $fasname2 = $row['fas'];
    $query = mysqli_query($connect, "SELECT * FROM `fas` WHERE `botid` = $botid and `fasid` = 3");
    $row = mysqli_fetch_assoc($query);
    $fasname3 = $row['fas'];
    
    if($fasid == 1){$fas = $fasname1;}
    else if($fasid == 2){$fas = $fasname2;}
    else if($fasid == 3){$fas = $fasname3;}
    
        // ЗАПРОС К ТОВАРУ //
    $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `tovid` = '$tovid' and `city` = '$city' and `region` = '$reg' and `cat` = '$cat' and `fas` = '$fas' limit 1");
    $row = mysqli_fetch_assoc($query);
    $price = $row['price'];
    mysqli_query($connect, "UPDATE `users` SET `pay` = '1', `price` = '$price' WHERE `users`.`chatid` = $id");
    $msg = "Переведите на QIWI в течение 24 часов"  . urlencode("\n\n▪▪▪▪▪▪▪▪▪▪\nКОШЕЛЕК: ") . urlencode("+") . $nomer1 . urlencode("\nСУММА: ") . $price . " рублей" . urlencode("\nКОММЕНТАРИЙ: ") . $comment . urlencode("\n▪▪▪▪▪▪▪▪▪▪\nБЕЗ КОММЕНТАРИЯ ДЕНЬГИ НЕ ЗАЧИСЛЯЮТСЯ! ");   
    $check = "Проверить оплату";
    sendMessage($token, $id, $msg.KeyboardMenuMenu($check, $but11, $but12, $but13));
}

    $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `chatid` = '$id'");
    $row = mysqli_fetch_assoc($query);
    $payid = $row['pay'];
    $comm = $row['comment'];

if($message == "Проверить оплату" and $payid == 1)
{
    $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `chatid` = $id");
    $row = mysqli_fetch_assoc($query);
    $price = $row['price'];
    $query = file_get_contents('https://qiwigate.ru/api?key=ZKCYWVA1TD67N34PQHAIO8DPXL5LSE&method=qiwi.get.history&start=25.09.2017&finish=27.09.2019');
    $json = json_decode($query, true);
    $json = $json['history'];

    $cash1 = $json[0]['cash'];
    $comm1 = $json[0]['comment'];
    $status1 = $json[0]['status'];
    $cash1 = preg_replace("/[^0-9]/", '', $cash1);
    
    $cash2 = $json[1]['cash'];
    $comm2 = $json[1]['comment'];
    $status2 = $json[0]['status'];
    $cash2 = preg_replace("/[^0-9]/", '', $cash1);
    
    $cash3 = $json[2]['cash'];
    $comm3 = $json[2]['comment'];
    $status3 = $json[0]['status'];
    $cash3 = preg_replace("/[^0-9]/", '', $cash1);

    if($cash1 == $price . "00" and $comm1 == $comm and $status1 == "SUCCESS")
    {
        $pay = 1;
    }
    
    else if($cash2 == $price . "00" and $comm2 == $comm and $status2 == "SUCCESS")
    {
        $pay = 1;
    }

    else if($cash2 == $price . "00" and $comm2 == $comm and $status3 == "SUCCESS")
    {
        $pay = 1;
    }
    
    if($pay == 1)
    {
    $query = mysqli_query($connect, "SELECT * FROM `users` WHERE `chatid` = '$id'");
    $row = mysqli_fetch_assoc($query);
    $tovid = $row['tovid'];
    $regid = $row['region'];
    $cat = $row['cat'];
    $fasid = $row['fas'];
    $comment = $row['comment'];
    
        // ФАСОВКА РЕИОНА //
    $query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 1");
    $row = mysqli_fetch_assoc($query);
    $regname1 = $row['reg'];
    $query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 2");
    $row = mysqli_fetch_assoc($query);
    $regname2 = $row['reg'];
    $query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 3");
    $row = mysqli_fetch_assoc($query);
    $regname3 = $row['reg'];
    $query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 4");
    $row = mysqli_fetch_assoc($query);
    $regname4 = $row['reg'];
    $query = mysqli_query($connect, "SELECT * FROM `reg` WHERE `botid` = $botid and `regid` = 5");
    $row = mysqli_fetch_assoc($query);
    $regname5 = $row['reg'];
    
    if($regid == 1){$reg = $regname1;}
    else if($regid == 2){$reg = $regname2;}
    else if($regid == 3){$reg = $regname3;}
    else if($regid == 4){$reg = $regname4;}
    else if($regid == 5){$reg = $regname5;}
    
        // КАТЕГОРИИ //
    $query = mysqli_query($connect, "SELECT * FROM `cat` WHERE `botid` = $botid");
    $row = mysqli_fetch_assoc($query);
    $cat1 = $row['cat1'];
    $cat2 = $row['cat2'];
    $cat3 = $row['cat3'];
    $cat4 = $row['cat4'];
    $cat5 = $row['cat5'];
    
    if($cat == 1){$cat = $cat1;}
    else if($cat == 2){$cat = $cat2;}
    else if($cat == 3){$cat = $cat3;}
    else if($cat == 4){$cat = $cat4;}
    else if($cat == 5){$cat = $cat5;}
    
        //ФАСОВКА//
    $query = mysqli_query($connect, "SELECT * FROM `fas` WHERE `botid` = $botid and `fasid` = 1");
    $row = mysqli_fetch_assoc($query);
    $fasname1 = $row['fas'];
    $query = mysqli_query($connect, "SELECT * FROM `fas` WHERE `botid` = $botid and `fasid` = 2");
    $row = mysqli_fetch_assoc($query);
    $fasname2 = $row['fas'];
    $query = mysqli_query($connect, "SELECT * FROM `fas` WHERE `botid` = $botid and `fasid` = 3");
    $row = mysqli_fetch_assoc($query);
    $fasname3 = $row['fas'];
    
    if($fasid == 1){$fas = $fasname1;}
    else if($fasid == 2){$fas = $fasname2;}
    else if($fasid == 3){$fas = $fasname3;}
        
        $query = mysqli_query($connect, "SELECT * FROM `tovar` WHERE `botid` = '$botid' and `tovid` = '$tovid' and `city` = '$city' and `region` = '$reg' and `cat` = '$cat' and `fas` = '$fas' limit 1");
            $row = mysqli_fetch_assoc($query);
        $idtovar = $row['id'];
        $about = $row['about'];
        $url = $row['url'];
        mysqli_query($connect, "UPDATE `tovar` SET `sell` = 1 WHERE `tovar`.`id` = $idtovar");
        $commee = rand(1000,9999);
            mysqli_query($connect, "UPDATE `users` SET `comment` = $commee WHERE `users`.`chatid` = $id");
        $msg = urlencode("Поздравляем с покупкой! Не забудь оставить отзыв /otziv\n\nОписание: ") . $about . urlencode("\n\nСсылки на фото:\n") . $url;
        $check = "";
    }else
    {
        $msg = urlencode("Получино 0 рублей\n\nСписок поступивших платежей обновляется раз в 5 минут, пожалуйста, подождите...");
        $check = "Проверить оплату";
    }
    sendMessage($token, $id, $msg.KeyboardMenuMenu($check, $but11, $but12, $but13));
}



file_put_contents("logs.txt",$message);


function KeyboardMenu($but1,$but2,$but3,$but4,$but5,$but6,$but7,$but8,$but9,$but10,$but11,$but12,$but13){
    $buttons = [[$but1, $but2],[$but3, $but4],[$but5, $but6],[$but7,$but8],[$but9,$but10],[$but11 , $but12, $but13]];
    $keyboard = json_encode($keyboard = ['keyboard' => $buttons,
        'resize_keyboard' => true,
        'one_time_keyboard' => false,
        'selective' => true]);
    $reply_markup = '&reply_markup=' . $keyboard . '';

    return $reply_markup;
}

function KeyboardMenuWall($wall1, $wall2, $but11, $but12, $but13){
    $buttons = [[$wall1,$wall2],[$but11,$but12,$but13]];
    $keyboard = json_encode($keyboard = ['keyboard' => $buttons,
        'resize_keyboard' => true,
        'one_time_keyboard' => false,
        'selective' => true]);
    $reply_markup = '&reply_markup=' . $keyboard . '';

    return $reply_markup;
}

function KeyboardMenuMenu($check, $but11, $but12, $but13){
    $buttons = [[$check],[$but11,$but12,$but13]];
    $keyboard = json_encode($keyboard = ['keyboard' => $buttons,
        'resize_keyboard' => true,
        'one_time_keyboard' => false,
        'selective' => true]);
    $reply_markup = '&reply_markup=' . $keyboard . '';

    return $reply_markup;
}

function KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13){
    $buttons = [[$cat1,$cat2],[$cat3,$cat4],[$cat5],[$but11,$but12,$but13]];
    $keyboard = json_encode($keyboard = ['keyboard' => $buttons,
        'resize_keyboard' => true,
        'one_time_keyboard' => false,
        'selective' => true]);
    $reply_markup = '&reply_markup=' . $keyboard . '';

    return $reply_markup;
}

function KeyboardMenuReg($reg1, $reg2, $reg3, $reg4, $reg5, $but11, $but12, $but13){
    $buttons = [[$reg1,$reg2],[$reg3,$reg4],[$reg5],[$but11,$but12,$but13]];
    $keyboard = json_encode($keyboard = ['keyboard' => $buttons,
        'resize_keyboard' => true,
        'one_time_keyboard' => false,
        'selective' => true]);
    $reply_markup = '&reply_markup=' . $keyboard . '';

    return $reply_markup;
}

function KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13){
    $buttons = [[$tov1,$tov2],[$tov3,$tov4],[$tov5],[$but11,$but12,$but13]];
    $keyboard = json_encode($keyboard = ['keyboard' => $buttons,
        'resize_keyboard' => true,
        'one_time_keyboard' => false,
        'selective' => true]);
    $reply_markup = '&reply_markup=' . $keyboard . '';

    return $reply_markup;
}

function KeyboardMenuFas($fas1, $fas2, $fas3, $but11, $but12, $but13){
    $buttons = [[$fas1],[$fas2],[$fas3],[$but11,$but12,$but13]];
    $keyboard = json_encode($keyboard = ['keyboard' => $buttons,
        'resize_keyboard' => true,
        'one_time_keyboard' => false,
        'selective' => true]);
    $reply_markup = '&reply_markup=' . $keyboard . '';

    return $reply_markup;
}

 function ReplyKeyboardRemove(){
        $removeKeyboard = json_encode($removeKeyboard = ['remove_keyboard' => true]);
        $reply_markup = '&reply_markup=' . $removeKeyboard . '';
        return $reply_markup;
    }
?>
