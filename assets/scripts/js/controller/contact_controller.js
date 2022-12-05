$(document).ready(function () {
  const name = $("#contact #name");
  const email = $("#contact #email");
  const message = $("#contact #message");
  const sendButton = $("#contact #send-mail");

  const errorName = $("#contact #errorName");
  const errorEmail = $("#contact #errorEmail");
  const errorMessage = $("#contact #errorMessage");
  const errorIcon = "<i class='bi bi-exclamation-circle-fill'></i>";
  const contactURL = "./assets/scripts/server/request/contact_request.php";

  const toast = new bootstrap.Toast($("#liveToast"));
  const toastBody = $(".toast-body");

  //CSRFT TOKEN
  const token = $(".token").val();

  //LOADING
  const loading = $("#loading");
  loading.toggle();
  loading.toggleClass("d-flex");

  sendButton.prop("disabled", true);

  sendButton.click(function () {
    loading.toggleClass("d-flex");
    loading.toggle();
    $.post(
      contactURL,
      {
        requestType: "send-email",
        token: token,
        name: name.val(),
        email: email.val(),
        message: message.val(),
      },
      function (data) {
        loading.toggleClass("d-flex");
        loading.toggle();
        if (data == "ok") {
          toastBody.html("Your email sent successfully!");
          toast.show();
          console.log("ok");
          reset();
        } else {
          toastBody.html("Failed to send the email!");
          toast.show();
        }
      }
    );
  });

  name.keyup(function () {
    errorName.empty();
    if (!isNameValid(name.val())) {
      errorName.html("is not valid " + errorIcon);
      if (name.val().length <= 0) {
        errorName.html(errorIcon);
      }
    }
    updateButton();
  });
  email.keyup(function () {
    errorEmail.empty();
    if (!isEmailValid(email.val())) {
      errorEmail.html("is not valid " + errorIcon);
      if (email.val().length <= 0) {
        errorEmail.html(errorIcon);
      }
    }
    updateButton();
  });
  message.keyup(function () {
    errorMessage.empty();
    if (message.val().length <= 0) {
      errorMessage.html(errorIcon);
    }
    updateButton();
  });

  function isNameValid(name) {
    var regex = /^([a-zA-Z])+([-. ]([a-zA-Z])+)?([-. ]([a-zA-Z])+)?$/;
    return regex.test(name);
  }
  function isEmailValid(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})$/;
    return regex.test(email);
  }
  function isMessageValid(message) {
    return message.length >= 1;
  }
  function updateButton() {
    if (
      isNameValid(name.val()) &&
      isEmailValid(email.val()) &&
      isMessageValid(message.val())
    ) {
      sendButton.prop("disabled", false);
    } else {
      sendButton.prop("disabled", true);
    }
  }
  function reset() {
    name.val("");
    email.val("");
    message.val("");

    updateButton();
  }
});
