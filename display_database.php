<?php
 ob_start();
class display
{
  private $query='SELECT * FROM allocation';

   public function __construct() {
      require_once('connection.inc.php');
      require_once('logout_session.php');
      require_once ('menu.php');
      require_once ('delete.php');
      require_once ('insert_activities.php');
      ob_start();
    echo  activities('Viewed Database ');

  }

  public function database() {
  echo '    <!DOCTYPE html>
<html>
<head>
    <title>Database</title>
</head>
<body>
  <center>
  <font size="10" color="Blue" ><i> Allocated IP Addresses</i></font>
   <br> <br> <br> <br>
   <table border="0" cellspacing="15" cellpadding="8">
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
     <th>Year </th>
   </tr>
   <form action="display_database.php" method="POST">  ';
         $result=mysql_query($this->query);

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


    mysql_free_result($result);

   echo ' </form>
   </table>
  </center>

</body>
</html>  ';
}

public function update($ID) {
       $ID_new=substr($ID,6);
       $_SESSION['Update']=$ID_new;
       $_SESSION['Last']='display_database.php';
      header('Location: display_update.php');
 }
 public function delete($ID) {
       $ID_new=substr($ID,6);
       Delete($ID_new);
       header('Location: display_database.php');
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


}
$del= new display;

$del->database();

if(isset($_POST)){
  if(!empty($_POST)){
  $del->altering();
 }
}

?>