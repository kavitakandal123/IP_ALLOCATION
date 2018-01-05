<?php
require 'connection.inc.php';
ob_start();
function Update() {
   ob_start();
  global $conn;
 if ($conn) {
   if(isset($_POST['Update'])&&!empty($_POST['Update'])) {

     if((isset($_POST['IP_Address'])&&!empty($_POST['IP_Address'])) OR (isset($_POST['Name'])&&!empty($_POST['Name']))){
       $query1="SELECT IP_Address FROM allocation ";
       $result1=mysql_query($query1);
     if(!empty($_POST['IP_Address'])) {
      if(preg_match('/^[0-9]*.[0-9]*.[0-9]*.[0-9]*$/',$_POST['IP_Address'])) {
       while($row1=mysql_fetch_array($result1)) {
         if($_POST['IP_Address']==$row1['IP_Address']) {
          $flag=true;
          break;
          } else  {
         $flag=false;
         }
       }
         if($flag==true) {
           Update_by_IP();

         }
         else if(!empty($_POST['Name'])) {
            $query1="SELECT Name FROM allocation ";
            $result1=mysql_query($query1);
           while($row1=mysql_fetch_array($result1)) {
            if($_POST['Name']==$row1['Name']) {
              $flag=true;
              break;
            } else  {
              $flag=false;
            }
           }  if($flag==true) {

                 Update_by_Name();
               } else {
                  echo "<script type='text/javascript'>alert('Both IP Address and Name does not exists. You need at least one of them to update!! ');</script>";
               }
          } else {
             echo "<script type='text/javascript'>alert('IP Address does not exists!! ');</script>";
          }
       } else {
           echo "<script type='text/javascript'>alert('Allocated IP is Invalid');</script>";
       }
      } else if(!empty($_POST['Name'])) {
            $query1="SELECT Name FROM allocation ";
            $result1=mysql_query($query1);
           while($row1=mysql_fetch_array($result1)) {
            if($_POST['Name']==$row1['Name']) {
              $flag=true;
              break;
            } else  {
              $flag=false;
            }
           }  if($flag==true) {
                 Update_by_Name();
               } else {
                  echo "<script type='text/javascript'>alert(' Name does not exists. You cannot update!! ');</script>";
               }
          }
       
       
      } else {
           echo "<script type='text/javascript'>alert('Please Enter IP Address or Name to update record!! ');</script>";
        }
            }
       

    }  else {
          die('Connection failed.');
         }
}
    
    function Update_by_IP(){
      ob_start();
               if(preg_match('/^[0-9]*.[0-9]*.[0-9]*.[0-9]*$/',$_POST['IP_Address'])) {
                 $query1="SELECT IP_Address FROM allocation ";
                 $result1=mysql_query($query1);
                while($row1=mysql_fetch_array($result1)){

                 if($_POST['IP_Address']==$row1['IP_Address']){
                    $flag=true;
                    $IP_Address=$_POST['IP_Address'];
                     activities('Updated IP : '.$IP_Address);
                    break;
                    } else {
                    $flag=false;
                    }
                }
                if($flag==false){
                 echo "<script type='text/javascript'>alert('IP Address does not exists!! You cannot update. ');</script>";
                }
               } else {
                  echo "<script type='text/javascript'>alert('Allocated IP is not valid');</script>";
               }

           $query2="SELECT * FROM allocation WHERE IP_Address='$IP_Address'";
           $result2=mysql_query($query2);
           while($row2=mysql_fetch_array($result2)) {

                 if(isset($_POST['Lab_Name'])&&!empty($_POST['Lab_Name'])){
                    $Lab_Name=$_POST['Lab_Name'];
                 } else if($_POST['Lab_Name']==Null){
                    $Lab_Name=$row2['Lab_Name'];
                 }
                 if(isset($_POST['ss'])&&!empty($_POST['ss'])){
                    $Student_Staff=$_POST['ss'];
                 } else {
                    $Student_Staff=$row2['Student_Staff'];
                 }
                 if(isset($_POST['Name'])&&!empty($_POST['Name'])){
                    $Name=$_POST['Name'];
                 } else if($_POST['Name']==Null){
                    $Name=$row2['Name'];
                 }
                 //MAC_Address
                  if(isset($_POST['MAC_Address'])&&!empty($_POST['MAC_Address'])){
                    $query1="SELECT IP_Address,MAC_Address FROM allocation ";
                    $result1=mysql_query($query1);
                    while($row1=mysql_fetch_array($result1)){
                      if($_POST['MAC_Address']==$row1['MAC_Address'] && $IP_Address!=$row1['IP_Address']){
                          $flag=true;
                          echo "<script type='text/javascript'>alert('MAC Address already exists!! ');</script>";
                          break;
                          } else {
                          $flag=false;
                          }
                      }
                      if($flag==false){
                       $MAC_Address=$_POST['MAC_Address'];
                      }

                 } else {
                    $MAC_Address=$row2['MAC_Address'];
                 }

                 if(isset($_POST['Email'])&&!empty($_POST['Email'])){
                   if(filter_var($_POST['Email'],FILTER_VALIDATE_EMAIL)) {
                     $query1="SELECT IP_Address,Email_id FROM allocation ";
                     $result1=mysql_query($query1);
                      while($row1=mysql_fetch_array($result1)){

                       if($_POST['Email']==$row1['Email_id'] && $IP_Address!=$row1['IP_Address']){
                          $flag=true;
                          echo "<script type='text/javascript'>alert('Email Id already exists!! ');</script>";
                          break;
                          } else {
                          $flag=false;
                          }
                      }
                      if($flag==false){
                       $Email=$_POST['Email'];
                      }
                 } else {
                     echo "<script type='text/javascript'>alert('Email Id is Invalid !! ');</script>";
                 }
                } else if($_POST['Email']==''){
                    $Email=$row2['Email_id'];
                 }

                 if(isset($_POST['DOA'])&&!empty($_POST['DOA'])){
                    $date=date_create($_POST['DOA']);
                     $DOA=date_format($date,'Y/m/d');
                     $Year=date_format($date,'Y');
                 } else {
                     $DOA=$row2['DateOfAllocation'];
                     $Year=$row2['Year'];
                 }
                 if(isset($_POST['DOE'])&&!empty($_POST['DOE'])){
                    $date=date_create($_POST['DOE']);
                     $DOE=date_format($date,'Y/m/d');
                 } else {
                    $DOE=$row2['DateOfExpiry'];
                 }

               }
         if(isset($Lab_Name)&&isset($Student_Staff)&&isset($Name)&&isset($MAC_Address)&&isset($Email)&&isset($IP_Address)) {
          $update="UPDATE allocation SET Lab_Name='$Lab_Name',Student_Staff='$Student_Staff',Name='$Name', MAC_Address='$MAC_Address', Email_id='$Email', DateOfAllocation='$DOA', DateOfExpiry='$DOE',Year='$Year' WHERE IP_Address='$IP_Address'";
          $update_result=mysql_query($update);
           if($update_result) {
                   activities('Updated Record IP: $IP_Address');
                   unset($_POST['Update']);
                    header('refresh:3; url= allocate.php.php');
                    echo "<script type='text/javascript'>alert('Database  UPDATED');</script>";
           }
         }  else {
                    echo "<script type='text/javascript'>alert('Database could not be UPDATED');</script>";
           }
  }


       function Update_by_Name() {
         ob_start();
         if(isset($_POST['Name'])&&!empty($_POST['Name'] )) {
            $Name=$_POST['Name'];

            $query2="SELECT * FROM allocation WHERE Name='$Name'";
            $result2=mysql_query($query2);
           while($row2=mysql_fetch_array($result2)) {
            if(isset($_POST['IP_Address'])&&!empty($_POST['IP_Address'])){
              $IP_Address=$_POST['IP_Address'];
           } else {
              $IP_Address=$row2['IP_Address'];
           }
           if(isset($_POST['Lab_Name'])&&!empty($_POST['Lab_Name'])){
              $Lab_Name=$_POST['Lab_Name'];
           } else {
              $Lab_Name=$row2['Lab_Name'];
           }
           if(isset($_POST['ss'])&&!empty($_POST['ss'])){
              $Student_Staff=$_POST['ss'];
           } else {
              $Student_Staff=$row2['Student_Staff'];
           }
           if(isset($_POST['MAC_Address'])&&!empty($_POST['MAC_Address'])){
              $query1="SELECT Name,MAC_Address FROM allocation ";
              $result1=mysql_query($query1);
              while($row1=mysql_fetch_array($result1)){
                 if($_POST['MAC_Address']==$row1['MAC_Address'] && $Name!=$row1['Name']){
                    $flag=true;
                    echo "<script type='text/javascript'>alert('MAC Address already exists!! ');</script>";
                    break;
                    } else {
                    $flag=false;
                    }
                }
                if($flag==false){
                 $MAC_Address=$_POST['MAC_Address'];
                }

           } else {
              $MAC_Address=$row2['MAC_Address'];
           }

           if(isset($_POST['Email'])&&!empty($_POST['Email'])){
             if(filter_var($_POST['Email'],FILTER_VALIDATE_EMAIL)) {
               $query1="SELECT Name,Email_id FROM allocation ";
               $result1=mysql_query($query1);
                while($row_result=mysql_fetch_array($result)){
                 if($_POST['Email']==$row1['Email_id'] && $Name!=$row1['Name']){
                    $flag=true;
                    echo "<script type='text/javascript'>alert('Email Id already exists!! ');</script>";
                    break;
                    } else {
                    $flag=false;
                    }
                }
                if($flag==false){
                 $Email=$_POST['Email'];
                }
           } else {
                    echo "<script type='text/javascript'>alert('Email Id is Invalid!! ');</script>";
           }
          } else {
              $Email=$row2['Email_id'];
           }
           if(isset($_POST['DOA'])&&!empty($_POST['DOA'])){
                    $date=date_create($_POST['DOA']);
                     $DOA=date_format($date,'Y/m/d');
                     $Year=date_format($date,'Y');
                 } else {
                     $DOA=$row2['DateOfAllocation'];
                     $Year=$row['Year'];
                 }
                 if(isset($_POST['DOE'])&&!empty($_POST['DOE'])){
                    $date=date_create($_POST['DOE']);
                     $DOE=date_format($date,'Y/m/d');
                 } else {
                    $DOE=$row2['DateOfExpiry'];
                 }


         }

         if(isset($IP_Address)&&isset($Lab_Name)&&isset($Student_Staff)&&isset($MAC_Address)&&isset($Email)) {

           $update="UPDATE allocation SET IP_Address='$IP_Address',Lab_Name='$Lab_Name',Student_Staff='$Student_Staff', MAC_Address='$MAC_Address', Email_id='$Email', DateOfAllocation='$DOA', DateOfExpiry='$DOE',Year='$Year' WHERE Name='$Name'";
           $update_result=mysql_query($update);
           if($update_result) {
                    activities('Updated Record having name: $Name');
                    unset($_POST['Update']);
                    header('refresh:3; url=allocate.php.php');
                    echo "<script type='text/javascript'>alert('Database  UPDATED');</script>";
            }
          } else {
                   echo "<script type='text/javascript'>alert('Database could not be  UPDATED');</script>";
           }

       }
  }




?>

