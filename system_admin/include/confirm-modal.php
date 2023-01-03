<?php
    if(!defined('ACCESS')) {
    header("location: ../");
    }
?>
<!-- CONFIRMATION MODAL - ADMIN PANEL -->
  <div class="modal fade" id="confirm-delete" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-light lt-space" id="modalLabel">CONFIRM</h5>
          <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body overflow-auto p-4" style="max-height: 60vh;">
            <div id="confirmation-message">Are you sure?</div>
        </div>
        <div class="modal-footer bg-light d-flex justify-content-center justify-content-sm-between px-4">
          <p class="p-0 m-0" id="messageText"></p>
          <input type="hidden" id="delete-id">
          <input type="hidden" id="requestType">
          <button type="submit" class="btn btn-sm btn-danger" id="delete-btn">Delete</button>
        </div>
      </div>
    </div>
  </div>