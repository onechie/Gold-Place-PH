<!doctype html>
<?php
  session_start();
  if(isset($_SESSION["userId"])) {
    header('location: home.php');
  }
?>

<html lang="en">
    <head>
      <?php
        include 'links.php';
      ?>
      <link rel="stylesheet" href="../css/login.css">
      <script src="../script/client/login_client_validation.js" type="text/javascript"></script>
      <title>Login</title>
      <style>
        .loading{
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
      </style>
    </head>

    <body>
      <?php
        include 'header.php';
      ?>
      
      <div class="container-fluid text-center test overflow-auto">
        <main class="form-signin w-100 mt-5 mx-auto mb-auto m-sm-auto pb-5 px-4 bg-dark rounded-5">
          
          <form>
            <img class="mb-4" src="../assets/images/compressed/logo-only.png" alt="" height="70">
            <h1 class="h3 mb-4 fw-normal">Please sign in</h1>
            <div class="form-floating mb-1">
              <input type="email" class="form-control" id="emInput" placeholder="name@example.com">
              <label for="emInput">
                Email address
                <span class="text-warning em-w em-exists"></span>
                <span class="text-warning em-w em-not-valid"> is not valid <i class="bi bi-exclamation-circle-fill"></i></span>
                <span class="text-warning em-w em-no-text"><i class="bi bi-exclamation-circle-fill"></i></span>
              </label>
            </div>
            <div class="form-floating mb-1">
              <input type="password" class="form-control" id="pwInput" placeholder="Password">
              <label for="pwInput">
                Password
                <span class="text-warning pw-w pw-no-text"><i class="bi bi-exclamation-circle-fill"></i></span>
              </label>
            </div>

            <p class="mt-3 mb-3 gray-text">Don't have an account? <a href="register.php" class="gold-text">register now</a></p>

            <button class="w-100 btn btn-lg btn-warning" id="log-submit" type="button">Sign-in</button>
          </form>
        </main>
      </div>

      <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast log-toast" role="alert" aria-live="assertive" aria-atomic="true">
        </div>
      </div>

  </body>
</html>