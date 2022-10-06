$(document).ready(function () {
  let labels = ["Cancelled", "Processing", "Delivered"];
  let allData = [];
  let pieChart = new Object();
  const mainDropDown = $(".orders #main-dropdown");

  getOrdersData("daily");
  
  const data = {
    labels: labels,
    datasets: [
      {
        label: "My First Dataset",
        data: allData,
        backgroundColor: ["#212529", "#198754", "#28d785"],
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

  function getOrdersData(limit){
    $.post("../assets/scripts/server/charts_data.php", {
      requestType:"order-chart-data",
      limit:limit
    },
      function (data) {
        if(data != null && data){
          let ordersData = JSON.parse(data);

          let cancelled = ordersData.cancelled;
          let processing = ordersData.checking + ordersData.processing;
          let delivered = ordersData.delivered;

          allData.pop();
          allData.pop();
          allData.pop();
          allData.push(cancelled, processing, delivered);
          pieChart = new Chart($("#pieChart"), config);
          $(".orders #total-orders").text(ordersData.total)
          
        }
      }
    );
  }
});