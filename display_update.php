<?php
      require_once('connection.inc.php');
      require_once('logout_session.php');
      include ('menu.php');
      require_once ('insert_activities.php');
      ob_start();
      Update();
      function Update() {
         if(isset($_SESSION['Update']) && !empty($_SESSION['Update'])) {
         $ID=$_SESSION['Update'];
         $select="SELECT * FROM allocation WHERE ID='$ID'";
         $result_select=mysql_query($select);
         $row=mysql_fetch_assoc($result_select);


         echo '

         <html>
         <head>
          <title>Update Record</title>
         </head>
         <body>
          <center>     <font size="10" color="Blue" ><i>Update Record</i></font>  </center>

          <br>
          <form action="display_update.php" method="POST">
          <table align="center" border="0" cellspacing="30" cellpadding="8">
          <tr><td><b> ID :</b></td> &emsp;&emsp; <td><input type="text" name="ID" id="ID" value="';echo $row['ID'] ; echo '"/></td>
          <td><b>  IP Address: </b></td> &emsp;&emsp; <td><input type="text" name="IP_Address" id="IP_Address" value="';echo $row['IP_Address']; echo'"></td>&emsp;&emsp;&emsp;&emsp;
          <td><b> Lab Name:  </b> </td>
                 <td><select type="dropdown" name="Lab_Name" id="Lab_Name">
                <option value="';echo $row['Lab_Name']; echo'" name="Lab_Name" checked>';echo $row['Lab_Name']; echo'</option> ';
         $select="SELECT Lab_Name FROM labs ";
         $select_result=mysql_query($select);
         while($row1=mysql_fetch_array($select_result)) {

              echo '<option value="'; echo $row1['Lab_Name'] ; echo '" name="Lab_Name" >'; echo $row1['Lab_Name'] ; echo '</option>';
         }
         echo'   </select></td></tr> <br><br><br>
       <tr><td><b>Student_Staff:</b></td> &emsp;&emsp; <td><select type="dropdown" name="Student_Staff" id="Student_Staff">
                 <option value="';echo $row['Student_Staff']; echo'" name="Student_Staff" checked>';echo $row['Student_Staff']; echo' </option>
                 <option value="Student" name="Student_Staff" >Student</option>
                 <option value="Staff" name="Student_Staff" >Staff</option>
                 </SELECT></td>

        <td><b> Name: </b></td> &emsp;&emsp; <td><input type="text" name="Name" id="Name" value="'; echo $row['Name']; echo'"/></td>
       <td><b>MAC Address:</b></td> &emsp;&emsp; <td><input type="text" name="MAC_Address" id="MAC_Address" value="';echo $row['MAC_Address']; echo'"/></td></tr>
         &nbsp; &emsp;&emsp; <tr><td><b>Email_id:</b></td> &emsp;&emsp; <td><input type="text" name="Email_id" id="Email_id" value="';echo $row['Email_id']; echo'"/> </td>
       <td><b>Date Of Allocation:</b></td> &emsp;&emsp; <td><input type="text" name="DateOfAllocation" id="DateOfAllocation" value="';echo $row['DateOfAllocation']; echo'"/> </td>
       <td><b>   Date Of Expiry:</b></td> &emsp;&emsp; <td><input type="text" name="DateOfExpiry" id="DateOfExpiry" value="';echo $row['DateOfExpiry']; echo'"/></td></tr>
       <tr><td> <b>  Year: </b></td>&emsp;&emsp; <td><input type="text" name="Year" id="Year" value="';echo $row['Year']; echo'"/><td></tr>

          </table>
            <br><br><br>    <center><input type="submit" name="Update" id="Update" value="Update" style="height:30px; width:100px "/>
          </form>
          </center>
          </body>
         </html>';



      if(isset($_POST['Update'])) {
          if(!empty($_POST['Update'])) {
            $IP_Address=$_POST['IP_Address'];
            $Lab_Name=$_POST['Lab_Name'];
            $Student_Staff=$_POST['Student_Staff'];
            $Name=$_POST['Name'];
            $MAC_Address=$_POST['MAC_Address'];
            $Email=$_POST['Email_id'];
            $DOA=$_POST['DateOfAllocation'];
            $DOE=$_POST['DateOfExpiry'];
            $Year=$_POST['Year'];

            $update="UPDATE allocation SET IP_Address='$IP_Address', Lab_Name='$Lab_Name',Student_Staff='$Student_Staff',Name='$Name', MAC_Address='$MAC_Address', Email_id='$Email', DateOfAllocation='$DOA', DateOfExpiry='$DOE', Year='$Year' WHERE ID='$ID'";
            $result_update=mysql_query($update);
            if($result_update) {
            header('refresh:1; url='.$_SESSION['Last']);
            } else {
              echo "<script type='text/javascript' >alert('Record not updated');</script>";
            }
          }
        }
      }
 }
?>

