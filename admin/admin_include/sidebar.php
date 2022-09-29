<?php
    if(!defined('ACCESS')) {
    header("location: dashboard.php");
    }
?>
<!--SIDE BAR-->
<div>
    <a class="px-4 d-flex position-absolute d-sm-none align-items-center justify-content-center text-decoration-none shadow rounded-4 rounded-start p-3 bg-warning test z-highest" type="button" id="sidebarTrigger">
        <img src="../assets/images/defaults/logo-only-black.png" height="40" width="40" alt="">
    </a>
    <div class="pe-3 h-100 z-high py-3 make-abs hide">
        <div class="h-100 py-5">
            <div class="d-flex flex-column flex-shrink-0 h-100 test">
                <a href="" class="px-4 d-none d-sm-flex align-items-center justify-content-center text-decoration-none shadow rounded-4 rounded-start p-3 bg-warning">
                    <img src="../assets/images/defaults/logo-only-black.png" height="40" width="40" alt="">
                    <span class="ms-1 my-auto text-center d-none d-xxl-block text-dark">MANAGEMENT</span>
                </a>
                <ul class="nav nav-pills flex-column mb-auto bg-white rounded-4 rounded-start mt-4 mt-sm-3 shadow overflow-hidden flex-shrink-0">
                    <li class="nav-item">
                        <a class="nav-link text-white d-flex justify-content-center justify-content-xxl-start" href="#list-1">
                            <i class="bi bi-house-door fs-5 text-dark"></i>
                            <div class="ms-3 my-auto d-none d-xxl-block">
                                <span class="fw-light text-dark">Home</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link text-white d-flex justify-content-center justify-content-xxl-start" href="#list-2">
                            <i class="bi bi-card-list fs-5 text-dark"></i>
                            <div class="ms-3 my-auto d-none d-xxl-block">
                                <span class="fw-light text-dark">Orders</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link text-white d-flex justify-content-center justify-content-xxl-start" href="#list-3">
                            <i class="bi bi-grid fs-5 text-dark"></i>
                            <div class="ms-3 my-auto d-none d-xxl-block">
                                <span class="fw-light text-dark">Items</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link text-white d-flex justify-content-center justify-content-xxl-start" href="#list-4">
                            <i class="bi bi-people fs-5 text-dark"></i>
                            <div class="ms-3 my-auto d-none d-xxl-block">
                                <span class="fw-light text-dark">Users</span>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="dropup">
                    <a href="#" class="d-flex align-items-center bg-dark shadow text-light text-decoration-none dropdown-toggle p-3 rounded-4 rounded-start mt-3" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../assets/images/defaults/rick.jpg" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong class="d-none d-xxl-block fw-light">Admin </strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark rounded-4 rounded-start w-100 my-3 p-0 overflow-hidden shadow">
                        <li><a class="dropdown-item py-2 px-3" href="#"><i class="bi bi-person fs-5 pe-3"></i> Profile</a></li>
                        <li><a class="dropdown-item py-2 px-3" href="#"><i class="bi bi-gear fs-5 pe-3"></i> Settings</a></li>
                        <li><a class="dropdown-item py-2 px-3" href="#"><i class="bi bi-box-arrow-left fs-5 pe-3"></i> Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#sidebarTrigger').click(function() {
        $(".make-abs").fadeToggle();
    });
</script>