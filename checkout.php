<?php
    include ('common.php');
    outputHeader("Welcome at Middlesex Electronics!");
    outputBannerNavigation("Home");
 ?>

 <script type="text/javascript" src="../js/checkout.js"></script>
 <body onload="loadOrderDetails(), checkLogin()">


<div class="checkout-cont">

<div class="registerContainer">
            <div class="col-12">
                <h1 class="changeDetH1">Shipping Details</h1>
                    <form >
                        <div class="row">
                            <div class="col-6 form-group lead">
                                <label for="firstNameInput">First Name</label>
                                <input type="text" class="form-control" name="firstName" id="firstName1" placeholder="First Name">
                            </div>

                            <div class="col-6 form-group lead">
                                <label for="lastNameInput">Last Name</label>
                                <input type="text" class="form-control" name="lastName" id="lastName1" placeholder="Last Name">
                            </div>

                            <div class="col-12 form-group lead">
                                <label for="phone">Phone Number</label>
                                <input type="text" class="form-control" name="phone" id="phone1" placeholder="Phone Number">
                            </div>

                            <div class="col-12 form-group lead">
                                <label for="address">Street Address</label>
                                <textarea type="text" class="form-control" id="address1" name="address" placeholder="Street Address"></textarea>
                            </div>

                            <div class="col-7 form-group lead">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city1" name="city" placeholder="City">
                            </div>

                            <div class="col-5 form-group lead">
                                <label for="post">Post Code</label>
                                <input type="text" class="form-control" id="postCode1" name="post" placeholder="Post Code">
                            </div>

                            <div id ="prdCount"></div>
                            <div id ="prdTotal"></div>

                            <div id ="basket-confirm"></div>

                            <div class="col-12 text-right registerBtn">
                                <button type="submit" onclick="completeOrder()" class="btn btn-info btn-lg">Save</button>
                            </div>
                        </div>
                    </form>              
            </div>
        </div>
</div>


<script>

    //Global variables 
    let request = new XMLHttpRequest();
    console.log('request: ' + request);

    //Checks whether user is logged in.
    function checkLogin(){
        //Create event handler that specifies what should happen when server responds
        request.onload = function(){
            console.log('responseText - ' + request.responseText);
            if(request.responseText === "ok"){
            }
            else {
                window.location.replace("login.php");
            }
        };
        //Set up and send request
        request.open("GET", "check_login.php");
        request.send();
    }

    
</script>

 
<?php

outputFooter("Home");
?>