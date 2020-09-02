<?php
require_once "pdo.php";
session_start();

if ( isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email'])
     && isset($_POST['password'])) {

    // Data validation
    if ( strlen($_POST['fname']) < 1 ){
        $_SESSION['error'] = 'Please enter first name';
        header("Location: registration.php");
        return;
    }
    if ( strlen($_POST['lname']) < 1 ){
        $_SESSION['error'] = 'Please enter last name';
        header("Location: registration.php");
        return;
    }
    if ( strlen($_POST['password']) < 1) {
        $_SESSION['error'] = 'Please enter password';
        header("Location: registration.php");
        return;
    }
    if ( strlen($_POST['email']) < 1) {
        $_SESSION['error'] = 'Please enter email-id';
        header("Location: registration.php");
        return;
    }

    if ( strpos($_POST['email'],'@') === false ) {
        $_SESSION['error'] = 'Enter a valid emaid-id';
        header("Location: registration.php");
        return;
    }
    if( strlen($_POST['password']) < 6){
        $_SESSION['error'] = 'Password must be atleast 6 characters';
        header("Location: registration.php");
        return;
    }
    $a = trim(stripslashes(htmlspecialchars($_POST['fname'])));
    if (!preg_match("/^[a-zA-Z-' ]*$/",$a)) {
        $_SESSION['error'] = 'Only letters and white space allowed';
        header("Location: registration.php");
        return;
      }

    $b = trim(stripslashes(htmlspecialchars($_POST['lname'])));
    if (!preg_match("/^[a-zA-Z-' ]*$/",$b)) {
        $_SESSION['error'] = 'Only letters and white space allowed';
        header("Location: registration.php");
        return;
      }

    $c = trim(stripslashes(htmlspecialchars($_POST['email'])));

    /* function test_input($data) {
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
         return $data;
       }*/
    $sql_select = "SELECT email FROM user WHERE email=:email";
    $select_stmt = $pdo->prepare($sql_select);
    $select_stmt->execute(array(
        ':email' => $_POST['email']));
    $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
    if($row["email"] == $_POST['email']){
        $_SESSION['error'] = 'Email-Id already exist';
        header("Location: registration.php");
        return;
    }
    $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt password using password_hash()
				

    $sql = "INSERT INTO user (first_name,last_name, email, pass)
              VALUES (:fname, :lname, :email, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':fname' => $a,
        ':lname' => $b,
        ':email' => $c,
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
?>
<p>Add A New User</p>
<form method="post">
<p>First-Name:
<input type="text" name="fname"></p>
<p>Last-Name:
<input type="text" name="lname"></p>
<p>Email:
<input type="text" name="email"></p>
<p>Password:
<input type="password" name="password"></p>
<p><input type="submit" value="Add New"/>
<a href="app.php">Cancel</a></p>
</form>
