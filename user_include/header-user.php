<?php
  include './assets/scripts/server/database.php';

  $userid = $_SESSION['userId'];
  $sql = "SELECT * FROM user WHERE id = '$userid'";
  $result = mysqli_query($conn, $sql);
  $firstname = NULL;
  $lastname = NULL;
  $email = NULL;
  $phone = NULL;

  if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result)) {
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $email = $row['email'];
        $phone = $row['phone'];
      }
  }
?>
<script type="text/javascript" src="./assets/scripts/js/user_cart.js"></script>
<script type="text/javascript" src="./assets/scripts/js/user_orders.js"></script>
<script src="./assets/scripts/js/logout.js" type="text/javascript"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-warning gradient shadow fixed-top" aria-label="Fourth navbar example">
  <div class="container-xxl">
    <a class="navbar-brand" href="#">
      <img height="40" src="./assets/images/defaults/logo-only-black.png" alt="Logo">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="./products.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Contact us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">About</a>
        </li>
      </ul>
      
        <form class="col-12 col-lg-auto mb-2 mt-2 mt-lg-0 mb-lg-0 me-lg-3" role="search">
          <input type="search" class="form-control py-1" placeholder="Search..." aria-label="Search">
        </form>

        <div class="dropdown text-start p-0">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="./assets/images/defaults/rick.jpg" alt="profile" width="32" height="32" class="rounded-circle">
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
