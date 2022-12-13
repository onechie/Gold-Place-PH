<!doctype html>

<html lang="en">

<head>
  <?php
  define('ACCESS', TRUE);
  include './user_include/restrict-admin.php';
  include './user_include/restrict-driver.php';
  $_SESSION['menu'] = 'login';
  if (isset($_SESSION["userId"])) {
    header('location: ./');
  }

  include './user_include/links.php';
  ?>
  <link rel="stylesheet" href="./assets/styles/login.css">
  <link rel="stylesheet" href="./assets/styles/default.css">
  <script src="./assets/scripts/js/controller/reset_password_controller.js" type="text/javascript"></script>
  <title>Gold Place PH - Password Reset</title>
</head>

<body>
  <?php
  include './user_include/header.php';
  ?>
  <main class="h-100 overflow-auto">
    <div id="loading" class="position-absolute bg-dark bg-opacity-25 h-100 w-100 d-flex z-highest justify-content-center align-items-center">
      <div class="spinner-border" style="width: 5rem; height: 5rem;" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
    <div class="container-fluid d-flex h-100 p-0 loading login">
      <div class="container-xxl d-flex text-center align-items-center p-0 px-sm-5">
        <div class="container-fluid d-flex justify-content-center rounded-5">
          <form class="form-signin w-100 pb-5 px-4 bg-white rounded-4 shadow">
            <img class="mb-4" src="./assets/images/defaults/logo-only.png" alt="" height="60">
            <h1 class="h3 mb-4 text-dark fw-normal fs-5">Enter your new password</h1>
            <div class="form-floating mb-1">
              <input type="password" class="form-control pw" id="pwInput" placeholder="Password">
              <label for="pwInput" class="fs-7" style="width:110%">
                Password
                <span class="text-danger pw-w"></span>
              </label>
            </div>
            <div class="form-floating mb-1">
              <input type="password" class="form-control pw" id="cpwInput" placeholder="Confirm password">
              <label for="cpwInput" class="fs-7" style="width:110%">
                Confirm password
                <span class="text-danger cpw-w"></span>
              </label>
            </div>
            <button class="w-100 btn btn-lg btn-dark fs-6 mt-3" id="reset_password" type="submit">Submit</button>
          </form>
          
          <div class="container-fluid ms-3 shadow bg-dark rounded-4 d-md-flex d-none side-content">

          </div>
        </div>
      </div>

    </div>
    <?php
    include './user_include/csrf_token.php';
    include './user_include/footer.php';
    include './user_include/toast.php';
    ?>
    </main>
    <input type="hidden" id="password_reset" value="<?php if (isset($_GET['token'])) echo $_GET['token']; ?>">
</body>

</html>