<!DOCTYPE html>
<html lang='en'>
<head><?php include('include/include_metaData.php');  ?></head>
<body style ="background-color: rgb(42,81,79); ">
<?php
if(isset($_SESSION['loggedin']) && !(($_SESSION['loggedin']) == false)){
	header("location: account.php");
}

echo " <p id='PCSHOP'> PC SHOP </p>";
$code = (isset($_GET['code']) ? $_GET['code'] : '0');
echo "
<div class='login_form' >
<h2> Login</h2>
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
<form method='post' action='include/process_login.php' class=''>
  Email: <input type='text' class='form_input_white' name='email'><br>
  Password: <input type='password' class='form_input_white' name='passw'><br>
  <a id='forgot_pw' href=''> Forgot your password ?</a> <br>
  <input type='submit' value='Submit' class='btton_co'>
</form>
<p id='border_text'> Don't have an account ?</p>
<a href='register.php' class = 'link_co'> Create Account </a>
</div>
";
?>
</body>
</html>
