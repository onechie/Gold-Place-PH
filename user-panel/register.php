<!doctype html>
<html lang="en">
    <head>
      <?php
        include 'links.php';
      ?>
      <link rel="stylesheet" href="../css/register.css">
      <script src="../script/client/register_client_validation.js" type="text/javascript"></script>
      <title>Login</title>
      
    </head>

    <body>
      <?php
        include 'header.php';
      ?>
      <div class="container-fluid text-center test overflow-auto">
        <main class="form-signin w-100 mt-5 mx-auto mb-auto m-sm-auto pb-5 px-4 bg-dark rounded-5">
          <form class="needs-validation" novalidate>
            <img class="mb-4" src="../assets/images/compressed/logo-only.png" alt="" height="70">
            <h1 class="h3 mb-4 fw-normal">Create your account</h1>

            <div class="form-floating mb-1">
              <input type="text" class="form-control fn" id="fnInput" placeholder="Firstname">
              <label for="fnInput">
                Firstname
                <span class="text-warning fn-w fn-long"> is too long <i class="bi bi-exclamation-circle-fill"></i></span>
                <span class="text-warning fn-w fn-not-valid"> is not valid <i class="bi bi-exclamation-circle-fill"></i></span>
                <span class="text-warning fn-w fn-no-text"><i class="bi bi-exclamation-circle-fill"></i></span>
              </label>
            </div>
            <div class="form-floating mb-1">
              <input type="text" class="form-control ln" id="lnInput" placeholder="Lastname">
              <label for="lnInput">
                Lastname
                <span class="text-warning ln-w ln-long"> is too long <i class="bi bi-exclamation-circle-fill"></i></span>
                <span class="text-warning ln-w ln-not-valid"> is not valid <i class="bi bi-exclamation-circle-fill"></i></span>
                <span class="text-warning ln-w ln-no-text"><i class="bi bi-exclamation-circle-fill"></i></span>
              </label>
            </div>
            <div class="form-floating mb-1">
              <input type="email" class="form-control ea" id="emInput" placeholder="Email address">
              <label for="emInput">
                Email address 
                <span class="text-warning em-w em-exists"></span>
                <span class="text-warning em-w em-not-valid"> is not valid <i class="bi bi-exclamation-circle-fill"></i></span>
                <span class="text-warning em-w em-no-text"><i class="bi bi-exclamation-circle-fill"></i></span>
              </label>
            </div>
            <div class="form-floating mb-1">
              <input type="text" class="form-control ea" id="pnInput" placeholder="Phone number">
              <label for="pnInput">
                Phone number
                <span class="text-warning ph-w ph-exists"></span>
                <span class="text-warning ph-w ph-not-valid"> is not valid <i class="bi bi-exclamation-circle-fill"></i></span>
                <span class="text-warning ph-w ph-no-text"><i class="bi bi-exclamation-circle-fill"></i></span>
              </label>
            </div>
            <div class="form-floating mb-1">
              <input type="password" class="form-control pw" id="pwInput" placeholder="Password">
              <label for="pwInput">
                Password
                <span class="text-warning pw-w pw-long"> is too long <i class="bi bi-exclamation-circle-fill"></i></span>
                <span class="text-warning pw-w pw-short"> is too short <i class="bi bi-exclamation-circle-fill"></i></span>
                <span class="text-warning pw-w pw-no-text"><i class="bi bi-exclamation-circle-fill"></i></span>
              </label>
            </div>
            <p class="mt-3 mb-3 text-white-50">Already have an account? <a href="login.php" class="gold-text">login now</a></p>
            <div class="checkbox mb-3">
            </div>
            <button class="w-100 btn btn-lg btn-warning" id="ca-submit" type="button">Sign-up</button>
          </form>
        </main>
      </div>
      
      <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast reg-toast" role="alert" aria-live="assertive" aria-atomic="true">
        </div>
      </div>
      
  </body>
</html>