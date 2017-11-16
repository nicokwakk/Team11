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
	$product_query = "select * from basket where CustSessionID = '$sessionid'";
	$product_prep = $mysql->prepare($product_query);
	$product_prep->execute();
	$product_result = $product_prep->fetchAll();
	$productName ='';
		$Brand = '';
		$Price = 0;
		$Salespercent = 0;
		$ImagePath = '';
		$Quantity = '';
		$psubtotal =0;
		$ptotal =0;
		$gtotal =0;
		echo "<div class='main_div'>
		<br>
		<div class='sixty'>
		<h2>Your Shopping Basket</h2>
		<hr>";
	foreach($product_result as $row){
		$productName = $row['ProductName'];
		$productID = $row['ProductID'];
		$Brand = $row['Brand'];
		$Price = $row['Price'];
		$Salespercent = $row['SalePercentage'];
		$ImagePath = $row['ImagePath'];
		$Quantity = $row['Quantity'];
		$ptotal = 0;
		$psubtotal = ($Price * $Quantity);
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
		  <p id='bsktQuantityLabel'>Quantity : </p>
			<form id='basketminus' action ='include/removeBasket.php' method='post'>
					<input type='hidden' value='$productID' name='productid'>
					<input type='submit' id='basketmin' name='submit' value='-'>
				</form>
				<p id='basketQuantity'>$Quantity</p>
				<form id='basketplus' action ='include/addBasketCheckout.php' method='post'>
					<input type='hidden' value='$productID' name='productid'>
					<input type='submit' id='basketpls' name='submit' value='+'>
				</form>
		  ";
		  if($Salespercent != 0){
		  echo "
		  <p id='sale'>Sale Percentage: $Salespercent%</p>
		  ";
		  }
		  echo "
		  <p>Sub Total: £$ptotal</p>
		  </div>
			</div>
			</div>
			";
	}
	echo "</div>";
}
	$product_prep->closeCursor();


echo "
<div class='basketTotal'>
	<h2 id='compBask'>Complete Your Order</h2>
	<hr>
	<p>Select your delivery option</p>
	<form name='checkoutSubmit' method='post' action='include/processCheckout.php'>
		<select id='del_type' name='deliverytype'>
			<option value='free'>Free Delivery (5-7 Days)</option>
			<option value='nd'>Next Day Delivery</option>
		</select>
		<p id='tprice'>Total Price : </p><p id='greentext'>£$gtotal</p>
		<br>
		<button name='basket' id='bsktSubmit'>CHECKOUT PRODUCTS</button>
	</form>
</div>
</div>
</body>
";
?>
