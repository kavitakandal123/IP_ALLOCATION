<?php
//search
class search {
public function __construct() {
 require ('connection.inc.php');
 require ('logout_session.php');
 include ('menu.php');
 require_once ('insert_activities.php');
 require_once 'delete.php';
 }
public function altering() {
         $result1=mysql_query('SELECT ID,IP_Address FROM allocation');
          while($row=mysql_fetch_assoc($result1)) {
            $delete='Delete'.$row['ID'];
            if(isset($_POST[$delete])) {
            if(!empty($_POST[$delete])) {
              activities('Deleted IP : '.$row['IP_Address']);
             $this->delete($delete);
             break;
             }
            }

            $update='Update'.$row['ID'];
            if(isset($_POST[$update])) {
              if(!empty($_POST[$update])) {
               activities('Updated Record  : '.$row['ID']);
               $this->update($update);
               break;
               }
            }
          }
         }

public function update($ID) {
       $ID_new=substr($ID,6);
       $_SESSION['Update']=$ID_new;
       $_SESSION['Last']='search.php';
      header('Location: display_update.php');
 }

 public function delete($ID) {
       $ID_new=substr($ID,6);
       Delete($ID_new);
       header('Location: search.php');
 }

public function database() {
  if(isset($_POST['Search'])) {
   if(!empty($_POST['Search'])) {
     if(isset($_POST['search_list'])&& !empty($_POST['search_list'])) {
       if(isset($_POST['search_text'])&&!empty($_POST['search_text'])) {

         $search_list=$_POST['search_list'];
         $search_text=$_POST['search_text'];
         activities('Searched database for : '.$search_text);
         $query="SELECT * FROM allocation WHERE $search_list LIKE '%$search_text%'";
         $result=mysql_query($query);
         if($num=mysql_num_rows($result)) {
           unset($_POST);

   echo ' <center> <form action="search.php" method="POST">

    <table border="0" cellspacing="15" cellpadding="8">
    <caption><h1><i>';echo ($num>1)? $num.' Results for ': $num.' Result for '; echo $search_text ;
    echo '</i></h1></caption>
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
         while($row=mysql_fetch_array($result))
      {  if($row['DateOfExpiry']==0000-00-00) {
         $DateOfAllocation=date_create($row['DateOfAllocation']);
         echo "<tr>";
         echo "<td>".$row['ID']."</td>";
         echo "<td>".$row['IP_Address']."</td>";
         echo "<td>".$row['Lab_Name']."</td>";
         echo "<td>".$row['Student_Staff']."</td>";
         echo "<td>".$row['Name']."</td>";
         echo "<td>".$row['MAC_Address']."</td>";
         echo "<td>".$row['Email_id']."</td>";
         echo "<td>".date_format($DateOfAllocation,'d/m/Y')."</td>";
         echo "<td>".$row['DateOfExpiry']."</td>";
         echo "<td>".$row['Year']."</td>";
         echo '<td><input type="submit" value="Delete" name="'; echo "Delete".$row["ID"]; echo '" id="'; echo "Delete".$row["ID"]; echo '"  /></td>';
         echo '<td><input type="submit" value="Update" name="'; echo "Update".$row["ID"]; echo '" id="'; echo "Update".$row["ID"]; echo '"  /></td>';
         echo "<tr>";
       } else {
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
         echo '<td><input type="submit" value="Delete" name="'; echo "Delete".$row["ID"]; echo '" id="'; echo "Delete".$row["ID"]; echo '"  /></td>';
         echo '<td><input type="submit" value="Update" name="'; echo "Update".$row["ID"]; echo '" id="'; echo "Update".$row["ID"]; echo '"  /></td>';
         echo "<tr>";
         }
      }

       echo ' </form> ';

       } else {
           echo '<center><h2><i>No data for value '.$search_text.'</i></h2></center>';
           header('refresh:2 ; url=search.php');
      }
    } else {
       echo "<script type='text/javascript'>alert('Please enter the value to be searched');</script>";
       }

   } else {
       echo "<script type='text/javascript'>alert('Please Enter the  search field');</script>";
     }
  }
 }
}

}
 $search=new search;
 $search->database();

  if(isset($_POST)) {
      if(!empty($_POST)) {
        $search->altering();
      }
     }



?>

<html>
 <head>
 <title>Search Database</title>
 </head>
 <body>
 <center>
  <font size="10" color="Blue" ><i> Search Records</i></font> <br><br><br>
 <form action="search.php" method="POST" >
  <h3><strong>Search By:</strong></h3>
             <SELECT name="search_list" id="search_list" >
             <option name="search_list" id="search_list" value=""></option>
             <option name="search_list" id="search_list" value="IP_Address">IP_Address</option>
             <option name="search_list" id="search_list" value="Name">Name</option>
             <option name="search_list" id="search_list" value="MAC_Address">MAC_Address</option>
             <option name="search_list" id="search_list" value="Year">Year</option>
             <option name="search_list" id="search_list" value="Email_id">Email_id</option>
            </SELECT>
            <br><br><br>
  <h3><strong> Search: </strong></h3>
            <input type="text" name="search_text" id="search_text"/>
            <br><br>
            <input type="submit" name="Search" id="Search" value="Search" style="height:30px; width:100px">
 </form>
 </center>
 </body>
</html>