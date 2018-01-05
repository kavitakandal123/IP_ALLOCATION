<?php
require 'connection.inc.php';
require 'logout_session.php';
require_once 'menu.php';

 function labs_insert() {
  $Lab_Name=mysql_real_escape_string($_POST['Lab_Name']);
  $insert="INSERT INTO labs VALUES('Null','$Lab_Name')";
  $insert_result=mysql_query($insert);
  if($insert_result) {
    unset($_POST['Add_Lab']);
    header('refresh: 2; url=lab_list.php');
    echo "<script type='text/javascript'>alert('Lab Name Added');</script>";
  } else {
    echo "<script type='text/javascript'>alert('Lab Name could not be Added');</script>";
  }
 }

function ip_insert() {
  $IP_Address=mysql_real_escape_string($_POST['IP_Address']);
  $insert="INSERT INTO ips VALUES('Null','$IP_Address')";
  $insert_result=mysql_query($insert);
  if($insert_result) {
    unset($_POST['Add IP']);
    header('refresh: 2; url=lab_list.php');
    echo "<script type='text/javascript'>alert('IP series Added');</script>";
  }
}

if($conn){
if(isset($_POST['Add_Lab'])&&!empty($_POST['Add_Lab'])) {
   if(isset($_POST['Lab_Name'])) {
    if(!empty($_POST['Lab_Name'])) {
      if(strlen($_POST['Lab_Name'])<=50) {
         $select="SELECT Lab_Name FROM labs";
         $select_result=mysql_query($select);
         $flag=false;
         while($row=mysql_fetch_array($select_result)) {
          if($_POST['Lab_Name']==$row['Lab_Name']) {
            $flag=true;
            echo "<script type='text/javascript'>alert('Lab Name already Exists');</script>";
            break;
          } else {
            $flag=false;
          }
         }
         if($flag==false) {
            labs_insert();
         }
    } else {
      echo "<script type='text/javascript'>alert('Lab Name is too long!!');</script>";
    }
   } else {
      echo "<script type='text/javascript'>alert('Please enter the lab Name');</script>";
    }
   }
 } else if(isset($_POST['Add_IP'])&&!empty($_POST['Add_IP'])) {
    if(isset($_POST['IP_Address'])) {
     if(!empty($_POST['IP_Address'])) {
       if(preg_match('/^[0-9]*.[0-9]*.[0-9]*$/',$_POST['IP_Address'])) {
         $select="SELECT IP_Address FROM ips";
         $select_result=mysql_query($select);
         while($row=mysql_fetch_array($select_result)) {
          if($_POST['IP_Address']==$row['IP_Address']) {
            $flag=true;
            break;
          } else {
            $flag=false;
          }
         }
         if($flag==true) {
            echo "<script type='text/javascript'>alert('IP series already Exists');</script>";
         }
         else {
            ip_insert();
         }

       } else {
            echo "<script type='text/javascript'>alert('IP series is invalid');</script>";
       }
    } else {
      echo "<script type='text/javascript'>alert('Please enter the IP Address');</script>";
    }
   }
 }
}  else {
     echo '<b>Connection failed</b>';
     die();
  }

?>

<html>
<head>
</head>
<body>
 <center>
   <font size="10" color="Blue" ><i> New Lab Names and IP series</i></font>  
   <br><br><br>
    <form action="lab_list.php" method="POST">
   <b>NEW LAB NAME:</b> <br><br>
   <input type="text" name="Lab_Name" id="Lab_Name"/> <br><br>
   <input type="submit" name="Add_Lab" id="Add_Lab" value="Add_Lab"/>
   <br><br><br><br><br><br><br><br><br><br><br>
   <b>NEW IP SERIES:</b> <br><br>
   <input type="text" name="IP_Address" id="IP_Address"/> <br><br>
   <input type="submit" name="Add_IP" id="Add_IP" value="Add_IP"/>
  </form>
  </center>
</body>
</html>