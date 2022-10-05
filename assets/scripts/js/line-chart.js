$(document).ready(function () {
  const labels = ["MON", "TUE", "WED", "THU", "FRI", "SAT", "SUN"];
  const allData = [0, 0, 0, 0, 0, 0];

  getOrdersData();

  const data = {
    labels: labels,
    datasets: [
      {
        label: "Sales",
        data: allData,
        fill: false,
        backgroundColor: "#ffc107",
        borderColor: "#ffc107",
        tension: 0,
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

  

  function getOrdersData(){
    $.post("../assets/scripts/server/charts_data.php", {requestType:"order-chart-data"},
      function (data) {
        console.log(data);
        if(data != null && data){
          let ordersData = JSON.parse(data);

          allData.push(ordersData.delivered);

          const pieChart = new Chart($("#lineChart"), config);
          
          $(".sales #total-sales").text(ordersData.delivered)
          $(".sales #home-sales").text(ordersData.delivered)
          $(".sales #home-orders").text(ordersData.total)
          $(".sales #home-stocks").text(ordersData.stocks)
          $(".sales #home-users").text(ordersData.users)
          
        }
      }
    );
  }

});
