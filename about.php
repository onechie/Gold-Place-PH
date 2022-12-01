<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    define('ACCESS', TRUE);
    include './user_include/restrict-admin.php';
    include './user_include/restrict-driver.php';
    include './user_include/links.php';
    $_SESSION['menu'] = 'about';
    ?>

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
    <div class="container-xxl">
        <h2 class="pt-5 mt-5">About us</h2>
    </div>

    <main class="mt-5 bg-light h-100 overflow-auto" id="user-panel">

        <?php
        include './user_include/csrf_token.php';
        include './user_include/footer.php';
        include './user_include/toast.php';
        ?>
    </main>

</body>

</html>