<?php include('include/include_metaData.php'); ?>
<html>
<head>
	<?php include('include/include_header.php'); ?>
</head>
<?php
$search = (isset($_GET['productid']) ? $_GET['productid'] : 'x');



if($search == 'x'){
	 header( 'Location: 404.php');
}

include ('include/db.php');
$product_query = "Select * from productfull where ProductID = '$search';";
$product_check = $mysql->prepare($product_query);
$product_check->execute();
$product_result = $product_check->fetchAll();
$name ="";
$brand ="";
$price ="";
$type ="";
$sales ="";
$image="";
$desc="";
foreach($product_result as $row){
  $name = $row['ProductName'];
  $brand = $row['Brand'];
  $price = $row['Price'];
  $type = $row['TypeOfProduct'];
  $sales = $row['SalePercentage'];
  $image = $row['ImagePath'];
  $desc = $row['ProductDesc'];
  $spec1 = $row['spec1'];
  $spec2 = $row['spec2'];
  $spec3 = $row['spec3'];
  $spec4 = $row['spec4'];
  $spec5 = $row['spec5'];
  $spec6 = $row['spec6'];
  $spec7 = $row['spec7'];
  $spec8 = $row['spec8'];
  $spec9 = $row['spec9'];
  $spec10 = $row['spec10'];
};
$product_check->closeCursor();
$vatprice = $price * 0.833;
$stock_query = "CALL getProductQuantity('$search',@quant);";
$stock_check = $mysql->prepare($stock_query);
$stock_check->execute();
$stock_result = $stock_check->fetchAll();
$quantity ="";
foreach($stock_result as $row){
  $quantity = $row['TotalQuantity'];
};
$stock_check->closeCursor();

$review_query = "CALL calcAverageReview('$search',@reviewAVG);";
$review_get = $mysql->prepare($review_query);
$review_get->execute();
$review_result = $review_get->fetchALL();
$score='';
foreach($review_result as $row){
	$score = $row['reviewAVG'];
}
$review_get->closeCursor();
$actualscore = $score/2;
$customerthoughts ='';
if($actualscore > 4){
	$customerthoughts = 'Excellent';
}else if($actualscore > 3){
	$customerthoughts = 'Good';
}else if($actualscore > 2){
	$customerthoughts = 'Okay';
}

echo "<br>";

echo "
<div class='main_div'>
		<h1> $brand  $name </h1>
		<hr>
		<br>
		<div class='product_cont'>
";
		$images = array_diff(scandir($image), array('.', '..','thumb.jpg','Thumbs.db'));
		$i=0;
		echo "<div class='product_images'>";
		foreach ($images as &$filename) {
				if($i==0){
					echo "<div class='contmain'>";
					echo "<img src='$image/$filename' id='mainimg' border='0' class='product_img'/>";
					echo "</div>";
					echo"<br>";
					echo "<img src='$image/$filename' id='selected' border='0' id='subimg$i' onclick='setImage(this)' class='product_subimg'/>";
				}else{
					echo "<img src='$image/$filename' border='0' id='subimg$i' onclick='setImage(this)' class='product_subimg'/>";
				}
				$i++;
		}
		$review_get->closeCursor();
echo "
		<div id='myModal' class='modal'>
		  <div class='modal-content'>
			  <div class='modal-header'>
				<span class='close'>&times;</span>
				<h2>Write a Product Review</h2>
			  </div>
			  <div class='modal-body'>
			<form action='include/addReview.php' method='post' class='review_form'>
			  Name:<br>
			  <input type='text' name='firstname'><br>
			  Review Text:<br>
			  <textarea name='reviewtext' rows='1' id='reviewtext' cols='1' length='1000'>
			  </textarea>
			  <br>
			  Star Rating:<br>
			  <input type='text' name='stars'><br><br>
			  <input type='submit' name='Submit'>
			  <br>
			  <input type='hidden' name='productid' value='$search'>
			</form>
			  </div>
			  <div class='modal-footer'>
				<h3></h3>
			  </div>
		</div>

		</div>
		</div>
		<div class='product_options'>
		";
		if ($quantity > 0){
			echo"<p class='stock'>$quantity items in stock</p>";
		}else{
			echo"<p class='stock' id='outofstock'>Item is currently out of stock</p>";
		}
		echo "
			<p class='price'>£$price</p>
			<p class='vatPrice'>£$vatprice exc vat</p>
			<p id='reviewScore'>On average, customers thought the product was: <b>$customerthoughts</b></p>
			<p id='reviewScore'>Average Review : $actualscore/5</p>
			<form action='include/addBasket.php' method='post'>
			";
			if ($quantity > 0){
				echo"<button type='submit' class='btnBasket'>Add to Basket</button>";
			}else{

				echo"<button type='submit' id='disabledBasket' class='btnBasket'>Out Of Stock</button>";
				echo"<script>document.getElementById('disabledBasket').disabled = true;</script>";
			}
			echo "
			<input type='hidden' value='$search' name='productid'>
			</form>
			";
			if((isset($_SESSION['loggedin'])) || ($_SESSION['loggedin'] == true)){
				$sesh = session_id();
				$mysql->query( "CALL getCustIDfromSession('$sesh',@userID)" );
				$userid = 0;
				foreach($mysql->query( "SELECT @userID" ) as $row)
				{
					$userid=$row['@userID'];
				}

				$mysql->query( "CALL checkWishList('$search','$userid',@pCount)" );
				foreach($mysql->query( "SELECT @pCount" ) as $row)
				{
					$count=$row['@pCount'];
				}
				if($count == 0){
					echo "
					<form action='include/addWishlist.php' method='post'>
					<button class='btnWishlist'>Add To Wishlist</button>
					<input type='hidden' value='$search' name='productid'>
					";
				}else{
					echo "
					<form action='include/removeFromWishlist.php' method='post'>
					<button class='btnWishlist'>Remove From Wishlist</button>
					<input type='hidden' value='$search' name='productid'>
					";
				}

			}
