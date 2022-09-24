$(document).ready(function () {
  //DISABLE THE ADD ITEM BUTTON
  $("#add-item-btn").prop("disabled", true);

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
        $("#add-item")[0].reset();
        $("#output").empty();
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
    if (hasFilled()) $("#add-item-btn").prop("disabled", false);
    else $("#add-item-btn").prop("disabled", true);
  }

  /*
  $("#add-item").submit(function () {
    event.preventDefault();
    console.log(new FormData(this));

    $.post(
      "../script/server/add_item.php",
      {
        data: new FormData(this),
      },
      function (data) {
        console.log(data);
      }
    );
  });*/
});
