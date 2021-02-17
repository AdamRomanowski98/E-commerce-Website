<?php
    include ('common.php');
    outputHeader("Welcome at Middlesex Electronics!");
    outputBannerNavigation("Home");
?>

<!-- Account form -->
        <div class="registerContainer">
            <div class="col-12">
                <h1 class="changeDetH1">Change Account Details</h1>
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

                            <div class="col-6 form-group lead">
                                <label for="emailInput">E-mail Address</label>
                                <input type="email" class="form-control" name="email" id="email1" placeholder="E-mail" readonly>
                            </div>

                            <div class="col-6 form-group lead">
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


                            <div class="col-12 text-right registerBtn">
                                <button type="submit" onclick="update_customer()" class="btn btn-info btn-lg">Save</button>
                            </div>
                        </div>
                    </form>
                    
            </div>
        </div>
<script>
//Global variables 
    let request = new XMLHttpRequest();
    console.log('request: ' + request);

    //Check login when page loads
    window.onload = checkLogin;
    //Load customer data 
    window.onload = loadCustomer;

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

    

    function loadCustomer(){
        //Create event handler that specifies what should happen when server responds
        request.onload = function(){
        //Check HTTP status code
        if(request.status === 200){
            //Add data from server to page
            console.log('responseText - ' + request.responseText);
            displayCustomer(request.responseText);
        } 
        else
            alert("Error communicating with server: " + request.status);
        };

        //Set up request and send it
        request.open("GET", "customer.php");
        request.send();
    }



//Loads customer into page
function displayCustomer(jsonCustomer){
        //Convert JSON to array of product objects
        let custArray = JSON.parse(jsonCustomer)

        //Output customer data
        document.getElementById("firstName1").value = custArray.firstName;
        document.getElementById("lastName1").value = custArray.lastName;
        document.getElementById("phone1").value = custArray.phone;
        document.getElementById("email1").value = custArray.email;
        document.getElementById("address1").value = custArray.address;
        document.getElementById("city1").value = custArray.city;
        document.getElementById("postCode1").value = custArray.postCode;
        console.log(jsonCustomer);
    }


    //edit details 
    function update_customer(){

	request.onload = function(){
		
		if(request.status === 200){
			let responseData = request.responseText;
			alert(responseData);
		}else
			alert("Error communicating with server: " + request.status);
	};
	request.open("POST", "editCustomer.php");
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	
    let NewEmail = document.getElementById("email1").value;
	let NewName = document.getElementById("firstName1").value;
	let NewSurname = document.getElementById("lastName1").value;
	let NewPhone = document.getElementById("phone1").value;
	let NewAddress = document.getElementById("address1").value;
	let NewCity = document.getElementById("city1").value;
	let NewPostCode = document.getElementById("postCode1").value;
	
	request.send("NewNam=" + NewName + "&NewEm="+ NewEmail + "&NewSur=" + NewSurname + "&NewPh=" + NewPhone + "&NewAdd=" + NewAddress + "&NewCit=" + NewCity + "&NewPost=" + NewPostCode);
}

</script>


<?php
        outputFooter("Home");
?>
