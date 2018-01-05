<?php
require_once('connection.inc.php');

/*
function send_mail()
{ */
   $query='SELECT IP_Address,Student_Name,Email_id,DateOfExpiry FROM allocation';
  echo  $result=mysql_query($query);
   $subject='Expiration of allocated IP Address';
   $admin_email='From: kavitakandal199@gmail.com';
  
  while($row=mysql_fetch_array($result))
  {
    if(date('Y/m/d',time())==$row['DateOfExpiry']) {
    $body='Dear'.$row['Student_Name']."\n".'you are hereby informed of your IP Address\''.$row['IP_Address'].' expiration date that is on '.$row['DateOfExpiry'].' . Please Update if you want it to be continued.';
     if(mail($row['Email'],$subject,$body,$admin_email)) {
    // echo "<script type='text/javascript'>alert(\"$row['Student_Name']`s IP is due to expire on $row['DateOfExpiry'] \"); </script>" ;
      echo 'mail sent';
    } else {
      echo 'Mail could not be send to '.$row['Email_id'];
    }
  }

}
  mysql_free_result($result);
  mysql_close();
//}
 
 //send_mail();


?>