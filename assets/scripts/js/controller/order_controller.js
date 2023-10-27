$(document).ready(function () {
  "use strict";
  const orderBtn = $("#order-button");
  const orderList = $("#order-items");
  const orderDelivered = $("#order #delivered");
  const orderProcessing = $("#order #processing");
  const orderStatus = $(".order-status");
  const orderTotalPrice = $("#order #total_price");
  const refSubmit = $("#order-reference #order-ref-submit");
  const refInput = $("#order-reference #order-ref-input");
  const refId = $("#order-reference #order-ref-id");

  //TOAST OBJECT
  const toast = new bootstrap.Toast($("#liveToast"));
  const toastBody = $(".toast-body");

  let currency = new Intl.NumberFormat("en-US", {
    style: "currency",
    currency: "PHP",
  });

  const token = $(".token").val();

  const orderUrl = "./assets/scripts/server/request/order_request.php";

  let totalPriceValue = 0;

  orderProcessing.hide();

  orderBtn.click(function () {
    getOrderData(orderStatus.val());
  });
  function setTotalPrice() {
    orderTotalPrice.text(currency.format(totalPriceValue));
  }
  orderStatus.change(function () {
    getOrderData(orderStatus.val());
  });
  refInput.keyup(function () {
    if (isRefValid(refInput.val())) {
      refSubmit.prop("disabled", false);
    } else {
      refSubmit.prop("disabled", true);
    }
  });
  refInput.change(function () {
    if (isRefValid(refInput.val())) {
      refSubmit.prop("disabled", false);
    } else {
      refSubmit.prop("disabled", true);
    }
  });
  $("#order").on("click", ".ref_submit", function () {
    let id = $(this).siblings("#order_id").val();
    let amount = $(this).siblings("#order_amount").val();
    refSubmit.prop("disabled", true);

    $("#order-reference #order-ref-id").val(id);
    $("#order-reference #billing-amount").text(currency.format(amount));
    $("#order-reference").modal("show");
  });
  refSubmit.click(function () {
    refSubmit.prop("disabled", true);
    $.post(
      orderUrl,
      {
        requestType: "submit-ref-number",
        token: token,
        order_id: refId.val(),
        reference_number: refInput.val(),
      },
      function (data) {
        if(data == 'ok'){
          $("#order-reference").modal("hide");
          toastBody.append("Reference number submitted. please wait for your payment to verify.");
        }
        refSubmit.prop("disabled", false);
        if(data == 'failed'){
          toastBody.append("Reference number submission failed.");
        }
        if(data == 'already'){
          toastBody.append("This order has a Reference humber already.");
        }
        if(data == 'exists'){
          toastBody.append("Reference number already used.");
        }
        if(data == 'invalid'){
          toastBody.append("Reference number is invalid.");
        }
        toast.show()
      }
    );
    console.log(refInput.val());
    console.log(refId.val());
  });

  function getOrderData(type) {
    totalPriceValue = 0;
    $.post(
      orderUrl,
      {
        type: type,
        requestType: "order_info",
        token: token,
      },
      function (data) {
        //orderList.empty();
        orderList.empty();
        let htmlData = "";
        totalPriceValue = 0;
        if (data && data != "null") {
          let orders = JSON.parse(data);
          for (let i = 0; i < orders.length; i++) {
            let order = orders[i];
            let order_items = order.order_items;
            totalPriceValue += order.total_price;
            htmlData +=
              "<tr>" +
              "<td class='p-0'>" +
              "  <div class='accordion accordion-flush'>" +
              "    <div class='accordion-item fw-200 fs-7'>" +
              "      <div class='accordion-header fw-normal row py-3 px-4 bg-white' data-bs-toggle='collapse' data-bs-target='#flush-" +
              i +
              "'>" +
              "        <div class='col-1'>" +
              (i + 1) +
              "</div>" +
              "        <div class='col-3'>" +
              order.date +
              "</div>" +
              "        <div class='col-2 text-uppercase'>" +
              currency.format(order.total_price) +
              " - " +
              order.payment_method +
              "<br><span class='text-success'>Shipping Fee: " +
              currency.format(order.shipping_fee) +
              "</span></div>" +
              "        <div class='col-2 text-break fw-200'><span class='text-secondary fw-normal'>" +
              order.status +
              "</span><br>" +
              order.status_message +
              "</div>" +
              "        <div class='col-3 d-flex fw-light text-danger'>";

            if (order.payment_method == "gcash") {
              if (order.reference_number == "0" || order.reference_number == "") {
                htmlData +=
                  "           <input id='order_id' type='hidden' value='" +
                  order.id +
                  "'>" +
                  "           <input id='order_amount' type='hidden' value='" +
                  order.total_price +
                  "'>" +
                  "           <button class='btn btn-dark btn-sm my-auto py-0 ref_submit' type='button' data-bs-dismiss='modal'>Pay Order</button>";
              } else {
                htmlData += order.reference_number;
              }
            } else {
              htmlData += "none";
            }

            htmlData +=
              "         </div>" +
              "        <div class='col-1'><i class='bi bi-chevron-down'></i></div>" +
              "      </div>";

            for (let j = 0; j < order_items.length; j++) {
              let item = order_items[j];
              htmlData +=
                "<div id='flush-" +
                i +
                "' class='accordion-collapse collapse'>" +
                "  <div class='accordion-body py-2 px-5 row bg-light'>" +
                "    <div class='col-2'> <img src='./assets/images/items/" +
                item.id +
                "/" +
                item.image +
                "' class='rounded-3' height='100' width='100' alt=''></div>" +
                "    <div class='col-5 my-auto'>" +
                item.name +
                "</div>" +
                "    <div class='col-3 my-auto'>" +
                currency.format(item.price) +
                "</div>" +
                "    <div class='col-2 my-auto'>x" +
                item.quantity +
                "</div>" +
                "  </div>" +
                "</div>";
            }
            htmlData += "</div>" + "</div>" + "</td>" + "</tr>";
          }
          orderList.append(htmlData);
        }
        setTotalPrice();
      }
    );
  }
  function isRefValid(number) {
    var regex = /^(\d{13})$/;
    return regex.test(number);
  }
});
