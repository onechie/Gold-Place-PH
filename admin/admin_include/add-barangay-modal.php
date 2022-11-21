<?php
if (!defined('ACCESS')) {
    header("location: ../");
}
?>
<!--MODAL - ADMIN PANEL -->
<div class="modal fade" id="add-brgy-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-light lt-space" id="modalLabel">ADD BARANGAY</h5>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body overflow-auto p-4 bg-light" style="max-height: 60vh;">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <label class="form-label" for="brgy-name">Barangay</span></label>
                        <input type="text" class="form-control" id="brgy-name">
                    </div>
                    <div class="col-12 col-sm-6 mb-3">
                        <label class="form-label" for="city">City/Municipality</label>
                        <select class="form-select" aria-label="Default select example" id="city" name="category">
                            <option selected value="">City/Municipality</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="shipping-fee">Shipping fee</span></label>
                        <input type="number" class="form-control" id="shipping-fee">
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-white d-flex justify-content-center justify-content-sm-between px-4">
                <p class="p-0 m-0" id="messageText"></p>
                <button type="submit" class="btn btn-sm btn-danger" id="add-brgy-btn">Add</button>
            </div>
        </div>
    </div>
</div>