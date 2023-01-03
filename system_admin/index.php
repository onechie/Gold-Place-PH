<!doctype html>
<html lang="en">

<head>
    <?php

    define('ACCESS', TRUE);

    include './include/check-user-type.php';
    if (!isset($_SESSION["userId"])) {
        header('location: ../');
    }
    include '../user_include/links.php';
    ?>
    <script type="text/javascript" src="../assets/scripts/js/controller/sa_total_values_controller.js"></script>
    <script type="text/javascript" src="../assets/scripts/js/controller/sa_delete_user_controller.js"></script>
    <script type="text/javascript" src="../assets/scripts/js/controller/sa_edit_user_controller.js"></script>
    <script type="text/javascript" src="../assets/scripts/js/controller/system_admin_controller.js"></script>
    <script type="text/javascript" src="../assets/scripts/js/controller/logout_controller.js"></script>
    <link rel="stylesheet" href="../assets/styles/default.css">
    <link rel="stylesheet" href="../assets/styles/home-admin.css">
    <title>Gold Place PH - System Admin</title>
</head>

<body>
    <main class="d-flex flex-nowrap">
        <?php
        include './include/sidebar.php';
        ?>
        <div class="container-fluid p-0 bg-light overflow-auto" data-bs-spy="scroll" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
            <?php
            include '../user_include/csrf_token.php';
            include './include/home.php';
            include './include/users.php';
            include './include/confirmation-modal.php';
            include './include/edit-user-modal.php';
            include './include/add-user-modal.php';
            include './include/toast.php';
            ?>
        </div>
    </main>
</body>

</html>