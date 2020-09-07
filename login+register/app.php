<?php
    require_once "pdo.php";
    session_start();
?>
<html>
<head>
</head>
<body style="font-family: sans-serif;">
<h1>Cool Application</h1>
<?php 
    if ( isset($_SESSION["success"]) ) {
        echo('<p style="color:green">'.$_SESSION["success"]."</p>\n");
        unset($_SESSION["success"]);
    }  
 
    // Check if we are logged in!
    if ( ! isset($_SESSION["email"]) ) { ?>
        <p>Please <a href="register_page.php">Register</a> to start.</p>
        <p>Please <a href="login_page.php">Log In</a> to start.</p>
    <?php } else { ?>
        <?php if(! isset($_SESSION["phone"]) ) { ?>
                <p>DO YOU WANT TO SELL SOMETHING</p>
                <p>Please <a href="seller.php">SELL</a>something</p>
                <p>Please <a href="logout.php">Log Out</a> when you are done.</p>

        <?php } else { ?>
                <p>DO YOU WANT TO ADD A PRODUCT</p>
                <p>Please <a href="add_new_product.php">Add Product</a> to sell</p>
                <p>Please <a href="change.php">EDIT</a> if you to change something</p>
                <p>Please <a href="logout.php">Log Out</a> when you are done.</p>
        <?php } ?>
    <?php } ?>
</body>
</html>



