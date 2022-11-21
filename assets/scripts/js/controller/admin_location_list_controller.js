$(document).ready(function () {
  const provInput = $(".locations #province-input");
  const provAdd = $(".locations #province-add");
  const provList = $(".locations #province-list");

  const cityInput = $("#add-city-modal #city-name");
  const cityProv = $("#add-city-modal #province");
  const cityAdd = $("#add-city-modal #add-city-btn");
  const cityAddMain = $(".locations #city-add");
  const messageText = $("#add-city-modal #messageText");
  const cityList = $(".locations #city-list");

  const brgyInput = $("#add-brgy-modal #brgy-name");
  const brgyCity = $("#add-brgy-modal #city");
  const brgyAdd = $("#add-brgy-modal #add-brgy-btn");
  const brgyAddMain = $(".locations #brgy-add");
  const brgyMessageText = $("#add-brgy-modal #messageText");
  const shipFee = $("#add-brgy-modal #shipping-fee");
  const brgyList = $(".locations #barangay-list");

  const locations = $(".locations");
  const token = $(".token").val();

  const loc_URL =
    "../assets/scripts/server/request/admin_location_list_request.php";

  provAdd.click(() => {
    console.log(provInput.val());
    $.post(
      loc_URL,
      {
        token: token,
        province: provInput.val(),
        requestType: "add-province",
      },
      function (data) {
        if (data == "ok") {
          provInput.val("");
        }
        if (data == "exist") {
        }
        loadProvinces();
      }
    );
  });
  cityAddMain.click(() => {
    messageText.empty();
    $.post(
      loc_URL,
      {
        requestType: "province-list",
        token: token,
      },
      (data) => {
        if (data != null && data) {
          if (data == "no record") {
          } else {
            cityProv.empty();
            let htmlData = "";
            let provinceData = JSON.parse(data);

            htmlData += "<option selected value=''>Province</option>";

            for (let province of provinceData) {
              htmlData +=
                "<option value='" +
                province.province +
                "'>" +
                province.province +
                "</option>";
            }
            cityProv.append(htmlData);
          }
        }
      }
    );
  });

  cityAdd.click(() => {
    $.post(
      loc_URL,
      {
        requestType: "add-city",
        city: cityInput.val(),
        province: cityProv.val(),
        token: token,
      },
      (data) => {
        if (data == "failed") {
          messageText.html("<span class='text-danger'>Adding Failed!</span>");
        }
        if (data == "ok") {
          messageText.html(
            "<span class='text-success'>Added Successfully!</span>"
          );
          cityInput.val('');
          loadCity();
        }
        if (data == "empty") {
          messageText.html(
            "<span class='text-danger'>Please fill out empty field!</span>"
          );
        }
      }
    );
  });

  brgyAddMain.click(() => {
    brgyMessageText.empty();
    $.post(
      loc_URL,
      {
        requestType: "city-list",
        token: token,
      },
      (data) => {
        if (data != null && data) {
          if (data == "no record") {
          } else {
            brgyCity.empty();
            let htmlData = "";
            let cityData = JSON.parse(data);

            htmlData += "<option selected value=''>City/Municipality</option>";

            for (let city of cityData) {
              htmlData +=
                "<option value='" + city.city + "'>" + city.city + "</option>";
            }
            brgyCity.append(htmlData);
          }
        }
      }
    );
  });

  brgyAdd.click(() => {
    $.post(
      loc_URL,
      {
        requestType: "add-brgy",
        barangay: brgyInput.val(),
        city: brgyCity.val(),
        shipping_fee: shipFee.val(),
        token: token,
      },
      (data) => {
        if (data == "failed") {
          brgyMessageText.html(
            "<span class='text-danger'>Adding Failed!</span>"
          );
        }
        if (data == "ok") {
          brgyMessageText.html(
            "<span class='text-success'>Added Successfully!</span>"
          );
          brgyInput.val('');
          shipFee.val('');
          loadBarangay();
        }
        if (data == "empty") {
          brgyMessageText.html(
            "<span class='text-danger'>Please fill out empty field!</span>"
          );
        }
      }
    );
  });

  locations.on("click", ".deleteProvince", function () {
    let provinceId = $(this).siblings("#province_id").val();
    let provinceName = $(this).siblings("#province_name").val();

    $("#confirm-delete #delete-id").val(provinceId);
    $("#confirm-delete #requestType").val("province-delete");
    $("#confirm-delete #confirmation-message").text(
      "Are you sure do you want to delete " + provinceName + "?"
    );
    $("#confirm-delete #messageText").empty();
  });
  locations.on("click", ".deleteCity", function () {
    let cityId = $(this).siblings("#city_id").val();
    let cityName = $(this).siblings("#city_name").val();

    $("#confirm-delete #delete-id").val(cityId);
    $("#confirm-delete #requestType").val("city-delete");
    $("#confirm-delete #confirmation-message").text(
      "Are you sure do you want to delete " + cityName + "?"
    );
    $("#confirm-delete #messageText").empty();
  });
  locations.on("click", ".deleteBrgy", function () {
    let brgyId = $(this).siblings("#brgy_id").val();
    let brgyName = $(this).siblings("#brgy_name").val();

    $("#confirm-delete #delete-id").val(brgyId);
    $("#confirm-delete #requestType").val("brgy-delete");
    $("#confirm-delete #confirmation-message").text(
      "Are you sure do you want to delete " + brgyName + "?"
    );
    $("#confirm-delete #messageText").empty();
  });

  $("#confirm-delete #delete-btn").click(function () {
    let deleteId = $(this).siblings("#delete-id").val();
    let requestType = $(this).siblings("#requestType").val();

    $.post(
      loc_URL,
      {
        requestType: requestType,
        id: deleteId,
        token: token,
      },
      (data) => {
        if (data == "ok") {
          $("#confirm-delete #messageText").html(
            "<span class='text-success'>Success!</span>"
          );
          if (requestType == "province-delete") {
            loadProvinces();
          }
          if (requestType == "city-delete") {
            loadCity();
          }
          if (requestType == "brgy-delete") {
            loadBarangay();
          }
        }
      }
    );
  });

  loadProvinces = () => {
    provList.empty();
    $.post(
      loc_URL,
      {
        requestType: "province-list",
        token: token,
      },
      (data) => {
        if (data != null && data) {
          if (data == "no record") {
          } else {
            htmlData = "";
            const provinceData = JSON.parse(data);
            for (let province of provinceData) {
              htmlData +=
                "<tr>" +
                "    <td class='ps-4 py-2 text-capitalize'>" +
                province.province +
                "</td>" +
                "    <td class='px-4 py-2'><input type='hidden' id='province_id' value='" +
                province.id +
                "'><input type='hidden' id='province_name' value='" +
                province.province +
                "'><i class='deleteProvince bi bi-trash fs-5 text-danger icon-btn' data-bs-toggle='modal' data-bs-target='#confirm-delete'></td>" +
                "</tr>";
            }
            provList.append(htmlData);
          }
        }
      }
    );
  };

  loadCity = () => {
    cityList.empty();
    $.post(
      loc_URL,
      {
        requestType: "city-list",
        token: token,
      },
      (data) => {
        if (data != null && data) {
          if (data == "no record") {
          } else {
            htmlData = "";
            const cityData = JSON.parse(data);
            for (let city of cityData) {
              htmlData +=
                "<tr>" +
                "    <td class='ps-4 py-2 text-capitalize'>" +
                city.city +
                "</td>" +
                "    <td class='ps-4 py-2 text-capitalize'>" +
                city.province +
                "</td>" +
                "    <td class='px-4 py-2'><input type='hidden' id='city_id' value='" +
                city.id +
                "'><input type='hidden' id='city_name' value='" +
                city.city +
                "'><i class='deleteCity bi bi-trash fs-5 text-danger icon-btn' data-bs-toggle='modal' data-bs-target='#confirm-delete'></td>" +
                "</tr>";
            }
            cityList.append(htmlData);
          }
        }
      }
    );
  };

  loadBarangay = () => {
    brgyList.empty();
    $.post(
      loc_URL,
      {
        requestType: "brgy-list",
        token: token,
      },
      (data) => {
        if (data != null && data) {
          if (data == "no record") {
          } else {
            htmlData = "";
            const brgyData = JSON.parse(data);
            for (let brgy of brgyData) {
              htmlData +=
                "<tr>" +
                "    <td class='ps-4 py-2 text-capitalize'>" +
                brgy.barangay +
                "</td>" +
                "    <td class='ps-4 py-2 text-capitalize'>" +
                brgy.city +
                "</td>" +
                "    <td class='ps-4 py-2 text-capitalize'>" +
                brgy.shipping_fee +
                "</td>" +
                "    <td class='px-4 py-2'><input type='hidden' id='brgy_id' value='" +
                brgy.id +
                "'><input type='hidden' id='brgy_name' value='" +
                brgy.barangay +
                "'><i class='deleteBrgy bi bi-trash fs-5 text-danger icon-btn' data-bs-toggle='modal' data-bs-target='#confirm-delete'></td>" +
                "</tr>";
            }
            brgyList.append(htmlData);
          }
        }
      }
    );
  };

  loadProvinces();
  loadCity();
  loadBarangay();
});
