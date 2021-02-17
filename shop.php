<?php
    include ('common.php');
    outputHeader("Welcome at Middlesex Electronics!");
    outputBannerNavigation("Home");
 ?>
<script type="text/javascript" src="../js/shop.js"></script>
<script type="module" src="../js/recommendations.js"></script>
<script type="module" src="../js/recommender.js"></script>
<body onload="load_prod(), loadBasket()">


<div class = "shop-containerr">

<span style="font-size:30px;cursor:pointer; float: right;" onclick="openNav()">&#x1F6CD; Basket</span>

<div id="mySidenav" class="sidenav">
	   <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
</div>

<div class="sort-cont">
        <button onclick="low_high()" type = "button" class = "btn btn-default btn-sm">Price Low-High</button>
		<button onclick="high_low()" type = "button" class = "btn btn-default btn-sm">Price High-Low</button>
		<button onclick="a_z()" type = "button" class = "btn btn-default btn-sm">Products A-Z</button>
		<button onclick="z_a()" type = "button" class = "btn btn-default btn-sm">Products Z-A</button>	
</div>



<div class="search-cont">
	<div class="search-box">
		<input type="text" class="search" id="search-p" placeholder="Search for products...">
		<button onclick="search_prod()" type="button" id="search-btn">
			<i class="fa fa-search"></i>
		</button>
	</div>
</div>	

        <table id="table"></table>
</div>

<span class="recommendedHeader">Recommended for you</span>
<div id ="recommendedProducts">


	<table id="recommendationTable"></table>

</div>


<?php

        outputFooter("Home");
?>