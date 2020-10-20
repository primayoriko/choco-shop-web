<?php
    require_once "config/db_config.php";

    $username = "";
    $password = "";
    $email = "";

    $username_err = "";
    $email_err = "";
    $password_err = "";
    $confirm_pass_err = "";

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        if(empty(trim($username))){
            $username_err = "username must be filled!";
        } else {
            $sql = "SELECT id FROM users WHERE username = :username";
            $stm = $pdo->prepare($sql);

            $username_data = trim($_POST["username"]);
            $stm->bindParam(":username", $username_data);

            if($stm->execute()){
                if($stm->rowCount() === 1){
                    $username_err = "username already taken.";
                } else {
                    $username = $username_data;
                }
            } else {
                echo "Internal server error";
            }

            unset($stm);
        }

        if(empty(trim($_POST["password"]))){
            $password_err = "password should be filled";
        } else {
            $password = trim($_POST["password"]);
        }

        if(empty(trim($_POST["confirmPassword"]))){
            $confirm_pass_err = "please input confirmation of the password";
        }
        else if($_POST["password"] !== $_POST["corfirmPassword"]
            && empty($password_err)){
            $confirm_pass_err = "the inputted string not same";
        }

        // ADD EMAIL VALIDATION

        if(!empty($confirm_pass_err) || !empty($password_err) || 
            !empty($username_err) || !empty($email_err)){

            }
    } else {

    }

    // $page = file_get_contents('public/register.html');
    // echo $page;
    // require('public/register.html');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="static/styles/register.css" type="text/css">  
    </head>
    <body>
        <div class="spacer"></div>
        <header>
            Register
        </header>
        <div class="spacer"></div>
        <main>
            this is main
            <form id="register" action="register.php" method="POST" onsubmit="register()">
                <table>
                    <tr>
                        <th>Username</th>
                    </tr>
                    <tr>
                        <td>
                            <input id="usernameField" name="username" onkeyup="checkUsername()">
                        </td>
                    </tr>
                    <tr id="usernameErrorRow" style="display: none">
                        <td>
                            <p id="usernameError"> </p>
                        </td>
                    </tr>
                    <tr>
                        <th>Email</th>
                    </tr>
                    <tr>
                        <td> 
                            <input type="email" id="emailField" name="email" onkeyup="checkEmail()">
                        </td>
                    </tr>
                    <tr id="emailErrorRow" style="display: none">
                        <td>
                            <p id="emailError"> </p>
                        </td>
                    </tr>
                    <tr>
                        <th>Password</th>
                    </tr>
                    <tr>
                        <td>
                            <input type="password" id="passwordField" name="passwordField" onkeyup="checkPassword()" >
                        </td>
                    </tr>
                    <tr>
                        <th>Confirm Password</th>
                    </tr>
                    <tr>
                        <td>
                            <input type="password" id="confirmPasswordField" name="confirmPassword">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <button type="submit" form="register" value="Submit" onclick="return register()" >
                                Register!
                            </button>
                        </th>
                    </tr>
                </table>
            </form>
        </main>
        <div class="spacer"></div>
        <script>
            function checkUsername(){
                var usernameCheck;
                const username = document. getElementById("usernameField").value;

                if(window.XMLHttpRequest){
                    usernameCheck = new XMLHttpRequest();
                } else {
                    usernameCheck = new ActiveXObject("Microsoft.XMLHTTP");
                }

                usernameCheck.onreadystatechange = function() {
                    if(this.readyState === 4){
                        var responseBody = JSON.parse(this.responseText);
                        if (this.status == 200 && responseBody.message === "Available") {
                            document.getElementById("usernameField").style.borderColor = "green";
                            document.getElementById("usernameField").style.borderWidth = "3px";
                            document.getElementById("usernameErrorRow").style.display = "none";
                            document.getElementById("usernameError").innerHTML = " ";
                        } else {
                            document. getElementById("usernameField").style.borderColor = "red";
                            document.getElementById("usernameField").style.borderWidth = "3px";
                            document.getElementById("usernameErrorRow").style.display = "block";
                            document.getElementById("usernameError").innerHTML = responseBody.message;
                        }
                    }
                };

                usernameCheck.open("GET", `check_availability.php?username=${username}`, true);
                usernameCheck.send();
            }
            
            function checkEmail(){
                var emailCheck;
                const email = document.getElementById("emailField").value;

                if(window.XMLHttpRequest){
                    emailCheck = new XMLHttpRequest();
                } else {
                    emailCheck = new ActiveXObject("Microsoft.XMLHTTP");
                }

                emailCheck.onreadystatechange = function() {
                    if(this.readyState === 4){
                        var responseBody = JSON.parse(this.responseText);
                        if (this.status == 200 && responseBody.message === "Available") {
                            document.getElementById("emailField").style.borderColor = "green";
                            document.getElementById("emailField").style.borderWidth = "3px";
                            document.getElementById("emailErrorRow").style.display = "none";
                            document.getElementById("emailError").innerHTML = " ";
                            console.log();
                        } else {
                            document. getElementById("emailField").style.borderColor = "red";
                            document.getElementById("emailField").style.borderWidth = "3px";
                            document.getElementById("emailErrorRow").style.display = "block";
                            document.getElementById("emailError").innerHTML = responseBody.message;
                        }
                    }
                };

                emailCheck.open("GET", `check_availability.php?email=${email}`, true);
                emailCheck.send();
            }

            function checkPassword(){
                console.log(document.getElementById("emailField").value);
                console.log(document.getElementById("passwordField").value);
            }

            function test(){

            }

            function register(){
                var emailError = document.getElementById("emailError").innerHTML;
                var usernameError = document.getElementById("emailError").innerHTML;
                var samePass = document.getElementById("passwordField").value === 
                                document.getElementById("confirmPasswordField").value;
                if(usernameError !== " " || emailError !== " " || !samePass){
                    var error = "";
                    console.log(usernameError.innerHTML === " ");
                    console.log(typeof usernameError.innerHTML);
                    if(usernameError !== " "){
                        error += (usernameError + "\n");
                    }
                    if(emailError !== " "){
                        error += (usernameError + "\n");
                    }
                    if(!samePass){
                        error += "Password and Confirm Password not same\n"
                    }
                    alert("ERROR!\n" + error);
                    return false;
                }
                else{
                    document.getElementById("register").submit();
                    return true;
                }
            }
        </script>
    </body>
</html>
