<?php include_once('include/include_metaData.php');  ?>
<!DOCTYPE html>
<html lang='en'>

	<head></head>

<body style ="background-color: rgb(42,81,79); ">
	<?php include_once('include/include_functions.php');  ?>
	<?php include_once('include/process_phppostcode.php');  ?>
<?php

$passw = $email =$add1 =$add2 =$postcode =$country =$city =$fname = $mname =$lname =$pnum =$nlp ="";
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
    //$passw = test_input($_POST["passw"]);
		$passwErr = passwordValidation($passw);
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
	if($emailErr=="" && $passwErr=="" && $add1Err=="" && $add2Err=="" && $postCodeErr=="" && $countryErr=="" && $cityErr=="" && $fnameErr=="" && $mnameErr=="" && $lnameErr=="" && $pnumErr=="" && $nlpErr=="")
	{
		session_start();
		$_SESSION['email'] = $email;
		$_SESSION['passw'] = $passw;
		$_SESSION['add1'] = $add1;
		$_SESSION['add2'] = $add2;
		$_SESSION['postcode'] = $postcode;
		$_SESSION['country'] = $country;
		$_SESSION['fname'] = $fname;
		$_SESSION['mname'] = $mname;
		$_SESSION['lname'] = $lname;
		$_SESSION['pnum'] = $pnum;
		$_SESSION['nlp'] = $nlp;
		//adds them to an array that sends over to the next page

	}
}
echo " <p id='PCSHOP'> PC SHOP </p>";
?>

