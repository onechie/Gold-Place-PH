<link rel="stylesheet" href="../css/default.css">
<link rel="stylesheet" href="../css/dashboard.css">
<script type="text/javascript" src="../script/client/add_item.js"></script>
<!-- ADD ITEM MODAL - ADMIN PANEL -->
<form action="" method="post" enctype="multipart/form-data" id="add-item">
  <div class="modal fade" id="items" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-light" id="modalLabel">ADD ITEM</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body overflow-auto p-4" style="max-height: 60vh;">
          <div class="row">
            <div class="col-12">
              <label class="form-label" for="item-name">Item name</label>
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
              <input type="number" class="form-control" id="price" name="price">
            </div>
            <div class="col-12 col-sm-3 mb-3">
              <label class="form-label" for="stocks">Stocks</label>
              <input type="number" class="form-control" id="stocks" name="stocks">
            </div>
            <div class="col-12 mb-3">
              <label class="form-label" for="description">Description</label>
              <textarea class="form-control h-auto" id="description" style="min-height:200px;" name="description"></textarea>
            </div>
            <div class="col-12 mb-3">
              <div id="output" class="mb-3 d-flex flex-wrap justify-content-center">

              </div>
              <div class="border border-2 position-relative rounded-4 d-flex flex-column justify-content-center align-items-center bg-light" style="height: 100px">
                <input class="position-absolute z-highest file-upload" accept="image/*" type="file" multiple id="imageInput" style="height: 100%; width: 100%; opacity:0;" name="images[]">
                <i class="bi bi-upload fs-1 opacity-50 z-mid"></i>
                <div><strong>Choose photos </strong>or Drag it here</div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer bg-light d-flex justify-content-center justify-content-sm-between px-4">
          <p class="text-danger p-0 m-0" id="errorText"></p>
          <button type="submit" class="btn btn-sm btn-danger" id="add-item-btn">Add Item</button>
        </div>
      </div>
    </div>
  </div>
</form>