"" && "" && <?php
include_once('db.php');
include_once('include_functions.php');
include_once('process_phppostcode.php');
$passw = $email =$add1 =$add2 =$postcode =$country =$city =$fname = $mname =$lname =$pnum =$nlp ="";
 //$_POST['email'];
 //$_POST['add1'];
// $_POST['add2'];
//$_POST['postcode'];
// $_POST['country'];
 //$_POST['city'];
 //$_POST['fname'];
// $_POST['mname'];
// $_POST['lname'];
//$pnum = $_POST['pnum'];
//$nlp = $_POST['nlp'];

//holding the error values
$emailErr=$passwErr=$add1Err=$add2Err=$postCodeErr=$countryErr=$cityErr=$fnameErr=$mnameErr=$lnameErr=$pnumErr=$nlpErr="";

//the start of the validation
if($_SERVER["REQUEST_METHOD"] == "POST") //sanitizes input before validation
{
  if(empty($_POST["email"])){ //checking if required box is empty
    $emailErr="Email is required";
  }
  else{
    $email = test_input($email); //you collect them at the start
    $emailErr= testEmail($email);
  }
  if(!empty($_POST["passw"])){ //checking if box is empty
    $passwErr = "Password is required";
  }
  else{
    $password = test_input($_POST["passw"]);

  }
  if(empty($_POST["fname"])){ //checking if required box is empty
    $fnameErr="First name is required";
  }
  else{
    $fname = test_input($_POST["fname"]);
    $fnameErr=testLettersAndWhiteSpace($fname);
  }
  if(empty($_POST["mname"])){
    $mnameErr="Middle name is required";
  }
  else{
    $mname = test_input($_POST["mname"]);
    $mnameErr=testLettersAndWhiteSpace($mname);
  }
  if(empty($_POST["lname"])){
    $lnameErr="Last name is required";
  }
  else{
    $lname = test_input($_POST["lname"]);
    $lnameErr=testLettersAndWhiteSpace($lname);

  }
  if(empty($_POST["add1"])){ //checking if required box is empty
    $add1Err="Address is required";
  }
  else{
    $add1 = test_input($_POST["add1"]);
    //$add1Err=testLettersAndWhiteSpace($add1);
  }
  if(!empty($_POST["add2"])){ //checking if box is empty
    $add2 = test_input($_POST["add2"]);
  }
  if(empty($_POST["city"])){ //checking if required box is empty
    $cityErr="City is required";
  }
  else{
    $city = test_input($_POST["city"]);
    $cityErr=testLettersAndWhiteSpace($city);
  }
  if(empty($_POST["postcode"])){ //checking if required box is empty
    $postcodeErr="Postcode is required";
  }
  else{
    $postcode = test_input($_POST["postcode"]);
    if(!checkPostcode($postcode)) //uses the checkPostcode function in process_phppostcode
    {
      $postcodeErr="Invalid Postcode";
    }
  }
  if(empty($_POST["pnum"])){
    $pnumErr="Contact number is required";
  }
  else{
    $pnum = test_input($_POST["pnum"]); //contact number
    $pnumErr=testNumber($pnum);

  }
  $country=$_POST["country"];
  if(empty($_POST["nlp"])){
    $nlpErr="Contact number is required";
  }
  else{
    $nlp = test_input($_POST["nlp"]); //contact number
    $nlpErr=testNumber($nlp);

  }

}
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
//if no error
if($emailErr=="" && $passwErr=="" && $add1Err=="" && $add2Err=="" && $postCodeErr=="" && $countryErr=="" && $cityErr=="" && $fnameErr=="" && $mnameErr=="" && $lnameErr=="" && $pnumErr=="" && $nlpErr=="")
{
  $passw = password_hash($passw, PASSWORD_DEFAULT);
  echo($passw);
  $mysql->query( "CALL CreateCustomer('$add1','$add2','$postcode','$country','$city','$fname','$mname','$lname','$pnum','$nlp','$email','$passw',@cID)" );
  header("location: ../login.php?code=5");
}

?>
