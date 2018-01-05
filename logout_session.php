<?php
   ob_start();
   session_start();
require_once ('insert_activities.php');
 
   function logout(){
        session_destroy();
        header('Location: login.php');
      }
   if(isset($_SESSION['userName']))
    echo 'Welcome '.$_SESSION['userName'];
    else
     die('<br><br><br><center><h1>Login first</h1></center>');
   if(isset($_POST['logout'])){
     if(!empty($_POST['logout'])) {
       date_default_timezone_set('Asia/Calcutta');
       $logout_time=date('Y/m/d H:i:s',time());
       activities('',$logout_time);
      logout();
     }
    }






?>

<form align="right" action="welcome.php" method="POST">
  <input type="submit" name="logout" Value="Log Out" >
  </input>
</form>
<hr size="2" color="black">
