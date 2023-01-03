<!-- ADD ITEM MODAL - ADMIN PANEL -->
<div class="modal fade" id="add-user" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header shadow-sm bg-white">
                <h5 class="modal-title fw-light lt-space" id="modalLabel">ADD USER</h5>
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
                        <label class="form-label" for="phone">Phone <span class='ph-w text-danger'></span></label>
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
                        <label class="form-label" for="password">Password <span class='pw-w text-danger'></span></label>
                        <input type="text" class="form-control" id="password">
                    </div>
                    <div class="col-12 text-end mt-3">
                        <input class="form-check-input me-2" type="checkbox" value="" id="verification_req">
                        <label class="form-check-label" for="verification_req">
                            Verification Required
                        </label>
                    </div>

                </div>
            </div>
            <div class="modal-footer bg-white d-flex justify-content-center justify-content-sm-between px-4">
                <p class="text-danger" id="error_message"></p>
                <button type="submit" class="btn btn-sm btn-warning" id="add-user-btn">Add User</button>
            </div>
        </div>
    </div>
</div>