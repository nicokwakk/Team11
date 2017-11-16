<?php include_once('include/include_metaData.php'); ?>
<head>
	<?php include_once('include/admin_header.php'); ?>
</head>
<body>
<?php
echo "
<div class='admin_div'>
<div class='tool-panel'>
<button class='admin-accordion'>Stock</button>
<div class='admin-panel'>
<div class='toolButton'>
<button class='adminButton' onclick='changeframe(this.id)' id='vStock'>View Stock</button>
</div>
<div class='toolButton'>
<button class='adminButton' onclick='changeframe(this.id)' id='oStock'>Order Stock</button>
</div>
<div class='toolButton'>
<button class='adminButton' onclick='changeframe(this.id)' id='aStock' >Add Product</button>
</div>
</div>

<button class='admin-accordion'>Orders</button>
<div class='admin-panel'>
<div class='toolButton'>
<button class='adminButton' onclick='changeframe(this.id)' id='instore'>Create in-store Order</button>
</div>
<div class='toolButton'>
<button class='adminButton' onclick='changeframe(this.id)' id='vOrder'>View Order History</button>
</div>
</div>

<button class='admin-accordion'>Staff</button>
<div class='admin-panel'>
<div class='toolButton'>
<button class='adminButton' onclick='changeframe(this.id)' id='vStaff'>View Staff</button>
</div>
<div class='toolButton'>
<button class='adminButton' onclick='changeframe(this.id)' id='aStaff'>Add Staff</button>
</div>
</div>

<button class='admin-accordion'>Customers</button>
<div class='admin-panel'>
<div class='toolButton'>
<button class='adminButton' onclick='changeframe(this.id)' id='vCustomer'>View Customers</button>
</div>
<div class='toolButton'>
<button class='adminButton' onclick='changeframe(this.id)' id='sendNewsletter'>Send Newsletter</a>
</div>
</div>
</div>
</div>
<div class='adminFunctionality'>
  <iframe id='pageframe' sandbox='allow-forms allow-scripts' class='fullPage' src='https://zeno.computing.dundee.ac.uk/2017-ac32006/team11/web/createBranch.php'></iframe>
</div>
";
?>
<script>
var acc = document.getElementsByClassName("admin-accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].onclick = function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  }
}
</script>
<script>
	function changeframe(id){
		if (id == 'vStock'){
			document.getElementById('pageframe').src = 'https://zeno.computing.dundee.ac.uk/2017-ac32006/team11/web/viewStock.php';
		}else if (id == 'oStock'){
			document.getElementById('pageframe').src = 'https://zeno.computing.dundee.ac.uk/2017-ac32006/team11/web/orderStock.php';
		}else if (id == 'aStock'){
			document.getElementById('pageframe').src = 'https://zeno.computing.dundee.ac.uk/2017-ac32006/team11/web/addProduct.php';
		}else if (id == 'uProduct'){
			document.getElementById('pageframe').src = 'https://zeno.computing.dundee.ac.uk/2017-ac32006/team11/web/selectProduct.php';
		}else if (id == 'rStock'){
			document.getElementById('pageframe').src = 'https://zeno.computing.dundee.ac.uk/2017-ac32006/team11/web/removeStock.php';
		}else if (id == 'createSale'){
			document.getElementById('pageframe').src = 'https://zeno.computing.dundee.ac.uk/2017-ac32006/team11/web/createSale.php';
		}else if (id == 'instore'){
			document.getElementById('pageframe').src = 'https://zeno.computing.dundee.ac.uk/2017-ac32006/team11/web/instore.php';
		}else if (id == 'vOrder'){
			document.getElementById('pageframe').src = 'https://zeno.computing.dundee.ac.uk/2017-ac32006/team11/web/viewOrder.php';
		}else if (id == 'dOrder'){
			document.getElementById('pageframe').src = 'https://zeno.computing.dundee.ac.uk/2017-ac32006/team11/web/deleteOrder.php';
		}else if (id == 'vStaff'){
			document.getElementById('pageframe').src = 'https://zeno.computing.dundee.ac.uk/2017-ac32006/team11/web/viewStaff.php';
		}else if (id == 'aStaff'){
			document.getElementById('pageframe').src = 'https://zeno.computing.dundee.ac.uk/2017-ac32006/team11/web/addStaff.php';
		}else if (id == 'uStaff'){
			document.getElementById('pageframe').src = 'https://zeno.computing.dundee.ac.uk/2017-ac32006/team11/web/updateStaff.php';
		}else if (id == 'rStaff'){
			document.getElementById('pageframe').src = 'https://zeno.computing.dundee.ac.uk/2017-ac32006/team11/web/removeStaff.php';
		}else if (id == 'vCustomer'){
			document.getElementById('pageframe').src = 'https://zeno.computing.dundee.ac.uk/2017-ac32006/team11/web/viewCustomer.php';
		}else if (id == 'rCustomer'){
			document.getElementById('pageframe').src = 'https://zeno.computing.dundee.ac.uk/2017-ac32006/team11/web/removeCustomer.php';
		}else if (id == 'sendNewsletter'){
			document.getElementById('pageframe').src = 'https://zeno.computing.dundee.ac.uk/2017-ac32006/team11/web/newsletter.php';
		}
	}
</script>
