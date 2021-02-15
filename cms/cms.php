<?php
    include ('../common.php');
	outputHeader("CMS Login");  
	outputBannerNavigation("Home");
?>


<!--- cms login --->
<div class="cms-login">
	<div class="cms-container">
		

		<form id="LoginPara">
            <h1> Enter admin details to access CMS! </h1>
            <p>Email</p>
            <input type="text" placeholder="Enter login" id="login">
            <p>Password</p>
            <input type="password" placeholder="Enter Password" id="password">
            <button class="loginButton" onclick="loginFunction()">Submit</button>
            <p style="color: red" id="ErrorMessages"></p>
        </form>   
	</div>
</div>
<script>
            //Global variables 
            let loggedInStr = "<div class='log'><a href='cms-panel.php'>CMS PANEL</a> </div><button class='logOutButton' onclick='logout()'>Logout</button>";
            let loginStr = document.getElementById("LoginPara").innerHTML;
            let request = new XMLHttpRequest();
            
            //Check login when page loads
            window.onload = checkLogin;
            
            //Checks whether admin is logged in.
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
            
            //Attempts to log in admin to server
            function loginFunction(){
                //Create event handler that specifies what should happen when server responds
                request.onload = function(){
                    //Check HTTP status code
                    if(request.status === 200){
                        //Get data from server
                        var responseData = request.responseText;

                        //Add data to page
                        if(responseData === "ok"){
                            document.getElementById("LoginPara").innerHTML = loggedInStr;
                            document.getElementById("ErrorMessages").innerHTML = "";//Clear error messages
                        }
                        else
                            document.getElementById("ErrorMessages").innerHTML = request.responseText;
                    }
                    else
                        document.getElementById("ErrorMessages").innerHTML = "Error communicating with server";
                };

                //Extract login data
                let admLogin = document.getElementById("login").value;
                let admPassword = document.getElementById("password").value;
                
                //Set up and send request
                request.open("POST", "admin_login.php");
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send("login=" + admLogin + "&password=" + admPassword);
            }
            
            //Logs the admin out.
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
        outputFooterCMS();
?>
