<?php
if (!defined('ACCESS')) {
    header("location: ../");
}
?>
<div class="modal fade" id="view-proof-modal" tabindex="-1" aria-labelledby="orderLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-white z-high">
                <img height="30" src="../assets/images/defaults/logo-only.png" alt="Logo">
                <h5 class="ps-3 modal-title text-dark fw-normal" id="orderLabel">Proof of Delivery</h5>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light overflow-auto p-3" style="height: 60vh;">
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
