<?php
  require_once('connection.inc.php');
  require_once ('insert_activities.php');
  ob_start();
   $query='SELECT * FROM Admin_users';
   $result=mysql_query($query);
   $page='welcome.php';

  if(isset($_POST['username'])&&isset($_POST['password']))
  { if(!empty($_POST['username'])&&!empty($_POST['password']))
     { $username= mysql_real_escape_string($_POST['username']);
       $password=md5(mysql_real_escape_string($_POST['password']));
       $flag=false;
     while($row=mysql_fetch_array($result))
     {if($username==$row['User_Name']&&$password==$row['Password']){
              $ID=$row['ID'];
              $flag=true;
              break;
       }
       else{
            $flag=false;
       }
     }
       if($flag==false){
       echo "<script type='text/javascript'>alert('Access Denied');</script>";
       }else{
         session_start();
         $_SESSION['userName']=$username;
         $_SESSION['ID']=$ID;
         date_default_timezone_set('Asia/Calcutta');
         $_SESSION['Time']=date('Y/m/d H:i:s',time());
         insert($_SESSION['ID'],$_SESSION['Time']);
          header('Location: '.$page);
       }

     }
  else{
       echo "<script type='text/javascript'>alert('Please fill in the username and the password');</script>";

     }
     

}
?>
<html>
<head><title>Login</title>
</head>
<body>
 <center>
  <font align="center"  style="forte" color="seablue"><h1>IP ADDRESS ALLOCATION</h1></font>

  <hr size="3" color="black"> <br><br><br><br><br><br><br><br><br>
  <form action="login.php" method="POST" >
  <strong>USERNAME:</strong>&nbsp&nbsp
  <input type="text" name="username" >
  <br><br>
  <strong>PASSWORD:</strong>&nbsp&nbsp
  <input type="password" name="password" >
  <br><br>
  <input type="submit" name="login" value="LOGIN" >
 </center>

</form>
</body>
</html>