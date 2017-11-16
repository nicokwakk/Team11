<?php
session_start();
include_once('db.php');
if(!(isset($_SESSION['loggedin'])) || ($_SESSION['loggedin'] == false)){
  header('location: ../login.php?code=2');
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

  $shopping_query = "CALL removeFromWishList($pid,$userid)";
  $shopping_stmt = $mysql->prepare($shopping_query);
  $shopping_stmt->execute();
  header("location: ../product.php?productid=$pid&removed=1");

}
?>
