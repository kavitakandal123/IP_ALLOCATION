<?php
 //sending mail through PHPMailer
 require 'PHPMAiler/PHPMailerAutoLoad.php';
  require 'connection.inc.php';

$mail =new PHPMailer;

$query='SELECT IP_Address,Name,Email_id,DateOfExpiry FROM allocation';
$result=mysql_query($query);

$admin_email='kavitakandal199@gmail.com';

$mail->IsSMTP();
$mail->Host = "smtp.gmail.com";
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Username = 'kavitakandal1997@gmail.com';
$mail->Password = 'radhalovekrishna';


while($row=mysql_fetch_array($result))
  {
    if(date('Y/m/d',time())==$row['DateOfExpiry']) {
    $mail->Body='Dear'.$row['Student_Name']."\n".'you are hereby informed of your IP Address\''.$row['IP_Address'].' expiration date that is on '.$row['DateOfExpiry'].' . Please Update if you want it to be continued.';
    $mail->addAddress($row['Email_id'],$row['Student_Name']);
    $mail->Subject='Expiration of allocated IP Address';
    $mail->setFrom($admin_email);
     if($mail->Send()) {
      echo 'mail sent to '.$row['Email_id'];
    } else {
      echo 'Mail could not be send to '.$row['Email_id'];
      echo '<br> Error occured: '.$mail->ErrorInfo;
    }
  }
 }
?>