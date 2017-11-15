<?php include('include/include_metaData.php'); ?>
<head>
	<?php include('include/include_header.php'); ?>
</head>
<body>
<?php
if(!(isset($_SESSION['loggedin']))){
	header("location: login.php?code=3");
}else{
	include('include/db.php');
	$sessionid = session_id();
	$cust_query = "select * from customerfull where CustSessionID = '$sessionid'";
	$cust_prep = $mysql->prepare($cust_query);
	$cust_prep->execute();
	$cust_result = $cust_prep->fetchAll();
	$custId = 0;
	$custnameID = 0;
	$custAddressID = 0;
	$custemail ='';
	$contactnumber = 0;
	$newsletterpref = 0;
	$passID = 0;
	$FirstLineAddress = '';
	$SecondAddress = '';
	$Postcode = '';
	$Country = '';
	$City = '';
	$Firstname = '';
	$Middlename = '';
	$Lastname = '';
	foreach($cust_result as $row){
		$custId = $row['CustID'];
		$custemail = $row['CustEmail'];
		$contactnumber = $row['ContactNum'];
		$newsletterpref = $row['NewsletterPref'];
		$FirstLineAddress = $row['FirstLineAddress'];
		$SecondAddress = $row['SecondLineAddress'];
		$Postcode = $row['PostCode'];
		$Country = $row['Country'];
		$City = $row['City'];
		$Firstname = $row['FirstName'];
		$Middlename = $row['MiddleName'];
		$Lastname = $row['LastName'];
}
}
echo "
<div class='main_div'>
<br>

<h2>My Account</h2>
<hr>
<div class='accountdiv'>
<p><b>Account Details</b></p>
<div class='personal_info'>
<p><b>Personal Information</b></p>
<p>First Name : $Firstname </p>
<p>Second Name : $Middlename </p>
<p>Last Name : $Lastname </p>
<p>Email Address : $custemail </p>
<p>Contact Number : $contactnumber</p>
</div>
<div class='Address_info'>
<p><b>Address Information</b></p>
<p>First Line Address : $FirstLineAddress</p>
<p>Additional Address Line : $SecondAddress</p>
<p>Postcode : $Postcode </p>
<p>Country : $Country </p>
<p>City : $City </p>
</div>
<div class='Account-details'>
<p><b>Account Information</b></p>
<p>Customer ID : $custId </p>
<p>Newsletter Preference : $newsletterpref </p>
</div>
</div>
<hr>
<br>
<div class='accountwishlist'>
<p id='wishlist'><b>Your Wishlist</b></p>
";

$sessionid = session_id();
$product_query = "select * from wishlistfull where CustID = '$custId'";
$product_prep = $mysql->prepare($product_query);
$product_prep->execute();
$product_result = $product_prep->fetchAll();
$productName ='';
	$Brand = '';
	$Price = 0;
	$Salespercent = 0;
	$ImagePath = '';
	$psubtotal =0;
	$ptotal =0;
	$gtotal =0;
foreach($product_result as $row){
	$productName = $row['ProductName'];
	$productID = $row['ProductID'];
	$Brand = $row['Brand'];
	$Price = $row['Price'];
	$Salespercent = $row['SalePercentage'];
	$ImagePath = $row['ImagePath'];
	$ptotal = 0;
	$psubtotal = ($Price);
	if($Salespercent == 0){
		$ptotal = $psubtotal;
	}else{
		$ptotal = ($psubtotal * (1 - ($Salespercent/100)));
	}
	$gtotal = $gtotal + $ptotal;
		echo "
		<div class='checkoutitem_content'>
		<div class='checkoutcolL'>
		<a href='product.php?productid=$productID'>
		<img src='$ImagePath/1.jpg' class='checkoutimg'>
		</a>
		</div>
		<div class ='checkoutcolR'>
		<div class='baskethalf'>
		<h3>$Brand $productName</h3>
		<p>£$Price per unit</p>
		";
		if($Salespercent != 0){
		echo "
		<p id='sale'>Sale Percentage: $Salespercent%</p>
		";
		}
		echo "
		<p>Sales Price: £$ptotal</p>
		</div>
		</div>
		<br>
		</div>
		";
}
echo "</div>";

$product_prep->closeCursor();
echo"
<hr>
<br>
<div class = 'accountorders'>
<p><b>Your Orders</b></p>
";
$product_query = "select * from wishlistfull where CustID = '$custId'";
$product_prep = $mysql->prepare($product_query);
$product_prep->execute();
$product_result = $product_prep->fetchAll();
$productName ='';
	$Brand = '';
	$Price = 0;
	$Salespercent = 0;
	$ImagePath = '';
	$psubtotal =0;
	$ptotal =0;
	$gtotal =0;
foreach($product_result as $row){
	$productName = $row['ProductName'];
	$productID = $row['ProductID'];
	$Brand = $row['Brand'];
	$Price = $row['Price'];
	$Salespercent = $row['SalePercentage'];
	$ImagePath = $row['ImagePath'];
	$ptotal = 0;
	$psubtotal = ($Price);
	if($Salespercent == 0){
		$ptotal = $psubtotal;
	}else{
		$ptotal = ($psubtotal * (1 - ($Salespercent/100)));
	}
	$gtotal = $gtotal + $ptotal;
		echo "
		<div class='checkoutitem_content'>
		<div class='checkoutcolL'>
		<a href='product.php?productid=$productID'>
		<img src='$ImagePath/1.jpg' class='checkoutimg'>
		</a>
		</div>
		<div class ='checkoutcolR'>
		<div class='baskethalf'>
		<h3>$Brand $productName</h3>
		<p>£$Price per unit</p>
		";
		if($Salespercent != 0){
		echo "
		<p id='sale'>Sale Percentage: $Salespercent%</p>
		";
		}
		echo "
		<p>Sales Price: £$ptotal</p>
		</div>
		</div>
		<br>
		</div>
		";
}
echo "
<hr>
</div>
<div class='accountsettings'>
<p><b>Account Settings</b></p>
<hr>
</div>
</body>
</html>
";
?>