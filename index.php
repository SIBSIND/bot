<?php
$connect = mysqli_connect('a0160954.xsph.ru:3306','a0160954_bazis','Ghjcnjq2','a0160954_bazis');
if(!$connect) exit();
$botid = 1;
$nomer1 = "79654405539";
$output = json_decode(file_get_contents('php://input'),true);
$id = $output['message']['chat']['id'];
$message = $output['message']['text'];
$token = "353692369:AAG8oKq8id2URz9Xzr8RFGlYOAWFA30A0LI";

$query = mysqli_query($connect, "SELECT * FROM `users`");
$query = mysqli_query($connect, "SELECT * FROM `users`");
$query = mysqli_query($connect, "SELECT * FROM `users`");
$query = mysqli_query($connect, "SELECT * FROM `users`");
$query = mysqli_query($connect, "SELECT * FROM `users`");
$query = mysqli_query($connect, "SELECT * FROM `users`");
$query = mysqli_query($connect, "SELECT * FROM `users`");

function sendMessage($token, $id, $message)
{
    file_get_contents("https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $id . "&text=" . $message);
}

if( $message == "/start" or $message == "В главное меню")
{
    $query = mysqli_query($connect, "SELECT * FROM `users`");
    $query = mysqli_query($connect, "SELECT * FROM `users`");
    $query = mysqli_query($connect, "SELECT * FROM `users`");
    $query = mysqli_query($connect, "SELECT * FROM `users`");
    $query = mysqli_query($connect, "SELECT * FROM `users`");
    $query = mysqli_query($connect, "SELECT * FROM `users`");
    $query = mysqli_query($connect, "SELECT * FROM `users`");
    $query = mysqli_query($connect, "SELECT * FROM `users`");
    $row = mysqli_num_rows($query);
    if($row) {$users = $row;}
    $msg = "Привет " . $row . " человек";
    sendMessage($token, $id, $msg);         
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
