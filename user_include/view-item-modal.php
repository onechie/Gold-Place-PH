<!-- ADD ITEM MODAL - ADMIN PANEL -->
<div class="modal fade" id="item" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header shadow-sm">
                <h5 class="modal-title fw-light lt-space" id="modalLabel">VIEW ITEM</h5>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body overflow-auto py-4 px-2 px-sm-4 bg-light" style="max-height: 60vh;">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="d-flex w-100 flex-column flex-lg-row justify-content-start align-items-start rounded-4 py-4 px-2 px-sm-4 bg-white shadow-sm">
                            <!-- ITEM IMAGE
                            <div class="ratio ratio-1x1 bg-light shadow-sm rounded-4 align-self-center" style="max-width: 400px;">
                                <img id="image" src="./assets/images/defaults/img1.jpg" alt="image" class="rounded-4" style="object-fit: cover;">
                            </div>-->
                            <div class="ratio ratio-1x1 bg-light shadow-sm rounded-4 align-self-center overflow-hidden" style="max-width: 400px;">
                                <div id="image-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active ratio ratio-1x1" style="max-width: 400px;">
                                            <img src="./assets/images/defaults/img1.jpg" class="d-block rounded-4" alt="image" style="object-fit: cover;">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#image-carousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#image-carousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>

                            
                            <!-- ITEM INFO-->
                            <div class="text-start ps-lg-5 px-3">
                                <h4 class="py-3 m-0 fw-light text-capitalize" id="item-name">RING OF CRITICAL +3</h4>
                                <span class="text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </span>
                                <h2 class="py-3 m-0 text-warning fw-normal text-capitalize">&#8369;<span id="item-price"></span></h2>
                                <h5 class="py-3 m-0 fw-200 text-capitalize" id="item-shipping">Shipping fee : <strong>P0 - P100</strong></h5>
                                <p class="py-1 fw-200 m-0">Sold : <strong id="item-sold">200</strong></p>
                                <p class="py-1 fw-200 m-0" id="item-rating">Ratings : <strong>100</strong></p>
                                <div class="pt-3">
                                    <p class="fw-200 p-0 pb-2 m-0">Quantity - <strong id="item-stocks">100</strong><strong> available</strong></p>
                                    <input type="number" class="form-control w-50" id="item-quantity" name="item-quantity" min="1" value="1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ITEM DESCRIPTION-->
                    <div class="col-12 mb-4">
                        <div class="overflow-hidden bg-white shadow-sm rounded-4 w-100">
                            <div class="py-4 px-2 px-sm-4 h-auto d-flex justify-content-start">
                                <div>
                                    <h4 class="fw-normal pb-4" id="total">Item Description</h4>
                                    <p class="m-0 p-0 fw-light" id="item-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor augue mauris augue neque gravida. Nec ultrices dui sapien eget mi proin sed libero. Donec enim diam vulputate ut pharetra. Egestas sed tempus urna et. Maecenas volutpat blandit aliquam etiam. Pharetra massa massa ultricies mi. Sapien eget mi proin sed libero enim sed faucibus turpis. Vitae semper quis lectus nulla at. Urna nec tincidunt praesent semper feugiat nibh sed pulvinar proin. Egestas egestas fringilla phasellus faucibus. Aliquam ultrices sagittis orci a scelerisque purus semper eget duis. Ultrices vitae auctor eu augue ut lectus arcu bibendum. Sed id semper risus in hendrerit gravida rutrum quisque. <br><br> A iaculis at erat pellentesque adipiscing commodo. Tortor posuere ac ut consequat semper viverra. Tempor orci eu lobortis elementum nibh.Enim praesent elementum facilisis leo. Vitae suscipit tellus mauris a diam maecenas sed enim ut. Sapien faucibus et molestie ac feugiat. Mattis nunc sed blandit libero volutpat. Pharetra convallis posuere morbi leo urna molestie at elementum. Ipsum consequat nisl vel pretium lectus quam id leo in. Aliquam ultrices sagittis orci a scelerisque purus semper eget. Ultrices sagittis orci a scelerisque purus semper eget duis at. Neque laoreet suspendisse interdum consectetur. Volutpat ac tincidunt vitae semper quis. Laoreet suspendisse interdum consectetur libero id faucibus nisl.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ITEM RATINGS-->
                    <div class="col-12 mb-4">
                        <div class="overflow-hidden bg-white shadow-sm rounded-4 h-100 w-100">
                            <div class="py-4 px-2 px-sm-4 h-auto d-flex justify-content-start">
                                <div>
                                    <h4 class="fw-normal pb-4">Item Ratings</h4>
                                    <div class="w-100 h-auto" id="customer-rate">
                                        <div class="d-flex align-items-center">
                                            <span class="position-relative rounded-5 bg-white shadow-sm me-3" style="width:50px; height:50px">
                                                <img class="position-absolute m-1 bg-primary rounded-5" src="./assets/images/defaults/rick.jpg" alt="" style="width:42px; height:42px">
                                            </span>
                                            <div class="">
                                                <span>Angelo Parole </span>
                                                <p class="text-warning p-0 m-0">
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                </p>
                                            </div>
                                        </div>
                                        <div id="rate-text" class="w-100 py-3 fw-200">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem mollis aliquam ut porttitor leo a diam. Ipsum nunc aliquet bibendum enim facilisis gravida. Magna etiam tempor orci eu. Quisque id diam vel quam elementum pulvinar etiam non.
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="w-100 h-auto" id="customer-rate">
                                        <div class="d-flex align-items-center">
                                            <span class="position-relative rounded-5 bg-white shadow-sm me-3" style="width:50px; height:50px">
                                                <img class="position-absolute m-1 bg-primary rounded-5" src="./assets/images/defaults/rick.jpg" alt="" style="width:42px; height:42px">
                                            </span>
                                            <div class="">
                                                <span>Angelo Parole </span>
                                                <p class="text-warning p-0 m-0">
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                </p>
                                            </div>
                                        </div>
                                        <div id="rate-text" class="w-100 py-3 fw-200">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem mollis aliquam ut porttitor leo a diam. Ipsum nunc aliquet bibendum enim facilisis gravida. Magna etiam tempor orci eu. Quisque id diam vel quam elementum pulvinar etiam non.
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="w-100 h-auto" id="customer-rate">
                                        <div class="d-flex align-items-center">
                                            <span class="position-relative rounded-5 bg-white shadow-sm me-3" style="width:50px; height:50px">
                                                <img class="position-absolute m-1 bg-primary rounded-5" src="./assets/images/defaults/rick.jpg" alt="" style="width:42px; height:42px">
                                            </span>
                                            <div class="">
                                                <span>Angelo Parole </span>
                                                <p class="text-warning p-0 m-0">
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                    <i class="bi bi-star-fill"></i>
                                                </p>
                                            </div>
                                        </div>
                                        <div id="rate-text" class="w-100 py-3 fw-200">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem mollis aliquam ut porttitor leo a diam. Ipsum nunc aliquet bibendum enim facilisis gravida. Magna etiam tempor orci eu. Quisque id diam vel quam elementum pulvinar etiam non.
                                        </div>
                                        <hr>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer bg-light d-flex justify-content-center justify-content-sm-end px-4">
                <button type="submit" class="btn btn-sm btn-warning" id="add-cart-btn">Add to cart</button>
                <input type="hidden" id="item-id" value="">
            </div>
        </div>
    </div>
</div>