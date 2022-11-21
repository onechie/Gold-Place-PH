$(document).ready(function () {
  let recentOrders = $(".orders #recent-orders");
  let orderItems = $("#view-order #order-items");
  const receiptContent = $("#view-receipt .receipt-content")
  let status = $("#view-order #status");
  let orderId = $(".modal-footer #order_id");
  const totalPrice = $(".modal-footer #total_price");
  const qrCode = $("#view-receipt #qrcode");

  let currency = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'PHP',
});

  const token = $(".token").val();

  const adminRC_URL =
    "../assets/scripts/server/request/admin_recent_order_request.php";

  let totalPriceValue = 0;

  loadRecentOrders();

  $(".orders").on("click", ".viewReceipt", function () {
    order_id = $(this).siblings("#order_id").val();
    receiptContent.empty();
    $.post(
      adminRC_URL,
      {
        requestType: "get-full-order-data",
        order_id: order_id,
        token: token,
      },
      function (data) {
        if (data && data != "null") {
          let orderData = JSON.parse(data);
          let orderItems = orderData.order.items_data;
          let customer = orderData.customer;
          let address = orderData.address;
          htmlData = "<h5 class='m-0 fw-normal text-start mb-2'>ITEMS</h5>";
          totalPriceValue = 0;
          for (let item of orderItems) {
            totalPriceValue += item.price * item.quantity;
            
            htmlData += 
            "<div class='row fs-7'>"+
                "<div class=' col-8 text-start text-break fw-200'>"+item.name+" - x"+item.quantity+"</div>"+
                "<div class='col-4 text-start text-break'>"+currency.format(item.price * item.quantity)+"</div>"+
            "</div>";

          }
          totalPriceValue+=orderData.shipping_fee;
          htmlData += 
          "<div class='row fs-7 mt-3'>"+
              "<div class=' col-8 text-start text-break fw-200'>Shipping Fee</div>"+
              "<div class='col-4 text-start text-break'>"+currency.format(orderData.shipping_fee)+"</div>"+
          "</div>"+
          "<div class='row'>"+
              "<div class=' col-8 text-start text-break'>Total</div>"+
              "<div class='col-4 text-start text-break'>"+currency.format(totalPriceValue)+"</div>"+
          "</div>"+
          "<hr>"+
          "<h5 class='m-0 fw-normal text-start mb-2'>SHIP TO</h5>"+
          "<div class='row fs-7'>"+
              "<div class=' col-4 text-start text-break fw-200'>Name: </div>"+
              "<div class='col-8 text-start text-break'>"+customer.name+"</div>"+
          "</div>"+
          "<div class='row fs-7'>"+
              "<div class=' col-4 text-start text-break fw-200'>Address: </div>"+
              "<div class='col-8 text-start text-break'>"+address+"</div>"+
          "</div>"+
          "<div class='row fs-7'>"+
              "<div class=' col-4 text-start text-break fw-200'>Phone: </div>"+
              "<div class='col-8 text-start text-break'>"+customer.contact+"</div>"+
          "</div>"+
          "<div class='row fs-7 mt-3'>"+
              "<div class=' col-4 text-start text-break fw-200'>Order ID: </div>"+
              "<div class='col-8 text-start text-break'>"+order_id+"</div>"+
          "</div>"


          receiptContent.append(htmlData);
          
          qrCode.empty();
          var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: order_id,
            width: 100,
            height: 100,
            colorDark : "black",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
          });

          orderId.val(order_id);
        }
      }
    );
  });

  $(".orders").on("click", ".editOrder", function () {
    orderItems.empty();
    order_id = $(this).siblings("#order_id").val();
    $.post(
      adminRC_URL,
      {
        requestType: "get-order-data",
        order_id: order_id,
        token: token,
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
        token: token,
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
        token: token,
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
              "    <i class='text-secondary icon-btn editOrder bi bi-pencil-square fs-5' data-bs-toggle='modal' data-bs-target='#view-order'></i>" +
              "    <i class='text-success icon-btn viewReceipt bi bi-receipt fs-5' data-bs-toggle='modal' data-bs-target='#view-receipt'></i>" +
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
