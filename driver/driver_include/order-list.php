<?php
if (!defined('ACCESS')) {
    header("location: ../");
}
?>
<!--ORDERS-->
<div class="container-fluid px-xl-4 px-0 order-handler">
    <div class="container-fluid p-0 pt-5">
        <!--RECENT SALES-->
        <div class="container-fluid p-0 my-4">
            <div class="bg-white rounded-4 overflow-hidden shadow d-flex flex-column align-items-center">
                <div class="px-4 py-3 shadow-sm d-flex w-100 justify-content-center justify-content-sm-between">
                    <P class="lt-space fw-light m-0 text-center text-sm-start">PROCESSING</P>
                    <i class="bi bi-arrow-clockwise ms-3 icon-btn" id="refresh-items"></i>
                </div>
                <div class="w-100 m-0 max-h-ex overflow-auto">
                    <div class="w-100 h-100">
                        <table class="table table-hover table-borderless table-striped fs-7 bg-white">
                            <thead class="sticky-top bg-dark text-light z-mid">
                                <tr class=" align-middle">
                                    <th class="ps-4 py-3" style="width:80%">ID</th>
                                    <th class="px-4 py-3" style="width:20%"><i class="bi bi-list"></i></th>
                                </tr>
                            </thead>
                            <tbody id="order-list">
                                <tr class="align-middle">
                                    <td class="ps-4 text-wrap order-id">00000000</td>
                                    <td class="px-4">
                                        <i class="text-success icon-btn bi bi-pencil-square fs-5 view-order-btn" data-bs-toggle='modal' data-bs-target='#view-order'></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="w-100 bg-white p-4">
                </div>
            </div>
        </div>
    </div>
</div>