<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION["user_name"])) {
    // If not logged in, redirect to the login page
    header("Location: index.php");
    exit();
}
// Display the authenticated user's information
$username = $_SESSION["user_name"];
//$all_section   = $_SESSION["user_roll_sections"];
$roll_areas = $_SESSION["user_roll_areas"];
$roll_other = $_SESSION["user_roll_other"];
?>
<?php
require_once('../../headers/header.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../../myimg/favicon-16x16.png" alt="Sky Logo" height="60" width="60">
        </div>
        <!-- Navbar -->
        <?php
        include '../../headers/top-menu.php'
            ?>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <?php
        include '../../headers/left-sidebar.php'
            ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="container-fluid">
                        <h5> <center><b>BreakDown</b></center> </h5>
                    </div>

                    <div class="container-fluid">
                        <!-- id_chart_Transformer -->
                        <div class="row row-cols-1 row-cols-md-4 g-4">
                            <div class="col ">
                                <div class="card w-100 " >
                                    <div class="card-body w-100 " >
                                       <div style="max-width: 300px; max-height: 150px;">
                                            <h5 class="card-title">AC</h5>
                                            <canvas id="id_chart_AC"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card w-100" >
                                    <div class="card-body w-100" >
                                        <div style="max-width: 200px; max-height: 150px;">
                                            <h5 class="card-title">CCTV</h5>
                                            <canvas id="id_chart_CCTV"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                     <div class="card-body">
                                        <div style="max-width: 300px; max-height: 150px;">
                                            <h5 class="card-title">Chiller</h5>
                                            <canvas id="id_chart_Chiller"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <div style="max-width: 300px; max-height: 150px;">
                                            <h5 class="card-title">Civil</h5>
                                            <canvas id="id_chart_Civil"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                        <div class="row row-cols-1 row-cols-md-4 g-4">
                            <div class="col">
                                <div class="card w-100" >
                                    <div class="card-body w-100" >
                                       <div style="max-width: 300px; max-height: 150px;">
                                            <h5 class="card-title">Compressor</h5>
                                            <canvas id="id_chart_Compressor"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card w-100" >
                                    <div class="card-body w-100" >
                                       <div style="max-width: 300px; max-height: 150px;">
                                            <h5 class="card-title">Diesel Storage</h5>
                                            <canvas id="id_chart_Diesel_Storage"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card w-100" >
                                    <div class="card-body w-100" >
                                       <div style="max-width: 300px; max-height: 150px;">
                                            <h5 class="card-title">Duct System</h5>
                                            <canvas id="id_chart_Duct_System"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card w-100" >
                                    <div class="card-body w-100" >
                                       <div style="max-width: 300px; max-height: 150px;">
                                            <h5 class="card-title">EAC</h5>
                                            <canvas id="id_chart_EAC"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row row-cols-1 row-cols-md-4 g-4">
                            <div class="col">
                                <div class="card w-100" >
                                    <div class="card-body w-100" >
                                       <div style="max-width: 300px; max-height: 150px;">
                                            <h5 class="card-title">Electrical</h5>
                                            <canvas id="id_chart_Electrical"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card w-100" >
                                    <div class="card-body w-100" >
                                       <div style="max-width: 300px; max-height: 150px;">
                                            <h5 class="card-title">Fire System</h5>
                                            <canvas id="id_chart_Fire_System"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card w-100" >
                                    <div class="card-body w-100" >
                                       <div style="max-width: 300px; max-height: 150px;">
                                            <h5 class="card-title">Generator</h5>
                                            <canvas id="id_chart_Generator"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card w-100" >
                                    <div class="card-body w-100" >
                                       <div style="max-width: 300px; max-height: 150px;">
                                            <h5 class="card-title">Lift</h5>
                                            <canvas id="id_chart_Lift"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row row-cols-1 row-cols-md-4 g-4">
                            <div class="col">
                                <div class="card w-100" >
                                    <div class="card-body w-100" >
                                       <div style="max-width: 300px; max-height: 150px;">
                                            <h5 class="card-title">PA System</h5>
                                            <canvas id="id_chart_PA_System"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card w-100" >
                                    <div class="card-body w-100" >
                                       <div style="max-width: 300px; max-height: 150px;">
                                            <h5 class="card-title">Pest Control</h5>
                                            <canvas id="id_chart_Pest_Control"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card w-100" >
                                    <div class="card-body w-100" >
                                       <div style="max-width: 300px; max-height: 150px;">
                                            <h5 class="card-title">RO Breakdown</h5>
                                            <canvas id="id_chart_RO_Breakdown"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card w-100" >
                                    <div class="card-body w-100" >
                                       <div style="max-width: 300px; max-height: 150px;">
                                            <h5 class="card-title">Transformer</h5>
                                            <canvas id="id_chart_Transformer"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    

                    <div class="row row-cols-1 row-cols-md-4 g-4">
                            <div class="col">
                                <div class="card w-100" >
                                    <div class="card-body w-100" >
                                       <div style="max-width: 300px; max-height: 150px;">
                                            <h5 class="card-title">Water dispenser</h5>
                                            <canvas id="id_chart_Water_dispenser"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>

                  





                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->


                <!-- Include Footer -->
                <br />
                <?php
                include '../../headers/footer-bar.php'
                    ?>
            </section>
        </div>
    </div>





    <script>
        var chart_Location_AC = [];
        var chart_COUNT_AC = [];
        var chart_Location_CCTV = [];
        var chart_COUNT_CCTV = [];
        var chart_Location_CHIILER = [];
        var chart_COUNT_CHIILER = [];
        var chart_Location_CIVIL = [];
        var chart_COUNT_CIVIL = [];
        var chart_Location_COMPRESSOR = [];
        var chart_COUNT_COMPRESSOR = [];
        var chart_Location_Diesel_Storage = [];
        var chart_COUNT_Diesel_Storage = [];
        var chart_Location_Duct_System = [];
        var chart_COUNT_Duct_System = [];
        var chart_Location_EAC = [];
        var chart_COUNT_EAC = [];

        var chart_Location_COMPRESSOR = [];
        var chart_COUNT_COMPRESSOR = [];


        function functionDailyPieChart() {

            let intDebugEnable = 0;
            if (intDebugEnable === 1) alert("functionDailyPieChart");
            const DataAry = [];
            DataAry[0] = "functionDailyPieChart";
            if (intDebugEnable === 1) alert(DataAry);

            $.post('class/getCount_Breakdown.php', { userpara: DataAry }, function (json_data2) {

                if (intDebugEnable === 1) alert(json_data2);
                var res = $.parseJSON(json_data2);
                if (intDebugEnable === 1) alert(res.Status_Ary[0]);

                var Data_Ary_size = res.Data_Ary.length;
                for (let x = 0; x < Data_Ary_size; x++) {
                    let chart_IssueType = res.Data_Ary[x][0];


                    if (chart_IssueType == "A\/C") {
                        chart_Location_AC.push(res.Data_Ary[x][2]);
                        chart_COUNT_AC.push(res.Data_Ary[x][3]);
                        RenderPieChart("id_chart_AC", chart_Location_AC, chart_COUNT_AC);
                    }
                    if (chart_IssueType == "CCTV") {
                        chart_Location_CCTV.push(res.Data_Ary[x][2]);
                        chart_COUNT_CCTV.push(res.Data_Ary[x][3]);
                        RenderPieChart("id_chart_CCTV", chart_Location_CCTV, chart_COUNT_CCTV);
                    }
                    if (chart_IssueType == "Chiller") {
                        chart_Location_CHIILER.push(res.Data_Ary[x][2]);
                        chart_COUNT_CHIILER.push(res.Data_Ary[x][3]);
                        RenderPieChart("id_chart_Chiller", chart_Location_CHIILER, chart_COUNT_CHIILER);
                    }
                    if (chart_IssueType == "Civil") {
                        chart_Location_CIVIL.push(res.Data_Ary[x][2]);
                        chart_COUNT_CIVIL.push(res.Data_Ary[x][3]);
                        RenderPieChart("id_chart_Civil", chart_Location_CIVIL, chart_COUNT_CIVIL);
                    }
                    if (chart_IssueType == "Compressor") {
                        chart_Location_COMPRESSOR.push(res.Data_Ary[x][2]);
                        chart_COUNT_COMPRESSOR.push(res.Data_Ary[x][3]);
                        RenderPieChart("id_chart_Compressor", chart_Location_COMPRESSOR, chart_COUNT_COMPRESSOR);
                    }
                    if (chart_IssueType == "Deasel Storage") {
                        chart_Location_Diesel_Storage.push(res.Data_Ary[x][2]);
                        chart_COUNT_Diesel_Storage.push(res.Data_Ary[x][3]);
                        RenderPieChart("id_chart_Diesel_Storage", chart_Location_Diesel_Storage, chart_COUNT_Diesel_Storage);
                    }
                    if (chart_IssueType == "Duct System") {
                        chart_Location_Duct_System.push(res.Data_Ary[x][2]);
                        chart_COUNT_Duct_System.push(res.Data_Ary[x][3]);
                        RenderPieChart("id_chart_Duct_System", chart_Location_Duct_System, chart_COUNT_Duct_System);
                    }
                    if (chart_IssueType == "EAC") {
                        chart_Location_EAC.push(res.Data_Ary[x][2]);
                        chart_COUNT_EAC.push(res.Data_Ary[x][3]);
                        RenderPieChart("id_chart_Duct_System", chart_Location_EAC, chart_COUNT_EAC);
                    }


                    //alert(chart_IssueType+" _ "+ chart_WorkOrderCategory+"_ "+chart_Location+" _ "+chart_COUNT)
                    //RenderPieChart(chart, labels, chart_COUNT)
                }


                //alert(Data_Ary_size);

            });


        }

        function RenderPieChart(chart, labels, count) {

            const canvas = document.getElementById(chart);
            const ctx = canvas.getContext("2d");

            // Check if chart exists on canvas and destroy it
            const existingChart = Chart.getChart(chart);
            if (existingChart) {
                existingChart.destroy();
            }

            // Create new chart
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: count,
                        borderWidth: 1,
                        backgroundColor: [
                            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
                            '#FF9F40', '#C9CBCF', '#FFCD56', '#47D147', '#2E86C1',
                            '#AF7AC5', '#F39C12', '#E74C3C', '#1ABC9C', '#8E44AD',
                            '#3498DB', '#27AE60', '#E67E22', '#D35400', '#BDC3C7',
                            '#7F8C8D', '#C0392B', '#2980B9', '#16A085', '#F1C40F',
                            '#95A5A6', '#34495E', '#5D6D7E', '#AAB7B8', '#58D68D'
                        ]
                    }]
                },
                options: {
                    animation: false,
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'right'
                        }
                    }
                }
            });

        }






        //setInterval(funRefresh_HomePage, 5000);
        functionDailyPieChart();

    </script>
</body>

</html>