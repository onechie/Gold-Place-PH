<?php
    if(!defined('ACCESS')) {
    header("location: ../");
    }
?>
<!--SALES-->
<div class="container-fluid px-xl-4 pt-5 sales" id="list-1">
    <h1 class="fs-1 fw-light lt-space pb-4 text-center text-sm-start">DASHBOARD</h1>
    <!--MAIN-->
    <div class="container-fluid p-0">
        <div class="row total-values">
            <div class="col-lg-3 col-sm-6 col-12 mb-4 sm-box px-3">
                <div class="overflow-hidden bg-white shadow rounded-4 h-100 w-100">
                    <div class="p-4 h-75 d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="fw-normal text-warning" id="home-sales">0</h4>
                            <p class="m-0">TOTAL SALES</p>
                        </div>
                        <div>
                            <i class="bi bi-card-checklist fs-1 text-warning"></i>
                        </div>
                    </div>
                    <div class="bg-warning bg-opacity-100 px-4 h-25 d-flex align-items-center text-light">
                        <p class="fw-light m-0 bg-dark bg-opacity-25 rounded-4 px-2 flex-shrink-0">+<span class="sales-number">0</span></p>
                        <p class="fw-light m-0 ms-2 flex-shrink-0"><i class="bi bi-arrow-up-short sales-arrow"></i><span class="sales-percent">0</span>%</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 mb-4 sm-box px-3">
                <div class="overflow-hidden bg-white shadow rounded-4 h-100 w-100">
                    <div class="p-4 h-75 d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="fw-normal text-success" id="home-orders">0</h4>
                            <p class="m-0">TOTAL ORDERS</p>
                        </div>
                        <div>
                            <i class="bi bi-clipboard-check fs-1 text-success"></i>
                        </div>
                    </div>
                    <div class="bg-success bg-opacity-100 px-4 h-25 d-flex align-items-center text-light">
                    <p class="fw-light m-0 bg-dark bg-opacity-25 rounded-4 px-2 flex-shrink-0">+<span class="orders-number">0</span></p>
                        <p class="fw-light m-0 ms-2 flex-shrink-0"><i class="bi bi-arrow-up-short orders-arrow"></i><span class="orders-percent">0</span>%</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 mb-4 sm-box px-3">
                <div class="overflow-hidden bg-white shadow rounded-4 h-100 w-100">
                    <div class="p-4 h-75 d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="fw-normal text-danger" id="home-stocks">0</h4>
                            <p class="m-0">TOTAL STOCKS</p>
                        </div>
                        <div>
                            <i class="bi bi-grid-3x3-gap fs-1 text-danger"></i>
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
                            <h4 class="fw-normal text-primary" id="home-users">0</h4>
                            <p class="m-0">TOTAL USERS</p>
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
    <div class="row">
        <!--GRAPH-->
        <div class="container-fluid col-12 px-3 mb-4">
            <div class="bg-white rounded-4 overflow-hidden shadow d-flex flex-column align-items-center">
                <div class="w-100 p-4 shadow-sm">
                    <P class="lt-space fw-light m-0 p-0 text-center text-sm-start">SALES CHART</P>
                </div>
                <div class="w-100 p-4 d-flex flex-wrap justify-content-center justify-content-sm-between">
                    <div class="px-3 pe-sm-0">
                        <P class=" fw-light m-0 p-0 flex-shrink-0 fs-7">TOTAL SALES <span class="text-warning fw-bold ms-1" id="total-sales">0</span></P>
                    </div>
                    <div class="d-flex">
                        <P class=" fw-light m-0 p-0 flex-shrink-0 fs-7">+<span class="me-1 sales-number">0</span><span class="bg-success bg-opacity-25 rounded-4 pe-1" id="color"><i class="bi bi-arrow-up-short sales-arrow"></i><span class="sales-percent">0</span>%</span></P>
                        <div class="btn-group drop-down ps-2">
                            <a type="button" class="btn p-0 dropdown-toggle bg-none border-0 text-dark fs-7 fw-light" id="main-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                DAILY
                            </a>
                            <ul class="dropdown-menu dropdown-menu-start border-0 p-0 overflow-hidden shadow">
                            <li><button class="dropdown-item text-start fs-7 fw-light" type="button" id="daily">DAILY</button></li>
                                <li><button class="dropdown-item text-start fs-7 fw-light" type="button" id="weekly">WEEKLY</button></li>
                                <li><button class="dropdown-item text-start fs-7 fw-light" type="button" id="monthly">MONTHLY</button></li>
                                <li><button class="dropdown-item text-start fs-7 fw-light" type="button" id="annually">ANNUALLY</button></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="w-100 px-4 py-0 m-0 fix-h">
                    <canvas id="lineChart"></canvas>
                </div>
                <div class="w-100 p-4 d-flex justify-content-center align-items-center">
                    <p class="m-0"><i class="bi bi-square-fill text-warning fs-9"></i> <span class="fs-8"> SALES</span></p>
                </div>
            </div>
        </div>

    </div>
</div>