<?php
    include ('common.php');
    outputHeader("Welcome at Middlesex Electronics!");
    outputBannerNavigation("Home");
?>

<div class="loginbox">
        <form id="LoginPara">
            <p>Email</p>
            <input type="text" placeholder="Enter email" id="email">
            <p>Password</p>
            <input type="password" placeholder="Enter Password" id="password">
            <button class="loginButton" onclick="login()">Submit</button>
            <a href="myAccount.php">Create account</a>
            <p style="color: red" id="ErrorMessages"></p>
        </form>    
</div>


<script>
            //Global variables 
            let loggedInStr = "<div class='log'>Logged in </div><button class='logOutButton' onclick='logout()'>Logout</button><a href='viewDetails.php'>View details</a><a href='checkOrders.php'>View Orders</a>";
            let loginStr = document.getElementById("LoginPara").innerHTML;
            let request = new XMLHttpRequest();
            
            //Check login when page loads
            window.onload = checkLogin;
            
            //Checks whether user is logged in.
            function checkLogin(){
                //Create event handler that specifies what should happen when server responds
                request.onload = function(){
                    if(request.responseText === "ok"){
                        document.getElementById("LoginPara").innerHTML = loggedInStr;
                    }
                    else{
                        console.log(request.responseText);
                        document.getElementById("LoginPara").innerHTML  = loginStr;
                    }
                };
                //Set up and send request
                request.open("GET", "check_login.php");
                request.send();
            }
            
            //Attempts to log in user to server
            function login(){
                //Create event handler that specifies what should happen when server responds
                request.onload = function(){
                    //Check HTTP status code
                    if(request.status === 200){
                        //Get data from server
                        var responseData = request.responseText;

                        //Add data to page
                        if(responseData === "ok"){
                            document.getElementById("LoginPara").innerHTML = loggedInStr;
                        
                        }
                        else
                            alert("Incorrect details. Try again");
                    }
                    else
                        document.getElementById("ErrorMessages").innerHTML = "Error communicating with server";
                };

                //Extract login data
                let usrEmail = document.getElementById("email").value;
                let usrPassword = document.getElementById("password").value;
                
                //Set up and send request
                request.open("POST", "customer_login.php");
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send("email=" + usrEmail + "&password=" + usrPassword);
            }
            
            //Logs the user out.
            function logout(){
                //Create event handler that specifies what should happen when server responds
                request.onload = function(){
                    checkLogin();
                };
                //Set up and send request
                request.open("GET", "logout.php");
                request.send();
            }
            
        </script>

    


<?php
        outputFooter("Home");
?>