<?php
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION["user_name"]))
    {
        // If not logged in, #ff6347irect to the login page
        header("Location: index.php");
        exit();
    }
    // Display the authenticated user's information
    $username = $_SESSION["user_name"];

?>
<?php
    include_once'../../headers/header.php';
    //include_once'../../dbconnection/dbConnection.php';
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
                    <div class="row pt-0">
                    <div class="col-lg2 col-xs-3">
                        <div id="l1">
                            <div class="small-box mx-2">
                                <div id="id_color_0" style="background-color: darkgray; width: 220px; height: 130px;">
                                    <center><h4 id='id_mcno_0' style="font-size: 18px; font-weight: bold;">SB-01</h4></center>
                                    <table style="width: 100%;">
                                        <tr>
                                            <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                                            <td id='id_mcspeed_0' style="font-size: 18px; font-weight: bold;">0</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                            <td id='runtime_1' style="font-size: 18px; font-weight: bold;"> - - </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                            <td id='Efficacy_1' style="font-size: 18px; font-weight: bold;"> - - </td>
                                        </tr>
                                    </table>                      
                                </div>
                            </div>
                        </div>                           
                    </div>


                    <div class="col-lg2 col-xs-3">
                        <div id="l1">
                            <div class="small-box mx-2">
                                <div id="id_color_001" style="background-color: darkgray; width: 220px; height: 130px;">
                                    <center><h4 id='id_mcno_1' style="font-size: 18px; font-weight: bold;">SC-01</h4></center>
                                    <table style="width: 100%;">
                                        <tr>
                                            <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                                            <td id='id_mcspeed_001' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                            <td id='runtime_2' style="font-size: 18px; font-weight: bold;"> - - </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                            <td id='Efficacy_2' style="font-size: 18px; font-weight: bold;"> - - </td>
                                        </tr>
                                    </table>                      
                                </div>
                            </div>
                        </div>                           
                    </div>

                    <div class="col-lg2 col-xs-3">
                        <div id="l1">
                            <div class="small-box mx-2">
                                <div id="id_color_0001" style="background-color: darkgray; width: 220px; height: 130px;">
                                    <center><h4 id='id_mcno_2' style="font-size: 18px; font-weight: bold;">SD-01</h4></center>
                                    <table style="width: 100%;">
                                        <tr>
                                            <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                                            <td id='id_mcspeed_0001' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                            <td id='runtime_3' style="font-size: 18px; font-weight: bold;"> - - </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                            <td id='Efficacy_3' style="font-size: 18px; font-weight: bold;"> - - </td>
                                        </tr>
                                    </table>                      
                                </div>
                            </div>
                        </div>                           
                    </div>

                    <div class="col-lg2 col-xs-3">
                        <div id="l1">
                            <div class="small-box mx-2">
                                <div id="id_color_0002" style="background-color: darkgray; width: 220px; height: 130px;">
                                    <center><h4 id='id_mcno_3' style="font-size: 18px; font-weight: bold;">SD-02</h4></center>
                                    <table style="width: 100%;">
                                        <tr>
                                            <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                                            <td id='id_mcspeed_0002' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                            <td id='runtime_4' style="font-size: 18px; font-weight: bold;"> - - </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                            <td id='Efficacy_4' style="font-size: 18px; font-weight: bold;"> - - </td>
                                        </tr>
                                    </table>                      
                                </div>
                            </div>
                        </div>                           
                    </div>

                    <div class="col-lg2 col-xs-3">
                        <div id="l1">
                            <div class="small-box mx-2">
                                <div id="id_color_0003" style="background-color: darkgray; width: 220px; height: 130px;">
                                    <center><h4 id='id_mcno_4' style="font-size: 18px; font-weight: bold;">SD-03</h4></center>
                                    <table style="width: 100%;">
                                        <tr>
                                            <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                                            <td id='id_mcspeed_0003' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                            <td id='runtime_5' style="font-size: 18px; font-weight: bold;"> - - </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                            <td id='Efficacy_5' style="font-size: 18px; font-weight: bold;"> - - </td>
                                        </tr>
                                    </table>                      
                                </div>
                            </div>
                        </div>                           
                    </div>

                    <div class="col-lg2 col-xs-3">
                        <div id="l1">
                            <div class="small-box mx-2">
                                <div id="id_color_0004" style="background-color: darkgray; width: 220px; height: 130px;">
                                    <center><h4 id='id_mcno_5' style="font-size: 18px; font-weight: bold;">SD-04</h4></center>
                                    <table style="width: 100%;">
                                        <tr>
                                            <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                                            <td id='id_mcspeed_0004' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                            <td id='runtime_6' style="font-size: 18px; font-weight: bold;"> - - </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                            <td id='Efficacy_6' style="font-size: 18px; font-weight: bold;"> - - </td>
                                        </tr>
                                    </table>                      
                                </div>
                            </div>
                        </div>                           
                    </div>

                    </div>   
                    <div class="row pt-0">
                        <div class="col-lg2 col-xs-3">
                            <div id="l1">
                                <div class="small-box mx-2">
                                    <div id="id_color_01" style="background-color: darkgray; width: 220px; height: 130px;">
                                        <center><h4 id='id_mcno_01' style="font-size: 18px; font-weight: bold;">SB-02</h4></center>
                                        <table style="width: 100%;">
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                                                <td id='id_mcspeed_01' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                                <td id='runtime_01' style="font-size: 18px; font-weight: bold;"> - - </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                                <td id='Efficacy_01' style="font-size: 18px; font-weight: bold;"> - - </td>
                                            </tr>
                                        </table>                      
                                    </div>
                                </div>
                            </div>                           
                        </div>

                        <div class="col-lg2 col-xs-3">
                            <div id="l1">
                                <div class="small-box mx-2">
                                    <div id="id_color_002" style="background-color: darkgray; width: 220px; height: 130px;">
                                        <center><h4 id='id_mcno_02' style="font-size: 18px; font-weight: bold;">SC-02</h4></center>
                                        <table style="width: 100%;">
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                                                <td id='id_mcspeed_002' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                                <td id='runtime_02' style="font-size: 18px; font-weight: bold;"> - - </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                                <td id='Efficacy_02' style="font-size: 18px; font-weight: bold;"> - - </td>
                                            </tr>
                                        </table>                      
                                    </div>
                                </div>
                            </div>                           
                        </div>

                        <div class="col-lg2 col-xs-3">
                            <div id="l1">
                                <div class="small-box mx-2">
                                    <div id="id_color_0005" style="background-color: darkgray; width: 220px; height: 130px;">
                                        <center><h4 id='id_mcno_03' style="font-size: 18px; font-weight: bold;">SD-05</h4></center>
                                        <table style="width: 100%;">
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                                                <td id='id_mcspeed_0005' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                                <td id='runtime_03' style="font-size: 18px; font-weight: bold;"> - - </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                                <td id='Efficacy_03' style="font-size: 18px; font-weight: bold;"> - - </td>
                                            </tr>
                                        </table>                      
                                    </div>
                                </div>
                            </div>                           
                        </div>

                        <div class="col-lg2 col-xs-3">
                            <div id="l1">
                                <div class="small-box mx-2">
                                    <div id="id_color_0006" style="background-color: darkgray; width: 220px; height: 130px;">
                                        <center><h4 id='id_mcno_04' style="font-size: 18px; font-weight: bold;">SD-06</h4></center>
                                        <table style="width: 100%;">
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                                                <td id='id_mcspeed_0006' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                                <td id='runtime_04' style="font-size: 18px; font-weight: bold;"> - - </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                                <td id='Efficacy_04' style="font-size: 18px; font-weight: bold;"> - - </td>
                                            </tr>
                                        </table>                      
                                    </div>
                                </div>
                            </div>                           
                        </div>

                        <div class="col-lg2 col-xs-3">
                            <div id="l1">
                                <div class="small-box mx-2">
                                    <div id="id_color_0007" style="background-color: darkgray; width: 220px; height: 130px;">
                                        <center><h4 id='id_mcno_05' style="font-size: 18px; font-weight: bold;">SD-07</h4></center>
                                        <table style="width: 100%;">
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                                                <td id='id_mcspeed_0007' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                                <td id='runtime_05' style="font-size: 18px; font-weight: bold;"> - - </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                                <td id='Efficacy_05' style="font-size: 18px; font-weight: bold;"> - - </td>
                                            </tr>
                                        </table>                      
                                    </div>
                                </div>
                            </div>                           
                        </div>

                        <div class="col-lg2 col-xs-3">
                            <div id="l1">
                                <div class="small-box mx-2">
                                    <div id="id_color_0008" style="background-color: darkgray; width: 220px; height: 130px;">
                                        <center><h4 id='id_mcno_06' style="font-size: 18px; font-weight: bold;">SD-08</h4></center>
                                        <table style="width: 100%;">
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                                                <td id='id_mcspeed_0008' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                                <td id='runtime_06' style="font-size: 18px; font-weight: bold;"> - - </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                                <td id='Efficacy_06' style="font-size: 18px; font-weight: bold;"> - - </td>
                                            </tr>
                                        </table>                      
                                    </div>
                                </div>
                            </div>                           
                        </div>
                    </div>

                    <div class="row pt-0">
                        <div class="col-lg2 col-xs-3">
                            <div id="l1">
                                <div class="small-box mx-2">
                                    <div id="id_color_03" style="background-color: darkgray; width: 220px; height: 130px;">
                                        <center><h4 id='id_mcno_03' style="font-size: 18px; font-weight: bold;">SB-03</h4></center>
                                        <table style="width: 100%;">
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                                                <td id='id_mcspeed_03' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                                <td id='runtime_03' style="font-size: 18px; font-weight: bold;"> - - </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                                <td id='Efficacy_03' style="font-size: 18px; font-weight: bold;"> - - </td>
                                            </tr>
                                        </table>                      
                                    </div>
                                </div>
                            </div>                           
                        </div>

                        <div class="col-lg2 col-xs-3">
                            <div id="l1">
                                <div class="small-box mx-2">
                                    <div id="id_color_003" style="background-color: darkgray; width: 220px; height: 130px;">
                                        <center><h4 id='id_mcno_12' style="font-size: 18px; font-weight: bold;">SC-03</h4></center>
                                        <table style="width: 100%;">
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                                                <td id='id_mcspeed_003' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                                <td id='runtime_12' style="font-size: 18px; font-weight: bold;"> - - </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                                <td id='Efficacy_12' style="font-size: 18px; font-weight: bold;"> - - </td>
                                            </tr>
                                        </table>                      
                                    </div>
                                </div>
                            </div>                           
                        </div>

                        <div class="col-lg2 col-xs-3">
                            <div id="l1">
                                <div class="small-box mx-2">
                                    <div id="id_color_0009" style="background-color: darkgray; width: 220px; height: 130px;">
                                        <center><h4 id='id_mcno_13' style="font-size: 18px; font-weight: bold;">SD-09</h4></center>
                                        <table style="width: 100%;">
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                                                <td id='id_mcspeed_0009' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                                <td id='runtime_13' style="font-size: 18px; font-weight: bold;"> - - </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                                <td id='Efficacy_13' style="font-size: 18px; font-weight: bold;"> - - </td>
                                            </tr>
                                        </table>                      
                                    </div>
                                </div>
                            </div>                           
                        </div>

                        <div class="col-lg2 col-xs-3">
                            <div id="l1">
                                <div class="small-box mx-2">
                                    <div id="id_color_0010" style="background-color: darkgray; width: 220px; height: 130px;">
                                        <center><h4 id='id_mcno_14' style="font-size: 18px; font-weight: bold;">SD-10</h4></center>
                                        <table style="width: 100%;">
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                                                <td id='id_mcspeed_0010' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                                <td id='runtime_14' style="font-size: 18px; font-weight: bold;"> - - </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                                <td id='Efficacy_14' style="font-size: 18px; font-weight: bold;"> - - </td>
                                            </tr>
                                        </table>                      
                                    </div>
                                </div>
                            </div>                           
                        </div>

                        <div class="col-lg2 col-xs-3">
                            <div id="l1">
                                <div class="small-box mx-2">
                                    <div id="id_color_0011" style="background-color: darkgray; width: 220px; height: 130px;">
                                        <center><h4 id='id_mcno_15' style="font-size: 18px; font-weight: bold;">SD-11</h4></center>
                                        <table style="width: 100%;">
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                                                <td id='id_mcspeed_0011' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                                <td id='runtime_15' style="font-size: 18px; font-weight: bold;"> - - </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                                <td id='Efficacy_15' style="font-size: 18px; font-weight: bold;"> - - </td>
                                            </tr>
                                        </table>                      
                                    </div>
                                </div>
                            </div>                           
                        </div>

                        <div class="col-lg2 col-xs-3">
                            <div id="l1">
                                <div class="small-box mx-2">
                                    <div id="id_color_0012" style="background-color: darkgray; width: 220px; height: 130px;">
                                        <center><h4 id='id_mcno_16' style="font-size: 18px; font-weight: bold;">SD-12</h4></center>
                                        <table style="width: 100%;">
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                                                <td id='id_mcspeed_0012' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                                <td id='runtime_16' style="font-size: 18px; font-weight: bold;"> - - </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                                                <td id='Efficacy_16' style="font-size: 18px; font-weight: bold;"> - - </td>
                                            </tr>
                                        </table>                      
                                    </div>
                                </div>
                            </div>                           
                        </div>
                    </div>
  
                    <div class="row pt-0">
    <div class="col-lg2 col-xs-3">
        <div id="l1">
            <div class="small-box mx-2">
                <div id="id_color_04" style="background-color: darkgray; width: 220px; height: 130px;">
                    <center><h4 id='id_mcno_17' style="font-size: 18px; font-weight: bold;">SB-04</h4></center>
                    <table style="width: 100%;">
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                            <td id='id_mcspeed_04' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                        </tr>
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                            <td id='runtime_17' style="font-size: 18px; font-weight: bold;"> - - </td>
                        </tr>
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                            <td id='Efficacy_17' style="font-size: 18px; font-weight: bold;"> - - </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>                           
    </div>

    <div class="col-lg2 col-xs-3">
        <div id="l1">
            <div class="small-box mx-2">
                <div id="id_color_004" style="background-color: darkgray; width: 220px; height: 130px;">
                    <center><h4 id='id_mcno_18' style="font-size: 18px; font-weight: bold;">SC-04</h4></center>
                    <table style="width: 100%;">
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                            <td id='id_mcspeed_004' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                        </tr>
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                            <td id='runtime_18' style="font-size: 18px; font-weight: bold;"> - - </td>
                        </tr>
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                            <td id='Efficacy_18' style="font-size: 18px; font-weight: bold;"> - - </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>                           
    </div>

    <div class="col-lg2 col-xs-3">
        <div id="l1">
            <div class="small-box mx-2">
                <div id="id_color_0013" style="background-color: darkgray; width: 220px; height: 130px;">
                    <center><h4 id='id_mcno_20' style="font-size: 18px; font-weight: bold;">SD-13</h4></center>
                    <table style="width: 100%;">
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                            <td id='id_mcspeed_0013' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                        </tr>
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                            <td id='runtime_20' style="font-size: 18px; font-weight: bold;"> - - </td>
                        </tr>
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                            <td id='Efficacy_20' style="font-size: 18px; font-weight: bold;"> - - </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>                           
    </div>

    <div class="col-lg2 col-xs-3">
        <div id="l1">
            <div class="small-box mx-2">
                <div id="id_color_0014" style="background-color: darkgray; width: 220px; height: 130px;">
                    <center><h4 id='id_mcno_21' style="font-size: 18px; font-weight: bold;">SD-14</h4></center>
                    <table style="width: 100%;">
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                            <td id='id_mcspeed_0014' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                        </tr>
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                            <td id='runtime_21' style="font-size: 18px; font-weight: bold;"> - - </td>
                        </tr>
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                            <td id='Efficacy_21' style="font-size: 18px; font-weight: bold;"> - - </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>                           
    </div>

    <div class="col-lg2 col-xs-3">
        <div id="l1">
            <div class="small-box mx-2">
                <div id="id_color_0015" style="background-color: darkgray; width: 220px; height: 130px;">
                    <center><h4 id='id_mcno_22' style="font-size: 18px; font-weight: bold;">SD-15</h4></center>
                    <table style="width: 100%;">
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                            <td id='id_mcspeed_0015' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                        </tr>
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                            <td id='runtime_22' style="font-size: 18px; font-weight: bold;"> - - </td>
                        </tr>
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                            <td id='Efficacy_22' style="font-size: 18px; font-weight: bold;"> - - </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>                           
    </div>

    <div class="col-lg2 col-xs-3">
        <div id="l1">
            <div class="small-box mx-2">
                <div id="id_color_0016" style="background-color: darkgray; width: 220px; height: 130px;">
                    <center><h4 id='id_mcno_23' style="font-size: 18px; font-weight: bold;">SD-16</h4></center>
                    <table style="width: 100%;">
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                            <td id='id_mcspeed_0016' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                        </tr>
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                            <td id='runtime_23' style="font-size: 18px; font-weight: bold;"> - - </td>
                        </tr>
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                            <td id='Efficacy_23' style="font-size: 18px; font-weight: bold;"> - - </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>                           
    </div>
