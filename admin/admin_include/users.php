<?php
if (!defined('ACCESS')) {
    header("location: ../");
}
?>
<!--ORDERS-->
<div class="container-fluid px-xl-4 users" id="list-5">
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
                            <select class="p-0 px-1 ms-1 rounded-1 fs-7 w-auto user-type btn btn-light border text-start">
                                <option selected value="customer">Customer</option>
                                <option value="driver">Driver</option>
                                <?php
                                if ($_SESSION['userType'] == 'super_admin') {
                                    echo "<option value='admin'>Admin</option>
                                    <option value='super_admin'>Super Admin</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="d-flex px-3">
                            <form class="" role="search">
                                <input type="search" class="form-control py-0 fw-light fs-7" id="search-user" placeholder="Search" aria-label="Search">
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
                        <?php
                        if ($_SESSION['userType'] == 'super_admin') {
                            echo "<button type='button' class='btn btn-sm btn-primary btn-control' data-bs-toggle='modal' data-bs-target='#add-user'>Add User</button>";
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>