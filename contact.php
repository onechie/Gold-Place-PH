<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    define('ACCESS', TRUE);
    include './user_include/restrict-admin.php';
    include './user_include/restrict-driver.php';
    include './user_include/links.php';
    $_SESSION['menu'] = 'contact';
    ?>
    <script src="./assets/scripts/js/controller/contact_controller.js"></script>
    <link rel="stylesheet" href="./assets/styles/default.css">
    <title>Gold Place PH - About</title>
</head>

<body>
    <?php
    if (isset($_SESSION["userId"])) {
        include './user_include/header-user.php';
    } else {
        include './user_include/header.php';
    }
    ?>

    <main class="mt-5 bg-light h-100 overflow-auto" id="contact">
        <div id="loading" class="position-absolute bg-dark bg-opacity-25 h-100 w-100 d-flex z-highest justify-content-center align-items-center">
            <div class="spinner-border" style="width: 5rem; height: 5rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="container-xxl">
            <h2 class="pt-4 pb-2 pt-sm-5 text-center text-sm-start">Contact us</h2>
            <p class='px-sm-3 text-center text-sm-start'>Got a question? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
            <div class="row my-4">
                <div class='rounded-2 p-2 p-sm-3 col-12 col-md-6'>
                    <div class="rounded-2 p-4 bg-white shadow-sm">
                        <label for="name" class="form-label">Name <span id='errorName' class='text-danger'></span></label>
                        <input type="text" class="form-control" placeholder="Your name" id="name">

                        <label for="email" class="form-label">Email <span id='errorEmail' class='text-danger'></span></label>
                        <input type="text" class="form-control" placeholder="Your email" id="email">

                        <label for="message" class="form-label">Message <span id='errorMessage' class='text-danger'></span></label>
                        <textarea class="form-control" id="message" placeholder='Write your message here...' style="height: 30vh;"></textarea>
                        <p class='text-center text-sm-start m-0 mt-3 p-0'>
                            <button type="button" class="btn btn-sm btn-warning" id='send-mail'>Send</button>
                        </p>
                    </div>
                </div>

                <div class='rounded-2 p-2 p-sm-3 col-12 col-md-6'>
                    <div class="rounded-2 p-4 bg-white shadow-sm">
                        <h6 class='fw-light'><i class="bi bi-telephone fs-3 me-3 text-muted"></i>09214722043</h6>
                        <h6 class='fw-light'><i class="bi bi-envelope fs-3 me-3 text-muted"></i>shop@goldplaceph.com</h6>
                        <a href="https://www.instagram.com/goldplaceph">
                            <h6 class='fw-light'><i class="bi bi-instagram fs-3 me-3 text-muted"></i>goldplaceph</h6>
                        </a>
                        <a href="https://www.facebook.com/lovejewelrybox">
                            <h6 class='fw-light'><i class="bi bi-facebook fs-3 me-3 text-muted"></i>lovejewelrybox</h6>
                        </a>
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

</body>

</html>