<?php
/**
 * [sendEmail description]
 * @param  [type] $from    [description]
 * @param  [type] $to      [description]
 * @param  [type] $subject [description]
 * @param  [type] $message [description]
 * @return [type]          [description]
 */
function sendEmail($from, $to, $subject, $message)
{
    if (is_array($to)) {
        $to = implode(',', $to);
    }

    return mail($to, $subject, $message, "Content-Type: text/html; charset=utf-8;\nFrom: $from");
}

$from = '111111';
$to = array(
    '111111',
    '111111'
);


$message = '';

if ( (isset($_POST)) && (!empty($_POST)) ) {

    $subject = 'С лендинга special.citrusfit.ru поступила заявка';

    $dump = array(
        'fio' => false,
        'phone' => false,
        'description' => $subject,
    );

    if (isset($_POST['Имя'])) {
        $dump['fio'] = $_POST['Имя'];
    }
    if (isset($_POST['Телефон'])) {
        $dump['phone'] = $_POST['Телефон'];
    }

    require_once('amo.php');




    $message .= 'С лендинга special.citrusfit.ru поступила заявка:<br><br>';

    foreach ($_POST as $key => $value) {
        $message .= '<b>' . htmlspecialchars($key) . ':</b> ' . htmlspecialchars($value) . '<br>';
    }

    if (sendEmail($from, $to, $subject, $message)) {
        header("Location: http://special.citrusfit.ru?email_ok=1");
    } else {
        header("Location: http://special.citrusfit.ru?email_fail=1");
    }
} else {
    header("Location: http://special.citrusfit.ru");
}

die();

?>