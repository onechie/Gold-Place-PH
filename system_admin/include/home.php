<?php
if (!defined('ACCESS')) {
    header("location: ../");
}
?>
<!--SALES-->
<div class="container-fluid px-xl-4 pt-5 users" id="list-1">
    <h1 class="fs-1 fw-light lt-space pb-4 text-center text-sm-start">DASHBOARD</h1>
    <!--MAIN-->
    <div class="container-fluid p-0">
        <div class="row total-values">
            <div class="col-lg-3 col-sm-6 col-12 mb-4 sm-box px-3">
                <div class="overflow-hidden bg-white shadow rounded-4 h-100 w-100">
                    <div class="p-4 h-75 d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="fw-normal text-warning" id="home-total">0</h4>
                            <p class="m-0">TOTAL USERS</p>
                        </div>
                        <div>
                            <i class="bi bi-people fs-1 text-warning"></i>
                        </div>
                    </div>
                    <div class="bg-warning bg-opacity-100 px-4 h-25 d-flex align-items-center text-light">
                        <!--
                        <p class="fw-light m-0 bg-dark bg-opacity-25 rounded-4 px-2 flex-shrink-0">+<span class="sales-number">0</span></p>
                        <p class="fw-light m-0 ms-2 flex-shrink-0"><i class="bi bi-arrow-up-short sales-arrow"></i><span class="sales-percent">0</span>%</p>
                        -->
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 mb-4 sm-box px-3">
                <div class="overflow-hidden bg-white shadow rounded-4 h-100 w-100">
                    <div class="p-4 h-75 d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="fw-normal text-success" id="home-customer">0</h4>
                            <p class="m-0">CUSTOMERS</p>
                        </div>
                        <div>
                            <i class="bi bi-people fs-1 text-success"></i>
                        </div>
                    </div>
                    <div class="bg-success bg-opacity-100 px-4 h-25 d-flex align-items-center text-light">
                        <!--
                        <p class="fw-light m-0 bg-dark bg-opacity-25 rounded-4 px-2 flex-shrink-0">+<span class="orders-number">0</span></p>
                        <p class="fw-light m-0 ms-2 flex-shrink-0"><i class="bi bi-arrow-up-short orders-arrow"></i><span class="orders-percent">0</span>%</p>
                        -->
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 mb-4 sm-box px-3">
                <div class="overflow-hidden bg-white shadow rounded-4 h-100 w-100">
                    <div class="p-4 h-75 d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="fw-normal text-danger" id="home-driver">0</h4>
                            <p class="m-0">DRIVERS</p>
                        </div>
                        <div>
                            <i class="bi bi-people fs-1 text-danger"></i>
                        </div>
                    </div>
                    <div class="bg-danger bg-opacity-100 px-4 h-25 d-flex align-items-center text-light">
                        <!--
                        <p class="fw-light m-0 bg-dark bg-opacity-25 rounded-4 px-2 flex-shrink-0">+0</p>
                        <p class="fw-light m-0 ms-2 bg-dark bg-opacity-25 rounded-4 px-2 flex-shrink-0">-0</p>
                        -->
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 mb-4 sm-box px-3">
                <div class="overflow-hidden bg-white shadow rounded-4 h-100 w-100">
                    <div class="p-4 h-75 d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="fw-normal text-primary" id="home-admin">0</h4>
                            <p class="m-0">EMPLOYEES</p>
                        </div>
                        <div>
                            <i class="bi bi-people fs-1 text-primary"></i>
                        </div>
                    </div>
                    <div class="bg-primary bg-opacity-100 px-4 h-25 d-flex align-items-center text-light">
                        <!--
                        <p class="fw-light m-0 bg-dark bg-opacity-25 rounded-4 px-2 flex-shrink-0">+0</p>
                        <p class="fw-light m-0 ms-2 flex-shrink-0"><i class="bi bi-arrow-up-short"></i>0%</p>
                        -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>