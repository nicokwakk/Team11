<?php
$passw = password_hash('marcslentils', PASSWORD_DEFAULT);
echo $passw;
?>
div.admin-panel {
	padding: 0 18px;
background-color: white;
max-height: 0;
overflow: hidden;
transition: max-height 0.2s ease-out;
}
/* Style the buttons that are used to open and close the accordion panel */
button.admin-accordion {
    background-color: rgb(42,81,79);
    color: white;
    cursor: pointer;
		font-size:16px;
    padding: 18px;
    width: 100%;
    text-align: left;
    border: 1px solid rgb(42,81,79);
    outline: none;
		margin-bottom:5px;
    transition: 0.4s;
}

/* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
button.admin-accordion.active, button.admin-accordion:hover {
    background-color: white;
		color:rgb(42,81,79);
}


<div class='toolButton'>
<button class='adminButton' onclick='changeframe(this.id)' id='uProduct'>Update Product</button>
</div>
<div class='toolButton'>
<button class='adminButton' onclick='changeframe(this.id)' id='rStock' >Remove Stock</button>
</div>
<div class='toolButton'>
<button class='adminButton' onclick='changeframe(this.id)' id='createSale' >Create Sale</button>
</div>

<div class='toolButton'>
<button class='adminButton' onclick='changeframe(this.id)' id='dOrder'>Delete Order</a>
</div>

<div class='toolButton'>
<button class='adminButton' onclick='changeframe(this.id)' id='uStaff'>Update Staff</button>
</div>
<div class='toolButton'>
<button class='adminButton' onclick='changeframe(this.id)' id='rStaff'>Delete Staff</button>
</div>

<div class='toolButton'>
<button class='adminButton' onclick='changeframe(this.id)' id='rCustomer'>Remove Customer</button>
</div>
