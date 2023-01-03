<?php
if (!defined('ACCESS')) {
    header("location: ../");
}
?>
<form action="" method="post" enctype="multipart/form-data" id="update-order-form">
    <div class="modal fade" tabindex="-1" id="update-order" aria-labelledby="orderLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-white z-high">
                    <img height="30" src="../assets/images/defaults/logo-only.png" alt="Logo">
                    <h5 class="ps-3 modal-title text-dark fw-normal" id="orderLabel">Update Order</h5>
                    <button type="button" class="btn-close btn-close-black" id='close-update-order' data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-light overflow-auto p-3" style="height: 60vh;">
                    <p class='fs-5'>ID : <span class='fw-normal text-success order-id'>0Z014012X4</span></p>
                    <p>Items : <span class='fw-200 order-count'>4</span></p>
                    <ul class='fw-200 order-items'>
                        <li>text item x1</li>
                        <li>text item x2</li>
                        <li>text item x3</li>
                        <li>text item x4</li>
                    </ul>
                    <p>
                        Items Price :
                        <span class='fw-200 text-success items-price'>

                        </span>
                    </p>
                    <p>
                        Shipping Fee :
                        <span class='fw-200 text-danger shipping-fee'>

                        </span>
                    </p>
                    <p>Address : <span class='fw-200 order-address'>test address jupiter malolos bulacan</span></p>
                    <p>Contact no : <span class='fw-200 order-contact'>908124724247</span></p>
                    <p>Name : <span class='fw-200 order-name'>test user</span></p>
                    
                    <p>
                        Status : <span class='fw-200 order-status'>test user</span></p>
                    </p>
                    <p class='m-0'>Proof of Delivery :</p>
                    <div class="col-12 mb-3">
                        <div id="image" class="mb-3 d-flex flex-wrap justify-content-center">

                        </div>
                        <div class="border border-2 position-relative rounded-4 d-flex flex-column justify-content-center align-items-center bg-white" style="height: 100px">
                            <input class="position-absolute z-highest file-upload" accept="image/*" type="file" multiple id="imageInput" style="height: 100%; width: 100%; opacity:0;" name="images[]">
                            <i class="bi bi-upload fs-2 opacity-50 z-mid"></i>
                            <?php include '../user_include/csrf_token.php' ?>
                            <div class="px-4 text-center"><strong>Choose photos </strong>or Drag it here</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <h6 class="fw-light fs-7">Total price :</h6>
                    <h6 class="fw-normal fs-7 text-success total-price">P0</h6>
                    <input type="hidden" id="requestType" name='requestType' value='update-order'>
                    <input type="hidden" id="order-id" name='order_id'>
                    <button type='submit' class='ms-5 btn btn-sm btn-success update-button'>Delivered</button>
                </div>
            </div>
        </div>
    </div>
</form>