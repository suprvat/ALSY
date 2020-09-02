<?php
include 'includes/connection.php';
/*
        $query = "SELECT * FROM product_list";
        $result = mysqli_query($connect, $query);

        while ($row = mysqli_fetch_assoc($result)) {
          $price = $row['price'];
          $description = $row['description'];
            
*/
$limits = $_POST['limits'];
$result = myquery($limits);
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
  $price = $row['price'];
  $description = $row['description'];

?>


  <div class="col-md-6 col-lg-4">
    <div class="product-description">
      <img class="product-img" src="images/img3.jpg" alt="">
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

?>