<?php
 require 'connection.inc.php';
 require 'logout_session.php';
 require_once 'menu.php';
 ob_start();


 echo ' <html>
        <head>
        
        </head>
        <body>


          <center>
            <font size="10" color="Blue" ><i> Change User Details</i></font><br><br><br>
            <form action="add_users.php" method="POST">
              <input type="submit" name="change_password" id="change_password" value="Change Password" style="height:30px; width:200px" /><br><br><br><br>
              <input type="submit" name="add_user" id="add_user" value="Add New User" style="height:30px; width:200px" /><br><br><br><br>
              <input type="submit" name="delete_user" id="delete_user" value="Delete User" style="height:30px; width:200px" />
            </form>
          </center>
        </body>
        </html>  ';

 if(isset($_POST['change_password'])&&!empty($_POST['change_password'])) {
      header('Location: change_password.php');
       } else if(isset($_POST['add_user'])&&!empty($_POST['add_user'])){
          header('Location: new_user.php');

       } else if(isset($_POST['delete_user'])&&!empty($_POST['delete_user'])) {
          header('Location: delete_user.php');
       }

?>
