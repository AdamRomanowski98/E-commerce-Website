//Import recommender class
import {Recommender} from './recommender.js';
//Create recommender object - it loads its state from local storage
let recommender = new Recommender();
document.getElementById("search-btn").onclick = search;


//Searches for products in database
function search(){
    //Extract the search text
    let searchText = document.getElementById("search-p").value;
    
    search_prod();
    //Add the search keyword to the recommender
    recommender.addKeyword(searchText);

    showRecommendation();
    }

function outputRecommended(request){

	document.getElementById("recommendationTable").innerHTML = "";
	let recommended = JSON.parse(request.responseText);
	let tab = document.getElementById("recommendationTable");

	let newR = tab.insertRow(tab.length);

    
	for(let x=0; x<recommended.length; x++){
		let recommendedId= recommended[x]._id.$oid;
		let recommendedName= recommended[x].Title;
		let recommendedPrice= recommended[x].Price;
		let recommendedImage= recommended[x].Image;


		let cell = newR.insertCell();

		cell.innerHTML ='<div class="small-containerr">'+
                        '<div class="col-4">'+
                        '<div class="shop-product-container">'+
                        '<div class="shop-product-box">'+
                        '<div class="shop-product-img">'+
                        '<button  onclick= \'addToBasket("'+recommendedId+'")\' class="add-cart">'+
                        '<i class="fas fa-shopping-cart"></i>'+
                        '</button>'+
						'<img src='+ recommendedImage +'>' +
                        '</div>'+
                        '</div>'+
                        '<div class="shop-product-details">'+
                     	'<h4 id="name" class="Newp-name">' + recommendedName +'</h4>'+
                        '<h4 id="price" class="p-price">' +  recommendedPrice + '£</h4>'+
                        '</div>'+
                        '</div>'+
                        '</div>'+
                        '</div>';	
	}


}

//Display the recommendation in the document
function showRecommendation(){ 
    

let topKeyWord = recommender.getTopKeyword();
console.log(topKeyWord);
let request = new XMLHttpRequest();
console.log('request: ' + request);

request.onload = () => {
	if(request.status === 200){
		console.log('responseText- ' +request.responseText);

		outputRecommended(request);
		
	}
	else{
		alert("Error communicating with server: "+request.status);
	}
}
request.open("POST", "recommended.php", true);
request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
request.send("topKey=" +topKeyWord);


}

 //Search for product 
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