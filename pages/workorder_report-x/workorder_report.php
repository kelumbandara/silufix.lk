<?php
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION["user_name"]))
    {
        // If not logged in, redirect to the login page
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
                    <!-- /.card-header -->                    
                    <div class="card card-default" >
                        <div class="card-header">
                            <h3 class="card-title">Work Order Reports</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>                                
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <!-- /.col -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Date Start:</label>
                                        <div>
                                            <input type="date" id="id_sdate" name="startDate" value="22-07-2018" />
                                        </div>
                                    </div> 
                                </div>
                                <!-- /.col -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Date End:</label>
                                        <div>                                        
                                           <input type="date" id="id_edate" name="startDate" value="22-07-2018" />     
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-2">
                                    <div class="form-group">  
                                        <label style="font-size: 1px;">.</label>
                                        <div class="input-group date" data-target-input="nearest">
                                            <button type="button" class="btn btn-primary" onclick="funViewReport()" id="id_ViewReport" name="viewbutton">View Report</button>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                    <!-- /.card -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <!-- /.card --> 
                                    <div class="card card-danger">                            
                                        <div class="card-header">
                                            <h3 class="card-title"><b>1. Work Order Details</b></h3>                                    
                                        </div>
                                        <div class="card-body" style="overflow-x: auto;">
                                            <table id="id_table2" class="table table-bordered table-striped" style="font-size: 10px;">
                                                <thead> 
                                                    <tr>
                                                        <th>#</th>
                                                        <th>WorkOrderNo</th>
                                                        <th>WorkOrderCategory</th>
                                                        <th>WorkOrderSubCategory</th>
                                                        <th>WoDepartment</th>
                                                        
                                                        <th>CreatedDateTime</th>
                                                        <th>CreatedUser</th>
                                                        <th>McCategory</th>
                                                        <th>MachineNo</th>
                                                        
                                                        <th>RespondDateTime</th>
                                                        <th>ClosedDateTime</th>
                                                        <th>ClosedFaultType</th>
                                                        <th>ClosedFaultLevel1</th>
                                                        
                                                        <th>ClosedFaultLevel2</th>
                                                        <th>ClosedFaultLevel3</th>
                                                        <th>ClosedFaultLevel4</th>
                                                        <th>VerifiedDateTime</th>
                                                        
                                                        <th>VerifiedUser</th>
                                                        <th>ReOpenedDateTime</th>
                                                        <th>ReOpenedUser</th>
                                                                                                      
                                                        <th>WoStatus</th>
                                                        <th>WoReOpen</th>
                                                    </tr>
                                                </thead>
                                                <tbody>                                            
                                                </tbody>                                        
                                                <tfoot>  
                                                    <tr><th>-</th><th>TOTAL</th><th></th><th></th></tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->
                    </section>
                    
                </div><!-- /.container-fluid -->
                <!-- Include Footer -->
                <?php
                     include '../../headers/footer-bar.php'
                ?> 
            </section>
        </div>    
    </div>    
 
<script>
     //--------------- Admin Panel Minimize ----------------------
    $('[data-widget="pushmenu"]').PushMenu("collapse");
    
    $(function () 
    {
        document.getElementById('id_sdate').valueAsDate = new Date();
        document.getElementById('id_edate').valueAsDate = new Date(Date.now() + ( 3600 * 1000 * 24)); 
        //$("#example2").DataTable({
        //    "responsive": true, "lengthChange": false, "autoWidth": false,
        //    "buttons": ["copy", "csv", "excel", "pdf", "print"]
        //}).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
        
        $('#id_table1').DataTable({
            dom: 'Bfrtip',
            buttons: [{ extend: 'copyHtml5', footer: true },{ extend: 'excelHtml5', footer: true },{ extend: 'csvHtml5', footer: true },{ extend: 'pdfHtml5', footer: true },{ extend: 'print', footer: true }]
        });
        $('#id_table2').DataTable({
            dom: 'Bfrtip',
            buttons: [{ extend: 'copyHtml5', footer: true },{ extend: 'excelHtml5', footer: true },{ extend: 'csvHtml5', footer: true },{ extend: 'pdfHtml5', footer: true },{ extend: 'print', footer: true }]
        });

        funViewReport();
    });
    //--------------- Print Report function ------------------------------------------
    function funPrintReport() 
    {                
        window.print();		
    }
    //-------------------- ViewReport Function --------------------------------------------
    function funViewReport() 
    {
        let intDebugEnable = 0;        
        if(intDebugEnable === 1)    alert("funViewReport");
            
        var intRowCount = 0;
        var intRowSum  =  0;

        const DataAry = []; 
        
        //----------------------- Work Order All Detail Repoert ------------------------------------------
        DataAry[0] = "funGet_WoAllDetails";        // Function Name    
        DataAry[1] = document.getElementById("id_sdate").value;
        DataAry[2] = document.getElementById("id_edate").value;
        if(intDebugEnable === 1)    alert("DataAry :" + DataAry);
        $.post('getData_WoReport_Basic.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1)    alert("json_data2 :" + json_data2);  
            var res = $.parseJSON(json_data2);  
            
            //------------------------------------------------------------
            //- Table 2 - Line Wise Downtime Summary 
            //------------------------------------------------------------ 
            //var intLinewiseTotalDT = 0;           
            var dtbl2 = $('#id_table2').DataTable();
            dtbl2.clear().draw();
            //---------- Insert Table Header -------------------------            
            //$(dtbl2.column(2).header()).html("Downtime (Min)");
            //$(dtbl2.column(3).header()).html("Occurrence");                     
            //---------- Insert Table Body -------------------------
            intRowCount = res.Data_Ary.length;
            for(i=0;i<intRowCount;i++)
            {
                //intLinewiseTotalDT = res.LineWiseDowntimeCategory1_Ary[i]+res.LineWiseDowntimeCategory2_Ary[i]+res.LineWiseDowntimeCategory3_Ary[i]+res.LineWiseDowntimeCategory4_Ary[i]+res.LineWiseDowntimeCategory5_Ary[i]+res.LineWiseDowntimeCategory6_Ary[i];
                intTmp = i + 1;
                dtbl2.row.add([intTmp.toString(), res.Data_Ary[i][0], res.Data_Ary[i][1], res.Data_Ary[i][2], res.Data_Ary[i][3] , res.Data_Ary[i][4], res.Data_Ary[i][5], res.Data_Ary[i][6], res.Data_Ary[i][7], res.Data_Ary[i][8], res.Data_Ary[i][9], res.Data_Ary[i][10], res.Data_Ary[i][11], res.Data_Ary[i][12], res.Data_Ary[i][13], res.Data_Ary[i][14], res.Data_Ary[i][15], res.Data_Ary[i][16], res.Data_Ary[i][17], res.Data_Ary[i][18], res.Data_Ary[i][19], res.Data_Ary[i][20]]).draw(false);
            }             
            
            //------------------ END --------------------------------------------------------------------- 
        });
        
        
        /*
        //----------------------- Work Order Summary ------------------------------------------
        DataAry[0] = "funGet_WoCountSummary";        // Function Name    
        DataAry[1] = document.getElementById("id_sdate").value;
        DataAry[2] = document.getElementById("id_edate").value;
        if(intDebugEnable === 1)    alert("DataAry :" + DataAry);
        $.post('getData_WoReport_Basic.php', { userpara: DataAry }, function(json_data2) 
        {
            if(intDebugEnable === 1)    alert("json_data2 :" + json_data2);  
            var res = $.parseJSON(json_data2);               
            //------------------------------------------------------------
            //- Table 1 - Department Wise Total Downtime 
            //------------------------------------------------------------ 
            var dtbl1 = $('#id_table1').DataTable();
            dtbl1.clear().draw();
            //---------- Insert Table Header -------------------------            
            $(dtbl1.column(2).header()).html("New");
            $(dtbl1.column(3).header()).html("Inprogress");
            $(dtbl1.column(4).header()).html("Closed");
            $(dtbl1.column(5).header()).html("TOTAL");
            //---------- Insert Table Body -------------------------
            intRowCount = res.Data_Ary.length;
            for(i=0;i<intRowCount;i++)
            {
                intTmp = i + 1;    
                intRowSum = parseFloat(res.Data_Ary[i][1]) + parseFloat(res.Data_Ary[i][2]) + parseFloat(res.Data_Ary[i][3]);
                dtbl1.row.add([intTmp.toString(), res.Data_Ary[i][0], res.Data_Ary[i][1], res.Data_Ary[i][2], res.Data_Ary[i][3], intRowSum]).draw(false);
            } 
            //---------- Insert Table Footer -------------------------        
            $(dtbl1.column(2).footer()).html(dtbl1.column(2).data().reduce( function (a,b){return parseFloat(a)+parseFloat(b);}));
            $(dtbl1.column(3).footer()).html(dtbl1.column(3).data().reduce( function (a,b){return parseFloat(a)+parseFloat(b);}));
            $(dtbl1.column(4).footer()).html(dtbl1.column(4).data().reduce( function (a,b){return parseFloat(a)+parseFloat(b);}));
            $(dtbl1.column(5).footer()).html(dtbl1.column(5).data().reduce( function (a,b){return parseFloat(a)+parseFloat(b);}));
            //------------------ END --------------------------------------------------------------------- 
        });	
        */
        
        
    }
</script>
</body>
</html>
