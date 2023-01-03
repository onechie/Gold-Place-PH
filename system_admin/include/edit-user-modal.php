<?php
if (!defined('ACCESS')) {
    header("location: ../");
}
?>
<!-- ADD ITEM MODAL - ADMIN PANEL -->
<div class="modal fade" id="edit-user" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header shadow-sm bg-white">
                <h5 class="modal-title fw-light lt-space" id="modalLabel">EDIT USER</h5>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body overflow-auto p-4 bg-light" style="max-height: 60vh;">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <label class="form-label" for="first-name">First name <span class='fn-w text-danger'></span></label>
                        <input type="text" class="form-control" id="first-name">
                    </div>
                    <div class="col-12 col-sm-6">
                        <label class="form-label" for="last-name">Last name <span class='ln-w text-danger'></span></label>
                        <input type="text" class="form-control" id="last-name">
                    </div>
                    <div class="col-12 col-sm-6">
                        <label class="form-label" for="email">Email <span class='em-w text-danger'></span></label>
                        <input type="email" class="form-control" id="email">
                    </div>
                    <div class="col-12 col-sm-6">
                        <label class="form-label" for="phone">Phone <span class='ph-w text-danger'> </span></label>
                        <input class="form-control" id="phone">
                    </div>

                    <div class="col-12 col-sm-6">
                        <label class="form-label" for="user-type">Type</label>
                        <select class="form-select" aria-label="Default select example" id="user-type">
                            <option selected value="admin">Admin</option>
                            <option value="customer">Customer</option>
                            <option value="driver">Driver</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label class="form-label" for="verified">Verified</label>
                        <select class="form-select" aria-label="Default select example" id="verified">
                            <option selected value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label class="form-label" for="status">Status</label>
                        <select class="form-select" aria-label="Default select example" id="status">
                            <option selected value="active">Active</option>
                            <option value="blocked">Blocked</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-white d-flex justify-content-center justify-content-sm-end px-4">
                <input type="hidden" id="user_id">
                <button type="submit" class="btn btn-sm btn-success" id="edit-user-btn">Update</button>
            </div>
        </div>
    </div>
</div>