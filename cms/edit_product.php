<?php
    include ('../common.php');
    outputHeader("CMS Login"); 
    outputBannerNavigation("Home"); 
?>      

<!--- cms navbar -->
<div class="cms-container">
    <ul>
		<li><a href="add_product.php">Add product</a></li>
        <li><a href="edit_product.php">Edit product</a></li>
		<li><a href="view_products.php">View products</a></li>
		<li><a href="orders.php">Placed orders</a></li> 
    </ul>        
</div>
<!----------------------------------------------------------------------------------->


	<div class="checkItem">
			<div class="form-group">
				<label for = "title">Enter name of product to edit:</label>
				<input type="text" class="form-control" id="productTitle">
			</div>

			<div class = "input-group">
				<button onclick = "check_product()" class="checkItemBtn">Check if product exist</button>
			</div>
	</div>
<!------------------------------------------------------------->
<div class="cms-product-cont">
	<h1 class="addProductsh1">Edit product</h1>
	<form class="productCont">

		<div class="form-group">
    		<label for="productTitle">Title</label>
    		<input type="text" class="form-control" id="newProductTitle" name="title" placeholder="Product title" readonly>
		</div>
	
	
		<div class="form-group">
    		<label for="productPrice">Price</label>
    		<input type="text" class="form-control" id= "productPrice" name="price" placeholder="Product price">
		</div>
	 
	 
		<div class="form-group">
    		<label for="productDescription">Description</label>
    		<input type="text" class="form-control" id="productDescription" name="description" placeholder="Description">
		</div>
	
	
		<div class="form-group">
    		<label for="productCategory">Category</label>
    		<input type="text" class="form-control" id="productCategory" name="category" placeholder="Category">
		</div>	

		<div class="form-group">
    		<label for="productManufacturer">Manufacturer</label>
    		<input type="text" class="form-control" id="productManufacturer" name="manufacturer" placeholder="Manufacturer">
		</div>

		<div class="form-group">
    		<label for="productImage">Image</label>
    		<input type="text" class="form-control" id="productImage" name="image" placeholder="/jpg/product_image.jpg">
		</div>
	
	 
	<div class="input-group">
		<button onclick="change_product()"  class="item_add btn btn-primary col-md-12">Edit product</button>
	</div>

</div>





<script>

//function which finds products by Title and displays them
function check_product(){
	var request = new XMLHttpRequest();
	request.onload = function(){
		if(request.status === 200){
			var myObj = JSON.parse(this.responseText);
			console.log(myObj);
			
			if (myObj[0] != 0){
			alert("Product found and will be loaded on to page");
			document.getElementById("newProductTitle").value=myObj[0];
			document.getElementById("productPrice").value=myObj[1];
			document.getElementById("productDescription").value=myObj[2];
			document.getElementById("productCategory").value=myObj[3];
			document.getElementById("productManufacturer").value=myObj[4];
			document.getElementById("productImage").value=myObj[5];
			
			}else{
				alert("Please enter product name!");
			}
		}
		else
			alert("Error communicating with server: " + request.status);
	};
	
	request.open("POST", "check_product.php");
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	var ti = document.getElementById("productTitle").value;
	request.send("_title=" + ti);
}	


//function which allows customer to change product details
function change_product(){
	var _request = new XMLHttpRequest();
	_request.onload = function(){
		if(_request.status === 200){
			var responseData = _request.responseText;
			alert(responseData);
		}else
			alert("Error communicating with server: " + _request.status);
	};
	_request.open("POST", "update_product.php");
	_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	var pt = document.getElementById("newProductTitle").value;
	var pp = document.getElementById("productPrice").value;
	var pd = document.getElementById("productDescription").value;
	var pc = document.getElementById("productCategory").value;
	var pm = document.getElementById("productManufacturer").value;
	var pi = document.getElementById("productImage").value;
	_request.send("NewProduct=" + pt + "&NewPrice=" + pp + "&NewDescription=" + pd + "&NewCategory=" + pc + "&NewManufacturer=" + pm + "&NewImage=" + pi);	
}
</script>

<?php
        outputFooter();
?>