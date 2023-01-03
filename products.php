<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    define('ACCESS', TRUE);
    include './user_include/restrict-admin.php';
    include './user_include/restrict-driver.php';
    include './user_include/links.php';
    $_SESSION['menu'] = 'products';
    ?>
    <script type="text/javascript" src="./assets/scripts/js/controller/items_page_controller.js"></script>
    <script type="text/javascript" src="./assets/scripts/js/controller/view_item_controller.js"></script>

    <link rel="stylesheet" href="./assets/styles/products.css">
    <link rel="stylesheet" href="./assets/styles/default.css">
    <title>Gold Place PH - Products</title>
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
            <div class="container-xxl p-0 pt-3 pt-md-4 pb-3">
                <div class="ratio ratio-21x9 bg-light overflow-hidden">
                    <div id="banner-carousel" class="carousel slide m-0 mb-4 main-carousel" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#banner-carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#banner-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#banner-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active ratio ratio-21x9">
                                <img src="./assets/images/defaults/banner1.png" class="d-block" alt="image" style="object-fit: cover;">
                            </div>
                            <div class="carousel-item ratio ratio-21x9">
                                <img src="./assets/images/defaults/banner2.png" class="d-block" alt="image" style="object-fit: cover;">
                            </div>
                            <div class="carousel-item ratio ratio-21x9">
                                <img src="./assets/images/defaults/banner3.png" class="d-block" alt="image" style="object-fit: cover;">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#banner-carousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#banner-carousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="container-xxl bg-white rounded-2 text-dark px-3 py-2 fw-light fs-7 d-flex justify-content-between flex-wrap mx-auto">
                <div class="d-flex d-md-none justify-self-end py-1 py-md-0 align-items-center">
                    <button class="btn btn-light py-1 px-3 border-0 fw-light fs-7" type="button" data-bs-toggle="offcanvas" data-bs-target="#oc-filter" aria-controls="oc-filter">
                        <i class="bi bi-filter-left fs-6"></i> Filter
                    </button>
                </div>
                <div class="d-none d-md-flex">
                    <div class="d-none d-md-flex align-items-center py-1 py-md-0 sort-by me-4">
                        <p class="p-0 pe-1 m-0">Sort by</p>
                        <div class="btn-group drop-down">
                            <a type="button" class="btn p-0 dropdown-toggle border-0 text-dark fs-7 fw-light btn-light px-2 py-1 rounded-1" id="sort-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Default</a>
                            <ul class="dropdown-menu dropdown-menu-start border-0 p-0 overflow-hidden shadow-sm my-2">
                                <li><button class="dropdown-item text-start fs-7 fw-light" id='Default' type="button">Default</button></li>
                                <li><button class="dropdown-item text-start fs-7 fw-light" id='Latest' type="button">Latest</button></li>
                                <li><button class="dropdown-item text-start fs-7 fw-light" id='Oldest' type="button">Oldest</button></li>
                                <li><button class="dropdown-item text-start fs-7 fw-light" id='Top-sales' type="button">Top Sales</button></li>
                            </ul>
                        </div>
                    </div>

                    <div class="d-none d-md-flex align-items-center py-1 py-md-0 price me-4">
                        <p class="p-0 pe-1 m-0">Price</p>
                        <div class="btn-group drop-down py-1 rounded-1">
                            <a type="button" class="btn p-0 dropdown-toggle border-0 text-dark fs-7 fw-light btn-light px-2 py-1 rounded-1" id="price-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Default</a>
                            <ul class="dropdown-menu dropdown-menu-start border-0 p-0 overflow-hidden shadow-sm my-2">
                                <li><button class="dropdown-item text-start fs-7 fw-light" id='Default' type="button">Default</button></li>
                                <li><button class="dropdown-item text-start fs-7 fw-light" id='Low-to-high' type="button">Low to High</button></li>
                                <li><button class="dropdown-item text-start fs-7 fw-light" id='High-to-low' type="button">High to Low</button></li>
                            </ul>
                        </div>
                    </div>

                    <div class="d-none d-md-flex align-items-center py-1 py-md-0 category me-4">
                        <p class="p-0 pe-1 m-0">Category</p>
                        <div class="btn-group drop-down py-1 rounded-1">
                            <a type="button" class="btn p-0 dropdown-toggle border-0 text-dark fs-7 fw-light btn-light px-2 py-1 rounded-1" id="category-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Default</a>
                            <ul class="dropdown-menu dropdown-menu-start border-0 p-0 my-2 overflow-hidden shadow-sm">
                                <li><button class="dropdown-item text-start fs-7 fw-light" id='Default' type="button">Default</button></li>
                                <li><button class="dropdown-item text-start fs-7 fw-light" id='Ring' type="button">Ring</button></li>
                                <li><button class="dropdown-item text-start fs-7 fw-light" id='Necklace' type="button">Necklace</button></li>
                                <li><button class="dropdown-item text-start fs-7 fw-light" id='Pendant' type="button">Pendant</button></li>
                                <li><button class="dropdown-item text-start fs-7 fw-light" id='Earring' type="button">Earring</button></li>
                                <li><button class="dropdown-item text-start fs-7 fw-light" id='Bracelet' type="button">Bracelet</button></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-self-end py-1 py-md-0 align-items-center">
                    <p class="p-0 pe-1 m-0 page-count">1/-</p>
                    <button type="button" class="btn btn-light py-1 px-3 border-0 previous" id="previous">
                        < </button>
                            <button type="button" class="btn btn-light py-1 px-3 border-0 next" id="next">></button>
                </div>
            </div>

            <div class="offcanvas offcanvas-start" tabindex="-1" id="oc-filter" aria-labelledby="oc-filter-Label">
                <div class="offcanvas-header shadow-sm">
                    <h5 class="offcanvas-title" id="oc-filter-Label">Filter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="d-flex align-items-center sort-by">
                        <p class="p-0 pe-1 m-0">Sort by</p>
                        <div class="btn-group drop-down py-1 rounded-1">
                            <a type="button" class="btn p-0 dropdown-toggle border-0 text-dark fs-7 fw-light btn-light px-2 py-1 rounded-1" id="sort-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Default</a>
                            <ul class="dropdown-menu dropdown-menu-start border-0 p-0 overflow-hidden shadow-sm my-2">
                                <li><button class="dropdown-item text-start fs-7 fw-light" id='Default' type="button">Default</button></li>
                                <li><button class="dropdown-item text-start fs-7 fw-light" id='Latest' type="button">Latest</button></li>
                                <li><button class="dropdown-item text-start fs-7 fw-light" id='Oldest' type="button">Oldest</button></li>
                                <li><button class="dropdown-item text-start fs-7 fw-light" id='Top-sales' type="button">Top Sales</button></li>
                            </ul>
                        </div>
                    </div>

                    <div class="d-flex align-items-center price">
                        <p class="p-0 pe-1 m-0">Price</p>
                        <div class="btn-group drop-down py-1 rounded-1">
                            <a type="button" class="btn p-0 dropdown-toggle border-0 text-dark fs-7 fw-light btn-light px-2 py-1 rounded-1" id="price-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Default</a>
                            <ul class="dropdown-menu dropdown-menu-start border-0 p-0 overflow-hidden shadow-sm my-2">
                                <li><button class="dropdown-item text-start fs-7 fw-light" id='Default' type="button">Default</button></li>
                                <li><button class="dropdown-item text-start fs-7 fw-light" id='Low-to-high' type="button">Low to High</button></li>
                                <li><button class="dropdown-item text-start fs-7 fw-light" id='High-to-low' type="button">High to Low</button></li>
                            </ul>
                        </div>
                    </div>

                    <div class="d-flex align-items-center category">
                        <p class="p-0 pe-1 m-0">Category</p>
                        <div class="btn-group drop-down py-1 rounded-1">
                            <a type="button" class="btn p-0 dropdown-toggle border-0 text-dark fs-7 fw-light btn-light px-2 py-1 rounded-1" id="category-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Default</a>
                            <ul class="dropdown-menu dropdown-menu-start border-0 p-0 my-2 overflow-hidden shadow-sm">
                                <li><button class="dropdown-item text-start fs-7 fw-light" id='Default' type="button">Default</button></li>
                                <li><button class="dropdown-item text-start fs-7 fw-light" id='Ring' type="button">Ring</button></li>
                                <li><button class="dropdown-item text-start fs-7 fw-light" id='Necklace' type="button">Necklace</button></li>
                                <li><button class="dropdown-item text-start fs-7 fw-light" id='Pendant' type="button">Pendant</button></li>
                                <li><button class="dropdown-item text-start fs-7 fw-light" id='Earring' type="button">Earring</button></li>
                                <li><button class="dropdown-item text-start fs-7 fw-light" id='Bracelet' type="button">Bracelet</button></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container-fluid bg-light p-0">
                <div class="container-xxl marketing mt-2 p-0">
                    <input type="hidden" id="page" value="1">
                    <div class="d-flex flex-wrap justify-content-center" id="item-list">
                        <!-- ITEM CARD -->
                    </div>
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center py-4">
                        <button type="button" class="btn btn-light py-1 mx-2 px-2 border-0 previous text-secondary" id="previous">Prev</button>
                        <button type="button" class="btn btn-light py-1 mx-2 px-2 border-0 next text-secondary" id="next">Next</button>
                    </ul>
                </nav>
            </div>
            <?php
            include './user_include/csrf_token.php';
            include './user_include/view-item-modal.php';
            include './user_include/footer.php';
            include './user_include/toast.php';
            ?>
    </main>

</body>

</html>