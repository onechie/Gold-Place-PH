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

  let rateCount = 0;
  $("#rate-input #rate-submit").prop("disabled", true);

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

  $("#rate-input .bi-star").click(function() {

    $("#rate-input #rate-submit").prop("disabled", false);
    if($(this).hasClass("1")){
      rateCount = 1;
    }
    if($(this).hasClass("2")){
      rateCount = 2;
    }
    if($(this).hasClass("3")){
      rateCount = 3;
    }
    if($(this).hasClass("4")){
      rateCount = 4;
    }
    if($(this).hasClass("5")){
      rateCount = 5;
    }

    $("#rate-input .bi").each(function(i){
      if($(this).hasClass("bi-star-fill")){
        $(this).removeClass("bi-star-fill");
      }
      if(!$(this).hasClass("bi-star")){
        $(this).addClass("bi-star");
      }
    })

    for(let i = 1; i <= rateCount; i++){
      $("#rate-input ."+i).removeClass("bi-star");
      $("#rate-input ."+i).addClass("bi-star-fill");
    }

    $("#rate-input .count").text(rateCount+"/5");
  })

  $("#rate-input p #rate-submit").click(function(){
    let star = rateCount;
    let comment = $("#rate-input #rate-comment").val();
    let itemId = modalId.val();
    
    $.post("./assets/scripts/server/catch_customer_request.php", {
      requestType: "rate-item",
      star:star,
      comment:comment,
      itemId:itemId
    }, function(data){
      loadItem(itemId);
    })

  })


  $("#item-list").on("click", ".viewItem", function () {
    let id = $(this).siblings(".id").val();
    loadItem(id);
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

  function setStar(score){

    let htmlStars = '';
    for(let i = 0; i < 5; i++){
      if(i<score){
        htmlStars += "<i class='bi bi-star-fill pe-1'></i>";
      } else {
        htmlStars += "<i class='bi bi-star pe-1'></i>";
      }
    }
    return htmlStars;
  }

  function loadItem(id){
    $("#rate-input").hide();
    $.post(
      "./assets/scripts/server/catch_customer_request.php",
      { requestType: "load-item", id: id },
      function (data) {
        if (data && data != "null") {
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

          let rateHtml = "";
          let ratingsCount = 0;
          let ratingsTotal = 0;

          for (let rating of item.ratings){
            let star = setStar(rating.score)

            ratingsTotal += parseInt(rating.score);
            ratingsCount ++;

            rateHtml += "<div class='d-flex align-items-center'>"
                +"<span class='position-relative rounded-5 bg-white shadow-sm me-3' style='width:50px; height:50px'>"
                +"    <img class='position-absolute m-1 bg-primary rounded-5' src='./assets/images/defaults/rick.jpg' alt='' style='width:42px; height:42px'>"
                +"</span>"
                +"<div class=''>"
                +"    <span>"+rating.name+"</span>"
                +"    <p class='text-warning p-0 m-0'>"
                +         star
                +"    </p>"
                +"</div>"
                +"</div>"
                +"<div id='rate-text' class='w-100 py-3 fw-200'>"
                +rating.comment
                +"</div>"
                +"<hr></hr>"
          }

          let avgRate = 0
          if(ratingsCount > 0){
            avgRate = ratingsTotal / ratingsCount
          }

          $(".average-rate").empty();
          $(".average-rate").append(setStar(avgRate));

          $(".average-rate-text").empty();
          $(".average-rate-text").text(avgRate + "/5");
          
          $("#customer-rate").empty();
          $("#customer-rate").append(rateHtml);
          modalId.val(item.id);
          modalName.text(item.name);
          modalPrice.text(item.price);
          modalSold.text(item.sold);
          modalStocks.text(item.stocks);
          modalDescription.text(item.description);
          if(item.canRate == 'yes'){
            $("#rate-input").show();
          }
        }
      }
    );
  }

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

            let ratingsCount = 0;
            let ratingsTotal = 0;

            for (let rating of item.ratings){
              ratingsTotal += parseInt(rating.score);
              ratingsCount ++;
            }

            let avgRate = 0
            if(ratingsCount > 0){
              avgRate = ratingsTotal / ratingsCount
            }

            htmlData +=  "<div class='card shadow-sm my-3 bg-white p-2 rounded-2 mx-1 border-0'>"
                        +"    <div class='ratio ratio-1x1 rounded-top overflow-hidden' style='max-width: 300px;'>"
                        +"        <img src='./assets/images/items/"+item.id+"/"+item.images[0]+"' class='card-img-top' alt='...'>"
                        +"     </div>"
                        +"    <div class='card-body pb-0 px-1'>"
                        +"        <h6 class='card-title m-0 fs-6 fw-light text-secondary'>"+item.name+"</h6>"
                        +"        <h6 class='card-text c-1 m-0 fs-5 fw-200'><span>&#8369; </span>"+item.price+"</h6>"
                        +"        <div class='row justify-content-between'>"
                        +"            <div class='col-6 my-auto'>"
                        +"                <span class='align-middle text-warning'>"
                        +                    setStar(avgRate)
                        +"                </span>"
                        +"            </div>"
                        +"            <div class='col-6 text-end'>"
                        +"                <input type='hidden' class='id' value='"+item.id+"'>"
                        +"                <button type='button' class='addCart btn btn-light text-muted'><i class='bi bi-bag-plus'></i></button>"
                        +"                <button type='button' class='viewItem btn btn-light text-muted' data-bs-toggle='modal' data-bs-target='#item'><i class='bi bi-search'></i></button>"
                        +"            </div>"
                        +"        </div>"
                        +"    </div>"
                        +"</div>"
          }
          itemList.append(htmlData);
          itemList.fadeIn();
        }
        
        if (cardCount == 11) {
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
