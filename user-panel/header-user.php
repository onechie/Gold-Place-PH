<?php
  include '../script/server/database.php';

  $userid = $_SESSION['userId'];
  $sql = "SELECT * FROM user WHERE id = '$userid'";
  $result = mysqli_query($conn, $sql);
  $firstname = NULL;
  $lastname = NULL;
  $email = NULL;
  $phone = NULL;

  if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result)) {
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $email = $row['email'];
        $phone = $row['phone'];
      }
  }
?>
<script src="../script/client/logout.js" type="text/javascript"></script>
<link rel="stylesheet" href="../css/index.css">
<nav class="navbar navbar-expand-lg navbar-light bg-warning gradient shadow fixed-top" aria-label="Fourth navbar example">
  <div class="container-xxl">
    <a class="navbar-brand" href="#">
      <img height="40" src="../assets/images/compressed/logo-only-black.png" alt="Logo">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Contact us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">About</a>
        </li>
      </ul>
      
        <form class="col-12 col-md-auto mb-3 mb-md-0 me-md-3" role="search">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
        </form>

        <div class="dropdown text-start">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../assets/images/compressed/rick.jpg" alt="profile" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small bg-dark dropdown-menu-xxl-start dropdown-menu-md-end">
            <li><a class="dropdown-item text-light" href="#" data-bs-toggle="modal" data-bs-target="#cart"><i class="bi bi-bag fs-5"></i> Cart</a></li>
            <li><a class="dropdown-item text-light" href="#" data-bs-toggle="modal" data-bs-target="#order"><i class="bi bi-card-checklist fs-5"></i> Orders</a></li>
            <li><a class="dropdown-item text-light" href="#" data-bs-toggle="modal" data-bs-target="#profile"><i class="bi bi-person fs-5"></i> Profile</a></li>
            <li><a class="dropdown-item text-light" href="#"><i class="bi bi-gear fs-5"></i> Settings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><button class="w-100 text-start btn btn-lg btn-dark fs-6 py-1 " id="logout-button" type="button"><i class="bi bi-box-arrow-left fs-5" id="#logout-button"></i> Sign-out</button></li>
          </ul>
        </div>
    </div>
  </div>
</nav>

<!-- User Info Modal -->
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
                  <img src="../assets/images/compressed/rick.jpg" alt="profile" width="150" height="150" class="rounded-circle">
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

<!-- User Cart Modal -->
<div class="modal fade" id="cart" tabindex="-1" aria-labelledby="cartLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title text-dark" id="cartLabel">Your Cart</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-light overflow-auto p-0" style="max-height: 60vh;">
        <div class="container-fluid p-0">
          <table class="table table-hover m-0">
            <thead class="sticky-top disabled-white ">
              <tr>
                <th class="text-center align-middle" scope="col" height="60"><input class="form-check-input" type="checkbox" value=""></th>
                <th class="text-center align-middle" scope="col">Image</th>
                <th class="text-center align-middle" scope="col">Name</th>
                <th class="text-center align-middle" scope="col">Price</th>
                <th class="text-center align-middle" scope="col">Quantity</th>
                <th class="text-center align-middle" scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center align-middle"><input class="form-check-input" type="checkbox" value=""></td>
                <td class="text-center align-middle"><img src="../assets/images/compressed/img2.jpg" height="100" width="100" alt=""></td>
                <td class="text-center align-middle">Pendant of Seven eleven</td>
                <td class="text-center align-middle">P 3,000</td>
                <td class="text-center align-middle"><input class="form-control input-qty mx-auto" type="number" value="1"></td>
                <td class="text-center align-middle"><button type="button" class="btn btn-warning me-2  ">View</button><button type="button" class="btn btn-dark">Remove</button></td>
              </tr>
              <tr>
                <td class="text-center align-middle"><input class="form-check-input" type="checkbox" value=""></td>
                <td class="text-center align-middle"><img src="../assets/images/compressed/img2.jpg" height="100" width="100" alt=""></td>
                <td class="text-center align-middle">Pendant of Seven eleven</td>
                <td class="text-center align-middle">P 3,000</td>
                <td class="text-center align-middle"><input class="form-control input-qty mx-auto" type="number" value="1"></td>
                <td class="text-center align-middle"><button type="button" class="btn btn-warning me-2  ">View</button><button type="button" class="btn btn-dark">Remove</button></td>
              </tr>
              <tr>
                <td class="text-center align-middle"><input class="form-check-input" type="checkbox" value=""></td>
                <td class="text-center align-middle"><img src="../assets/images/compressed/img2.jpg" height="100" width="100" alt=""></td>
                <td class="text-center align-middle">Pendant of Seven eleven</td>
                <td class="text-center align-middle">P 3,000</td>
                <td class="text-center align-middle"><input class="form-control input-qty mx-auto" type="number" value="1"></td>
                <td class="text-center align-middle"><button type="button" class="btn btn-warning me-2  ">View</button><button type="button" class="btn btn-dark">Remove</button></td>
              </tr>
              <tr>
                <td class="text-center align-middle"><input class="form-check-input" type="checkbox" value=""></td>
                <td class="text-center align-middle"><img src="../assets/images/compressed/img2.jpg" height="100" width="100" alt=""></td>
                <td class="text-center align-middle">Pendant of Seven eleven</td>
                <td class="text-center align-middle">P 3,000</td>
                <td class="text-center align-middle"><input class="form-control input-qty mx-auto" type="number" value="1"></td>
                <td class="text-center align-middle"><button type="button" class="btn btn-warning me-2  ">View</button><button type="button" class="btn btn-dark">Remove</button></td>
              </tr>
              <tr>
                <td class="text-center align-middle"><input class="form-check-input" type="checkbox" value=""></td>
                <td class="text-center align-middle"><img src="../assets/images/compressed/img2.jpg" height="100" width="100" alt=""></td>
                <td class="text-center align-middle">Pendant of Seven eleven</td>
                <td class="text-center align-middle">P 3,000</td>
                <td class="text-center align-middle"><input class="form-control input-qty mx-auto" type="number" value="1"></td>
                <td class="text-center align-middle"><button type="button" class="btn btn-warning me-2  ">View</button><button type="button" class="btn btn-dark">Remove</button></td>
              </tr>
            </tbody>

          </table>
        </div>
      </div>
      <div class="modal-footer">
        <h6>Total value of selected items :</h6>
        <h6>P0</h6>
        <button type="button" class="btn btn-warning ms-5" data-bs-dismiss="modal">Checkout</button>
        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Remove</button>
      </div>
    </div>
  </div>