<div class='register_form'>
<h2>Register</h2>
<form method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' class=''>

  <div class='userdetails'>
	<h4>Account Details</h4>
	  Email: <br> <input type='email' class='form_input_white' name='email' required='required'><br>
	  Password: <br>  <input type='text' class='form_input_white' name='passw' required='required' id='passw'><br>
	  Confirm Password: <br> <input type='text' class='form_input_white' name='confirmpassw' id='confirmpassw' required='required'><br>
	  Newsletter Prefrence: <br> <select name='nlp' >
		  <option value='1'>Yes Please</option>
		  <option value='0'>No Thanks</option>
		</select>
  </div>

  <div class ='personaldetails'>
	<h4>Personal Details</h4>
	  First Name: <br> <input type='text' class='form_input_white' name='fname' required='required'><br>
	  Middle Name: <br> <input type='text' class='form_input_white' name='mname'><br>
	  Last Name: <br> <input type='text' class='form_input_white' name='lname' required='required'><br>
	  1st Line Address: <br> <input type='text' class='form_input_white' name='add1' required='required'><br>
	  2nd Line Address: <br> <input type='text' class='form_input_white' name='add2'><br>
	  Postcode: <br> <input type='text' class='form_input_white' name='postcode' required='required'><br>
	  City: <br> <input type='text' class='form_input_white' name='city' required='required'><br>
	  Mobile No: <br> <input type='tel' class='form_input_white' name='pnum' required='required'><br>
	  Country: <br>
	<select name='country'>
		<option value='AF'>Afghanistan</option>
		<option value='AX'>Åland Islands</option>
		<option value='AL'>Albania</option>
		<option value='DZ'>Algeria</option>
		<option value='AS'>American Samoa</option>
		<option value='AD'>Andorra</option>
		<option value='AO'>Angola</option>
		<option value='AI'>Anguilla</option>
		<option value='AQ'>Antarctica</option>
		<option value='AG'>Antigua and Barbuda</option>
		<option value='AR'>Argentina</option>
		<option value='AM'>Armenia</option>
		<option value='AW'>Aruba</option>
		<option value='AU'>Australia</option>
		<option value='AT'>Austria</option>
		<option value='AZ'>Azerbaijan</option>
		<option value='BS'>Bahamas</option>
		<option value='BH'>Bahrain</option>
		<option value='BD'>Bangladesh</option>
		<option value='BB'>Barbados</option>
		<option value='BY'>Belarus</option>
		<option value='BE'>Belgium</option>
		<option value='BZ'>Belize</option>
		<option value='BJ'>Benin</option>
		<option value='BM'>Bermuda</option>
		<option value='BT'>Bhutan</option>
		<option value='BO'>Bolivia, Plurinational State of</option>
		<option value='BQ'>Bonaire, Sint Eustatius and Saba</option>
		<option value='BA'>Bosnia and Herzegovina</option>
		<option value='BW'>Botswana</option>
		<option value='BV'>Bouvet Island</option>
		<option value='BR'>Brazil</option>
		<option value='IO'>British Indian Ocean Territory</option>
		<option value='BN'>Brunei Darussalam</option>
		<option value='BG'>Bulgaria</option>
		<option value='BF'>Burkina Faso</option>
		<option value='BI'>Burundi</option>
		<option value='KH'>Cambodia</option>
		<option value='CM'>Cameroon</option>
		<option value='CA'>Canada</option>
		<option value='CV'>Cape Verde</option>
		<option value='KY'>Cayman Islands</option>
		<option value='CF'>Central African Republic</option>
		<option value='TD'>Chad</option>
		<option value='CL'>Chile</option>
		<option value='CN'>China</option>
		<option value='CX'>Christmas Island</option>
		<option value='CC'>Cocos (Keeling) Islands</option>
		<option value='CO'>Colombia</option>
		<option value='KM'>Comoros</option>
		<option value='CG'>Congo</option>
		<option value='CD'>Congo, the Democratic Republic of the</option>
		<option value='CK'>Cook Islands</option>
		<option value='CR'>Costa Rica</option>
		<option value='CI'>Côte d'Ivoire</option>
		<option value='HR'>Croatia</option>
		<option value='CU'>Cuba</option>
		<option value='CW'>Curaçao</option>
		<option value='CY'>Cyprus</option>
		<option value='CZ'>Czech Republic</option>
		<option value='DK'>Denmark</option>
		<option value='DJ'>Djibouti</option>
		<option value='DM'>Dominica</option>
		<option value='DO'>Dominican Republic</option>
		<option value='EC'>Ecuador</option>
		<option value='EG'>Egypt</option>
		<option value='SV'>El Salvador</option>
		<option value='GQ'>Equatorial Guinea</option>
		<option value='ER'>Eritrea</option>
		<option value='EE'>Estonia</option>
		<option value='ET'>Ethiopia</option>
		<option value='FK'>Falkland Islands (Malvinas)</option>
		<option value='FO'>Faroe Islands</option>
		<option value='FJ'>Fiji</option>
		<option value='FI'>Finland</option>
		<option value='FR'>France</option>
		<option value='GF'>French Guiana</option>
		<option value='PF'>French Polynesia</option>
		<option value='TF'>French Southern Territories</option>
		<option value='GA'>Gabon</option>
		<option value='GM'>Gambia</option>
		<option value='GE'>Georgia</option>
		<option value='DE'>Germany</option>
		<option value='GH'>Ghana</option>
		<option value='GI'>Gibraltar</option>
		<option value='GR'>Greece</option>
		<option value='GL'>Greenland</option>
		<option value='GD'>Grenada</option>
		<option value='GP'>Guadeloupe</option>
		<option value='GU'>Guam</option>
		<option value='GT'>Guatemala</option>
		<option value='GG'>Guernsey</option>
		<option value='GN'>Guinea</option>
		<option value='GW'>Guinea-Bissau</option>
		<option value='GY'>Guyana</option>
		<option value='HT'>Haiti</option>
		<option value='HM'>Heard Island and McDonald Islands</option>
		<option value='VA'>Holy See (Vatican City State)</option>
		<option value='HN'>Honduras</option>
		<option value='HK'>Hong Kong</option>
		<option value='HU'>Hungary</option>
		<option value='IS'>Iceland</option>
		<option value='IN'>India</option>
		<option value='ID'>Indonesia</option>
		<option value='IR'>Iran, Islamic Republic of</option>
		<option value='IQ'>Iraq</option>
		<option value='IE'>Ireland</option>
		<option value='IM'>Isle of Man</option>
		<option value='IL'>Israel</option>
		<option value='IT'>Italy</option>
		<option value='JM'>Jamaica</option>
		<option value='JP'>Japan</option>
		<option value='JE'>Jersey</option>
		<option value='JO'>Jordan</option>
		<option value='KZ'>Kazakhstan</option>
		<option value='KE'>Kenya</option>
		<option value='KI'>Kiribati</option>
		<option value='KP'>Korea, Democratic People's Republic of</option>
		<option value='KR'>Korea, Republic of</option>
		<option value='KW'>Kuwait</option>
		<option value='KG'>Kyrgyzstan</option>
		<option value='LA'>Lao People's Democratic Republic</option>
		<option value='LV'>Latvia</option>
		<option value='LB'>Lebanon</option>
		<option value='LS'>Lesotho</option>
		<option value='LR'>Liberia</option>
		<option value='LY'>Libya</option>
		<option value='LI'>Liechtenstein</option>
		<option value='LT'>Lithuania</option>
		<option value='LU'>Luxembourg</option>
		<option value='MO'>Macao</option>
		<option value='MK'>Macedonia, the former Yugoslav Republic of</option>
		<option value='MG'>Madagascar</option>
		<option value='MW'>Malawi</option>
		<option value='MY'>Malaysia</option>
		<option value='MV'>Maldives</option>
		<option value='ML'>Mali</option>
		<option value='MT'>Malta</option>
		<option value='MH'>Marshall Islands</option>
		<option value='MQ'>Martinique</option>
		<option value='MR'>Mauritania</option>
		<option value='MU'>Mauritius</option>
		<option value='YT'>Mayotte</option>
		<option value='MX'>Mexico</option>
		<option value='FM'>Micronesia, Federated States of</option>
		<option value='MD'>Moldova, Republic of</option>
		<option value='MC'>Monaco</option>
		<option value='MN'>Mongolia</option>
		<option value='ME'>Montenegro</option>
		<option value='MS'>Montserrat</option>
		<option value='MA'>Morocco</option>
		<option value='MZ'>Mozambique</option>
		<option value='MM'>Myanmar</option>
		<option value='NA'>Namibia</option>
		<option value='NR'>Nauru</option>
		<option value='NP'>Nepal</option>
		<option value='NL'>Netherlands</option>
		<option value='NC'>New Caledonia</option>
		<option value='NZ'>New Zealand</option>
		<option value='NI'>Nicaragua</option>
		<option value='NE'>Niger</option>
		<option value='NG'>Nigeria</option>
		<option value='NU'>Niue</option>
		<option value='NF'>Norfolk Island</option>
		<option value='MP'>Northern Mariana Islands</option>
		<option value='NO'>Norway</option>
		<option value='OM'>Oman</option>
		<option value='PK'>Pakistan</option>
		<option value='PW'>Palau</option>
		<option value='PS'>Palestinian Territory, Occupied</option>
		<option value='PA'>Panama</option>
		<option value='PG'>Papua New Guinea</option>
		<option value='PY'>Paraguay</option>
		<option value='PE'>Peru</option>
		<option value='PH'>Philippines</option>
		<option value='PN'>Pitcairn</option>
		<option value='PL'>Poland</option>
		<option value='PT'>Portugal</option>
		<option value='PR'>Puerto Rico</option>
		<option value='QA'>Qatar</option>
		<option value='RE'>Réunion</option>
		<option value='RO'>Romania</option>
		<option value='RU'>Russian Federation</option>
		<option value='RW'>Rwanda</option>
		<option value='BL'>Saint Barthélemy</option>
		<option value='SH'>Saint Helena, Ascension and Tristan da Cunha</option>
		<option value='KN'>Saint Kitts and Nevis</option>
		<option value='LC'>Saint Lucia</option>
		<option value='MF'>Saint Martin (French part)</option>
		<option value='PM'>Saint Pierre and Miquelon</option>
		<option value='VC'>Saint Vincent and the Grenadines</option>
		<option value='WS'>Samoa</option>
		<option value='SM'>San Marino</option>
		<option value='ST'>Sao Tome and Principe</option>
		<option value='SA'>Saudi Arabia</option>
		<option value='SN'>Senegal</option>
		<option value='RS'>Serbia</option>
		<option value='SC'>Seychelles</option>
		<option value='SL'>Sierra Leone</option>
		<option value='SG'>Singapore</option>
		<option value='SX'>Sint Maarten (Dutch part)</option>
		<option value='SK'>Slovakia</option>
		<option value='SI'>Slovenia</option>
		<option value='SB'>Solomon Islands</option>
		<option value='SO'>Somalia</option>
		<option value='ZA'>South Africa</option>
		<option value='GS'>South Georgia and the South Sandwich Islands</option>
		<option value='SS'>South Sudan</option>
		<option value='ES'>Spain</option>
		<option value='LK'>Sri Lanka</option>
		<option value='SD'>Sudan</option>
		<option value='SR'>Suriname</option>
		<option value='SJ'>Svalbard and Jan Mayen</option>
		<option value='SZ'>Swaziland</option>
		<option value='SE'>Sweden</option>
		<option value='CH'>Switzerland</option>
		<option value='SY'>Syrian Arab Republic</option>
		<option value='TW'>Taiwan, Province of China</option>
		<option value='TJ'>Tajikistan</option>
		<option value='TZ'>Tanzania, United Republic of</option>
		<option value='TH'>Thailand</option>
		<option value='TL'>Timor-Leste</option>
		<option value='TG'>Togo</option>
		<option value='TK'>Tokelau</option>
		<option value='TO'>Tonga</option>
		<option value='TT'>Trinidad and Tobago</option>
		<option value='TN'>Tunisia</option>
		<option value='TR'>Turkey</option>
		<option value='TM'>Turkmenistan</option>
		<option value='TC'>Turks and Caicos Islands</option>
		<option value='TV'>Tuvalu</option>
		<option value='UG'>Uganda</option>
		<option value='UA'>Ukraine</option>
		<option value='AE'>United Arab Emirates</option>
		<option value='GB'>United Kingdom</option>
		<option value='US'>United States</option>
		<option value='UM'>United States Minor Outlying Islands</option>
		<option value='UY'>Uruguay</option>
		<option value='UZ'>Uzbekistan</option>
		<option value='VU'>Vanuatu</option>
		<option value='VE'>Venezuela, Bolivarian Republic of</option>
		<option value='VN'>Viet Nam</option>
		<option value='VG'>Virgin Islands, British</option>
		<option value='VI'>Virgin Islands, U.S.</option>
		<option value='WF'>Wallis and Futuna</option>
		<option value='EH'>Western Sahara</option>
		<option value='YE'>Yemen</option>
		<option value='ZM'>Zambia</option>
		<option value='ZW'>Zimbabwe</option>
</select>
</br>
  </div>
  <div class='submitdiv'>
	<input type='submit' onClick='return validate();' value='Register' class='btton_co'>
  </div>
</form>
<div class='loginexists'>
	<p id='border_text'> Already Have an Account?</p>
	<a href='login.php' class = 'link_co_2'> Login </a>
</div>
</div>





</body>
<script>
function validate() {
var x = document.getElementById('confirmpassw');
    var y = document.getElementById('passw');
if(x.value==y.value) return true;
else{
	alert('PASSWORD NOT THE SAME');
	return false;
}
}
</script>
</html>
