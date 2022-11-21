<!doctype html>
<html lang="en">
<!--Test Git -->

<head>
  <?php
  define('ACCESS', TRUE);
  include './user_include/restrict-admin.php';
  include './user_include/restrict-driver.php';
  include './user_include/links.php';
  ?>
  <script src="anime-master/lib/anime.min.js"></script>
  <script src="./assets/scripts/js/controller/home_controller.js"></script>
  <link rel="stylesheet" href="./assets/styles/home-user.css">
  <link rel="stylesheet" href="./assets/styles/default.css">
  <title>Gold Place PH</title>
  <style>
    .front-page h1 {
      font-size: 30px;
    }

    #main-image {
      max-width: 400px
    }

    .scroll-page {
      scroll-snap-align: start;
      scroll-margin-top: 50px;
      scroll-snap-stop: always;
    }

    @media (min-width: 768px) {
      .front-page h1 {
        font-size: 50px;
      }

      #main-image {
        max-width: 500px
      }

    }
  </style>
</head>

<body>
  <?php
  if (isset($_SESSION["userId"])) {
    include './user_include/header-user.php';
  } else {
    include './user_include/header.php';
  }
  ?>

  <main class="bg-light h-100 overflow-auto" style='scroll-snap-type: y mandatory; '>
    <!--
    <div class="row h-100 bg-white front-page">
      <div class="col-12 d-flex justify-content-center align-items-end">
        <img src="./assets/images/defaults/logo-only-hd.png" class="z-mid pe-4" style='display:none; margin-bottom: -500px' height="500" alt="" id='main-image'>
        <div class="ps-4" id='main-text' style='display:none; margin-bottom: -154px'>
          <h1 class="z-high fw-normal pb-3">Gold Place PH</h1>
          <h2 class="lt-space fw-light z-high text-center">ONLINE JEWELRY SHOP</h2>
          <h2 class="lt-space fw-light z-high text-center"></h2>
        </div>
      </div>
    </div>
-->
    <div class="row h-100 w-100 m-0 p-0 bg-white front-page scroll-page">
      <div class="col-12 d-flex flex-column flex-md-row justify-content-center align-items-center cont" style='display:none;'>
        <img src="./assets/images/defaults/logo-only-hd.png" class="z-mid px-4 pe-md-4 w-100" alt="" id='main-image'>
        <div class="ps-md-4 text-center mt-3 mt-md-0" id='main-text'>
          <h1 class="z-high fw-normal pb-md-3 pb-1">Gold Place PH</h1>
          <h5 class="lt-space fw-light z-high text-center">ONLINE JEWELRY SHOP</h5>
          <h2 class="lt-space fw-light z-high text-center"></h2>
        </div>
      </div>
    </div>

    <div id="myCarousel" class="carousel slide h-100 scroll-page overflow-hidden" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="bg-image" style="background-image: url(./assets/images/defaults/sample-image.png);"></div>
          <div class="container">
            <div class="carousel-caption text-start">
              <h1>Test headline.</h1>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. </p>
              <p><a class="btn btn-lg btn-warning" href="#">Sign up today</a></p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="bg-image" style="background-image: url(./assets/images/defaults/sample-image.png);"></div>
          <div class="container">
            <div class="carousel-caption">
              <h1>Another Test headline.</h1>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Tortor vitae purus faucibus ornare suspendisse.</p>
              <p><a class="btn btn-lg btn-warning" href="#">Learn more</a></p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="bg-image" style="background-image: url(./assets/images/defaults/sample-image.png);"></div>
          <div class="container">
            <div class="carousel-caption text-end">
              <h1>One more for good measure.</h1>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
              <p><a class="btn btn-lg btn-warning" href="#">Browse products</a></p>
            </div>
          </div>
        </div>
      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <!-- Marketing messaging and featurettes
        ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing bg scroll-page overflow-auto h-100 pt-5">

      <!-- Three columns of text below the carousel -->
      <div class="row pt-5">
        <div class="col-md-4">
          <img src="./assets/images/defaults/img1.jpg" alt="image">
          <h2 class="fw-normal">Necklace</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <p><a class="btn btn-outline-dark" href="#">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-md-4">
          <img src="./assets/images/defaults/img2.jpg" alt="image">
          <h2 class="fw-normal">Pendant</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <p><a class="btn btn-outline-dark" href="#">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-md-4">
          <img src="./assets/images/defaults/img3.jpg" alt="image">
          <h2 class="fw-normal">Ring</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
          <p><a class="btn btn-outline-dark" href="#">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->
      <div class="row ">
        <div class="col-md-4">
          <img src="./assets/images/defaults/img4.jpg" alt="image">
          <h2 class="fw-normal">Earring</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <p><a class="btn btn-outline-dark" href="#">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-md-4">
          <img src="./assets/images/defaults/img5.jpg" alt="image">
          <h2 class="fw-normal">Bracelet</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <p><a class="btn btn-outline-dark" href="#">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->

      <!-- START THE FEATURETTES -->
    </div>
    <div class="container marketing bg scroll-page overflow-auto h-100">

      <div class="row featurette pt-5">
        <div class="col-md-7">
          <h2 class="featurette-heading fw-normal lh-1">First featurette heading. <span class="text-muted">It’ll blow your mind.</span></h2>
          <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Malesuada nunc vel risus commodo viverra maecenas accumsan. Nisi porta lorem mollis aliquam ut porttitor.</p>
        </div>
        <div class="col-md-5">
          <img src="./assets/images/defaults/img1.jpg" alt="" class="bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7 order-md-2">
          <h2 class="featurette-heading fw-normal lh-1">Oh yeah, it’s that good. <span class="text-muted">See for yourself.</span></h2>
          <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Erat pellentesque adipiscing commodo elit at imperdiet dui.</p>
        </div>
        <div class="col-md-5 order-md-1">
          <img src="./assets/images/defaults/img2.jpg" alt="" class="bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading fw-normal lh-1">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
          <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Imperdiet proin fermentum leo vel orci porta non pulvinar. </p>
        </div>
        <div class="col-md-5">
          <img src="./assets/images/defaults/img3.jpg" alt="" class="bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500">
        </div>
      </div>

      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->

    </div><!-- /.container -->

    <!-- FOOTER -->
    <?php
    include './user_include/toast.php';
    include './user_include/csrf_token.php';
    include './user_include/footer.php';
    ?>
  </main>
</body>

</html>