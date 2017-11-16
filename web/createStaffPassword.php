<!DOCTYPE html>
<html lang='en'>	
	
	<head><?php include_once('include/include_metaData.php'); ?>
		  <?php	//include_once('include/db.php'); ?>
		  <?php include_once('include/include_header.php'); ?>
		  </head>
	<body>
		  <div id="tester_input"> <!--For validation of the form -->
		  <?php
			$password=$passwordCon="" //passwordCon means password confirm box
			$passwordErr=$passwordConErr="" //variables to handle errors
			
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$pattern = '/(?=^.{14,22}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/'; //a regex pattern
				//"?=^. is the start of the string of what to be matched
				//{14,22} is the range of characters the user can user
				//*\d means include at least one number - * means can be more one occurence
				// the | is OR
				//*\W+ matches 1 or more symbols 
				//.\n means no line breaks
				//A-Z is capitals and a-z is lowercase
				if(empty($_POST["password"])){ //checking if required box is empty
						$passwordErr="A password is required";
				}
				else{
					$password = test_input($_POST["password"]);
					if(!preg_match($pattern,$password)){ //preg_match searches a string for pattern, returning true if the pattern exists
						$passwordErr="Between 14 and 22 characters with Uppercase,lowercase, numbers and symbols"; //Disallows anything not a letter or a space
					}
				}
				if(empty($_POST["passwordCon"])){ //checking if required box is empty
						$passwordConErr="The password needs confirmed";
				}
				else{
					$passwordCon = test_input($_POST["passwordCon"]);
					if(!preg_match($pattern,$password)){ //preg_match searches a string for pattern, returning true if the pattern exists
						$passwordConErr="Between 14 and 22 characters with Uppercase,lowercase, numbers and symbols"; //Disallows anything not a letter or a space
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
	</body>
	
	
</html>