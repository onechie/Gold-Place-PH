$(document).ready(function () {
  "use strict";
  const userList = $("#users-list");

  const token = $(".token").val();

  const toastBody = $(".toast-body");
  const toast = new bootstrap.Toast($("#liveToast"));
  const SA_URL = "../assets/scripts/server/request/system_admin_request.php";

  const errorIcon = "<i class='bi bi-exclamation-circle-fill'></i>";

  //DELETE BUTTON
  userList.on("click", ".deleteUser", function () {
    $("#confirmation #messageText").empty();
    let id = $(this).parentsUntil("tr").siblings(".id").text();
    $("#confirmation-message").empty();
    $("#confirmation-message").append(
      "Are you sure do you want to delete user [ID = " + id + "]?"
    );
    $("#confirmation #messageText").empty();
    $("#confirmation #id").val(id);
    $("#confirmation #requestType").val("delete-user");
  });
  //AJAX FOR DELETING ITEM
  $("#confirmation").on("submit", function (e) {
    e.preventDefault();
    $.ajax({
      url: SA_URL,
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
    }).done(function (data) {
      if (data == "ok") {
        toastBody.text("User deleted successfully!");
        toast.show();
      } else {
        toastBody.text("User deletion failed!");
        toast.show();
      }
    });
  });
});
