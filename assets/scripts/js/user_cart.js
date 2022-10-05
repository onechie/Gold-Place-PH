$(document).ready(function () {
  "use strict";
  const cartBtn = $("#cart-button");
  const cartList = $("#cart-items");
  const cartCheckOut = $("#cart #checkOut");
  const cartTotalPrice = $("#cart #total_price")
  const cartRemove = $("#cart #remove");

  const toast = new bootstrap.Toast($("#liveToast"));
  const toastBody = $(".toast-body");

  let totalPriceValue = 0;

  $(cartBtn).click(function () {
    getCartData();
  });

  //CHANGE QUANTITY REQUEST
  cartList.on("change", ".input-qty", function () {
    let value = $(this).val();
    let cart_id = $(this).parent().siblings("#ids_parent").find("#cart_id").val();
    $.post("./assets/scripts/server/catch_customer_request.php", {
      value: value,
      cart_id: cart_id,
      requestType: "cart_update",
    },
      function (data) {
        getCartData();
      },
    );
  })

  //CHECK ALL
  $("#check_all").change(function () { 
    totalPriceValue = 0; 
    if($(this).is(":checked")){
      $(".checkBox").each(function(){
        this.checked = true;
        let itemValue = parseInt($(this).parent().siblings("td").find("#item_price").text());
        let itemQty = parseInt($(this).parent().siblings("td").find("#item_qty").val());
        totalPriceValue += itemValue*itemQty; 
      })
    } else {
      $(".checkBox").each(function(){
        this.checked = false;
        totalPriceValue = 0; 
      })
    }
    setTotalPrice();
  });

  //CHECK EACH
  cartList.on("change", ".checkBox", function(){
      let itemValue = parseInt($(this).parent().siblings("td").find("#item_price").text());
      let itemQty = parseInt($(this).parent().siblings("td").find("#item_qty").val());
    if($(this).is(":checked")){
      totalPriceValue += itemValue*itemQty; 
    } else {
      totalPriceValue -= itemValue*itemQty; 
    }

    setTotalPrice();
  })

  //CHECKOUT 
  cartCheckOut.click(function () {
    let  checkoutArray = [];
    $(".checkBox").each(function(){
      if($(this).is(":checked")){
        checkoutArray.push($(this).parent().siblings("td").find("#cart_id").val())
      }
    })
    if(checkoutArray.length > 0){
      $.post("./assets/scripts/server/catch_customer_request.php", {
        cartItems:checkoutArray,
        requestType:"cart_checkout"
      },
        function (data) {
          if(data == "ok"){
            getCartData();
            setTotalPrice();
            if($("#check_all").is(":checked")){
              $("#check_all").prop("checked", false);
            }
            toastBody.text("Items ordered successfully!");
            toast.show();
          }
          
        }
      );
    }
    
  });

  //REMOVE
  cartRemove.click(function(){
    let removeArray = [];
    $(".checkBox").each(function(){
      if($(this).is(":checked")){
        removeArray.push($(this).parent().siblings("td").find("#cart_id").val())
      }
    })
    if(removeArray.length > 0){
      $.post("./assets/scripts/server/catch_customer_request.php", {
        cartItems:removeArray,
        requestType:"cart_remove"
      },
        function (data) {
          if(data == "ok"){
            getCartData();
            setTotalPrice();
            if($("#check_all").is(":checked")){
              $("#check_all").prop("checked", false);
            }
            toastBody.text("Items removed successfully!");
            toast.show();
          }
        }
      );
    }

  })

  function setTotalPrice(){
    cartTotalPrice.text(totalPriceValue);
  }

  function getCartData(){
    totalPriceValue = 0;
    $.post(
      "./assets/scripts/server/catch_customer_request.php",
      {
        requestType: "cart_info"
      },
      function (data) {
        cartList.empty();
        if (data && data != "null") {

            let cartItems = JSON.parse(data);
            let htmlData = "";

            for(let i = 0; i < cartItems.length; i++){
                let item = cartItems[i];

                htmlData +="<tr class='text-center align-middle fs-7 itemClick'>"
                        +"<td><input class='form-check-input checkBox' type='checkbox' value=''></td>"
                        +"<td><img src='./assets/images/items/"+item.id+"/"+item.images[0]+"' class='rounded-4' height='100' width='100' alt=''></td>"
                        +"<td class='fw-light'>"+item.name+"</td>"
                        +"<td class='fw-light'>&#8369;<span id='item_price'>"+item.price+"</span></td>"
                        +"<td><input class='form-control input-qty mx-auto p-1' id='item_qty' type='number' value='"+item.quantity+"'></td>"
                        +"<td id='ids_parent'>"
                        +"    <div class='d-flex justify-content-center fs-4'>"
                        +"        <input type='hidden' id='cart_id' value='"+item.cart_id+"'>"
                        +"        <input type='hidden' id='item_id' value='"+item.id+"'>"
                        +"        <i class='bi bi-eye mx-1 text-success'></i>"
                        +"    </div>"
                        +"</td>"
                        +"</tr>"

            }
            cartList.append(htmlData);
        }
      }
    );
  }

  
});
