$(document).ready(function () {
  "use strict";

  //INSERT ITEM DATA MODAL EDIT/ADD
  const addForm = $("#add-item")
  const addId =  $("#add-item #id")
  const addName =  $("#add-item #item-name")
  const addCategory = $("#add-item #category")
  const addPrice = $("#add-item #price")
  const addStocks = $("#add-item #stocks")
  const addDescription = $("#add-item #description")
  const addBtn = $("#add-item #add-item-btn")
  const editBtn = $("#add-item #edit-item-btn")
  const addMsg = $("#add-item #messageText")
  const addLabel = $("#add-item #modalLabel")
  const addReqType = $("#add-item #requestType")
  const addOutput = $("#add-item #output")

  //ITEMS TABLE
  const itemList = $("#item-list")
  const itemAddBtnMain = $("#addItemMainButton");

  $(".items #search-item").on("keyup", function(){
    var value = $(this).val().toLowerCase();
    $("#item-list tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  })

  $("#sort_item_id").click(function(){
    sortTable("id");
  })
  $("#sort_item_name").click(function(){
    sortTable("name");
  })
  $("#sort_item_stock").click(function(){
    sortTable("stock");
  })
  $("#sort_item_price").click(function(){
    sortTable("price");
  })
  $("#sort_item_sold").click(function(){
    sortTable("sold");
  })

  addBtn.prop("disabled", true);
  getItemsData();

  $("#refresh-items").click(function () {
    getItemsData();
  });

  //EDIT BUTTON
 itemList.on("click", ".editItem", function () {
    let id = $(this).parentsUntil("tr").siblings(".id").text();
    $.post(
      "../assets/scripts/server/catch_admin_request.php",{ 
        requestType: "load-item",
        id: id
      },
      function (data) {
        let itemsInfo = JSON.parse(data);
        let itemInfo = itemsInfo[0];
        addId.val(itemInfo.id);
        addName.val(itemInfo.name);
        addCategory.val(itemInfo.category);
        addPrice.val(itemInfo.price);
        addStocks.val(itemInfo.stocks);
        addDescription.val(itemInfo.description);
        addCategory.trigger("change");

        addOutput.empty();
        for (let i = 0; i < itemInfo.images.length; i++) {
          addOutput.append(
            "<div class='ratio ratio-1x1 bg-light shadow rounded-4 align-self-center' style='max-width: 300px; margin:10px;'>" +
              "<img class='inputImages rounded-4' src='../assets/images/items/"+itemInfo.id+"/"+itemInfo.images[i] +"'/>" +
            "</div>"
          );
        }
        addBtn.hide();
        editBtn.show();
        addMsg.empty();
        addLabel.text("EDIT ITEM");
        addReqType.val("edit-item");
      }
    );
  });
  //ADD BUTTON
  itemAddBtnMain.click(function () {
    addReqType.val("add-item");
    addForm[0].reset();
    addCategory.trigger("change");
    addBtn.show();
    editBtn.hide();
    addMsg.empty();
    addLabel.text("ADD ITEM");
    addOutput.empty();
  });
  //AJAX FOR ADD OR EDIT ITEM
  addForm.on("submit", function (e) {
    e.preventDefault();
    $.ajax({
      url: "../assets/scripts/server/catch_admin_request.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
    }).done(function (data) {
      serverResponseTranslate(data);
      getItemsData();
      $("#imageInput").val(null);
    });
  });
  //DELETE BUTTON
 itemList.on("click", ".deleteItem", function () {
    let id = $(this).parentsUntil("tr").siblings(".id").text();
    $("#confirmation-message").empty();
    $("#confirmation-message").append(
      "Are you sure do you want to delete item [ID = " + id + "]?"
    );
    $("#confirmation #messageText").empty();
    $("#confirmation #id").val(id);
    $("#confirmation #requestType").val("delete-item");
  });
  //AJAX FOR DELETING ITEM
  $("#confirmation").on("submit", function (e) {
    e.preventDefault();
    $.ajax({
      url: "../assets/scripts/server/catch_admin_request.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
    }).done(function (data) {
      serverResponseTranslate(data);
      getItemsData();
      console.log(data);
    });
  });
  //FUNCTION FOR DISPLAYING IMAGE ON INPUT
  $("#imageInput").change(function () {
    var i = 0;
    addOutput.empty();

    while (i < this.files.length) {
      var file = this.files[i];
      var fileType = file["type"];
      var validImageTypes = [
        "image/gif",
        "image/jpeg",
        "image/png",
        "image/jpg",
      ];
      if ($.inArray(fileType, validImageTypes) < 0) {
        addMsg.empty();
        addMsg.append("<span class='text-danger'>Please insert pictures only!</span>");
        addOutput.empty();
        this.value = null;
      } else {
        addMsg.empty();
        addOutput.append(
          "<div class='ratio ratio-1x1 bg-light shadow rounded-4 align-self-center' style='max-width: 300px; margin:10px;'>" +
              "<img class='inputImages rounded-4' src='"+URL.createObjectURL(event.target.files[i])+"'/>" +
          "</div>"
        );
      }
      i++;
    }

  });

  addName.change(function () {
    updateButton();
  });
  addCategory.change(function () {
    updateButton();
  });
  addPrice.change(function () {
    updateButton();
  });
  addStocks.change(function () {
    updateButton();
  });
  addDescription.change(function () {
    updateButton();
  });
  
  function hasFilled() {
    if (addName.val().length == 0) return false;
    if (addCategory.val().length == 0) return false;
    if (addPrice.val().length == 0) return false;
    if (addStocks.val().length == 0) return false;
    if (addDescription.val().length == 0) return false;

    return true;
  }
  
  function updateButton() {
    if (hasFilled()) {
      editBtn.prop("disabled", false);
      addBtn.prop("disabled", false);
    } else {
      editBtn.prop("disabled", true);
      addBtn.prop("disabled", true);
    }
  }
  function sortTable(by) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("item-list");
    switching = true;

    dir = "asc";

    while (switching) {

      switching = false;
      rows = table.rows;

      for (i = 0; i < (rows.length - 1); i++) {

        shouldSwitch = false;

        if(by=="id"){
          x = Number($(rows[i]).children(".sort-by-id").text())
          y = Number($(rows[i+1]).children(".sort-by-id").text())
        } else if(by=="name"){
          x = $(rows[i].getElementsByTagName("td")[1]).children("div").children("#sort-by-name").text().toLowerCase()
          y = $(rows[i+1].getElementsByTagName("td")[1]).children("div").children("#sort-by-name").text().toLowerCase()
        } else if(by=="stock"){
          x = Number($(rows[i].getElementsByTagName("td")[2]).children("p").children(".stocks").text().toLowerCase())
          y = Number($(rows[i+1].getElementsByTagName("td")[2]).children("p").children(".stocks").text().toLowerCase())
        } else if(by=="price") {
          x = Number($(rows[i].getElementsByTagName("td")[3]).children(".price").text().toLowerCase())
          y = Number($(rows[i+1].getElementsByTagName("td")[3]).children(".price").text().toLowerCase())
        } else {
          x = Number($(rows[i].getElementsByTagName("td")[4]).children(".sold").text().toLowerCase())
          y = Number($(rows[i+1].getElementsByTagName("td")[4]).children(".sold").text().toLowerCase())
        }

        if (dir == "asc") {
          if (x > y) {
            shouldSwitch = true;
            break;
          }
        } else if (dir == "desc") {
          if (x < y) {
            shouldSwitch = true;
            break;
          }
        }
      }
      if (shouldSwitch) {
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
        switchcount ++;
      } else {
        if (switchcount == 0 && dir == "asc") {
          dir = "desc";
          switching = true;
        }
      }
    }
  }

  function getItemsData() {
   itemList.empty();
    $.post("../assets/scripts/server/catch_admin_request.php", {requestType:"load-items"},function (data) {
      if (data && data != "null") {
        let itemInfo = JSON.parse(data);
        let htmlData = ""
        for (let i = 0; i < itemInfo.length; i++) {
          let item = itemInfo[i];
          let color = "primary";
          let stocks = item.stocks;

          if (stocks <= 25) {
            color = "danger";
          } else if (stocks <= 50) {
            color = "warning";
          } else {
            color = "primary";
          }
          htmlData += "<tr class='align-middle'>"
            +"   <td class='ps-4 py-4 id sort-by-id'>"+item.id+"</td>"
            +"    <td class='ps-4'>"
            +"        <div class='d-flex align-items-center'>"
            +"            <div class='position-relative rounded-5 bg-white shadow-sm me-2 flex-shrink-0' style='width:50px; height:50px'>"
            +"                <img class='position-absolute m-1 bg-secondary rounded-5' src='../assets/images/items/"+item.id+"/"+item.images[0]+"' alt='' style='width:42px; height:42px'>"
            +"           </div>"
            +"            <strong id='sort-by-name' class='text-break'>"+item.name+"</strong>"
            +"        </div>"
            +"    </td>"
            +"    <td class='ps-4 stocks-parent'>"
            +"        <p class='p-0 m-0'><span class='stocks'>"+item.stocks+"</span>/100</p>"
            +"        <div class='progress bg-dark bg-opacity-25'>"
            +"            <div class='progress-bar bg-"+color+"' role='progressbar' style='width:"+item.stocks+"%'></div>"
            +"        </div>"
            +"    </td>"
            +"    <td class='ps-4'><strong class='price text-break'>"+item.price+"</strong></td>"
            +"    <td class='ps-4'><strong class='sold'>"+item.sold+"</strong></td>"
            +"    <td class='ps-4 d'>"
            +"        <div class='d-flex '>"
            +"            <i class='editItem bi-pencil-square fs-5 text-secondary icon-btn' data-bs-toggle='modal' data-bs-target='#items'></i>"
            +"            <i class='deleteItem bi bi-trash fs-5 text-danger icon-btn' data-bs-toggle='modal' data-bs-target='#confirm'></i>"
            +"        </div>"
            +"    </td>"
            +"</tr>"
        }
       itemList.append(htmlData);
       const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
       const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
      }
    });
  }

  function serverResponseTranslate(data){
    addMsg.empty();
    $("#confirmation #messageText").empty();
    //ADD AND EDIT FORM RESPONSES
    if(data=="addSuccess"){
      addMsg.append("<span class='text-success'>Item uploaded successfully!</span>")
      addForm[0].reset();
      addOutput.empty();
    }
    if(data=="editSuccess"){
      addMsg.append("<span class='text-success'>Item edited successfully!</span>")
    }
    if(data=="addFailed"){
      addMsg.append("<span class='text-danger'>Item failed to upload!</span>")
    }
    if(data=="editFailed"){
      addMsg.append("<span class='text-danger'>Item failed to edit!</span>")
    }
    if(data=="noImage"){
      addMsg.append("<span class='text-danger'>Please insert image!</span>")
    }
    if(data=="notImage"){
      addMsg.append("<span class='text-danger'>File is not an image!</span>")
    }
    if(data=="existsImage"){
      addMsg.append("<span class='text-danger'>File already existed!</span>")
    }
    if(data=="largeImage"){
      addMsg.append("<span class='text-danger'>File size is too large! (maximum size 2mb)</span>")
    }
    if(data=="formatImage"){
      addMsg.append("<span class='text-danger'>Only (jpg, jpeg, png) allowed!</span>")
    }
    if(data=="failedImage"){
      addMsg.append("<span class='text-danger'>File failed to process!</span>")
    }

    //DELETE ITEM FOR RESPONSES
    if(data=="deleteSuccess"){
      $("#confirmation #messageText").append("<span class='text-success'>Item deleted successfully!</span>")
    }
    if(data=="deleteFailed"){
      $("#confirmation #messageText").append("<span class='text-danger'>Item deletion failed!</span>")
    }
    
    //REFRESH BUTTON
    addCategory.trigger('change');
  }
});
