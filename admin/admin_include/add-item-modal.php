<?php
    if(!defined('ACCESS')) {
    header("location: ../");
    }
?>
<!-- ADD ITEM MODAL - ADMIN PANEL -->
<form action="" method="post" enctype="multipart/form-data" id="add-item">
  <div class="modal fade" id="items" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered  modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-light lt-space" id="modalLabel">ADD ITEM</h5>
          <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body overflow-auto p-4 bg-light" style="max-height: 60vh;">
          <div class="row">
            <div class="col-12">
              <label class="form-label" for="item-name">Item name</label>
              <input type="hidden" id="id" name="id">
              <input type="hidden" id="requestType" name="requestType">
              <input type="text" class="form-control" id="item-name" name="name">
            </div>
            <div class="col-12 col-sm-6 mb-3">
              <label class="form-label" for="category">Category</label>
              <select class="form-select" aria-label="Default select example" id="category" name="category">
                <option selected value="">Category</option>
                <option value="Ring">Ring</option>
                <option value="Necklace">Necklace</option>
                <option value="Pendant">Pendant</option>
                <option value="Earring">Earring</option>
                <option value="Earring">Bracelet</option>
              </select>
            </div>
            <div class="col-12 col-sm-3 mb-3">
              <label class="form-label" for="price">Price</label>
              <input type="number" class="form-control" id="price" name="price" min="1">
            </div>
            <div class="col-12 col-sm-3 mb-3">
              <label class="form-label" for="stocks">Stocks</label>
              <input type="number" class="form-control" id="stocks" name="stocks" min="1">
            </div>
            <div class="col-12 mb-3">
              <label class="form-label" for="description">Description</label>
              <textarea class="form-control h-auto" id="description" style="min-height:200px;" name="description"></textarea>
            </div>
            <div class="col-12 mb-3">
              <div id="output" class="mb-3 d-flex flex-wrap justify-content-center">

              </div>
              <div class="border border-2 position-relative rounded-4 d-flex flex-column justify-content-center align-items-center bg-white" style="height: 100px">
                <input class="position-absolute z-highest file-upload" accept="image/*" type="file" multiple id="imageInput" style="height: 100%; width: 100%; opacity:0;" name="images[]">
                <i class="bi bi-upload fs-2 opacity-50 z-mid"></i>
                <div class="px-4 text-center"><strong>Choose photos </strong>or Drag it here</div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-white d-flex justify-content-center justify-content-sm-between px-4">
          <p class="p-0 m-0" id="messageText"></p>
          <button type="submit" class="btn btn-sm btn-danger" id="add-item-btn">Add Item</button>
          <button type="submit" class="btn btn-sm btn-danger" id="edit-item-btn">Edit Item</button>
        </div>
      </div>
    </div>
  </div>
</form>