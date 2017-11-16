<?php
include_once("include/include_metaData.php");
include_once('include/db.php');
$branch = $_SESSION['branch'];
$product_query = "CALL productSearch($branch)";
$product_prep = $mysql->prepare($product_query);
$product_prep->execute();
$prod_results = $product_prep->fetchAll();
$prodID = 0;
$prodName = '';
$prodBrand ='';
?>
<body>
  <form action='https://zeno.computing.dundee.ac.uk/2017-ac32006/team11/web/removeProduct.php?productID=<?php echo $prodID ?>'>
  <div class='prodSelect'>
  <label for='productlist'>Select Product to Remove</label>
  <select id='productSelect' name='prodID'>
  <?php
  foreach($prod_results as $row){
    ?>
    <?php
    $prodID = $row['ProductID'];
    $prodName = $row['ProductName'];
    $prodBrand = $row['Brand'];
    echo"
  <option value='$prodID'> $prodBrand  $prodName</option>
  ";
  }
  ?>
  </select>
  <input type='submit' name='submit'>
</form>
</div>
