<?php
session_start();
include('db.php');
if(!(isset($_SESSION['loggedin'])) || ($_SESSION['loggedin'] == false)){
  header('location: ../login.php?code=1');
}else{
  $sesh = session_id();
  $mysql->query( "CALL getCustIDfromSession('$sesh',@userID)" );
  $userid = 0;
  foreach($mysql->query( "SELECT @userID" ) as $row)
  {
    $userid=$row['@userID'];
  }
  $pid = (INTEGER)$_POST['productid'];
  echo $pid;
  echo"<br>";
  echo $userid;

  $shopping_query = "CALL removeFromShoppingCart($pid,$userid)";
  echo $shopping_query;
  $shopping_stmt = $mysql->prepare($shopping_query);
  $shopping_stmt->execute();
  $_SESSION['basketcount'] =   $_SESSION['basketcount'] - 1;
  echo $sesh;
  echo "<br>";
  echo session_id();
  echo $userid;
  header("location: ../basket.php");
}
?>
