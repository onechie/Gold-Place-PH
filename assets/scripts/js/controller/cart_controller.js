$(document).ready(function () {
  "use strict";

  const toastBody = $(".toast-body");
  const toast = new bootstrap.Toast($("#liveToast"));

  const cartBtn = $("#cart-button");
  const cartList = $("#cart-items");
  const cartCheckOut = $("#cart #checkOut");
  const cartTotalPrice = $("#cart #total_price")
  const cartRemove = $("#cart #remove");

  const token = $('.token').val();

  const cartUrl = "./assets/scripts/server/request/cart_request.php";

  let totalPriceValue = 0;

  $("#item-list").on("click", ".addCart", function () {
    let id = $(this).siblings(".id").val();
    $.post(
      cartUrl,
      {
        id: id,
        quantity: 1,
        requestType: "cart_add",
        token: token
      },
      function (data) {
        if (data == "login_required") {
          toastBody.text("Please login to add in your cart!");
        }
        if (data == "success") {
          toastBody.text("Added to cart successfully!");
        }
        if (data == "already") {
          toastBody.text("Item already added to cart!");
        }
        if (data == "error") {
          toastBody.text("Something went wrong! Please reload the page.");
        }
        toast.show();
      }
    );
  });

  $("#item #add-cart-btn").click(function () {
    let id = $(this).siblings("#item-id").val();
    let qty = $("#item-quantity").val();
    $.post(
      cartUrl,
      {
        id: id,
        quantity: qty,
        requestType: "cart_add",
        token: token
      },
      function (data) {
        if (data == "login_required") {
          toastBody.text("Please login to add in your cart!");
        }
        if (data == "success") {
          toastBody.text("Added to cart successfully!");
        }
        if (data == "already") {
          toastBody.text("Item already added to cart!");
        }
        if (data == "error") {
          toastBody.text("Something went wrong! Please reload the page.");
        }
        toast.show();
      }
    );
  });

  $(cartBtn).click(function () {
    getCartData();
  });

  //CHANGE QUANTITY REQUEST
  cartList.on("change", ".input-qty", function () {
    let value = $(this).val();
    let cart_id = $(this).parent().siblings("#ids_parent").find("#cart_id").val();
    $.post(cartUrl, {
      value: value,
      cart_id: cart_id,
      requestType: "cart_update",
      token: token
    },
      function (data) {
        getCartData();
      },
    );
  })

    //CHECKOUT 
    cartCheckOut.click(function () {
      let checkoutArray = [];
      $(".checkBox").each(function(){
        if($(this).is(":checked")){
          checkoutArray.push($(this).parent().siblings("td").find("#cart_id").val())
        }
      })
      if(checkoutArray.length > 0){
        $.post(cartUrl, {
          cartItems:checkoutArray,
          requestType:"cart_checkout",
          token: token
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
            if(data == "invalid_address"){
              toastBody.text("Please update your address in your profile!");
              toast.show();
            }
            if(data == "zero_value"){
              toastBody.text("Add at least 1 quantity to checkout!");
              toast.show();
            }
            if(data == "out_of_stock"){
              toastBody.text("Item out of stock!");
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
      $.post(cartUrl, {
        cartItems:removeArray,
        requestType:"cart_remove",
        token: token
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

  
  function setTotalPrice(){
    cartTotalPrice.text(totalPriceValue);
  }

  function getCartData(){
    totalPriceValue = 0;
    $.post(
      cartUrl,
      {
        requestType: "cart_info",
        token: token
      },
      function (data) {
        cartList.empty();
        if (data && data != "null") {

            let cartItems = JSON.parse(data);
            let htmlData = "";

            for(let i = 0; i < cartItems.length; i++){
                let item = cartItems[i];

                htmlData +="<tr class='align-middle fs-7 itemClick'>"
                        +"<td class='px-4'><input class='form-check-input checkBox' type='checkbox' value=''></td>"
                        +"<td class='px-4'><img src='./assets/images/items/"+item.id+"/"+item.images[0]+"' class='rounded-4' height='100' width='100' alt=''></td>"
                        +"<td class='fw-light px-4'>"+item.name+"</td>"
                        +"<td class='fw-light px-4'>&#8369;<span id='item_price'>"+item.price+"</span></td>"
                        +"<td class='px-4'><input class='form-control input-qty p-1' id='item_qty' type='number' value='"+item.quantity+"'></td>"
                        +"<td class='px-4' id='ids_parent'>"
                        +"    <div class='d-flex fs-4'>"
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
