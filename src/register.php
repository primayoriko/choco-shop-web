<?php
['connect_db' => $connect_db] = require 'utils/db_connect.php';

$error_message = "";
$success_message = "";
$show_error_message = "none";
$show_success_message = "none";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $password = trim($_POST["password"]);
        $email = trim($_POST["email"]);
        $username = trim($_POST["username"]);

        $email_regex = "/[a-zA-Z0-9_\-.]+@[a-zA-Z0-9\-]+.[a-zA-Z]+/";
        $username_regex = "/[a-zA-Z0-9_]+/";
        $password_regex = "/[a-zA-Z0-9_\-@!#]+/";
        // $password_regex = "/[a-zA-Z0-9_@!\$\-\+\.\*%\^#=]+/";

        $match_email = preg_match($email_regex, $email);
        $match_username = preg_match($username_regex, $username);
        $match_password = preg_match($password_regex, $password);

        if (
            strlen($username) > 0
            && strlen($email) > 0
            && strlen($password) > 0
            && $match_email
            && $match_username
            && $match_password
        ) {

            $hash_options = [
                'cost' => 10
            ];
            $password_hash = password_hash($password, PASSWORD_BCRYPT, $hash_options);
            $is_superuser = 0;

            $sql = "INSERT INTO users (username, email, password_hash, is_superuser)
                        VALUES (:username, :email, :password_hash, :is_superuser)";
            $pdo = $connect_db();

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password_hash", $password_hash);
            $stmt->bindParam(":is_superuser", $is_superuser);

            if ($stmt->execute()) {
                $success_message .= "User has been created successfully.\n";
                header("location: dashboard.php");
                exit;
            } else {
                // 
            }
        } else {
            if (strlen($username) == 0 || !$match_username) {
                $error_message .= "username contains error\n";
            }
            if (strlen($email) == 0 || !$match_email) {
                $error_message .= "email contains error\n";
            }
            if (strlen($password) == 0 || !$match_password) {
                $error_message .= "password contains error\n";
            }
        }
    } catch (PDOException $db_error) {
        // $error_message .= $db_error->getMessage() . "\n";
        $error_message .= "Internal server error\n";
    } catch (Exception $err) {
        // $error_message .= $err->getMessage() . "\n";
        $error_message .= "Internal server error\n";
    }


    if (!empty($error_message)) {
        $error_message = "Error(s) found:\n" . $error_message;
    }
}

// $page = file_get_contents('public/register.html');
// echo $page;
// require('public/register.html');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../public/css/logreg.css" type="text/css">
</head>

<body>
    <main>
        <div class="container">
            <div class="text-title large-title">
                Willy Wangky Choco Factory
            </div>
            <form id="register" action="register.php" method="POST" onsubmit="register()">
                <div class="text-content label">Username</div>
                <input class="text-input" id="usernameField" name="username" oninput="checkUsername()">
                <div class="text-content error" id="usernameError"></div>
                <div class="text-content label">Email</div>
                <input class="text-input" id="emailField" name="email" type="email" oninput="checkEmail()">
                <div class="text-content error" id="emailError"></div>
                <div class="text-content label">Password</div>
                <input class="text-input" id="passwordField" name="password" type="password" oninput="checkPassword()">
                <div class="text-content label">Confirm Password</div>
                <input class="text-input" id="confirmPasswordField" name="confirmPassword" type="password" oninput="checkPassword()">
                <div class="text-content error" id="passwordError"></div>
                <a href="/src/login.php"><button class="btn-secondary text-subtitle" type="button">Back to Login</button></a>
                <button class="btn-primary btn-submit text-subtitle" type="submit" form="register" value="Submit" onclick="return register()">Register!</button>
            </form>
        </div>
    </main>
    <script>
        function checkUsername() {
            var usernameCheck;
            const username = document.getElementById("usernameField").value;

            if (window.XMLHttpRequest) {
                usernameCheck = new XMLHttpRequest();
            } else {
                usernameCheck = new ActiveXObject("Microsoft.XMLHTTP");
            }

            usernameCheck.onreadystatechange = function() {
                if (this.readyState === 4) {
                    var responseBody = JSON.parse(this.responseText);
                    if (this.status == 200 && responseBody.message === "Available") {
                        document.getElementById("usernameField").style.borderColor = "green";
                        document.getElementById("usernameField").style.borderWidth = "3px";
                        document.getElementById("usernameError").innerHTML = "";
                    } else {
                        document.getElementById("usernameField").style.borderColor = "red";
                        document.getElementById("usernameField").style.borderWidth = "3px";
                        document.getElementById("usernameError").innerHTML = responseBody.message;
                    }
                }
            };

            usernameCheck.open("GET", `utils/check_availability.php?username=${username}`, true);
            usernameCheck.send();
        }

        function checkEmail() {
            var emailCheck;
            const email = document.getElementById("emailField").value;

            if (window.XMLHttpRequest) {
                emailCheck = new XMLHttpRequest();
            } else {
                emailCheck = new ActiveXObject("Microsoft.XMLHTTP");
            }

            emailCheck.onreadystatechange = function() {
                if (this.readyState === 4) {
                    var responseBody = JSON.parse(this.responseText);
                    if (this.status == 200 && responseBody.message === "Available") {
                        document.getElementById("emailField").style.borderColor = "green";
                        document.getElementById("emailField").style.borderWidth = "3px";
                        document.getElementById("emailError").innerHTML = "";
                    } else {
                        document.getElementById("emailField").style.borderColor = "red";
                        document.getElementById("emailField").style.borderWidth = "3px";
                        document.getElementById("emailError").innerHTML = responseBody.message;
                    }
                }
            };

            emailCheck.open("GET", `utils/check_availability.php?email=${email}`, true);
            emailCheck.send();
        }

        function checkPassword(){
            var password = document.getElementById("passwordField").value;
            var confirmPassword = document.getElementById("confirmPasswordField").value;

            if(password === confirmPassword){
                document.getElementById("passwordField").style.borderColor = "green";
                document.getElementById("passwordField").style.borderWidth = "3px";
                document.getElementById("confirmPasswordField").style.borderColor = "green";
                document.getElementById("confirmPasswordField").style.borderWidth = "3px";
                document.getElementById("passwordError").innerHTML = "";
            }
            else{
                document. getElementById("passwordField").style.borderColor = "red";
                document.getElementById("passwordField").style.borderWidth = "3px";
                document. getElementById("confirmPasswordField").style.borderColor = "red";
                document.getElementById("confirmPasswordField").style.borderWidth = "3px";
                document.getElementById("passwordError").innerHTML = "Password and confirm password not same!";
            }
        }

        function register(){
            var emailError = document.getElementById("emailError").innerHTML;
            var usernameError = document.getElementById("usernameError").innerHTML;
            var passwordError = document.getElementById("passwordError").innerHTML;
            if(usernameError !== "" || emailError !== "" || passwordError !== ""){
                var error = "";
                // console.log(usernameError.innerHTML === " ");
                // console.log(typeof usernameError.innerHTML);
                if(usernameError !== ""){
                    error += (usernameError + "\n");
                }
                if(emailError !== ""){
                    error += (emailError + "\n");
                }
                if(passwordError !== ""){
                    error += (passwordError + "\n");
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
