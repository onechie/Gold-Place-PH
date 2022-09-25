<!--ORDERS-->
<div class="container-fluid px-xl-4" id="list-3">
    <div class="container-fluid p-0">
        <div class="row">
            <!--RECENT SALES-->
            <div class="container-fluid col-12 px-3 mb-4">
                <div class="bg-white rounded-4 overflow-hidden shadow d-flex flex-column align-items-center">
                    <div class="p-4 shadow-sm w-100 shadow-sm z-high d-flex justify-content-center justify-content-sm-between">
                        <P class="lt-space fw-light m-0">ITEMS LIST</P>
                        <i class="bi bi-arrow-clockwise ms-3" id="refresh-items"></i>
                    </div>
                    <div class="p-4 shadow-sm w-100 bg-light-sm d-flex justify-content-center justify-content-sm-between flex-wrap">
                        <div class="d-flex">
                            <P class="fw-normal m-0 text-center text-sm-start fs-7 flex-shrink-0 px-3 px-sm-0 pe-sm-3">SORT BY</P>
                            <div class="btn-group drop-down ps-2">
                                <a type="button" class="btn p-0 dropdown-toggle bg-none border-0 text-dark fs-7 fw-light" data-bs-toggle="dropdown" aria-expanded="false">
                                    DEFAULT
                                </a>
                                <ul class="dropdown-menu dropdown-menu-start border-0 p-0 overflow-hidden shadow">
                                    <li><button class="dropdown-item text-start fs-7 fw-light" type="button">STOCK</button></li>
                                    <li><button class="dropdown-item text-start fs-7 fw-light" type="button">SOLD</button></li>
                                </ul>
                            </div>
                        </div>
                        <div class="d-flex px-3">
                            <form class="" role="search">
                                <input type="search" class="form-control py-0 fw-light fs-7" placeholder="Search..." aria-label="Search">
                            </form>
                        </div>
                    </div>
                    <div class="w-100 m-0 max-h-ex overflow-auto">
                        <div class="w-100 h-100" style="min-width: 800px">
                            <table class="table table-hover table-borderless table-striped fs-7 bg-white">
                                <thead class="sticky-top bg-light z-mid bg-dark text-light">
                                    <tr class=" align-middle">
                                        <th class="ps-4 py-4" style="width:10%">ID</th>
                                        <th class="ps-4" style="width:30%">NAME</th>
                                        <th class="ps-4" style="width:30%">STOCK</th>
                                        <th class="ps-4" style="width:10%">PRICE</th>
                                        <th class="ps-4" style="width:10%">SOLD</th>
                                        <th class="ps-4" style="width:10%">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody id="item-list">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="w-100 bg-light p-4 d-flex justify-content-center justify-content-sm-end">
                        <button type="button" id="addItemMainButton" class="btn btn-sm btn-danger btn-control" data-bs-toggle="modal" data-bs-target="#items">Add Item</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>