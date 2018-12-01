 <!-- Topbar - start -->
 <div class="header_top">
        <div class="container">
            <ul class="contactinfo nav nav-pills">
                <li>
                    <i class='fa fa-phone'></i> <?php echo SITE_PHONE; ?>
                </li>
                <li>
                    <i class="fa fa-envelope"></i> <?php echo SITE_EMAIL; ?>
                </li>
            </ul>
            <!-- Social links -->
            <ul class="social-icons nav navbar-nav">
                <li>
                    <a href="http://facebook.com" rel="nofollow" target="_blank">
                        <i class="fa fa-facebook"></i>
                    </a>
                </li>
                <li>
                    <a href="http://google.com" rel="nofollow" target="_blank">
                        <i class="fa fa-google-plus"></i>
                    </a>
                </li>
                <li>
                    <a href="http://twitter.com" rel="nofollow" target="_blank">
                        <i class="fa fa-twitter"></i>
                    </a>
                </li>
                <li>
                    <a href="http://vk.com" rel="nofollow" target="_blank">
                        <i class="fa fa-vk"></i>
                    </a>
                </li>
                <li>
                    <a href="http://instagram.com" rel="nofollow" target="_blank">
                        <i class="fa fa-instagram"></i>
                    </a>
                </li>
            </ul>       </div>
    </div>
    <!-- Topbar - end -->

    <!-- Logo, Shop-menu - start -->
    <div class="header-middle">
        <div class="container header-middle-cont">
            <div class="toplogo">
                <a href="<?php echo base_url(); ?>">
                    <img src="<?php echo LOGO_PATH; ?>" alt="<?php echo PROJECT_NAME; ?>" title="<?php echo PROJECT_NAME; ?>">
                </a>
            </div>
            <div class="shop-menu" style="display:none;">
                <ul>
                    <?php
                    $login_status =$this->session->userdata('user_login_status');
                    $redirectionlink = base_url().'signup';
                    if($login_status==1)
                    {
                        $redirectionlink = base_url().'managebooks';
                        $username = $this->session->userdata(USER_SESS_CODE.'username');
                        $useremail = $this->session->userdata(USER_SESS_CODE.'useremail');
                        $usermobile = $this->session->userdata(USER_SESS_CODE.'usermobile');
                    }
                    ?>
                    <li>
                        <a href="<?php echo $redirectionlink; ?>">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="<?php echo $redirectionlink; ?>">Sell  Books</span> 
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>">
                            <i class="fa fa-credit-card-alt"></i>
                            <span class="">Buy Books</span> 
                        </a>
                    </li>
                     <?php
                     if($login_status==''){
                     ?>   
                    <li class="topauth">
                        <a href="<?php echo base_url(); ?>signup">
                            <i class="fa fa-lock"></i>
                            <span class="shop-menu-ttl">Registration</span>
                        </a>
                        <a href="<?php echo base_url(); ?>signup">
                            <span class="shop-menu-ttl">Login</span>
                        </a>
                    </li>
                     <?php } ?>      
                     <?php
                     if($login_status==1){
                     ?>   
                    <li class="topauth">
                        <a href="<?php echo base_url(); ?>profile">
                            <i class="fa fa-user-circle"></i>
                            My profile
                        </a>
                        
                    </li>
                    <li>
                    <a onclick="return  confirm('Confirm to logout the session ?')" href="<?php echo base_url(); ?>logout">
                            <span class="shop-menu-ttl">Logout</span>
                        </a>
                    </li>
                     <?php } ?>    
                    <li>
                        <div class="h-cart">
                            <a href="<?php echo base_url(); ?>checkout">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="shop-menu-ttl">Cart</span>
                                 
                            </a>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <!-- Logo, Shop-menu - end -->

    <!-- Topmenu - start -->
    <div class="header-bottom">
        <div class="banner-vir">
        <img src="<?php echo ADDS_PATH.'banner3.jpg';?>"/>
        </div>
        <div class="container">

            <nav class="topmenu">
