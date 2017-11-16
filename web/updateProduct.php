<?php
include_once("include/include_metaData.php");
include_once('include/db.php');
$branch = $_SESSION['branch'];
$product = $_GET['prodID'];
$query = "select * from productfull where ProductID = '$product'";
$prep = $mysql->prepare($query);
$prep->execute();
$result = $prep->fetchAll();
foreach($result as $row){
  ?>
  <form>
    <form action="include/updateProduct.php" method="post">
    Product Name: <br> <input type='text' class='form_input_white' name='productName' required='required' value="<?php echo $row['ProductName']?>"><br>
    Brand: <br> <input type='text' class='form_input_white' name='brand' value="<?php echo $row['Brand']?>"><br>
    Price: <br> <input type='text' class='form_input_white' name='price' required='required' value="<?php echo $row['Price']?>"><br>
    Type:
      <select name='type'>
        <option>Laptop</option>
        <option>Desktop</option>
        <option>Tablet</option>
        <option>Accessory</option>
        <option>Printer</option>
        <option>Monitor</option>
    </div>
    <br>
    <label for='productDesc'>Product Description</label>
    <input type='text' class='form_input_white' name='productDesc' required='required' rows="8" cols="60" value="<?php echo $row['ProductDesc']?>">
    </textarea>
    <br>
    <label for='spec1'>Spec 1</label>
    <input type='text' class='form_input_white' name='spec1' required='required' value="<?php echo $row['spec1']?>"><br>    <label for='spec1'>Spec 2</label>
    <input type='text' class='form_input_white' name='spec2' required='required' value="<?php echo $row['spec2']?>"><br>    <label for='spec1'>Spec 3</label>
    <input type='text' class='form_input_white' name='spec3' required='required' value="<?php echo $row['spec3']?>"><br>    <label for='spec1'>Spec 4</label>
    <input type='text' class='form_input_white' name='spec4' required='required' value="<?php echo $row['spec4']?>"><br>    <label for='spec1'>Spec 5</label>
    <input type='text' class='form_input_white' name='spec5' required='required' value="<?php echo $row['spec5']?>"><br>    <label for='spec1'>Spec 6</label>
    <input type='text' class='form_input_white' name='spec6' required='required' value="<?php echo $row['spec6']?>"><br>  <label for='spec1'>Spec 7</label>
    <input type='text' class='form_input_white' name='spec7' required='required' value="<?php echo $row['spec7']?>"><br>  <label for='spec1'>Spec 8</label>
    <input type='text' class='form_input_white' name='spec8' required='required' value="<?php echo $row['spec8']?>"><br>  <label for='spec1'>Spec 9</label>
    <input type='text' class='form_input_white' name='spec9' required='required' value="<?php echo $row['spec9']?>"><br>  <label for='spec1'>Spec 10</label>
    <input type='text' class='form_input_white' name='spec10' required='required' value="<?php echo $row['spec10']?>"><br>
    <input type="submit" name='submit'>
    </form>
  </form>
<?php
}

 ?>
<style>
form{
  text-align: center;
}
</style>
