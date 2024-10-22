$(document).ready(function () {
  const orderList = $(".order-handler-done #order-list");
  const refreshBtn = $(".order-handler-done #refresh-items");
  const token = $(".token").val();

  const orderId = $("#view-order .order-id");
  const orderPrice = $("#view-order .total-price");

  const modalBody = $("#view-order .modal-body");

  let currency = new Intl.NumberFormat("en-US", {
    style: "currency",
    currency: "PHP",
  });
  const driverDOL_URL =
    "../assets/scripts/server/request/driver_done_order_list_request.php";

  loadOrderList();

  refreshBtn.click(function () {
    loadOrderList();
  });

  orderList.on("click", ".view-order-btn", function () {
    let order_id = $(this).parent().siblings(".order-id").text();
    modalBody.empty();
    $.post(
      driverDOL_URL,
      { requestType: "view-order", order_id: order_id, token: token },
      function (data) {
        let htmlData = "";
        if (data && data != "null") {
          if (data == "failed") {
            htmlData =
              "<div class='text-center text-danger'>Order not found</div>";
          } else {
            let orderData = JSON.parse(data);
            let itemList = "";
            let orderPriceData = 0;

            for (let item of orderData.order.items_data) {
              itemList += "<li>" + item.name + " x" + item.quantity + "</li>";
              orderPriceData += item.price * item.quantity;
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
              "<p>Items Price : <span class='fw-200 text-success'>" +
              currency.format(orderPriceData) +
              "</span></p>" +
              "<p>Shipping Fee : <span class='fw-200 text-danger'>" +
              currency.format(orderData.shipping_fee) +
              "</span></p>" +
              "<p>Address : <span class='fw-200'>" +
              orderData.address +
              "</span></p>" +
              "<p>Contact no : <span class='fw-200'>" +
              orderData.customer.contact +
              "</span></p>" +
              "<p>Name : <span class='fw-200'>" +
              orderData.customer.name +
              "</span></p>";

            if (orderData.order.status == "delivered") {
              htmlData +=
                "<p>Status : <span class='text-success'>" +
                orderData.order.status +
                "</span></p>";
            } else {
              htmlData +=
                "<p>Status : <span class='text-danger'>" +
                orderData.order.status +
                "</span></p>";
            }

            htmlData +=
              "<p>Proof of Delivery :</p>" +
              "<div id='image' class='mb-3 d-flex flex-wrap justify-content-center'>";

            for (let image of orderData.delivered_proof) {
              htmlData +=
                "<div class='ratio ratio-1x1 bg-light shadow rounded-4 align-self-center' style='max-width: 300px; margin:10px;'>" +
                "<img class='inputImages rounded-4' src='../assets/images/proofs/" +
                orderData.order.id +
                "/" +
                image +
                "'/>" +
                "</div>";
            }

            htmlData += "</div>";

            orderId.val(orderData.order.id);
            orderPrice.text(
              currency.format(
                parseInt(orderPriceData) + parseInt(orderData.shipping_fee)
              )
            );
          }
        }
        modalBody.append(htmlData);
      }
    );
  });

  function loadOrderList() {
    orderList.empty();

    $.post(
      driverDOL_URL,
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
                order.id +
                "</td>" +
                "   <td class='ps-4 text-wrap'>" +
                order.status +
                "</td>" +
                "   <td class='px-4'>" +
                "     <i" +
                "      class='text-success icon-btn bi bi-eye fs-5 view-order-btn'" +
                "      data-bs-toggle='modal'" +
                "      data-bs-target='#view-order'" +
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
