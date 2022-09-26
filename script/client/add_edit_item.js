$(document).ready(function () {
  //DISABLE THE ADD ITEM BUTTON
  $("#add-item-btn").prop("disabled", true);

  //IF EDIT ITEM IS CLICKED RUN THE FUNCTION
  $("#item-list").on("click", ".editItem", function () {
    let id = $(this).parentsUntil("tr").siblings(".id").text();
    //DO AJAX TO GET THE ITEMS DATA FROM THE SERVER
    $.post(
      "../script/server/item_data.php",
      { dataRequest: id },
      function (data) {
        //PUT THE JSON DATA INTO ARRAY
        let itemInfo = JSON.parse(data);

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
            "<img class='inputImages rounded-4 shadow' src='../script/server/images/" +
              itemInfo.id +
              "/" +
              itemInfo.images[i] +
              "' />"
          );
        }
        $("#add-item #add-item-btn").hide();
        $("#add-item #edit-item-btn").show();
        $("#add-item #requestType").val("edit");
      }
    );
  });

  //AJAX FOR ADDING ALL THE FORM DATA
  $("#add-item").on("submit", function (e) {
    e.preventDefault();
    $.ajax({
      url: "../script/server/add_edit_item.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
    }).done(function (data) {
      serverResponseTranslate(data);
    });
  });

  //IF ADD BUTTON IS CLICKED RESET THE FORM AND READY FOR ADDING
  $("#addItemMainButton").click(function () {
    $("#add-item #requestType").val("add");
    $("#add-item")[0].reset();
    $("#add-item #category").trigger("change");
    $("#add-item #add-item-btn").show();
    $("#add-item #edit-item-btn").hide();
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
      url: "../script/server/add_edit_item.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
    }).done(function (data) {
      serverResponseTranslate(data);
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
          "<img class='inputImages rounded-4 shadow' src='" +
            //GET THE URL OF INPUT IMAGE AND SET AS SOURCE IN IMAGE TAG
            URL.createObjectURL(event.target.files[i]) +
            "' />"
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

    $("#category").trigger('change');
  }
});
