<?php

require_once 'connection.inc.php';
require_once 'logout_session.php';
require_once 'menu.php';
require_once 'update.php';
require_once 'insert_activities.php';
$select="SELECT IP_Address,MAC_Address,Email_id FROM allocation ";
$select_result=mysql_query($select);
 $flag=false;
   if($conn) {
     if(isset($_POST['Allocate'])) {
       if(!empty($_POST['Allocate'])) {
       if(isset($_POST['IP_Address'])||isset($_POST['Name'])|| isset($_POST['MAC_Address'])|| isset($_POST['Email'])|| isset($_POST['DOA'])|| isset($_POST['DOE'])) {
             if(isset($_POST['IP_Address'])&& !empty($_POST['IP_Address'])) {
               if(preg_match('/^[0-9]*.[0-9]*.[0-9]*.[0-9]*$/',$_POST['IP_Address'])) {
                while($row=mysql_fetch_array($select_result)){
                 global $flag;
                 if($_POST['IP_Address']==$row['IP_Address']){
                     $flag=true;
                    echo "<script type='text/javascript'>alert('IP Address already allocated!! ');</script>";
                    break;
                    } else {
                    $flag=false;
                    }
                }
                if($flag==false){
                 $IP_Address=mysql_real_escape_string($_POST['IP_Address']);
                }
               } else {
               echo "<script type='text/javascript'>alert('Allocated IP is not valid');</script>";
                }
             } else  {
                $IP_Address='';
             }

              if(isset($_POST['Lab_Name'])&& !empty($_POST['Lab_Name'])) {
                $Lab_Name=mysql_real_escape_string($_POST['Lab_Name']);
              } else  {
               $Lab_Name='';
             }

             if(isset($_POST['ss'])&& !empty($_POST['ss'])) {
                $Student_Staff=mysql_real_escape_string($_POST['ss']);
             } else  {
                $Student_Staff='';
             }


             if(isset($_POST['Name'])&& !empty($_POST['Name'])) {
               if(preg_match('/^[a-zA-Z. ]*$/',$_POST['Name'])) {
                $Name=mysql_real_escape_string($_POST['Name']);
               } else {
                echo "<script type='text/javascript'>alert('Enter a valid Name');</script>";
               }
             } else  {
                $Name='';
             }

             if(isset($_POST['MAC_Address'])&& !empty($_POST['MAC_Address'])) {

                while($row=mysql_fetch_array($select_result)){
                 if($_POST['MAC_Address']==$row['MAC_Address']){
                    $flag=true;
                    echo "<script type='text/javascript'>alert('MAC Address already exists!! ');</script>";
                    break;
                    } else {
                    $flag=false;
                    }
                }
                if($flag==false){
                 $MAC_Address=mysql_real_escape_string($_POST['MAC_Address']);
                }

             } else  {
                $MAC_Address='';
             }

             if(isset($_POST['Email'])&& !empty($_POST['Email'])) {
               if(filter_var($_POST['Email'],FILTER_VALIDATE_EMAIL)) {
                while($row=mysql_fetch_array($select_result)){
                 if($_POST['Email']==$row['Email_id']){
                    $flag=true;
                    echo "<script type='text/javascript'>alert('Email Id already exists!! ');</script>";
                    break;
                    } else {
                    $flag=false;
                    }
                }
                if($flag==false){
                 $Email=mysql_real_escape_string($_POST['Email']);
                }
               } else {
                echo "<script type='text/javascript'>alert('Please enter valid email id . For eg : someone@gmail.com ');</script>";
               }
             } else  {
                $Email='';
             }

             if(isset($_POST['DOA'])&&!empty($_POST['DOA'])){
               $date=date_create($_POST['DOA']);
               $DOA=date_format($date,'Y/m/d');
               $Year=date('Y',$DOA);
             } else  {
               $DOA=date('Y/m/d',time());
               $Year=date('Y',time());
             }

             if(isset($_POST['DOE'])&&!empty($_POST['DOE'])){
               $date=date_create($_POST['DOE']);
               $DOE=date_format($date,'Y/m/d');
             }else{
               $DOE='';
             }

            if(isset($IP_Address)&&isset($Name)&& isset($MAC_Address)&& isset($Email)&& isset($DOA)&& isset($DOE))
            {
              $query="INSERT INTO allocation VALUES('NULL','$IP_Address','$Lab_Name','$Student_Staff','$Name','$MAC_Address','$Email','$DOA','$DOE','$Year')";
              $result=mysql_query($query);
             if($result){
                 activities('Allocated new IP : '.$IP_Address);
                 unset($_POST['Allocate']);
                  header('refresh:3; url=allocate.php.php');
                   echo "<script type='text/javascript'>alert('NEW IP ALLOCATED');</script>";
                 mysql_close();
               }
               else {
                echo "<script type='text/javascript'>alert('NEW IP COULD NOT BE ALLOCATED');</script>";

               }
            }



      }
     } else {
           echo "<script type='text/javascript'>alert('Fill at least one field');</script>";
      }
     } else if(isset($_POST['Update'])) {
        if(!empty($_POST['Update'])) {
          Update();
        }
     }
    }  else {
         die( 'Connection ERROR');
    }

