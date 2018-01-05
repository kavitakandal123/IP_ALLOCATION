<?php
 require_once 'connection.inc.php';
 require_once 'logout_session.php';
 require_once 'menu.php';
 require_once 'insert_activities.php';
 if($conn) {
 if(isset($_POST['Submit'])&&!empty($_POST['Submit'])) {
   if(isset($_POST['User_Name'])&&isset($_POST['Password'])&&isset($_POST['Confirm_Password'])) {
     if(!empty($_POST['User_Name'])&&!empty($_POST['Password'])&&!empty($_POST['Confirm_Password'])) {
      $select='SELECT User_Name FROM admin_users';
      $select_result=mysql_query($select);
      while($row=mysql_fetch_array($select_result)) {
       if($_POST['User_Name']==$row['User_Name']) {
        $flag=true;
         echo "<script type='text/javascript'>alert('Username already exists.');</script>";
        break;
       } else {
         $flag=false;
       }
      }
      if($flag==false) {
       if(preg_match('/^[a-zA-Z0-9]*$/',$_POST['User_Name'])&&strlen($_POST['User_Name'])<=40) {
         if(preg_match('/^[a-zA-Z0-9!@#$%^&*_]*$/',$_POST['Password'])) {
           if($_POST['Password']==$_POST['Confirm_Password']){
             $User_Name=mysql_real_escape_string($_POST['User_Name']);
             $Password=md5(mysql_real_escape_string($_POST['Password']));
             $Confirm_Password=mysql_real_escape_string($_POST['Confirm_Password']);
             $insert="INSERT INTO admin_users VALUES ('Null','$User_Name','$Password')";
             $insert_result=mysql_query($insert);
             if($insert_result){
                echo "<script type='text/javascript'>alert('New User Added.');</script>";
                activities('New user added by the name: '.$User_Name);
           header('refresh:2 ; url=new_user.php');
             } else {
           echo "<script type='text/javascript'>alert('New User Could not be added.');</script>";
             }
           } else {
           echo "<script type='text/javascript'>alert('Passwords do not match.');</script>";
           }
         } else {
           echo "<script type='text/javascript'>alert('Invalid Password.');</script>";
       }
       } else {
           echo "<script type='text/javascript'>alert('Invalid username.<br> Only alphabets and digits can be used. ');</script>";
       }
      }
     } else {
           echo "<script type='text/javascript'>alert('Please fill all the fields');</script>";
     }

   }
 }
}


?>
<html>
<head>
</head>

<body>

    <center> <font size="10" color="Blue" ><i>Add New User</i></font> </center> <br><br><br><br>
     <form action="new_user.php" method="POST">
       &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;<b>USERNAME :</b>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;<input type="text" name="User_Name" id="User_Name"/>&emsp;&emsp;&nbsp;<br><br>
      &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<b>PASSWORD :</b>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;<input type="Password" name="Password" id="Password"/>&emsp;&emsp;&emsp;&emsp;&nbsp;<br><br>
      &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;<b>CONFIRM PASSWORD :</b>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;<input type="Password" name="Confirm_Password" id="Confirm_Password"/>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;<br><br>
        <center> <input type="submit" name="Submit" ><br><br>  </center>

     </form>

</body>
</html>
<form>