<!DOCTYPE html>
<html>
<body>
<?php
include("/web/include/db.php");
$i = 0;
$actualdir ="";
$actualdirdb ="";
  $spec1 = (isset($_POST['spec1']) ? $_POST['spec1'] : "*");
$spec2 = (isset($_POST['spec2']) ? $_POST['spec2'] : "*");
$spec3 = (isset($_POST['spec3']) ? $_POST['spec3'] : "*");
$spec4 = (isset($_POST['spec4']) ? $_POST['spec4'] : "*");
$spec5 = (isset($_POST['spec5']) ? $_POST['spec5'] : "*");
$spec6 = (isset($_POST['spec6']) ? $_POST['spec6'] : "*");
$spec7 = (isset($_POST['spec7']) ? $_POST['spec7'] : "*");
$spec8 = (isset($_POST['spec8']) ? $_POST['spec8'] : "*");
$spec9 = (isset($_POST['spec9']) ? $_POST['spec9'] : "*");
$spec10 = (isset($_POST['spec10']) ? $_POST['spec10'] : "*");
$brand = (isset($_POST['brand']) ? $_POST['brand'] : ' ');
$productName = (isset($_POST['productName']) ? $_POST['productName'] : ' ');
$type= (isset($_POST['type']) ? $_POST['type'] : ' ');
$salePercentage = (isset($_POST['SalePercentage']) ? $_POST['SalePercentage'] : ' ');
$productDesc = (isset($_POST['productDesc']) ? $_POST['productDesc'] : ' ');
$price = (isset($_POST['price']) ? $_POST['price'] : ' ');

//C:\2017-ac32006\team11\images
   if(isset($_FILES['image'])){
     $total = count($_FILES['image']['name']);

// Loop through each file
    for($i=0; $i<$total; $i++) {
      //Get the temp file path
      $tmpFilePath = $_FILES['image']['tmp_name'][$i];
      $extension = pathinfo($_FILES['image']['name'][$i],PATHINFO_EXTENSION);
      //Make sure we have a filepath
      if ($tmpFilePath != ""){
        //Setup our new file path
        $pwd = ("C:".DIRECTORY_SEPARATOR."websites".DIRECTORY_SEPARATOR."2017-ac32006".DIRECTORY_SEPARATOR."team11".DIRECTORY_SEPARATOR."images");
        $actualdir = ($pwd.DIRECTORY_SEPARATOR.$_POST['type'].DIRECTORY_SEPARATOR.$_POST['brand'].DIRECTORY_SEPARATOR.$_POST['productName']);
        $actualdirdb = ("C:".DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR."websites".DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR."2017-ac32006".DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR."team11".DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR.$_POST['type'].DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR.$_POST['brand'].DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR.$_POST['productName']);
        echo $actualdir;
        if (!file_exists($pwd.DIRECTORY_SEPARATOR.$_POST['type'].DIRECTORY_SEPARATOR.$_POST['brand'].DIRECTORY_SEPARATOR.$_POST['productName'])) {
            mkdir($pwd.DIRECTORY_SEPARATOR.$_POST['type'].DIRECTORY_SEPARATOR.$_POST['brand'].DIRECTORY_SEPARATOR.$_POST['productName'], 0777, true);
        }
        $newFilePath = $pwd.DIRECTORY_SEPARATOR.$_POST['type'].DIRECTORY_SEPARATOR.$_POST['brand'].DIRECTORY_SEPARATOR.$_POST['productName'].DIRECTORY_SEPARATOR.($i+1).".".$extension;

        //Upload the file into the temp dir
        if(move_uploaded_file($tmpFilePath, $newFilePath)) {
          chmod($newFilePath, 0755);
          //Handle other code here

        }
      }
    }
    $mysql->query( "CALL CreateProduct('$productName','$brand',$price,'$type',$salePercentage,'$actualdirdb','$spec1','$spec2','$spec3','$spec4','$spec5','$spec6','$spec7','$spec8','$spec9','$spec10','$productDesc', @pID);" );
    foreach($mysql->query( "SELECT @bID" ) as $row)
    {
    echo($row['@bID']);
    }
  }



echo"
<html>
   <body>

      <form action='' method='POST' enctype='multipart/form-data'>
        Product Name: <br> <input type='text' class='form_input_white' name='productName' required='required' ><br>
        <br>
        Brand: <br> <input type='text' class='form_input_white' name='brand' ><br>
        <br>
        Sale Percentage: <br> <input type='text' class='form_input_white' name='SalePercentage' required='required'><br>
        Price: <br> <input type='text' class='form_input_white' name='price' required='required'><br>
        <br>
        Type:
          <select name='type'>
            <option>Laptops</option>
            <option>Desktops</option>
            <option>Tablets</option>
            <option>Accessorys</option>
            <option>Printers</option>
            <option>Monitors</option>
            </select>
        </div>
        <br><br>
        Product Description: <br><textarea class='form_input_white' name='productDesc' required='required' rows='8' cols='60' ></textarea>
          <br><br>
";
?>
          <div id='dynamicInput'> <!--This button and the code behind it was from http://www.randomsnippets.com/2008/02/21/how-to-dynamically-add-form-elements-via-javascript/-->
            Specification 1:<br><input type='text' class='form_input_white' name='spec1'>
          </div>

          <input type='button' value='Add another specification' onClick='addInput("dynamicInput");'>

          <br><br>
        Select image to upload:<br>
          <input name='image[]' type='file' multiple='multiple' />
          <br>
          <input type='submit' value='Submit Product' name='submit'>

      </form>

   </body>
</html>
<script>
//Taken from http://www.randomsnippets.com/2008/02/21/how-to-dynamically-add-form-elements-via-javascript/
var counter = 1;
var limit = 10;
function addInput(divName){
  console.log("1");
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {
          var newdiv = document.createElement('div');
          newdiv.innerHTML = "Specification " + (counter + 1) + " <br><input type='text' name='spec" +(counter+1) +"'>";
          document.getElementById(divName).appendChild(newdiv);
          counter++;
     }
}
</script>
