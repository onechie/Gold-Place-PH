$(document).ready(function () {
  "use strict";

  //VALUES
  var emValue = "";
  var pwValue = "";

  var isEmOk = false;
  var isPwOk = false;
  //SELECTORS FOR WARNING TEXT
  const emWarning = $(".em-w");
  const pwWarning = $(".pw-w");

  //SELECTORS FOR INPUT
  const emInput = $("#emInput");
  const pwInput = $("#pwInput");

  //TOAST OBJECT
  const toast = new bootstrap.Toast($("#liveToast"));
  const toastBody = $(".toast-body");

  const errorIcon = "<i class='bi bi-exclamation-circle-fill'></i>";

  $("#log-submit").prop("disabled", true);

  //SHOW TOAST IF VERIFY VALUE IS SET FOR ACCOUNT VERIFICATION
  if ($("#verify").val() != "") {
    var getCode = $("#verify").val();
    toastBody.empty();
    toastBody.load(
      "./assets/scripts/server/catch_customer_request.php",
      {
        requestType: "verify-email",
        code: getCode,
      },
      function (data) {
        
        if(data == "error"){
          location.href = 'login.php';
        } else {
          const toast = new bootstrap.Toast($("#liveToast"));
          toast.show();
        }
      }
    );
  }

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
      $.post("./assets/scripts/server/catch_customer_request.php",{
        requestType: "v-log-email",
        email: emValue
      }, function (data) {
        if(data == "not_registered"){
          emWarning.append("is not registered " + errorIcon);
        }
        if(data == "not_verified"){
          emWarning.append("is not verified " + errorIcon);
        }
        if(data == "ok"){
          isEmOk = true;
        }
        updateButton(isEmOk, isPwOk);
      })
    }
    updateButton(isEmOk, isPwOk);
  });

  //PASSWORD VALIDATION
  pwInput.keyup(function () {
    pwWarning.empty();
    isPwOk = false;
    pwValue = pwInput.val();
    if (pwValue.length <= 0) {
      pwWarning.append(errorIcon)
    } else {
      isPwOk = true;
    }

    updateButton(isEmOk, isPwOk);
  });

  //LOGIN CLICK
  $("#log-submit").click(function () {
    toastBody.empty();
    $.post("./assets/scripts/server/catch_customer_request.php",{
      email: emValue,
      password: pwValue,
      requestType: "v-log-final"
    },function(data){
      let str = data;
      if(data == "wrong_pass"){
        toastBody.append("Wrong Password!")
        toast.show();
      }
      if(data == "not_verified"){
        toastBody.append("Please verify your email before you log in.")
        toast.show();
      }
      if(str.includes("o_k")){
        toastBody.append("Welcome, "+str.replace("o_k", "")+"!")
        toast.show();
        setTimeout(function () {
          location.reload();
        }, 2000);
        setTimeout(function () {
          $(".loading").fadeOut();
        }, 1000);
        $(".navbar").fadeOut();
        $(".remove-footer").fadeOut();
        $(".loading").load("./assets/scripts/server/loading.php");
        $(".loading").hide();
        $(".loading").fadeIn();
      }

    })
  });

  function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})$/;
    return regex.test(email);
  }
  function updateButton(em, pw) {
    if (em && pw) {
      $("#log-submit").prop("disabled", false);
    } else {
      $("#log-submit").prop("disabled", true);
    }
  }

});


