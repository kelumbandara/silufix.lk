<?php
    //session_start();
    $username = $_SESSION["user_name"];
    $roll_section   = $_SESSION["user_roll_sections"];
    //$roll_areas     = $_SESSION["user_roll_areas"];
    //print_r($section);   
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../../myimg/Logo-Silueta.jpg" class="img-fluid active " alt="User Image">
            </div>
            <div class="info">
                <a href="https://www.mas-silueta.com/" class="d-block">MAS Silueta</a>
            </div>
        </div>       
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
                <?php if (in_array('10' , $roll_section)): ?>
                    <li class="nav-item menu-open">
                        <a href="../../pages/home/home.php" class="nav-link deactive">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>                   
                    </li> 
                <?php endif; ?>     
                <li class="nav-item">
                    <?php if (in_array('20' , $roll_section)): ?>
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-list"></i>
                            <p>Reports<i class="right fas fa-angle-left"></i></p>
                        </a>
                    <?php endif; ?>                    
                    <ul class="nav nav-treeview">
                        <?php if (in_array('201' , $roll_section)): ?>
                            <li class="nav-item">
                                <a href="../workorder_mttr_mtbr/index.php" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>MTBF/MTTR</p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (in_array('202' , $roll_section)): ?>
                            <li class="nav-item">
                                <a href="../workorder_report_breakdown/index.php" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>Breakdown</p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (in_array('203' , $roll_section)): ?>
                            <li class="nav-item">
                                <a href="../workorder_report_plannedmnt/index.php" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>Planned Maintenance</p>
                                </a>
                            </li> 
                        <?php endif; ?>
                        <?php if (in_array('204' , $roll_section)): ?>
                            <li class="nav-item">
                                <a href="../workorder_report_redtag/index.php" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>Red Tag</p>
                                </a>
                            </li> 
                        <?php endif; ?>
                        <?php if (in_array('205' , $roll_section)): ?>
                            <li class="nav-item">
                                <a href="../workorder_report_buildingmnt/index.php" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>Building Maintenance</p>
                                </a>
                            </li> 
                        <?php endif; ?>
                        <?php if (in_array('206' , $roll_section)): ?>
                            <li class="nav-item">
                                <a href="../workorder_report_other/index.php" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>Other</p>
                                </a>
                            </li> 
                        <?php endif; ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <?php if (in_array('30' , $roll_section)): ?>
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>Machine Monitoring<i class="right fas fa-angle-left"></i></p>
                        </a>
                    <?php endif; ?>
                    <ul class="nav nav-treeview">
                        <?php if (in_array('301' , $roll_section)): ?>
                            <li class="nav-item">
                                <a href="../machine_monitoring_dashboard/mc_dashboard.php" class="nav-link">
                                    <i class="nav-icon fas fa-desktop"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (in_array('302' , $roll_section)): ?>
                            <li class="nav-item">
                                <a href="../machine_monitoring_report_machinewise_allmc/index.php" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>Machine wise Reports</p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (in_array('303' , $roll_section)): ?>
                            <li class="nav-item">
                                <a href="../machine_monitoring_report_modulewise/index.php" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>Module wise Reports</p>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <?php if (in_array('40' , $roll_section)): ?>
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-male"></i>
                            <p>Mechanic Performance<i class="right fas fa-angle-left"></i></p>
                        </a>
                    <?php endif; ?>
                    <ul class="nav nav-treeview">
                        <?php if (in_array('401' , $roll_section)): ?>
                            <li class="nav-item">
                                <a href="../mechanic_performance/index.php" class="nav-link">
                                    <i class="nav-icon fas fa-desktop"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (in_array('402' , $roll_section)): ?>
                            <li class="nav-item">
                                <a href="../mechanic_jobhistory/index.php" class="nav-link">
                                    <i class="nav-icon fas fa-file-alt"></i>
                                    <p>Job History Summary</p>
                                </a>
                            </li> 
                        <?php endif; ?>    
                        <?php if (in_array('403' , $roll_section)): ?>
                            <li class="nav-item">
                                <a href="../mechanic_jobhistory_shift/index.php" class="nav-link">
                                    <i class="nav-icon fas fa-file-alt"></i>
                                    <p>Job History Details</p>
                                </a>
                            </li> 
                        <?php endif; ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <?php if (in_array('50' , $roll_section)): ?>
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user-cog"></i>
                            <p>User Management<i class="right fas fa-angle-left"></i></p>
                        </a>
                    <?php endif; ?>
                    <ul class="nav nav-treeview">
                        <?php if (in_array('501' , $roll_section)): ?>
                            <li class="nav-item">
                                <a href="../user_account/users.php" class="nav-link">
                                    <i class="nav-icon far fa-edit"></i>
                                    <p>User Account Management</p>
                                </a>
                            </li>
                        <?php endif; ?>                        
                        <?php if (in_array('502' , $roll_section)): ?>
                            <li class="nav-item disabled">
                                <a href="../user_role/users_role.php" class="nav-link">
                                    <i class="nav-icon far fa-edit"></i>
                                    <p>User Access Management</p>
                                </a>
                            </li>   
                        <?php endif; ?>
                    </ul>
                </li>  
                <li class="nav-item">
                    <?php if (in_array('60' , $roll_section)): ?>
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-pencil-alt"></i>
                            <p>System Management<i class="right fas fa-angle-left"></i></p>
                        </a>
                    <?php endif; ?>
                    <ul class="nav nav-treeview">
                        <?php if (in_array('601' , $roll_section)): ?>
                            <li class="nav-item">
                                <a href="../machine_management/index.php" class="nav-link">
                                    <i class="nav-icon far fa-edit"></i>
                                    <p>Machine Management</p>
                                </a>
                            </li>
                        <?php endif; ?>                        
                        <?php if (in_array('602' , $roll_section)): ?>
                            <li class="nav-item disabled">
                                <a href="../data_management/index.php" class="nav-link">
                                    <i class="nav-icon far fa-edit "></i>
                                    <p>Data Management</p>
                                </a>
                            </li>   
                        <?php endif; ?>
                        <?php if (in_array('603' , $roll_section)): ?>
                            <li class="nav-item disabled">
                                <a href="../masterdata_upload/masterdata_redtag.php" class="nav-link">
                                    <i class="nav-icon far fa-edit "></i>
                                    <p>Master Data - Redtag</p>
                                </a>
                            </li>   
                        <?php endif; ?>
                        <?php if (in_array('604' , $roll_section)): ?>
                            <li class="nav-item disabled">
                                <a href="../masterdata_upload/issuetype.php" class="nav-link">
                                    <i class="nav-icon far fa-edit "></i>
                                    <p>Issue Types</p>
                                </a>
                            </li>   
                        <?php endif; ?>
                    </ul>
                </li>   
                <li class="nav-item">                   
                        <a href="../user_profile/index.php" class="nav-link deactive">
                            <i class="nav-icon far fa-user"></i>
                            <p>User Profile</p>
                        </a>                     
                </li> 
                <li class="nav-item">                   
                        <a href="../help/index.php" class="nav-link deactive">
                            <i class="nav-icon far fa-question-circle"></i>
                            <p>Help</p>
                        </a>                     
                </li> 
                <li class="nav-item">                    
                    <a href="../logout/logout.php" class="nav-link">
                        <i class="nav-icon fas fas fa-power-off"></i>
                        <p>
                            Logout
                            <span class="badge badge-info right"></span>
                        </p>
                    </a> 
                </li>  
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
      <!-- /.sidebar -->
</aside>
