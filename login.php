<?php
    session_start();

    if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]){
        header("location: dashboard.php");
        exit;
    }

    require_once "config/db_config.php";

    $error_message = "";

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);

        $sql = "SELECT password_hash FROM users WHERE username = :username";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":username", $username);

        if($stmt->execute()){
            if($stmt->rowCount() === 1){
                $password_hash = $stmt->fetch(PDO::FETCH_OBJ)->password_hash;
                echo $password_hash;
                if(password_verify($password, $password_hash)){

                } else {

                }
            }
            else {

            }
        }
        else{

        }
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
            <?php echo $error_message ?>
        </div>
        <main>
            <form id="login" action="login.php" method="POST">
                <table>
                    <tr>
                        <th>Username</th>
                    </tr>
                    <tr>
                        <td>
                            <input id="usernameField" name="username" >
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
                            <input type="password" id="passwordField" name="password" >
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