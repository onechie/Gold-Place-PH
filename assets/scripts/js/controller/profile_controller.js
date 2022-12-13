$(document).ready(function () {
  const profileBtn = $("#profile-button");
  const imageContainer = $("#profile .image-container ");
  const updatePicture = $("#update-picture");
  const toast = new bootstrap.Toast($("#liveToast"));
  const toastBody = $(".toast-body");

  const houseNumber = $("#profile #address_number");
  const brgyDrop = $("#profile #address_street");
  const cityDrop = $("#profile #address_city");
  const provDrop = $("#profile #address_province");
  const saveAddress = $("#profile #save_address");

  const oldPass = $("#profile #old-password");
  const newPass = $("#profile #new-password");
  const cNewPass = $("#profile #confirm-new-password");

  const opwWarning = $("#profile .opw-w");
  const npwWarning = $("#profile .npw-w");
  const cnpwWarning = $("#profile .cnpw-w");

  let isOpwOk = false;
  let isNpwOk = false;
  let isCnpwOk = false;

  let opwValue = '';
  let npwValue = '';
  let cnpwValue = '';

  const savePassword = $("#profile #save_password");

  const brgyHidden = $("#profile #hidden_street");
  const cityHidden = $("#profile #hidden_city");
  const provHidden = $("#profile #hidden_province");

  let userAddress;

  const token = $(".token").val();
  const errorIcon = "<i class='bi bi-exclamation-circle-fill'></i>";

  const profileUrl = "./assets/scripts/server/request/profile_request.php";

  getProfileData();

  savePassword.prop("disabled", true);

  function cityList(province, type) {
    $.post(
      profileUrl,
      {
        requestType: "city_list",
        province: province,
        token: token,
      },
      function (data) {
        let city_options = "<option value=''>City/Municipality</option>";
        if (data && data != null) {
          let cityList = JSON.parse(data);
          if (cityList.length > 0) {
            for (let city of cityList) {
              city_options +=
                "<option value='" + city + "'>" + city + "</option>";
            }
          }
        }
        cityDrop.html(city_options);
        if (type == "load") {
          cityDrop.val(userAddress.city);
        } else {
          cityDrop.val("");
        }
      }
    );
  }

  function brgyList(city, type) {
    $.post(
      profileUrl,
      {
        requestType: "brgy_list",
        city: city,
        token: token,
      },
      function (data) {
        let brgy_options = "<option value=''>Barangay</option>";
        if (data && data != null) {
          let brgyList = JSON.parse(data);

          if (brgyList.length > 0) {
            for (let brgy of brgyList) {
              brgy_options +=
                "<option value='" + brgy + "'>" + brgy + "</option>";
            }
          }
        }
        brgyDrop.html(brgy_options);
        if (type == "load") {
          brgyDrop.val(userAddress.street);
        } else {
          brgyDrop.val("");
        }
      }
    );
  }

  provDrop.change(function () {
    if (provDrop.val() == "" || provDrop.val() == null) {
      cityDrop.prop("disabled", true);
      brgyDrop.prop("disabled", true);
      cityDrop.val("");
      brgyDrop.val("");
    } else {
      cityDrop.prop("disabled", false);
      brgyDrop.prop("disabled", true);
      brgyDrop.val("");
      cityList(provDrop.val(), "reload");
    }
  });
  cityDrop.change(function () {
    if (cityDrop.val() == "" || cityDrop.val() == null) {
      brgyDrop.prop("disabled", true);
      brgyDrop.val("");
    } else {
      brgyDrop.prop("disabled", false);
      brgyList(cityDrop.val(), "reload");
    }
  });

  function updateDropDowns() {
    if (provDrop.val() == "" || provDrop.val() == null) {
      cityDrop.prop("disabled", true);
    } else {
      cityDrop.prop("disabled", false);
    }

    if (cityDrop.val() == "" || cityDrop.val() == null) {
      brgyDrop.prop("disabled", true);
    } else {
      brgyDrop.prop("disabled", false);
    }
  }

  profileBtn.click(() => {
    getProfileData();
  });

  updatePicture.on("submit", function (e) {
    e.preventDefault();
    $.ajax({
      url: profileUrl,
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
    }).done(function (data) {
      if (data == "error") {
        toastBody.text("Error ocurred!");
      } else {
        toastBody.text("Profile picture updated successfully!");
      }
      toast.show();
      getProfileData();
      $("#imageInput").val(null);
    });
  });
  saveAddress.click(function () {
    $.post(
      profileUrl,
      {
        requestType: "update_address",
        number: houseNumber.val(),
        street: brgyDrop.val(),
        city: cityDrop.val(),
        province: provDrop.val(),
        token: token,
      },
      function (data) {
        if (data == "ok") {
          toastBody.text("Home address updated successfully!");
        } else {
          toastBody.text("Error ocurred!");
        }
        toast.show();
      }
    );
  });
  oldPass.keyup(function () {
    opwWarning.empty();
    isOpwOk = false;
    opwValue = oldPass.val();
    if (opwValue.length <= 0) {
      opwWarning.empty();
      opwWarning.html(errorIcon);
    } else {
      isOpwOk = true;
    }
    updatePassBtn(isOpwOk, isNpwOk, isCnpwOk);
  });
  //PASSWORD VALIDATION
  newPass.keyup(function () {
    npwWarning.empty();
    isNpwOk = false;
    npwValue = newPass.val();
    if (npwValue.length <= 7) {
      npwWarning.html("is too short " + errorIcon);
      if (npwValue.length <= 0) {
        npwWarning.empty();
        npwWarning.html(errorIcon);
      }
    } else if (npwValue.length >= 50) {
      npwWarning.html("is too long " + errorIcon);
    } else {
      isNpwOk = true;
    }
    cNewPass.trigger("keyup");
    updatePassBtn(isOpwOk, isNpwOk, isCnpwOk);
  });
  //PASSWORD VALIDATION
  cNewPass.keyup(function () {
    cnpwWarning.empty();
    isCnpwOk = false;
    cnpwValue = cNewPass.val();
    if (cnpwValue.length <= 0) {
      cnpwWarning.empty();
      cnpwWarning.html(errorIcon);
    } else if (cnpwValue != npwValue) {
      cnpwWarning.html("not matched " + errorIcon);
    } else {
      isCnpwOk = true;
    }
    updatePassBtn(isOpwOk, isNpwOk, isCnpwOk);
  });

  savePassword.click(function () {
    $.post(
      profileUrl,
      {
        requestType: "update_password",
        old_password: oldPass.val(),
        new_password: newPass.val(),
        confirm_new_password: cNewPass.val(),
        token: token,
      },
      function (data) {
        if (data == "ok") {
          toastBody.text("Password updated successfully!");
          clearPassword();
        } else if (data == "wrong") {
          toastBody.text("Your old password is incorrect!");
        } else {
          toastBody.text("Error ocurred!");
        }
        toast.show();
      }
    );
  });

  //FUNCTION FOR DISPLAYING IMAGE ON INPUT
  $("#profile #imageInput").change(function () {
    var file = this.files[0];
    var fileType = file["type"];
    var validImageTypes = ["image/gif", "image/jpeg", "image/png", "image/jpg"];
    if ($.inArray(fileType, validImageTypes) < 0) {
      this.value = null;
      toastBody.text("Please input valid image file!");
      toast.show();
    } else {
      imageContainer.empty();
      imageContainer.append(
        "<img id='image' src='" +
          URL.createObjectURL(event.target.files[0]) +
          "' alt='profile' class='inputImages'>"
      );
    }
  });

  function getProfileData() {
    $.post(
      profileUrl,
      {
        requestType: "get_profile",
        token: token,
      },
      function (data) {
        if (data && data != null) {
          let response_data = JSON.parse(data);

          let user_info = response_data.user_info;
          userAddress = response_data.user_address;
          let user_orders = response_data.user_orders;
          let address_option = response_data.address_option;

          let city_list = address_option.city_list;
          let province_list = address_option.province_list;
          let barangay_list = address_option.barangay_list;

          let city_options = "";
          let province_options = "<option value=''>Province</option>";
          let brgy_options = "";

          let defaultImg = "./assets/images/defaults/default-profile.png";
          let currentImg = "";

          if (user_info.image == "") {
            currentImg = defaultImg;
          } else {
            currentImg =
              "./assets/images/users/" +
              user_info.id +
              "/" +
              user_info.image +
              "";
          }

          for (let i = 0; i < province_list.length; i++) {
            province_options +=
              "<option value='" +
              province_list[i].province +
              "'>" +
              province_list[i].province +
              "</option>";
          }

          provHidden.val(userAddress.province);
          cityHidden.val(userAddress.city);
          brgyHidden.val(userAddress.street);

          provDrop.html(province_options);
          provDrop.val(userAddress.province);
          cityList(userAddress.province, "load");
          brgyList(userAddress.city, "load");

          /*

          for (let i = 0; i < city_list.length; i++) {
            city_options +=
              "<option value='" +
              city_list[i].city +
              "'>" +
              city_list[i].city +
              "</option>";
          }

          cityDrop.html(city_options);
          $("#profile #address_city").val(user_address.city);

          for (let i = 0; i < barangay_list.length; i++) {
            brgy_options +=
              "<option value='" +
              barangay_list[i].barangay +
              "'>" +
              barangay_list[i].barangay +
              "</option>";
          }

          brgyDrop.html(brgy_options);
          $("#profile #address_street").val(user_address.street);
          */

          //USER INFO
          $("#profile-icon").prop("src", currentImg);
          $("#profile #image").prop("src", currentImg);
          $("#profile #name").text(user_info.name);
          $("#profile #email").text(user_info.email);
          $("#profile #phone").text(user_info.phone);
          //USER ORDERS
          $("#profile #total").text(user_orders.orders);
          $("#profile #cancelled").text(user_orders.cancelled);
          $("#profile #delivered").text(user_orders.delivered);
          //USER ADDRESS
          $("#profile #address_number").val(userAddress.house);
        }
        $("#profile #imageInput").val(null);
        updateDropDowns();
      }
    );
  }
  function updatePassBtn(opw, npw, cnpw) {
    if (opw, npw, cnpw) {
      savePassword.prop("disabled", false);
    } else {
      savePassword.prop("disabled", true);
    }
  }
  function clearPassword(){
    oldPass.val("");
    newPass.val("");
    cNewPass.val("");

    opwWarning.html('');
    npwWarning.html('');
    cnpwWarning.html('');



    isOpwOk = false;
    isNpwOk = false;
    isCnpwOk = false;

    updatePassBtn(isOpwOk, isNpwOk, isCnpwOk);
  }
});