</div>
  
<div class="row pt-0">
    <div class="col-lg2 col-xs-3">
        <div id="l1">
            <div class="small-box mx-2">
                <div id="id_color_05" style="background-color: darkgray; width: 220px; height: 130px;">
                    <center><h4 id='id_mcno_17' style="font-size: 18px; font-weight: bold;">SB-05</h4></center>
                    <table style="width: 100%;">
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                            <td id='id_mcspeed_05' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                        </tr>
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                            <td id='runtime_17' style="font-size: 18px; font-weight: bold;"> - - </td>
                        </tr>
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                            <td id='Efficacy_17' style="font-size: 18px; font-weight: bold;"> - - </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>                           
    </div>

    <div class="col-lg2 col-xs-3">
        <div id="l2">
            <div class="small-box mx-2">
                <div id="id_color_005" style="background-color: darkgray; width: 220px; height: 130px;">
                    <center><h4 id='id_mcno_18' style="font-size: 18px; font-weight: bold;">SC-05</h4></center>
                    <table style="width: 100%;">
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                            <td id='id_mcspeed_005' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                        </tr>
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                            <td id='runtime_18' style="font-size: 18px; font-weight: bold;"> - - </td>
                        </tr>
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                            <td id='Efficacy_18' style="font-size: 18px; font-weight: bold;"> - - </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>                           
    </div>

    <div class="col-lg2 col-xs-3">
        <div id="l2">
            <div class="small-box mx-2">
                <div id="id_color_0017" style="background-color: darkgray; width: 220px; height: 130px;">
                    <center><h4 id='id_mcno_20' style="font-size: 18px; font-weight: bold;">SD-17</h4></center>
                    <table style="width: 100%;">
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                            <td id='id_mcspeed_0017' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                        </tr>
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                            <td id='runtime_20' style="font-size: 18px; font-weight: bold;"> - - </td>
                        </tr>
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                            <td id='Efficacy_20' style="font-size: 18px; font-weight: bold;"> - - </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>                           
    </div>

    <div class="col-lg2 col-xs-3">
        <div id="l2">
            <div class="small-box mx-2">
                <div id="id_color_0018" style="background-color: darkgray; width: 220px; height: 130px;">
                    <center><h4 id='id_mcno_21' style="font-size: 18px; font-weight: bold;">SD-18</h4></center>
                    <table style="width: 100%;">
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                            <td id='id_mcspeed_0018' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                        </tr>
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                            <td id='runtime_21' style="font-size: 18px; font-weight: bold;"> - - </td>
                        </tr>
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                            <td id='Efficacy_21' style="font-size: 18px; font-weight: bold;"> - - </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>                           
    </div>

    <div class="col-lg2 col-xs-3">
        <div id="l2">
            <div class="small-box mx-2">
                <div id="id_color_0019" style="background-color: darkgray; width: 220px; height: 130px;">
                    <center><h4 id='id_mcno_22' style="font-size: 18px; font-weight: bold;">SD-19</h4></center>
                    <table style="width: 100%;">
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                            <td id='id_mcspeed_0019' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                        </tr>
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                            <td id='runtime_22' style="font-size: 18px; font-weight: bold;"> - - </td>
                        </tr>
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                            <td id='Efficacy_22' style="font-size: 18px; font-weight: bold;"> - - </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>                           
    </div>

    <div class="col-lg2 col-xs-3">
        <div id="l2">
            <div class="small-box mx-2">
                <div id="id_color_0020" style="background-color: darkgray; width: 220px; height: 130px;">
                    <center><h4 id='id_mcno_23' style="font-size: 18px; font-weight: bold;">SD-20</h4></center>
                    <table style="width: 100%;">
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Current speed :</td>
                            <td id='id_mcspeed_0020' style="font-size: 18px; font-weight: bold;">0 rpm</td>
                        </tr>
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Run time &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                            <td id='runtime_23' style="font-size: 18px; font-weight: bold;"> - - </td>
                        </tr>
                        <tr>
                            <td style="font-size: 18px; font-weight: bold;">Efficacy &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</td>
                            <td id='Efficacy_23' style="font-size: 18px; font-weight: bold;"> - - </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>                           
    </div>
