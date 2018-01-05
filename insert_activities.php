<?php
  require_once 'connection.inc.php';
     function insert($ID,$login_time) {
       if(isset($_SESSION['ID'])&&!empty($_SESSION['ID'])) {
        $ID=$_SESSION['ID'];
        $insert="INSERT INTO activities VALUES('$ID','$login_time','','Null')";
        $result=mysql_query($insert);
       }
     }
     function activities($activities='',$logout_time=Null) {
       if(isset($_SESSION['ID'])&&!empty($_SESSION['ID'])) {
        $ID=$_SESSION['ID'];
        $login_time=$_SESSION['Time'];
        $select="SELECT * FROM activities WHERE Access_Time='$login_time' AND User_ID='$ID' ";
        $select_result=mysql_query($select);
           while($row=mysql_fetch_assoc($select_result)) {
             if(preg_match('/'.$activities.'/',$row['User_Activities'])) {
                $activities=$row['User_Activities'];
             } else {
                if($row['User_Activities']=='') {
                $activities=" ".$activities ;
                }
                else  {
                $activities=$row['User_Activities']."  ;  ".$activities;
                }
             }
             $update="UPDATE activities SET User_Activities='$activities',Logout_Time='$logout_time' WHERE Access_Time='$login_time' AND User_ID='$ID'";
             $update_result=mysql_query($update);
           }



     }
    }
?>