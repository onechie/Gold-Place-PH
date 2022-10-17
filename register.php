<!doctype html>
<html lang="en">

<head>
  <?php
  define('ACCESS', TRUE);
  include './user_include/restrict-admin.php';
  if (isset($_SESSION["userId"])) {
    header('location: ./');
  }
  include './user_include/links.php';
  ?>
  <link rel="stylesheet" href="./assets/styles/register.css">
  <link rel="stylesheet" href="./assets/styles/default.css">
  <script src="./assets/scripts/js/register_client_validation.js" type="text/javascript"></script>
  <title>Create Account</title>
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
    <div class="container-fluid d-flex h-100 p-0 register">
      <div class="container-xxl d-flex text-center align-items-center p-0 px-sm-5">
        <div class="container-fluid d-flex justify-content-center rounded-4">
          <form class="form-signin w-100 pb-5 px-4 bg-white shadow rounded-4" novalidate>
            <img class="mb-4" src="./assets/images/defaults/logo-only.png" alt="" height="60">
            <h1 class="h3 mb-4 text-dark fw-normal fs-5">Create your account</h1>
            <div class="form-floating mb-1">
              <input type="text" class="form-control fn fs-7" id="fnInput" placeholder="Firstname">
              <label for="fnInput" class="fs-7" style="width:110%">
                Firstname
                <span class="text-danger fn-w"></i></span>
              </label>
            </div>
            <div class="form-floating mb-1">
              <input type="text" class="form-control ln" id="lnInput" placeholder="Lastname">
              <label for="lnInput" class="fs-7" style="width:110%">
                Lastname
                <span class="text-danger ln-w"></i></span>
              </label>
            </div>
            <div class="form-floating mb-1">
              <input type="email" class="form-control ea" id="emInput" placeholder="Email address">
              <label for="emInput" class="fs-7" style="width:110%">
                Email address
                <span class="text-danger em-w"></i></span>
              </label>
            </div>
            <div class="form-floating mb-1">
              <input type="text" class="form-control ea" id="phInput" placeholder="Phone number">
              <label for="phInput" class="fs-7" style="width:110%">
                Phone number
                <span class="text-danger ph-w"></i></span>
              </label>
            </div>
            <div class="form-floating mb-1">
              <input type="password" class="form-control pw" id="pwInput" placeholder="Password">
              <label for="pwInput" class="fs-7" style="width:110%">
                Password
                <span class="text-danger pw-w"></i></span>
              </label>
            </div>
            <p class="mt-3 mb-3 text-dark fs-7">Already have an account? <a href="login.php" class="link-secondary">login now</a></p>
            <button class="w-100 btn btn-lg btn-dark fs-6" id="ca-submit" type="button">Sign-up</button>
          </form>
          <div class="container-fluid ms-3 shadow bg-dark rounded-4 d-md-flex d-none side-content">

          </div>
        </div>
      </div>

    </div>
    <?php
    include './user_include/footer.php';
    include './user_include/toast.php';
    ?>
    <main>

</body>

</html>