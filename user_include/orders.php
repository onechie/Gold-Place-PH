<div class="modal fade" id="order" tabindex="-1" aria-labelledby="orderLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-warning z-high">
        <img height="30" src="./assets/images/defaults/logo-only-black.png" alt="Logo">
        <h5 class="ps-3 modal-title text-dark fw-normal" id="orderLabel">Your Order</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-light overflow-auto p-0" style="height: 60vh;">
        <div class="w-100 h-100" style="min-width: 800px;">
          <table class="table table-hover m-0 table-striped">
            <thead class="sticky-top bg-white shadow-sm z-mid">
              <tr class="text-center align-middle text-dark fs-7">
                <th height="60">#</th>
                <th>IMAGE</th>
                <th>NAME</th>
                <th>PRICE</th>
                <th>QUANTITY</th>
                <th>STATUS</th>
                <th>ACTION</th>
              </tr>
            </thead>
            <tbody id="order-items">

            </tbody>

          </table>
        </div>
      </div>
      <div class="modal-footer">
        <h6 class="fw-light fs-7">Total price :</h6>
        <h6 class="fw-normal fs-7" id="total_price">P0</h6>
        <div class="d-flex">
            <button type="button" class="btn btn-warning btn-sm ms-5" id="delivered">Delivered</button>
            <button type="button" class="btn btn-warning btn-sm ms-5" id="processing">Processing</button>
        </div>
      </div>
    </div>
  </div>
</div>