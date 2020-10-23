<?php
    ini_set('session.gc_maxlifetime', 1800); // Cookie time 10 sec
    ini_set('session.cookie_lifetime', 1800); 
    session_start();

    if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]){
        header("location: dashboard.php");
        exit;
    }

    require_once "utils/db_connect.php";

    $error_message = "";

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);

        $sql = "SELECT * FROM users WHERE username = :username";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":username", $username);

        if($stmt->execute()){
            if($stmt->rowCount() === 1){
                $user = $stmt->fetch(PDO::FETCH_OBJ);
                // echo $password_hash;
                if(password_verify($password, $user->password_hash)){
                    ini_set('session.gc_maxlifetime', 1800);
                    ini_set('session.cookie_lifetime', 1800); 
                    session_start();

                    $_SESSION["username"] = $username;
                    $_SESSION["isSuperuser"] = $user->is_superuser;
                    $_SESSION["loggedIn"] = true;

                    header("location: dashboard.php");
                } 
                else {
                    $error_message = "Between username or password is wrong/not exist asdas\n";
                }
            }
            else {
                $error_message = "Between username or password is wrong/not exist\n";
            }
        }
        else{
            $error_message = "Internal server error\n";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="../public/css/register.css" type="text/css">
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