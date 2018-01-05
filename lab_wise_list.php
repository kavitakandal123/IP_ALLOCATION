<?php
require 'connection.inc.php';
require 'logout_session.php';
include 'menu.php';
require_once ('insert_activities.php');

if(isset($_POST['List'])){
  if(!empty($_POST['List'])) {
  if(!empty($_POST['LabList']) && $_POST['LabList']!=Null) {
    activities('Viewed List by '.$_POST['LabList']);
    $Lab_Name=$_POST['LabList'];
    LabWise($Lab_Name);

  }
 }
}


echo '

<!DOCTYPE html>
   <head>
    <title> Lab Wise List </title>
   </head>
   <body>
  <center>
  <font size="10" color="Blue" ><i> Lab Wise List</i></font>
   <br>
   <br>
   <h2><i>Choose Lab Name :</i></h2> <br><br>
   <form action ="lab_wise_list.php" method="POST">
   <SELECT name="LabList" id="LabList">
    <option value="" name="LabList"></option> ';
        $select="SELECT Lab_Name FROM labs ";
         $select_result=mysql_query($select);
         while($row=mysql_fetch_array($select_result)) {

              echo '<option value="'; echo $row['Lab_Name'] ; echo '" name="LabList" >'; echo $row['Lab_Name'] ; echo '</option>';
         }

  echo ' </Select>
  &emsp;&emsp;&nbsp; <input type="submit" name="List" value="List"/><br> <br> <br> <br>
   </form> ';

  function LabWise($Lab_Name) {
    $query="SELECT * FROM allocation  WHERE Lab_Name ='$Lab_Name'";
    $result=mysql_query($query);
    if(1) {
    if(mysql_num_rows($result)) {

    echo ' <center>

    <table border="2" cellspacing="8" cellpadding="8">
    <caption><h1><i>'.$Lab_Name.'</i></h1></caption>
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
 } else {
    header('refresh:2; url=lab_wise_list.php');
    echo '<center><h2><i>No data for Lab '.$Lab_Name.'</i></h2></center>';

 }
  }
   }
  echo '</center>';



 echo '</center>
 </body>
 </html> ';
?>