<?php
if (!defined('ACCESS')) {
    header("location: ../");
}
?>
<div class="modal fade" id="view-order" tabindex="-1" aria-labelledby="orderLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-white z-high">
                <img height="30" src="../assets/images/defaults/logo-only.png" alt="Logo">
                <h5 class="ps-3 modal-title text-dark fw-normal" id="orderLabel">Order</h5>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light overflow-auto p-0" style="height: 60vh;">

                <div class="w-100 h-100" style="min-width: 800px;">
                    <table class="table table-hover m-0 table-striped">
                        <thead class="sticky-top shadow-sm z-mid">
                            <tr>
                                <th class="p-0">
                                    <div class="row fw-light py-3 fs-7 bg-dark px-4 text-light">
                                        <div class="col-3">Image</div>
                                        <div class="col-5">Name</div>
                                        <div class="col-3">Price</div>
                                        <div class="col-1">Quantity</div>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="order-items">
                            <tr>
                                <td class="p-0">
                                    <div id="order-items h-100">
                                        <div class="px-4 row bg-light fw-light py-2">
                                            <div class="col-3"> <img src='../assets/images/defaults/img3.jpg' class='rounded-3' height='100' width='100' alt=''></div>
                                            <div class="col-5 my-auto">Item name example</div>
                                            <div class="col-3 my-auto">&#8369;<span id='item_price'>1,000</span></div>
                                            <div class="col-1 my-auto">5</div>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <h6 class="fw-light fs-7">Total price :</h6>
                <h6 class="fw-normal fs-7" id="total_price">P0</h6>
                <input type="hidden" id="order_id">
                <div class="d-flex align-items-center fw-light ms-5">
                    Status :
                    <select class="py-1 px-1 rounded-1 fs-7 bg-success w-auto ms-2 border-0 text-light" id="status" name="status">
                        <option value="checking">Checking</option>
                        <option value="processing">Processing</option>
                        <option value="delivered">Delivered</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>