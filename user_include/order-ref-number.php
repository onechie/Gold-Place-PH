<?php
if (!defined('ACCESS')) {
    header("location: ../");
}
?>
<div class="modal fade" id="order-reference" tabindex="-1" aria-labelledby="cartLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-white z-high">
                <img height="30" src="./assets/images/defaults/logo-only.png" alt="Logo">
                <h5 class="ps-3 modal-title text-dark fw-normal" id="cartLabel">Reference Number</h5>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light overflow-auto p-4" style="height: 60vh;">
                <h5 class='fw-normal pt-2'>RECEIVER INFORMATION</h5>
                <div class='fw-normal fs-5 text-primary' id='billing-name'>
                    Angelo P.
                </div>
                <div class='fw-light' id='billing-number'>
                    09260295144
                </div>
                <hr>

                <h5 class='fw-normal pt-2'>AMOUNT TO PAY</h5>
                <div class='fw-normal fs-5 text-success' id='billing-amount'>
                    0
                </div>
                <hr>

                <h6 class='fw-normal text-danger'>PLEASE READ THIS BEFORE YOU PROCEED.</h5>
                    <ol class='list-group list-group-numbered'>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto w-100">
                                <div class="fw-bold">Send payment via GCASH Express send</div>
                                <div class='w-100 pe-4'>

                                    <div class='pt-2'>input the number given above <span class='text-danger'>(Check the number and name before sending)</span></div>
                                    <div class='pt-2'>Enter the order total amount <span class='text-danger'>(Pay exact price based on your order total amount.)</span></div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto w-100">
                                <div class="fw-bold">Send payment via GCASH QR-code</div>
                                <div class='w-100 pe-4'>

                                    <div class='pt-2'>Scan the QR-code if possible.</div>
                                    <img src="./assets/images/payment/g1-3.png" style='max-width:100%' class='' alt="">

                                    <div class='pt-2'>If you can’t scan the QR-code download and upload the QR-code image.</div>
                                    <div class='pt-2'>Enter the order total amount <span class='text-danger'>(Pay exact price based on your order total amount.)</span></div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">To get the reference number follow the steps below:</div>
                                <ul>
                                    <li>
                                        Click Transactions
                                    </li>
                                    <li>
                                        Click the three dots corresponding to your transaction made
                                    </li>
                                    <li>
                                        You will see all the information in relation to the transaction including the date and reference number.
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ol>
                    <hr>

                    <h5 class='m-0 fw-normal text-start mb-2'>ENTER REF NUMBER</h5>
                    <div class='fw-light text-danger'>
                        DOUBLE CHECK THE REFERENCE NUMBER YOU WILL ENTER. THIS CAN BE ONLY DONE ONCE.
                    </div>
                    <div class=''>
                        <input type='text' class='w-100 form-control' id='order-ref-input' placeholder="Your reference number">
                    </div>




            </div>
            <div class="modal-footer">
                <div class="d-flex">
                    <input type="hidden" id="order-ref-id" val=''>
                    <button type="button" class="btn btn-warning btn-sm ms-5" id="order-ref-submit" >Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>