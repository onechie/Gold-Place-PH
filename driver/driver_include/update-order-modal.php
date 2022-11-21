<?php
if (!defined('ACCESS')) {
    header("location: ../");
}
?>
<div class="modal fade" id="update-order" tabindex="-1" aria-labelledby="orderLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-white z-high">
                <img height="30" src="../assets/images/defaults/logo-only.png" alt="Logo">
                <h5 class="ps-3 modal-title text-dark fw-normal" id="orderLabel">Update Order</h5>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light overflow-auto p-3" style="height: 60vh;">
                <p class='fs-5'>ID : <span class='fw-normal text-success order-id'>0Z014012X4</span></p>
                <p>Items : <span class='fw-200 order-count'>4</span></p>
                <ul class='fw-200 order-items'>
                    <li>text item x1</li>
                    <li>text item x2</li>
                    <li>text item x3</li>
                    <li>text item x4</li>
                </ul>
                <p>
                    Items Price :
                    <span class='fw-200 text-success items-price'>

                    </span>
                </p>
                <p>
                    Shipping Fee :
                    <span class='fw-200 text-danger shipping-fee'>

                    </span>
                </p>
                <p>Address : <span class='fw-200 order-address'>test address jupiter malolos bulacan</span></p>
                <p>Contact no : <span class='fw-200 order-contact'>908124724247</span></p>
                <p>Name : <span class='fw-200 order-name'>test user</span></p>
                <p>
                    Status :
                    <select class="p-1 rounded-1 fs-7 btn btn-dark w-auto border-0 text-light order-status">
                        <option value="checking">Checking</option>
                        <option value="processing">Processing</option>
                        <option value="delivered">Delivered</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </p>
                <p>Message <span class='fw-200'>(optional)</span> :</p>
                <textarea class="form-control h-auto fw-light mb-2 order-message" style="min-height:200px;"></textarea>
            </div>
            <div class="modal-footer">
                <h6 class="fw-light fs-7">Total price :</h6>
                <h6 class="fw-normal fs-7 text-success total-price">P0</h6>
                <input type="hidden" id="order-id">
                <button type='button' class='ms-5 btn btn-sm btn-success update-button'>Update</button>
            </div>
        </div>
    </div>
</div>