<!doctype html>
<html lang="en">
<!--Test Git -->

<head>
  <?php
  define('ACCESS', TRUE);
  include './user_include/restrict-admin.php';
  include './user_include/links.php';
  ?>
  <link rel="stylesheet" href="./assets/styles/home-user.css">
  <link rel="stylesheet" href="./assets/styles/default.css">
  <title>Gold Place PH</title>

  <style>
    .front-page h1 {
      font-size: 70px;
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

  <main class="bg-light h-100 overflow-auto">
    <div class="row h-100 bg-white front-page">
      <div class="col-12 d-flex justify-content-center align-items-center">
        <img src="./assets/images/defaults/logo-only-hd.png" class="z-mid pe-4" height="500" alt="">
        <div class="ps-4">
          <h1 class="z-high fw-normal pb-3">Gold Place PH</h1>
          <h2 class="lt-space fw-light z-high text-center">ONLINE JEWELRY SHOP</h2>
          <h2 class="lt-space fw-light z-high text-center"></h2>
        </div>
      </div>
    </div>
    <div class="container-fluid pt-3 p-0">
      <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="bg-image" style="background-image: url(./assets/images/defaults/background3.jpg);"></div>
            <div class="container">
              <div class="carousel-caption text-start">
                <h1>Test headline.</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. </p>
                <p><a class="btn btn-lg btn-warning" href="#">Sign up today</a></p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="bg-image" style="background-image: url(./assets/images/defaults/background4.jpg);"></div>
            <div class="container">
              <div class="carousel-caption">
                <h1>Another Test headline.</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Tortor vitae purus faucibus ornare suspendisse.</p>
                <p><a class="btn btn-lg btn-warning" href="#">Learn more</a></p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="bg-image" style="background-image: url(./assets/images/defaults/background5.jpg);"></div>
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

      <div class="container marketing bg">

        <!-- Three columns of text below the carousel -->
        <div class="row">
          <div class="col-lg-4">
            <img src="./assets/images/defaults/img1.jpg" alt="image">
            <h2 class="fw-normal">Necklace</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <p><a class="btn btn-dark" href="#">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <img src="./assets/images/defaults/img2.jpg" alt="image">
            <h2 class="fw-normal">Pendant</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <p><a class="btn btn-dark" href="#">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <img src="./assets/images/defaults/img3.jpg" alt="image">
            <h2 class="fw-normal">Ring</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
            <p><a class="btn btn-dark" href="#">View details &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->

        <!-- START THE FEATURETTES -->

        <hr class="featurette-divider">

        <div class="row featurette">
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

      <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast log-toast" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header bg-warning">
            <img src="./assets/images/defaults/logo-only-black.png" height="30" class="rounded me-2" alt="...">
            <strong class="me-auto text-dark">Gold Place PH</strong>
            <button type="button" class="btn-close btn-close-black" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body text-capitalize">

          </div>
        </div>
      </div>
      <!-- FOOTER -->
      <?php
      include './user_include/footer.php';
      ?>
    </div>
  </main>
</body>

</html>