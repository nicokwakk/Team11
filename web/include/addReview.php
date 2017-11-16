<?php
include('db.php');
session_start();
$sesh = session_id();
  $pid = (isset($_POST['productid']) ? $_POST['productid'] : 'x');
  $text = (string)(isset($_POST['reviewtext']) ? $_POST['reviewtext'] : 'x');
  $name = (string)(isset($_POST['firstname']) ? $_POST['firstname'] : 'x');
  $stars = (isset($_POST['stars']) ? $_POST['stars'] : 'x');
  $checked = (isset($_POST['checked']) ? $_POST['checked'] : 'x');

if($pid == 'x' || $text == 'x' || $name == 'x' || $stars=='x'|| $checked=='checked'){

  header("location:../product.php?productid=$pid&code=3");
}else{
    echo $name;
    echo "<br>";
    echo $text;
    echo "<br>";
    echo $pid;
    echo "<br>";
    echo $stars;

    $mysql->query( "CALL getCustIDfromSession('$sesh',@userID);" );
    $userid = 0;
    foreach($mysql->query( "SELECT @userID" ) as $row)
    {
      $userid=$row['@userID'];
    }
  if($checked > 0){
    $mysql->query( "CALL CreateReview($userid,$pid,'$name','$text',$stars,@rID);" );
    $reviewid = 0;
    foreach($mysql->query( "SELECT @rID" ) as $row)
    {
      $reviewid=$row['@rID'];
    }
  }
echo $checked;
echo $reviewid;
echo $userid;
  if($reviewid > 0){
		header("location:../product.php?productid=$pid&code=1");
  }else{
		header("location:../product.php?productid=$pid&code=2");
  }
}
?>
