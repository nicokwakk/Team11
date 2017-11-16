<?php
?>
		<header class='header' >
		<p id='PCSHOP_head'><a id="headhome" href="index.php"> PC SHOP </a></p>
		<div id='link_head' >
		<?php
		if(!(isset($_SESSION['loggedin'])) || ($_SESSION['loggedin'] == false)){
		echo "<a href ='login.php' class='link_head' style='border-right: 1px white solid;'> Log In </a>";
	}else{
		$sesh = session_id();
		$email_query = "select CustEmail from customers where CustSessionID = '$sesh'";
		$email_prep = $mysql->prepare($email_query);
		$email_prep->execute();
		$email_result = $email_prep->fetchAll();
		$email ='';
		foreach($email_result as $row){
			$email = $row['CustEmail'];
		}
		echo "
		<div class='dropdown'>
		<button class='dropbtn'>$email</button>
		<div class='dropdown-content'>
			<a id='drop' href='account.php'>View Account</a>
			<a id='drop' href='account.php#wishlist'>View Wishlist</a>
		<a id='drop' href='include/process_logout.php'>Logout</a>
		</div>
		</div>
		";
	}
		?>
		<?php
		echo "<a href ='basket.php' class='link_head'> Basket ($basketCount)</a>";
		?>
		<?php
				echo "
						<form action='../web/allProducts.php' method='post' class='searchForm'>
							<input type='text' id='searchbar' name='search' value='' >
							<span class='error'></span>
							<button class='btton_search'>Search</button>
						</form>

				";
			?>
		</div>
		<div class="snd_head">
				<a class="head_link" href="allProducts.php"> All products </a>
				<a class="head_link" href="allProducts.php?sort=Laptops"> Laptops </a>
				<a class="head_link" href="allProducts.php?sort=Desktops"> Desktops </a>
				<a class="head_link" href="allProducts.php?sort=Tablets"> Ipads And Tablets </a>
				<a class="head_link" href="allProducts.php?sort=Accessorys"> Accessories </a>
				<a class="head_link" href="allProducts.php?sort=Printers"> Printers </a>
				<a class="head_link" href="allProducts.php?sort=Monitors"> Monitors </a>
		</div>

		</header>

		<body>
			<div class ="main_body">
