<!doctype html>
<html lang="en">

<head>
    <?php
    define('ACCESS', TRUE);
    include '../user_include/restrict-customer.php';
    if (!isset($_SESSION["userId"])) {
        header('location: ../');
    }
    include '../user_include/links.php';
    ?>
    <script type="text/javascript" src="../assets/scripts/js/total_values.js"></script>
    <script type="text/javascript" src="../assets/scripts/js/recent_orders.js"></script>
    <script type="text/javascript" src="../assets/scripts/js/orders-chart.js"></script>
    <script type="text/javascript" src="../assets/scripts/js/sales-chart.js"></script>
    <script type="text/javascript" src="../assets/scripts/js/add_edit_item.js"></script>
    <script type="text/javascript" src="../assets/scripts/js/users_list.js"></script>
    <script type="text/javascript" src="../assets/scripts/js/logout.js"></script>
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
        <div class="container-fluid p-0 bg-light overflow-auto scrollspy-example" data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
            <?php
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