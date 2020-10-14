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

        if(empty(trim($_POST["confirm_password"]))){
            $confirm_pass_err = "please input confirmation of the password";
        }
        else if($_POST["password"] !== $_POST["corfirm_password"]
            && empty($password_err)){
            $confirm_pass_err = "the inputted string not same";
        }

        // ADD EMAIL VALIDATION

        if(!empty($confirm_pass_err) || !empty($password_err) || 
            !empty($username_err) || !empty($email_err)){

            }
    } else {

    }

    readfile('public/register.html');
?>