</div>

                    
                </div><!-- /.container-fluid -->
                <!-- Include Footer -->
                <?php
                    include '../../headers/footer-bar.php'
                ?> 
            </section>
        </div>    
    </div>    
 
<!-- Navbar -->
<?php
  // include './model-pages/mod_BreakDown.php';        
?>    
<!-- Page specific script -->
<script>
    
    var i;
    var dtbl1;
    var strReceiptNo = "0";
    $(function () 
    {
        
        //Initialize Select2 Elements
        $('.select2').select2();
        //Initialize Select2 Elements
        $('.select2bs4').select2({
          theme: 'bootstrap4'
        });  
         //alert("Hooi");
        //------------ DataTable Initialize -------------------
        $("#example1").DataTable({
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": false, 
           
            "scrollX": true,
            "scrollY": 160,
            "info": false, 
            "rowCallback" : funCellCreated,
            "dom": "lrti"
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        //$("#example1").DataTable({
        //    "responsive": true, "lengthChange": false, "autoWidth": false,
        //    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        //}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        dtbl1 = $('#example1').DataTable();        
        //--- Load Tables --------------------------------------
        funRefreshClicked();
        
    }); 
    $('#myCustomSearchBox').keyup(function() 
    {
        dtbl1.search($(this).val()).draw(); // this  is for customized searchbox with datatable search feature.
    });
    $('[data-widget="pushmenu"]').PushMenu("collapse");
    
    function funCellCreated(row, data, index) 
    {        
        //alert(index);
        $(row).find('td:eq(4)').css('background-color', data[4]);
        $(row).find('td:eq(5)').css('background-color', data[5]);
        $(row).find('td:eq(6)').css('background-color', data[6]);        
        //if(data[3]> 420)    $(row).find('td:eq(3)').css('background-color', data[4]);       
    }

    $('#example1 tbody').on('click', 'tr', function () 
    {
        const table2 = new DataTable('#example1');
        table2.on('click', 'tbody tr', (e) => 
        {
            let classList = e.currentTarget.classList;
            if (classList.contains('selected')) 
            {
                //classList.remove('selected');
            }
            else 
            {
                table2.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
                classList.add('selected');
                funModelBreakDownClicked();
            }
        });        
    });

    //$('#button').click(function () 
    //{
    //    var table = $('#example1').DataTable();
    //    alert(table.rows('.selected').data().length + ' row(s) selected');
    //});
    // Update the count down every 1 second
    var x = setInterval(function() 
    {
        //alert("Timer running..");
        //-------------- Show Time -------------------------------------------------
        var today = new Date();
        var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        //document.getElementById("id_datetime").innerHTML = date+' '+time;
        //--------------- Update Data ----------------------------------------------
        funRefreshClicked(); 
             
    }, 2000); 

//-------------------- Model : Edit Update Clicked -------------------------
function funClickedModCutUpdate() 
    {
        //alert("Cutting Update Clicked");   
        const DataAry = []; 
                        
        DataAry[0] = document.getElementById("id_mod_wcno").value;  
        DataAry[1] = document.getElementById("id_mod_wcname").value;
        DataAry[2] = document.getElementById("id_mod_lowervalue").value;
        DataAry[3] = document.getElementById("id_mod_uppervalue").value;
        DataAry[4] = document.getElementById("id_mod_lowercolor").value;
        DataAry[5] = document.getElementById("id_mod_middlecolor").value;
        DataAry[6] = document.getElementById("id_mod_uppercolor").value;
        
        //alert(DataAry); 
        //var vblSendPara =  "1234"; 
        $.post('class/updateData_CutSetting.php', { userpara: DataAry }, function(json_data2) 
        {
            //alert(json_data2);           
            var res = $.parseJSON(json_data2);
            //alert(res);
            //alert(res[0]); 
            //alert(res[1]);            
            //var AryCustomOrder = new Array();
            //AryCustomOrder = res.CustomOrderAry;
            //document.getElementById("id_status").value = res[1];
        }); 
        //alert("Data Updated successfully.");
               
        var varmodbox = document.getElementById("id_mod_prodedit");
        varmodbox.style.display = "none";        
        
    }

    //-------------------- Read Data to Load Table ----------------------
    function funRefreshClicked() 
    {
        //alert("Refresh page");
        //var myJavaScriptVariable = "<?php echo isset($_SESSION['user_name2']) ? $_SESSION['user_name2'] : 'Modaya'; ?>";
        //alert(myJavaScriptVariable);

        var vblSendPara =  "1234"; 
        $.post('getData_McDashboard.php', { userpara: vblSendPara }, function(json_data2) 
        {
            //  alert(json_data2);           
            var res = $.parseJSON(json_data2);
            //alert(res); 
            var multiply=60;
    
            var MachineIDAry        = new Array();
            var MachineNumberAry    = new Array();
            var Sen1SpeedAry        = new Array();
            var Sen2SpeedAry   = new Array();
            var Sen3SpeedAry  = new Array();
            var Sen4SpeedAry     = new Array();
           
            MachineIDAry        = res.MachineID_Ary;          
            MachineNumberAry    = res.MachineNumber_Ary;  
            Sen1SpeedAry        = res.Sen1Speed_Ary;
            Sen2SpeedAry        = res.Sen2Speed_Ary;
            Sen3SpeedAry        = res.Sen3Speed_Ary;
            Sen4SpeedAry        = res.Sen4Speed_Ary;
            
            var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            var strSpeed1 = intSpeed1 + " rpm";
            document.getElementById("id_mcspeed_0").innerHTML = strSpeed1;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed1 > 1500)
            {
                document.getElementById("id_color_0").style.backgroundColor =  "yellow";
            }
            else if(intSpeed1 > 0)
            {
                document.getElementById("id_color_0").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_0").style.backgroundColor =  "#ff6347";
            }



            var intSpeed2 = parseInt(Sen1SpeedAry[1]) * multiply;
            var strSpeed2 = intSpeed2 + " rpm";
            document.getElementById("id_mcspeed_01").innerHTML = strSpeed2;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed2 > 1500)
            {
                document.getElementById("id_color_01").style.backgroundColor =  "yellow";
            }
            else if(intSpeed2 > 0)
            {
                document.getElementById("id_color_01").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_01").style.backgroundColor =  "#ff6347";
            }  
            
            
            var intSpeed3 = parseInt(Sen1SpeedAry[2]) * multiply;
            var strSpeed3 = intSpeed3 + " rpm";
            document.getElementById("id_mcspeed_03").innerHTML = strSpeed3;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed3 > 1500)
            {
                document.getElementById("id_color_03").style.backgroundColor =  "yellow";
            }
            else if(intSpeed3 > 0)
            {
                document.getElementById("id_color_03").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_03").style.backgroundColor =  "#ff6347";
            }     
            
            
            var intSpeed4 = parseInt(Sen1SpeedAry[3]) * multiply;
            var strSpeed4 = intSpeed4 + " rpm";
            document.getElementById("id_mcspeed_04").innerHTML = strSpeed4;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed4 > 1500)
            {
                document.getElementById("id_color_04").style.backgroundColor =  "yellow";
            }
            else if(intSpeed4 > 0)
            {
                document.getElementById("id_color_04").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_04").style.backgroundColor =  "#ff6347";
            }       


            var intSpeed5 = parseInt(Sen1SpeedAry[4]) * multiply;
            var strSpeed5 = intSpeed5 + " rpm";
            document.getElementById("id_mcspeed_05").innerHTML = strSpeed5;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed5 > 1500)
            {
                document.getElementById("id_color_05").style.backgroundColor =  "yellow";
            }
            else if(intSpeed5 > 0)
            {
                document.getElementById("id_color_05").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_05").style.backgroundColor =  "#ff6347";
            }       


            var intSpeed001 = parseInt(Sen1SpeedAry[5]) * multiply;
            var strSpeed001 = intSpeed001 + " rpm";
            document.getElementById("id_mcspeed_001").innerHTML = strSpeed001;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed001 > 1500)
            {
                document.getElementById("id_color_001").style.backgroundColor =  "yellow";
            }
            else if(intSpeed001 > 0)
            {
                document.getElementById("id_color_001").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_001").style.backgroundColor =  "#ff6347";
            }       

            var intSpeed002 = parseInt(Sen1SpeedAry[6]) * multiply;
            var strSpeed002 = intSpeed002 + " rpm";
            document.getElementById("id_mcspeed_002").innerHTML = strSpeed002;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed002 > 1500)
            {
                document.getElementById("id_color_002").style.backgroundColor =  "yellow";
            }
            else if(intSpeed002 > 0)
            {
                document.getElementById("id_color_002").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_002").style.backgroundColor =  "#ff6347";
            }       


            var intSpeed003 = parseInt(Sen1SpeedAry[7]) * multiply;
            var strSpeed003 = intSpeed003 + " rpm";
            document.getElementById("id_mcspeed_003").innerHTML = strSpeed003;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed003 > 1500)
            {
                document.getElementById("id_color_003").style.backgroundColor =  "yellow";
            }
            else if(intSpeed003 > 0)
            {
                document.getElementById("id_color_003").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_003").style.backgroundColor =  "#ff6347";
            }       

            var intSpeed004 = parseInt(Sen1SpeedAry[8]) * multiply;
            var strSpeed004 = intSpeed004 + " rpm";
            document.getElementById("id_mcspeed_004").innerHTML = strSpeed004;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed004 > 1500)
            {
                document.getElementById("id_color_004").style.backgroundColor =  "yellow";
            }
            else if(intSpeed004 > 0)
            {
                document.getElementById("id_color_004").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_004").style.backgroundColor =  "#ff6347";
            }   

            var intSpeed005 = parseInt(Sen1SpeedAry[9]) * multiply;
            var strSpeed005 = intSpeed005 + " rpm";
            document.getElementById("id_mcspeed_005").innerHTML = strSpeed005;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed005 > 1500)
            {
                document.getElementById("id_color_005").style.backgroundColor =  "yellow";
            }
            else if(intSpeed005 > 0)
            {
                document.getElementById("id_color_005").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_005").style.backgroundColor =  "#ff6347";
            }   
            
            var intSpeed0001 = parseInt(Sen1SpeedAry[10]) * multiply;
            var strSpeed0001 = intSpeed0001 + " rpm";
            document.getElementById("id_mcspeed_0001").innerHTML = strSpeed0001;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed0001 > 1500)
            {
                document.getElementById("id_color_0001").style.backgroundColor =  "yellow";
            }
            else if(intSpeed0001 > 0)
            {
                document.getElementById("id_color_0001").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_0001").style.backgroundColor =  "#ff6347";
            }   


            var intSpeed0002 = parseInt(Sen1SpeedAry[11]) * multiply;
            var strSpeed0002 = intSpeed0002 + " rpm";
            document.getElementById("id_mcspeed_0002").innerHTML = strSpeed0002;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed0002 > 1500)
            {
                document.getElementById("id_color_0002").style.backgroundColor =  "yellow";
            }
            else if(intSpeed0002 > 0)
            {
                document.getElementById("id_color_0002").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_0002").style.backgroundColor =  "#ff6347";
            }   


            var intSpeed0003 = parseInt(Sen1SpeedAry[12]) * multiply;
            var strSpeed0003 = intSpeed0003 + " rpm";
            document.getElementById("id_mcspeed_0003").innerHTML = strSpeed0003;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed0003 > 1500)
            {
                document.getElementById("id_color_0003").style.backgroundColor =  "yellow";
            }
            else if(intSpeed0003 > 0)
            {
                document.getElementById("id_color_0003").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_0003").style.backgroundColor =  "#ff6347";
            }   

            
            var intSpeed0004 = parseInt(Sen1SpeedAry[13]) * multiply;
            var strSpeed0004 = intSpeed0004 + " rpm";
            document.getElementById("id_mcspeed_0004").innerHTML = strSpeed0004;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed0004 > 1500)
            {
                document.getElementById("id_color_0004").style.backgroundColor =  "yellow";
            }
            else if(intSpeed0004 > 0)
            {
                document.getElementById("id_color_0004").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_0004").style.backgroundColor =  "#ff6347";
            }   

            var intSpeed0005 = parseInt(Sen1SpeedAry[14]) * multiply;
            var strSpeed0005 = intSpeed0005 + " rpm";
            document.getElementById("id_mcspeed_0005").innerHTML = strSpeed0005;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed0005 > 1500)
            {
                document.getElementById("id_color_0005").style.backgroundColor =  "yellow";
            }
            else if(intSpeed0005 > 0)
            {
                document.getElementById("id_color_0005").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_0005").style.backgroundColor =  "#ff6347";
            }   

            var intSpeed0006 = parseInt(Sen1SpeedAry[15]) * multiply;
            var strSpeed0006 = intSpeed0006 + " rpm";
            document.getElementById("id_mcspeed_0006").innerHTML = strSpeed0006;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed0006 > 1500)
            {
                document.getElementById("id_color_0006").style.backgroundColor =  "yellow";
            }
            else if(intSpeed0006 > 0)
            {
                document.getElementById("id_color_0006").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_0006").style.backgroundColor =  "#ff6347";
            }   


            var intSpeed0007 = parseInt(Sen1SpeedAry[16]) * multiply;
            var strSpeed0007 = intSpeed0007 + " rpm";
            document.getElementById("id_mcspeed_0007").innerHTML = strSpeed0007;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed0007 > 1500)
            {
                document.getElementById("id_color_0007").style.backgroundColor =  "yellow";
            }
            else if(intSpeed0007 > 0)
            {
                document.getElementById("id_color_0007").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_0007").style.backgroundColor =  "#ff6347";
            }  


            var intSpeed0008 = parseInt(Sen1SpeedAry[17]) * multiply;
            var strSpeed0008 = intSpeed0008 + " rpm";
            document.getElementById("id_mcspeed_0008").innerHTML = strSpeed0008;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed0008 > 1500)
            {
                document.getElementById("id_color_0008").style.backgroundColor =  "yellow";
            }
            else if(intSpeed0008 > 0)
            {
                document.getElementById("id_color_0008").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_0008").style.backgroundColor =  "#ff6347";
            }  

            var intSpeed0009 = parseInt(Sen1SpeedAry[18]) * multiply;
            var strSpeed0009 = intSpeed0009 + " rpm";
            document.getElementById("id_mcspeed_0009").innerHTML = strSpeed0009;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed0009 > 1500)
            {
                document.getElementById("id_color_0009").style.backgroundColor =  "yellow";
            }
            else if(intSpeed0009 > 0)
            {
                document.getElementById("id_color_0009").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_0009").style.backgroundColor =  "#ff6347";
            }  


            var intSpeed0010 = parseInt(Sen1SpeedAry[19]) * multiply;
            var strSpeed0010 = intSpeed0010 + " rpm";
            document.getElementById("id_mcspeed_0010").innerHTML = strSpeed0010;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed0010 > 1500)
            {
                document.getElementById("id_color_0010").style.backgroundColor =  "yellow";
            }
            else if(intSpeed0010 > 0)
            {
                document.getElementById("id_color_0010").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_0010").style.backgroundColor =  "#ff6347";
            } 
               
            var intSpeed0011 = parseInt(Sen1SpeedAry[20]) * multiply;
            var strSpeed0011 = intSpeed0011 + " rpm";
            document.getElementById("id_mcspeed_0011").innerHTML = strSpeed0011;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed0011 > 1500)
            {
                document.getElementById("id_color_0011").style.backgroundColor =  "yellow";
            }
            else if(intSpeed0011 > 0)
            {
                document.getElementById("id_color_0011").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_0011").style.backgroundColor =  "#ff6347";
            } 

            var intSpeed0012 = parseInt(Sen1SpeedAry[21]) * multiply;
            var strSpeed0012 = intSpeed0012 + " rpm";
            document.getElementById("id_mcspeed_0012").innerHTML = strSpeed0012;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed0012 > 1500)
            {
                document.getElementById("id_color_0012").style.backgroundColor =  "yellow";
            }
            else if(intSpeed0012 > 0)
            {
                document.getElementById("id_color_0012").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_0012").style.backgroundColor =  "#ff6347";
            } 

            var intSpeed0013 = parseInt(Sen1SpeedAry[22]) * multiply;
            var strSpeed0013 = intSpeed0013 + " rpm";
            document.getElementById("id_mcspeed_0013").innerHTML = strSpeed0013;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed0013 > 1500)
            {
                document.getElementById("id_color_0013").style.backgroundColor =  "yellow";
            }
            else if(intSpeed0013 > 0)
            {
                document.getElementById("id_color_0013").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_0013").style.backgroundColor =  "#ff6347";
            } 

            var intSpeed0014 = parseInt(Sen1SpeedAry[23]) * multiply;
            var strSpeed0014 = intSpeed0014 + " rpm";
            document.getElementById("id_mcspeed_0014").innerHTML = strSpeed0014;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed0014 > 1500)
            {
                document.getElementById("id_color_0014").style.backgroundColor =  "yellow";
            }
            else if(intSpeed0014 > 0)
            {
                document.getElementById("id_color_0014").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_0014").style.backgroundColor =  "#ff6347";
            } 

            var intSpeed0015 = parseInt(Sen1SpeedAry[24]) * multiply;
            var strSpeed0015 = intSpeed0015 + " rpm";
            document.getElementById("id_mcspeed_0015").innerHTML = strSpeed0015;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed0015 > 1500)
            {
                document.getElementById("id_color_0015").style.backgroundColor =  "yellow";
            }
            else if(intSpeed0015 > 0)
            {
                document.getElementById("id_color_0015").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_0015").style.backgroundColor =  "#ff6347";
            } 


            var intSpeed0016 = parseInt(Sen1SpeedAry[25]) * multiply;
            var strSpeed0016 = intSpeed0016 + " rpm";
            document.getElementById("id_mcspeed_0016").innerHTML = strSpeed0016;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed0016 > 1500)
            {
                document.getElementById("id_color_0016").style.backgroundColor =  "yellow";
            }
            else if(intSpeed0016 > 0)
            {
                document.getElementById("id_color_0016").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_0016").style.backgroundColor =  "#ff6347";
            } 

            var intSpeed0017 = parseInt(Sen1SpeedAry[26]) * multiply;
            var strSpeed0017 = intSpeed0017 + " rpm";
            document.getElementById("id_mcspeed_0017").innerHTML = strSpeed0017;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed0017 > 1500)
            {
                document.getElementById("id_color_0017").style.backgroundColor =  "yellow";
            }
            else if(intSpeed0017 > 0)
            {
                document.getElementById("id_color_0017").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_0017").style.backgroundColor =  "#ff6347";
            } 

            var intSpeed0018 = parseInt(Sen1SpeedAry[27]) * multiply;
            var strSpeed0018 = intSpeed0018 + " rpm";
            document.getElementById("id_mcspeed_0018").innerHTML = strSpeed0018;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed0018 > 1500)
            {
                document.getElementById("id_color_0018").style.backgroundColor =  "yellow";
            }
            else if(intSpeed0018 > 0)
            {
                document.getElementById("id_color_0018").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_0018").style.backgroundColor =  "#ff6347";
            } 

            var intSpeed0019 = parseInt(Sen1SpeedAry[28]) * multiply;
            var strSpeed0019 = intSpeed0019 + " rpm";
            document.getElementById("id_mcspeed_0019").innerHTML = strSpeed0019;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed0019 > 1500)
            {
                document.getElementById("id_color_0019").style.backgroundColor =  "yellow";
            }
            else if(intSpeed0019 > 0)
            {
                document.getElementById("id_color_0019").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_0019").style.backgroundColor =  "#ff6347";
            } 

            var intSpeed0020 = parseInt(Sen1SpeedAry[29]) * multiply;
            var strSpeed0020 = intSpeed0020 + " rpm";
            document.getElementById("id_mcspeed_0020").innerHTML = strSpeed0020;
            //document.getElementById("id_mcspeed_0").innerHTML = Sen1SpeedAry[0];
            //var intSpeed1 = parseInt(Sen1SpeedAry[0]) * multiply;
            if(intSpeed0020 > 1500)
            {
                document.getElementById("id_color_0020").style.backgroundColor =  "yellow";
            }
            else if(intSpeed0020 > 0)
            {
                document.getElementById("id_color_0020").style.backgroundColor =  "yellow";
            }
            else
            {
                document.getElementById("id_color_0020").style.backgroundColor =  "#ff6347";
            } 
            //document.getElementById("id_color_0").style.backgroundColor =  "#00FF00";            
        });
        
    }   

   
    
    
</script>
</body>
</html>
