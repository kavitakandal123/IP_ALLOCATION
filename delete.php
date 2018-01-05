<?php
   require 'connection.inc.php';
   function Delete($ID) {
         $query="DELETE FROM allocation WHERE ID='$ID'";
         $result=mysql_query($query);
   }
   function Delete_activities() {
         $query="DELETE FROM activities";
         $result=mysql_query($query);
         if($result) {
           echo '<script type="text/javascript">alert("All user actitvities deleted!! ");</script>';
         } else {
           echo '<script type="text/javascript">alert("User actitvities not deleted!! ");</script>';
         }
   }
   function delete_user($User_Name) {
      $query="DELETE FROM admin_users WHERE User_Name='$User_Name'";
     echo $result=mysql_query($query);
      if($result) {
           echo '<script type="text/javascript">alert("User deleted!! ");</script>';
      } else {
           echo '<script type="text/javascript">alert("User Not deleted!! ");</script>';
      }
   }


?>