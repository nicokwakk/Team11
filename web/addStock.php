<?php
include_once("include/include_metaData.php");
include_once('include/db.php');
$branch = $_SESSION['branch'];
?>

<form>
  <input type='hidden' value=''>
  <label for='ProductName'>Product Name</label>
  <input type='text' id='ProductName' name='ProductName'>
  <label for='Brand'>Brand</label>
  <input type='text' id='Brand' name='Brand'>
  <label for='Price'>Price</label>
  <input type='text' id='Price' name='Price'>
  <label for='type'>Type Of Product</label>
  <select name='type'>
    <option>Laptop</option>
    <option>Desktop</option>
    <option>Tablet</option>
    <option>Accessory</option>
    <option>Printer</option>
    <option>Monitor</option>
  </select>
  <label for='=path'>Image Path</label>
  <input type='text' id='Brand' name='Brand'>
  <label for='Brand'>Brand</label>
  <input type='text' id='Brand' name='Brand'>
  <label for='Brand'>Brand</label>
  <input type='text' id='Brand' name='Brand'>
  <label for='Brand'>Brand</label>
  <input type='text' id='Brand' name='Brand'>

</form>
