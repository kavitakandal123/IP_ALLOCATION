<?php
 require_once 'connection.inc.php';
  require_once 'logout_session.php';
  require_once 'menu.php';
  require_once 'insert_activities.php';
function  change_password() {

   echo '<center>
     <font size="10" color="Blue" ><i>Set New Password</i></font>  <br><br>

    <form action="change_password.php" method="POST">
      <h3>USERNAME:</h3><input type="text" name="User_Name" id="User_Name" value="'; echo $_SESSION['userName']; echo '"> <br><br><br>
      <h3>NEW PASSWORD:</h3><input type="password" name="new_password" id="new_password"/>   <br><br><br>
      <h3>CONFIRM PASSWORD:</h3><input type="password" name="confirm_password" id="confirm_password"/> <br><br><br>
      <input type="submit" name="Submit" id="Submit" value="Submit"/>  <br><br><br>
    </form>
  </center>';
    if(isset($_POST['Submit'])&&!empty($_POST['Submit'])) {
      if(isset($_POST['new_password'])&& isset($_POST['confirm_password']) ) {
        if(!empty($_POST['new_password'])&&!empty($_POST['confirm_password'])) {
          $User_Name=mysql_real_escape_string($_POST['User_Name']);
          $new_password=mysql_real_escape_string($_POST['new_password']);
          $confirm_password=mysql_real_escape_string($_POST['confirm_password']);
          if($new_password==$confirm_password) {
            $ID=$_SESSION['ID'];
            $new_password=md5($new_password);
            $update="UPDATE admin_users SET User_Name='$User_Name',Password='$new_password' WHERE ID='$ID'";
            $result_update=mysql_query($update);
            if($result_update) {
              echo '<script type="text/javascript">alert("Password Changed!!  ");</script>';
              activities('Password changed by: '.$User_Name);
              $_SESSION['userName']=$User_Name;
              header('refresh:2; url=change_password.php');
            } else {
              echo '<script type="text/javascript">alert("Password not Changed!!  ");</script>';
            }
          } else {
              echo '<script type="text/javascript">alert("Passwords don\'t match!!  ");</script>';
          }
        } else {
            echo '<script type="text/javascript">alert("Please Enter the Password");</script>';
        }
      }
    }
 }
change_password();

?>

