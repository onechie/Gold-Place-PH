<!doctype html>
<html lang="en">

<head>
    <?php
    define('ACCESS', TRUE);
    include './admin_include/check-user-type.php';
    if (!isset($_SESSION["userId"])) {
        header('location: ../');
    }
    include '../user_include/links.php';
    ?>
    <script type="text/javascript" src="../assets/scripts/js/controller/admin_total_values_controller.js"></script>
    <script type="text/javascript" src="../assets/scripts/js/controller/admin_recent_order_controller.js"></script>
    <script type="text/javascript" src="../assets/scripts/js/controller/admin_orders_chart_controller.js"></script>
    <script type="text/javascript" src="../assets/scripts/js/controller/admin_sales_chart_controller.js"></script>
    <script type="text/javascript" src="../assets/scripts/js/controller/admin_item_list_controller.js"></script>
    <script type="text/javascript" src="../assets/scripts/js/controller/admin_user_list_controller.js"></script>
    <script type="text/javascript" src="../assets/scripts/js/controller/logout_controller.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.js" integrity="sha512-d6nObkPJgV791iTGuBoVC9Aa2iecqzJRE0Jiqvk85BhLHAPhWqkuBiQb1xz2jvuHNqHLYoN3ymPfpiB1o+Zgpw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="../assets/styles/default.css">
    <link rel="stylesheet" href="../assets/styles/home-admin.css">
    <title>Gold Place PH - Admin</title>
</head>

<body>
    <main class="d-flex flex-nowrap">
        <?php
        include './admin_include/sidebar.php';
        ?>
        <!--DASHBOARD-->
        <div class="container-fluid p-0 bg-light overflow-auto" data-bs-spy="scroll" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
            <?php
            include '../user_include/csrf_token.php';
            include './admin_include/home.php';
            include './admin_include/orders.php';
            include './admin_include/items.php';
            include './admin_include/users.php';
            include './admin_include/add-item-modal.php';
            include './admin_include/confirmation-modal.php';
            include './admin_include/view-user-modal.php';
            include './admin_include/add-user-modal.php';
            include './admin_include/view-order-modal.php';
            ?>
        </div>
    </main>
</body>

</html>