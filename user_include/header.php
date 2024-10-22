<?php
if (!defined('ACCESS')) {
  header("location: ../");
}
?>
<script type="text/javascript" src="./assets/scripts/js/controller/cart_controller.js"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm" aria-label="Fourth navbar example">
  <div class="container-xxl">

    <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#oc-menu" aria-controls="oc-menu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <a class="navbar-brand p-0 pe-3 m-0 d-none d-lg-block" href="#">
      <img height="40" src="./assets/images/defaults/logo-only.png" alt="Logo">
    </a>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="oc-menu" aria-labelledby="oc-menu-Label">
      <div class="offcanvas-header shadow-sm">
        <h5 class="offcanvas-title" id="oc-menu-Label">Gold Place PH</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link fs-7 home" aria-current="page" href="./">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-7 products" aria-current="page" href="./products.php">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-7 about" aria-current="page" href="./about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-7 contact" aria-current="page" href="./contact.php">Contact us</a>
          </li>

        </ul>
      </div>
    </div>

    <div class="text-start remove-button d-flex justify-content-end">
      <a class="btn btn-sm btn-dark me-2 px-3" href="./login.php">Login</a>
      <a class="btn btn-sm btn-warning gold-bg-2 fw-light px-3" href="./register.php">Sign-up</a>
    </div>

  </div>
</nav>
<?php
if (isset($_SESSION['menu'])) {
  $menu = $_SESSION['menu'];
?>
  <script>
    let menu = '<?php echo $menu; ?>';
    if (menu == 'home') {
      $('.home').addClass('active');
    } else if (menu == 'products') {
      $('.products').addClass('active');
    } else if (menu == 'about') {
      $('.about').addClass('active');
    } else if (menu == 'contact') {
      $('.contact').addClass('active');
    }
  </script>
<?php
}
?>