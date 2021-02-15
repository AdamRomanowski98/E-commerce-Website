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

<div class="cms-product-cont">
	<h1 class="addProductsh1">Add products</h1>
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
		<button onclick="add_product()"  class="item_add btn btn-primary col-md-12">Add product</button>
	</div>
<!------------------------------------------------------------------------------------------------------------------------>	 
 </form>
</div>
	
<!------------------------------------------------------------------------------------------------------------------------>	  
   
<script>
function add_product(){
	let request = new XMLHttpRequest();
	request.onload = function(){
		if(request.status === 200){
			let responseData = request.responseText;
			alert(responseData);
		}
		else
			alert("Error communicating with server: " + request.status);
	};
	
	request.open("POST", "product_db.php");
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	let tit = document.getElementById("productTitle").value;
	let pr = document.getElementById("productPrice").value;
	let desc = document.getElementById("productDescription").value;
	let cat = document.getElementById("productCategory").value;
	let manu = document.getElementById("productManufacturer").value;
	let img = document.getElementById("productImage").value;
	request.send("_title=" + tit + "&_price=" + pr + "&_description=" + desc + "&_category=" + cat + "&_manufacturer=" + manu +"&_image=" +img);
	
}

</script>









<?php
        outputFooter();
?>