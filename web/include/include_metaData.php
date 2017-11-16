<?php
include ('db.php');
session_start();

if(!(isset($_SESSION['loggedin'])) || $_SESSION['loggedin'] == false){
	$basketCount = 0;
}else if (($_SESSION['loggedin']) == true){
	$seshID = session_id();
	$basketCount = $_SESSION['basketcount'];
	$userID = $_SESSION['userID'];
	$mysql->query( "CALL updateSessionID('$userID', '$seshID', 0);" );
}
?>
<!DOCTYPE html>
<html lang='en'>
	<head>
		<meta charset='UTF-8'>
		<title> PC SHOP </title>
		<link rel="stylesheet" href="../css/stylesheet.css" />
	    <link rel="stylesheet" media="all and (max-device-width: 500px)" href="../css/mobile.css" />
	    <link type="text/css" rel="stylesheet" media="all and (max-width: 1000px) and (min-device-width:500px)" href="../css/tablet.css"/>
		<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	</head>
