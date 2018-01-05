<?php
require 'connection.inc.php';
require 'logout_session.php';
include 'menu.php';
include 'delete.php';

 $query="SELECT * FROM admin_users JOIN activities ON Admin_Users.ID=Activities.User_ID";
 $result=mysql_query($query);



if(mysql_num_rows($result)) {
echo '
<html>
  <head>
   <title>User Activities</title>
  </head>
  <body>
  
    <center>
    <table border="0" cellspacing="10" cellpadding="10"> <br><br><br><br>
     <caption>    <center> <font size="10" color="Blue" ><i>User Activities</i></font> </center> <br><br><br><br></caption>
      <tr>
        <th>User ID</th>
        <th>User Name</th>
        <th>Access Time</th>
        <th>Activities Performed</th>
        <th>Logout Time </th>
      </tr> ';


    while($row=mysql_fetch_array($result)) {
         echo "<tr>";
         echo "<td>".$row['User_ID']."</td>";
         echo "<td>".$row['User_Name']."</td>";
         echo "<td>".$row['Access_Time']."</td>";
         echo "<td>".$row['User_Activities']."<br><br></td>";
         echo "<td>".$row['Logout_Time']."</td>";
         echo "<tr>";
   }


   function del() {
   echo '
   <br><br><br><br><br>
   <center><form action="user_activities.php" method="POST" >
     <input type="submit" name="Delete" value="Delete Activities" id="Delete" style="height:30px; width=300px"/>
   </form> 
   </center>';
   }

  echo '</table>
   </center>
  </body>
</html>  ';
del();
}

else {
  echo '<br><br><center><h1>No activities to show....</h1></center>';
}



if(isset($_POST['Delete'])&&!empty($_POST['Delete'])) {
 Delete_activities();
}
?>

