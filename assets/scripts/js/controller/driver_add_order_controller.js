$(document).ready(function () {
  const addOrderModal = $("#add-order");
  const modalBody = $("#add-order #modal-body");
  const orderId = $("#add-order #order-id");
  const inputId = $("#add-order #input-id");
  const hint = $("#add-order #hint");
  const searchBtn = $("#add-order #search-btn");
  const scanAgain = $("#add-order #scan-again");
  const scanOpen = $("#add-order #scan-open");
  const token = $(".token").val();

  let currency = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'PHP',
});

  const toastBody = $(".toast-body");
  const toast = new bootstrap.Toast($("#liveToast"));

  let ableToScan = true;

  const driverAO_URL =
    "../assets/scripts/server/request/driver_add_order_request.php";

  scanAgain.hide();

  var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", {
    fps: 20,
    qrbox: 200,
  });

  function onScanSuccess(decodedText, decodedResult) {
    if (ableToScan) {
      console.log(`Code scanned = ${decodedText}`, decodedResult);
      inputId.val(decodedText);
      findOrder();
      ableToScan = false;

      $("#add-order #qr-reader").hide();
      hint.hide();

      scanOpen.hide();
      scanAgain.show();
    }
  }
  scanOpen.click(function () {
    html5QrcodeScanner.render(onScanSuccess);
    $("#add-order #qr-reader").show();
    hint.show();
    
    scanOpen.hide();
    scanAgain.hide();
    modalBody.empty();
    ableToScan = true;
  });

  scanAgain.click(function () {
    $("#add-order #qr-reader").show();
    hint.show();

    scanOpen.hide();
    scanAgain.hide();
    modalBody.empty();
    ableToScan = true;
  });

  searchBtn.click(function () {
    findOrder();
  });

  function findOrder() {
    modalBody.empty();
    $.post(
      driverAO_URL,
      {
        requestType: "find-order",
        order_id: inputId.val(),
        token: token,
      },
      function (data) {
        let htmlData = "";
        if (data && data != "null") {
          if (data == "failed") {
            htmlData =
              "<div class='text-center text-danger'>Order not found</div>";
          } else {
            let orderData = JSON.parse(data);
            let itemList = "";
            let orderPrice = 0;

            for (let item of orderData.order.items_data) {
              itemList += "<li>" + item.name + " x" + item.quantity + "</li>";
              orderPrice += item.price * item.quantity;
            }

            htmlData =
              "<p class='fs-5'>ID : <span class='fw-normal text-success' id='order-id'>" +
              orderData.order.id +
              "</span></p>" +
              "<p>Items : <span class='fw-200'>" +
              orderData.order.items_count +
              "</span></p>" +
              "<ul class='fw-200'>" +
              itemList +
              "</ul>" +
              "<p>Items Price : <span class='fw-200'>" +
              currency.format(orderPrice) +
              "</span></p>" +
              "<p>Shipping Fee : <span class='fw-200'>" +
              currency.format(orderData.shipping_fee) +
              "</span></p>" +
              "<p>Total Price : <span class='fw-200'>" +
              currency.format(orderPrice+orderData.shipping_fee) +
              "</span></p>" +
              "<p>Address : <span class='fw-200'>" +
              orderData.address +
              "</span></p>" +
              "<p>Contact no : <span class='fw-200'>" +
              orderData.customer.contact +
              "</span></p>" +
              "<p>Name : <span class='fw-200'>" +
              orderData.customer.name +
              "</span></p>" +
              "<p>Status : <span class='text-success'>" +
              orderData.order.status +
              "</span></p>";

            if (orderData.order.available == "yes") {
              htmlData +=
                "<p>Available : <span class='text-success'>Yes</span></p>" +
                "<button type='button' class='btn btn-sm btn-success' id='add-btn'>Add To Your List</button>";
            } else {
              htmlData +=
                "<p>Available : <span class='text-danger'>No</span></p>";
            }

            orderId.val(orderData.order.id);
          }
        }
        modalBody.append(htmlData);
        $("#add-order #qr-reader").hide();
        hint.hide();
        scanOpen.show();
      }
    );
  }
  addOrderModal.on("click", "#add-btn", function () {
    $.post(
      driverAO_URL,
      {
        requestType: "add-order",
        order_id: orderId.val(),
        token: token,
      },
      function (data) {
        if (data && data != "null") {
          if (data == "ok") {
            toastBody.text("Order added successfully!");
            toast.show();
          }
        }
      }
    );
  });
});
