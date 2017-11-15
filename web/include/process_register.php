<?php
include ('db.php');
$passw = $_POST['passw'];
$email = $_POST['email'];
$add1 = $_POST['add1'];
$add2 = $_POST['add2'];
$postcode = $_POST['postcode'];
$country = $_POST['country'];
$city = $_POST['city'];
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$pnum = $_POST['pnum'];
$nlp = $_POST['nlp'];

echo($passw);
echo("<br>");
echo($email);
echo("<br>");
echo($add1);
echo("<br>");
echo($add2);
echo("<br>");
echo($postcode);
echo("<br>");
echo($country);
echo("<br>");
echo($city);
echo("<br>");
echo($fname);
echo("<br>");
echo($mname);
echo("<br>");
echo($lname);
echo("<br>");
echo($pnum);
echo("<br>");
echo($nlp);

$passw = password_hash($passw, PASSWORD_DEFAULT);
echo($passw);
$mysql->query( "CALL CreateCustomer('$add1','$add2','$postcode','$country','$city','$fname','$mname','$lname','$pnum','$nlp','$email','$passw',@cID)" );
header("location: ../login.php?code=5")
?>
