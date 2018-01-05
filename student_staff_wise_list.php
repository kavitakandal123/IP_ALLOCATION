<?php
require ('connection.inc.php');
require ('logout_session.php');
include ('menu.php');
require_once ('insert_activities.php');
if(isset($_POST['List'])){
  if(!empty($_POST['List'])) {
  if(!empty($_POST['SSList'])&&$_POST['SSList']!=Null) {
    activities('Viewed database by : '.$_POST['SSList']);
    $Student_Staff=$_POST['SSList'];
    SSWise($Student_Staff);

  }
 }
}

?>
<!DOCTYPE html>
   <head>
    <title> Student/Staff Wise List </title>
   </head>
   <body>
  <center>
  <font size="10" color="Blue" ><i> Student/Staff Wise List</i></font>
   <br>
   <br>
   <h2><i>Select :</i></h2> <br><br>
   <form action ="student_staff_wise_list.php" method="POST">
   <SELECT name="SSList" id="SSList">
    <option name="SSList" value="" checked></option>
     <option name="SSList" value="Student"><strong>Student</strong></option>
     <option name="SSList" value="Staff"><strong>Staff</strong></option>
   </Select>
    &emsp;&emsp;&emsp;<input type="submit" name="List" value="List"/><br> <br> <br> <br>
   </form>

 <?php
  function SSWise($Student_Staff) {
    $query="SELECT * FROM allocation  WHERE Student_Staff ='$Student_Staff'";
    $result=mysql_query($query);
    if(1) {
    if(mysql_num_rows($result)) {
    echo ' <center>

    <table border="2" cellspacing="8" cellpadding="8">
    <caption><h1><i>'.$Student_Staff.'</i></h1></caption>
   <tr>

     <th>ID </th>
     <th>IP Address </th>
     <th>Lab Name </th>
     <th>Student_Staff</th>
     <th>Name </th>
     <th>MAC Address </th>
     <th>Email id </th>
     <th>Date Of Allocation </th>
     <th>Date Of Expiry </th>
     <th>Year</th>
   </tr>  ';
      while($row=mysql_fetch_array($result))  {
         $DateOfAllocation=date_create($row['DateOfAllocation']);
         $DateOfExpiry=date_create($row['DateOfExpiry']);
         echo "<tr>";
         echo "<td>".$row['ID']."</td>";
         echo "<td>".$row['IP_Address']."</td>";
         echo "<td>".$row['Lab_Name']."</td>";
         echo "<td>".$row['Student_Staff']."</td>";
         echo "<td>".$row['Name']."</td>";
         echo "<td>".$row['MAC_Address']."</td>";
         echo "<td>".$row['Email_id']."</td>";
         echo "<td>".date_format($DateOfAllocation,'d/m/Y')."</td>";
         echo "<td>".date_format($DateOfExpiry,'d/m/Y')."</td>";
         echo "<td>".$row['Year']."</td>";
         echo "</tr>";
   }
 } else  {
    echo '<center><h2><i>No data for '.$Student_Staff.'</i></h2></center>';
 }
    }
 }

   echo '</center>';

 ?>

 </center>
 </body>
 </html>