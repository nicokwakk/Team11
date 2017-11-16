<?php
include_once("include/include_metaData.php");
include_once('include/db.php');
$branch = $_SESSION['branch'];
?>
<table class='orderTable'>
  <thead>
    <tr>
      <td><b>Customer ID</b></td>
      <td><b>First Name</b></td>
      <td><b>Middle Name</b></td>
      <td><b>Last Name</b></td>
      <td><b>Email</b></td>
      <td><b>1st Address Line</b></td>
      <td><b>2nd Address Line</b></td>
      <td><b>Postcode</b></td>
      <td><b>Country</b></td>
      <td><b>City</b></td>
      <td><b>NewsLetter Pref</b></td>
      <td><b>Session ID</b></td>
    </tr>
  </thead>
  <tbody>
    <?php
    $stock_query ="select * from customerfull";
    $stock_prep = $mysql->prepare($stock_query);
    $stock_prep->execute();
    $stock_results = $stock_prep->fetchAll();
    foreach($stock_results as $row){
      ?><tr>
          <td><?php echo $row['CustID']?></td>
          <td><?php echo $row['FirstName']?></td>
          <td><?php echo $row['MiddleName']?></td>
          <td><?php echo $row['LastName']?></td>
          <td><?php echo $row['CustEmail']?></td>
          <td><?php echo $row['FirstLineAddress']?></td>
          <td><?php echo $row['SecondLineAddress']?></td>
          <td><?php echo $row['PostCode']?></td>
          <td><?php echo $row['Country']?></td>
          <td><?php echo $row['City']?></td>
          <td><?php echo $row['NewsletterPref']?></td>
          <td><?php echo $row['CustSessionID']?></td>

    <?php
    }
    ?>
  </tbody>
  <table>
    <h2>Edit Customer</h2>
    <form action="https://zeno.computing.dundee.ac.uk/2017-ac32006/team11/web/editCustomer.php?custID=<?php echo $custID ?>">
      <label for='custID'>Select Email of Customer to Remove</label>
      <select name='custID'>
        <?php
        foreach($stock_results as $row){
          ?>
          <?php
          $custID= $row['CustID'];
          $email = $row['CustEmail'];
          echo"
        <option value='$custID'>$email</option>
          ";
        }
        ?>
      </select>
      <input type='submit' name='submit'>
    </form>
  <br>
  <h2>Remove Customer</h2>
  <form action="https://zeno.computing.dundee.ac.uk/2017-ac32006/team11/web/removeCustomer.php?custID=<?php echo $custID ?>">
    <label for='custID'>Select Email of Customer to Remove</label>
    <select name='custID'>
      <?php
      foreach($stock_results as $row){
        ?>
        <?php
        $custID= $row['CustID'];
        $email = $row['CustEmail'];
        echo"
      <option value='$custID'>$email</option>
        ";
      }
      ?>
    </select>
    <input type='submit' name='submit'>
  </form>
