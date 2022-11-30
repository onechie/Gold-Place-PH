$(document).ready(function () {
  "use strict";

  //VALUES
  var fnValue = "";
  var lnValue = "";
  var emValue = "";
  var phValue = "";
  var pwValue = "";

  //VALID INDICATOR
  var isFnOk = false;
  var isLnOk = false;
  var isEmOk = false;
  var isPhOk = false;
  var isPwOk = false;

  //SELECTORS FOR WARNING TEXT
  const fnWarning = $(".fn-w");
  const lnWarning = $(".ln-w");
  const emWarning = $(".em-w");
  const phWarning = $(".ph-w");
  const pwWarning = $(".pw-w");

  //SELECTORS FOR INPUT
  const fnInput = $("#fnInput");
  const lnInput = $("#lnInput");
  const emInput = $("#emInput");
  const phInput = $("#phInput");
  const pwInput = $("#pwInput");
  
  //CSRFT TOKEN
  const token = $(".token").val();

  const registerUrl = "./assets/scripts/server/request/register_request.php";

  //LOADING
  const loading = $("#loading");
  loading.toggle();
  loading.toggleClass("d-flex");

  //TOAST OBJECT
  const toast = new bootstrap.Toast($("#liveToast"));
  const toastBody = $(".toast-body");

  const errorIcon = "<i class='bi bi-exclamation-circle-fill'></i>";

  $("#ca-submit").prop("disabled", true);

  //FIRSTNAME VALIDATION
  fnInput.keyup(function () {
    fnWarning.empty();
    isFnOk = false;
    fnValue = fnInput.val();
    if (!isNameValid(fnValue)) {
      fnWarning.html("is not valid " + errorIcon);
      if (fnValue.length <= 0) {
        fnWarning.empty();
        fnWarning.html(errorIcon);
      }
    } else if (fnValue.length >= 20) {
      fnWarning.html("is too long " + errorIcon);
    } else {
      isFnOk = true;
    }
    updateButton(isFnOk, isLnOk, isEmOk, isPhOk, isPwOk);
  });

  //LASTNAME VALIDATION
  lnInput.keyup(function () {
    lnWarning.empty();
    isLnOk = false;
    lnValue = lnInput.val();
    if (!isNameValid(lnValue)) {
      lnWarning.html("is not valid " + errorIcon);
      if (lnValue.length <= 0) {
        lnWarning.empty();
        lnWarning.html(errorIcon);
      }
    } else if (lnValue.length >= 20) {
      lnWarning.html("is too long " + errorIcon);
    } else {
      isLnOk = true;
    }

    updateButton(isFnOk, isLnOk, isEmOk, isPhOk, isPwOk);
  });

  //EMAIL VALIDATION
  emInput.keyup(function () {
    emWarning.empty();
    isEmOk = false;
    emValue = emInput.val();
    if (!isEmailValid(emValue)) {
      emWarning.html("is not valid " + errorIcon);
      if (emValue.length <= 0) {
        emWarning.empty();
        emWarning.html(errorIcon);
      }
    } else {
      $.post(
        registerUrl,
        {
          email: emValue,
          requestType: "validate_email",
          token: token
        },
        function (data) {
          if (data == "used") {
            emWarning.html("is already used " + errorIcon);
          }
          if (data == "ok") {
              emWarning.empty();
            isEmOk = true;
          }
        }
      );
    }
    updateButton(isFnOk, isLnOk, isEmOk, isPhOk, isPwOk);
  });

  //PHONE NUMBER VALIDATION
  phInput.keyup(function () {
    phWarning.empty();
    isPhOk = false;
    phValue = phInput.val();
    if (!isPhoneValid(phValue)) {
      phWarning.html("is not valid " + errorIcon);
      if (phValue.length <= 0) {
        phWarning.empty();
        phWarning.html(errorIcon);
      }
    } else {
      $.post(
        registerUrl,
        {
          phone: phValue,
          requestType: "validate_phone",
          token: token
        },
        function (data) {
          if (data == "used") {
            phWarning.html("is already used " + errorIcon);
          }
          if (data == "ok") {
            phWarning.empty();
            isPhOk = true;
          }
        }
      );
    }

    updateButton(isFnOk, isLnOk, isEmOk, isPhOk, isPwOk);
  });

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

    updateButton(isFnOk, isLnOk, isEmOk, isPhOk, isPwOk);
  });

  //CREATE ACCOUNT CLICK
  $("#ca-submit").click(function () {
    loading.toggleClass("d-flex");
    loading.toggle();
    toastBody.empty();
    $.post(
      registerUrl,
      {
        firstname: fnValue,
        lastname: lnValue,
        email: emValue,
        phone: phValue,
        password: pwValue,
        requestType: "create_account",
        token: token
      },
      function (data) {
        loading.toggleClass("d-flex");
        loading.toggle();
        if (data == "ok") {
          toastBody.append(
            "Registered successfully! Please check your email for verification."
          );
          toast.show();
          reset();
        } else {
          toastBody.append(data);
          toast.show();
        }
      }
    );
  });

  function isNameValid(name) {
    var regex = /^([a-zA-Z])+([-. ]([a-zA-Z])+)?([-. ]([a-zA-Z])+)?$/;
    return regex.test(name);
  }
  function isEmailValid(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})$/;
    return regex.test(email);
  }
  function isPhoneValid(phone) {
    var regex = /((^(\+63)(\d{10}))|(^(09)(\d{9}))|(^(9)(\d{9})))$/;
    return regex.test(phone);
  }

  function updateButton(fn, ln, em, ph, pw) {
    if (fn && ln && em && ph && pw) {
      $("#ca-submit").prop("disabled", false);
    } else {
      $("#ca-submit").prop("disabled", true);
    }
  }
  function reset() {
    fnInput.val("");
    lnInput.val("");
    emInput.val("");
    phInput.val("");
    pwInput.val("");

    isFnOk = false;
    isLnOk = false;
    isEmOk = false;
    isPhOk = false;
    isPwOk = false;

    updateButton(isFnOk, isLnOk, isEmOk, isPhOk, isPwOk);
  }
});
