<?php

require __DIR__.'/vendor/autoload.php';
use Joli\JoliNotif\NotifierFactory;
use Joli\JoliNotif\Notification;

$notifier = NotifierFactory::create();
echo $notifier;
if ($notifier) {
  $notification = 
    (new Notification())
    ->setTitle('T�tulo de ejemplo')
    ->setBody('Este un ejemplo de contenido de la notificai�n')
    ;
}

$notifier->send($notification);
echo 'done';



?>