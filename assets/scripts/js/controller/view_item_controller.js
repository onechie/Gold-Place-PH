$(document).ready(function () {
    "use strict";

    const modalId = $("#item #item-id")
    const modalName = $("#item #item-name");
    const modalPrice = $("#item #item-price");
    const modalSold = $("#item #item-sold");
    const modalStocks = $("#item #item-stocks");
    const modalDescription = $("#item #item-description");
    const modalImage = $("#image-carousel .carousel-inner");

    const token = $(".token").val();

    const viewItemUrl = "./assets/scripts/server/request/view_item_request.php";
  
    let rateCount = 0;
    $("#rate-input #rate-submit").prop("disabled", true);
  
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
      
      $.post(viewItemUrl, {
        requestType: "rate-item",
        star:star,
        comment:comment,
        itemId:itemId,
        token:token
      }, function(data){
        loadItem(itemId);
      })
  
    })
  
    $("#item-list").on("click", ".viewItem", function () {
      let id = $(this).siblings(".id").val();
      loadItem(id);
    });
  
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
        viewItemUrl,
        { requestType: "load-item", id: id, token:token},
        function (data) {
          if (data && data != "null") {
            let item = JSON.parse(data);
  
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
            modalDescription.html(item.description);
            if(item.canRate == 'yes'){
              $("#rate-input").show();
            }
          }
        }
      );
    }
  });
  