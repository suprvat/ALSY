<?php
require_once "pdo.php";
    session_start();
    if ( isset($_POST["email"]) && isset($_POST["password"]) ) {
        unset($_SESSION["email"]);  // Logout current user

        if ( strlen($_POST['email']) < 1 || strlen($_POST['password']) < 1) {
            $_SESSION['error'] = 'Missing data';
            header("Location: login.php");
            return;
        }
    
        if ( strpos($_POST['email'],'@') === false ) {
            $_SESSION['error'] = 'Please enter a valid email address';
            header("Location: login.php");
            return;
        }

        if( strlen($_POST['password']) < 6){
            $_SESSION['error'] = 'Password must be atleast 6 characters';
            header("Location: login.php");
            return;
        }

        $sql = "SELECT * FROM user 
                WHERE email = :em ";

            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':em' => $_POST['email']));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ( $stmt->rowCount() > 0 ) {
                if(password_verify($_POST['password'], $row["pass"])){
                    $_SESSION["email"] = $_POST["email"];
                    $_SESSION["success"] = "Logged in.";
                    header( "Location: app.php" ) ;
                    return;
                }
                else{
                    $_SESSION["error"] = "Incorrect password.";
                    header( 'Location: login.php' ) ;
                    return;
                }
            }
            else{
                $_SESSION["error"] = "User not registered";
                header( 'Location: login.php' ) ;
                return;
            }
    }
?>
<html>
<head>
</head>
<body style="font-family: sans-serif;">
<h1>Please Log In</h1>
<?php
    if ( isset($_SESSION["error"]) ) {
        echo('<p style="color:red">'.$_SESSION["error"]."</p>\n");
        unset($_SESSION["error"]);
    }
?>
<form method="post">
<p>Email-Id: <input type="text" name="email" value=""></p>
<p>Password: <input type="password" name="password" value=""></p>
<p><input type="submit" value="Log In">
<a href="app.php">Cancel</a></p>
</form>
</body>
