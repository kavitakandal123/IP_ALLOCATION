<?php
require ('logout_session.php');
include ('menu.php');

if(isset($_POST['LabWise'])) {
 if(!empty($_POST['LabWise'])) {
   header('Location: lab_wise_list.php');
 }
}

if(isset($_POST['YearWise'])) {
 if(!empty($_POST['YearWise'])) {
   header('Location: year_wise_list.php');
 }
}
if(isset($_POST['IPWise'])) {
 if(!empty($_POST['IPWise'])) {
   header('Location: ip_wise_list.php');
 }
}
if(isset($_POST['SSWise'])) {
 if(!empty($_POST['SSWise'])) {
   header('Location: student_staff_wise_list.php');
 }
}


?>

<html>
<head>
  <title >Reports</title>
</head>

<body>
<center>
 <h1><i> REPORTS </i></h1><br><br><br><br>
 <form action="reports.php" method="POST">
 <input type="submit" name="LabWise" value="Lab Wise List" id="LabWise" style="height:50px; width:300px"/><br><br>
 <input type="submit" name="YearWise" value="Year Wise List" id="YearWise" style="height:50px; width:300px"/><br><br>
 <input type="submit" name="IPWise" value="IP Wise List" id="IPWise" style="height:50px; width:300px"/><br><br>
 <input type="submit" name="SSWise" value="Student/Staff Wise List" id="SSWise" style="height:50px; width:300px"/><br><br>

 </form>
 </center>
</body>
</html>