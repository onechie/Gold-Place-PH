<div class="modal fade" id="cart" tabindex="-1" aria-labelledby="cartLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-white z-high">
        <img height="30" src="./assets/images/defaults/logo-only.png" alt="Logo">
        <h5 class="ps-3 modal-title text-dark fw-normal" id="cartLabel">Your Cart</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-light overflow-auto p-0" style="height: 60vh;">
        <div class="w-100 h-100" style="min-width: 800px;">
          <table class="table table-hover m-0 table-striped">
            <thead class="sticky-top bg-dark shadow-sm z-mid">
              <tr class="align-middle text-light fs-7">
                <th class="p-0 py-3 px-4"><input class="form-check-input" id="check_all" type="checkbox" value=""></th>
                <th class="p-0 py-3 px-4">IMAGE</th>
                <th class="p-0 py-3 px-4">NAME</th>
                <th class="p-0 py-3 px-4">PRICE</th>
                <th class="p-0 py-3 px-4">QUANTITY</th>
                <th class="p-0 py-3 px-4">ACTION</th>
              </tr>
            </thead>
            <tbody id="cart-items">

            </tbody>

          </table>
        </div>
      </div>
      <div class="modal-footer">
        <h6 class="fw-light fs-7">Total Price :</h6>
        <h6 class="fw-normal fs-7" id="total_price">P0</h6>
        <div class="d-flex">
            <button type="button" class="btn btn-warning btn-sm ms-5" id="checkOut">Checkout</button>
            <button type="button" class="btn btn-dark btn-sm ms-2" id="remove">Remove</button>
        </div>
      </div>
    </div>
  </div>
</div>