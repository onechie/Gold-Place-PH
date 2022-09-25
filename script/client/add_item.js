$(document).ready(function () {
  //DISABLE THE ADD ITEM BUTTON
  $("#add-item-btn").prop("disabled", true);

  //IF EDIT ITEM IS CLICKED RUN THE FUNCTION
  $("#item-list").on("click", ".editItem", function () {
    let id = $(this).parentsUntil("tr").siblings(".id").text();
    //DO AJAX TO GET THE ITEMS DATA FROM THE SERVER
    $.post("../script/server/edit_item.php", { dataRequest: id }, function (data) {
      //PUT THE JSON DATA INTO ARRAY
      let itemInfo = JSON.parse(data);

      $("#id").val(itemInfo.id);
      $("#item-name").val(itemInfo.name);
      $("#category").val(itemInfo.category);
      $("#price").val(itemInfo.price);
      $("#stocks").val(itemInfo.stocks);
      $("#description").val(itemInfo.description);
      $("#category").trigger("change");

      //SET IMAGES TO SPECIFIED CLASS
      $("#output").empty();
      for (let i = 0; i < itemInfo.images.length; i++) {
        $("#output").append(
          "<img class='inputImages rounded-4 shadow' src='../script/server/images/"+itemInfo.id+"/"+ itemInfo.images[i]+"' />"
        );
      }
      $("#add-item-btn").hide();
      $("#edit-item-btn").show();
      $("#requestType").val("edit");
    });
  });

  //IF ADD BUTTON IS CLICKED RESET THE FORM AND READY FOR ADDING
  $("#addItemMainButton").click(function () {
    $("#requestType").val("add");
    $("#add-item")[0].reset();
    $("#category").trigger("change");
    $("#add-item-btn").show();
    $("#edit-item-btn").hide();
    $("#output").empty();
  });

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
        $("#errorText").empty();
        $("#errorText").append("Please insert pictures only.");
        //REMOVE THE IMAGES DISPLAYED
        $("#output").empty();
        this.value = null;
      } else {
        //REMOVE THE ERROR MESSAGES
        $("#errorText").empty();
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

  //AJAX FOR ADDING ALL THE FORM DATA
  $("#add-item").on("submit", function (e) {
    e.preventDefault();
    $.ajax({
      url: "../script/server/add_item.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
    }).done(function (data) {
      console.log(data);
      if (data == "done") {
        $("#errorText").empty();
        $("#add-item")[0].reset();
        $("#errorText").append("<span class='text-success'>Item uploaded successfully!</span>");
        $("#output").empty();
        updateButton();
      }
      if (data == "error") {
        $("#errorText").empty();
        $("#errorText").append("<span class='text-error'>ERROR! empty or 0 below is not allowed.</span>");
        updateButton();
      }
      if (data == "no-picture") {
        $("#errorText").empty();
        $("#errorText").append("<span class='text-error'>Please insert picture.</span>");
        updateButton();
      }
    });
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
    if (hasFilled()){
      $("#edit-item-btn").prop("disabled", false);
      $("#add-item-btn").prop("disabled", false);
    } 
    else{
      $("#edit-item-btn").prop("disabled", true);
      $("#add-item-btn").prop("disabled", true);
    } 
  }
});
