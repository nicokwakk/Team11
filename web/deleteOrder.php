<?php
include_once("include/include_metaData.php");
include_once('include/db.php');
$branch = $_SESSION['branch'];
$product = $_GET['prodID'];
$query = "CALL removeOrder($product)";
header("location:../adminpanel.php");
?>
