<?php
if (!defined('ACCESS')) {
    header("location: ../");
}
?>
<!--ORDERS-->
<div class="container-fluid px-xl-4 locations" id="list-3">
    <div class="container-fluid p-0">
        <div class="row">
            <!--RECENT SALES-->
            <div class="container-fluid col-12 px-3 mb-4">
                <div class="bg-white rounded-4 overflow-hidden shadow d-flex flex-column align-items-center">
                    <div class="p-4 shadow-sm w-100 shadow-sm">
                        <P class="lt-space fw-light m-0 text-center text-sm-start">BARANGAY LIST</P>
                    </div>
                    <div class="w-100 m-0 max-h-ex overflow-auto">
                        <div class="w-100 h-100" style="min-width: 600px">
                            <table class="table table-hover table-borderless table-striped fs-7 bg-white">
                                <thead class="sticky-top bg-light z-mid">
                                    <tr class=" align-middle">
                                        <th class="ps-4 py-4" style="width:30%">BARANGAY</th>
                                        <th class="ps-4 py-4" style="width:30%">CITY/MUNICIPALITY</th>
                                        <th class="ps-4 py-4" style="width:25%">SHIPPING FEE</th>
                                        <th class="px-4 py-4" style="width:15%">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody id="barangay-list">
                                    <tr>
                                        <td class='ps-4 py-2'>Test brgy</td>
                                        <td class='ps-4 py-2'>Test city</td>
                                        <td class='ps-4 py-2'>000</td>
                                        <td class='px-4 py-2'><i class="deleteProvince bi bi-trash fs-5 text-danger icon-btn" data-bs-toggle="modal" data-bs-target="#confirm"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="w-100 bg-light p-4 d-flex justify-content-center justify-content-sm-end">
                        <button type="button" id="brgy-add" class="btn btn-sm btn-danger btn-control ms-2" data-bs-toggle="modal" data-bs-target="#add-brgy-modal">Add Barangay</button>
                    </div>
                </div>
            </div>
            <!--RECENT SALES-->
            <div class="container-fluid col-12 col-lg-8 px-3 mb-4">
                <div class="bg-white rounded-4 overflow-hidden shadow d-flex flex-column align-items-center">
                    <div class="p-4 shadow-sm w-100 shadow-sm">
                        <P class="lt-space fw-light m-0 text-center text-sm-start">CITY/MUNICIPALITY LIST</P>
                    </div>
                    <div class="w-100 m-0 max-h-ex overflow-auto">
                        <div class="w-100 h-100" style="min-width: 500px">
                            <table class="table table-hover table-borderless table-striped fs-7 bg-white">
                                <thead class="sticky-top bg-light z-mid">
                                    <tr class=" align-middle">
                                        <th class="ps-4 py-4" style="width:30%">CITY/MUNICIPALITY</th>
                                        <th class="ps-4 py-4" style="width:30%">PROVINCE</th>
                                        <th class="px-4 py-4" style="width:15%">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody id="city-list">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="w-100 bg-light p-4 d-flex justify-content-center justify-content-sm-end">
                        <button type="button" id="city-add" class="btn btn-sm btn-danger btn-control ms-2" data-bs-toggle="modal" data-bs-target="#add-city-modal">Add City</button>
                    </div>
                </div>
            </div>
            <!--RECENT SALES-->
            <div class="container-fluid col-12 col-lg-4 px-3 mb-4">
                <div class="bg-white rounded-4 overflow-hidden shadow d-flex flex-column align-items-center">
                    <div class="p-4 shadow-sm w-100 shadow-sm">
                        <P class="lt-space fw-light m-0 text-center text-sm-start">PROVINCE LIST</P>
                    </div>
                    <div class="w-100 m-0 max-h-ex overflow-auto">
                        <div class="w-100 h-100">
                            <table class="table table-hover table-borderless table-striped fs-7 bg-white">
                                <thead class="sticky-top bg-light z-mid">
                                    <tr class=" align-middle">
                                        <th class="ps-4 py-4" style="width:70%">PROVINCE</th>
                                        <th class="p-4" style="width:30%">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody id="province-list">
                                    <tr>
                                        <td class='ps-4 py-2'>Test 1</td>
                                        <td class='px-4 py-2'><i class="deleteProvince bi bi-trash fs-5 text-danger icon-btn" data-bs-toggle="modal" data-bs-target="#confirm"></td>
                                    </tr>
                                    <tr>
                                        <td class='ps-4 py-2'>Test 2</td>
                                        <td class='px-4 py-2'><i class="deleteProvince bi bi-trash fs-5 text-danger icon-btn" data-bs-toggle="modal" data-bs-target="#confirm"></td>
                                    </tr>
                                    <tr>
                                        <td class='ps-4 py-2'>Test 3</td>
                                        <td class='px-4 py-2'><i class="deleteProvince bi bi-trash fs-5 text-danger icon-btn" data-bs-toggle="modal" data-bs-target="#confirm"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="w-100 bg-light p-4 d-flex justify-content-center justify-content-sm-end">
                        <input type="text" class="form-control fw-light fs-7 py-0" id="province-input" placeholder="Province">
                        <button type="button" id="province-add" class="btn btn-sm btn-danger btn-control ms-2">Add</button>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>