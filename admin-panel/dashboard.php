<!doctype html>
<html lang="en">

<head>
    <?php
    include '../user-panel/links.php';
    ?>
    <script type="text/javascript" src="../script/client/pie-chart.js"></script>
    <script type="text/javascript" src="../script/client/line-chart.js"></script>
    <script type="text/javascript" src="../script/client/add_item.js"></script>
    <script type="text/javascript" src="../script/client/load_data_admin.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.js" integrity="sha512-d6nObkPJgV791iTGuBoVC9Aa2iecqzJRE0Jiqvk85BhLHAPhWqkuBiQb1xz2jvuHNqHLYoN3ymPfpiB1o+Zgpw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="../css/dashboard.css">
    <title>Admin Panel</title>
</head>

<body>
    <main class="d-flex flex-nowrap">
        <?php
        include './sidebar.php';
        ?>
        <!--DASHBOARD-->
        <div class="container-fluid p-0 bg-light overflow-auto scrollspy-example" data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
            <?php
            include './home.php';
            include './orders.php';
            include './items.php';
            include './users.php';
            include './add-item-modal.php'
            ?>
        </div>
    </main>
    <div id="modal-show"></div>
</body>

</html>