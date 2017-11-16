<?php include_once('include/include_metaData.php'); ?>
<html>
<head>
	<?php include_once('include/include_header.php'); ?>
  <?php include_once('include/include_functions.php'); ?>
	<?php include_once('include/db.php'); ?>
</head>
<?php
echo "
<div id='snd_head_global'>
			<div class='snd_head_big snd_head_big_2'>
					<a class='head_link' href=''>Free Delivery on Orders</a>
			</div>
			<div class='snd_head_big snd_head_big_2'>
					<a class='head_link' href=''>Finance Options</a>
			</div>
			<div class='snd_head_big'>
						<a class='head_link' href=''>Click and Collect from any of our store</a>
			</div>
			<div class='snd_head_big'>
					<a class='head_link' href=''>Need Help ? Contact our support team</a>
			</div>
		</div>
		<div class='main_div'>
			<div class='banner'>
				<img id='ad_banner' src='../images/Icons/ad1.png'>
		</div>

		<div class='allProducts'>
		";
$filter = (isset($_GET['filter']) ? $_GET['filter'] : '*');

$search= test_input($_Post('search')); //strips the search of any special characterss
$product_thumbquery = "SELECT ProductName, Brand, TypeOfProduct FROM products WHERE ProductName LIKE '%$search%' OR Brand LIKE '%$search%' OR TypeOfProduct LIKE '%$search%';";
//Does a LIKE statement for the search on the type, brand and name

$product_thumbcheck = $mysql->prepare($product_thumbquery);
$product_thumbcheck->execute();
$product_thumbresult = $product_thumbcheck->fetchAll();
$id='';
$name ='';
$brand ='';
$price ='';
$type ='';
$sales ='';
$image='';
$desc='';
$i=0;
foreach($product_thumbresult as $row){

  $id = $row['ProductID'];
  $name = $row['ProductName'];
  $brand = $row['Brand'];
  $price = $row['Price'];
  $type = $row['TypeOfProduct'];
  $sales = $row['SalePercentage'];
  $image = $row['ImagePath'];
  $desc = $row['ProductDesc'];
  echo "<div class='product_thumb'>";
  echo "<div class='product_thumbimgcont'>";
  echo "<img src='$image/1.jpg' border='0' class='product_thumbimg'/>";
  echo "</div>";
	echo "$brand $name";
	echo "<br>";
	echo "£$price";
	echo "<br>";
	echo "<form action='product.php?productid=' method='get' class='productredirect'>
	<input type='hidden' name='productid' value='$id' class='hidden'>
	<input type='submit' value='More Details' class='more_details'></input>
	</form>";
  echo "</div>";
  $i++;
};
$product_thumbcheck->closeCursor();

echo "
		</div>
	</div>
</body>
";
?>
<?php include_once('include/include_footer.php'); ?>
</html>
