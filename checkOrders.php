<?php
    include ('common.php');
    outputHeader("Welcome at Middlesex Electronics!");
    outputBannerNavigation("Home");
?>


    <table id="table"></table>


<script>

let request = new XMLHttpRequest();
console.log('request: ' + request);
window.onload = loadOrder;

//load orders
function loadOrder(){
    request.onload = function(){
        if(request.status === 200){
            console.log('responseText- ' +request.responseText);
            displayOrders(request.responseText);
        }
        else{
            alert("Error communicating with server: "+request.status);
        }
    }
        request.open("GET", "load_orders.php");
        request.send();
}

//display orders in the table
function displayOrders(jsonOrder){
    document.getElementById("table").innerHTML="";
    let orderArray = JSON.parse(jsonOrder)
    let t = document.getElementById("table");
    let newRow = t.insertRow(t.length);// create a new row

    //Create cells
            var cell = newRow.insertCell(0);
                cell.innerHTML = "First Name";

            var cell = newRow.insertCell(1);
                cell.innerHTML = "Surname";

            var cell = newRow.insertCell(2);
                cell.innerHTML = "Date";

            var cell = newRow.insertCell(3);
                cell.innerHTML = "Total";

    //display orders
    for (let i = 0 ; i < orderArray.length; i++){
        newRow = t.insertRow(t.length);// create a new row


                cell = newRow.insertCell(0);
                cell.innerHTML = orderArray[i].FirstName;

                cell = newRow.insertCell(1);
                cell.innerHTML = orderArray[i].Surname;

                cell = newRow.insertCell(2);
                cell.innerHTML = orderArray[i].date;

                cell = newRow.insertCell(3);
                cell.innerHTML = orderArray[i].total;


    }
}

</script>



<?php
        outputFooter("Home");
?>