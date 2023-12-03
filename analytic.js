// Sample data for cleaning services
const services = ["Service 1", "Service 2", "Service 3", "Service 4", "Service 5", "Service 6"];
const serviceData = [50, 30, 20, 40, 60, 25]; // Replace with your actual data

// Get the canvas element
const ctx = document.getElementById("cleaningServicesChart").getContext("2d");

// Create a bar chart
const cleaningServicesChart = new Chart(ctx, {
  type: "bar",
  data: {
    labels: services,
    datasets: [
      {
        label: "Number of Bookings",
        data: serviceData,
        backgroundColor: "rgba(75, 192, 192, 0.2)", // Adjust colors as needed
        borderColor: "rgba(75, 192, 192, 1)",
        borderWidth: 1,
      },
    ],
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});
// Sample data for information boxes
const newClientsCount = 120;
const growthPercentage = 15;
const revenueAmount = 10000;
const appointmentsCount = 80;

// Update information boxes with sample data
document.getElementById("newClientsCount").innerText = newClientsCount;
document.getElementById("growthPercentage").innerText = growthPercentage + "%";
document.getElementById("revenueAmount").innerText = "$" + revenueAmount;
document.getElementById("appointmentsCount").innerText = appointmentsCount;
// Update your existing bar chart code

// Sample data for pie chart
const servicesPieData = {
    labels: ["Service 1", "Service 2", "Service 3", "Service 4", "Service 5", "Service 6"],
    datasets: [
      {
        data: [10, 20, 15, 25, 18, 12], // Replace with your actual data
        backgroundColor: [
          "#007bff",
          "#28a745",
          "#dc3545",
          "#ffc107",
          "#17a2b8",
          "#6610f2",
        ], // Custom colors for each service
      },
    ],
  };
  
  // Get the canvas element for the pie chart
  const pieCtx = document.getElementById("servicesPieChart").getContext("2d");
  
  // Create a pie chart
  const servicesPieChart = new Chart(pieCtx, {
    type: "pie",
    data: servicesPieData,
    options: {
      legend: {
        position: "right", // Adjust legend position as needed
      },
    },
  });
 // Initialize amChart for Appointments Comparison Graph
am4core.ready(function () {
    // Apply a theme
    am4core.useTheme(am4themes_animated);
  
    // Create chart instance
    var chart = am4core.create("appointmentsGraph", am4charts.XYChart);
  
    // Add data for all 12 months
    chart.data = [
      { "month": "Jan", "totalAppointments": 100 },
      { "month": "Feb", "totalAppointments": 120 },
      { "month": "Mar", "totalAppointments": 150 },
      { "month": "Apr", "totalAppointments": 130 },
      { "month": "May", "totalAppointments": 160 },
      { "month": "Jun", "totalAppointments": 180 },
      { "month": "Jul", "totalAppointments": 200 },
      { "month": "Aug", "totalAppointments": 220 },
      { "month": "Sep", "totalAppointments": 250 },
      { "month": "Oct", "totalAppointments": 230 },
      { "month": "Nov", "totalAppointments": 210 },
      { "month": "Dec", "totalAppointments": 190 }
    ];
  
    // Create axes
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "month";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 20;
  
    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
  
    // Create series
    var series = chart.series.push(new am4charts.ColumnSeries());
    series.dataFields.valueY = "totalAppointments";
    series.dataFields.categoryX = "month";
    series.name = "Total Appointments";
    series.columns.template.tooltipText = "{name}: [bold]{valueY}[/]";
    series.columns.template.strokeWidth = 2;
  
    // Add legend
    chart.legend = new am4charts.Legend();
  });
  const switchMode = document.getElementById('switch-mode');

  switchMode.addEventListener('change', function () {
    if (this.checked) {
      document.body.classList.add('dark');
    } else {
      document.body.classList.remove('dark');
    }
  });