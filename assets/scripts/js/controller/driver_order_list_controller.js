$(document).ready(function () {
  const orderList = $(".order-handler #order-list");
  const refreshBtn = $(".order-handler #refresh-items");
  const token = $(".token").val();

  const orderId = $("#update-order .order-id");
  const orderCount = $("#update-order .order-count");
  const orderItems = $("#update-order .order-items");
  const orderPrice = $("#update-order .total-price");
  const itemsPrice = $("#update-order .items-price");
  const shippingFee = $("#update-order .shipping-fee");
  const orderAddress = $("#update-order .order-address");
  const orderContact = $("#update-order .order-contact");
  const orderName = $("#update-order .order-name");
  const orderStatus = $("#update-order .order-status");
  const orderMessage = $("#update-order .order-message");

  const updateButton = $("#update-order .update-button");

  let currency = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'PHP',
});
  const toastBody = $(".toast-body");
  const toast = new bootstrap.Toast($("#liveToast"));

  const driverOL_URL =
    "../assets/scripts/server/request/driver_order_list_request.php";

  loadOrderList();

  refreshBtn.click(function () {
    loadOrderList();
  });
  orderList.on("click", ".view-order-btn", function () {
    let order_id = $(this).parent().siblings(".order-id").text();

    $.post(
      driverOL_URL,
      { requestType: "view-order", order_id: order_id, token: token },
      function (data) {
        if (data && data != "null") {
          let orderData = JSON.parse(data);

          let orderPriceData = 0;

          orderId.text(orderData.order.id);
          orderCount.text(orderData.order.items_count);

          let orderItemsData = "";
          for (let item of orderData.order.items_data) {
            orderItemsData +=
              "<li>" + item.name + " x" + item.quantity + "</li>";
            orderPriceData += item.price * item.quantity;
          }
          orderItems.empty();
          orderItems.append(orderItemsData);
          itemsPrice.text(currency.format(orderPriceData));
          shippingFee.text(currency.format(orderData.shipping_fee));
          orderPrice.text(currency.format(orderPriceData+ orderData.shipping_fee));
          orderAddress.text(orderData.address);
          orderContact.text(orderData.customer.contact);
          orderName.text(orderData.customer.name);
          orderStatus.val(orderData.order.status);
          orderMessage.val(orderData.order.status_message);

          $("#update-order #order-id").val(orderData.order.id);
        }
      }
    );
  });

  updateButton.click(function () {
    let order_id = $("#update-order #order-id").val();
    $.post(
      driverOL_URL,
      {
        requestType: "update-order",
        order_id: order_id,
        status: orderStatus.val(),
        status_message: orderMessage.val(),
        token: token,
      },
      function (data) {
        if (data == "ok") {
          toastBody.text("Order updated successfully!");
          toast.show();
          loadOrderList();
        }
      }
    );
  });

  function loadOrderList() {
    orderList.empty();

    $.post(
      driverOL_URL,
      { requestType: "order-list", token: token },
      function (data) {
        if (data == "failed") {
        } else {
          if (data && data != "null") {
            const ordersData = JSON.parse(data);
            let htmlData = "";

            for (let order of ordersData) {
              htmlData +=
                "<tr class='align-middle'>" +
                "   <td class='ps-4 text-wrap order-id'>" +
                order +
                "</td>" +
                "   <td class='px-4'>" +
                "     <i" +
                "      class='text-success icon-btn bi bi-pencil-square fs-5 view-order-btn'" +
                "      data-bs-toggle='modal'" +
                "      data-bs-target='#update-order'" +
                "    ></i>" +
                "  </td>" +
                "</tr>";
            }

            orderList.append(htmlData);
          }
        }
      }
    );
  }
});
