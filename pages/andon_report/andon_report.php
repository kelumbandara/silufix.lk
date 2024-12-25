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
                            <h3 class="card-title">Downtime Reports</h3>
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
                                        <label>Shift</label>
                                        <div>
                                            <select name="Shift" id="id_shift" style="width: 100px; height: 30px">
                                                <option value="All">All</option>
                                                <option value="Shift-A">Shift-A</option>
                                                <option value="Shift-B">Shift-B</option>						   
                                            </select> 
                                        </div>                               
                                    </div>
                                </div> 
                                <div class="col-md-2">
                                    <div class="form-group">                                
                                        <div class="input-group date" data-target-input="nearest">
                                            <button type="button" class="btn btn-primary" onclick="funViewReport()" id="id_ViewReport" name="viewbutton">View Report<i class="fa fa-file-video"></i></button>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                    <div class="form-group">                                
                                        <div class="input-group date" data-target-input="nearest">
                                            <button type="button" class="btn btn-primary" onclick="funPrintReport()" id="id_PrintReport" name="printbutton">Print Report  <i class="fa fa-file-pdf"></i></button>
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
                                    <div class="card card-danger">  
                                        <div class="card-header">
                                            <h3 class="card-title"><b>Fault Type wise Downtime and Ocurance</b></h3>                                    
                                        </div>                                
                                        <!-- /.card-header -->
                                        <div class="card-body" id="id_class1">
                                            <table id="id_table1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr><th>#</th><th>Fault Type</th><th></th><th></th></tr>
                                                </thead>
                                                <tbody>                                          
                                                </tbody>
                                                <tfoot>
                                                    <tr><th>-</th><th>TOTAL </th><th></th><th></th></tr>
                                                </tfoot>
                                            </table>	
                                        </div>
                                    </div>
                                    <!-- /.card --> 
                                    <div class="card card-danger">                            
                                        <div class="card-header">
                                            <h3 class="card-title"><b>Machine Category Wise Downtime and Occurance</b></h3>                                    
                                        </div>
                                        <div class="card-body">
                                            <table id="id_table2" class="table table-bordered table-striped">
                                                <thead> 
                                                    <tr><th>#</th><th>Machine Category</th><th></th><th></th></tr>
                                                </thead>
                                                <tbody>                                            
                                                </tbody>                                        
                                                <tfoot>  
                                                    <tr><th>-</th><th>TOTAL</th><th></th><th></th></tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.card --> 
                                    <div class="card card-danger">                            
                                        <div class="card-header">
                                            <h3 class="card-title">Date Wise Downtime, Occurrence </h3>                                    
                                        </div>
                                        <div class="card-body">
                                            <table id="id_table3" class="table table-bordered table-striped">
                                                <thead> 
                                                    <tr><th>#</th><th>Date</th><th></th><th></th><th></th></tr>
                                                </thead>
                                                <tbody>                                            
                                                </tbody>                                        
                                                <tfoot>  
                                                    <tr><th>-</th><th>TOTAL</th><th></th><th></th><th></th></tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- /.card -->
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
 
