<!DOCTYPE html>
<html lang='en'>
	<head>
		<meta charset='UTF-8'>
		<title> PC SHOP </title>
		<link rel="stylesheet" href="../css/stylesheet.css" />
		<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	</head>
	<body>
	<div id="wrapper">
	<header class="header">
	<h1 id="logo">PC SHOP</h1>
		<?php
			echo"
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"];?>" method="post" class='searchForm'>
				<input type="text" name="search" value="<?php echo $search;?>">
				<span class="error">* <?php echo $nameErr;?></span>
				
				<fieldset>
				<button id='search_bttn'>Search</button>
				</fieldset>
				</form>
			";
		?>
</body>
</html>