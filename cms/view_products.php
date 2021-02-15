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
    
    <table id="table"></table>
   
</div>


<script>

window.onload = show_products;

function show_products(){
    let Table = document.getElementById("table");
    Table.innerHTML="";
    let _request = new XMLHttpRequest();
    _request.onload= function(){
        if(_request.status === 200){
            let productsJSON = _request.responseText;
            let productsArray = JSON.parse(productsJSON);
            let newRow = table.insertRow(table.lenght);

            var cell = newRow.insertCell(0);
                cell.innerHTML = "Title";

            var cell = newRow.insertCell(1);
                cell.innerHTML = "Price";

            var cell = newRow.insertCell(2);
                cell.innerHTML = "Description";

            var cell = newRow.insertCell(3);
                cell.innerHTML = "Category";

            var cell = newRow.insertCell(4);
                cell.innerHTML = "Manufacturer";

            var cell = newRow.insertCell(5);
                cell.innerHTML = "Image";


            for (let i = 0; i < productsArray.length; i++){
                newRow = table.insertRow(table.length);

                cell = newRow.insertCell(0);
                cell.innerHTML = productsArray[i].Title;

                cell = newRow.insertCell(1);
                cell.innerHTML = productsArray[i].Price;

                cell = newRow.insertCell(2);
                cell.innerHTML = productsArray[i].Description;

                cell = newRow.insertCell(3);
                cell.innerHTML = productsArray[i].Category;

                cell = newRow.insertCell(4);
                cell.innerHTML = productsArray[i].Manufacturer;

                cell = newRow.insertCell(5);
                cell.innerHTML = productsArray[i].Image;
            }

        }else
            alert("Server error:" + _request.status);
    };
    _request.open("POST", "load_products.php");
    _request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    _request.send();
}
</script>
        


<?php
        outputFooter();
?>