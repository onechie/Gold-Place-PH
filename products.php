<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    define('ACCESS', TRUE);
    include './user_include/restrict-admin.php';
    include './user_include/links.php';
    ?>
    <script type="text/javascript" src="./assets/scripts/js/items_page.js"></script>
    <link rel="stylesheet" href="./assets/styles/products.css">
    <link rel="stylesheet" href="./assets/styles/default.css">
    <title>View Products</title>
</head>

<body>
    <?php
    if (isset($_SESSION["userId"])) {
        include './user_include/header-user.php';
    } else {
        include './user_include/header.php';
    }
    ?>
    <main class="mt-5 bg-light h-100 overflow-auto" id="user-panel">
        <div class="container-fluid p-0 pb-5">
            <!-- COMMENT
            <p class="pt-4 m-0"></p>
            <p class="text-center fs-3 m-0 py-4  bg-light fw-light">OUR FINEST MERCHANDISE</p>
            <div class="container-xxl pt-5 pb-2">
                <div class="d-flex flex-row justify-content-evenly">

                    <div class="card d-flex mx-1 s-1 bg-light p-2" style="display:none">
                        <div class='ratio ratio-1x1 rounded-top overflow-hidden' style='max-width: 300px;'>
                            <img src="./assets/images/defaults/img1.jpg" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h6 class="card-title m-0 fs-6 fw-light text-dark">EXAMPLE PRODUCT</h6>
                            <h6 class="card-text c-1 m-0 fs-5 fw-normal pb-2"><span>&#8369;</span>3000</h6>
                            <i class="bi bi-star-fill c-3"></i>
                            <span>
                                <i class="bi bi-star-fill c-3"></i>
                                <i class="bi bi-star-fill c-3"></i>
                                <i class="bi bi-star-fill c-3"></i>
                                <i class="bi bi-star-fill c-3"></i>
                            </span>
                        </div>
                    </div>

                    <div class="card d-sm-flex mx-1 s-1 bg-light p-2" style="display:none">
                    <div class='ratio ratio-1x1 rounded-top overflow-hidden' style='max-width: 300px;'>
                            <img src="./assets/images/defaults/img2.jpg" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h6 class="card-title m-0 fs-6 fw-light text-dark">EXAMPLE PRODUCT</h6>
                            <h6 class="card-text c-1 m-0 fs-5 fw-normal pb-2"><span>&#8369;</span>3000</h6>
                            <i class="bi bi-star-fill c-3"></i>
                            <span>
                                <i class="bi bi-star-fill c-3"></i>
                                <i class="bi bi-star-fill c-3"></i>
                                <i class="bi bi-star-fill c-3"></i>
                                <i class="bi bi-star-fill c-3"></i>
                            </span>
                        </div>
                    </div>
                    <div class="card d-lg-flex mx-1 s-1 bg-light p-2" style="display:none">
                        <div class='ratio ratio-1x1 rounded-top overflow-hidden' style='max-width: 300px;'>
                            <img src="./assets/images/defaults/img3.jpg" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h6 class="card-title m-0 fs-6 fw-light text-dark">EXAMPLE PRODUCT</h6>
                            <h6 class="card-text c-1 m-0 fs-5 fw-normal pb-2"><span>&#8369;</span>3000</h6>
                            <i class="bi bi-star-fill c-3"></i>
                            <span>
                                <i class="bi bi-star-fill c-3"></i>
                                <i class="bi bi-star-fill c-3"></i>
                                <i class="bi bi-star-fill c-3"></i>
                                <i class="bi bi-star-fill c-3"></i>
                            </span>
                        </div>
                    </div>
                    <div class="card d-xl-flex mx-1 s-1 bg-light p-2" style="display:none">
                    <div class='ratio ratio-1x1 rounded-top overflow-hidden' style='max-width: 300px;'>
                            <img src="./assets/images/defaults/img4.jpg" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h6 class="card-title m-0 fs-6 fw-light text-dark">EXAMPLE PRODUCT</h6>
                            <h6 class="card-text c-1 m-0 fs-5 fw-normal pb-2"><span>&#8369;</span>3000</h6>
                            <i class="bi bi-star-fill c-3"></i>
                            <span>
                                <i class="bi bi-star-fill c-3"></i>
                                <i class="bi bi-star-fill c-3"></i>
                                <i class="bi bi-star-fill c-3"></i>
                                <i class="bi bi-star-fill c-3"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid gold-bg-2 px-0 mb-5 shadow">
            <p class="text-center fs-2 lt-space fw-light m-0 py-4 text-dark">CATEGORIES</p>
            <div class="container marketing">
                <div class="row justify-content-center">
                    <div class="cat col-lg-2 col-sm-4 col-6">
                        <img src="./assets/images/defaults/img3.jpg" alt="image">
                        <h6 class="fw-light fs-4">Ring</h6>
                    </div>
                    <div class="cat col-lg-2 col-sm-4 col-6">
                        <img src="./assets/images/defaults/img1.jpg" alt="image">
                        <h6 class="fw-light fs-4">Necklace</h6>
                    </div>
                    <div class="cat col-lg-2 col-sm-4 col-6">
                        <img src="./assets/images/defaults/img2.jpg" alt="image">
                        <h6 class="fw-light fs-4">Pendant</h6>
                    </div>
                    <div class="cat col-lg-2 col-sm-4 col-6">
                        <img src="./assets/images/defaults/img4.jpg" alt="image">
                        <h6 class="fw-light fs-4">Earring</h6>
                    </div>
                    <div class="cat col-lg-2 col-sm-4 col-6">
                        <img src="./assets/images/defaults/img5.jpg" alt="image">
                        <h6 class="fw-light fs-4">Bracelet</h6>
                    </div>
                </div>
            </div>
        </div> 
        
