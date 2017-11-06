<!DOCTYPE html>
<html lang='en'>

	<head><?php include('include/include_metaData.php');  ?></head>

<body style ="background-color: rgb(42,81,79); ">
<?php
// PHP code goes here
echo " <p id='PCSHOP'> PC SHOP </p>";
// Declare a variable
//$name = "John Smith";
//echo "My name is ".$name."<br>";
echo "
<div class='login_form' >
<h2> Login</h2>
<form method='post' action='include/process_login.php' class=''>
  Email: <input type='text' class='form_input_white' name='email'><br>
  Password: <input type='text' class='form_input_white' name='passw'><br>
  <a id='forgot_pw' href=''> Forgot your password ?</a> <br>
  <input type='submit' value='Submit' class='btton_co'>
</form>
<p id='border_text'> Don't have an account ?</p>
<a href='' class = 'link_co'> Create Account </a>
</div>
";
?>
</body>
</html>
