<?php
 ob_start();
 if(isset($_POST['HOME'])) {
   if(!empty($_POST['HOME'])) {
   header('Location: welcome.php');
   }
 }
 if(isset($_POST['ALLOCATE'])) {
   if(!empty($_POST['ALLOCATE'])) {
   header('Location: allocate.php.php');
   }
 }
 if(isset($_POST['DATABASE'])) {
   if(!empty($_POST['DATABASE'])) {
   header('Location: display_database.php');
   }
 }
 if(isset($_POST['ACTIVITIES'])) {
   if(!empty($_POST['ACTIVITIES'])) {
   header('Location: user_activities.php');
   }
 }
  if(isset($_POST['REPORTS'])) {
   if(!empty($_POST['REPORTS'])) {
   header('Location: reports.php');
   }
 }
  if(isset($_POST['NEW_ENTRY'])) {
   if(!empty($_POST['NEW_ENTRY'])) {
   header('Location: lab_list.php');
   }
 }
 if(isset($_POST['CHANGE_USER_DETAILS'])) {
   if(!empty($_POST['CHANGE_USER_DETAILS'])) {
   header('Location: add_users.php');
   }
 }
 if(isset($_POST['SEARCH'])) {
   if(!empty($_POST['SEARCH'])) {
   header('Location: search.php');
   }
 }


?>
<html>
<body>
<form action="<?php echo $_SERVER['SCRIPT_NAME'] ;?>" method="POST">

  <input type="submit" name="HOME" value="HOME" id="HOME"/>   &emsp;&emsp;&emsp;&emsp;&emsp;
  <input type="submit" name="ALLOCATE" value="ALLOCATE" id="ALLOCATE"/>  &emsp;&emsp;&emsp;&emsp;&emsp;
  <input type="submit" name="DATABASE" value="DATABASE" id="DATABASE"/>  &emsp;&emsp;&emsp;&emsp;&emsp;
  <input type="submit" name="ACTIVITIES" value="ACTIVITIES" id="ACTIVITIES"/>       &emsp;&emsp;&emsp;&emsp;&emsp;
  <input type="submit" name="REPORTS" value="REPORTS" id="REPORTS"/>    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
  <input type="submit" name="NEW_ENTRY" value="NEW ENTRY" id="NEW_ENTRY"/>    &emsp;&emsp;&emsp;&emsp;&emsp;
  <input type="submit" name="CHANGE_USER_DETAILS" value="CHANGE USER DETAILS" id="CHANGE_USER_DETAILS"/>    &emsp;&emsp;&emsp;&emsp;&emsp;
  <input type="submit" name="SEARCH" value="SEARCH" id="SEARCH"/>    &emsp;&emsp;
  <hr size="4" color="black">
</form>
</body>
</html>