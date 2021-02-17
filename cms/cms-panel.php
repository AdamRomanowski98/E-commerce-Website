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

<script>
            //Global variables 
            let loggedInStr = "<div class='log'><a href='cms-panel.php'>CMS PANEL</a> </div><button class='logOutButton' onclick='logout()'>Logout</button>";
        
            let request = new XMLHttpRequest();
            
            //Check login when page loads
            window.onload = checkLogin;
            
            //Checks whether user is logged in.
            function checkLogin(){
                //Create event handler that specifies what should happen when server responds
                request.onload = function(){
                    if(request.responseText === "ok"){
                        
                    }
                    else{
                        console.log("You must log in!");
                        window.location.replace("cms.php");
                    }
                };
                //Set up and send request
                request.open("GET", "check_login.php");
                request.send();
            }
</script>

<?php
        outputFooter();
?>
