<?php
require('PHPMailerAutoload.php');
require('class.smtp.php');
require('class.phpmailer.php');
$mail= new PHPMailer;
$mail->IsSMTP();
$mail->Host ='smtp.gmail.com';
$mail->SMTPDebug = 3;
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Username = 'kavitakandal1997@gmail.com';
$mail->Password = 'radhalovekrishna';


$mail->setFrom('kavitakandal1997@gmail.com','Kavita');
$mail->addAddress('kavitakandal1431997@gmail.com');
$mail->Subject='testing';
$mail->Body='hey this is kavita ... How are you?';
if($mail->Send()) {
 echo 'sent';
} else
 {echo 'sorry not send <br>';
  echo 'Error: '.$mail->ErrorInfo;
  }
?>