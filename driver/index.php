<!doctype html>
<html lang="en">

<head>
    <?php
    define('ACCESS', TRUE);
    include './driver_include/check-user-type.php';
    if (!isset($_SESSION["userId"])) {
        header('location: ../');
    }
    include '../user_include/links.php';
    ?>
    <script type="text/javascript" src="../assets/scripts/js/controller/driver_add_order_controller.js"></script>
    <script type="text/javascript" src="../assets/scripts/js/controller/driver_order_list_controller.js"></script>
    <script type="text/javascript" src="../assets/scripts/js/controller/driver_done_order_list_controller.js"></script>
    <link rel="stylesheet" href="../assets/styles/default.css">
    <link rel="stylesheet" href="../assets/styles/home-admin.css">
    <title>Gold Place PH - Driver</title>
</head>

<body>
    <?php
    include './driver_include/header-driver.php';
    ?>
    <main class="d-flex flex-nowrap">
        <div class="container-fluid overflow-auto p-0">
            <div class="container-xxl">
                <?php
                include '../user_include/csrf_token.php';
                include './driver_include/order-list.php';
                include './driver_include/done-order-list.php';
                include './driver_include/update-order-modal.php';
                include './driver_include/view-order-modal.php';
                include './driver_include/add-order-modal.php';
                include './driver_include/toast.php';
                ?>
            </div>

        </div>

    </main>
</body>

</html>