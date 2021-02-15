<?php
    include ('common.php');
    outputHeader("Welcome at Middlesex Electronics!");
    outputBannerNavigation("Home");
 ?>

 <body onload="load_prod(), loadBasket()">

 <span style="font-size:30px;cursor:pointer; float: right;" onclick="openNav()">&#x1F6CD; Basket</span>

 <div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
</div>


<div class = "shop-containerr">

<div class="sort-cont">
        <button onclick="low_high()" type = "button" class = "btn btn-default btn-sm">Price Low-High</button>
		<button onclick="high_low()" type = "button" class = "btn btn-default btn-sm">Price High-Low</button>
		<button onclick="a_z()" type = "button" class = "btn btn-default btn-sm">Products A-Z</button>
		<button onclick="z_a()" type = "button" class = "btn btn-default btn-sm">Products Z-A</button>	
</div>



<div class="search-cont">
	<div class="search-box">
		<input type="text" class="search" id="search-p" placeholder="Search for products...">
		<button onclick="search_prod()" type="button" class="search-btn">
			<i class="fa fa-search"></i>
		</button>
	</div>
</div>	

        <table id="table"></table>
</div>

<script>


	function output_products(request){
	document.getElementById("table").innerHTML="";
	let product = JSON.parse(request.responseText);	
	let t = document.getElementById("table");
	
		let newRow = t.insertRow(t.length);// create a new row
		for (let i = 0 ; i < product.length; i++){
			
			let productId = product[i]._id.$oid;
			let productName = product[i].Title;
			let productPrice = product[i].Price;
			let productImage = product[i].Image;

			let cell = newRow.insertCell();
			
			cell.innerHTML = '<div class="small-containerr">'+
                        '<div class="col-4">'+
                        '<div class="shop-product-container">'+
                        '<div class="shop-product-box">'+
                        '<div class="shop-product-img">'+
                        '<button  onclick= \'addToBasket("'+productId+'")\' class="add-cart">'+
                        '<i class="fas fa-shopping-cart"></i>'+
                        '</button>'+
						'<img src='+ productImage +'>' +
                        '</div>'+
                        '</div>'+
                        '<div class="shop-product-details">'+
                     	'<h4 id="name" class="Newp-name">' + productName +'</h4>'+
                        '<h4 id="price" class="p-price">' +  productPrice + '£</h4>'+
                        '</div>'+
                        '</div>'+
                        '</div>'+
                        '</div>';			

			
		}

}

    function load_prod(){
	let request = new XMLHttpRequest();
	request.onload = function(){
		if(request.status === 200){	
                output_products(request);
		}else
			alert("Error communicating with server: " + request.status);
	};
	request.open("POST", "load_products.php");
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	let no = 0;
	request.send("_condition=" + no);
        }

    function low_high(){
	let request = new XMLHttpRequest();
	request.onload = function(){
		if(request.status === 200){
			output_products(request);		
		}else
			alert("Error communicating with server: " + request.status);
	};

	request.open("POST", "load_products.php");
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	let no = 1;
	request.send("_condition=" + no);
}

function high_low(){
	let request = new XMLHttpRequest();
	request.onload = function(){
		
		if(request.status === 200){
                        output_products(request);		
		}else
			alert("Error communicating with server: " + request.status);
	};

	request.open("POST", "load_products.php");
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	let no = -1;
	request.send("_condition=" + no);
}

function a_z(){
	let request = new XMLHttpRequest();
	request.onload = function(){
		
		if(request.status === 200){
                        output_products(request);		
		}else
			alert("Error communicating with server: " + request.status);
	};

	request.open("POST", "load_products.php");
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	let no = 2;
	request.send("_condition=" + no);
}

function z_a(){
	let request = new XMLHttpRequest();
	request.onload = function(){
		
		if(request.status === 200){
                        output_products(request);		
		}else
			alert("Error communicating with server: " + request.status);
	};

	request.open("POST", "load_products.php");
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	let no = -2;
	request.send("_condition=" + no);
}

function search_prod(){
	let request = new XMLHttpRequest();
	request.onload = function(){
		if(request.status === 200){	
                output_products(request);
		}else
			alert("Error communicating with server: " + request.status);
	};
	request.open("POST", "load_products.php");
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	let no = 3;
	let search = document.getElementById("search-p").value;
	request.send("_condition=" + no + "&_search=" +search);
}

function openNav() {
    document.getElementById("mySidenav").style.width = "350px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}

 
</script>




<?php

        outputFooter("Home");
?>