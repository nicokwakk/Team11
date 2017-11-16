<?php include_once('include/include_metaData.php'); ?>
<head>
	<?php include_once('include/include_header.php'); ?>
</head>
<body>
<?php
if(!(isset($_SESSION['loggedin']))){
	header("location: login.php?code=3");
}else{
	include_once('include/db.php');
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
		<div class='wishlistitem_content'>
		<div class='wishlistcolL'>
		<a href='product.php?productid=$productID'>
		<img src='$ImagePath/1.jpg' class='wishlistimg'>
		</a>
		</div>
		<div class ='wishlistcolR'>
		<div class='wishlisthalf'>
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
<br>
<hr>
<br>
<div class = 'accountorders'>
<p><b>Your Orders</b></p>
";
$product_query = "select * from salesfull where CustID = '$custId' ORDER BY CustOrderID ASC";
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
	$curcustorder = 0;
	$newdiv = 0;
	$i=0;
foreach($product_result as $row){
	$i=$i+1;
	$productName = $row['ProductName'];
	$productID = $row['ProductID'];
	$Brand = $row['Brand'];
	$Price = $row['CalculatedPrice'];
	$beforeOrderID = $row['CustOrderID'];
	$status = $row['StatusState'];
	$dateo = $row['DateOrdered'];
	$dated = $row['DateDelivered'];
	$totalprice = $row['TotalPrice'];
	$delivery = $row['DeliveryType'];
	$quantity = $row['Quantity'];

		if($curcustorder != $beforeOrderID){
			if($i > 1){
				echo"</div>";
			}
			$newdiv=1;
			$tempOrderID = $row['CustOrderID'];
			echo "<div class='seperateOrder'>";
			echo "<h4> Order Num: #$tempOrderID</h3>";
			echo "Status of Order: ";
			switch($status){
				case 0:
					echo "Ordered Placed";
				break;
				case 1:
					echo "Ordered Processing";
				break;
				case 2:
					echo "Ordered Dispatched";
				break;
				case 3:
					echo "Order Delivered";
				break;
				case 4:
					echo "Returned";
				break;
				case 5:
					echo "Courier Returned to Sender";
				break;
				default:
					echo "Unknown(Please contact customer services)";
					break;
			}
			echo "<br>";
			echo "Current Status: $status<br>";
			echo "Date Ordered: $dateo<br>";
			if($dated == NULL){
				echo "Date Delivered: Not Yet Delivered<br>";
			}else{
				echo "Date Delivered: $dated<br>";
			}

			echo "Total Order Price : $totalprice<br>";
			if($delivery == "free"){
				echo "Delivery Method: Free UK Delivery (3-5 days)<br>";
			}elseif ($delivery == "nd"){
				echo "Delivery Method: Next Day Delivery<br>";
			}
			echo "<br>";
		}
	$CustOrderID = $row['CustOrderID'];
  $curcustorder = $CustOrderID;
	$ImagePath = $row['ImagePath'];
	$gtotal = $gtotal + $ptotal;
		echo "
		<div class='ordertitem_content'>
		<div class='ordercolL'>
		<a href='product.php?productid=$productID'>
		<img src='$ImagePath/1.jpg' class='orderimg'>
		</a>
		</div>
		<div class ='ordercolR'>
		<div class='orderhalf'>
		<h3>$Brand $productName</h3>
		<p>£$Price per unit</p>
		";
		echo "
		</div>
		</div>
		<br>
		</div>
		";
}
if($newdiv == 1){
	echo"</div>";
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
