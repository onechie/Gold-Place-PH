<!doctype html>
<html lang="en">
<!--Test Git -->

<head>
  <?php
  define('ACCESS', TRUE);
  include './user_include/restrict-admin.php';
  include './user_include/restrict-system-admin.php';
  include './user_include/restrict-driver.php';
  include './user_include/links.php';
  $_SESSION['menu'] = 'home';
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
          <div class="bg-image" style="background-image: url(./assets/images/defaults/sample-image2.png);"></div>
          <div class="container">
            <div class="carousel-caption text-start">
              <h1>Order now</h1>
              <p>Have you found a fit accessory for you? Sign up, add to cart, and place an order for your desired product!</p>
              <p><a class="btn btn-lg btn-warning" href="./register.php">Sign up today</a></p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="bg-image" style="background-image: url(./assets/images/defaults/sample-image2.png);"></div>
          <div class="container">
            <div class="carousel-caption">
              <h1>Online Jewelry Shop</h1>
              <p>est. 2020. Trusted seller of 18k saudi gold jewelry!</p>
              <p><a class="btn btn-lg btn-warning" href="./about.php">Learn more</a></p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="bg-image" style="background-image: url(./assets/images/defaults/sample-image2.png);"></div>
          <div class="container">
            <div class="carousel-caption text-end">
              <h1>Looking for something?</h1>
              <p>Are you looking for jewelry that suits for you? check out our products now!</p>
              <p><a class="btn btn-lg btn-warning" href="./products.php">Browse products</a></p>
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

    <div class="container py-5 scroll-page h-100 overflow-auto">
      <div class="p-5 mb-4 bg-white rounded-3">
        <div class="container-fluid py-5">
          <h1 class="display-5 fw-bold">Rings & Bracelet</h1>
          <p class="col-md-8 fs-4">Charming and delicate accessories are available here for your different kinds of desired designs</p>
          <a class="btn btn-warning btn-lg" type="button" href="./products.php">Check now</a>
        </div>
      </div>

      <div class="row align-items-md-stretch">
        <div class="col-md-6">
          <div class="h-100 p-5 text-bg-dark rounded-3">
            <h2>Necklace & Pendant</h2>
            <p>Check out here some of the most lustrous and elegant styles of necklaces and pendants for classier looks. Timeless designs</p>
            <a class="btn btn-outline-light" type="button" href="./products.php">just for you</a>
          </div>
        </div>
        <div class="col-md-6">
          <div class="h-100 p-5 bg-light border rounded-3">
            <h2>Earring</h2>
            <p>Stunning and delightful gleam of affordable earrings are available for a more exclusive and courtly fashionable look</p>
            <a class="btn btn-outline-secondary" type="button" href="./products.php">More</a>
          </div>
        </div>
      </div>

    </div>

    <!-- Marketing messaging and featurettes
        ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->
    <!--
    <div class="container marketing bg scroll-page overflow-auto h-100 pt-5">


      <div class="row pt-5">
        <div class="col-md-4">
          <img src="./assets/images/defaults/img1.jpg" alt="image">
          <h2 class="fw-normal">Necklace</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <p><a class="btn btn-outline-dark" href="#">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">
          <img src="./assets/images/defaults/img2.jpg" alt="image">
          <h2 class="fw-normal">Pendant</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <p><a class="btn btn-outline-dark" href="#">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">
          <img src="./assets/images/defaults/img3.jpg" alt="image">
          <h2 class="fw-normal">Ring</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
          <p><a class="btn btn-outline-dark" href="#">View details &raquo;</a></p>
        </div>
      </div>
      <div class="row ">
        <div class="col-md-4">
          <img src="./assets/images/defaults/img4.jpg" alt="image">
          <h2 class="fw-normal">Earring</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <p><a class="btn btn-outline-dark" href="#">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">
          <img src="./assets/images/defaults/img5.jpg" alt="image">
          <h2 class="fw-normal">Bracelet</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
          <p><a class="btn btn-outline-dark" href="#">View details &raquo;</a></p>
        </div>
      </div>

    </div>
-->
    <div class="container marketing bg scroll-page overflow-auto h-100">
      <hr class="featurette-divider">
      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading fw-normal lh-1">Simple <span class="text-muted">is elegant.</span></h2>
          <p class="lead">Simplicity is the best beauty so try and keep it as simple as possible. Big accessories are best worn with simple clothes. Steer clear of busy patterns and embellishments when wearing a bold jewelry. A bold dress pattern goes best with simple accessories and vice-versa. Remember, you want your costume jewelry to stand out and to grab attention, so match it wisely.</p>
        </div>
        <div class="col-md-5">
          <img src="./assets/images/defaults/img1.jpg" alt="" class="bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7 order-md-2">
          <h2 class="featurette-heading fw-normal lh-1">True beauty <span class="text-muted">engraved in our jewelry.</span></h2>
          <p class="lead">Jewellery has an unquestionable ability to bring out the best in a woman's features and personality when the right piece is worn by the right individual to the right occasion. It is important for women as it can make them feel beautiful, stylish, special, and confident. It ultimately plays a big role in making a woman feel good about herself, which is why it's so valuable to many women.</p>
        </div>
        <div class="col-md-5 order-md-1">
          <img src="./assets/images/defaults/img2.jpg" alt="" class="bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading fw-normal lh-1">Trendy designs <span class="text-muted">that adds glow to your appearance</span></h2>
          <p class="lead">Jewellery is very valuable to women and it's importance in their lives today is not hard to understand given the fact that it has been worn by humans for centuries. It's popularity only increases as time progresses as new styles and designs enter the marketplace. Attending special occasions, such as weddings, graduations, award ceremonies, birthday parties, and anniversary dinners, without wearing jewellery is not an option for the majority of women. They would feel dull and under-dressed without some pieces of jewellery to adorn themselves.</p>
        </div>
        <div class="col-md-5">
          <img src="./assets/images/defaults/img3.jpg" alt="" class="bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500">
        </div>
      </div>

      <hr class="featurette-divider">

    </div>

    <?php
    include './user_include/toast.php';
    include './user_include/csrf_token.php';
    include './user_include/footer.php';
    ?>
  </main>
</body>

</html>