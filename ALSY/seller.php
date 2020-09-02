<?php
require_once "pdo.php";
session_start();

if ( isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['room_number']) ) {

    // Data validation
    if ( strlen($_POST['phone']) < 1 ){
        $_SESSION['error'] = 'Please enter phone number';
        header("Location: seller.php");
        return;
    }

    if ( strlen($_POST['phone']) != 10 ){
        $_SESSION['error'] = 'Please enter valid phone number';
        header("Location: seller.php");
        return;
    }
    if ( strlen($_POST['address']) < 1 ){
        $_SESSION['error'] = 'Please enter hostel name';
        header("Location: seller.php");
        return;
    }
    $a = trim(stripslashes(htmlspecialchars($_POST['phone'])));
    if (!preg_match("/^[0-9 ]*$/",$a)) {
        $_SESSION['error'] = 'Only digits are allowed';
        header("Location: seller.php");
        return;
      }
      
    $b = trim(stripslashes(htmlspecialchars($_POST['address'])));
    if (!preg_match("/^[a-zA-Z-' ]*$/",$b)) {
        $_SESSION['error'] = 'Only letters and white space allowed';
        header("Location: seller.php");
        return;
      }

    $c = trim(stripslashes(htmlspecialchars($_POST['room_number'])));

    $sql_select = "SELECT phone FROM seller WHERE phone=:phone";
    $select_stmt = $pdo->prepare($sql_select);
    $select_stmt->execute(array(
        ':phone' => $_POST['phone']));
    $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
    if($row["phone"] == $_POST['phone']){
        $_SESSION['error'] = 'Phone number already exist';
        header("Location: seller.php");
        return;
    }			

    $sql_id = "SELECT user_id FROM user WHERE email=:email";
    $id_stmt = $pdo->prepare($sql_id);
    $id_stmt->execute(array(
      ':email' => $_SESSION['email']));
    $row_id=$id_stmt->fetch(PDO::FETCH_ASSOC);
    $id = $row_id['user_id'];


    $sql = "INSERT INTO seller (user_id,phone,address,room_number)
              VALUES (:id,:phone,:address,:room_number)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':id' => $id,
        ':phone' => $a,
        ':address' => $b,
        ':room_number' => $c));
    $_SESSION["phone"] = $_POST["phone"];
    $_SESSION['success'] = 'Information Added';
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
<p>Phone Number:
<input type="text" name="phone"></p>
<p>Hostel name:
<input type="text" name="address"></p>
<p>Room Number:
<input type="text" name="room_number"></p>
<p><input type="submit" value="Add Details"/>
<a href="app.php">Cancel</a></p>
</form>
