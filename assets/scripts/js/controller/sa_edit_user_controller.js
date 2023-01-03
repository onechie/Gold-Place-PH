$(document).ready(function () {
  "use strict";
  const userList = $("#users-list");

  //VALUES
  var fnValue = "";
  var lnValue = "";
  var emValue = "";
  var phValue = "";

  //VALID INDICATOR
  var isFnOk = true;
  var isLnOk = true;
  var isEmOk = true;
  var isPhOk = true;

  //SELECTORS FOR WARNING TEXT
  const fnWarning = $("#edit-user .fn-w");
  const lnWarning = $("#edit-user .ln-w");
  const emWarning = $("#edit-user .em-w");
  const phWarning = $("#edit-user .ph-w");

  //SELECTORS FOR EDIT USER
  const fnEdit = $("#edit-user #first-name");
  const lnEdit = $("#edit-user #last-name");
  const emEdit = $("#edit-user #email");
  const phEdit = $("#edit-user #phone");
  const utEdit = $("#edit-user #user-type");
  const veEdit = $("#edit-user #verified");
  const stEdit = $("#edit-user #status");
  const uidEdit = $("#edit-user #user_id");

  let prevEmail = "";
  let prevPhone = "";

  const token = $(".token").val();
  const toastBody = $(".toast-body");
  const toast = new bootstrap.Toast($("#liveToast"));

  const SA_URL =
    "../assets/scripts/server/request/system_admin_request.php";

  //VALIDATION START

  const errorIcon = "<i class='bi bi-exclamation-circle-fill'></i>";

  utEdit.change(function(){
    updateButton(isFnOk, isLnOk, isEmOk, isPhOk);
  })
  veEdit.change(function(){
    updateButton(isFnOk, isLnOk, isEmOk, isPhOk);
  })
  stEdit.change(function(){
    updateButton(isFnOk, isLnOk, isEmOk, isPhOk);
  })

  //FIRSTNAME VALIDATION
  fnEdit.keyup(function () {
    fnWarning.empty();
    isFnOk = false;
    fnValue = fnEdit.val();
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

    updateButton(isFnOk, isLnOk, isEmOk, isPhOk);
  });

  //LASTNAME VALIDATION
  lnEdit.keyup(function () {
    lnWarning.empty();
    isLnOk = false;
    lnValue = lnEdit.val();
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

    updateButton(isFnOk, isLnOk, isEmOk, isPhOk);
  });

  //EMAIL VALIDATION
  emEdit.keyup(function () {
    emWarning.empty();
    isEmOk = false;
    emValue = emEdit.val();
    if (!isEmail(emValue)) {
      emWarning.append("is not valid " + errorIcon);
      if (emValue.length <= 0) {
        emWarning.empty();
        emWarning.append(errorIcon);
      }
    } else {
      if (emValue == prevEmail) {
        isEmOk = true;
      } else {
        $.post(
          "../assets/scripts/server/request/register_request.php",
          {
            email: emValue,
            requestType: "validate_email",
            token: token,
          },
          function (data) {
            if (data == "used") {
              emWarning.append("is already used " + errorIcon);
            }
            if (data == "ok") {
              isEmOk = true;
            }
            updateButton(isFnOk, isLnOk, isEmOk, isPhOk);
          }
        );
      }
    }
    updateButton(isFnOk, isLnOk, isEmOk, isPhOk);
  });

  //PHONE NUMBER VALIDATION
  phEdit.keyup(function () {
    phWarning.empty();
    isPhOk = false;
    phValue = phEdit.val();
    if (!isPhone(phValue)) {
      phWarning.append("is not valid " + errorIcon);
      if (phValue.length <= 0) {
        phWarning.empty();
        phWarning.append(errorIcon);
      }
    } else {
      $.post(
        "../assets/scripts/server/request/register_request.php",
        {
          phone: phValue,
          requestType: "validate_phone",
          token: token,
        },
        function (data) {
          if (data == "used") {
            phWarning.append("is already used " + errorIcon);
          }
          if (data == "ok") {
            isPhOk = true;
          }
          updateButton(isFnOk, isLnOk, isEmOk, isPhOk);
        }
      );
    }

    updateButton(isFnOk, isLnOk, isEmOk, isPhOk);
  });

  //VALIDATION END

  userList.on("click", ".editUser", function () {
    $("#edit-user-btn").prop("disabled", true);
    let id = $(this).parentsUntil("tr").siblings(".id").text();
    $.post(
     SA_URL,
      {
        id: id,
        requestType: "view-user",
        token: token,
      },
      function (data) {
        if (data && data != "null") {
          let users = JSON.parse(data);
          let user_info = users.user_info;
          let user_orders = users.user_orders;

          let defaultImg = "../assets/images/defaults/default-profile.png";
          let currentImg = "";

          if (user_info.image == "") {
            currentImg = defaultImg;
          } else {
            currentImg =
              "../assets/images/users/" + user_info.id + "/" + user_info.image;
          }
          /*
            userName.text(user_info.name);
            userEmail.text(user_info.email);
            userPhone.text(user_info.phone);
            userImage.prop("src", currentImg);
            userTotal.text(user_orders.orders);
            userCancelled.text(user_orders.cancelled);
            userDelivered.text(user_orders.delivered);
            */

          fnEdit.val(user_info.firstname);
          lnEdit.val(user_info.lastname);
          emEdit.val(user_info.email);
          phEdit.val(user_info.phone);
          utEdit.val(user_info.type);
          veEdit.val(user_info.verified);
          stEdit.val(user_info.status);
          uidEdit.val(user_info.id);

          prevEmail = user_info.email;
          prevPhone = user_info.phone;
        }
      }
    );
  });

  $("#edit-user-btn").click(function(){
    let id = $(this).siblings("#user_id").val();
    $.post(SA_URL,{
        requestType: "edit-user",
        token: token,
        first_name: fnEdit.val(),
        last_name: lnEdit.val(),
        email: emEdit.val(),
        phone: phEdit.val(),
        user_type: utEdit.val(),
        verified: veEdit.val(),
        status: stEdit.val(),
        id: uidEdit.val()
    }, function(data){
        if(data == 'ok'){
            toastBody.text('User updated successfully!');
            toast.show();
        } else {
            toastBody.text('Failed to update user data!');
            toast.show();
        }
    })
    $("#edit-user-btn").prop("disabled", true);
  })

  function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})$/;
    return regex.test(email);
  }

  function isPhone(phone) {
    var regex = /((^(\+63)(\d{10}))|(^(09)(\d{9}))|(^(9)(\d{9})))$/; // or /^(\+\d{2})?(\d{1})?\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
    return regex.test(phone);
  }

  function isName(name) {
    var regex = /^([a-zA-Z])+([-. ]([a-zA-Z])+)?([-. ]([a-zA-Z])+)?$/;
    return regex.test(name);
  }
  function updateButton(fn, ln, em, ph) {
    if (fn && ln && em && ph) {
      $("#edit-user-btn").prop("disabled", false);
    } else {
      $("#edit-user-btn").prop("disabled", true);
    }
  }
});