</div>

<!-- User Order Modal -->
<div class="modal fade" id="order" tabindex="-1" aria-labelledby="orderLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title text-dark" id="orderLabel">Your Order</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-light overflow-auto p-0" style="max-height: 60vh;">
        <div class="container-fluid p-0">
        <table class="table table-hover m-0">
          <thead class="sticky-top disabled-white ">
            <tr>
              <th class="text-center align-middle" scope="col" height="60">#</th>
              <th class="text-center align-middle" scope="col">Image</th>
              <th class="text-center align-middle" scope="col">Name</th>
              <th class="text-center align-middle" scope="col">Price</th>
              <th class="text-center align-middle" scope="col">Quantity</th>
              <th class="text-center align-middle" scope="col">Status</th>
              <th class="text-center align-middle" scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-center align-middle" scope="row">1</td>
              <td class="text-center align-middle"><img src="../assets/images/compressed/img1.jpg" height="100" width="100" alt=""></td>
              <td class="text-center align-middle">Necklace of Seven eleven</td>
              <td class="text-center align-middle">P3,000</td>
              <td class="text-center align-middle">1</td>
              <td class="text-center align-middle">Processing</td>
              <td class="text-center align-middle"><button type="button" class="btn btn-warning me-2  ">View</button><button type="button" class="btn btn-dark">Cancel</button></td>
            </tr>
            <tr>
              <td class="text-center align-middle" scope="row">1</td>
              <td class="text-center align-middle"><img src="../assets/images/compressed/img1.jpg" height="100" width="100" alt=""></td>
              <td class="text-center align-middle">Necklace of Seven eleven</td>
              <td class="text-center align-middle">P3,000</td>
              <td class="text-center align-middle">1</td>
              <td class="text-center align-middle">Processing</td>
              <td class="text-center align-middle"><button type="button" class="btn btn-warning me-2  ">View</button><button type="button" class="btn btn-dark">Cancel</button></td>
            </tr>
            <tr>
              <td class="text-center align-middle" scope="row">1</td>
              <td class="text-center align-middle"><img src="../assets/images/compressed/img1.jpg" height="100" width="100" alt=""></td>
              <td class="text-center align-middle">Necklace of Seven eleven</td>
              <td class="text-center align-middle">P3,000</td>
              <td class="text-center align-middle">1</td>
              <td class="text-center align-middle">Processing</td>
              <td class="text-center align-middle"><button type="button" class="btn btn-warning me-2  ">View</button><button type="button" class="btn btn-dark">Cancel</button></td>
            </tr>
            <tr>
              <td class="text-center align-middle" scope="row">1</td>
              <td class="text-center align-middle"><img src="../assets/images/compressed/img1.jpg" height="100" width="100" alt=""></td>
              <td class="text-center align-middle">Necklace of Seven eleven</td>
              <td class="text-center align-middle">P3,000</td>
              <td class="text-center align-middle">1</td>
              <td class="text-center align-middle">Processing</td>
              <td class="text-center align-middle"><button type="button" class="btn btn-warning me-2  ">View</button><button type="button" class="btn btn-dark">Cancel</button></td>
            </tr>
            <tr>
              <td class="text-center align-middle" scope="row">1</td>
              <td class="text-center align-middle"><img src="../assets/images/compressed/img1.jpg" height="100" width="100" alt=""></td>
              <td class="text-center align-middle">Necklace of Seven eleven</td>
              <td class="text-center align-middle">P3,000</td>
              <td class="text-center align-middle">1</td>
              <td class="text-center align-middle">Processing</td>
              <td class="text-center align-middle"><button type="button" class="btn btn-warning me-2  ">View</button><button type="button" class="btn btn-dark">Cancel</button></td>
            </tr>
          </tbody>
        </table>
        </div>
      </div>
      <div class="modal-footer bg-light">
        <h6>Total to pay :</h6>
        <h6>P0</h6>
        <button type="button" class="btn btn-warning ms-5" data-bs-dismiss="modal">View Delivered</button>
      </div>
    </div>
  </div>
</div>
