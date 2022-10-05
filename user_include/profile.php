<div class="modal fade" id="profile" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title text-dark" id="modalLabel">Your Profile</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body overflow-auto">
        <div class="container-fluid">
        <div class="row text-center mt-3">
              <div class="col-sm">
                <h3 class="">Profile Photo</h3>
              </div>
            </div>

            <div class="row text-center my-3">
                <div class="col-sm">
                  <img src="./assets/images/defaults/rick.jpg" alt="profile" width="150" height="150" class="rounded-circle">
                </div>
            </div>
            
            <div class="row mb-3">
              <div class="col-sm-4 mx-auto">
                <input class="form-control" type="file">
              </div>
            </div>
                
            <div class="row">
                <div class="col-sm mt-2 form-floating">
                    <input type="text" class="form-control fn" id="floatingInput" placeholder="Firstname" value="<?php echo $firstname?>" disabled>
                    <label class="px-4" for="floatingInput">Firstname</label>
                </div>
                <div class="col-sm mt-2 form-floating">
                    <input type="text" class="form-control fn" id="floatingInput" placeholder="Lastname" value="<?php echo $lastname?>" disabled>
                    <label class="px-4" for="floatingInput">Lastname</label>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-8 mt-2 form-floating">
                    <input type="email" class="form-control fn" id="floatingInput" placeholder="Email" value="<?php echo $email?>" disabled>
                    <label class="px-4" for="floatingInput">Email</label>
                </div>
                <div class="col-sm-4 mt-2 form-floating">
                    <input type="email" class="form-control fn" id="floatingInput" placeholder="Email" value="<?php echo $phone?>">
                    <label class="px-4" for="floatingInput">Phone #</label>
                </div>
            </div>
            <div class="row" >
                <div class="col-sm mt-2 form-floating">
                    <input type="text" class="form-control fn" id="floatingInput" placeholder="Bldg./ House No." value="#000">
                    <label class="px-4" for="floatingInput">Bldg./ House #</label>
                </div>
                <div class="col-sm mt-2 form-floating">
                    <input type="text" class="form-control fn" id="floatingInput" placeholder="Street/Barangay" value="Palapat">
                    <label class="px-4" for="floatingInput">Street/Barangay</label>
                </div>
                <div class="col-sm mt-2 form-floating">
                    <input type="text" class="form-control fn" id="floatingInput" placeholder="Municipality/City" value="Hagonoy">
                    <label class="px-4" for="floatingInput">Municipality/City</label>
                </div>
                <div class="col-sm mt-2 mb-5 form-floating">
                    <input type="text" class="form-control fn" id="floatingInput" placeholder="Province" value="Bulacan">
                    <label class="px-4" for="floatingInput">Province</label>
                </div>
                
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning">Save changes</button>
      </div>
    </div>
  </div>
</div>