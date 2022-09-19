<!doctype html>
<html lang="en">
  <head>
    <?php
      include 'links.php';
    ?>
    <link rel="stylesheet" href="../css/register.css">
    <script src="../script/client/register_client_validation.js" type="text/javascript"></script>
    <title>Create Account</title>
  </head>

  <body>
    <?php
      include 'header.php';
    ?>
    <main class="h-100 overflow-auto">
      <div class="container-fluid d-flex h-100 p-0">
        <div class="container-xxl d-flex text-center align-items-center p-0">
          <div class="container-fluid d-flex justify-content-center rounded-5">
              <form class="form-signin w-100 pb-5 px-4 bg-warning rounded-5" novalidate>
                <img class="mb-4" src="../assets/images/compressed/logo-only-black.png" alt="" height="70">
                <h1 class="h3 mb-4 text-dark fw-normal">Create your account</h1>
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
                <p class="mt-3 mb-3 text-dark">Already have an account? <a href="login.php" class="link-secondary">login now</a></p>
                <button class="w-100 btn btn-lg btn-dark" id="ca-submit" type="button">Sign-up</button>
              </form>
            <div class="container-fluid ms-3 shadow bg-dark rounded-5 d-md-flex d-none side-content">
              
            </div>
          </div>
        </div>

        </div>
      <?php
        include 'footer.php';
      ?>
    <main>
    
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
      <div id="liveToast" class="toast log-toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-warning">
          <img src="../assets/images/compressed/logo-only-black.png" height="30" class="rounded me-2" alt="...">
          <strong class="me-auto text-dark">Gold Place PH</strong>
          <button type="button" class="btn-close btn-close-black" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">

        </div>
      </div>
    </div>
    
  </body>
</html>