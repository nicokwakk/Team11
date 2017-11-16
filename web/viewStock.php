<?php
include_once("include/include_metaData.php");
include_once('include/db.php');
$branch = $_SESSION['branch'];
?>
<table>
  <thead>
    <tr>
      <td><b>ProductID</b></td>
      <td><b>Product Name</b></td>
      <td><b>Brand</b></td>
      <td><b>Price</b></td>
      <td><b>Product Type</b></td>
      <td><b>Sale Percentage</b></td>
      <td><b>Product Desc</b></td>
      <td><b>Quantity</b></td>
    </tr>
  </thead>
  <tbody>
    <?php
    $stock_query ="select * from stockfull where BranchID = '$branch'";
    $stock_prep = $mysql->prepare($stock_query);
    $stock_prep->execute();
    $stock_results = $stock_prep->fetchAll();
    foreach($stock_results as $row){
      ?><tr>
          <td><?php echo $row['ProductID']?></td>
          <td><?php echo $row['ProductName']?></td>
          <td><?php echo $row['Brand']?></td>
          <td><?php echo $row['TypeOfProduct']?></td>
          <td><?php echo $row['SalePercentage']?></td>
          <td><?php echo $row['ImagePath']?></td>
          <td><?php echo $row['ProductDesc']?></td>
          <td><?php echo $row['Quantity']?></td>

    <?php
    }
    ?>
  </tbody>
  <table>
