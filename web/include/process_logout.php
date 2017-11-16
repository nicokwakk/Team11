<?php
session_start();
$sessionID = session_id();
include_once('db.php');
$sesh_query = "Select * from Customers where CustSessionID ='$sessionID'";
$sesh_check = $mysql->prepare($sesh_query);
$sesh_check->execute();
$sesh_result = $sesh_check->fetchALL();
$sesh_val ="";
echo $sessionID;
echo "<br>";
foreach($sesh_result as $row){
  $sesh_val = $row['CustSessionID'];
  echo $sesh_val;
}
$sesh_check->closeCursor();
if($sesh_val == $sessionID){

echo "<br>";
  $session_query = "call updateSessionID('$sesh_val',NULL,1)"; //1 Used to update based on session ID and not userID
  $session_check = $mysql->prepare($session_query);
  $session_check->execute();
  $session_check->closeCursor();
  echo $sesh_val;
  $_SESSION['loggedin'] = false;
  header("location: ../index.php");
}
?>
