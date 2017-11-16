<?php
session_start();
include_once('db.php');
if(!(isset($_SESSION['loggedin'])) || ($_SESSION['loggedin'] == false)){
  header('location: ../login.php?code=1');
}else{
  $pid=$_POST['productid'];
  $sesh = session_id();
  $userid = 0;
  $mysql->query( "CALL getCustIDfromSession('$sesh',@userID);" );
  $userid = 0;
  foreach($mysql->query( "SELECT @userID" ) as $row)
  {
    $userid=$row['@userID'];
  }
  $pid = (INTEGER)$_POST['productid'];
  $mysql->query("CALL checkPurchased('$pid','$userid',@checked);");
  foreach($mysql->query( "SELECT @checked" ) as $row)
  {
    $checked=$row['@checked'];
  }
    echo "<form id='submitForm' action='../product.php?productid=$pid' method='POST'>";
    echo "<input type ='hidden' name='checked' value='$checked'>";
    #echo "<input type ='hidden' name='productid' value='$pid'>";
    echo "</form>";

}
echo "<script type='text/javascript'>
document.getElementById('submitForm').submit();
</script>
";
?>
