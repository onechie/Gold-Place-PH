<?php
if (!defined('ACCESS')) {
    header("location: ../");
}
?>
<!--MODAL - ADMIN PANEL -->
<div class="modal fade" id="add-city-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-light lt-space" id="modalLabel">ADD PROVINCE</h5>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body overflow-auto p-4 bg-light" style="max-height: 60vh;">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <label class="form-label" for="city-name">City/Municipality <span class='fn-w text-danger'></span></label>
                        <input type="text" class="form-control" id="city-name">
                    </div>
                    <div class="col-12 col-sm-6 mb-3">
                        <label class="form-label" for="province">Province</label>
                        <select class="form-select" aria-label="Default select example" id="province" name="category">
                            <option selected value="">Province</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-white d-flex justify-content-center justify-content-sm-between px-4">
                <p class="p-0 m-0" id="messageText"></p>
                <button type="submit" class="btn btn-sm btn-danger" id="add-city-btn">Add</button>
            </div>
        </div>
    </div>
</div>