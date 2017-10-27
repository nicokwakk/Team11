<!DOCTYPE html>
<html lang='en'>
	<head>
		<meta charset='UTF-8'>
		<title> PC SHOP </title>
		<link rel='stylesheet' href='../css/stylesheet.css' />
		<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
	</head>
	<body>
	
	<header class='header'>
	<p id='PCSHOP_head'> PC SHOP </p>
	<p id='link_head'>
		<a href ="#" class="link_head" style='border-right: 1px white solid;'> My account </a>
		<a href ="#" class="link_head"> Basket </a>
	</p>
		<?php
			echo "
				<form action='' method='post' class='searchForm' >
				<input type='text' name='search' value=''>
				<span class='error'></span>
				<button class='btton_search'>Search</button>
				</form>
			";
		?>
	
	</header>

</body>
</html>