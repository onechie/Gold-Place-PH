$(document).ready(function () {
  //CALL THE ITEMS DATA FUNCTION
  getItemsData();

  $("#refresh-items").click(function () {
    getItemsData();
  });

  //FUNCTION TO LOAD THE ITEMS DATA
  function getItemsData() {
    $("#item-list").empty();
    //DO AJAX TO GET THE ITEMS DATA FROM THE SERVER
    $.post("../script/server/load_data_admin.php", function (data) {
      //CHECK IF JSON DATA IS NOT EMPTY
      if (data) {
        //PUT THE JSON DATA INTO ARRAY
        let itemInfo = JSON.parse(data);
        //GET THE DATA ON EACH JSON
        for (let i = 0; i < itemInfo.length; i++) {
          let item = itemInfo[i];
          let color = "primary";
          let stocks = item.stocks;

          //SET THE COLOR OF STOCKS BAR DEPENDS ON THE COUNT OF STOCKS
          if (stocks <= 25) {
            color = "danger";
          } else if (stocks <= 50) {
            color = "warning";
          } else {
            color = "primary";
          }
          //PUT THE TABLE ROW INTO ITEM LIST DIVIDER WITH THE ITEM VALUES
          $("#item-list").append(
            "<tr class='align-middle'>"
            +"   <td class='ps-4 py-4 id'>"+item.id+"</td>"
            +"    <td class='ps-4'>"
            +"        <div class='d-flex align-items-center'>"
            +"            <span class='position-relative rounded-5 bg-white shadow-sm me-2' style='width:50px; height:50px'>"
            +"                <img class='position-absolute m-1 bg-secondary rounded-5' src='../script/server/images/"+item.id+"/"+item.image+"' alt='' style='width:42px; height:42px'>"
            +"           </span>"
            +"            <strong>"+item.name+"</strong>"
            +"        </div>"
            +"    </td>"
            +"    <td class='ps-4 stocks-parent'>"
            +"        <p class='p-0 m-0'><span class='stocks'>"+item.stocks+"</span>/100</p>"
            +"        <div class='progress bg-dark bg-opacity-25'>"
            +"            <div class='progress-bar bg-"+color+"' role='progressbar' style='width:"+item.stocks+"%'></div>"
            +"        </div>"
            +"    </td>"
            +"    <td class='ps-4'><strong>"+item.price+"</strong></td>"
            +"    <td class='ps-4'><strong>"+item.sold+"</strong></td>"
            +"    <td class='ps-4 d'>"
            +"        <div class='d-flex '>"
            +"            <i class='editItem bi-pencil-square fs-5 text-secondary' data-bs-toggle='modal' data-bs-target='#items'></i>"
            +"            <i class='deleteItem bi bi-trash fs-5 text-danger'></i>"
            +"        </div>"
            +"    </td>"
            +"</tr>"
          )
        }
      }
    });
  }
});
