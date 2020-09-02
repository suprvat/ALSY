<?php include 'includes/connection.php'; ?>
<?php include 'includes/header.php'; ?>



<body>


  <!-- TOP NAVBAR -->

  <?php include 'includes/navbar.php'; ?>

  <!-- END OF TOP NAVBAR -->


  <!-- Page Content -->
  <div class="container">

    <div class="row top-carousel">

      <!-- <div class="col-lg-3">

        <h1 class=" my-4">Shop Name</h1>
        <div class="list-group">
          <a href="#" class="list-group-item">Category 1</a>
          <a href="#" class="list-group-item">Category 2</a>
          <a href="#" class="list-group-item">Category 3</a>
        </div>

      </div> -->
      <!-- /.col-lg-3 -->





      <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <div class="carousel-item active">
            <img class="d-block img-fluid wide-img" src="images/img5.jpg" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block img-fluid wide-img" src="images/img6.jpg" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block img-fluid wide-img" src="images/img10.jpg" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only" ">Previous</span>
        </a>
        <a class=" carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
      </div>
    </div>




  </div>


  <div class="container">

    <div id="show_product" class="row">

      <?php

      $result = myquery(6);
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


    </div>
  </div>



  <button id="show_more_btn">show more</button>


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

      $("#show_more_btn").on("click", function() {

        limit = limit + 3;
        $("#show_product").load('db.php', {
          limits: limit
        });

      });
    });
  </script>









</body>

</html>