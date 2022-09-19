<?php
    include './links.php';
?>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cart">
  Launch demo modal
</button>

<!-- User Cart Modal -->
<div class="modal fade" id="cart" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h5 class="modal-title text-light" id="modalLabel">Your Cart</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-light overflow-auto" style="max-height: 60vh;">
        <div class="container-fluid">
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="text-center" scope="col">#</th>
              <th class="text-center" scope="col">Image</th>
              <th class="text-center" scope="col">Name</th>
              <th class="text-center" scope="col">Price</th>
              <th class="text-center" scope="col">Quantity</th>
              <th class="text-center" scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th class="text-center align-middle" scope="row">1</th>
              <td class="text-center align-middle"><img src="../assets/images/img1.jpg" height="100" width="100" alt=""></td>
              <td class="text-center align-middle">Necklace of Seven eleven</td>
              <td class="text-center align-middle">P 3,000</td>
              <td class="text-center align-middle"><input class="form-control input-qty mx-auto" type="number" value="1"></td>
              <td class="text-center align-middle">Processing</td>
            </tr>
            <tr>
              <th class="text-center align-middle" scope="row">2</th>
              <td class="text-center align-middle"><img src="../assets/images/img2.jpg" height="100" width="100" alt=""></td>
              <td class="text-center align-middle">Necklace of Seven eleven</td>
              <td class="text-center align-middle">P 3,000</td>
              <td class="text-center align-middle"><input class="form-control input-qty mx-auto" type="number" value="1"></td>
              <td class="text-center align-middle">Processing</td>
            </tr>
            <tr>
              <th class="text-center align-middle" scope="row">3</th>
              <td class="text-center align-middle"><img src="../assets/images/img3.jpg" height="100" width="100" alt=""></td>
              <td class="text-center align-middle">Necklace of Seven eleven</td>
              <td class="text-center align-middle">P 3,000</td>
              <td class="text-center align-middle"><input class="form-control input-qty mx-auto" type="number" value="1"></td>
              <td class="text-center align-middle">Processing</td>
            </tr>
          </tbody>
        </table>
        </div>
      </div>
      <div class="modal-footer bg-dark">
        <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning">Save changes</button>
      </div>
    </div>
  </div>
</div>

