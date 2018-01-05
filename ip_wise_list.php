<?php
//ip_wise_list.php
require 'connection.inc.php';
require 'logout_session.php';
include 'menu.php';
require_once 'insert_activities.php';
if(isset($_POST['List'])){
  if(!empty($_POST['List'])) {
  if(!empty($_POST['IPList'])&&$_POST['IPList']!=Null) {
    activities('Viewed database by : '.$_POST['IPList']);
    $IP_Address=$_POST['IPList'];
    IPWise($IP_Address);

  }
 }
}

 echo '

<!DOCTYPE html>
   <head>
    <title> IP Wise List </title>
   </head>
   <body>
  <center>
  <font size="10" color="Blue" ><i> IP Wise List</i></font>
   <br>
   <br>
   <h2><i>Choose IP Address :</i></h2> <br><br>
   <form action ="ip_wise_list.php" method="POST">
   <SELECT name="IPList" id="IPList">
    <option name="IPList" value="" checked></option>';

         $select="SELECT IP_Address FROM ips ";
         $select_result=mysql_query($select);
         while($row=mysql_fetch_array($select_result)) {

              echo '<option value="'; echo $row['IP_Address'] ; echo '" name="IP_Address" >'; echo $row['IP_Address'] ; echo '</option>';
         }
     echo'

   </Select>
   &emsp;&emsp;&emsp;<input type="submit" name="List" value="List"/><br> <br> <br> <br>
   </form>';


  function IPWise($IP_Address) {
    $query="SELECT * FROM allocation  WHERE IP_Address LIKE '$IP_Address.___' ";
    $result=mysql_query($query);
      if(1) {
    if(mysql_num_rows($result)) {
      echo ' <center>

    <table border="2" cellspacing="8" cellpadding="8">
    <caption><h1><i>'.$IP_Address.'</i></h1></caption>
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
 }
   else {
    echo '<center><h2><i>No data for IP '.$IP_Address.'</i></h2></center>';
 }
  }
   }
       echo '</center>';



 echo '</center>
 </body>
 </html>';
 ?>