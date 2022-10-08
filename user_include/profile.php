<form action="" method="post" enctype="multipart/form-data" id="update-profile">
  <div class="modal fade" id="profile" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-warning z-high">
        <img height="30" src="./assets/images/defaults/logo-only-black.png" alt="Logo">
        <h5 class="ps-3 modal-title text-dark fw-normal" id="cartLabel">Your Profile</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4 overflow-auto bg-light">
        <div class="row">
          <div class="col-12 d-flex flex-column flex-sm-row justify-content-center justify-content-sm-start align-items-center mb-3">
            <div class='ratio ratio-1x1 bg-light shadow rounded-circle overflow-hidden position-relative' style='max-width: 150px;'>
              <div class="position-absolute h-100 w-100 d-flex align-items-end" id="upload-container">
                <div class="z-highest w-100 h-75 opacity-0 position-absolute align-self-start"></div>
                <input class="position-absolute z-high file-upload" accept="image/*" type="file" id="imageInput" style="height: 50%; width: 100%; opacity:0;" name="images[]">
                <div class="bg-white z-mid bg-opacity-75 w-100 h-25 upload text-center position-absolute">
                  <i class="bi bi-upload fs-4 opacity-100 z-mid"></i>
                </div>
              </div>
              <div class='ratio ratio-1x1 rounded-circle overflow-hidden image-container' style='max-width: 150px;'>
                <img id="image" src="" alt="profile" class="inputImages">
             </div>
            </div>
            <div class="text-center text-sm-start">
              <h3 class="px-3 py-2 m-0 fw-light text-capitalize" id="name">Firstname Lastname</h3>
              <p class="px-3 py-0 fw-200 m-0" id="email">example@email.com</p>
              <p class="px-3 py-0 fw-200 m-0" id="phone">09000000000</p>
              <input type="hidden" value="update_profile" name="requestType">
            </div>
          </div>
          <div class="col-12 col-sm-6 mt-2 form-floating">
            <input type="text" class="form-control fn" id="address_number" name="number" placeholder="Bldg./ House No." value="">
            <label class="px-4" for="address_number">Bldg./ House #</label>
          </div>
          <div class="col-12 col-sm-6 mt-2 form-floating">
            <input type="text" class="form-control fn" id="address_street" name="street" placeholder="Street/Barangay" value="">
            <label class="px-4" for="address_street">Street/Barangay</label>
          </div>
          <div class="col-12 col-sm-6 mt-2 form-floating">
            <select class="form-select" id="address_city" name="city" value="">

            </select>
            <label class="px-4" for="address_city">Municipality/City</label>
          </div>
          <div class="col-12 col-sm-6 mt-2 mb-5 form-floating">
            <select class="form-select" id="address_province" name="province" value="">

            </select>
            <label class="px-4" for="address_province">Province</label>
          </div>
          <div class="col-12 mb-4 sm-box px-3">
            <div class="overflow-hidden bg-white shadow-sm rounded-4 h-100 w-100">
              <div class="p-4 h-100 d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="fw-normal" id="total">0</h4>
                  <p class="m-0">TOTAL ORDERS</p>
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
                  <p class="m-0">RECEIVED</p>
                </div>
                <div>
                  <i class="bi bi-bag-plus fs-1"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-warning" id="save_profile">Save changes</button>
      </div>
    </div>
  </div>
</div>
</form>