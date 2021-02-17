//Loads number of products and total price
function loadOrderDetails(){
    try{
        let basket = JSON.parse(sessionStorage.basket);
        let orderTotal = 0;

        for(let i=0; i<basket.length; i++){
            orderTotal += parseInt(basket[i].price);
        }
        document.getElementById('prdCount').innerHTML = "Products:" +basket.length;
        document.getElementById('prdTotal').innerHTML = "Total: $" +orderTotal;
    }
    catch{
        document.getElementById("basket-confirm").innerHTML = "Basket is empty";
    }
}

//completes order
function completeOrder(){

    let date = new Date();
    let basket = JSON.parse(sessionStorage.basket);
    const prdTotal = basket.length;
    let orderTotal = document.getElementById('prdTotal').innerHTML;
    orderTotal = orderTotal.substring(8);
    let firstName = document.getElementById('firstName1').value;
    let lastName = document.getElementById('lastName1').value;
    let phone = document.getElementById('phone1').value;
    let address = document.getElementById('address1').value;
    let city = document.getElementById('city1').value;
    let postCode = document.getElementById('postCode1').value;
    

    productList = '['
    for(let i = 0; i<basket.length; i++){
        productList+= basket[i]._id.$oid + ",";
    }
    date = (date.getHours()+ ":" +date.getMinutes() + " " + date.getDate()+ "/" + (date.getMonth()+1)+ "/" + date.getFullYear());
    productList = productList.slice(0, -1);
    productList += "]";

    let request = new XMLHttpRequest();

    request.onload = () => {
        if(request.status === 200){
            console.log(request.responseText);

            if(request.responseText == "Thank you, your order has been placed."){
                document.getElementById("checkout-cont").innerHTML = '<div id="checkout-confirm">Thank you, your order has been placed</div>'
                sessionStorage.clear();
            }
        }
        else{
            alert("Error communicating with server: "+request.status);
        }
    }

    request.open("POST", "../new_order.php", true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.send("date=" +date+ "&_surname="+lastName+ "&_phone="+phone+"&_address="+address+"&_city="+city+ "&_postCode="+postCode+ "&basket=" +productList + "&total=" +orderTotal +"&prdtotal=" +prdTotal +"&_name="+firstName);



}