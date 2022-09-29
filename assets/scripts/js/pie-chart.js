$(document).ready(function () {
  let labels = ["Cancelled", "Processing", "Delivered"];
  let allData = [100, 300, 200];

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

  const pieChart = new Chart($("#pieChart"), config);
});