echo "
			</form>

			<form action='include/checkPurchased.php' method='post'>
			<button type='submit' class='btnReview'>Write Review</button>
			<input type='hidden' value='$search' name='productid'>
			</form>
		</div>
		<div class='del_options'>
			<button onclick='changetext1()' class='accordion1'>+ Delivery Options</button>
			<div class='panel'>
				<h3 id='test1' class='del_padding'>Free Delivery</h3>
				<p class='del_font'>Delivered within 3-5 working days More delivery options including Weekend, timed and European delivery are also available at the checkout.</p>
				<h3 class='del_padding'>Express Delivery</h3>
				<p class='del_font'>Order in the next 3h 08m for delivery tomorrow when choosing Next Working Day delivery from £5.99. Or reserve & collect from our Portsmouth showroom for free.</p>
			</div>
			<button onclick='changetext2()' class='accordion2'>+ Returns</button>
			<div class='panel'>
				<p class='del_font'>Items can be returned free of cost within 28 days of date of delivery. All products come with a 2 year warranty, as per E.U. (RIP) rules and regulations.</p>
			</div>
			<button onclick='changetext3()' class='accordion3'>+ Finance this product</button>
			<div class='panel'>
				<p class='del_font'>Currently our finance option is only availble in one of our branches. Use our branch finder to find your local branch</p>
			</div>
		</div>
	";

echo "
		<br>
		<br>
		</div>
		<div id='productSpecs'>
		<p id='prodDetails'>Product Details</p>
		<hr>
		<p>$desc</p>
		<br>
		<p id='prodDetails'>Product Specification</p>
		<hr>
		<p>$spec1</p>
		<p>$spec2</p>
		<p>$spec3</p>
		<p>$spec4</p>
		<p>$spec5</p>
		<p>$spec6</p>
		<p>$spec7</p>
		<p>$spec8</p>
		<p>$spec9</p>
		<p>$spec10</p>
		</div>
		<br>
		<br>
		<div id='productRvws'>
		<p id='prodDetails'>Customer Reviews</p>
		<hr>
		<br>
		";
$review_query = "SELECT * FROM reviews WHERE ProductID = $search;";
$review_check = $mysql->prepare($review_query);
$review_check->execute();
$review_result = $review_check->fetchAll();
$reviewerName ="";
$reviewDesc ="";
$starRating ="";
foreach($review_result as $reviewrow){
  $reviewerName = $reviewrow['ReviewerName'];
  $reviewDesc = $reviewrow['ReviewText'];
  $starRating = $reviewrow['StarRating'];
  $actualRating = $starRating/2;

  echo "
  <div class='review_item'>
  <div class='review_content'>
  <div class='reviewcolL'>
	<img src='../Images/Icons/reviewav.jpg' class='reviewav'>
  </div>
  <div class ='reviewcolR'>
  <h3>$reviewerName's Review</h3>
  <p>\"$reviewDesc\"</p>
  <p>$actualRating/5</p>
  </div>
  </div>
  </div>
  ";
}
 echo"
		</div>
		</div>
	</div>
</body>
";
?>
<?php include('include/include_footer.php'); ?>

<script>
var acc = document.getElementsByClassName("accordion1");
var i;
for (i = 0; i < acc.length; i++) {
  acc[i].onclick = function() {
    this.classList.toggle("active");
		if(this.innerHTML == '+ Delivery Options'){
			this.innerHTML = '- Delivery Options';
		}else{
			this.innerHTML = '+ Delivery Options';
		}
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  }
}
var acc = document.getElementsByClassName("accordion2");
var i;
for (i = 0; i < acc.length; i++) {
  acc[i].onclick = function() {
    this.classList.toggle("active");
		if(this.innerHTML == '+ Returns'){
			this.innerHTML = '- Returns';
		}else{
			this.innerHTML = '+ Returns';
		}
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  }
}
var acc = document.getElementsByClassName("accordion3");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].onclick = function() {
    this.classList.toggle("active");
		if(this.innerHTML == '+ Finance this product'){
			this.innerHTML = '- Finance this product';
		}else{
			this.innerHTML = '+ Finance this product';
		}
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  }
}
</script>
<script language="javascript">
    function setImage(sent) {
		var srcsub = sent.src;
		document.getElementById('selected').setAttribute("style", "")
		document.getElementById('selected').setAttribute("id", "")
		sent.setAttribute("id", "selected");
		document.getElementById('mainimg').src = srcsub;
		sent.setAttribute("style", "border-style: solid; border-color: lightgrey;border-width: 1px;")
    }
</script>
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("btnReview");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}</script>
</html>