echo '<html>

<head>
 <title> Allocate IP</title>
</head>

<body>
<center>
  <font size="10" color="Blue" ><i> IP Address Allocation</i></font>
  <hr size="4" color="black">
  <form action="allocate.php.php" method="POST">
    <table border="0" cellspacing="20" cellpadding="20">';
    if(isset($_POST['Allocate'])||isset($_POST['Update'])){ echo'

         <tr><td>IP:    <input type="text" value="';echo $_POST['IP_Address']; echo '" name="IP_Address" id="IP_Address"></td></tr>
          <tr><td> Lab Name:   <select type="dropdown" name="Lab_Name" id="Lab_Name">
          <option value="';echo $_POST['Lab_Name'];echo '" name="Lab_Name" checked> ';echo $_POST['Lab_Name'];echo ' </option>';
         $select="SELECT Lab_Name FROM labs ";
         $select_result=mysql_query($select);
         while($row=mysql_fetch_array($select_result)) {

              echo '<option value="'; echo $row['Lab_Name'] ; echo '" name="Lab_Name" >'; echo $row['Lab_Name'] ; echo '</option>';
         }
         echo'
         </select></td></tr><tr><td>Student/Staff :
            <input type="radio" name="ss" id="ss" value="Student" >Student</input>  <br>
            &emsp;&nbsp; &emsp; &emsp;&emsp;&nbsp;&emsp;<input type="radio" name="ss" id="ss" value="staff">Staff</input></td></tr>
 <tr> <tr><td> Name:  <input type="text" value="';echo $_POST['Name']; echo '" name="Name" id="Name"></td></tr>
         <tr><td>MAC Address:    <input type="text" value="';echo $_POST['MAC_Address']; echo '" name="MAC_Address" id="MAC_Address"/></td></tr>
         <tr><td>Email Id:       <input type="text" value="';echo $_POST['Email']; echo '" name="Email" id="Email"/></td></tr>
         <tr><td>DateOfAllocation:  <input type="text" name="DOA" id="DOA"/></td></tr>
         <tr><td>DateOfExpiry:      <input type="text" name="DOE" id="DOE"/></td></tr>
   </table>
      <br><br>
      <input type="submit" value="Allocate" name="Allocate" id="Allocate" /> &emsp;&emsp;&emsp;
      <input type="submit" value="Update" name="Update" id="Update"/>
  </form>
    '; }
  else { echo '
  <tr><td>IP:    <input type="text" value="" name="IP_Address" id="IP_Address"></td></tr>
         <tr><td> Lab Name:   <select type="dropdown" name="Lab_Name" id="Lab_Name"> 
         <option value="" name="Lab_Name"></option> ';
         $select="SELECT Lab_Name FROM labs ";
         $select_result=mysql_query($select);
         while($row=mysql_fetch_array($select_result)) {

              echo '<option value="'; echo $row['Lab_Name'] ; echo '" name="Lab_Name" >'; echo $row['Lab_Name'] ; echo '</option>';
         }
         echo'
                 </select></td></tr>
         <tr><td>Student/Staff :
         <input type="radio" name="ss" id="ss" value="Student" >Student</input>  <br>
            &emsp; &emsp; &emsp;&emsp;&nbsp;&nbsp;&emsp;<input type="radio" name="ss" id="ss" value="staff">Staff</input></td></tr>
         <tr><td> Name:  <input type="text"  name="Name" id="Name"></td></tr>
         <tr><td>MAC Address:    <input type="text" name="MAC_Address" id="MAC_Address"/></td></tr>
         <tr><td>Email Id:       <input type="text" name="Email" id="Email"/></td></tr>
         <tr><td>DateOfAllocation:  <input type="text" name="DOA" id="DOA"/></td></tr>
         <tr><td>DateOfExpiry:      <input type="text" name="DOE" id="DOE"/></td></tr>
   </table>
      <br><br>
      <input type="submit" value="Allocate" name="Allocate" id="Allocate" /> &emsp;&emsp;&emsp;
      <input type="submit" value="Update" name="Update" id="Update"/>
  </form>
  '; } echo '

</center>

</body>
</html> ';
?>