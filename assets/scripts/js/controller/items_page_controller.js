$(document).ready(function () {
  "use strict";

  const itemList = $("#user-panel #item-list");
  const toastBody = $(".toast-body");
  const nextPage = $("#next");
  const prevPage = $("#previous");
  const pageCount = $("#page");
  const itemSearchBar = $("#search-item");
  const toast = new bootstrap.Toast($("#liveToast"));

  const itemsPageUrl = "./assets/scripts/server/request/items_page_request.php";

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
    if (page >= 2) {
      page -= 1;
      pageCount.val(page);
    }
    getItemsData();
  });

  function setStar(score) {
    let htmlStars = "";
    for (let i = 0; i < 5; i++) {
      if (i < score) {
        htmlStars += "<i class='bi bi-star-fill pe-1'></i>";
      } else {
        htmlStars += "<i class='bi bi-star pe-1'></i>";
      }
    }
    return htmlStars;
  }

  function getItemsData() {
    let page = pageCount.val();

    $.post(
      itemsPageUrl,
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

            for (let rating of item.ratings) {
              ratingsTotal += parseInt(rating.score);
              ratingsCount++;
            }

            let avgRate = 0;
            if (ratingsCount > 0) {
              avgRate = ratingsTotal / ratingsCount;
            }

            htmlData +=
              "<div class='card shadow-sm my-3 bg-white p-2 rounded-2 mx-1 border-0'>" +
              "    <div class='ratio ratio-1x1 rounded-top overflow-hidden' style='max-width: 300px;'>" +
              "        <img src='./assets/images/items/" +
              item.id +
              "/" +
              item.images[0] +
              "' class='card-img-top' alt='...'>" +
              "     </div>" +
              "    <div class='card-body pb-0 px-1'>" +
              "        <h6 class='card-title m-0 fs-6 fw-light text-secondary'>" +
              item.name +
              "</h6>" +
              "        <h6 class='card-text c-1 m-0 fs-5 fw-200'><span>&#8369; </span>" +
              item.price +
              "</h6>" +
              "        <div class='row justify-content-between'>" +
              "            <div class='col-6 my-auto'>" +
              "                <span class='align-middle text-warning'>" +
              setStar(avgRate) +
              "                </span>" +
              "            </div>" +
              "            <div class='col-6 text-end'>" +
              "                <input type='hidden' class='id' value='" +
              item.id +
              "'>" +
              "                <button type='button' class='addCart btn btn-light text-muted'><i class='bi bi-bag-plus'></i></button>" +
              "                <button type='button' class='viewItem btn btn-light text-muted' data-bs-toggle='modal' data-bs-target='#item'><i class='bi bi-search'></i></button>" +
              "            </div>" +
              "        </div>" +
              "    </div>" +
              "</div>";
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

          if (cardCount == 0) {
            pageCount.val(page - 1);
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
