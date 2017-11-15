<?php include_once('include/include_metaData.php'); ?>
<html>
<head>
	<?php include_once('include/include_header.php'); ?>
	<?php include_once('include/db.php'); ?>
	<?php include_once('include/include_functions.php');?>
</head>

<body>
	<?php
	function filter($filter,$search)//function for applying the filter and search options
	{
		global $mysql;
	  $search= test_input($search); //strips the search of any special characterss
	  if($search == ""){
	    $product_thumbquery = "Select * from products where TypeOfProduct = '$filter' ;";
	  }
	  else {
	    $product_thumbquery = "SELECT * FROM products WHERE ProductName LIKE '%" .$search. "%' OR Brand LIKE '%" .$search. "%' OR TypeOfProduct LIKE '%" .$search. "%';";
	    //Does a LIKE statement for the search on the type, brand and name}
	  }
	  if($filter == '*' && $search == ""){
	    $product_thumbquery = "Select * from products ;";
	  }
		echo "The actual query being used ... " .$product_thumbquery;
	  $product_thumbcheck = $mysql->prepare($product_thumbquery);
	  $product_thumbcheck->execute();
	  $product_thumbresult = $product_thumbcheck->fetchAll();
		$product_thumbcheck->closeCursor();
	  return $product_thumbresult;

	} ?>

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



	</div>

	<div class='allProducts'>
		<div class='filterForm'>
				<?PHP
				if($_SERVER["REQUEST_METHOD"] == "POST")
				{
					$priceQuery="";
					if(!empty($_POST['priceFilter'])){
						$lowerEnd=1000; //sets up the lower end of the range to collect values
						$highEnd=0; //sets up the higher end of the range to collect values

						foreach($_POST['priceFilter'] as $priceRange)
						{
							if(intval($priceRange)<$lowerEnd)
							{
								$lowerEnd = intval($priceRange);
							}
							if(intval($priceRange)>$highEnd) //needs to be a separate if function for the first number thrugh - it might fullfill both conditions
							{
								$highEnd = intval($priceRange);
							}
							//Get the lowest range and highest range and deliver them into a
						}
						$highEnd+=100; //Adds 100 to $highEnd as the lower value of the range is stored in the checkbox
						//BECOMES : WHERE Price BETWEEN $lowEnd AND $highEnd;
						$priceQuery = "Price BETWEEN " .$lowerEnd. " AND " .$highEnd. " ";
					}
					//becomes "Type = " .$typeRange. " OR Type = " .$typeRange. " OR ....."
					$typeQuery ="Type = "; //initialising variable
					if(!empty($_POST['typeFilter'])){
						foreach($_POST['typeFilter'] as $typeRange)
						{
							if(count($typeRange) - 1 == 0)//if the array is on the final part LengthException
							{
								$typeQuery.= "" .$typeRange. " ";//finish off this part of query
							}
							else
							{
								$typeQuery.= "" .$typeRange. " OR Type = ";//add another OR to handle more filters
							}

						}
					}
					//becomes "Brand = " .$brandRange. " OR Brand = " .$brandRange. " OR ....."
					$brandQuery=""; //initialising brandQuery
					if(!empty($_POST['brandFilter'])){
						foreach($_POST['brandFilter'] as $brandRange)
						{

							if(count($brandRange) - 1 == 0)//if the array is on the final part
							{
								$brandQuery.= "" .$brandRange. " "; //finish off this part of query
							}
							else
							{
								$brandQuery.= "" .$brandRange. " OR Brand = "; //add another OR to handle more filters
							}

						}
					}

					//Done with finding out what the parts of the query are, now putting them together
					if($priceQuery=="") //if priceQuery has not been filled
					{
						$priceQuery ="Price = *"; //assign it the wildcard value so it does not affect the query
					}

					if($typeQuery =="") //same thing happens to all parts of the query
					{
						$typeQuery = 'Type = ';

						if((isset($_GET['filter'])))
						{
							$typeQuery .= ($_GET['filter']); //uses the URL to find out what Type Page they are looking at
						}
						else
						{
							$typeQuery .="*"; //nothing in the URL go back to normal way
						}

					}

					if($brandQuery=="")
					{
						$brandQuery="Brand = *";
					}
					$search = (isset($_POST['search']) ? $_POST['search'] : '');

					$filterQuery = "SELECT * FROM products WHERE " .$priceQuery. " AND " .$typeQuery. " AND " .$brandQuery. ";"; //the total query
					$filterResult = filter($filterQuery, $search); //currently filters the whole database
					displayProducts($filterResult); //displays the results of the filter
					//for testing purposes
					echo $priceQuery;
					echo $typeQuery;
					echo $brandQuery;
					echo $filterQuery;
				}
				?>

				<div id="filterPrice"> <!--holds the different price options-->
					<form method="post" action="<?php ($_SERVER["PHP_SELF"]);?>">
						Price: <br> <!--The [] is so I can access each set of checkboxes as an array-->
						<input type="checkbox" name="priceFilter[]" value="0">£0 to £100<br>
						<input type="checkbox" name="priceFilter[]" value="100">£100 to £200<br>
						<input type="checkbox" name="priceFilter[]" value="200">£200 to £300<br>
						<input type="checkbox" name="priceFilter[]" value="300">£300 to £400<br>
						<input type="checkbox" name="priceFilter[]" value="400">£400 to £500<br>
						<input type="checkbox" name="priceFilter[]" value="500">£500 to £600<br>
						<input type="checkbox" name="priceFilter[]" value="600">£600 to £700<br>
						<input type="checkbox" name="priceFilter[]" value="700">£700 to £800<br>
						<input type="checkbox" name="priceFilter[]" value="800">£800 to £900<br>
						<input type="checkbox" name="priceFilter[]" value="900">£900 to £1000<br>
						<input type="checkbox" name="priceFilter[]" value="1000">£1000 to £1100<br>
						<br><br> <!--adding a break in the elements for the filter menu-->
				</div>
				<div id="filterType">
						Type: <br>
						<input type="checkbox" name="typeFilter[]" value="Laptop">Laptops<br>
						<input type="checkbox" name="typeFilter[]" value="Desktop">Desktops<br>
						<input type="checkbox" name="typeFilter[]" value="Tablet">Tablets<br>
						<input type="checkbox" name="typeFilter[]" value="Accessory">Accessories<br>
						<input type="checkbox" name="typeFilter[]" value="Printer">Printers<br>
						<input type="checkbox" name="typeFilter[]" value="Monitor">Monitors<br><br>

						Brand: <br>
						<?php
						$brandCheck = $mysql->prepare("SELECT distinct Brand FROM products"); //fetches all the different brands from products
						$brandCheck->execute();
						$brandResult = $brandCheck->fetchAll();
						$i =0;
						foreach ($brandResult as $row)
						{
							echo "
								<input type='checkbox' name='brandFilter[]' value='" .$row['Brand']. "'>".$row['Brand']." <br>
								"; //iterates through all the brands and displays them
								$i++;
						}
						?>
						<input type="submit" value="Apply">
					</form>
				</div>

		<?php

			//$filterQuery = (isset($_GET['filter']) ? $_GET['filter'] : '*');

		function displayProducts($product_thumbresult) //a function that display thumbnails of products returned from a search of the database
		{
			$id='';
			$name ='';
			$brand ='';
			$price ='';
			$type ='';
			$sales ='';
			$image='';
			$desc='';
			$i=0;
			//the statement below returns true if no rows are found when searching
			//if(!$product_thumbresult->fetchColumn()) //if no. rows found 0 do-
			//{
				//echo "No results found, please type in singular keywords";
			//}
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
			//$product_thumbcheck->closeCursor();
		}

		?>

	</div> <!--ends the allProducts div that holds the filter options-->
</div> <!--Ends the main div that holds everything in the main part of the page-->
</body>



<?php include('include/include_footer.php'); ?>
</html>
