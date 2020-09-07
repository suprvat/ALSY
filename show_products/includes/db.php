<?php
include 'connection.php';
/*
        $query = "SELECT * FROM product_list";
        $result = mysqli_query($connect, $query);

        while ($row = mysqli_fetch_assoc($result)) {
          $price = $row['price'];
          $description = $row['description'];
            
*/
$limits = $_POST['limits'];
$cat_id = $_POST['cat_id'];

//$cat_id = 1;
$result = myquery($limits, $cat_id);
if ($result->rowCount() > 0) {   //start of if 

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
  $price = $row['price'];
  $description = $row['description'];
  $image1= $row['image1'];


?>


  <div class="col-md-6 col-lg-4">
    <div class="product-description">
      <img class="product-img" src="images/<?php echo $image1; ?>" alt="" width="330px">
      <div class="product-price">
        <h4>price: <?php echo $price; ?></h4>
      </div>
      <div class="prosuct-info">
        <p class="card-text"><?php echo $description; ?>
        </p>

      </div>
    </div>
  </div>



<?php


}  //end of while loop
}  //end of if
else
{
  echo ("<h1 style='color: green;'>Sorry No product to show till now..  😅 </h1>");

}
?>