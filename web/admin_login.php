<!DOCTYPE html>
<html lang='en'>
<head><?php include_once('include/include_metaData.php');  ?></head>
<body style ="background-color: white; ">
<?php
if(isset($_SESSION['loggedin']) && !(($_SESSION['loggedin']) == false)){
	header("location: index.php");
}

echo " <p id='adminPCSHOP'> Admin Panel </p>";
$code = (isset($_GET['code']) ? $_GET['code'] : '0');
echo "
<div class='login_form' >
<h2>Enter Staff Details</h2>
";
	if ($code == 1){
		echo "<p id='log_error'> You must be logged in to add an item to your basket </p>";
	}else if ($code == 2){
		echo "<p id='log_error'> You must be logged in to add an item to your wishlist </p>";
	}else if ($code == 4){
		echo "<p id='log_error'> Incorrect username or password   </p>";
	}else if ($code == 5){
		echo "<p id='log_error'> Registration Successful  </p>";
	}

echo "
<p id='log_error'> </p>
<form method='post' action='include/process_admin_login.php' class=''>
  Email: <input type='text' class='form_input_white' name='email'><br>
  Password: <input type='password' class='form_input_white' name='passw'><br>
 	<br>
  <input type='submit' value='Submit' class='btton_co'>
</form>
</div>
";
?>
</body>
</html>
