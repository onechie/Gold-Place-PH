<?php
    if(!defined('ACCESS')) {
    header("location: ../");
    }
?>
<!-- ADD ITEM MODAL - ADMIN PANEL -->
<div class="modal fade" id="users" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header shadow-sm bg-white">
        <h5 class="modal-title fw-light lt-space" id="modalLabel">VIEW USER</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body overflow-auto p-4 bg-light" style="max-height: 60vh;">
          <div class="row">
            <div class="col-12 d-flex flex-column flex-sm-row justify-content-center justify-content-sm-start align-items-center mb-3">
              <img id="image" src="" alt="profile" width="150" height="150" class="rounded-circle">
              <div class="text-center text-sm-start">
                <h3 class="px-3 py-2 m-0 fw-light text-capitalize" id="name">Firstname Lastname</h3>
                <p class="px-3 py-0 fw-200 m-0" id="email">example@email.com</p>
                <p class="px-3 py-0 fw-200 m-0" id="phone">09000000000</p>
              </div>
            </div>
            <div class="col-12 mb-4 sm-box px-3">
                <div class="overflow-hidden bg-white shadow-sm rounded-4 h-100 w-100">
                    <div class="p-4 h-100 d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="fw-normal" id="total">0</h4>
                            <p class="m-0 total">TOTAL ORDERS</p>
                        </div>
                        <div>
                            <i class="bi bi-card-checklist fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-12 mb-4 sm-box px-3">
                <div class="overflow-hidden bg-white shadow-sm rounded-4 h-100 w-100">
                    <div class="p-4 h-100 d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="fw-normal" id="cancelled">0</h4>
                            <p class="m-0">CANCELLED</p>
                        </div>
                        <div>
                            <i class="bi bi-bag-dash fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-12 mb-4 sm-box px-3">
                <div class="overflow-hidden bg-white shadow-sm rounded-4 h-100 w-100">
                    <div class="p-4 h-100 d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="fw-normal" id="delivered">0</h4>
                            <p class="m-0">DELIVERED</p>
                        </div>
                        <div>
                            <i class="bi bi-bag-plus fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
          </div>
      </div>
      <div class="modal-footer bg-white d-flex justify-content-center justify-content-sm-end px-4">
        <button type="submit" class="btn btn-sm btn-outline-primary" id="edit-item-btn" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>