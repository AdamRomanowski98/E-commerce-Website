

function getBasket(){
    let basket;
    if(sessionStorage.basket === undefined || sessionStorage.basket === ""){
        basket = [];
    }
    else {
        basket = JSON.parse(sessionStorage.basket);
    }
    return basket;
}

//Displays basket in page.
function loadBasket(){

    let orderTotal = 0;

   
    let basket = getBasket();//Load or create basket
    
    //Build string with basket HTML
    let htmlStr = "";
    let prodIDs = [];
    htmlStr += '<div class="wrap">Your products</div>'
    for(let i=0; i<basket.length; ++i){
        orderTotal += parseInt(basket[i].price);
        htmlStr += '<span class=cartInfo>Product Name: ' +'  '+ basket[i].name +'</span></br>';
        htmlStr += '<span class=cartInfo>Product Price:' +'  '+ basket[i].price +'£</span></br></br>';
        prodIDs.push({id: basket[i].id, count: 1});//Add to product array
    }
    //Add hidden field to form that contains stringified version of product ids.
    htmlStr += "<a href='javascript:void(0)' class='closebtn' onclick='closeNav()'>&times;</a>";
    htmlStr += "<input type='hidden' name='prodIDs' value='" + JSON.stringify(prodIDs) + "'>";
    //Add checkout and empty basket buttons
    htmlStr += '<span class=cartInfo>Total Price: ' + orderTotal +'£</span></br>';
    htmlStr += "<br><button class='cartButton' onclick='emptyBasket()'>Empty Basket</button>";
    htmlStr += "<a href='checkout.php' class='checkoutButton'>Checkout</a>";
    
    
    //Display nubmer of products in basket
    document.getElementById("mySidenav").innerHTML = htmlStr;
}

//adding products to basket 
function addToBasket(prodID){

	openNav();
	let basket = getBasket();
	let request = new XMLHttpRequest();

	request.onload = () => {

		if(request.status === 200){

			console.log(request.responseText);
			let products = JSON.parse(request.responseText);

			basket.push({"_id": products._id, "name": products.Title, "price": products.Price})

			sessionStorage.basket = JSON.stringify(basket);

			loadBasket();
		}
		else{
			alert("Error communicating with server: "+request.status);
		}
	}

	request.open("GET", "add_tobasket.php?prdid=" +prodID, true);
	request.send();
	
	
}

//Deletes all products from basket
function emptyBasket(){
    sessionStorage.clear();
    loadBasket();
}