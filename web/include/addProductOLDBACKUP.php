<?php include_once('include/include_metaData.php'); ?>

<!DOCTYPE html>

<html lang='en'>

	<head>
		  <?php	//include_once('include/db.php'); ?>
		  <?php include_once('include/include_header.php'); ?>
			<?php include_once('include/include_functions.php'); ?>
			<?php include_once('include/process_phppostcode.php');?>
		  </head>
		  <body>
		  <div id="tester_input"> <!--For validation of the form -->
		  <?php
				$productName=$brand=$price=$type=$imagePath=$productDesc="";
				$productNameErr=$brandErr=$priceErr=$typeErr=$imagePathErr=$productDescErr="";
				//Image stuff needs to be added. But I am unsure about so I haven't included it yet.

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
					if(empty($_POST["productName"])){ //checking if required box is empty
						$productNameErr="Product name is required";
					}
					else{
						$productName = test_input($_POST["productName"]);
					}
					if(empty($_POST["brand"])){ //checking if required box is empty
						$brandErr="Brand is required";
					}
					else{
						$brand = test_input($_POST["brand"]);
						//$add2Err=testLettersAndWhiteSpace($add2);
					}
					if(empty($_POST["price"])){ //checking if required box is empty
						$PriceErr="Price is required";
					}
					else{
						$price = test_input($_POST["price"]);
						$priceErr=testNumbers($price);
					}
					if(empty($_POST["productDesc"])){ //checking if required box is empty
						$productDescErr="Product Description is required";
					}
					else{
						$productDesc = test_input($_POST["productDesc"]);
					}
				}

      ?>
			</div>
			<div class="Form">
				 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				Product Name: <br> <input type='text' class='form_input_white' name='productName' required='required' value="<?php echo $productName;?>"><br>
				<span class="error">* <?php echo $productNameErr;?></span>
			  <br><br>
				Brand: <br> <input type='text' class='form_input_white' name='brand' value="<?php echo $brand;?>"><br>
				<span class="error">* <?php echo $brandErr;?></span>
			  <br><br>
				Price: <br> <input type='text' class='form_input_white' name='price' required='required' value="<?php echo $price;?>"><br>
				<span class="error">* <?php echo $priceErr;?></span>
			  <br>
				Type:
					<select name='type'>
						<option>Laptop</option>
						<option>Desktop</option>
						<option>Tablet</option>
						<option>Accessory</option>
						<option>Printer</option>
						<option>TV</option>
						<option>Camera</option>
						<option>Monitor</option>
				</div>
				<br><br><br><br>
				Product Description: <textarea class='form_input_white' name='productDesc' required='required' rows="8" cols="60" value="<?php echo $productDesc;?>">
				</textarea>
					<span class="error">* <?php echo $productDescErr;?></span>
				  <br><br><br>
				</form>
				<form action="process_uploadImg.php" method="post" enctype="multipart/form-data">
  			Select image to upload:
		    	<input type="file" name="fileToUpload" id="fileToUpload">
  				<input type="submit" value="Upload Image" name="submit">
				</form>





      </body>
</html>
