<?php
    require_once "config/db_config.php";

    $username = "";
    $password = "";
    $email = "";

    if($_SERVER["REQUEST_METHOD"] === "POST"){

    }
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
            Willy Wangky Choco Factory
        </header>
        <div class="spacer"></div>
        <div class="errorMessage">
            
        </div>
        <main>
            <form id="login" action="login.php">
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
                        <th>Password</th>
                    </tr>
                    <tr>
                        <td>
                            <input type="password" id="passwordField" name="passwordField" onkeyup="checkPassword()" >
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <button type="submit" form="login">
                                Login
                            </button>
                        </th>
                    </tr>
                </table>
            </form>
        </main>
        <div class="spacer"></div>
        <script>

        </script>    
    </body>
</html>