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
	    $product_thumbquery = " " .$filter. " ;";
	  }
	  else {
	    $product_thumbquery = "SELECT * FROM products WHERE ProductName LIKE '%" .$search. "%' OR Brand LIKE '%" .$search. "%' OR TypeOfProduct LIKE '%" .$search. "%';";
	    //Does a LIKE statement for the search on the type, brand and name}
			//if($filter!="") //partial code for it to do filters on searches - needs work to run
			//{
			//	$product_thumbquery.="UNION"; //Adding a second query onto it

			//}

	  }
	  if($filter == '*' && $search == ""){
	    $product_thumbquery = "Select * from products;";
	  }
		//echo "The actual query being used ... " .$product_thumbquery;
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


				<div id="filterPrice"> <!--holds the different price options-->
					<form method="post" action="<?php ($_SERVER["PHP_SELF"]);?>">
						<p class="accordion_ap"> Price </p>
						<div class="panel_ap">
						  <p>
						 <!--The [] is so I can access each set of checkboxes as an array-->
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
						</p>
						</div> <!--adding a break in the elements for the filter menu-->
				</div>
				<div id="filterType">
					<p class="accordion_ap" >Type: </p>
					<div class="panel_ap">
						<p>
  							<input type="checkbox" name="typeFilter[]" value="Laptop">Laptops<br>
							<input type="checkbox" name="typeFilter[]" value="Desktop">Desktops<br>
							<input type="checkbox" name="typeFilter[]" value="Tablet">Tablets<br>
							<input type="checkbox" name="typeFilter[]" value="Accessory">Accessories<br>
							<input type="checkbox" name="typeFilter[]" value="Printer">Printers<br>
							<input type="checkbox" name="typeFilter[]" value="Monitor">Monitors<br><br>
						</p>
					</div>
				</div>

					<p class="accordion_ap">Brand: </p>
						<div class="panel_ap">
						  <p>
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
							</p>
						</div>
						<input type="submit" value="Apply" class="btton_filter">
						<input type='reset' value="Reset Filter" class="btton_filter">
					</form>
			</div>

	<div class="products_filtered">
		<p>
			<?PHP
				$filterON = FALSE; //a boolean that is global that tells if the filter is working or not
				//This has to happen as the filtering code happens when you "POST" the page, normal searches and the header filters won't work with it
				//So it if a filter is supplied it doesn't display what it needs to
				if($_SERVER["REQUEST_METHOD"] == "POST")
				{
					//echo "We are looking at tabs of the header";

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
					$typeQuery =""; //initialising variable
					if(!empty($_POST['typeFilter'])){
							$typeQuery= "TypeOfProduct = ";
							foreach($_POST['typeFilter'] as $typeRange)
							{
								if(count($typeRange) - 1 == 0)//if the array is on the final part
								{
									$typeQuery.="'".$typeRange."'";//finish off this part of query
								}
								else
								{
									$typeQuery.= "'". $typeRange."' OR TypeOfProduct = ";//add another OR to handle more filters
								}

							}
					}
					//becomes "Brand = " .$brandRange. " OR Brand = " .$brandRange. " OR ....."
					$brandQuery=""; //initialising brandQuery
					if(!empty($_POST['brandFilter'])){
							$brandQuery= "Brand = ";
							foreach($_POST['brandFilter'] as $brandRange)
							{

								if(count($brandRange) - 1 == 0)//if the array is on the final part
								{
									$brandQuery.= "'" .$brandRange. "'"; //finish off this part of query
								}
								else
								{
									$brandQuery.= "'" .$brandRange. "' OR Brand = "; //add another OR to handle more filters
								}

							}
					}

					//So if reset is true it means that all these variables should be *

					$filterQuery = "SELECT * FROM products "; //the start of the query
					$firstVariable = FALSE; //says if we have past the first variable or not
					//SELECT * FROM products WHERE
					if($priceQuery!="")
					{
						$filterQuery.="WHERE ";
						$filterQuery.="" .$priceQuery. "";//if price query actually has stuff in it, add it to query
						$firstVariable=TRUE; //The first variable has went in
					} //need the double quotes
					if($typeQuery!="")
					{
						if($firstVariable)
						{
							$filterQuery.= " AND "; //adding an and to to make sure the query gets pieced together
							$filterQuery.="" .$typeQuery. "";//if price query actually has stuff in it, add it to query
						}
						else{
							$filterQuery.="WHERE ";
							$filterQuery.="" .$typeQuery. "";//if price query actually has stuff in it, add it to query
							$firstVariable=TRUE; //The first variable has went in
						}

					}
					if($brandQuery!="")
					{
						if($firstVariable)
						{
							$filterQuery.= " AND "; //adding an and to to make sure the query gets pieced together
							$filterQuery.="" .$brandQuery. "";//if price query actually has stuff in it, add it to query
						}
						else{
							$filterQuery.="WHERE ";
							$filterQuery.="" .$brandQuery. "";//if price query actually has stuff in it, add it to query
							$firstVariable=TRUE; //The first variable has went in
						}

					}
					//S$filterQuery.=";";

					$search = (isset($_POST['search']) ? $_POST['search'] : '');
					$searchSanitized = test_input($search);

					global $filterON;
					$filterON =TRUE; //the filter is going on - ie dont do the other display yet
					//what the query should look like
					//$filterQuery = "SELECT * FROM products WHERE " .$priceQuery. " AND " .$typeQuery. " AND " .$brandQuery. ";"; //the total query
					$filterResult = filter($filterQuery, $searchSanitized); //currently filters the whole database
					displayProducts($filterResult); //displays the results of the filter
					//for testing purposes
					//echo $priceQuery;
					//echo $typeQuery;
					//echo $brandQuery;
					//
					//echo $filterQuery;
				}
				?>



			<?php //the start of the part of the page that displays products normally
			global $filterON;
			if($filterON)
			{
				//do nothing, the filter functions will handle putting things together
			}
			else { //well you aren't filtering it so do proper search or simply just get everything back
				{
					$product_thumbquery = (isset($_GET['sort']) ? $_GET['sort'] : '*'); //sets the filter to one of the header options
					//Need line below as we changed the filter function
					$product_thumbquery ="Select * from products where TypeOfProduct = '$product_thumbquery' ";
					$search = (isset($_POST['search']) ? $_POST['search'] : ''); //sets the search to correct
					$productSearchResult = filter($product_thumbquery, $search); //currently filters the whole database
					displayProducts($productSearchResult); //displays the results of the filter
					//echo "We are looking at tabs of the header";

					global $filterON;
					$filterON = FALSE;
				}
			}


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

			</p>
		</div>
	</div> <!--ends the allProducts div that holds the filter options-->




</div> <!--Ends the main div that holds everything in the main part of the page-->


<style>
	 /* Style the buttons that are used to open and close the accordion panel */
	.accordion_ap {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    text-align: left;
    border: none;
    outline: none;
    transition: 0.4s;
}

/* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
.accordion_ap.active, .accordion_ap:hover {
    background-color: #ccc;
}

/* Style the accordion panel. Note: hidden by default */
.panel_ap {
    padding: 0 18px;
    background-color: white;
    display: none;
}

</style>

<script>

var acc = document.getElementsByClassName("accordion_ap");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel_ap */
        this.classList.toggle("active");

        /* Toggle between hiding and showing the active panel_ap */
        var panel_ap = this.nextElementSibling;
        if (panel_ap.style.display === "block") {
            panel_ap.style.display = "none";
        } else {
            panel_ap.style.display = "block";
        }
    }
}


</script>

</body>
<?php include_once('include/include_footer.php'); ?>
</html>
