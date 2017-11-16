<?php
session_start();
session_regenerate_id();
$sessionID = session_id();
include ('db.php');
$password = $_POST['passw'];
$email = $_POST['email'];
$pw_query = "CALL staffReturnHash('$email')";
$pw_check = $mysql->prepare($pw_query);
$pw_check->execute();
$pw_result = $pw_check->fetchAll();
$pw_val ="";
foreach($pw_result as $row){
  $pw_val = $row['HashedVal'];
};
$pw_check->closeCursor();
if (password_verify($password, $pw_val)){
  $staff_query = "CALL staffReturnInfo('$email')";
  $staff_prep = $mysql->prepare($staff_query);
  $staff_prep->execute();
  $staff_results = $staff_prep->fetchAll();
  $branchid = 0;
  foreach($staff_results as $row){
    $branchid = $row['BranchID'];
  }
  $_SESSION['branch'] = $branchid;
  header("location: ../adminPanel.php");
}
?>