<!-- Page specific script -->
<script>
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
        $('#id_table3').DataTable({
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
        //alert("View button Clicked");     
        var intRowCount = 0;
        var vbl_sdate = document.getElementById("id_sdate");
        var vbl_edate = document.getElementById("id_edate");		
        var vbl_shift = document.getElementById("id_shift");

        var vblSendPara =  [vbl_sdate.value, vbl_edate.value, vbl_shift.value];  
        $.post('getData_AndonReport.php', { userpara: vblSendPara }, function(json_data2) 
        {
            //alert(json_data2);  

            var res = $.parseJSON(json_data2);               
            //------------------------------------------------------------
            //- Table 1 - Department Wise Total Downtime 
            //------------------------------------------------------------ 
            var dtbl1 = $('#id_table1').DataTable();
            dtbl1.clear().draw();
            //---------- Insert Table Header -------------------------            
            $(dtbl1.column(2).header()).html("Downtime (Min)");
            $(dtbl1.column(3).header()).html("Occurrence");
            //---------- Insert Table Body -------------------------
            intRowCount = res.FaultType_DtName_Ary.length;
            for(i=0;i<intRowCount;i++)
            {
                intTmp = i + 1;      
                dtbl1.row.add([intTmp.toString(), res.FaultType_DtName_Ary[i], res.FaultType_Dt_Ary[i], res.FaultType_Occ_Ary[i]]).draw(false);
            } 
            //---------- Insert Table Footer -------------------------        
            $(dtbl1.column(2).footer()).html(dtbl1.column(2).data().reduce( function (a,b){return parseFloat(a)+parseFloat(b);}));
            $(dtbl1.column(3).footer()).html(dtbl1.column(3).data().reduce( function (a,b){return parseFloat(a)+parseFloat(b);}));
                        
            //------------------------------------------------------------
            //- Table 2 - Line Wise Downtime Summary 
            //------------------------------------------------------------ 
            //var intLinewiseTotalDT = 0;           
            var dtbl2 = $('#id_table2').DataTable();
            dtbl2.clear().draw();
            //---------- Insert Table Header -------------------------            
            $(dtbl2.column(2).header()).html("Downtime (Min)");
            $(dtbl2.column(3).header()).html("Occurrence");                     
            //---------- Insert Table Body -------------------------
            intRowCount = res.McCategory_DtName_Ary.length;
            for(i=0;i<intRowCount;i++)
            {
                //intLinewiseTotalDT = res.LineWiseDowntimeCategory1_Ary[i]+res.LineWiseDowntimeCategory2_Ary[i]+res.LineWiseDowntimeCategory3_Ary[i]+res.LineWiseDowntimeCategory4_Ary[i]+res.LineWiseDowntimeCategory5_Ary[i]+res.LineWiseDowntimeCategory6_Ary[i];
                intTmp = i + 1;
                dtbl2.row.add([intTmp.toString(), res.McCategory_DtName_Ary[i], res.McCategory_Dt_Ary[i], res.McCategory_Occ_Ary[i]]).draw(false);
            }              
            //---------- Insert Table Footer -------------------------        
            $(dtbl2.column(2).footer()).html(dtbl2.column(2).data().reduce( function (a,b){return parseFloat(a)+parseFloat(b);}));
            $(dtbl2.column(3).footer()).html(dtbl2.column(3).data().reduce( function (a,b){return parseFloat(a)+parseFloat(b);}));
           
            //------------------------------------------------------------
            //- Table 3 - Date Wise Downtime,Occurance Summary 
            //------------------------------------------------------------ 
            //var intLinewiseTotOccurrence = 0;    
            
            var dtbl3 = $('#id_table3').DataTable();
            dtbl3.clear().draw();
            //---------- Insert Table Header -------------------------            
            $(dtbl3.column(2).header()).html("Attended Time");
            $(dtbl3.column(3).header()).html("Repaired Time");
            $(dtbl3.column(4).header()).html("Total Downtime");
            
            //---------- Insert Table Body -------------------------
            intRowCount = res.DateWise_DtName_Ary.length;
            //alert(intRowCount);
            
            for(i=0;i<intRowCount;i++)
            {
                //intLinewiseTotOccurrence = res.LineWiseOccuranceCategory1_Ary[i]+res.LineWiseOccuranceCategory2_Ary[i]+res.LineWiseOccuranceCategory3_Ary[i]+res.LineWiseOccuranceCategory4_Ary[i]+res.LineWiseOccuranceCategory5_Ary[i]+res.LineWiseOccuranceCategory6_Ary[i];
                intTmp = i + 1;
                dtbl3.row.add([intTmp.toString(), res.DateWise_DtName_Ary[i], res.DateWise_AttnDt_Ary[i], res.DateWise_McRepDt_Ary[i], res.DateWise_McRepDt_Ary[i]]).draw(false);
            }   
            
            //---------- Insert Table Footer -------------------------        
            $(dtbl3.column(2).footer()).html(dtbl3.column(2).data().reduce( function (a,b){return parseFloat(a)+parseFloat(b);}));
            $(dtbl3.column(3).footer()).html(dtbl3.column(3).data().reduce( function (a,b){return parseFloat(a)+parseFloat(b);}));
            $(dtbl3.column(4).footer()).html(dtbl3.column(4).data().reduce( function (a,b){return parseFloat(a)+parseFloat(b);}));
               
            //------------------ END --------------------------------------------------------------------- 
        });	
    }
</script>
</body>
</html>
