<?php
if (!defined('ACCESS')) {
    header("location: ../");
}
?>
<div class="modal fade" id="add-order" tabindex="-1" aria-labelledby="orderLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-white z-high">
                <img height="30" src="../assets/images/defaults/logo-only.png" alt="Logo">
                <h5 class="ps-3 modal-title text-dark fw-normal" id="orderLabel">Add Order</h5>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light overflow-auto p-3" style="height: 60vh;">
            
                <div class='text-center'>Search for Order</div>
            <!--
                <p class='fs-5'>ID : <span class='fw-normal text-success'>0Z014012X4</span></p>
                <p>Items : <span class='fw-200'>4</span></p>
                <ul class='fw-200'>
                    <li>text item x1</li>
                    <li>text item x2</li>
                    <li>text item x3</li>
                    <li>text item x4</li>
                </ul>
                <p>Total Price : <span class='fw-200'>1000</span></p>
                <p>Address : <span class='fw-200'>test address jupiter malolos bulacan</span></p>
                <p>Contact no : <span class='fw-200'>908124724247</span></p>
                <p>Name : <span class='fw-200'>test user</span></p>
                <p>Status : <span class='text-success'>Processing</span></p>
                <p>Available : <span class='text-success'>Yes</span></p>

            -->
            </div>
            <div class="modal-footer d-flex">
                <input type="text" id="input-id" class='form-control p-1 w-50' placeholder="Order ID">
                <input type="hidden" id="order-id">
                <button type='button' class='btn btn-sm btn-success' id='search-btn'>Search</button>
            </div>
        </div>
    </div>
</div>