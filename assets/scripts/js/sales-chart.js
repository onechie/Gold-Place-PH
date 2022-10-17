$(document).ready(function () {
  let labels = [];
  let allData = [];
  let lineChart = new Object();
  const mainDropDown = $(".sales #main-dropdown");
  const percentColor = $(".sales p #color");
  const percentArrow = $(".sales-arrow");
  const percentNumber = $(".sales-percent");
  const WholeNumber = $(".sales-number");


  getOrdersData("daily");

  const data = {
    labels: labels,
    datasets: [
      {
        label: "Sales",
        data: allData,
        fill: true,
        backgroundColor: "#ffc107",
        borderColor: "#ffc107",
        tension: 0.2,
      },
    ],
  };

  const config = {
    type: "line",
    data: data,
    options: {
      plugins: {
        legend: {
          display: false,
        },
      },
      interaction: {
        mode: "nearest",
        axis: "x",
        intersect: false,
      },
      maintainAspectRatio: false,
    },
  };

  
  $(".sales #daily").click(function(){
    lineChart.destroy();
    mainDropDown.empty();
    mainDropDown.text("DAILY");
    getOrdersData("daily");
  })
  $(".sales #weekly").click(function(){
    lineChart.destroy();
    mainDropDown.empty();
    mainDropDown.text("WEEKLY");
    getOrdersData("weekly");
  })
  $(".sales #monthly").click(function(){
    lineChart.destroy();
    mainDropDown.empty();
    mainDropDown.text("MONTHLY");
    getOrdersData("monthly");
  })
  $(".sales #annually").click(function(){
    lineChart.destroy();
    mainDropDown.empty();
    mainDropDown.text("ANNUALLY");
    getOrdersData("annually");
  })
  function getOrdersData(limit){

    $.post("../assets/scripts/server/catch_admin_request.php", {
      requestType:"line-chart-data",
      limit:limit
    },
      function (data) {
        console.log(data)
        if(data != null && data){
          
          let ordersData = JSON.parse(data);
          for(let i = 0; i < 7; i++){
            let order = ordersData[i];
            allData.unshift(order.sales);
            labels.unshift(order.label);

            if(allData.length == 8) allData.pop();
            if(labels.length == 8) labels.pop();

          }

          let percent = 0;
          
          if(allData[5] <= 0){
            percent = allData[6]*100;
          } else {
            percent = (allData[6] / allData[5] -1)*100;
          }

          percent = parseInt(percent);

          if(percent < 0){
            percent = percent * -1;
            percentColor.removeClass("bg-success");
            percentColor.addClass("bg-danger");
            percentArrow.removeClass("bi-arrow-up-short");
            percentArrow.addClass("bi-arrow-down-short");
          } else {
            percentColor.addClass("bg-success");
            percentColor.removeClass("bg-danger");
            percentArrow.addClass("bi-arrow-up-short");
            percentArrow.removeClass("bi-arrow-down-short");
          }
          
          percentNumber.empty();
          percentNumber.text(percent);
          WholeNumber.empty();
          WholeNumber.text(allData[6]);
          
          lineChart = new Chart($("#lineChart"), config);
          
        }
      }
    );
  }

});