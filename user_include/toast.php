<?php
if (!defined('ACCESS')) {
  header("location: ../");
}
?>
<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header py-2 bg-dark">
            <img src="./assets/images/defaults/logo-only.png" height="25" class="rounded me-2" alt="logo">
            <strong class="me-auto fw-light fs-8 text-light">Gold Place PH</strong>
            <small class="text-black-25 text-muted">just now</small>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body text-capitalize fs-8 text-muted px-4">

        </div>
    </div>
</div>