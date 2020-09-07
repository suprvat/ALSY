<?php
require_once "pdo.php";
session_start();
if(isset($_POST['submit2']))
{



    if ( isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email'])
     && isset($_POST['password'])) {

    // Data validation
    if ( strlen($_POST['fname']) < 1 ){
        $_SESSION['error'] = 'Please enter first name';
        header("Location: register_page.php");
        return;
    }
    if ( strlen($_POST['lname']) < 1 ){
        $_SESSION['error'] = 'Please enter last name';
        header("Location: register_page.php");
        return;
    }
    if ( strlen($_POST['password']) < 1) {
        $_SESSION['error'] = 'Please enter password';
        header("Location: register_page.php");
        return;
    }
    if ( strlen($_POST['email']) < 1) {
        $_SESSION['error'] = 'Please enter email-id';
        header("Location: register_page.php");
        return;
    }

    if( strlen($_POST['password']) < 6){
        $_SESSION['error'] = 'Password must be atleast 6 characters';
        header("Location: register_page.php");
        return;
    }
    $sql_select = "SELECT email FROM user WHERE email=:email";
    $select_stmt = $pdo->prepare($sql_select);
    $select_stmt->execute(array(
        ':email' => $_POST['email']));
    $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
    if($row["email"] == $_POST['email']){
        $_SESSION['error'] = 'Email-Id already exist';
        header("Location: register_page.php");
        return;
    }
    $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt password using password_hash()
				

    $sql = "INSERT INTO user (first_name,last_name, email, pass)
              VALUES (:fname, :lname, :email, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':fname' => $_POST['fname'],
        ':lname' => $_POST['lname'],
        ':email' => $_POST['email'],
        ':password' => $new_password));
    $_SESSION['success'] = 'Record Added';
    header( 'Location: app.php' ) ;
    return;
}

// Flash pattern
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
}
?>



