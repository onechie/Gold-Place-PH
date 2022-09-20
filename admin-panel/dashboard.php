<!doctype html>
<html lang="en">
    <head>
        <?php
            include '../user-panel/links.php';
        ?>
        <link rel="stylesheet" href="../css/dashboard.css">
        <title>Admin Panel</title>
    </head>
    <body>
        <main class="d-flex flex-nowrap">
            <div class="d-none d-xl-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px;">
                <a href="/" class="d-flex align-items-center text-white text-decoration-none">
                    <img src="../assets/images/compressed/logo-only.png" height="50" width="50" alt="">
                    <span class="ms-3 my-auto fs-5 text-center">DASHBOARD</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white d-flex" href="#list-1">
                            <i class="bi bi-house-door fs-4"></i>
                            <div class="ms-3 my-auto">
                                <span class="fw-light">Home</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link text-white d-flex" href="#list-2">
                            <i class="bi bi-card-list fs-4"></i>
                            <div class="ms-3 my-auto">
                                <span class="fw-light">Orders</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link text-white d-flex" href="#list-3">
                            <i class="bi bi-grid fs-4"></i>
                            <div class="ms-3 my-auto">
                                <span class="fw-light">Products</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link text-white d-flex" href="#list-4">
                            <i class="bi bi-people fs-4"></i>
                            <div class="ms-3 my-auto">
                                <span class="fw-light">Users</span>
                            </div>
                        </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../assets/images/compressed/rick.jpg" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong>Admin</strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
                    </ul>
                </div>
            </div>
            <div class="container-fluid p-0 bg-light overflow-auto scrollspy-example" data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true"tabindex="0"> 
                    <div class="container-fluid px-xl-5 py-5">
                        <h1 class="fs-1 fw-light lt-space pb-4 text-center text-sm-start">DASHBOARD</h1>
                        <div class="container-fluid p-0" id="list-1">
                            <div class="row">
                                <div class="col-lg-3 col-sm-6 col-12 mb-4 sm-box px-3">
                                    <div class="rounded-5 shadow h-100 px-5 py-4 bg-white">
                                        <h3 class="fw-light">1,000</h3>
                                        <p>TOTAL SALES</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12 mb-4 sm-box px-3">
                                    <div class="rounded-5 shadow h-100 px-5 py-4 bg-white">
                                        <h3 class="fw-light">40,000</h3>
                                        <p>REVENUE</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12 mb-4 sm-box px-3">
                                    <div class="rounded-5 shadow h-100 px-5 py-4 bg-white">
                                        <h3 class="fw-light">30,00</h3>
                                        <p>COST</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12 mb-4 sm-box px-3">
                                    <div class="rounded-5 shadow h-100 px-5 py-4 bg-white">
                                        <h3 class="fw-light">10,000</h3>
                                        <p>PROFIT</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container-fluid rounded-5 shadow bg-white lg-box px-5 py-4">
                            <P class="lt-space fw-light text-center text-sm-start">DAILY SALES GRAPH</P>
                        </div>
                    </div>

                    <div class="container-fluid px-xl-5 pb-5">
                        <h1 class="fs-1 fw-light lt-space pb-3 text-center text-sm-start">ORDERS</h1>
                        <div class="container-fluid bg-white h-75 mb-4 shadow rounded-5 p-4" id="list-2">

                        </div>
                    </div>

                    <h1 class="fs-1 fw-light lt-space py-3">PRODUCTS</h1>
                    <div class="container-fluid bg-white h-75 mb-4 shadow rounded-5 p-4"id="list-3">

                    </div>

                    <h1 class="fs-1 fw-light lt-space py-3">USERS</h1>
                    <div class="container-fluid bg-white h-75 shadow rounded-5 p-4"id="list-4">
                        
                    </div>
            </div>
        </main>
    </body>
</html>