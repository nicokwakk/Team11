<?php
session_start();
session_regenerate_id();
$sessionID = session_id();
include ('db.php');
$password = $_POST['passw'];
$email = $_POST['email'];
$pw_query = "Select HashedVal from logincustview where CustEmail = '$email'";
$pw_check = $mysql->prepare($pw_query);
$pw_check->execute();
$pw_result = $pw_check->fetchAll();
$pw_val ="";
foreach($pw_result as $row){
  $pw_val = $row['HashedVal'];
};
$pw_check->closeCursor();
echo "<br>";
if(password_verify($password, $pw_val)){
  //add code for inputting sessionID into Customers table.
  $session_query = "update Customers set CustSessionID = '$sessionID' where CustEmail = '$email'";
  $session_stmt = $mysql->prepare($session_query);
  $session_stmt->execute();
  $_SESSION['loggedin'] = true;
  $sesh = session_id();
  $mysql->query( "CALL getCustIDfromSession('$sesh',@userID)" );
  $userid = 0;
  foreach($mysql->query( "SELECT @userID" ) as $row)
  {
    $userid=$row['@userID'];
  }
  $_SESSION['basketcount'] = 0;
  $basketQuery = "select SUM(quantity) from shoppingcart where CustomerID = '$userid'";
  $basketStmt = $mysql->prepare($basketQuery);
  $basketStmt->execute();
  $basketresult=$basketStmt->fetchALL();
  foreach($basketresult as $row)
  {
    $quantity=$row['SUM(quantity)'];

  }
  $_SESSION['basketcount'] = $quantity;
  $_SESSION['userID'] = $userid;
  header("location: ../index.php");
}else{
  header("location: ../login.php?code=4");
}

?>
