$(document).ready(function () {
  "use strict";
  const userList = $("#users-list");
  const userName = $("#users #name");
  const userEmail = $("#users #email");
  const userPhone = $("#users #phone");
  const userImage = $("#users #image");
  const userTotal = $("#users #total");
  const userCancelled = $("#users #cancelled");
  const userDelivered = $("#users #delivered");

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
  const fnInput = $("#add-user #first-name");
  const lnInput = $("#add-user #last-name");
  const emInput = $("#add-user #email");
  const phInput = $("#add-user #phone");
  const pwInput = $("#add-user #password");
  $("#add-user-btn").prop("disabled", true);

  const adminUL_URL =
    "../assets/scripts/server/request/admin_user_list_request.php";

  let verRequired = "no";

  getUsersData();

  $(".users #search-user").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("#users-list tr").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });

  $("#sort_user_id").click(function () {
    sortTable("id");
  });
  $("#sort_user_name").click(function () {
    sortTable("name");
  });
  $("#sort_user_email").click(function () {
    sortTable("email");
  });
  $("#sort_user_purchased").click(function () {
    sortTable("purchased");
  });

  $("#refresh-users").click(function () {
    getUsersData();
  });
  //VALIDATION START

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
    console.log("test");
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
        "../assets/scripts/server/request/register_request.php",
        {
          email: emValue,
          requestType: "validate_email",
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
        "../assets/scripts/server/request/register_request.php",
        {
          phone: phValue,
          requestType: "validate_phone",
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
  //VALIDATION END

  userList.on("click", ".viewUser", function () {
    let id = $(this).parentsUntil("tr").siblings(".id").text();
    $.post(
      adminUL_URL,
      {
        id: id,
        requestType: "view-users",
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

          userName.text(user_info.name);
          userEmail.text(user_info.email);
          userPhone.text(user_info.phone);
          userImage.prop("src", currentImg);
          userTotal.text(user_orders.orders);
          userCancelled.text(user_orders.cancelled);
          userDelivered.text(user_orders.delivered);
        }
      }
    );
  });

  $("#add-user #verification_req").change(function () {
    if ($(this).is(":checked")) {
      verRequired = "yes";
    } else {
      verRequired = "no";
    }
    console.log("test");
  });
  $("#add-user-btn").click(function () {
    const first_name = $("#add-user #first-name").val();
    const last_name = $("#add-user #last-name").val();
    const email = $("#add-user #email").val();
    const phone = $("#add-user #phone").val();
    const user_type = $("#add-user #user-type").val();
    const password = $("#add-user #password").val();

    $.post(
      adminUL_URL,
      {
        requestType: "add-user",
        first_name,
        last_name,
        email,
        phone,
        user_type,
        password,
        verRequired,
      },
      function (data) {
        if (data == "ok") {
          $("#add-user #error_message").removeClass("text-danger");
          $("#add-user #error_message").addClass("text-success");
          $("#add-user #error_message").text("User Created successfully!");
        } else {
          $("#add-user #error_message").removeClass("text-success");
          $("#add-user #error_message").addClass("text-danger");
          $("#add-user #error_message").text(data);
        }
      }
    );
  });

  function sortTable(by) {
    var table,
      rows,
      switching,
      i,
      x,
      y,
      shouldSwitch,
      dir,
      switchcount = 0;
    table = document.getElementById("users-list");
    switching = true;

    dir = "asc";

    while (switching) {
      switching = false;
      rows = table.rows;

      for (i = 0; i < rows.length - 1; i++) {
        shouldSwitch = false;

        if (by == "id") {
          x = Number($(rows[i]).children(".id").text());
          y = Number(
            $(rows[i + 1])
              .children(".id")
              .text()
          );
        } else if (by == "name") {
          x = $(rows[i].getElementsByTagName("td")[1])
            .children("div")
            .children(".name")
            .text()
            .toLowerCase();
          y = $(rows[i + 1].getElementsByTagName("td")[1])
            .children("div")
            .children(".name")
            .text()
            .toLowerCase();
        } else if (by == "email") {
          x = $(rows[i]).children(".email").text().toLowerCase();
          y = $(rows[i + 1])
            .children(".email")
            .text()
            .toLowerCase();
        } else {
          x = Number(
            $(rows[i].getElementsByTagName("td")[4])
              .children(".purchased")
              .text()
          );
          y = Number(
            $(rows[i + 1].getElementsByTagName("td")[4])
              .children(".purchased")
              .text()
          );
        }

        if (dir == "asc") {
          if (x > y) {
            shouldSwitch = true;
            break;
          }
        } else if (dir == "desc") {
          if (x < y) {
            shouldSwitch = true;
            break;
          }
        }
      }
      if (shouldSwitch) {
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
        switchcount++;
      } else {
        if (switchcount == 0 && dir == "asc") {
          dir = "desc";
          switching = true;
        }
      }
    }
  }

  function getUsersData() {
    $.post(
      adminUL_URL,
      {
        requestType: "load-users",
      },
      function (data) {
        if (data && data != "null") {
          let users = JSON.parse(data);
          let htmlData = "";
          userList.empty();
          for (let i = 0; i < users.length; i++) {
            let user = users[i];
            let name = user.firstname + " " + user.lastname;
            let defaultImg = "'../assets/images/defaults/default-profile.png'";
            let currentImg = "";
            if (user.image == "") {
              currentImg = defaultImg;
            } else {
              currentImg =
                "'../assets/images/users/" + user.id + "/" + user.image + "'";
            }
            htmlData +=
              "<tr class='align-middle'>" +
              "    <td class='ps-4 py-4 id'>" +
              user.id +
              "</td>" +
              "    <td class='ps-4'>" +
              "        <div class='d-flex align-items-center'>" +
              "            <div class='position-relative rounded-5 bg-white shadow-sm me-2 flex-shrink-0' style='width:50px; height:50px;'>" +
              "                <img class='position-absolute m-1 rounded-5' src=" +
              currentImg +
              " alt='' style='width:42px; height:42px;');>" +
              "            </div>" +
              "            <strong class='text-capitalize name text-break'>" +
              name +
              "</strong>" +
              "        </div>" +
              "    </td>" +
              "    <td class='ps-4 email text-break'>" +
              user.email +
              "</td>" +
              "    <td class='ps-4 text-break'><strong>" +
              user.phone +
              "</strong></td>" +
              "    <td class='ps-4'><strong class='purchased'>" +
              user.purchased +
              "</strong></td>" +
              "    <td class='ps-4'>" +
              "        <i class='viewUser bi bi-eye fs-4 text-success icon-btn' data-bs-toggle='modal' data-bs-target='#users'></i>" +
              "    </td>" +
              "</tr>";
          }
          userList.append(htmlData);
        }
      }
    );
  }
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
      $("#add-user-btn").prop("disabled", false);
    } else {
      $("#add-user-btn").prop("disabled", true);
    }
  }
});
