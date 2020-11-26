<?php
require_once '../vendor/autoload.php';
// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.mail.ru', 465, 'ssl'))
    ->setUsername('aska-pakhomova.87@mail.ru')
    ->setPassword('ForLoftSchool')
;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
$message = (new Swift_Message('Wonderful Subject'))
    ->setFrom(['aska-pakhomova.87@mail.ru' => 'aska-pakhomova.87@mail.ru'])
    ->setTo(['aska-pakhomova.87@mail.ru'])
    ->setBody('Here is the message itself')
    ->attach(Swift_Attachment::fromPath('.htaccess'))
;

// Send the message
$result = $mailer->send($message);