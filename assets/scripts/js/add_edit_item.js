$(document).ready(function () {
  //DISABLE THE ADD ITEM BUTTON
  $("#add-item-btn").prop("disabled", true);
  //CALL THE ITEMS DATA FUNCTION
  getItemsData();

  $("#refresh-items").click(function () {
    getItemsData();
  });

  //IF EDIT ITEM IS CLICKED RUN THE FUNCTION
  $("#item-list").on("click", ".editItem", function () {
    let id = $(this).parentsUntil("tr").siblings(".id").text();
    //DO AJAX TO GET THE ITEMS DATA FROM THE SERVER
    $.post(
      "../assets/scripts/server/item_data.php",{ 
        requestType: "load-item",
        id: id
      },
      function (data) {
        //PUT THE JSON DATA INTO ARRAY
        let itemsInfo = JSON.parse(data);
        let itemInfo = itemsInfo[0];
        $("#add-item #id").val(itemInfo.id);
        $("#add-item #item-name").val(itemInfo.name);
        $("#add-item #category").val(itemInfo.category);
        $("#add-item #price").val(itemInfo.price);
        $("#add-item #stocks").val(itemInfo.stocks);
        $("#add-item #description").val(itemInfo.description);
        $("#add-item #category").trigger("change");

        //SET IMAGES TO SPECIFIED DIVIDER
        $("#output").empty();
        for (let i = 0; i < itemInfo.images.length; i++) {
          $("#output").append(
            "<div class='ratio ratio-1x1 bg-light shadow rounded-4 align-self-center' style='max-width: 300px; margin:10px;'>" +
              "<img class='inputImages rounded-4' src='../assets/images/items/"+itemInfo.id+"/"+itemInfo.images[i] +"'/>" +
            "</div>"
          );
        }
        $("#add-item #add-item-btn").hide();
        $("#add-item #edit-item-btn").show();
        $("#add-item #messageText").empty();
        $("#add-item #modalLabel").text("EDIT ITEM");
        $("#add-item #requestType").val("edit");
      }
    );
  });

  //AJAX FOR ADDING ALL THE FORM DATA
  $("#add-item").on("submit", function (e) {
    e.preventDefault();
    $.ajax({
      url: "../assets/scripts/server/add_edit_item.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
    }).done(function (data) {
      serverResponseTranslate(data);
      getItemsData();
    });
  });

  //IF ADD BUTTON IS CLICKED RESET THE FORM AND READY FOR ADDING
  $("#addItemMainButton").click(function () {
    $("#add-item #requestType").val("add");
    $("#add-item")[0].reset();
    $("#add-item #category").trigger("change");
    $("#add-item #add-item-btn").show();
    $("#add-item #edit-item-btn").hide();
    $("#add-item #messageText").empty();
    $("#add-item #modalLabel").text("ADD ITEM");
    $("#add-item #output").empty();
  });

  //IF DELETE ITEM IS CLICKED RUN THE FUNCTION
  $("#item-list").on("click", ".deleteItem", function () {
    let id = $(this).parentsUntil("tr").siblings(".id").text();
    $("#confirmation-message").empty();
    $("#confirmation-message").append(
      "Are you sure do you want to delete item [ID = " + id + "]?"
    );
    $("#confirmation #id").val(id);
    $("#confirmation #requestType").val("delete-item");
  });

  //AJAX FOR DELETING ITEM
  $("#confirmation").on("submit", function (e) {
    e.preventDefault();
    $.ajax({
      url: "../assets/scripts/server/add_edit_item.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
    }).done(function (data) {
      serverResponseTranslate(data);
      getItemsData();
    });
  });

  //FUNCTION FOR DISPLAYING IMAGE ON INPUT
  $("#imageInput").change(function () {
    var i = 0;
    //REMOVE THE IMAGES DISPLAYED//
    $("#output").empty();

    while (i < this.files.length) {
      var file = this.files[i];
      var fileType = file["type"];
      //VALID FILE EXTENSION LIST
      var validImageTypes = [
        "image/gif",
        "image/jpeg",
        "image/png",
        "image/jpg",
      ];
      //CHECK IF FILE EXTENSION IS IN THE LIST
      if ($.inArray(fileType, validImageTypes) < 0) {
        $("#add-item #messageText").empty();
        $("#add-item #messageText").append("<span class='text-danger'>Please insert pictures only!</span>");
        //REMOVE THE IMAGES DISPLAYED
        $("#output").empty();
        this.value = null;
      } else {
        //REMOVE THE ERROR MESSAGES
        $("#add-item #messageText").empty();
        $("#output").append(
          //GET THE URL OF INPUT IMAGE AND SET AS SOURCE IN IMAGE TAG
          "<div class='ratio ratio-1x1 bg-light shadow rounded-4 align-self-center' style='max-width: 300px; margin:10px;'>" +
              "<img class='inputImages rounded-4' src='"+URL.createObjectURL(event.target.files[i])+"'/>" +
          "</div>"
        );
      }
      i++;
    }
  });

  $("#item-name").change(function () {
    updateButton();
  });
  $("#category").change(function () {
    updateButton();
  });
  $("#price").change(function () {
    updateButton();
  });
  $("#stocks").change(function () {
    updateButton();
  });
  $("#description").change(function () {
    updateButton();
  });
  
  //CHECK IF THERE IS EMPTY VALUE
  function hasFilled() {
    if ($("#item-name").val().length == 0) return false;
    if ($("#category").val().length == 0) return false;
    if ($("#price").val().length == 0) return false;
    if ($("#stocks").val().length == 0) return false;
    if ($("#description").val().length == 0) return false;

    return true;
  }
  //CHECK FORM AND UPDATE THE BUTTON
  function updateButton() {
    if (hasFilled()) {
      $("#edit-item-btn").prop("disabled", false);
      $("#add-item-btn").prop("disabled", false);
    } else {
      $("#edit-item-btn").prop("disabled", true);
      $("#add-item-btn").prop("disabled", true);
    }
  }
  
  //FUNCTION TO LOAD THE ITEMS DATA
  function getItemsData() {
    $("#item-list").empty();
    //DO AJAX TO GET THE ITEMS DATA FROM THE SERVER
    $.post("../assets/scripts/server/item_data.php", {requestType:"load-items"},function (data) {
      //CHECK IF JSON DATA IS NOT EMPTY
      if (data) {
        //PUT THE JSON DATA INTO ARRAY
        let itemInfo = JSON.parse(data);
        //GET THE DATA ON EACH JSON
        for (let i = 0; i < itemInfo.length; i++) {
          let item = itemInfo[i];
          let color = "primary";
          let stocks = item.stocks;

          //SET THE COLOR OF STOCKS BAR DEPENDS ON THE COUNT OF STOCKS
          if (stocks <= 25) {
            color = "danger";
          } else if (stocks <= 50) {
            color = "warning";
          } else {
            color = "primary";
          }
          //PUT THE TABLE ROW INTO ITEM LIST DIVIDER WITH THE ITEM VALUES
          $("#item-list").append(
            "<tr class='align-middle'>"
            +"   <td class='ps-4 py-4 id'>"+item.id+"</td>"
            +"    <td class='ps-4'>"
            +"        <div class='d-flex align-items-center'>"
            +"            <span class='position-relative rounded-5 bg-white shadow-sm me-2' style='width:50px; height:50px'>"
            +"                <img class='position-absolute m-1 bg-secondary rounded-5' src='../assets/images/items/"+item.id+"/"+item.images[0]+"' alt='' style='width:42px; height:42px'>"
            +"           </span>"
            +"            <strong>"+item.name+"</strong>"
            +"        </div>"
            +"    </td>"
            +"    <td class='ps-4 stocks-parent'>"
            +"        <p class='p-0 m-0'><span class='stocks'>"+item.stocks+"</span>/100</p>"
            +"        <div class='progress bg-dark bg-opacity-25'>"
            +"            <div class='progress-bar bg-"+color+"' role='progressbar' style='width:"+item.stocks+"%'></div>"
            +"        </div>"
            +"    </td>"
            +"    <td class='ps-4'><strong>"+item.price+"</strong></td>"
            +"    <td class='ps-4'><strong>"+item.sold+"</strong></td>"
            +"    <td class='ps-4 d'>"
            +"        <div class='d-flex '>"
            +"            <i class='editItem bi-pencil-square fs-5 text-secondary icon-btn' data-bs-toggle='modal' data-bs-target='#items'></i>"
            +"            <i class='deleteItem bi bi-trash fs-5 text-danger icon-btn' data-bs-toggle='modal' data-bs-target='#confirm'></i>"
            +"        </div>"
            +"    </td>"
            +"</tr>"
          )
        }
      }
    });
  }

  function serverResponseTranslate(data){
    $("#add-item #messageText").empty();
    $("#confirmation #messageText").empty();
    //ADD AND EDIT FORM RESPONSES
    if(data=="addSuccess"){
      $("#add-item #messageText").append("<span class='text-success'>Item uploaded successfully!</span>")
      $("#add-item")[0].reset();
      $("#add-item #output").empty();
    }
    if(data=="editSuccess"){
      $("#add-item #messageText").append("<span class='text-success'>Item edited successfully!</span>")
    }
    if(data=="addFailed"){
      $("#add-item #messageText").append("<span class='text-danger'>Item failed to upload!</span>")
    }
    if(data=="editFailed"){
      $("#add-item #messageText").append("<span class='text-danger'>Item failed to edit!</span>")
    }
    if(data=="noImage"){
      $("#add-item #messageText").append("<span class='text-danger'>Please insert image!</span>")
    }
    if(data=="notImage"){
      $("#add-item #messageText").append("<span class='text-danger'>File is not an image!</span>")
    }
    if(data=="existsImage"){
      $("#add-item #messageText").append("<span class='text-danger'>File already existed!</span>")
    }
    if(data=="largeImage"){
      $("#add-item #messageText").append("<span class='text-danger'>File size is too large! (maximum size 2mb)</span>")
    }
    if(data=="formatImage"){
      $("#add-item #messageText").append("<span class='text-danger'>Only (jpg, jpeg, png) allowed!</span>")
    }
    if(data=="failedImage"){
      $("#add-item #messageText").append("<span class='text-danger'>File failed to process!</span>")
    }

    //DELETE ITEM FOR RESPONSES
    if(data=="deleteSuccess"){
      $("#confirmation #messageText").append("<span class='text-success'>Item deleted successfully!</span>")
    }
    if(data=="deleteFailed"){
      $("#confirmation #messageText").append("<span class='text-danger'>Item deletion failed!</span>")
    }
    
    //REFRESH BUTTON
    $("#category").trigger('change');
  }
});
