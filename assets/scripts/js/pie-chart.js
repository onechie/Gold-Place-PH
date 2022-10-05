$(document).ready(function () {
  let labels = ["Cancelled", "Processing", "Delivered"];
  let allData = [];

  getOrdersData();

  console.log(allData);
  
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

  function getOrdersData(){
    $.post("../assets/scripts/server/charts_data.php", {requestType:"order-chart-data"},
      function (data) {
        console.log(data);
        if(data != null && data){
          let ordersData = JSON.parse(data);

          let cancelled = ordersData.cancelled;
          let processing = ordersData.checking + ordersData.processing;
          let delivered = ordersData.delivered;

          allData.push(cancelled, processing, delivered);
          const pieChart = new Chart($("#pieChart"), config);
          $(".orders #total-orders").text(ordersData.total)
          
        }
      }
    );
  }
});
