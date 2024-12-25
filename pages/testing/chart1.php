<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Horizontal Stacked Bar Chart</title>
<!-- Load Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<!-- Create a canvas to render the chart -->
<div id="id_divEmpChart">
    <canvas id="id_canEmpChart" style="min-height: 240px; height: 240px; max-height: 240px; max-width: 100%;"></canvas>
</div>

<script>
// Dummy data for the chart
const d0 = 100; // Worked Time
const d1 = 200; // Allocated Time
const d2 = 250; // Total Time

// Chart options
var barOptions_stacked = {
    hover: {
        animationDuration: 10
    },
    scales: {
        xAxes: [{
            display: false, // Hide x-axis
            stacked: true
        }],
        yAxes: [{
            ticks: {
                beginAtZero: true,
                fontFamily: "'Open Sans Bold', sans-serif",
                fontSize: 12,
                fontWeight: 'bold'
            },
            scaleLabel: {
                display: true,
                labelString: 'Worked Time', // Set y-label
                fontFamily: "'Open Sans Bold', sans-serif",
                fontSize: 14,
                fontWeight: 'bold'
            },
            stacked: true
        }]
    },
    legend: {
        display: false
    },
};

// Chart data
var ctx = document.getElementById("id_canEmpChart");
var myChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        labels: ['Worked Time'], // Label for the single horizontal bar
        datasets: [{
            label: 'Allocated Time',
            data: [d1], // Dummy data for Allocated Time
            backgroundColor: 'rgba(54, 162, 235, 0.5)', // Color for Allocated Time
            borderWidth: 0 // Remove border
        }, {
            label: 'Total Time',
            data: [d2], // Dummy data for Total Time
            backgroundColor: 'rgba(75, 192, 192, 0.5)', // Color for Total Time
            borderWidth: 0 // Remove border
        }]
    },
    options: barOptions_stacked,
});
</script>

</body>
</html>
