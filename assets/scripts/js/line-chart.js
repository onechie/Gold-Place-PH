$(document).ready(function () {
  const labels = ["MON", "TUE", "WED", "THU", "FRI", "SAT", "SUN"];
  const allData = [800, 500, 400, 300, 600, 700, 1000];

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

  const pieChart = new Chart($("#lineChart"), config);
});
