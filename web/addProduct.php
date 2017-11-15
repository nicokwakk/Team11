<?php include('include/include_metaData.php'); ?>

<!DOCTYPE html>

<html lang='en'>

	<head>
		  <?php	//include('include/db.php'); ?>
		  <?php include('include/include_header.php'); ?>
			<?php include('include/include_functions.php'); ?>
			<?php include('include/process_phppostcode.php');?>
		  </head>
		  <body>
		  <div id="tester_input"> <!--For validation of the form -->
		  <?php
				$productName=$brand=$price=$type=$imagePath=$productDesc="";
				$productNameErr=$brandErr=$priceErr=$typeErr=$imagePathErr=$productDescErr="";

				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					if(empty($_POST["productName"])){ //checking if required box is empty
						$productNameErr="Product name is required";
					}
					else{
						$productName = test_input($_POST["productName"]); //strip white space out?
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
						$priceErr=testNumber($price);
					}
					if(empty($_POST["productDesc"])){ //checking if required box is empty
						$productDescErr="Product Description is required";
					}
					else{
						$productDesc = test_input($_POST["productDesc"]);
					}



					if(empty($_POST["fileToUpload"]))
					{
					//from W3Schools tutorial https://www.w3schools.com/php/php_file_upload.asp

					  $target_dir = "../images/" + $brand; //we want to store the img in the img folder underneath the brand and then the name
					  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
					  $uploadOk = 1;
					  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
					  // Check if image file is a actual image or fake image
					  if(isset($_POST["submit"])) {
					      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
					      if($check !== false) {
					          echo "File is an image - " . $check["mime"] . ".";
					          $uploadOk = 1;
					      } else {
					          echo "File is not an image.";
					          $uploadOk = 0;
					      }
					  }

					  // Check if file already exists
					  if (file_exists($target_file)) {
					      echo "Sorry, file already exists.";
					      $uploadOk = 0;
					  }

					  // Check file size
					  if ($_FILES["fileToUpload"]["size"] > 500000) {
					     echo "Sorry, your file is too large.";
					     $uploadOk = 0;
					  }

					  // Allow certain file formats
					  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg")
					  {
					      echo "Sorry, only JPG, JPEG & PNG files are allowed.";
					      $uploadOk = 0;
					  }

					  // Check if $uploadOk is set to 0 by an error
					  if ($uploadOk == 0) {
					      echo "Sorry, your file was not uploaded.";
					  // if everything is ok, try to upload file
					  }
					  else {
					      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					          echo "The file ". basename( $_FILES["fileToUpload"]["productName"]). " has been uploaded.";
					      } else {
					          echo "Sorry, there was an error uploading your file.";
					      }
					  }
					}
					//Should mostly add product details into the database. Needs to correct what image path is and if we can actually do it
					//$type=$_POST("type")
					//if($productNameErr == "" && $brandErr== "" && $priceErr == "" && $imagePathErr== "" && $productDescErr =="")
					//{
						//$mysql->query( "CALL CreateProduct('$productName','$brand','$price','$type','100',$imagepath, $productDesc, @pID)" );
						//foreach($mysql->query( "SELECT @bID" ) as $row)
						//{
						//debug($row);
						//}

					//}

				}
      ?>
			</div>
			<div class="Form">
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
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
						<option>Monitor</option>
				</div>
				<br><br><br><br>
				Product Description: <textarea class='form_input_white' name='productDesc' required='required' rows="8" cols="60" value="<?php echo $productDesc;?>">
				</textarea>
					<span class="error">* <?php echo $productDescErr;?></span>
				  <br><br><br>


  			Select image to upload:
		    	<input type="file" name="fileToUpload" id="fileToUpload">
  				<input type="submit" value="Upload Image" name="submit">
				</form>





      </body>
</html>
