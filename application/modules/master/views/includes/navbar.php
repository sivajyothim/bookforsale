<div id="sidebar-collapse">
                <ul class="side-menu metismenu">
                <li >
                        <a href="<?php echo ADMIN_LINK;  ?>"><i class="sidebar-item-icon ti-home"></i>
                            <span class="nav-label">Dashboard</span><i class="fa fa-angle-left arrow"></i></a>
                                            </li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon ti-home"></i>
                            <span class="nav-label">Menu</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="<?php echo ADMIN_LINK;  ?>Settings/menulist">Menu List</a>
                            </li>
                            <li>
                                <a href="<?php echo ADMIN_LINK;  ?>Settings/createmenu">Create Menu </a>
                            </li>

                            <li>
                                <a href="<?php echo ADMIN_LINK;  ?>Settings/subgroup">Manage Sub Groups</a>
                            </li>
                            <li>
                                <a href="<?php echo ADMIN_LINK;  ?>Settings/createsubgroup">Create Sub Groups</a>
                            </li>

                            <li>
                                <a href="<?php echo ADMIN_LINK;  ?>Settings/submenu">Manage Submenu</a>
                            </li>
                            <li>
                                <a href="<?php echo ADMIN_LINK;  ?>Settings/createsubmenu">Create Submenu</a>
                            </li>
                            
                        </ul>
                    </li>
                    <!--<li class="heading">FEATURES</li>-->
                    

                    <!-- Orders section -->
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon ti-home"></i>
                            <span class="nav-label">Orders</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="<?php echo ADMIN_LINK; ?>Orders" >Manage Orders</a>
                            </li>
                           <li>
                                <a href="<?php echo ADMIN_LINK; ?>Orders/pendingorders" >Pending Orders</a>
                            </li>
                            <li>
                                <a href="<?php echo ADMIN_LINK; ?>Orders/completedorders" >Completed Orders</a>
                            </li>
                            
                        </ul>
                    </li>
                    <!-- Orders section end -->

                     <!-- users section -->
                     <li>
                        <a href="javascript:;"><i class="sidebar-item-icon ti-user"></i>
                            <span class="nav-label">Users</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                        <li>
                                <a href="<?php echo ADMIN_LINK; ?>User">Manage Users</a>
                            </li>
                             
                            
                        </ul>
                    </li>
                    <!-- users section end -->

                   
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon ti-paint-roller"></i>
                            <span class="nav-label">Site Settings</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse in">
                        <li>
                                <a class="active" href="<?php echo ADMIN_LINK; ?>Settings/sliders">Slider</a>
                            </li>
                            <li>
                                <a class="active" href="<?php echo ADMIN_LINK; ?>Settings/createslider">Crete Slider</a>
                            </li>
                            <li>
                                <a class="active" href="<?php echo ADMIN_LINK; ?>Settings/weight">Manage Weights & Price</a>
                            </li>
                            <li>
                                <a class="active" href="<?php echo ADMIN_LINK; ?>Settings/createweight">Create Weights & Price</a>
                            </li>
                            
                        </ul>
                    </li>
                   
                </ul>
                <div class="sidebar-footer">
                    <a href="javascript:;"><i class="ti-announcement"></i></a>
                    <a href="calendar.html"><i class="ti-calendar"></i></a>
                    <a href="javascript:;"><i class="ti-comments"></i></a>
                    <a href="<?php echo ADMIN_LINK; ?>logout" onclick="return confirm('Confirm to Logout the Session');"><i class="ti-power-off"></i></a>
                </div>
            </div>