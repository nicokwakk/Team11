<!DOCTYPE html>
<html lang='en'>	
	
	<head><?php include('include/include_metaData.php'); ?>
		  <?php	//include('include/db.php'); ?>
		  <?php include('include/include_header.php'); ?>
		  </head>
		  <body>
		  <div id="tester_input"> <!--For validation of the form -->
		  <?php
				// define variables and set to empty values
				$fnameErr=$lnameErr=$genderErr=$emailErr=$conNumErr=$emConNumErr=""; 
				$fname = $lname = $gender = $email= $conNum= $emConNum="";

				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					if(empty($_POST["fname"])){ //checking if required box is empty
						$fnameErr="First name is required";
					}
					else{
						$fname = test_input($_POST["fname"]);
						if(!preg_match("/^[a-zA-Z]*$/",$fname)){ //preg_match searches a string for pattern, returning true if the pattern exists
							$fnameErr="Only letters and white space allowed"; //Disallows anything not a letter or a space
						}
					}
					if(empty($_POST["lname"])){
						$lnameErr="Last name is required";
					}
					else{
						$lname = test_input($_POST["lname"]);
						if(!preg_match("/^[a-zA-Z]*$/",$lname)){
							$lnameErr="Only letters and white space allowed";
						}
					}
					
					if(empty($_POST["email"])){
						$email="Email is required";
					}
					else{
						$email = test_input($_POST["email"]);
						 // check if e-mail address is well-formed
						 if (!filter_var($email, FI LTER_VALIDATE_EMAIL)) {
							$emailErr = "Invalid email format";
							}
					}
					if(empty($_POST["conNum"])){
						$conNumErr="Contact number is required";
					}
					else{
						$conNum = test_input($_POST["conNum"]);
						if(!preg_match("/^[0-9]*$/",$conNum)){
							$conNumErr="Only numbers are accepted";
						}
					}
					if(empty($_POST["emConNum"])){
						$emConNumErr="Emergency contact number is required";
					}
					else{
						$emConNum = test_input($_POST["emConNum"]);
						if(!preg_match("/^[0-9]*$/",$emConNum)){
							$emConNumErr="Only numbers are allowed";
						}
					} 
					if(empty($_POST["gender"])){
						$genderErr="Gender is required";
					}
					else{
						$gender = test_input($_POST["gender"]); //can only select one of the radio buttons so it shouldnt go wrong
					}
				}
				

				function test_input($data) {
				  $data = trim($data);
				  $data = stripslashes($data);
				  $data = htmlspecialchars($data);
				  return $data;
				}
				?>
		  
		  </div>
		  <div id="CreateStaffForm" class="Form">

		  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		  
		  First Name:<input type="text" name="fname" value="<?php echo $fname;?>">
		  <span class="error">* <?php echo $fnameErr;?></span>
		  <br><br>
		  Last Name:<input type="text" name="lname" value="<?php echo $lname;?>">
		  <span class="error">* <?php echo $lnameErr;?></span>
		  <br><br>
		  Email:<input type="text" name="fname" value="<?php echo $email;?>">
		  <span class="error">* <?php echo $emailErr;?></span>
		  <br><br>
		  Contact Number:<input type="text" name="conNum" value="<?php echo $conNum;?>">
		  <span class="error">* <?php echo $conNumErr;?></span>
		  <br><br>
		  Emergency Contact Number:<input type="text" name="emConNum" value="<?php echo $emConNum;?>">
		  <span class="error">* <?php echo $emConNumErr;?></span>
		  <br><br>
		  Gender:
		  <input type="radio" name="gender" 
		  <?php if(isset($gender) && $gender=="female") echo "checked";?>
		  value="female">Female
		  
		  <input type="radio" name="gender" 
		  <?php if(isset($gender) && $gender=="male") echo "checked";?>
		  value="male">Male
		  
		  <input type="radio" name="gender"
		  <?php if(isset($gender) && $gender=="other") echo "checked";?>		 
		  value=="other">Other
		  <span class="error">* <?php echo $genderErr;?></span>
		  <br><br>
		  <input type="submit" name="submit" value="Submit">
		  
		  </form>
		  
		 
		  </div>
		  </body>
		  