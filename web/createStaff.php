<?php include_once('include/include_metaData.php'); ?>

<!DOCTYPE html>

<html lang='en'>

	<head>
		  <?php	//include_once('include/db.php'); ?>
		  <?php include_once('include/include_header.php'); ?>
			<?php include_once('include/include_functions.php'); ?>
		  </head>
		  <body>
		  <div id="tester_input"> <!--For validation of the form -->
		  <?php
				// define variables and set to empty values
				$fnameErr=$lnameErr=$mnameErr=$genderErr=$emailErr=$conNumErr=$emConNumErr=$passwordErr=$passwordConErr=$jTitle=$salary="";
				$fname = $lname = $mname= $gender = $email= $conNum= $emConNum=$password=$passwordCon=$jTitleErr=$salaryErr="";
				$confirmPassword="";

				if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
					if(empty($_POST["jTitle"])){
						$jTitleErr="Job Title is required";
					}
					else{
						$jTitle = test_input($_POST["jTitle"]);
						$jTitleErr=testLettersAndWhiteSpace($jTitle);

					}

					if(empty($_POST["email"])){
						$emailErr="Email is required";
					}
					else{
						$email = test_input($_POST["email"]);
						$emailErr = testEmail($email);

					}
					if(empty($_POST["conNum"])){
						$conNumErr="Contact number is required";
					}
					else{
						$conNum = test_input($_POST["conNum"]); //contact number
						$conNumErr=testNumber($conNum);

					}
					if(empty($_POST["emConNum"])){ //Emergency contact number
						$emConNumErr="Emergency contact number is required";
					}
					else{
						$emConNum = test_input($_POST["emConNum"]);
						$emConNumErr=testNumber($emConNum);
					}

					if(empty($_POST["gender"])){
						$genderErr="Gender is required";
					}
					else{
						$gender = test_input($_POST["gender"]); //can only select one of the radio buttons so it shouldnt go wrong
					}

					$passwordErr = passwordValidation($password);
					$passwordConErr = passwordValidation($passwordCon);
					if($_POST["password"] != $_POST["passwordCon"])
					{
						$confirmPassword= "Passwords do not match";
					}

				}
				?>

		  </div>
		  <div id="CreateStaffForm" class="Form">

		  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

		  First Name: <input type="text" name="fname" value="<?php echo $fname;?>">
		  <span class="error">* <?php echo $fnameErr;?></span>
		  <br>
		  Middle Name: <input type="text" name="mname" value="<?php echo $mname;?>">
		  <span class="error">* <?php echo $mnameErr;?></span>
		  <br>
		  Last Name: <input type="text" name="lname" value="<?php echo $lname;?>">
		  <span class="error">* <?php echo $lnameErr;?></span>
		  <br>

			Job Title: <input type="text" name="jTitle" value="<?php echo $jTitle;?>">
		  <span class="error">* <?php echo $jTitleErr;?></span>
		  <br>

		  Email: <input type="text" name="email" value="<?php echo $email;?>">
		  <span class="error">* <?php echo $emailErr;?></span>
		  <br>
		  Contact Number: <input type="tel" name="conNum" value="<?php echo $conNum;?>">
		  <span class="error">* <?php echo $conNumErr;?></span>
		  <br>
		  Emergency Contact Number: <input type="tel" name="emConNum" value="<?php echo $emConNum;?>">
		  <span class="error">* <?php echo $emConNumErr;?></span>
		  <br>
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
		  <br>

		  Password:<input type="text" name="password" value="">
		  <span class="error">* <?php echo $passwordErr;?></span>
		  <br>

		  Confirm Password:<input type="text" name="passwordCon" value="">
		  <span class="error">* <?php echo $passwordConErr;?></span>
			<span class="error">* <?php echo $confirmPassword;?></span>
		  <br>


		  <input type="submit" name="submit" value="Submit">

		  </form>


		  </div>
		  </body>
