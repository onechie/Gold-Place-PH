$(document).ready(function () {
  "use strict";

  const itemList = $("#user-panel #item-list");
  const toastBody = $(".toast-body");
  const modalId = $("#item #item-id")
  const modalName = $("#item #item-name");
  const modalPrice = $("#item #item-price");
  const modalSold = $("#item #item-sold");
  const modalStocks = $("#item #item-stocks");
  const modalDescription = $("#item #item-description");
  const modalImage = $("#image-carousel .carousel-inner");
  const nextPage = $("#next");
  const prevPage = $("#previous");
  const pageCount =  $("#page");
  const itemSearchBar = $("#search-item")
  const toast = new bootstrap.Toast($("#liveToast"));
  
  getItemsData();

  nextPage.click(function () {
    let page = parseInt(pageCount.val());
    page += 1;
    pageCount.val(page);
    getItemsData();
  });

  prevPage.click(function () {
    let page = parseInt(pageCount.val());
    if(page >= 2){
      page -= 1;
      pageCount.val(page);
    }
    getItemsData();
  });

  $("#item-list").on("click", ".viewItem", function () {
    let id = $(this).siblings(".id").val();
    $.post(
      "./assets/scripts/server/catch_customer_request.php",
      { requestType: "load-item", id: id },
      function (data) {
        if (data) {
          let itemInfo = JSON.parse(data);
          let item = itemInfo[0];

          modalImage.empty();

          for (let i = 0; i < item.images.length; i++) {
            let setActive = "active";
            if (i == 0) setActive = "active";
            else setActive = "";

            modalImage.append(
                "<div class='carousel-item " + setActive + " ratio ratio-1x1' style='max-width: 400px;'>" +
                "    <img src='./assets/images/items/" + item.id + "/" + item.images[i] + "' class='d-block rounded-4' alt='image' style='object-fit: cover;'>" +
                "</div>"
            );
          }
          modalId.val(item.id);
          modalName.text(item.name);
          modalPrice.text(item.price);
          modalSold.text(item.sold);
          modalStocks.text(item.stocks);
          modalDescription.text(item.description);
          
        }
      }
    );
  });

  $("#item-list").on("click", ".addCart", function(){
    let id = $(this).siblings(".id").val()
    $.post("./assets/scripts/server/catch_customer_request.php",{
        id:id,
        quantity:1,
        requestType:"cart_add"
    }, function(data){
        
        if(data=="login_required"){
          toastBody.text("Please login to add in your cart!");
        }
        if(data=="success"){
          toastBody.text("Added to cart successfully!");
        }
        if(data=="already"){
          toastBody.text("Item already added to cart!");
        }
        if(data=="error"){
          toastBody.text("Something went wrong! Please reload the page.");
        }
        toast.show();
    })
  })

  $("#item #add-cart-btn").click(function(){
    let id = $(this).siblings("#item-id").val()
    let qty = $("#item-quantity").val();
    $.post("./assets/scripts/server/catch_customer_request.php",{
        id:id,
        quantity:qty,
        requestType:"cart_add"
    }, function(data){
        toastBody.text("Added to cart successfully!");
        if(data=="login_required"){
          toastBody.text("Please login to add in your cart!");
        }
        if(data=="success"){
          toastBody.text("Added to cart successfully!");
        }
        if(data=="already"){
          toastBody.text("Item already added to cart!");
        }
        if(data=="error"){
          toastBody.text("Something went wrong! Please reload the page.");
        }
        toast.show();
    })
  })

  function getItemsData() {
    let page = pageCount.val();

    $.post(
      "./assets/scripts/server/catch_customer_request.php",
      { requestType: "load-items", page: page },
      function (data) {

        let cardCount = 0;
        if (data && data != "null") {
          let itemInfo = JSON.parse(data);
          let htmlData = "";

          itemList.hide();
          itemList.empty();
          for (let i = 0; i < itemInfo.length; i++) {   
            let item = itemInfo[i];
            cardCount = i;
            htmlData +=  "<div class='card shadow my-3 bg-light p-2 rounded-4 mx-1'>"
                        +"    <div class='ratio ratio-1x1 rounded-top overflow-hidden' style='max-width: 300px;'>"
                        +"        <img src='./assets/images/items/"+item.id+"/"+item.images[0]+"' class='card-img-top' alt='...'>"
                        +"     </div>"
                        +"    <div class='card-body pb-0 px-1'>"
                        +"        <h6 class='card-title m-0 fs-6 fw-light text-dark'>"+item.name+"</h6>"
                        +"        <h6 class='card-text text-warning m-0 fs-5 fw-normal'><span>&#8369;</span>"+item.price+"</h6>"
                        +"        <div class='row justify-content-between'>"
                        +"            <div class='col-6 my-auto'>"
                        +"                <span class='align-middle'>"
                        +"                    <i class='bi bi-star-fill text-warning'></i>"
                        +"                    <i class='bi bi-star-fill text-warning'></i>"
                        +"                    <i class='bi bi-star-fill text-warning'></i>"
                        +"                    <i class='bi bi-star-fill text-warning'></i>"
                        +"                    <i class='bi bi-star-fill text-warning'></i>"
                        +"                </span>"
                        +"            </div>"
                        +"            <div class='col-6 text-end'>"
                        +"                <input type='hidden' class='id' value='"+item.id+"'>"
                        +"                <button type='button' class='addCart btn btn-outline-warning'><i class='bi bi-bag-plus'></i></button>"
                        +"                <button type='button' class='viewItem btn btn-outline-warning' data-bs-toggle='modal' data-bs-target='#item'><i class='bi bi-search'></i></button>"
                        +"            </div>"
                        +"        </div>"
                        +"    </div>"
                        +"</div>"
          }
          itemList.append(htmlData);
          itemList.fadeIn();
        }
        
        if (cardCount == 7) {
            nextPage.prop("disabled", false);
        } else {
            nextPage.prop("disabled", true);
            toastBody.text("This is the last page.");
            toast.show();
            
            if(cardCount == 0){
              pageCount.val(page-1);
              page--;
            }
        }
        if (page == 1) {
          prevPage.prop("disabled", true);
        } else {
          prevPage.prop("disabled", false);
        }
        cardCount = 0;
      }
    );
  }
});
