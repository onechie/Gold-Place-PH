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
        <h5 class="modal-title text-light" id="modalLabel">Your Order</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-light overflow-auto p-0" style="max-height: 60vh;">
        <div class="container-fluid p-0">
        <table class="table table-hover m-0">
          <thead class="sticky-top bg-warning">
            <tr>
              <th class="text-center align-middle" scope="col" height="60">#</th>
              <th class="text-center align-middle" scope="col">Image</th>
              <th class="text-center align-middle" scope="col">Name</th>
              <th class="text-center align-middle" scope="col">Price</th>
              <th class="text-center align-middle" scope="col">Quantity</th>
              <th class="text-center align-middle" scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-center align-middle" scope="row">1</td>
              <td class="text-center align-middle"><img src="../assets/images/img1.jpg" height="100" width="100" alt=""></td>
              <td class="text-center align-middle">Necklace of Seven eleven</td>
              <td class="text-center align-middle">P 3,000</td>
              <td class="text-center align-middle">1</td>
              <td class="text-center align-middle"><button type="button" class="btn btn-warning me-2  ">View</button><button type="button" class="btn btn-dark">Cancel</button></td>
            </tr>
            <tr>
              <td class="text-center align-middle" scope="row">2</td>
              <td class="text-center align-middle"><img src="../assets/images/img1.jpg" height="100" width="100" alt=""></td>
              <td class="text-center align-middle">Necklace of Seven eleven</td>
              <td class="text-center align-middle">P 3,000</td>
              <td class="text-center align-middle">1</td>
              <td class="text-center align-middle"><button type="button" class="btn btn-warning me-2  ">View</button><button type="button" class="btn btn-dark">Cancel</button></td>
            </tr>
            <tr>
              <td class="text-center align-middle" scope="row">3</td>
              <td class="text-center align-middle"><img src="../assets/images/img1.jpg" height="100" width="100" alt=""></td>
              <td class="text-center align-middle">Necklace of Seven eleven</td>
              <td class="text-center align-middle">P 3,000</td>
              <td class="text-center align-middle">1</td>
              <td class="text-center align-middle"><button type="button" class="btn btn-warning me-2  ">View</button><button type="button" class="btn btn-dark">Cancel</button></td>
            </tr>
            <tr>
              <td class="text-center align-middle" scope="row">4</td>
              <td class="text-center align-middle"><img src="../assets/images/img1.jpg" height="100" width="100" alt=""></td>
              <td class="text-center align-middle">Necklace of Seven eleven</td>
              <td class="text-center align-middle">P 3,000</td>
              <td class="text-center align-middle">1</td>
              <td class="text-center align-middle"><button type="button" class="btn btn-warning me-2  ">View</button><button type="button" class="btn btn-dark">Cancel</button></td>
            </tr>
            <tr>
              <td class="text-center align-middle" scope="row">5</td>
              <td class="text-center align-middle"><img src="../assets/images/img1.jpg" height="100" width="100" alt=""></td>
              <td class="text-center align-middle">Necklace of Seven eleven</td>
              <td class="text-center align-middle">P 3,000</td>
              <td class="text-center align-middle">1</td>
              <td class="text-center align-middle"><button type="button" class="btn btn-warning me-2  ">View</button><button type="button" class="btn btn-dark">Cancel</button></td>
            </tr>
            <tr>
              <td class="text-center align-middle" scope="row">6</td>
              <td class="text-center align-middle"><img src="../assets/images/img1.jpg" height="100" width="100" alt=""></td>
              <td class="text-center align-middle">Necklace of Seven eleven</td>
              <td class="text-center align-middle">P 3,000</td>
              <td class="text-center align-middle">1</td>
              <td class="text-center align-middle"><button type="button" class="btn btn-warning me-2  ">View</button><button type="button" class="btn btn-dark">Cancel</button></td>
            </tr>
          </tbody>
          <tfoot class="sticky-bottom bg-warning">
            <tr>
              <td scope="row" colspan="2"></td>
              <th class="text-center align-middle">Total to pay :</th>
              <th class="text-center align-middle">P 3,000</th>
              <td scope="row" colspan="2"></td>
            </tr>
          </tfoot>
        </table>
        </div>
      </div>
      <div class="modal-footer bg-dark">
        <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>