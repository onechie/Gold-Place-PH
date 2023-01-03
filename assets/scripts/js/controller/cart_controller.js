$(document).ready(function () {
  "use strict";

  const toastBody = $(".toast-body");
  const toast = new bootstrap.Toast($("#liveToast"));

  const cartBtn = $("#cart-button");
  const cartList = $("#cart-items");
  const cartCheckOut = $("#cart #checkOut");

  const cartTotalPrice = $("#cart #total_price");
  const cartShippingFee = $("#cart #shipping_fee");
  const sfNumber = $("#cart #sf_number");
  const cartRemove = $("#cart #remove");

  const cartConfirm = $("#cart #proceed-confirm");
  const confirmBtn = $("#confirm-checkout confirm-btn");

  let paymentMethod = "";

  const popoverTriggerList = document.querySelectorAll(
    '[data-bs-toggle="popover"]'
  );
  const popoverList = [...popoverTriggerList].map(
    (popoverTriggerEl) => new bootstrap.Popover(popoverTriggerEl)
  );

  let currency = new Intl.NumberFormat("en-US", {
    style: "currency",
    currency: "PHP",
  });

  const token = $(".token").val();

  const cartUrl = "./assets/scripts/server/request/cart_request.php";

  let totalPriceValue = 0;
  cartConfirm.prop("disabled", true);
  cartRemove.prop("disabled", true);
  let checkoutArray = [];

  $("#item-list").on("click", ".addCart", function () {
    let id = $(this).siblings(".id").val();
    $.post(
      cartUrl,
      {
        id: id,
        quantity: 1,
        requestType: "cart_add",
        token: token,
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

  $("#item-quantity").keyup(function () {
    //check if input value is valid
    let id = $(this)
      .parents(".modal-content")
      .children(".modal-footer")
      .children("#item-id")
      .val();
    $.post(
      cartUrl,
      {
        token: token,
        requestType: "get_item_max_qty",
        id: id,
        quantity: $("#item-quantity").val(),
      },
      function (data) {
        $("#item-quantity").val(data);
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
        token: token,
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
    setShippingFee();
  });

  //CHANGE QUANTITY REQUEST
  cartList.on("change", ".input-qty", function () {
    let value = $(this).val();
    let cart_id = $(this)
      .parent()
      .siblings("#ids_parent")
      .find("#cart_id")
      .val();
    $.post(
      cartUrl,
      {
        value: value,
        cart_id: cart_id,
        requestType: "cart_update",
        token: token,
      },
      function (data) {
        getCartData();
        if (data == "no_stocks") {
          toastBody.text("Item out of stock!");
          toast.show();
        }
      }
    );
  });

  //CHECKOUT
  /*
  cartCheckOut.click(function () {
    checkoutArray = [];
    $(".checkBox").each(function () {
      if ($(this).is(":checked")) {
        checkoutArray.push(
          $(this).parent().siblings("td").find("#cart_id").val()
        );
      }
    });
    if (checkoutArray.length > 0) {
      $.post(
        cartUrl,
        {
          payment_method: 'cod',
          cartItems: checkoutArray,
          requestType: "cart_checkout",
          token: token,
        },
        function (data) {
          if (data == "ok") {
            getCartData();
            setTotalPrice();
            if ($("#check_all").is(":checked")) {
              $("#check_all").prop("checked", false);
            }
            toastBody.text("Items ordered successfully!");
            toast.show();
          }
          if (data == "invalid_address") {
            toastBody.text("Please update your address in your profile!");
            toast.show();
          }
          if (data == "zero_value") {
            toastBody.text("Add at least 1 quantity to checkout!");
            toast.show();
          }
          if (data == "not_updated") {
            toastBody.text(
              "Item quantity is not sync, Please re-open your cart or reload the page!"
            );
            toast.show();
          }
          if (data == "out_of_stock") {
            toastBody.text("Item out of stock!");
            toast.show();
          }
        }
      );
    }
  });
  */
  //CONFIRM CHECKOUT
  cartConfirm.click(function () {
    $("#confirm-btn").prop("disabled", true);
    checkoutArray = [];
    let itemNames = [];
    let itemPrices = [];
    let itemQuantities = [];
    let shippingFee = 0;
    let address = "";
    let total = 0;

    address =
      $("#address_number").val() +
      " " +
      $("#address_street").val() +
      ", " +
      $("#address_city").val() +
      ", " +
      $("#address_province").val();

    shippingFee = $(this).parent().siblings("div").find("#sf_number").text();

    $(".checkBox").each(function () {
      if ($(this).is(":checked")) {
        checkoutArray.push(
          $(this).parent().siblings("td").find("#cart_id").val()
        );
        itemNames.push($(this).parent().siblings(".item-name").text() + " x");
        itemQuantities.push(
          $(this).parent().siblings("td").find("#item_qty").val()
        );
        itemPrices.push(
          $(this).parent().siblings("td").find("#item_price").text() *
            $(this).parent().siblings("td").find("#item_qty").val()
        );
      }
    });

    for (let qty of itemQuantities) {
      if (qty <= 0) {
        toastBody.text("Add at least 1 quantity to checkout!");
        toast.show();
        return;
      }
    }

    if (shippingFee == "invalid") {
      toastBody.text("Please update your address in your profile!");
      toast.show();
    } else {
      if (checkoutArray.length > 0) {
        $("#confirm-checkout").modal("show");
        $("#confirm-address").text(address);
        let itemsHtmlData = "";
        let count = 0;
        for (let item of itemNames) {
          itemsHtmlData +=
            "<div class=' col-8 text-start text-break fw-200'>" +
            item +
            itemQuantities[count] +
            "</div>" +
            "<div class='col-4 text-start text-break'>" +
            currency.format(itemPrices[count]) +
            "</div>";

          total += parseInt(itemPrices[count]);
          count++;
        }
        total += parseInt(shippingFee);

        $("#confirm-items").html(itemsHtmlData);
        $("#confirm-shipping").html(currency.format(shippingFee));
        $("#confirm-total").text(currency.format(total));
        resetPaymentButton();
      }
    }
  });
  //PAYMENT OPTION CHOOSE
  $(".payment-option").click(function () {
    paymentMethod = "";

    if ($(this).hasClass("cod")) {
      if ($(this).hasClass("btn-outline-success")) {
        resetPaymentButton();
        $(this).removeClass("btn-outline-success");
        $(this).addClass("btn-success");
        paymentMethod = "cod";
      } else {
        resetPaymentButton();
      }
    }
    if ($(this).hasClass("gcash")) {
      if ($(this).hasClass("btn-outline-primary")) {
        resetPaymentButton();
        $(this).removeClass("btn-outline-primary");
        $(this).addClass("btn-primary");
        paymentMethod = "gcash";
        $("#gcash-message").show();
      } else {
        resetPaymentButton();
      }
    }
    if (paymentMethod == "") {
      $("#confirm-btn").prop("disabled", true);
    } else {
      $("#confirm-btn").prop("disabled", false);
    }
  });
  function resetPaymentButton() {
    $("#gcash-message").hide();
    $(".cod").removeClass("btn-success");
    $(".cod").addClass("btn-outline-success");

    $(".gcash").removeClass("btn-primary");
    $(".gcash").addClass("btn-outline-primary");
  }

  //CONFIRM CHECKOUT
  $("#confirm-btn").click(function () {
    $.post(
      cartUrl,
      {
        cartItems: checkoutArray,
        payment_method: paymentMethod,
        requestType: "cart_checkout",
        token: token,
      },
      function (data) {
        if (data == "ok") {
          getCartData();
          setTotalPrice();
          if ($("#check_all").is(":checked")) {
            $("#check_all").prop("checked", false);
          }
          toastBody.text("Items ordered successfully!");
          toast.show();
        }
        if (data == "invalid_address") {
          toastBody.text("Please update your address in your profile!");
          toast.show();
        }
        if (data == "zero_value") {
          toastBody.text("Add at least 1 quantity to checkout!");
          toast.show();
        }
        if (data == "not_updated") {
          toastBody.text(
            "Item quantity is not sync, Please re-open your cart or reload the page!"
          );
          toast.show();
        }
        if (data == "out_of_stock") {
          toastBody.text("Item out of stock!");
          toast.show();
        }
      }
    );
  });
  //REMOVE
  cartRemove.click(function () {
    let removeArray = [];
    $(".checkBox").each(function () {
      if ($(this).is(":checked")) {
        removeArray.push(
          $(this).parent().siblings("td").find("#cart_id").val()
        );
      }
    });
    if (removeArray.length > 0) {
      $.post(
        cartUrl,
        {
          cartItems: removeArray,
          requestType: "cart_remove",
          token: token,
        },
        function (data) {
          if (data == "ok") {
            getCartData();
            setTotalPrice();
            if ($("#check_all").is(":checked")) {
              $("#check_all").prop("checked", false);
            }
            toastBody.text("Items removed successfully!");
            toast.show();
          }
        }
      );
    }
  });
  //CHECK ALL
  $("#check_all").change(function () {
    totalPriceValue = 0;
    if ($(this).is(":checked")) {
      cartConfirm.prop("disabled", false);
      cartRemove.prop("disabled", false);
      $(".checkBox").each(function () {
        this.checked = true;
        let itemValue = parseInt(
          $(this).parent().siblings("td").find("#item_price").text()
        );
        let itemQty = parseInt(
          $(this).parent().siblings("td").find("#item_qty").val()
        );
        totalPriceValue += itemValue * itemQty;
      });
    } else {
      cartConfirm.prop("disabled", true);
      cartRemove.prop("disabled", true);
      $(".checkBox").each(function () {
        this.checked = false;
        totalPriceValue = 0;
      });
    }
    setTotalPrice();
  });

  //CHECK EACH
  cartList.on("change", ".checkBox", function () {
    cartConfirm.prop("disabled", true);
    cartRemove.prop("disabled", true);
    let itemValue = parseInt(
      $(this).parent().siblings("td").find("#item_price").text()
    );
    let itemQty = parseInt(
      $(this).parent().siblings("td").find("#item_qty").val()
    );
    if ($(this).is(":checked")) {
      totalPriceValue += itemValue * itemQty;
      cartConfirm.prop("disabled", false);
      cartRemove.prop("disabled", false);
      let checkAll = true;
      $(".checkBox").each(function () {
        if ($(this).prop("checked") == false) {
          checkAll = false;
        }
      });
      if (checkAll) {
        $("#check_all").prop("checked", true);
      }
    } else {
      $(".checkBox").each(function () {
        if ($(this).prop("checked") == true) {
          cartConfirm.prop("disabled", false);
          cartRemove.prop("disabled", false);
        }
      });
      $("#check_all").prop("checked", false);
      totalPriceValue -= itemValue * itemQty;
    }

    setTotalPrice();
  });

  function setTotalPrice() {
    cartTotalPrice.text(currency.format(totalPriceValue));
  }
  function setShippingFee() {
    $.post(
      cartUrl,
      {
        requestType: "user_shipping_fee",
        token: token,
      },
      function (data) {
        if (data >= 0) {
          cartShippingFee.text(currency.format(data));
          sfNumber.text(data);
        } else {
          cartShippingFee.text(data);
          sfNumber.text("invalid");
        }
      }
    );
  }

  function getCartData() {
    totalPriceValue = 0;
    cartConfirm.prop("disabled", true);
    cartRemove.prop("disabled", true);
    setTotalPrice();
    $("#check_all").prop("checked", false);
    $.post(
      cartUrl,
      {
        requestType: "cart_info",
        token: token,
      },
      function (data) {
        cartList.empty();
        if (data && data != "null") {
          let cartItems = JSON.parse(data);
          let htmlData = "";

          for (let i = 0; i < cartItems.length; i++) {
            let item = cartItems[i];

            htmlData +=
              "<tr class='align-middle fs-7 itemClick'>" +
              "<td class='px-4'><input class='form-check-input checkBox' type='checkbox' value=''></td>" +
              "<td class='px-4'><img src='./assets/images/items/" +
              item.id +
              "/" +
              item.images[0] +
              "' class='rounded-4' height='100' width='100' alt=''></td>" +
              "<td class='fw-light px-4 item-name'>" +
              item.name +
              "</td>" +
              "<td class='fw-light px-4'>" +
              currency.format(item.price) +
              "<span id='item_price' class='d-none'>" +
              item.price +
              "</span></td>" +
              "<td class='px-4'><input class='form-control input-qty p-1' id='item_qty' type='number' value='" +
              item.quantity +
              "'></td>" +
              "<td class='px-4' id='ids_parent'>" +
              "    <div class='d-flex fs-4'>" +
              "        <input type='hidden' id='cart_id' value='" +
              item.cart_id +
              "'>" +
              "        <input type='hidden' id='item_id' value='" +
              item.id +
              "'>" +
              "    </div>" +
              "</td>" +
              "</tr>";
          }
          cartList.append(htmlData);
        }
      }
    );
  }
});
