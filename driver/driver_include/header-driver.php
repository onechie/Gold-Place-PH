<?php

if (!defined('ACCESS')) {
  header("location: ../");
}


?>
<script type="text/javascript" src="../assets/scripts/js/controller/logout_controller.js"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm py-2" aria-label="Fourth navbar example">
  <div class="container-xxl">
    <a class="navbar-brand p-0 pe-3 m-0" href="#">
      <img height="40" src="../assets/images/defaults/logo-only.png" alt="Logo">
    </a>

    <div class="dropdown text-start p-0">
      <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="../assets/images/defaults/default-profile.png" id="profile-icon" alt="profile" width="32" height="32" class="rounded-circle">
      </a>
      <ul class="dropdown-menu shadow-sm dropdown-menu-end p-0 m-0 border-0 overflow-hidden my-2">
        <li><button class="dropdown-item text-start fs-7 fw-light" id="add-order-btn" type="button" data-bs-toggle="modal" data-bs-target="#add-order"><i class="bi bi-card-checklist fs-5"></i> Add Order</button></li>
        <li><button class="dropdown-item text-start fs-7 fw-light" id="logout-d" type="button"><i class="bi bi-box-arrow-left fs-5"></i> Sign-out</button></li>
      </ul>
    </div>
  </div>
</nav>