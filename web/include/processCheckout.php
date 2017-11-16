<?php
session_start();
include_once('db.php');
if(!(isset($_SESSION['loggedin'])) || ($_SESSION['loggedin'] == false)){
  header('location: ../login.php?code=7');
}else{
  $deltype = $_POST['deliverytype'];
  $sesh = session_id();
  $mysql->query( "CALL getCustIDfromSession('$sesh',@userID)" );
  $userid = 0;
  foreach($mysql->query( "SELECT @userID" ) as $row)
  {
    $userid=$row['@userID'];
  }
  $checkout_query = "CALL checkoutBasket('$sesh',$userid,'$deltype')";
  print_r($checkout_query);
  $checkout_stmt = $mysql->prepare($checkout_query);
  $checkout_stmt->execute();
  $_SESSION['basketcount'] = 0;
  echo $sesh;
  echo "<br>";
  echo session_id();
  echo $userid;
  header("location: ../basket.php");
}
?>
