<?php
if (!defined('ACCESS')) {
  header("location: ../");
}
?>
<div class="modal fade" id="order" tabindex="-1" aria-labelledby="orderLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-white z-high">
        <img height="30" src="./assets/images/defaults/logo-only.png" alt="Logo">
        <h5 class="ps-3 modal-title text-dark fw-normal" id="orderLabel">Your Order</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-light overflow-auto p-0" style="height: 60vh;">
        <div class="w-100 h-100" style="min-width: 800px;">
          <table class="table table-hover m-0 table-striped">
            <thead class="sticky-top bg-white shadow-sm z-mid">
              <tr>
                <th class="p-0">
                  <div class="row fw-light py-3 fs-7 bg-dark px-4 text-light">
                    <div class="col-1">#</div>
                    <div class="col-3">DATE</div>
                    <div class="col-3">Total Price</div>
                    <div class="col-4">STATUS</div>
                    <div class="col-1"><i class="bi bi-list"></i></div>
                  </div>
                </th>
              </tr>
            </thead>
            <tbody id="order-items">
              <tr>
                <td class="p-0">
                  <div class="accordion accordion-flush">
                    <div class="accordion-item fw-200 fs-7">
                      <div class="accordion-header row py-3 px-4 bg-white" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo">
                        <div class="col-2">0</div>
                        <div class="col-5">00-00-0000</div>
                        <div class="col-4">Checking</div>
                        <div class="col-1"><i class="bi bi-chevron-down"></i></div>
                      </div>
                      <div id="flush-collapseTwo" class="accordion-collapse collapse">
                        <div class="accordion-body py-2 row bg-light">
                          <div class="col-2"> <img src='./assets/images/defaults/img3.jpg' height='100' width='100' alt=''></div>
                          <div class="col-4 my-auto">Item name example</div>
                          <div class="col-3 my-auto">&#8369;<span id='item_price'>1,000</span></div>
                          <div class="col-2 my-auto">5</div>
                          <div class="col-1 my-auto"><i class='bi bi-eye mx-1 text-success fs-4'></i></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>

          </table>
        </div>
      </div>
      <div class="modal-footer">
        <h6 class="fw-light fs-7">Overall price :</h6>
        <h6 class="fw-normal fs-7 text-success" id="total_price">P0</h6>
        <div class="d-flex">
          <select class="p-1 ms-5 rounded-1 fs-7 w-auto btn btn-dark border-0 order-status">
            <option value="default">All</option>
            <option value="checking">Checking</option>
            <option value="processing">Processing</option>
            <option value="delivered">Delivered</option>
            <option value="cancelled">Cancelled</option>
          </select>

        </div>
      </div>
    </div>
  </div>
</div>