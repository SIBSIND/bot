<?php
$connect = mysqli_connect('a0160954.xsph.ru:3306','a0160954_bazis','Ghjcnjq2','a0160954_bazis');
if(!$connect) exit();

$output = json_decode(file_get_contents('php://input'),true);
$id = $output['message']['chat']['id'];
$message = $output['message']['text'];
$token = "332809777:AAHjqELf5LmeTgrqxWIp5BxtsTIi9upLsl4";

function sendMessage($token, $id, $message)
{
    file_get_contents("https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $id . "&text=" . $message);
}

if($message == "/start" or $message == "Нет :-1:")
{
    $query = mysqli_query($connect, "SELECT `chatid` FROM `users` WHERE chatid = $id");
    $row = mysqli_fetch_array($query);
    if (!$row) 
    {
    mysqli_query($connect, "INSERT INTO `users` (`chatid`) VALUES ($id)");
    $message = urlencode("Вы зарегистрировались! Ваш ChatID: $id. \n\nПривет, меня зовут Бот Антон!\nПопав сюда, ты встретил самого выгодного телеграм бота!\n\nВыбери, чем ты хочешь заняться?");
    $but1 = "Подзаработать денег! :moneybag:";
    $but2 = "Рекламировать проект! :mega:";
    sendMessage($token, $id, $message.KeyboardMenu($but1,$but2));
    }else
    {
    $message = urlencode("Вы зарегистрированы! Ваш ChatID: $id. \n\nПривет, меня зовут Бот Антон!\nПопав сюда, ты встретил самого выгодного телеграм бота!\n\nВыбери, чем ты хочешь заняться?");
    $but1 = "Подзаработать денег! :moneybag:";
    $but2 = "Рекламировать проект! :mega:";
    sendMessage($token, $id, $message.KeyboardMenu($but1,$but2));
    }


}

if($message == "Подзаработать денег! :moneybag:")
{
    $message = urlencode("Отлично! \n\nУ меня ты можешь зарабатывать баллы выполняя всего три простых шага! \nЯ буду присылать тебе каналы, а твоя задача переходить по ним, изучать тематику канала и ответить на заданный вопрос!\n\nЕсли ты ответишь правильно - заработаешь 1 балл, если ответишь не верно, тогда мы спишем 1 балл с твоего баланса! \nБаллы можно обменивать на реальные рубли по курсу: \n1 балл = 50 копеек!");
    $but1 = "Отлично, жду квест! :hourglass:";
    $but2 = "Рекламировать проект! :mega:";
    sendMessage($token, $id, $message.KeyboardMenu($but1,$but2));
}

if ($message == "Отлично, жду квест! :hourglass:")
{
    $message = urlencode("Мы присылаем квесты раз в 30 минут!");
    sendMessage($token, $id, $message); 
}

if ($message == "Рекламировать проект! :mega:")
{
    $message = urlencode("Хочешь пропиарить свой телеграм канал? - Ты по адресу!\nЯ помогу тебе набрать кучу подписчиков, но эта услуга стоит денег!\n\nВстать на рассылку стоит 500 рублей/баллов!\n\nЧто это тебе даст?\n1) Более 1000 человек увидят твой канал.\n\nГотов оплатить?");
    $but1 = "Да! :+1:";
    $but2 = "Нет :-1:";
    sendMessage($token, $id, $message.KeyboardMenu($but1,$but2)); 
}



file_put_contents("logs.txt",$connection);


function KeyboardMenu($but1,$but2){
    $buttons = [[$but1],[$but2]];
    $keyboard =json_encode($keyboard = ['keyboard' => $buttons,
        'resize_keyboard' => true,
        'one_time_keyboard' => false,
        'selective' => true]);
    $reply_markup = '&reply_markup=' . $keyboard . '';

    return $reply_markup;
}
?>
