<?php
include_once("include/include_metaData.php");
include_once('include/db.php');
$branch = $_SESSION['branch'];
?>
<table class='orderTable'>
  <thead>
    <tr>
      <td><b>Order ID</b></td>
      <td><b>Product ID</b></td>
      <td><b>Customer ID</b></td>
      <td><b>Date Ordered</b></td>
      <td><b>Date Delivered</b></td>
      <td><b>Price</b></td>
      <td><b>Delivery Type</b></td>
      <td><b>Product Brand</b></td>
      <td><b>Product Name</b></td>
      <td><b>Quantity</b></td>
    </tr>
  </thead>
  <tbody>
    <?php
    $stock_query ="select * from salesfull";
    $stock_prep = $mysql->prepare($stock_query);
    $stock_prep->execute();
    $stock_results = $stock_prep->fetchAll();
    foreach($stock_results as $row){
      ?><tr>
          <td><?php echo $row['CustOrderID']?></td>
          <td><?php echo $row['ProductID']?></td>
          <td><?php echo $row['CustID']?></td>
          <td><?php echo $row['DateOrdered']?></td>
          <td><?php echo $row['DateDelivered']?></td>
          <td><?php echo $row['TotalPrice']?></td>
          <td><?php echo $row['DeliveryType']?></td>
          <td><?php echo $row['Brand']?></td>
          <td><?php echo $row['ProductName']?></td>
          <td><?php echo $row['Quantity']?></td>

    <?php
    }
    ?>
  </tbody>
  <table>
