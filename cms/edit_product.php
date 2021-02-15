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


<div class="registerContainer">
    <div>
        <div class="form-group">
            <label for = "title">Enter name of product to edit:</label>
            <input type="text" class="form-control" id="productTitle">
        </div>

        <div class = "input-group">
            <button onclick = "check_product()" class="item_add btn btn-primary col-md-12">Check if product exist</button>
<!------------------------------------------------------------->
<div class="cms-product-cont">
	<h1 class="addProductsh1">Edit product</h1>
	<form class="productCont">
	
		<div class="form-group">
    		<label for="productTitle">Title</label>
    		<input type="text" class="form-control" id="productTitle" name="title" placeholder="Product title">
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
    		<input type="text" class="form-control" id="productImage" name="image" placeholder="D:\www\jpg\product_image.jpg">
		</div>
	
	 
	<div class="input-group">
		<button onclick="change_product()"  class="item_add btn btn-primary col-md-12">Add product</button>
	</div>





<script>

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
	
	var pr = document.getElementById("NewproductTytule").value;
	var qt = document.getElementById("units").value;
	var prc = document.getElementById("price").value;
	var ph = document.getElementById("path").value;
	_request.send("NewProduct=" + pr + "&NewUnits=" + qt + "&NewPrice=" + prc + "&NewPath=" + ph);	
}
</script>

<?php
        outputFooter();
?>