<?php
$header_active=1;
$header_menu_req = json_decode($header_menu);
if($header_menu_req->code!=SUCCESS_CODE){
    $header_active=0;
}
?>
                <!-- Catalog menu - start -->
                <div class="topcatalog">
                    <a class="topcatalog-btn" href="javascript:void(0)"><span></span> Menu</a>
                    <ul class="topcatalog-list" style="display:none;">
                        <?php
                        if($header_active ==1){
                            foreach($header_menu_req->menu_result as $menu_res){
                                $menulink=base_url().'menu/'.url_title($menu_res->menu_title).'/'.base64_encode($menu_res->menu_id);
                        ?>
                        <li>
                            <a href="<?php echo $menulink; ?>">
                                <?php echo fetch_ucfirst($menu_res->menu_title); ?>
                            </a>
                            <i class="fa fa-angle-right"></i>
                            <ul>
                            <?php foreach($menu_res->submenu as $sub_res){ 
                               $submenulink=base_url().'submenu/'.url_title($sub_res->subgroup_title).'/'.base64_encode($sub_res->subgroup_id);
                                ?>
                                <li>
                                    <a href="<?php echo $submenulink; ?>">
                                        <?php echo fetch_ucfirst($sub_res->subgroup_title); ?>
                                    </a>
                                </li>
                            <?php } ?>
                               
                               
                            </ul>
                        </li>
                        <?php } } ?>
                    </ul>
                    <ul class="topcatalog-list">
                    
                    <?php
                        if($header_active ==1){
                            foreach($header_menu_req->menu_result as $menu_res){
                                $menulink=base_url().'menu/'.url_title($menu_res->menu_title).'/'.base64_encode($menu_res->menu_id);
                        ?>
                    <li class="menu-item-has-children">
                        <a href="<?php echo $menulink; ?>">
                        <?php echo fetch_ucfirst($menu_res->menu_title); ?> <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="sub-menu">
                        <?php foreach($menu_res->submenu as $sub_res){ 
                             $submenulink=base_url().'submenu/'.url_title($sub_res->subgroup_title).'/'.base64_encode($sub_res->subgroup_id);
                            ?>
                            <li>
                                <a href="<?php echo $submenulink; ?>">
                                <?php echo fetch_ucfirst($sub_res->subgroup_title); ?>
                                </a>
                            </li>
                        <?php } ?>
                        </ul>
                    </li>
                            <?php } } ?>
                    <li class="menu-item-has-children">
                        <a href="">
                            profile
                        </a><i class="fa fa-angle-down"></i>
                        <ul class="sub-menu">
                            <?php
                    $cur_page=$this->uri->segment(1);

                     ?>
                        <!-- profile list elements start -->
                        <li <?php if($cur_page=='profile'){ ?>class="active"<?php } ?>>
                            <a href="<?php echo base_url().'profile'; ?>">
                            <i class="glyphicon glyphicon-user"></i>
                            My profile </a>
                        </li>
                        <li <?php if($cur_page=='managebooks'){ ?>class="active"<?php } ?>>
                            <a href="<?php echo base_url().'managebooks'; ?>">
                            <i class="glyphicon glyphicon-book"></i>
                            Manage My Books  </a>
                        </li>
                        <li <?php if($cur_page=='addnewbook'){ ?>class="active"<?php } ?>>
                            <a href="<?php echo base_url().'addnewbook'; ?>">
                            <i class="glyphicon glyphicon-book"></i>
                            Sell Book</a>
                        </li>
                        <li >
                            <a href="<?php echo base_url().''; ?>">
                            <i class="fa fa-plus-circle"></i>
                            Buy Book</a>
                        </li>
                        <li <?php if($cur_page=='orders'){ ?>class="active"<?php } ?>>
                            <a href="<?php echo base_url().'orders'; ?>">
                            <i class="fa fa-edit"></i>
                            My Orders</a>
                        </li>
                        <li <?php if($cur_page=='transactions'){ ?>class="active"<?php } ?>>
                            <a href="<?php echo base_url().'transactions'; ?>">
                            <i class="glyphicon glyphicon-credit-card"></i>
                            Transactions</a>
                        </li>
                        <li <?php if($cur_page=='bookingorders'){ ?>class="active"<?php } ?>>
                            <a href="<?php echo base_url().'bookingorders'; ?>">
                            <i class="fa fa-edit"></i>
                            Booking Orders</a>
                        </li>
                        <!-- <li>
                            <a href="<?php echo base_url().'addnewbook'; ?>">
                            <i class="fa fa-truck"></i>
                            Track Order</a>
                        </li> -->
                        <li <?php if($cur_page=='changepassword'){ ?>class="active"<?php } ?>>
                            <a href="<?php echo base_url().'changepassword'; ?>">
                            <i class="fa fa-key"></i>
                            Change Password </a>
                        </li>

                        <li>
                            <a onclick="return confirm('Confirm to logout the session ?')" href="<?php echo base_url().'logout'; ?>">
                            <i class="fa fa-power-off"></i>
                            Logout </a>
                        </li>
                        <!--profile list elements end-->
                      
                        </ul>
                    </li>
                     
                    <li class="menu-item">
                        <a href="<?php echo base_url(); ?>contactus">
                            Contact Us
                        </a>
                    </li>
                    <li class="menu-item">
                    <a href="<?php echo base_url(); ?>requestbook">
                            Request a Book
                        </a>
                    </li>
                    <li class="menu-item" style="display:none;">
                        <a href="<?php echo $redirectionlink;?>">
                            Joint Seller
                        </a>
                    </li>
                    
                </ul>
                </div>
                <!-- Catalog menu - end -->

                <!-- Main menu - start -->
                <button type="button" class="mainmenu-btn">Menu</button>
