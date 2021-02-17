//display products from database 
	function output_products(request){
        document.getElementById("table").innerHTML="";
        let product = JSON.parse(request.responseText);	
        let t = document.getElementById("table");
        
            let newRow = t.insertRow(t.length);
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
        //load products from database 
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
    
        // price ascending 
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
    
    //price descending 
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
    
    //Product name ascending 
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
    
    //Product name descending 
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
    
   

    
    function openNav() {
        document.getElementById("mySidenav").style.width = "350px";
    }
    
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
    

    
    