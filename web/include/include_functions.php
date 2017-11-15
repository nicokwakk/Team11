
<?php include_once('db.php'); ?>
<?php

function passwordValidation($password)
{
  //THE PASSWORD VALIDATION SCHEMA
  ///////////////////////////////////////////////////
  $pattern = '/(?=^.{14,22}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/'; //a regex pattern
  //"?=^. is the start of the string of what to be matched
  //{14,22} is the range of characters the user can user
  //*\d means include at least one number - * means can be more one occurence
  // the | is OR
  //*\W+ matches 1 or more symbols
  //.\n means no line breaks
  //A-Z is capitals and a-z is lowercase

  $paswordErr = ""; //returns blank if nothing goes wrong
  if(empty($_POST["password"])){ //checking if required box is empty
      $passwordErr="A password is required";
  }
  else{
    $password = test_input($_POST["password"]);
    if(!preg_match($pattern,$password)){ //preg_match searches a string for pattern, returning true if the pattern exists
     return  $passwordErr="Between 14 and 22 characters with Uppercase,lowercase, numbers and symbols"; //Disallows anything not a letter or a space
    }
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function testLettersAndWhiteSpace($data) //tests if its just letters and white space
//for valditing names and such
{//preg_match searches a string for pattern, returning true if the pattern exists
  $error=""; //returns blank when no error occurs
  if(!preg_match("/^[a-zA-Z]*$/",$data)){ //Disallows anything not a letter or a space
  return $error="Only letters and white space allowed";
  }
}

function testNumber($data) //tests if its just numbers
{
  $error=""; //returns blank when no error occurs
  if(!preg_match("/^([0-9])*$/",$data)){
   return $error="Only numbers are accepted";
  }
}

function testEmail($data)//tests if the email looks correct
{

  $error=""; //returns blank when no error occurs
  if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
    return $error = "Invalid email format";
  }

}

//To test postcode you use the function checkPostcode in process phppostcode
/*function filter($filter,$search)//function for applying the filter and search options
{
  global $mysql;
  $search= test_input($search); //strips the search of any special characterss
  if($search == ""){
    $product_thumbquery = "Select * from products where TypeOfProduct = '$filter' ;";
  }
  else {
    $product_thumbquery = "SELECT * FROM products WHERE ProductName LIKE '%" .$search. "%' OR Brand LIKE '%" .$search. "%' OR TypeOfProduct LIKE '%" .$search. "%';";
    //Does a LIKE statement for the search on the type, brand and name}
  }
  if($filter == '*' && $search == ""){
    $product_thumbquery = "Select * from products ;";
  }
  $product_thumbcheck = $mysql->prepare($product_thumbquery);
  $product_thumbcheck->execute();
  $product_thumbresult = $product_thumbcheck->fetchAll();
  $product_thumbcheck->closeCursor();
  return $product_thumbresult;

}*/

?>
