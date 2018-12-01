<!-- SIDEBAR USERPIC -->
<?php
$username = $this->session->userdata(USER_SESS_CODE.'username');
$useremail = $this->session->userdata(USER_SESS_CODE.'useremail');
$usermobile = $this->session->userdata(USER_SESS_CODE.'usermobile');
?>
			<div class="profile-userpic">
					<img src="<?php echo LOGO_PATH; ?>" class="img-responsive" alt="">
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						<?php echo $username; ?>
					</div>

				</div>
				<!-- END SIDEBAR USER TITLE -->
					<?php
					$cur_page=$this->uri->segment(1);

					 ?>
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu" style="display:none;">
					<ul class="nav">
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
					</ul>
				</div>
				<div class="profile-usermenu">
					<img src="<?php echo ADDS_PATH.'banner1.jpg';?>" height="300" width="300">
				</div>
