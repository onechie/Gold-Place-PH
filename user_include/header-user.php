<?php
include './assets/scripts/server/database.php';
$userid = $_SESSION['userId'];

if (!defined('ACCESS')) {
  header("location: ../");
}


?>
<script type="text/javascript" src="./assets/scripts/js/user_cart.js"></script>
<script type="text/javascript" src="./assets/scripts/js/user_orders.js"></script>
<script type="text/javascript" src="./assets/scripts/js/user_profile.js"></script>
<script src="./assets/scripts/js/logout.js" type="text/javascript"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm" aria-label="Fourth navbar example">
  <div class="container-xxl px-0">
    <a class="navbar-brand p-0 px-3 m-0" href="#">
      <img height="40" src="./assets/images/defaults/logo-only.png" alt="Logo">
    </a>
    <button class="navbar-toggler mx-2 py-2 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active fs-7 px-3 " aria-current="page" href="./">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fs-7 px-3" aria-current="page" href="./products.php">Items</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fs-7 px-3" aria-current="page" href="#">Contact us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fs-7 px-3" aria-current="page" href="#">About</a>
        </li>
      </ul>

      <form class="px-3 py-2" role="search">
        <input type="search" class="form-control py-1 bg-white fs-7" placeholder="Search" aria-label="Search">
      </form>

      <div class="dropdown text-start p-0">
        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="./assets/images/defaults/default-profile.png" id="profile-icon" alt="profile" width="32" height="32" class="rounded-circle">
        </a>
        <ul class="dropdown-menu text-small bg-dark dropdown-menu-xxl-start dropdown-menu-lg-end p-0">
          <li><button class="w-100 text-start btn btn-lg btn-dark py-1 fs-6" id="cart-button" type="button" data-bs-toggle="modal" data-bs-target="#cart"><i class="bi bi-bag fs-5"></i> Cart</button></li>
          <li><button class="w-100 text-start btn btn-lg btn-dark py-1 fs-6" id="order-button" type="button" data-bs-toggle="modal" data-bs-target="#order"><i class="bi bi-card-checklist fs-5"></i> Orders</button></li>
          <li><button class="w-100 text-start btn btn-lg btn-dark py-1 fs-6" id="profile-button" type="button" data-bs-toggle="modal" data-bs-target="#profile"><i class="bi bi-person fs-5"></i> Profile</button></li>
          <li><button class="w-100 text-start btn btn-lg btn-dark py-1 fs-6" id="logout-button" type="button"><i class="bi bi-box-arrow-left fs-5"></i> Sign-out</button></li>
        </ul>
      </div>
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