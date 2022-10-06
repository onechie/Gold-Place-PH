<?php
    if(!defined('ACCESS')) {
    header("location: dashboard.php");
    }
?>
<!--ORDERS-->
<div class="container-fluid px-xl-4 orders" id="list-2">
    <div class="container-fluid p-0">
        <div class="row">
            <!--GRAPH-->
            <div class="container-fluid col-12 col-lg-6 px-3 mb-4">
                <div class="bg-white rounded-4 overflow-hidden shadow d-flex flex-column align-items-center">
                    <div class="w-100 p-4 shadow-sm">
                        <P class="lt-space fw-light m-0 p-0 text-center text-sm-start">ORDERS CHART</P>
                    </div>
                    <div class="w-100 p-4 d-flex flex-wrap justify-content-center justify-content-sm-between">
                        <div class="px-3 pe-sm-0">
                            <P class=" fw-light m-0 p-0 flex-shrink-0 fs-7">TOTAL ORDERS <span class="text-success fw-bold" id="total-orders">10,000</span></P>
                        </div>
                        <div class="d-flex">
                            <P class=" fw-light m-0 p-0 flex-shrink-0 fs-7">+0<span class="bg-success bg-opacity-25 rounded-4 pe-1"><i class="bi bi-arrow-up-short"></i>0%</span></P>
                            <div class="btn-group drop-down ps-2">
                                <a type="button" class="btn p-0 dropdown-toggle bg-none border-0 text-dark fs-7 fw-light" id="main-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    TODAY
                                </a>
                                <ul class="dropdown-menu dropdown-menu-start border-0 p-0 overflow-hidden shadow">
                                    <li><button class="dropdown-item text-start fs-7 fw-light" type="button" id="daily">TODAY</button></li>
                                    <li><button class="dropdown-item text-start fs-7 fw-light" type="button" id="weekly">THIS WEEK</button></li>
                                    <li"><button class="dropdown-item text-start fs-7 fw-light" type="button" id="monthly">THIS MONTH</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 px-4 px-sm-4 py-0 m-0 max-h d-flex justify-content-center">
                        <div class="w-100 p-0 m-0 max-w-for-pie max-h">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                    <div class="w-100 p-4 d-flex justify-content-center align-items-center flex-wrap">
                        <p class="m-0 px-3"><i class="bi bi-square-fill color-cancelled fs-9"></i> <span class="fs-8"> CANCELLED</span></p>
                        <p class="m-0 px-3"><i class="bi bi-square-fill color-processing fs-9"></i> <span class="fs-8"> PROCESSING</span></p>
                        <p class="m-0 px-3"><i class="bi bi-square-fill color-delivered fs-9"></i> <span class="fs-8"> DELIVERED</span></p>
                    </div>
                </div>
            </div>
            <!--RECENT SALES-->
            <div class="container-fluid col-12 col-lg-6 px-3 mb-4">
                <div class="bg-white rounded-4 overflow-hidden shadow d-flex flex-column align-items-center">
                    <div class="p-4 shadow-sm w-100 shadow-sm">
                        <P class="lt-space fw-light m-0 text-center text-sm-start">RECENT ORDERS</P>
                    </div>
                    <div class="w-100 m-0 max-h-ex overflow-auto">
                        <div class="w-100 h-100" style="min-width: 750px">
                            <table class="table table-hover table-borderless table-striped fs-7 bg-white">
                                <thead class="sticky-top bg-light z-mid">
                                    <tr class=" align-middle">
                                    <th class="ps-4 py-4" style="width:40%">NAME</th>
                                    <th class="ps-4 py-4" style="width:15%">ITEM ID</th>
                                    <th class="ps-4 py-4" style="width:10%">QTY</th>
                                    <th class="ps-4 py-4" style="width:10%">PRICE</th>
                                    <th class="ps-4 py-4" style="width:15%">STATUS</th>
                                    <th class="px-4 py-4" style="width:10%">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="align-middle">
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <span class="position-relative rounded-5 bg-white shadow-sm me-3" style="width:50px; height:50px">
                                                    <img class="position-absolute m-1 bg-primary rounded-5" src="../assets/images/defaults/rick.jpg" alt="" style="width:42px; height:42px">
                                                </span>
                                                <div class="">
                                                    <strong>Angelo Parole</strong>
                                                    <br>
                                                    <span class="text-muted fs-7">angeloparole@gmail.com</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="ps-4">9</td>
                                        <td class="ps-4">1</td>
                                        <td class="ps-4"><strong>P4,000</strong></td>
                                        <td class="ps-4">Processing</td>
                                        <td class="px-4">
                                            <a class="text-success" href=""><i class="bi bi-eye fs-3"></i></a>
                                        </td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <span class="position-relative rounded-5 bg-white shadow-sm me-3" style="width:50px; height:50px">
                                                    <img class="position-absolute m-1 bg-primary rounded-5" src="../assets/images/defaults/rick.jpg" alt="" style="width:42px; height:42px">
                                                </span>
                                                <div class="">
                                                    <strong>Angelo Parole</strong>
                                                    <br>
                                                    <span class="text-muted fs-7">angeloparole@gmail.com</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="ps-4">9</td>
                                        <td class="ps-4">1</td>
                                        <td class="ps-4"><strong>P4,000</strong></td>
                                        <td class="ps-4">Processing</td>
                                        <td class="px-4">
                                            <a class="text-success" href=""><i class="bi bi-eye fs-3"></i></a>
                                        </td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <span class="position-relative rounded-5 bg-white shadow-sm me-3" style="width:50px; height:50px">
                                                    <img class="position-absolute m-1 bg-primary rounded-5" src="../assets/images/defaults/rick.jpg" alt="" style="width:42px; height:42px">
                                                </span>
                                                <div class="">
                                                    <strong>Angelo Parole</strong>
                                                    <br>
                                                    <span class="text-muted fs-7">angeloparole@gmail.com</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="ps-4">9</td>
                                        <td class="ps-4">1</td>
                                        <td class="ps-4"><strong>P4,000</strong></td>
                                        <td class="ps-4">Processing</td>
                                        <td class="px-4">
                                            <a class="text-success" href=""><i class="bi bi-eye fs-3"></i></a>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="w-100 bg-light p-4">
                        <p class="fw-light m-0 lt-space text-center text-sm-start m-0"><i class="bi bi-clock-history"></i></i></p>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>