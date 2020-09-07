<?php include 'includes/connection.php'; ?>
<?php $cat_id = $_GET['cat_id']; ?>

<?php include 'includes/header.php'; ?>

<body>


  <!-- TOP NAVBAR -->

  <?php include 'includes/navbar.php'; ?>

  <!-- END OF TOP NAVBAR -->


  <!-- Page Content -->
  <div class="container" style="margin: 20px 10px 60px !important ;>


    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner" style="max-width:500px; max-height:300px !important;margin-left:300px;">
        <div class="carousel-item active">
          <img class="d-block w-100" src="images/img5.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="images/img6.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="images/img10.jpg" alt="Third slide">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>




  </div>


  <div class="container">

    <div id="show_product" class="row">

      <?php

      $result = myquery(6, $cat_id);
      if ($result->rowCount() > 0) {   //start of if 
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {    //start of while
          $price = $row['price'];
          $description = $row['description'];
          $image1 = $row['image2'];

      ?>


          <div class="col-md-6 col-lg-4">
            <div class="product-description">
              <a href=""><img class="product-img" src="images/<?php echo $image1; ?> " alt="" width="330px">
                <div class="product-price" style="color: red;">
                  <h4>price: <?php echo $price; ?></h4>
                </div>
                <div class="product-info">
                  <p class="card-text" style="color: red;"><?php echo $description; ?>
                  </p>

                </div>
              </a>
            </div>
          </div>



      <?php


        }  //end of while loop
      }  //end of if
      else {
        echo ("<h1 style='color: green;'>Sorry No product to show till now..  😅</h1>");
      }
      ?>


    </div>
  </div>


  <div style="margin: 20px;">
    <button id="show_more_btn" type="button" class="btn btn-primary">show more</button>

  </div>


  <!-- /.container -->

  <!-- Footer -->
  <?php include 'includes/footer.php'; ?>
  <!-- END OF FOOTER -->


  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/my_js/show_products.js"></script>
  <script>
    $(document).ready(function() {
      var limit = 6;
      var cat_id = '<?php echo $cat_id; ?>';

      $("#show_more_btn").on("click", function() {
        limit = limit + 3;
        $("#show_product").load('includes/db.php', {
          limits: limit,
          cat_id: cat_id
        });

      });
    });
  </script>








</body>

</html>
