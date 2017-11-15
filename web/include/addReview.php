<?php
include('db.php');
  $pid = (isset($_POST['productid']) ? $_POST['productid'] : 'x');
  $text = (isset($_POST['reviewtext']) ? $_POST['reviewtext'] : 'x');
  $name = (isset($_POST['firstname']) ? $_POST['firstname'] : 'x');
  $stars = (isset($_POST['stars']) ? $_POST['stars'] : 'x');
if($pid == 'x' || $text == 'x' || $name == 'x' || $stars=='x'){
  header("location:../product.php?productid=$pid&code=3");
}else{
  $pid = $pid;
  $mysql->query( "CALL CreateReview('$pid','$name','$text','$stars',@rID)" );
  $reviewid = 0;
  foreach($mysql->query( "SELECT @rID" ) as $row)
  {
    $reviewid=$row['@rID'];
  }
  
  if($reviewid > 0){
		header("location:../product.php?productid=$pid&code=1");
  }else{
		header("location:../product.php?productid=$pid&code=2");
  }
}
?>
