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

if($message == "/start" or $message == "Выйти в меню 🔙")
{
    $query = mysqli_query($connect, "SELECT `chatid` FROM `users` WHERE chatid = $id");
    $row = mysqli_fetch_array($query);
    if (!$row) 
    {
        mysqli_query($connect, "INSERT INTO `users` (`chatid`, `pts`) VALUES ($id, 0)");
        $message = urlencode("Вы зарегистрировались! Ваш ChatID: $id. \n\nПривет, меня зовут Бот Антон!\nПопав сюда, ты встретил самого выгодного телеграм бота!\n\nВыбери, чем ты хочешь заняться?");
        $but1 = "Подзаработать денег! 💰";
        $but2 = "Рекламировать проект! 📢";
        sendMessage($token, $id, $message.KeyboardMenu($but1,$but2));
    }else
    {
        $message = urlencode("Вы зарегистрированы! Ваш ChatID: $id. \n\nПривет, меня зовут Бот Антон!\nПопав сюда, ты встретил самого выгодного телеграм бота!\n\nВыбери, чем ты хочешь заняться");
        $but1 = "Подзаработать денег! 💰";
        $but2 = "Рекламировать проект! 📢";
        sendMessage($token, $id, $message.KeyboardMenu($but1,$but2));
    }
}

if($message == "Подзаработать денег! 💰")
{
    $message = urlencode("Отлично! \n\nУ меня ты можешь зарабатывать PTS выполняя всего три простых шага! \nЯ буду присылать тебе каналы, а твоя задача переходить по ним, изучать тематику канала и ответить на заданный вопрос!\n\nЕсли ты ответишь правильно - заработаешь 1 PTS, если ответишь не верно, тогда мы спишем 1 PTS с твоего баланса! \nPTS можно обменивать на реальные рубли по курсу: \n1 PTS = 30 копеек!");
    $but1 = "Отлично, жду квест! ⌛";
    $but2 = "Рекламировать проект! 📢";
    sendMessage($token, $id, $message.KeyboardMenu($but1,$but2));
}

if ($message == "Отлично, жду квест! ⌛")
{
    $message = urlencode("В данный момент очередь на рекламу пуста!");
    sendMessage($token, $id, $message); 
}

if ($message == "Рекламировать проект! 📢")
{
    $query = mysqli_query($connect, "SELECT `id` FROM `users`");
    $row = mysqli_num_rows($query);
    $cena = $row*0.7;
    $message = urlencode("Хочешь пропиарить свой телеграм канал? - Ты по адресу!\nЯ помогу тебе набрать кучу подписчиков, но эта услуга стоит денег!\n\nВстать на рассылку стоит $cena PTS!\n\nЧто это тебе даст?\n•) Ровно $row человек увидят твою рекламу.\n\nГотов оплатить?");
    $but1 = "Да! 👍";
    $but2 = "Выйти в меню 🔙";
    sendMessage($token, $id, $message.KeyboardMenu($but1,$but2)); 
}

if($message == "Да! 👍")
{
    $query = mysqli_query($connect, "SELECT `pts` FROM `users` WHERE `chatid` = $id");
    $row = mysqli_fetch_assoc($query);
    $rows = mysqli_num_rows($query);
    $rows =  $rows * 0.7;
    if($row['pts'] < $rows)
    {
        $message = "Твой баланс: " . $row['pts'] . urlencode(" PTS.\n\nТебе не хватает денег для покупки рассылки!\nЕсть два варианта:\n1) Пополнить через QIWI\n2) Подзаработать денег");
        $but1 = "Пополнить через QIWI ✔";
        $but2 = "Подзаработать денег! 💰";
        sendMessage($token, $id, $message.KeyboardMenu($but1,$but2)); 
    }else
    {
        $msg = "Твой баланс: " . $row['pts'] . urlencode(" PTS.\n\nТы можешь позволить себе рекламу!\nРеклама встанет в очередь после модерации.\nВведи адрес канала и к какой тематике она соответствует через запятую (например - @antonbot, рекламная биржа):");
        sendMessage($token, $id, $msg.ReplyKeyboardRemove());
        $okotv = rand(1,5);
        mysqli_query($connect, "INSERT INTO `quest` (`kanal`, `chatid`, `see`, `win`, `okotv`) VALUES ($message, $chatid, $rows, 0, $okotv)");
    }
}

if($message == "Пополнить через QIWI ✔")
{
    $query = mysqli_query($connect, "SELECT `pts` FROM `users` WHERE `chatid` = 343099999");
    $row = mysqli_fetch_assoc($query);
    $rows = mysqli_num_rows($query);
    $commendrand = rand(1000,9999);
    $summ = ($rows * 0.7) - $row['pts'];
    $message = "ТВОЙ БАЛАНС: " . $row['pts'] . urlencode(" PTS.\n\nПереведите на QIWI в течение 24 часов! \n\n🔻🔻🔻🔻🔻🔻🔻🔻🔻🔻\n1) КОШЕЛЕК: +79832356445\n2) СУММА: $summ рублей\n3) КОММЕНТАРИЙ: $commendrand\n🔺🔺🔺🔺🔺🔺🔺🔺🔺🔺\n\nБаланс пополнится в течении 3х минут.");
    $but1 = "Проверить 🔄";
    $but2 = "Выйти в меню 🔙";
    sendMessage($token, $id, $message.KeyboardMenu($but1,$but2)); 
}

if($message == "Проверить 🔄")
{
    $query = mysqli_query($connect, "SELECT `pts` FROM `users` WHERE `chatid` = $id");
    $row = mysqli_fetch_assoc($query);
    $message = "Твой баланс: " . $row['pts'] . urlencode(" PTS.\n\nБаланс обновляется раз в 3 минуты. ");
    $but1 = "Проверить 🔄";
    $but2 = "Выйти в меню 🔙";
    sendMessage($token, $id, $message.KeyboardMenu($but1,$but2)); 
}



file_put_contents("logs.txt",$connection);


function KeyboardMenu($but1,$but2){
    $buttons = [[$but1],[$but2]];
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
