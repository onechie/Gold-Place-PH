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
    getOrderData("processing");
  });


  function setTotalPrice(){
    orderTotalPrice.text(totalPriceValue);
  }
  orderDelivered.click(function(){
    orderDelivered.toggle();
    getOrderData("delivered");
    orderProcessing.toggle();
  })
  orderProcessing.click(function(){
    orderDelivered.toggle();
    getOrderData("processing");
    orderProcessing.toggle();
  })

  function getOrderData(type){
    totalPriceValue = 0;
    $.post(
      "./assets/scripts/server/catch_customer_request.php",
      {
        type:type,
        requestType: "order_info"
      },
      function (data) {
        //orderList.empty();
        orderList.empty();
        let htmlData = "";
        totalPriceValue = 0;
        if (data && data != "null") {
          let orders = JSON.parse(data);
          for(let i = 0; i < orders.length; i++){
            let order = orders[i];
            let order_items = order.order_items;
            
            htmlData += "<tr>"
                          +"<td class='p-0'>"
                          +"  <div class='accordion accordion-flush'>"
                          +"    <div class='accordion-item fw-200 fs-7'>"
                          +"      <div class='accordion-header fw-normal row py-3 px-4 bg-white' data-bs-toggle='collapse' data-bs-target='#flush-"+i+"'>"
                          +"        <div class='col-2'>"+(i+1)+"</div>"
                          +"        <div class='col-5'>"+order.date+"</div>"
                          +"        <div class='col-4'>"+order.status+"</div>"
                          +"        <div class='col-1'><i class='bi bi-chevron-down'></i></div>"
                          +"      </div>"

            for(let j = 0; j < order_items.length; j++){
              let item = order_items[j];
              totalPriceValue += item.price * item.quantity;
              htmlData += "<div id='flush-"+i+"' class='accordion-collapse collapse'>"
                          +"  <div class='accordion-body py-2 px-5 row bg-light'>"
                          +"    <div class='col-2'> <img src='./assets/images/items/"+item.id+"/"+item.image+"' class='rounded-3' height='100' width='100' alt=''></div>"
                          +"    <div class='col-4 my-auto'>"+item.name+"</div>"
                          +"    <div class='col-3 my-auto'>&#8369;<span id='item_price'>"+item.price+"</span></div>"
                          +"    <div class='col-2 my-auto'>"+item.quantity+"</div>"
                          +"    <div class='col-1 my-auto'><i class='bi bi-eye mx-1 text-success fs-4'></i></div>"
                          +"  </div>"
                          +"</div>"
            }
            htmlData += "</div>"
                      +"</div>"
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
