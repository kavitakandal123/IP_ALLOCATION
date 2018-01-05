<?php
//year_wise_list.php

require 'connection.inc.php';
require 'logout_session.php';
include 'menu.php';
require_once ('insert_activities.php');
if(isset($_POST['List'])){
  if(!empty($_POST['List'])) {
  if(!empty($_POST['YearList'])&&$_POST['YearList']!=Null) {
    activities('Viewed database by Year : '.$_POST['YearList']);
    $Year=$_POST['YearList'];
    YearWise($Year);

  }
 }
}
?>
<!DOCTYPE html>
   <head>
    <title> Year Wise List </title>
   </head>
   <body>
  <center>
  <font size="10" color="Blue" ><i> Year Wise List </i></font>
   <br>
   <br>
   <h2><i>Enter Year :</i></h2> <br><br>
   <form action ="year_wise_list.php" method="POST">
   <!--<SELECT name="YearList" id="YearList">
    <option name="YearList" value="" checked></option>
     <option name="YearList" value="Computer Center"><strong>Computer Center</strong></option>
     <option name="YearList" value="Micro Biology"><strong>Micro Biology</strong></option>
   </Select>--!>
   <input type="text" name="YearList" value=""/><br> <br>
   <input type="submit" name="List" value="List"/><br> <br> <br> <br>
   </form>

 <?php
  function YearWise($Year) {
    $query="SELECT * FROM allocation  WHERE Year ='$Year'";
    $result=mysql_query($query);
    if(1) {
    if(mysql_num_rows($result)) {
    echo ' <center>

    <table border="2" cellspacing="8" cellpadding="8">
    <caption><h1><i>'.$Year.'</i></h1></caption>
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
    header('refresh:2; url=year_wise_list.php');
    echo '<center><h2><i>No data for year '.$Year.'</i></h2></center>';
 }
    }
 }

   echo '</center>';

 ?>

 </center>
 </body>
 </html>