-->
            <div class="container-xxl p-0 pt-3 pt-md-5">
                <div id="banner-carousel" class="carousel slide m-0 mb-4 main-carousel" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#banner-carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#banner-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#banner-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="bg-image" style="background-image: url(./assets/images/defaults/background5.jpg);"></div>
                        </div>
                        <div class="carousel-item">
                            <div class="bg-image" style="background-image: url(./assets/images/defaults/background5.jpg);"></div>

                        </div>
                        <div class="carousel-item">
                            <div class="bg-image" style="background-image: url(./assets/images/defaults/background5.jpg);"></div>
                        </div>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#banner-carousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#banner-carousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="container-xxl bg-white rounded-2 text-dark px-4 py-3 fw-light fs-7 d-flex justify-content-between flex-wrap mx-auto">
                <div class="d-flex align-items-center py-1 py-md-0">
                    <p class="p-0 pe-1 m-0">Sort by</p>
                    <div class="btn-group drop-down">
                        <a type="button" class="btn p-0 dropdown-toggle border-0 text-dark fs-7 fw-light btn-light px-2 py-1 rounded-1" id="main-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Default
                        </a>
                        <ul class="dropdown-menu dropdown-menu-start border-0 p-0 overflow-hidden shadow-sm m-2">
                            <li><button class="dropdown-item text-start fs-7 fw-light" type="button">Latest</button></li>
                            <li><button class="dropdown-item text-start fs-7 fw-light" type="button">Top Sales</button></li>
                        </ul>
                    </div>
                </div>

                <div class="d-flex align-items-center py-1 py-md-0">
                    <p class="p-0 pe-1 m-0">Price</p>
                    <div class="btn-group drop-down py-1 rounded-1">
                        <a type="button" class="btn p-0 dropdown-toggle border-0 text-dark fs-7 fw-light btn-light px-2 py-1 rounded-1" id="main-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Default
                        </a>
                        <ul class="dropdown-menu dropdown-menu-start border-0 p-0 overflow-hidden shadow-sm m-2">
                            <li><button class="dropdown-item text-start fs-7 fw-light" type="button">Low to High</button></li>
                            <li><button class="dropdown-item text-start fs-7 fw-light" type="button">High to Low</button></li>
                        </ul>
                    </div>
                </div>

                <div class="d-flex align-items-center py-1 py-md-0">
                    <p class="p-0 pe-1 m-0">Category</p>
                    <div class="btn-group drop-down py-1 rounded-1">
                        <a type="button" class="btn p-0 dropdown-toggle border-0 text-dark fs-7 fw-light btn-light px-2 py-1 rounded-1" id="main-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Default
                        </a>
                        <ul class="dropdown-menu dropdown-menu-start border-0 p-0 m-2 overflow-hidden shadow-sm">
                            <li><button class="dropdown-item text-start fs-7 fw-light" type="button">Ring</button></li>
                            <li><button class="dropdown-item text-start fs-7 fw-light" type="button">Necklace</button></li>
                            <li><button class="dropdown-item text-start fs-7 fw-light" type="button">Pendant</button></li>
                            <li><button class="dropdown-item text-start fs-7 fw-light" type="button">Earring</button></li>
                            <li><button class="dropdown-item text-start fs-7 fw-light" type="button">Bracelet</button></li>
                        </ul>
                    </div>
                </div>
                <div class="d-flex justify-self-end py-1 py-md-0 align-items-center">
                    <p class="p-0 pe-1 m-0">1/50</p>
                    <button type="button" class="btn btn-light py-1 px-3 border-0" id="previous"><</button>
                    <button type="button" class="btn btn-light py-1 px-3 border-0" id="next">></button>
                </div>
            </div>
            <div class="container-fluid bg-light p-0">
                <div class="container-xxl marketing mt-2 p-0">
                    <input type="hidden" id="page" value="1">
                    <div class="d-flex flex-row justify-content-evenly flex-wrap" id="item-list">

                    </div>
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination justify-content-center py-4">
                        <li class="page-item shadow-sm"><a class="page-link">Prev</a></li>
                        <li class="page-item shadow-sm"><a class="page-link">1</a></li>
                        <li class="page-item shadow-sm"><a class="page-link">2</a></li>
                        <li class="page-item shadow-sm"><a class="page-link">3</a></li>
                        <li class="page-item shadow-sm"><a class="page-link">Next</a></li>
                    </ul>
                </nav>
            </div>
            <?php
            include './user_include/view-item-modal.php';
            include './user_include/footer.php';
            include './user_include/toast.php';
            ?>
    </main>

</body>

</html>