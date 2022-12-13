$(document).ready(function () {
  "use strict";

  //VALUES
  var emValue = "";

  var isEmOk = false;
  //SELECTORS FOR WARNING TEXT
  const emWarning = $(".em-w");

  //SELECTORS FOR INPUT
  const emInput = $("#emInput");
  //TOAST OBJECT
  const toast = new bootstrap.Toast($("#liveToast"));
  const toastBody = $(".toast-body");

  //LOADING
  const loading = $("#loading");
  loading.toggle();
  loading.toggleClass("d-flex");

  const loginUrl = "./assets/scripts/server/request/login_request.php";
  const forgotPwURL = "./assets/scripts/server/request/forgot_password_request.php";
  
  const token = $('.token').val();

  const errorIcon = "<i class='bi bi-exclamation-circle-fill'></i>";

  $("#email-submit").prop("disabled", true);

  //EMAIL VALIDATION
  emInput.keyup(function () {
    emWarning.empty();
    isEmOk = false;
    emValue = emInput.val();
    if (!isEmailValid(emValue)) {
      emWarning.html("is not valid " + errorIcon);
      if (emValue.length <= 0) {
        emWarning.html(errorIcon);
      }
    } else {
      $.post(
        loginUrl,
        {
          requestType: "validate_email",
          email: emValue,
          token: token
        },
        function (data) {
          if (data == "not_registered") {
            emWarning.html("is not registered " + errorIcon);
          }
          if (data == "not_verified") {
            emWarning.html("is not verified " + errorIcon);
          }
          if (data == "ok") {
            emWarning.empty();
            isEmOk = true;
          }
          updateButton(isEmOk);
        }
      );
    }
    updateButton(isEmOk);
  });

  //LOGIN CLICK
  $("#email-submit").click(function (e) {
    e.preventDefault();
    loading.toggleClass("d-flex");
    loading.toggle();
    toastBody.empty();
    $.post(
      forgotPwURL,
      {
        email: emValue,
        requestType: "forgot_password",
        token: token
      },
      function (data) {
        loading.toggleClass("d-flex");
        loading.toggle();
        if (data == "failed") {
          toastBody.append("Email sending failed.");
          toast.show();
        }
        if (data == "ok") {
          toastBody.append("Link for password reset sent successfully!");
          emInput.val('');
          isEmOk = false;
          emValue = '';
          updateButton(isEmOk);
          toast.show();
        }
      }
    );
  });

  function isEmailValid(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})$/;
    return regex.test(email);
  }
  function updateButton(em) {
    if (em) {
      $("#email-submit").prop("disabled", false);
    } else {
      $("#email-submit").prop("disabled", true);
    }
  }
});
