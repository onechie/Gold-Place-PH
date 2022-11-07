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
                <h5 class="ps-3 modal-title text-dark fw-normal" id="orderLabel">View Order</h5>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light overflow-auto p-3" style="height: 60vh;">
            </div>
            <div class="modal-footer">
                <h6 class="fw-light fs-7">Total price :</h6>
                <h6 class="fw-normal fs-7 text-success total-price">P0</h6>
            </div>
        </div>
    </div>
</div>