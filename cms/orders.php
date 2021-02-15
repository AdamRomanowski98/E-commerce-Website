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
		<li><a href="view_orders.php">View orders</a></li>
		<li><a href="orders.php">Placed orders</a></li> 
    </ul>        
</div>


<div class="cms-product-cont">
    <div id="orderContainer"></div>
</div>


<script>
window.onload =view_orders;

function view_orders(){
    document.getElementById("orderContainer").innerHTML ="";
    let _request = new XMLHttpRequest();
    _request.onload= function(){
        if(_request.status === 200){
            let ordersJSON = _request.responseText;
            console.log (ordersJSON);
           
            let ordersArray = JSON.parse(ordersJSON);
            
            
            document.getElementById("orderContainer").innerHTML ='  <br><table id="table"> </table>';
            let newRow = table.insertRow(table.lenght);

           
            var cell = newRow.insertCell(0);
                cell.innerHTML = "First Name";

            var cell = newRow.insertCell(1);
                cell.innerHTML = "Surname";

            var cell = newRow.insertCell(2);
                cell.innerHTML = "Address";

            var cell = newRow.insertCell(3);
                cell.innerHTML = "City";

            var cell = newRow.insertCell(4);
                cell.innerHTML = "Post Code";

            var cell = newRow.insertCell(5);
                cell.innerHTML = "Date";

            var cell = newRow.insertCell(6);
                cell.innerHTML = "Order id";


            for (let i = 0; i < ordersArray.length; i++){
                newRow = table.insertRow(table.length);
                let orderId = ordersArray[i]._id.$oid;

                cell = newRow.insertCell(0);
                cell.innerHTML = ordersArray[i]["FirstName"];

                cell = newRow.insertCell(1);
                cell.innerHTML = ordersArray[i]["Surname"];
           
                cell = newRow.insertCell(2);
                cell.innerHTML = ordersArray[i]["Address"];
             
                cell = newRow.insertCell(3);
                cell.innerHTML = ordersArray[i]["City"];

                cell = newRow.insertCell(4);
                cell.innerHTML = ordersArray[i]["PostCode"];

                cell = newRow.insertCell(5);
                cell.innerHTML = ordersArray[i]["date"];

                cell = newRow.insertCell(6);
                cell.innerHTML = orderId;


            
            }

        }else
            alert("Server error:" + _request.status);
    };
    _request.open("POST", "load_orders.php");
    _request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    _request.send();
}
</script>
<?php
        outputFooter();
?>