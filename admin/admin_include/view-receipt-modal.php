<?php
if (!defined('ACCESS')) {
    header("location: ../");
}
?>
<div class="modal fade" id="view-receipt" tabindex="-1" aria-labelledby="orderLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-white z-high">
                <img height="30" src="../assets/images/defaults/logo-only.png" alt="Logo">
                <h5 class="ps-3 modal-title text-dark fw-normal" id="orderLabel">Receipt</h5>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light p-3 overflow-auto" style="min-height: 90vh;">
                <style>
                    @media print {
                        body * {
                            visibility: hidden;
                        }

                        #receipt-container {
                            height: 100%;

                        }

                        #receipt-container,
                        #receipt-container * {
                            visibility: visible;
                        }

                    }
                </style>
                <div id="receipt-container" class='text-center p-2 pt-3 m-auto'>
                    <div class='row'>
                        <div id="qrcode" class="d-flex col-5"></div>
                        <div class='col-7'>
                            <img height="50" src="../assets/images/defaults/logo-only.png" alt="Logo">
                            <h4 class="m-0 fw-normal">Gold Place PH</h4>
                            <p class="m-0 fw-normal">https://www.gold-place-ph.com</p>
                        </div>

                    </div>

                    <hr>
                    <div class='receipt-content'>
                        <h5 class='m-0 fw-normal text-start mb-2'>ITEMS</h5>
                        <div class='row fs-7'>
                            <div class=' col-8 text-start text-break fw-200'>example item x1</div>
                            <div class='col-4 text-start text-break'>P4,000</div>
                        </div>

                        <div class='row fs-7 mt-3'>
                            <div class=' col-8 text-start text-break fw-200'>Shipping Fee</div>
                            <div class='col-4 text-start text-break'>P100</div>
                        </div>
                        <div class='row'>
                            <div class=' col-8 text-start text-break'>Total</div>
                            <div class='col-4 text-start text-break'>P12,100</div>
                        </div>
                        <hr>
                        <h5 class='m-0 fw-normal text-start mb-2'>SHIP TO</h5>
                        <div class='row fs-7'>
                            <div class=' col-4 text-start text-break fw-200'>Name: </div>
                            <div class='col-8 text-start text-break'>Customer Tester</div>
                        </div>
                        <div class='row fs-7'>
                            <div class=' col-4 text-start text-break fw-200'>Address: </div>
                            <div class='col-8 text-start text-break'>#000 Example Address Hagonoy, Bulacan</div>
                        </div>
                        <div class='row fs-7'>
                            <div class=' col-4 text-start text-break fw-200'>Phone: </div>
                            <div class='col-8 text-start text-break'>09999999999</div>
                        </div>
                        <div class='row fs-7 mt-3'>
                            <div class=' col-4 text-start text-break fw-200'>Order ID: </div>
                            <div class='col-8 text-start text-break'>hnc1g24g12ct4g1t2cg4</div>
                        </div>
                    </div>



                </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" id="order_id">
                <div class="d-flex align-items-center fw-light ms-5 fs-7">
                    <button type="submit" class="btn btn-sm btn-success" id="print-receipt" onclick="window.print()">Print Receipt</button>
                </div>
            </div>
        </div>
    </div>
</div>