<div class="shop-menu">
                <ul>
                    <?php
                    $login_status =$this->session->userdata('user_login_status');
                    $redirectionlink = base_url().'signup';
                    if($login_status==1)
                    {
                        $redirectionlink = base_url().'managebooks';
                        $username = $this->session->userdata(USER_SESS_CODE.'username');
                        $useremail = $this->session->userdata(USER_SESS_CODE.'useremail');
                        $usermobile = $this->session->userdata(USER_SESS_CODE.'usermobile');
                    }
                    ?>
                    <li>
                        <a href="<?php echo base_url(); ?>" class="active">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo $redirectionlink; ?>">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="<?php echo $redirectionlink; ?>">Sell  Books</span> 
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>">
                            <i class="fa fa-credit-card-alt"></i>
                            <span class="">Buy Books</span> 
                        </a>
                    </li>
                     <?php
                     if($login_status==''){
                     ?>   
                    <li class="topauth">
                        <a href="<?php echo base_url(); ?>signup">
                            <i class="fa fa-lock"></i>
                            <span class="shop-menu-ttl">Registration</span>
                        </a>
                        <a href="<?php echo base_url(); ?>signup">
                            <span class="shop-menu-ttl">Login</span>
                        </a>
                    </li>
                     <?php } ?>      
                     <?php
                     if($login_status==1){
                     ?>   
                    <li>
                        <a href="<?php echo base_url(); ?>profile">
                            <i class="fa fa-user-circle"></i>
                            My profile
                        </a>
                        
                    </li>
                    <li>
                    <a onclick="return  confirm('Confirm to logout the session ?')" href="<?php echo base_url(); ?>logout">
                            <span class="shop-menu-ttl">Logout</span>
                        </a>
                    </li>
                     <?php } ?>    
                    <li>
                        <div class="h-cart">
                            <a href="<?php echo base_url(); ?>checkout">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="shop-menu-ttl">Cart</span>
                                 
                            </a>
                        </div>
                    </li>

                </ul>
            </div>
                <ul class="mainmenu" style="display:none;">
                    <li>
                        <a href="<?php echo base_url(); ?>" class="active">
                            Home
                        </a>
                    </li>
                    <?php
                        if($header_active ==1){
                            foreach($header_menu_req->menu_result as $menu_res){
                                $menulink=base_url().'menu/'.url_title($menu_res->menu_title).'/'.base64_encode($menu_res->menu_id);
                        ?>
                    <li class="menu-item-has-children">
                        <a href="<?php echo $menulink; ?>">
                        <?php echo fetch_ucfirst($menu_res->menu_title); ?> <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="sub-menu">
                        <?php foreach($menu_res->submenu as $sub_res){ 
                             $submenulink=base_url().'submenu/'.url_title($sub_res->subgroup_title).'/'.base64_encode($sub_res->subgroup_id);
                            ?>
                            <li>
                                <a href="<?php echo $submenulink; ?>">
                                <?php echo fetch_ucfirst($sub_res->subgroup_title); ?>
                                </a>
                            </li>
                        <?php } ?>
                        </ul>
                    </li>
                            <?php } } ?>
                     
                    <li class="menu-item">
                        <a href="<?php echo base_url(); ?>contactus">
                            Contact Us
                        </a>
                    </li>
                    <li class="menu-item">
                    <a href="<?php echo base_url(); ?>requestbook">
                            Request a Book
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="<?php echo $redirectionlink;?>">
                            Joint Seller
                        </a>
                    </li>
                    <li class="mainmenu-more">
                        <span>...</span>
                        <ul class="mainmenu-sub"></ul>
                    </li>
                </ul>
                <!-- Main menu - end -->

                <!-- Search - start -->
                <div class="topsearch">
                    <a id="topsearch-btn" class="topsearch-btn" href="#"><i class="fa fa-search"></i></a>
                    <form class="topsearch-form" action="" id="headerSearchForm">
                        <input type="text" name="searchproduct" id="searchproduct" maxlength="60" placeholder="Search products">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <!-- Search - end -->

            </nav>       </div>
            <div class="banner-hor">
        <img src="<?php echo ADDS_PATH.'banner3.jpg';?>"/>
        </div>
    </div>
    <!-- Topmenu - end -->