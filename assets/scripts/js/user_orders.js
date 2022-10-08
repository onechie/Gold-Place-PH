$(document).ready(function () {
  "use strict";
  const orderBtn = $("#order-button");
  const orderList = $("#order-items");
  const orderDelivered = $("#order #delivered");
  const orderProcessing = $("#order #processing");
  const orderTotalPrice = $("#order #total_price")

  let totalPriceValue = 0;

  orderProcessing.hide();

  orderBtn.click(function () {
    getOrderData();
  });


  function setTotalPrice(){
    orderTotalPrice.text(totalPriceValue);
  }
  orderDelivered.click(function(){
    orderDelivered.toggle();
    getOrderDataDelivered();
    orderProcessing.toggle();
  })
  orderProcessing.click(function(){
    orderDelivered.toggle();
    getOrderData();
    orderProcessing.toggle();
  })

  function getOrderData(){
    totalPriceValue = 0;
    $.post(
      "./assets/scripts/server/catch_customer_request.php",
      {
        requestType: "order_info"
      },
      function (data) {
        orderList.empty();
        if (data && data != "null") {

            let orderItems = JSON.parse(data);
            let htmlData = "";

            for(let i = 0; i < orderItems.length; i++){
                let item = orderItems[i];
                totalPriceValue += item.quantity * item.price;
               

                htmlData +="<tr class='text-center align-middle fs-7 itemClick'>"
                        +"<td>"+(i+1)+"</td>"
                        +"<td><img src='./assets/images/items/"+item.id+"/"+item.images[0]+"' class='rounded-4' height='100' width='100' alt=''></td>"
                        +"<td class='fw-light'>"+item.name+"</td>"
                        +"<td class='fw-light'>&#8369;<span id='item_price'>"+item.price+"</span></td>"
                        +"<td>"+item.quantity+"</td>"
                        +"<td>"+item.status+"</td>"
                        +"<td id='ids_parent'>"
                        +"    <div class='d-flex justify-content-center fs-4'>"
                        +"        <input type='hidden' id='order_id' value='"+item.order_id+"'>"
                        +"        <input type='hidden' id='item_id' value='"+item.id+"'>"
                        +"        <i class='bi bi-eye mx-1 text-success'></i>"
                        +"    </div>"
                        +"</td>"
                        +"</tr>"

            }
            orderList.append(htmlData);
        }
        setTotalPrice();
      }
    );
  }

  function getOrderDataDelivered(){
    totalPriceValue = 0;
    $.post(
      "./assets/scripts/server/catch_customer_request.php",
      {
        requestType: "order_delivered_info"
      },
      function (data) {
        orderList.empty();
        if (data && data != "null") {

            let orderItems = JSON.parse(data);
            let htmlData = "";

            for(let i = 0; i < orderItems.length; i++){
                let item = orderItems[i];
                totalPriceValue += item.quantity * item.price;  

                htmlData +="<tr class='text-center align-middle fs-7 itemClick'>"
                        +"<td>"+(i+1)+"</td>"
                        +"<td><img src='./assets/images/items/"+item.id+"/"+item.images[0]+"' class='rounded-4' height='100' width='100' alt=''></td>"
                        +"<td class='fw-light'>"+item.name+"</td>"
                        +"<td class='fw-light'>&#8369;<span id='item_price'>"+item.price+"</span></td>"
                        +"<td>"+item.quantity+"</td>"
                        +"<td>"+item.status+"</td>"
                        +"<td id='ids_parent'>"
                        +"    <div class='d-flex justify-content-center fs-4'>"
                        +"        <input type='hidden' id='order_id' value='"+item.order_id+"'>"
                        +"        <input type='hidden' id='item_id' value='"+item.id+"'>"
                        +"        <i class='bi bi-eye mx-1 text-success'></i>"
                        +"    </div>"
                        +"</td>"
                        +"</tr>"

            }
            orderList.append(htmlData);
        }
        setTotalPrice();
      }
    );
  }

  
});
