<?php
require_once "pdo.php";
session_start();

if ( isset($_POST['category']) && isset($_POST['pname']) && isset($_POST['price']) && isset($_POST['purchase']) 
    && isset($_POST['brand']) && isset($_POST['description']) && isset($_POST['image'])){

    // Data validation
    if ( strlen($_POST['pname']) < 1 ){
        $_SESSION['error'] = 'Please enter product name';
        header("Location: add_new_product.php");
        return;
    }
    if ( strlen($_POST['pname']) > 50 ){
        $_SESSION['error'] = 'Product name should not exceed 50 char';
        header("Location: add_new_product.php");
        return;
    }
    if ( strlen($_POST['price']) < 1 ){
        $_SESSION['error'] = 'Please enter price';
        header("Location: add_new_product.php");
        return;
    }
    if ( strlen($_POST['description']) < 1) {
        $_SESSION['error'] = 'Please enter description';
        header("Location: add_new_product.php");
        return;
    }
    // if ( strlen($_POST['image']) < 1) {
    //     $_SESSION['error'] = 'Please enter atleast one image';
    //     header("Location: add_new_product.php");
    //     return;
    // }

    $sql_id = "SELECT seller_id FROM seller WHERE phone=:phone";
    $id_stmt = $pdo->prepare($sql_id);
    $id_stmt->execute(array(
      ':phone' => $_SESSION['phone']));
    $row_id=$id_stmt->fetch(PDO::FETCH_ASSOC);
    $s_id = $row_id['seller_id'];

    $sql_cid = "SELECT category_id FROM category WHERE category_name=:cname";
    $cid_stmt = $pdo->prepare($sql_cid);
    $cid_stmt->execute(array(
      ':cname' => $_POST['category']));
    $row_cid=$cid_stmt->fetch(PDO::FETCH_ASSOC);
    $cid = $row_cid['category_id'];

    $sql = "INSERT INTO product (seller_id,category_id,product_name,price,purchase_year,description,brand,image)
              VALUES (:s_id, :c_id, :pname, :price, :pyear, :d, :brand, :img)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':s_id' => $s_id,
        ':c_id' => $cid,
        ':pname' => $_POST['pname'],
        ':price' => $_POST['price'],
        ':pyear' => $_POST['purchase'],
        ':d' => $_POST['description'],
        ':brand' => $_POST['brand'],
        ':img' => $_POST['image']));
    $_SESSION['success'] = 'Product Added';
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
<p>Category:
<select name="category" id="">
    <option value="">CLOTHING AND ACCESSORIES</option>
    <option value="">BOOKS</option>
    <option value="">ELECTRONICS</option>
    <option value="">ROOM STUFF</option>
    <option value="">WASHROOM STUFF</option>
    <option value="">CYCLE</option>
    <option value="">MOBILE AND TABLETS</option>
    <option value="">OTHER</option>

</select></p>
<p>Product Name:
<input type="text" name="pname"></p>
<p>Price:
<input type="text" name="price"></p>
<p>Purchase Year:
<input type="text" name="purchase"></p>
<p>Brand:
<input type="text" name="brand"></p>
Description: <br />
				<p><textarea id="productDescription" class="form-control" required name="description" cols=150 rows=20><?php echo $description; ?></textarea>				
				<p>Image: <input type="file" name="image" required /><br />
				Max image size should be less than 5 MB.<br /></p>
<p><input type="submit" value="Upload"/>
<a href="app.php">Cancel</a></p>
</form>
