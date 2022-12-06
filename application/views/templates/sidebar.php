
 <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <?php if($this->ion_auth->logged_in()): ?>
                            
                                <?php if($this->ion_auth->is_admin()): ?>
                                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url() ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('users') ?>" aria-expanded="false"><i class="mdi mdi-account-circle"></i><span class="hide-menu">Users</span></a></li>
                                
                                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-key-plus"></i><span class="hide-menu">Masters </span></a>
                                        <ul aria-expanded="false" class="collapse  first-level">            
                                            <li class="sidebar-item"><a href="<?php echo base_url('items') ?>" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Items </span></a></li>
                                            <li class="sidebar-item"><a href="<?php echo base_url('department') ?>" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Department </span></a></li>
                                        </ul>
                                    </li>
                                
                                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-cart"></i><span class="hide-menu">Stocks </span></a>
                                    <!-- <span class="badge bg-danger"><?php //echo isset($_SESSION['min_qty_alrert']) ? ($_SESSION['min_qty_alrert']) : '0' ?></span> -->
                                        <ul aria-expanded="false" class="collapse  first-level">
                                            <li class="sidebar-item"><a href="<?php echo base_url('purchase') ?>" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Purchase </span></a></li>
                                            <li class="sidebar-item"><a href="<?php echo base_url('selling') ?>" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Sell </span></a></li>                                        
                                            <li class="sidebar-item"><a href="<?php echo base_url('instock') ?>" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> In-Stock </span></a></li>
                                        </ul>
                                    </li>
                                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Vendors </span></a>
                                        <ul aria-expanded="false" class="collapse  first-level">
                                            <li class="sidebar-item"><a href="<?php echo base_url('vendors') ?>" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> List </span></a></li>
                                            <li class="sidebar-item"><a href="<?php echo base_url('vendors/stock') ?>" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Stock </span></a></li>
                                        </ul>
                                    </li>
                                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-file"></i><span class="hide-menu">Reports </span></a>
                                        <ul aria-expanded="false" class="collapse  first-level">
                                            <li class="sidebar-item"><a href="<?php echo base_url('reports/purchase') ?>" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Purchase </span></a></li>
                                            <li class="sidebar-item"><a href="<?php echo base_url('reports/selling') ?>" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Selling </span></a></li>
                                        </ul>
                                    </li>
                                <?php endif ?>
                                <?php if($this->ion_auth->in_group('user')) { ?>
                                    <li class="sidebar-item"><a href="<?php echo base_url('instock') ?>" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> In-Stock </span></a></li>
                                    <li class="sidebar-item"><a href="<?php echo base_url('selling/add') ?>" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Add Selling </span></a></li>
                                <?php } ?>
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url("profile/".$this->ion_auth->user()->row()->id) ?>" aria-expanded="false"><i class="mdi mdi-account-edit"></i><span class="hide-menu">My Profile</span></a></li>
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('logout') ?>" aria-expanded="false"><i class="mdi mdi-power"></i><span class="hide-menu">Logout</span></a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
    
