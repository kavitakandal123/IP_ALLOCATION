<?php
  require_once 'connection.inc.php';
  require_once 'delete.php';
  require_once 'logout_session.php';
  require_once 'menu.php';
  
  if(isset($_POST['delete_user'])&&!empty($_POST['delete_user'])) {
    delete_user($_POST['User_Name']);
  }
?>

<html>
<head>
  <title>Delete user</title>
</head>
<body>
<br><br><br>
 <center>
 <font size="10" color="Blue" ><i> Delete User </i></font><br><br><br>
 <form action="delete_user.php" method="POST">
     <b>USERNAME :</b><br><br>
    <input type="text" name="User_Name" id="User_Name"><br><br><br>
    <input type="submit" name="delete_user" id="delete_user" value="Delete User" style="height:30px; width:200px" />
 </form>
 </center>
</body>
</html>