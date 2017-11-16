<?php
include_once("include/include_metaData.php");
include_once('include/db.php');
$branch = $_SESSION['branch'];
$customer = $_GET['custID'];
$query = "CALL removeCustomer($customer)";
echo $customer;

?>
