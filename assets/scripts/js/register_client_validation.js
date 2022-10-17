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

  //LOADING
  const loading = $("#loading");
  loading.toggle()
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
    if (!isName(fnValue)) {
      fnWarning.append("is not valid " + errorIcon);
      if (fnValue.length <= 0) {
        fnWarning.empty();
        fnWarning.append(errorIcon);
      }
    } else if (fnValue.length >= 20) {
      fnWarning.append("is too long " + errorIcon);
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
    if (!isName(lnValue)) {
      lnWarning.append("is not valid " + errorIcon);
      if (lnValue.length <= 0) {
        lnWarning.empty();
        lnWarning.append(errorIcon);
      }
    } else if (lnValue.length >= 20) {
      lnWarning.append("is too long " + errorIcon);
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
    if (!isEmail(emValue)) {
      emWarning.append("is not valid " + errorIcon);
      if (emValue.length <= 0) {
        emWarning.empty();
        emWarning.append(errorIcon);
      }
    } else {
      $.post(
        "./assets/scripts/server/catch_customer_request.php",
        {
          email: emValue,
          requestType: "v-reg-email",
        },
        function (data) {
          if (data == "used") {
            emWarning.append("is already used " + errorIcon);
          }
          if (data == "ok") {
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
    if (!isPhone(phValue)) {
      phWarning.append("is not valid " + errorIcon);
      if (phValue.length <= 0) {
        phWarning.empty();
        phWarning.append(errorIcon);
      }
    } else {
      $.post(
        "./assets/scripts/server/catch_customer_request.php",
        {
          phone: phValue,
          requestType: "v-reg-phone",
        },
        function (data) {
          if (data == "used") {
            phWarning.append("is already used " + errorIcon);
          }
          if (data == "ok") {
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
      pwWarning.append("is too short " + errorIcon);
      if (pwValue.length <= 0) {
        pwWarning.empty();
        pwWarning.append(errorIcon);
      }
    } else if (pwValue.length >= 50) {
      pwWarning.append("is too long " + errorIcon);
    } else {
      isPwOk = true;
    }

    updateButton(isFnOk, isLnOk, isEmOk, isPhOk, isPwOk);
  });

  //CREATE ACCOUNT CLICK
  $("#ca-submit").click(function () {
    loading.toggleClass("d-flex");
    loading.toggle()
    toastBody.empty();
    $.post(
      "./assets/scripts/server/catch_customer_request.php",
      {
        firstname: fnValue,
        lastname: lnValue,
        email: emValue,
        phone: phValue,
        password: pwValue,
        requestType: "v-reg-final",
      },
      function (data) {
        loading.toggleClass("d-flex");
        loading.toggle()
        if(data == "ok"){
          toastBody.append("Registered successfully! Please check your email for verification.")
          toast.show();
          reset();
        } else {
          toastBody.append(data)
          toast.show();
        }
      }
    );
  });

  function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})$/;
    return regex.test(email);
  }

  function isPhone(phone) {
    var regex = /((^(\+63)(\d{10}))|(^(0)(\d{10}))|(^(9)(\d{9})))$/; // or /^(\+\d{2})?(\d{1})?\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
    return regex.test(phone);
  }

  function isName(name) {
    var regex = /^([a-zA-Z])+([-. ]([a-zA-Z])+)?([-. ]([a-zA-Z])+)?$/;
    return regex.test(name);
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
