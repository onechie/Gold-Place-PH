$(document).ready(function () {
  let labels = ["Cancelled", "Processing", "Delivered"];
  let colors = ["#212529", "#198754", "#28d785"];
  let allData = [];
  let pieChart = new Object();
  const mainDropDown = $(".orders #main-dropdown");
  const percentColor = $(".orders p #color");
  const percentArrow = $(".orders-arrow");
  const percentNumber = $(".orders-percent");
  const WholeNumber = $(".orders-number");

  getOrdersData("daily");
  
  const data = {
    labels: labels,
    datasets: [
      {
        label: "My First Dataset",
        data: allData,
        backgroundColor: colors,
        weight: 200,
        hoverOffset: 4,
      },
    ],
  };

  const config = {
    type: "doughnut",
    data: data,
    options: {
      plugins: {
        legend: {
          display: false,
        },
        tooltip: {},
      },
    },
  };

  $(".orders #daily").click(function(){
    pieChart.destroy();
    mainDropDown.empty();
    mainDropDown.text("TODAY");
    getOrdersData("daily");
  })
  $(".orders #weekly").click(function(){
    pieChart.destroy();
    mainDropDown.empty();
    mainDropDown.text("THIS WEEK");
    getOrdersData("weekly");
  })
  $(".orders #monthly").click(function(){
    pieChart.destroy();
    mainDropDown.empty();
    mainDropDown.text("THIS MONTH");
    getOrdersData("monthly");
  })
  $(".orders #annually").click(function(){
    pieChart.destroy();
    mainDropDown.empty();
    mainDropDown.text("THIS YEAR");
    getOrdersData("annually");
  })
  
  function getOrdersData(limit){
    $.post("../assets/scripts/server/catch_admin_request.php", {
      requestType:"order-chart-data",
      limit:limit
    },
      function (data) {
        if(data != null && data){
          let ordersData = JSON.parse(data);
          
          for(let i = 0; i < 2; i++){}

          let orderData = ordersData[0];

          let cancelled = orderData.cancelled;
          let processing = orderData.checking + orderData.processing;
          let delivered = orderData.delivered;

          allData.pop();
          allData.pop();
          allData.pop();
          allData.unshift(cancelled, processing, delivered);

          if(allData[0] == 0 && allData[1] == 0  && allData[2] == 0 ){
            if(labels.length == 4){
              labels.pop();
              colors.pop();
              allData.pop();
            }
            labels.push("Empty");
            colors.push("#6c757d");
            allData.push(1);

          } else {
            if(labels.length == 4){
              labels.pop();
              colors.pop();
              allData.pop();
            }
          }

          let percent = 0;
          
          if(ordersData[1].new <= 0){
            percent = ordersData[0].new*100;
          } else {
            percent = (ordersData[0].new / ordersData[1].new -1)*100;
          }


          if(percent < 0){
            percent = percent * -1;
            percentColor.removeClass("bg-success");
            percentColor.addClass("bg-danger");
            percentArrow.removeClass("bi-arrow-up-short");
            percentArrow.addClass("bi-arrow-down-short");
          } else {
            percent = percent * 1;
            percentColor.addClass("bg-success");
            percentColor.removeClass("bg-danger");
            percentArrow.addClass("bi-arrow-up-short");
            percentArrow.removeClass("bi-arrow-down-short");
          }
          
          percentNumber.empty();
          percentNumber.text(percent);
          WholeNumber.empty();
          WholeNumber.text(orderData.new);
          
          pieChart = new Chart($("#pieChart"), config);
          
        }
      }
    );
  }
});