$(document).ready(function () {
  "use strict";

  //VALUES
  var pwValue = "";
  var cpwValue = "";

  var isPwOk = false;
  var isCpwOk = false;

  //SELECTORS FOR WARNING TEXT
  const pwWarning = $(".pw-w");
  const cpwWarning = $(".cpw-w");

  //SELECTORS FOR INPUT
  const pwInput = $("#pwInput");
  const cpwInput = $("#cpwInput");

  //TOAST OBJECT
  const toast = new bootstrap.Toast($("#liveToast"));
  const toastBody = $(".toast-body");

  //LOADING
  const loading = $("#loading");
  loading.toggle();
  loading.toggleClass("d-flex");

  const resetPwURL =
    "./assets/scripts/server/request/reset_password_request.php";

  const token = $(".token").val();

  const errorIcon = "<i class='bi bi-exclamation-circle-fill'></i>";

  $("#reset_password").prop("disabled", true);

  if ($("#password_reset").val() != "") {
    var resetToken = $("#password_reset").val();
    toastBody.empty();
    $.post(
      resetPwURL,
      {
        requestType: "verify-reset-request",
        reset_token: resetToken,
        token: token
      },
      function (data) {
        if(data == 'ok'){
        } else {
          location.href = "login.php";
        }
      }
    );
  }

  //PASSWORD VALIDATION
  pwInput.keyup(function () {
    pwWarning.empty();
    isPwOk = false;
    pwValue = pwInput.val();
    if (pwValue.length <= 7) {
      pwWarning.html("is too short " + errorIcon);
      if (pwValue.length <= 0) {
        pwWarning.empty();
        pwWarning.html(errorIcon);
      }
    } else if (pwValue.length >= 50) {
      pwWarning.html("is too long " + errorIcon);
    } else {
      isPwOk = true;
    }
    cpwInput.trigger("keyup");
    updateButton(isPwOk, isCpwOk);
  });
  //PASSWORD VALIDATION
  cpwInput.keyup(function () {
    cpwWarning.empty();
    isCpwOk = false;
    cpwValue = cpwInput.val();
    if (cpwValue.length <= 0) {
      cpwWarning.empty();
      cpwWarning.html(errorIcon);
    } else if (cpwValue != pwValue) {
      cpwWarning.html("not matched " + errorIcon);
    } else {
      isCpwOk = true;
    }

    updateButton(isPwOk, isCpwOk);
  });

  //LOGIN CLICK
  $("#reset_password").click(function (e) {
    e.preventDefault();
    loading.toggleClass("d-flex");
    loading.toggle();
    toastBody.empty();
    $.post(
      resetPwURL,
      {
        password: cpwInput.val(),
        reset_token: $("#password_reset").val(),
        requestType: "reset_password",
        token: token,
      },
      function (data) {
        loading.toggleClass("d-flex");
        loading.toggle();
        if (data == "failed") {
          toastBody.append("Failed to reset your password.");
          toast.show();
        }
        if (data == "ok") {
          toastBody.append("Your password successfully reset!");
          toast.show();
          reset();
        }
      }
    );
  });

  function reset() {
    pwInput.val("");
    cpwInput.val("");

    pwWarning.html('');
    cpwWarning.html('');

    isPwOk = false;
    isCpwOk = false;

    updateButton(isPwOk, isCpwOk);
  }

  function updateButton(pw, cpw) {
    if (pw && cpw) {
      $("#reset_password").prop("disabled", false);
    } else {
      $("#reset_password").prop("disabled", true);
    }
  }
});
