<?php
require_once "pdo.php";
session_start();

if( isset($_POST["submit1"])){

    $v11=rand(1111,9999);
    $v12=rand(1111,9999);
    $v13=$v11.$v12;
    $v13=md5($v13);
    
    $fnm1=basename($_FILES['image1']['name']);
    $destination1="imgs/".$v13.$fnm1;
    $temp1="imgs/".$v13.$fnm1;
    $img1_type = strtolower(pathinfo($destination1,PATHINFO_EXTENSION));
    $img1_size = getimagesize($_FILES["image1"]["tmp_name"]);
  
    //image 1 validation
    if($img1_size === false) {
      $_SESSION['error'] = 'File is not an image';
      header("Location: add_new_product.php");
      return;
    }

    if (file_exists($destination1)) {
      $_SESSION['error'] = 'Sorry! File already exist';
      header("Location: add_new_product.php");
      return;
    }

    if ($_FILES["image1"]["size"] > 500000) {
      $_SESSION['error'] = 'Sorry, your file is too lagre';
      header("Location: add_new_product.php");
      return;
    }
    
    if($img1_type != "jpg" && $img1_type != "png" && $img1_type != "jpeg"
    && $img1_type != "gif" ) {
      $_SESSION['error'] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
      header("Location: add_new_product.php");
      return;
    }
    if( ! (move_uploaded_file($_FILES['image1']['tmp_name'],$destination1)) ){
      $_SESSION['error'] = 'Sorry, there was a problem uploading your file.';
      header("Location: add_new_product.php");
      return;
    }

    //image 2
    $target = $target . $final_name;
    $v21=rand(1111,9999);
    $v22=rand(1111,9999);
    $v23=$v21.$v22;
    $v23=md5($v23);

    $fnm2=basename($_FILES['image2']['name']);
    $destination2="imgs/".$v23.$fnm2;
    $temp2="imgs/".$v23.$fnm2;
    $img2_type = strtolower(pathinfo($destination2,PATHINFO_EXTENSION));
    $img2_size = getimagesize($_FILES["image2"]["tmp_name"]);

    //image 2 validation
    if($img2_size === false) {
      $_SESSION['error'] = 'File is not an image';
      header("Location: add_new_product.php");
      return;
    }

    if (file_exists($destination2)) {
      $_SESSION['error'] = 'Sorry! File already exist';
      header("Location: add_new_product.php");
      return;
    }

    if ($_FILES["image2"]["size"] > 500000) {
      $_SESSION['error'] = 'Sorry, your file is too lagre';
      header("Location: add_new_product.php");
      return;
    }
    
    if($img2_type != "jpg" && $img2_type != "png" && $img2_type != "jpeg"
    && $img2_type != "gif" ) {
      $_SESSION['error'] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
      header("Location: add_new_product.php");
      return;
    }
    if( ! (move_uploaded_file($_FILES['image2']['tmp_name'],$destination2)) ){
      $_SESSION['error'] = 'Sorry, there was a problem uploading your file.';
      header("Location: add_new_product.php");
      return;
    }

    //image 3
    $v31=rand(1111,9999);
    $v32=rand(1111,9999);
    $v33=$v31.$v32;
    $v33=md5($v33);

    $fnm3=basename($_FILES['image3']['name']);
    $destination3="imgs/".$v33.$fnm3;
    $temp3="imgs/".$v33.$fnm3;
    $img3_type = strtolower(pathinfo($destination3,PATHINFO_EXTENSION));
    $img3_size = getimagesize($_FILES["image3"]["tmp_name"]);
  
    //image 3 validation
    if($img3_size === false) {
      $_SESSION['error'] = 'File is not an image';
      header("Location: add_new_product.php");
      return;
    }

    if (file_exists($destination3)) {
      $_SESSION['error'] = 'Sorry! File already exist';
      header("Location: add_new_product.php");
      return;
    }

    if ($_FILES["image3"]["size"] > 500000) {
      $_SESSION['error'] = 'Sorry, your file is too lagre';
      header("Location: add_new_product.php");
      return;
    }
    
    if($img3_type != "jpg" && $img3_type != "png" && $img3_type != "jpeg"
    && $img3_type != "gif" ) {
      $_SESSION['error'] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
      header("Location: add_new_product.php");
      return;
    }
    if( ! (move_uploaded_file($_FILES['image3']['tmp_name'],$destination3)) ){
      $_SESSION['error'] = 'Sorry, there was a problem uploading your file.';
      header("Location: add_new_product.php");
      return;
    }

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
    $a = trim(stripslashes(htmlspecialchars($_POST['price'])));
    if (!preg_match("/^[0-9 ]*$/",$a)) {
        $_SESSION['error'] = 'Only digits are allowed';
        header("Location: add_new_product.php");
        return;
      }
      
    $b = trim(stripslashes(htmlspecialchars($_POST['pname'])));
    if (!preg_match("/^[a-zA-Z-' ]*$/",$b)) {
        $_SESSION['error'] = 'Only letters and white space allowed';
        header("Location: add_new_product.php");
        return;
      }


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

    $sql = "INSERT INTO product (seller_id,category_id,product_name,price,purchase_year,description,brand,image1,image2,image3)
              VALUES (:s_id, :c_id, :pname, :price, :pyear, :d, :brand, :img1, :img2, :img3)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':img1',$temp1); 
    $stmt->bindParam(':img2',$temp2); 
    $stmt->bindParam(':img3',$temp3); 
    $stmt->execute(array(
        ':s_id' => $s_id,
        ':c_id' => $cid,
        ':pname' => $b,
        ':price' => $a,
        ':pyear' => $_POST['purchase'],
        ':d' => $_POST['description'],
        ':brand' => $_POST['brand'],
        ':img1' => $temp1,
        ':img2' => $temp2,
        ':img3' => $temp3));
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
<form method="post" action="add_new_product.php" enctype="multipart/form-data">
<p>Category:
<select name="category" id="">
    <option value="CLOTHING AND ACCESSORIES">CLOTHING AND ACCESSORIES</option>
    <option value="BOOKS">BOOKS</option>
    <option value="ELECTRONICS">ELECTRONICS</option>
    <option value="ROOM STUFF">ROOM STUFF</option>
    <option value="WASHROOM STUFF">WASHROOM STUFF</option>
    <option value="CYCLE">CYCLE</option>
    <option value="MOBILE AND TABLETS">MOBILE AND TABLETS</option>
    <option value="OTHER">OTHER</option>
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
				<p>Image1: <input type="file" name="image1" required /><br />
				<p>Image2: <input type="file" name="image2" required /><br />
				<p>Image3: <input type="file" name="image3" required /><br />
                
				Max image size should be less than 5 MB.<br /></p>
<p><input type="submit" name="submit1" value="Upload"/>
<a href="app.php">Cancel</a></p>
</form>




</body>
</html>
