<?php
    include './links.php';
?>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title text-light" id="exampleModalLabel">Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm mt-2 form-floating">
                    <input type="text" class="form-control fn" id="floatingInput" placeholder="Firstname" value="Angelo" disabled>
                    <label class="px-4" for="floatingInput">Firstname</label>
                </div>
                <div class="col-sm mt-2 form-floating">
                    <input type="text" class="form-control fn" id="floatingInput" placeholder="Lastname" value="Parole" disabled>
                    <label class="px-4" for="floatingInput">Lastname</label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 mt-2 form-floating">
                    <input type="email" class="form-control fn" id="floatingInput" placeholder="Email" value="angeloparole@admin.com" disabled>
                    <label class="px-4" for="floatingInput">Email</label>
                </div>
                <div class="col-sm-4 mt-2 form-floating">
                    <input type="email" class="form-control fn" id="floatingInput" placeholder="Email" value="09123123123">
                    <label class="px-4" for="floatingInput">Phone #</label>
                </div>
            </div>
            <div class="row">
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
                <div class="col-sm mt-2 form-floating">
                    <input type="text" class="form-control fn" id="floatingInput" placeholder="Province" value="Bulacan">
                    <label class="px-4" for="floatingInput">Province</label>
                </div>
                
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning">Save changes</button>
      </div>
    </div>
  </div>
</div>


            <div class="form-floating">
              <input type="email" class="form-control fn" id="floatingInput" placeholder="Firstname">
              <label for="floatingInput">Firstname</label>
            </div>
            <div class="form-floating">
              <input type="text" class="form-control ln" id="floatingInput" placeholder="Lastname">
              <label for="floatingInput">Lastname</label>
            </div>
            <div class="form-floating">
              <input type="text" class="form-control ea" id="floatingInput" placeholder="name@example.com">
              <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
              <input type="password" class="form-control pw" id="floatingPassword" placeholder="Password">
              <label for="floatingPassword">Password</label>
            </div>