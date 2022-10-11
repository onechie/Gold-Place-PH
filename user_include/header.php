<?php
if (!defined('ACCESS')) {
  header("location: ../");
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top" aria-label="Fourth navbar example">
  <div class="container-xxl px-0">
    <a class="navbar-brand p-0 px-3" href="#">
      <img height="40" src="./assets/images/defaults/logo-only.png" alt="Logo">
    </a>
    <button class="navbar-toggler mx-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active fs-7 px-3 " aria-current="page" href="./">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fs-7  px-3" aria-current="page" href="./products.php">Items</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fs-7  px-3" aria-current="page" href="#">Contact us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fs-7  px-3" aria-current="page" href="#">About</a>
        </li>
      </ul>
      <form class="px-3 py-2" role="search">
        <input type="search" class="form-control py-1 bg-light fs-7" placeholder="Search" aria-label="Search">
      </form>

      <div class="text-start remove-button px-3 d-flex justify-content-end">
        <a class="btn btn-sm btn-dark me-2" href="./login.php">Login</a>
        <a class="btn btn-sm btn-warning" href="./register.php">Sign-up</a>
      </div>

    </div>
  </div>
</nav>