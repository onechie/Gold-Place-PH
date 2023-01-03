<?php
if (!defined('ACCESS')) {
  header("location: ../");
}
?>
<div class="modal fade" id="confirm-checkout" tabindex="-1" aria-labelledby="cartLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-white z-high">
        <img height="30" src="./assets/images/defaults/logo-only.png" alt="Logo">
        <h5 class="ps-3 modal-title text-dark fw-normal" id="cartLabel">Confirm Order</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-light overflow-auto p-4" style="height: 60vh;">
        <h5 class='fw-light pt-2'>SHIPPING ADDRESS</h5>
        <div class='fw-200' id='confirm-address'>
          #215 Palapat, Hagonoy, Bulacan.
        </div>
        <hr>

        <h5 class='fw-light'>MODE OF PAYMENT</h5>
        <div class="row">
          <div class="col-12 p-3">
            <button class="btn btn-outline-success py-4 w-100 fs-3 payment-option cod">COD</button>
          </div>
          <div class="col-12 p-3">
            <button class="btn btn-outline-primary py-4 w-100 fs-3 payment-option gcash">GCASH</button>
            <div class="col-12 pt-3 text-danger" id='gcash-message'>
              After you confirm this order. Go to "Orders" and click "Pay Order" button for payment procedure.
            </div>
          </div>
        </div>
        <hr>

        <h5 class='m-0 fw-light text-start mb-2'>ITEMS</h5>
        <div class='row fs-7' id='confirm-items'>
          <div class=' col-8 text-start text-break fw-200'>example item x1</div>
          <div class='col-4 text-start text-break'>P4,000</div>
        </div>

        <div class='row fs-7 mt-3'>
          <div class='col-8 text-start text-break fw-200'>Shipping Fee</div>
          <div class='col-4 text-start text-break' id='confirm-shipping'>P100</div>
        </div>
        <div class='row'>
          <div class=' col-8 text-start fw-light text-break'>Total</div>
          <div class='col-4 text-start text-break' id='confirm-total'>P12,100</div>
        </div>




      </div>
      <div class="modal-footer">
        <div class="d-flex">
          <button type="button" class="btn btn-warning btn-sm ms-5" id="confirm-btn" data-bs-dismiss="modal">Confirm</button>
        </div>
      </div>
    </div>
  </div>
</div>