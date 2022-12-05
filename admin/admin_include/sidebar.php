<?php
if (!defined('ACCESS')) {
    header("location: ../");
}
?>
<!--SIDE BAR-->
<div>
    <a class="px-4 d-flex position-absolute d-sm-none align-items-center justify-content-center text-decoration-none shadow rounded-4 rounded-start p-3 bg-white test z-highest" type="button" id="sidebarTrigger">
        <img src="../assets/images/defaults/logo-only.png" height="40" width="40" alt="">
    </a>
    <div class="pe-3 h-100 z-high py-3 make-abs">
        <div class="h-100 py-5">
            <div class="d-flex flex-column flex-shrink-0 h-100 test">
                <a class="d-none d-sm-flex align-items-center justify-content-start text-decoration-none shadow rounded-4 rounded-start p-3 bg-white">
                    <img src="../assets/images/defaults/logo-only.png" height="40" width="40" alt="">
                    <span class="ms-1 my-auto text-center d-none d-xxl-block text-muted">Management</span>
                </a>
                <ul class="nav nav-pills flex-column mb-auto bg-white rounded-4 rounded-start mt-4 mt-sm-3 shadow overflow-hidden flex-shrink-0 p">
                    <li class="nav-item">
                        <a class="nav-link text-white d-flex justify-content-center justify-content-xxl-start px-4" href="#list-1">
                            <i class="bi bi-house-door fs-5 text-dark"></i>
                            <div class="ms-3 my-auto d-none d-xxl-block">
                                <span class="fw-light text-dark">Home</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link text-white d-flex justify-content-center justify-content-xxl-start px-4" href="#list-2">
                            <i class="bi bi-card-list fs-5 text-dark"></i>
                            <div class="ms-3 my-auto d-none d-xxl-block">
                                <span class="fw-light text-dark">Orders</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link text-white d-flex justify-content-center justify-content-xxl-start px-4" href="#list-3">
                            <i class="bi bi-geo-alt fs-5 text-dark"></i>
                            <div class="ms-3 my-auto d-none d-xxl-block">
                                <span class="fw-light text-dark">Locations</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link text-white d-flex justify-content-center justify-content-xxl-start px-4" href="#list-4">
                            <i class="bi bi-grid fs-5 text-dark"></i>
                            <div class="ms-3 my-auto d-none d-xxl-block">
                                <span class="fw-light text-dark">Items</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link text-white d-flex justify-content-center justify-content-xxl-start px-4" href="#list-5">
                            <i class="bi bi-people fs-5 text-dark"></i>
                            <div class="ms-3 my-auto d-none d-xxl-block">
                                <span class="fw-light text-dark">Users</span>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="dropup">
                    <a href="#" class="d-flex align-items-center bg-dark shadow text-light text-decoration-none dropdown-toggle p-3 rounded-4 rounded-start mt-3" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../assets/images/defaults/default-profile.png" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong class="d-none d-xxl-block fw-light"><?php 
                        if($_SESSION['userType'] == 'super_admin'){
                            echo 'Super Admin';
                        }
                        if($_SESSION['userType'] == 'admin'){
                            echo 'Admin';
                        }
                        
                        
                        ?></strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark rounded-4 rounded-start w-100 my-3 p-0 overflow-hidden shadow">
                        <!--
                        <li><a class="dropdown-item py-2 px-4"><i class="bi bi-person fs-5 pe-2"></i> Profile</a></li>
                        <li><a class="dropdown-item py-2 px-4"><i class="bi bi-gear fs-5 pe-2"></i> Settings</a></li>
                        -->
                        <li><a class="dropdown-item py-2 px-4" id="logout-a"><i class="bi bi-box-arrow-left fs-5 pe-2"></i> Sign out</a></li>
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

    $(window).resize(function() {
        if (window.innerWidth > 576 && $(".make-abs").is(":hidden")) {
            $(".make-abs").show();
        }
    });
</script>