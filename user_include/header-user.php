<?php
$userid = $_SESSION['userId'];

if (!defined('ACCESS')) {
  header("location: ../");
}


?>
<script type="text/javascript" src="./assets/scripts/js/controller/cart_controller.js"></script>
<script type="text/javascript" src="./assets/scripts/js/controller/order_controller.js"></script>
<script type="text/javascript" src="./assets/scripts/js/controller/profile_controller.js"></script>
<script type="text/javascript" src="./assets/scripts/js/controller/logout_controller.js"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm py-2" aria-label="Fourth navbar example">
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
            <a class="nav-link active fs-7" aria-current="page" href="./">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-7" aria-current="page" href="./products.php">Items</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-7" aria-current="page" href="#">Contact us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-7" aria-current="page" href="#">About</a>
          </li>
        </ul>
      </div>
    </div>


    <div class="dropdown text-start p-0">
      <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="./assets/images/defaults/default-profile.png" id="profile-icon" alt="profile" width="32" height="32" class="rounded-circle">
      </a>
      <ul class="dropdown-menu shadow-sm dropdown-menu-end p-0 m-0 border-0 overflow-hidden my-2">
        <li><button class="dropdown-item text-start fs-7 fw-light" id="cart-button" type="button" data-bs-toggle="modal" data-bs-target="#cart"><i class="bi bi-bag fs-5"></i> Cart</button></li>
        <li><button class="dropdown-item text-start fs-7 fw-light" id="order-button" type="button" data-bs-toggle="modal" data-bs-target="#order"><i class="bi bi-card-checklist fs-5"></i> Orders</button></li>
        <li><button class="dropdown-item text-start fs-7 fw-light" id="profile-button" type="button" data-bs-toggle="modal" data-bs-target="#profile"><i class="bi bi-person fs-5"></i> Profile</button></li>
        <li><button class="dropdown-item text-start fs-7 fw-light" id="logout-button" type="button"><i class="bi bi-box-arrow-left fs-5"></i> Sign-out</button></li>
      </ul>
    </div>
  </div>
</nav>

<!-- User Info Modal -->

<!-- User Cart Modal -->

<!-- User Order Modal -->

<?php
include './user_include/profile.php';
include './user_include/cart.php';
include './user_include/orders.php';
?>