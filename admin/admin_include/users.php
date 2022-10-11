<?php
    if(!defined('ACCESS')) {
    header("location: ../");
    }
?>
<!--ORDERS-->
<div class="container-fluid px-xl-4 users" id="list-4">
    <div class="container-fluid p-0">
        <div class="row">
            <!--RECENT SALES-->
            <div class="container-fluid col-12 px-3 mb-4">
                <div class="bg-white rounded-4 overflow-hidden shadow d-flex flex-column align-items-center">
                    <div class="p-4 shadow-sm w-100 shadow-sm d-flex justify-content-center justify-content-sm-between">
                        <P class="lt-space fw-light m-0">USERS LIST</P>
                        <i class="bi bi-arrow-clockwise ms-3 icon-btn" id="refresh-users"></i>
                    </div>
                    <div class="p-4 shadow-sm w-100 bg-light-sm d-flex justify-content-center justify-content-sm-between flex-wrap">
                        <div class="d-flex">
                            <P class="fw-normal m-0 text-center text-sm-start fs-7 flex-shrink-0 px-3 px-sm-0 pe-sm-3">SORT BY</P>
                            <div class="btn-group drop-down ps-2">
                                <a type="button" class="btn p-0 dropdown-toggle bg-none border-0 text-dark fs-7 fw-light" data-bs-toggle="dropdown" aria-expanded="false">
                                    DEFAULT
                                </a>
                                <ul class="dropdown-menu dropdown-menu-start border-0 p-0 overflow-hidden shadow">
                                    <li><button class="dropdown-item text-start fs-7 fw-light" type="button">TOP BUYERS</button></li>
                                    <li><button class="dropdown-item text-start fs-7 fw-light" type="button">ADMINS</button></li>
                                </ul>
                            </div>
                        </div>
                        <div class="d-flex px-3">
                            <form class="" role="search">
                                <input type="search" class="form-control py-0 fw-light fs-7" id="search-user"placeholder="Search" aria-label="Search">
                            </form>
                        </div>
                    </div>
                    <div class="w-100 m-0 max-h-ex overflow-auto">
                        <div class="w-100 h-100" style="min-width: 800px">
                            <table class="table table-hover table-borderless table-striped fs-7 bg-white">
                                <thead class="sticky-top bg-light z-mid bg-dark text-light">
                                    <tr class=" align-middle">
                                        <th class="ps-4 py-4" style="width:10%"><span id="sort_user_id"><i class="px-1 py-3 bi bi-arrow-down-up"></i>ID</span></th>
                                        <th class="ps-4" style="width:30%"><span id="sort_user_name"><i class="px-1 py-3 bi bi-arrow-down-up"></i></span>NAME</th>
                                        <th class="ps-4" style="width:25%"><span id="sort_user_email"><i class="px-1 py-3 bi bi-arrow-down-up"></i></span>EMAIL</th>
                                        <th class="ps-4" style="width:15%">PHONE</th>
                                        <th class="ps-4" style="width:20%"><span id="sort_user_purchased"><i class="px-1 py-3 bi bi-arrow-down-up"></i></span>PURCHASED</th>
                                        <th class="px-4" style="width:10%">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody id="users-list">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="w-100 bg-light p-4 d-flex justify-content-center justify-content-sm-end">
                        <button type="button" class="btn btn-sm btn-primary btn-control">Add Admin</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>