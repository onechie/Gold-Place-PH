$(document).ready(function () {
  let recentOrders = $(".orders #recent-orders");
  let orderItems = $("#view-order #order-items");
  let status = $("#view-order #status");
  let orderId = $(".modal-footer #order_id");
  const totalPrice = $(".modal-footer #total_price");

  const token = $(".token").val();

  const adminRC_URL =
    "../assets/scripts/server/request/admin_recent_order_request.php";

  let totalPriceValue = 0;

  loadRecentOrders();

  $(".orders").on("click", ".editOrder", function () {
    orderItems.empty();
    order_id = $(this).siblings("#order_id").val();
    $.post(
      adminRC_URL,
      {
        requestType: "get-order-data",
        order_id: order_id,
        token: token
      },
      function (data) {
        if (data && data != "null") {
          let items = JSON.parse(data);
          htmlData = "";
          totalPriceValue = 0;
          for (let item of items) {
            totalPriceValue += item.price * item.quantity;

            htmlData +=
              "<tr>" +
              "<td class='p-0'>" +
              "    <div id='order-items h-100'>" +
              "        <div class='px-4 row bg-light fw-light py-2'>" +
              "            <div class='col-3'> <img src='../assets/images/items/" +
              item.item_id +
              "/" +
              item.image +
              "' class='rounded-3' height='100' width='100' alt=''></div>" +
              "            <div class='col-5 my-auto'>" +
              item.name +
              "</div>" +
              "            <div class='col-3 my-auto'>&#8369;<span id='item_price'>" +
              item.price +
              "</span></div>" +
              "            <div class='col-1 my-auto'>" +
              item.quantity +
              "</div>" +
              "        </div>" +
              "    </div>" +
              "</td>" +
              "</tr>";
            if (item.status == "cancelled" || item.status == "delivered") {
              status.prop("disabled", true);
            } else {
              status.prop("disabled", false);
            }
            status.val(item.status);
          }
          setTotalPrice();
          orderItems.append(htmlData);
          orderId.val(order_id);
        }
      }
    );
  });

  status.change(function () {
    $.post(
      adminRC_URL,
      {
        requestType: "edit-order-status",
        order_id: orderId.val(),
        status: status.val(),
        token: token
      },
      function (data) {
        loadRecentOrders();
      }
    );
  });

  function loadRecentOrders() {
    $.post(
      adminRC_URL,
      {
        requestType: "get-recent-orders",
        token:token
      },
      function (data) {
        recentOrders.empty();

        if (data && data != "null") {
          let orders = JSON.parse(data);
          let htmlData = "";
          for (let i = 0; i < orders.length; i++) {
            let order = orders[i];

            let defaultImg = "'../assets/images/defaults/default-profile.png'";
            let currentImg = "";

            if (order.user_image == "") {
              currentImg = defaultImg;
            } else {
              currentImg =
                "'../assets/images/users/" +
                order.user_id +
                "/" +
                order.user_image +
                "'";
            }

            htmlData +=
              "<tr class='align-middle'>" +
              "<td class='ps-4'>" +
              "    <div class='d-flex align-items-center'>" +
              "        <span class='position-relative rounded-5 bg-white shadow-sm me-3' style='width:50px; height:50px'>" +
              "            <img class='position-absolute m-1 bg-primary rounded-5' src=" +
              currentImg +
              " alt='' style='width:42px; height:42px'>" +
              "        </span>" +
              "        <div class=''>" +
              "            <strong>" +
              order.user_name +
              "</strong>" +
              "            <br>" +
              "            <span class='text-muted fs-7'>" +
              order.user_email +
              "</span>" +
              "        </div>" +
              "    </div>" +
              "</td>" +
              "<td class='ps-4'>" +
              order.items +
              "</td>" +
              "<td class='ps-4'>" +
              order.date +
              "</td>" +
              "<td class='ps-4'>" +
              order.order_status +
              "</td>" +
              "<td class='px-4'>" +
              "<div class='d-flex'>" +
              "    <input type='hidden' id='order_id' value='" +
              order.order_id +
              "'>" +
              "    <i class='text-success icon-btn editOrder bi bi-pencil-square fs-5' data-bs-toggle='modal' data-bs-target='#view-order'></i>" +
              "</div>" +
              "</td>" +
              "</tr>";
          }
          recentOrders.append(htmlData);
        }
      }
    );
  }

  function setTotalPrice() {
    totalPrice.text(totalPriceValue);
  }
});
