<?php
$connect = mysqli_connect('a0160954.xsph.ru:3306','a0160954_bazis','Ghjcnjq2','a0160954_bazis');
if(!$connect) exit();

$botid = 1;  //ID БОТА

$output = json_decode(file_get_contents('php://input'),true);
$id = $output['message']['chat']['id'];
$message = $output['message']['text'];
$token = "353692369:AAG8oKq8id2URz9Xzr8RFGlYOAWFA30A0LI";

function sendMessage($token, $id, $message)
{
    file_get_contents("https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $id . "&text=" . $message);
}

	//ЗАПРОСЫ//
	$querycity = mysqli_query($connect, "SELECT * FROM `city` WHERE `botid` = $botid");  //ЗАПРОС ГОРОДОВ
	$rowcity = mysqli_fetch_assoc($querycity);
	$city1 = $rowcity['but1'];
	$city2 = $rowcity['but2'];
	$city3 = $rowcity['but3'];
	$city4 = $rowcity['but4'];
	$city5 = $rowcity['but5'];
	$city6 = $rowcity['but6'];
	$city7 = $rowcity['but7'];
	$city8 = $rowcity['but8'];
	$city9 = $rowcity['but9'];
	$city10 = $rowcity['but10'];

	$allcity = array($city1, $city2, $city3, $city4, $city5, $city6, $city7, $city8, $city9, $city10);

	$querysettings = mysqli_query($connect, "SELECT * FROM `settings` WHERE `botid` = $botid");  //ЗАПРОС ПРИВЕТСТВИЯ 
	$rowsettings = mysqli_fetch_assoc($querysettings);
	$welcome = $rowsettings['welcome'];

	$queryusers = mysqli_query($connect, "SELECT * FROM `users` WHERE `chatid` = $id"); //ЗАПРОС ЮЗЕРА
	$rowusers = mysqli_num_rows($queryusers);

	//КНОПКИ СЛУЖЕБНЫЕ//
	$menu = "В главное меню";
	$price = "Прайс";
	$help = "Помощь";
	$jobs = "Работа";

	//ДОП. ПЕРЕМЕННЫЕ//
	$comment = rand(1000, 9999);

if( $message == "/start" or $message == "В главное меню")
{
	if(!$rowusers)
	{
		mysqli_query($connect, "INSERT INTO `users` (`botid`, `chatid`, `comment`, `city`, `cat`, `tovid`,`region` , `fas`) VALUES ('$botid', '$id', '$comment', '0', '0', '0', '0', '0')");
		$msg = $welcome . urlencode("\n\nОтзывы покупателей (нажмите 👉 /otzivi)\nОставить отзыв (нажмите 👉 /otziv)\n\nДля покупки нажмите на свой город внизу:");
		sendMessage($token, $id, $msg.KeyboardMenu($city1,$city2,$city3,$city4,$city5,$city6,$city7,$city8,$city9,$city10,$menu,$price,$help,$jobs));
	}else
	{	
		mysqli_query($connect, "UPDATE `users` SET `cat` = '0', `tovid` = '0', `city` = '0', `region` = '0', `fas` = '0' WHERE `users`.`chatid` = $id");
		$msg = $welcome . urlencode("\n\nОтзывы покупателей (нажмите 👉 /otzivi)\nОставить отзыв (нажмите 👉 /otziv)\n\nДля покупки нажмите на свой город внизу:");
		sendMessage($token, $id, $msg.KeyboardMenu($city1,$city2,$city3,$city4,$city5,$city6,$city7,$city8,$city9,$city10,$menu,$price,$help,$jobs));
	}
}

foreach($allcity as $city )
{
	if($city == $message)
	{
		$msg = "Пидор";
		sendMessage($token, $id, $msg);
	}
}





function KeyboardMenu($city1,$city2,$city3,$city4,$city5,$city6,$city7,$city8,$city9,$city10,$menu,$price,$help,$jobs){
	$buttons = [
		   [$city1, $city2],
		   [$city3, $city4],
		   [$city5, $city6],
		   [$city7, $city8],
		   [$city9, $city10],
	   [$menu , $price, $help],
	    	   [$jobs]
		   ];
	$keyboard = json_encode($keyboard = ['keyboard' => $buttons,
        'resize_keyboard' => true,
        'one_time_keyboard' => false,
        'selective' => true]);
    $reply_markup = '&reply_markup=' . $keyboard . '';

    return $reply_markup;
}

function KeyboardMenuCat($cat1, $cat2, $cat3, $cat4, $cat5, $but11, $but12, $but13){
	$buttons = [[$cat1],[$cat2],[$cat3],[$cat4],[$cat5],[$but11],[$but12],[$but13]];
	$keyboard = json_encode($keyboard = ['keyboard' => $buttons,
        'resize_keyboard' => true,
        'one_time_keyboard' => false,
        'selective' => true]);
    $reply_markup = '&reply_markup=' . $keyboard . '';

    return $reply_markup;
}

function KeyboardMenuTov($tov1, $tov2, $tov3, $tov4, $tov5, $but11, $but12, $but13){
	$buttons = [[$tov1],[$tov2],[$tov3],[$tov4],[$tov5],[$but11],[$but12],[$but13]];
	$keyboard = json_encode($keyboard = ['keyboard' => $buttons,
        'resize_keyboard' => true,
        'one_time_keyboard' => false,
        'selective' => true]);
    $reply_markup = '&reply_markup=' . $keyboard . '';

    return $reply_markup;
}

function KeyboardMenuFas($fas1, $fas2, $fas3, $but11, $but12, $but13){
	$buttons = [[$fas1],[$fas2],[$fas3],[$but11],[$but12],[$but13]];
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
