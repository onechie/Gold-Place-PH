$(document).ready(function () {
    const profileBtn = $("#profile-button");
    const imageContainer = $("#profile .image-container ");
    const updateProfile = $("#update-profile");
    const toast = new bootstrap.Toast($("#liveToast"));
    const toastBody = $(".toast-body");

    const profileUrl = "./assets/scripts/server/request/profile_request.php";
    getProfileData();
  
    profileBtn.click(() => {
      getProfileData();
    });
  
    updateProfile.on("submit", function (e) {
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
          toastBody.text("Profile updated successfully!");
        }
        toast.show();
        getProfileData();
        $("#imageInput").val(null);
      });
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
        },
        function (data) {
          if (data && data != null) {
            let response_data = JSON.parse(data);
            let user_info = response_data.user_info;
            let user_address = response_data.user_address;
            let user_orders = response_data.user_orders;
            let address_option = response_data.address_option;
            
            let city_list = address_option.city_list;
            let province_list = address_option.province_list;
  
            let city_options = "";
            let province_options = "";
  
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
  
            $("#profile #address_city").empty();
            $("#profile #address_province").empty();
  
            for (let i = 0; i < city_list.length; i++) {
              city_options +=
                "<option value='" +
                city_list[i].city +
                "'>" +
                city_list[i].city +
                "</option>";
            }
            $("#profile #address_city").append(city_options);
  
            for (let i = 0; i < province_list.length; i++) {
              province_options +=
                "<option value='" +
                province_list[i].province +
                "'>" +
                province_list[i].province +
                "</option>";
            }
            $("#profile #address_province").append(province_options);
  
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
            $("#profile #address_number").val(user_address.house);
            $("#profile #address_street").val(user_address.street);
            $("#profile #address_city").val(user_address.city);
            $("#profile #address_province").val(user_address.province);
          }
          $("#profile #imageInput").val(null);
        }
      );
    }
  });
  