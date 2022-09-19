<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include 'links.php';
        
    ?>
    <link rel="stylesheet" href="../css/products.css">
    <title>View Products</title>
</head>
<body>
    <?php
        if(isset($_SESSION["userId"])) {
          include 'header-user.php';
        } else {
          include 'header.php';
        }
    ?>
    <main class="mt-5 bg-light h-100 overflow-auto">
        <div class="container-fluid p-0 pb-5 shadow">
            <p class="pt-4 m-0"></p>
            <p class="text-center fs-3 fw-normal m-0 py-4 shadow text-warning bg-dark bg-opacity-100 gradient">OUR FINEST MERCHANDISE</p>
            <div class="container-xxl py-5">
                <div class="d-flex flex-row justify-content-evenly">

                    <div class="card d-flex shadow bg-light p-2" style="display:none">
                        <img src="../assets/images/compressed/img1.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h6 class="card-title m-0 fs-6 fw-normal text-dark">EXAMPLE PRODUCT</h6>
                            <h6 class="card-text text-warning m-0 fs-5 fw-normal pb-2"><span>&#8369;</span>3000</h6>
                            <i class="bi bi-star-fill text-warning"></i>
                            <span>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
                    </div>

                    <div class="card d-sm-flex shadow bg-light p-2" style="display:none">
                        <img src="../assets/images/compressed/img2.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h6 class="card-title m-0 fs-6 fw-normal text-dark">EXAMPLE PRODUCT</h6>
                            <h6 class="card-text text-warning m-0 fs-5 fw-normal pb-2"><span>&#8369;</span>3000</h6>
                            <i class="bi bi-star-fill text-warning"></i>
                            <span>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
                    </div>
                    <div class="card d-md-flex shadow-lg bg-light p-2" style="display:none">
                        <img src="../assets/images/compressed/img3.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h6 class="card-title m-0 fs-6 fw-normal text-dark">EXAMPLE PRODUCT</h6>
                            <h6 class="card-text text-warning m-0 fs-5 fw-normal pb-2"><span>&#8369;</span>3000</h6>
                            <i class="bi bi-star-fill text-warning"></i>
                            <span>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
                    </div>
                    <div class="card d-lg-flex shadow-lg bg-light p-2" style="display:none">
                        <img src="../assets/images/compressed/img4.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h6 class="card-title m-0 fs-6 fw-normal text-dark">EXAMPLE PRODUCT</h6>
                            <h6 class="card-text text-warning m-0 fs-5 fw-normal pb-2"><span>&#8369;</span>3000</h6>
                            <i class="bi bi-star-fill text-warning"></i>
                            <span>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center"><a class="btn btn-lg btn-warning shadow px-5" href="#">View More</a></div>
        </div>
        <div class="container-fluid bg-warning gradient px-0 mb-5 shadow">
        <p class="text-center fs-2 fw-normal m-0 py-4 text-dark">CATEGORIES</p>
            <div class="container marketing">
            <!-- Three columns of text below the carousel -->
                <div class="row justify-content-center">
                    <div class="cat col-lg-2 col-sm-4 col-6">
                    <img src="../assets/images/compressed/img3.jpg" alt="image">
                    <h6 class="fw-normal fs-4">Ring</h6>
                    </div>
                    <div class="cat col-lg-2 col-sm-4 col-6">
                    <img src="../assets/images/compressed/img1.jpg" alt="image">
                    <h6 class="fw-normal fs-4">Necklace</h6>
                    </div>
                    <div class="cat col-lg-2 col-sm-4 col-6">
                    <img src="../assets/images/compressed/img2.jpg" alt="image">
                    <h6 class="fw-normal fs-4">Pendant</h6>
                    </div>
                    <div class="cat col-lg-2 col-sm-4 col-6">
                    <img src="../assets/images/compressed/img4.jpg" alt="image">
                    <h6 class="fw-normal fs-4">Earring</h6>
                    </div>
                    <div class="cat col-lg-2 col-sm-4 col-6">
                    <img src="../assets/images/compressed/img5.jpg" alt="image">
                    <h6 class="fw-normal fs-4">Bracelet</h6>
                    </div>
                </div><!-- /.row -->
            </div>
        </div>
        <div class="container-fluid bg-light gradient px-0 pb-5">
        <p class="text-center fs-3 fw-normal m-0 py-2 text-dark">RECOMMENDED FOR YOU</p>
            <div class="container marketing mt-5">
            <!-- Three columns of text below the carousel -->
                <div class="row justify-content-evenly">
                    <div class="card shadow my-3 bg-light p-2 col-lg-3 col-md-4">
                        <img src="../assets/images/compressed/img1.jpg" class="card-img-top" alt="...">
                        <div class="card-body pb-0">
                            <h6 class="card-title m-0 fs-6 fw-normal text-dark">EXAMPLE PRODUCT</h6>
                            <h6 class="card-text text-warning m-0 fs-5 fw-normal"><span>&#8369;</span>3000</h6>
                            <div class="row justify-content-between">
                                <div class="col-6 my-auto">
                                    <span class="align-middle">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                    </span>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="button" class="btn btn-outline-warning"><i class="bi bi-bag-plus"></i></button>
                                    <button type="button" class="btn btn-outline-warning"><i class="bi bi-search"></i></button>
                                </div>
                            </div>
                        </div>                    
                    </div>
                    <div class="card shadow my-3 bg-light p-2 col-lg-3 col-md-4">
                        <img src="../assets/images/compressed/img1.jpg" class="card-img-top" alt="...">
                        <div class="card-body pb-0">
                            <h6 class="card-title m-0 fs-6 fw-normal text-dark">EXAMPLE PRODUCT</h6>
                            <h6 class="card-text text-warning m-0 fs-5 fw-normal"><span>&#8369;</span>3000</h6>
                            <div class="row justify-content-between">
                                <div class="col-6 my-auto">
                                    <span class="align-middle">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                    </span>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="button" class="btn btn-outline-warning"><i class="bi bi-bag-plus"></i></button>
                                    <button type="button" class="btn btn-outline-warning"><i class="bi bi-search"></i></button>
                                </div>
                            </div>
                        </div>                    
                    </div>
                    <div class="card shadow my-3 bg-light p-2 col-lg-3 col-md-4">
                        <img src="../assets/images/compressed/img1.jpg" class="card-img-top" alt="...">
                        <div class="card-body pb-0">
                            <h6 class="card-title m-0 fs-6 fw-normal text-dark">EXAMPLE PRODUCT</h6>
                            <h6 class="card-text text-warning m-0 fs-5 fw-normal"><span>&#8369;</span>3000</h6>
                            <div class="row justify-content-between">
                                <div class="col-6 my-auto">
                                    <span class="align-middle">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                    </span>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="button" class="btn btn-outline-warning"><i class="bi bi-bag-plus"></i></button>
                                    <button type="button" class="btn btn-outline-warning"><i class="bi bi-search"></i></button>
                                </div>
                            </div>
                        </div>                    
                    </div>
                    <div class="card shadow my-3 bg-light p-2 col-lg-3 col-md-4">
                        <img src="../assets/images/compressed/img1.jpg" class="card-img-top" alt="...">
                        <div class="card-body pb-0">
                            <h6 class="card-title m-0 fs-6 fw-normal text-dark">EXAMPLE PRODUCT</h6>
                            <h6 class="card-text text-warning m-0 fs-5 fw-normal"><span>&#8369;</span>3000</h6>
                            <div class="row justify-content-between">
                                <div class="col-6 my-auto">
                                    <span class="align-middle">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                    </span>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="button" class="btn btn-outline-warning"><i class="bi bi-bag-plus"></i></button>
                                    <button type="button" class="btn btn-outline-warning"><i class="bi bi-search"></i></button>
                                </div>
                            </div>
                        </div>                    
                    </div>
                    <div class="card shadow my-3 bg-light p-2 col-lg-3 col-md-4">
                        <img src="../assets/images/compressed/img1.jpg" class="card-img-top" alt="...">
                        <div class="card-body pb-0">
                            <h6 class="card-title m-0 fs-6 fw-normal text-dark">EXAMPLE PRODUCT</h6>
                            <h6 class="card-text text-warning m-0 fs-5 fw-normal"><span>&#8369;</span>3000</h6>
                            <div class="row justify-content-between">
                                <div class="col-6 my-auto">
                                    <span class="align-middle">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                    </span>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="button" class="btn btn-outline-warning"><i class="bi bi-bag-plus"></i></button>
                                    <button type="button" class="btn btn-outline-warning"><i class="bi bi-search"></i></button>
                                </div>
                            </div>
                        </div>                    
                    </div>
                    <div class="card shadow my-3 bg-light p-2 col-lg-3 col-md-4">
                        <img src="../assets/images/compressed/img1.jpg" class="card-img-top" alt="...">
                        <div class="card-body pb-0">
                            <h6 class="card-title m-0 fs-6 fw-normal text-dark">EXAMPLE PRODUCT</h6>
                            <h6 class="card-text text-warning m-0 fs-5 fw-normal"><span>&#8369;</span>3000</h6>
                            <div class="row justify-content-between">
                                <div class="col-6 my-auto">
                                    <span class="align-middle">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                    </span>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="button" class="btn btn-outline-warning"><i class="bi bi-bag-plus"></i></button>
                                    <button type="button" class="btn btn-outline-warning"><i class="bi bi-search"></i></button>
                                </div>
                            </div>
                        </div>                    
                    </div>
                    <div class="card shadow my-3 bg-light p-2 col-lg-3 col-md-4">
                        <img src="../assets/images/compressed/img1.jpg" class="card-img-top" alt="...">
                        <div class="card-body pb-0">
                            <h6 class="card-title m-0 fs-6 fw-normal text-dark">EXAMPLE PRODUCT</h6>
                            <h6 class="card-text text-warning m-0 fs-5 fw-normal"><span>&#8369;</span>3000</h6>
                            <div class="row justify-content-between">
                                <div class="col-6 my-auto">
                                    <span class="align-middle">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                    </span>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="button" class="btn btn-outline-warning"><i class="bi bi-bag-plus"></i></button>
                                    <button type="button" class="btn btn-outline-warning"><i class="bi bi-search"></i></button>
                                </div>
                            </div>
                        </div>                    
                    </div>
                    <div class="card shadow my-3 bg-light p-2 col-lg-3 col-md-4">
                        <img src="../assets/images/compressed/img1.jpg" class="card-img-top" alt="...">
                        <div class="card-body pb-0">
                            <h6 class="card-title m-0 fs-6 fw-normal text-dark">EXAMPLE PRODUCT</h6>
                            <h6 class="card-text text-warning m-0 fs-5 fw-normal"><span>&#8369;</span>3000</h6>
                            <div class="row justify-content-between">
                                <div class="col-6 my-auto">
                                    <span class="align-middle">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                    </span>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="button" class="btn btn-outline-warning"><i class="bi bi-bag-plus"></i></button>
                                    <button type="button" class="btn btn-outline-warning"><i class="bi bi-search"></i></button>
                                </div>
                            </div>
                        </div>                    
                    </div>

                </div>
                
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination justify-content-center py-5">
                    <li class="page-item shadow"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item shadow"><a class="page-link" href="#">1</a></li>
                    <li class="page-item shadow"><a class="page-link" href="#">2</a></li>
                    <li class="page-item shadow"><a class="page-link" href="#">3</a></li>
                    <li class="page-item shadow"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
        <?php
            include 'footer.php';
        ?>
    </main>
</body>
</html>