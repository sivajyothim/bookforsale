
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <title><?php echo $url_title; ?></title>

    <link href="https://fonts.googleapis.com/css?family=PT+Serif:400,400i,700,700ii%7CRoboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic" rel="stylesheet">

    
    <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH;  ?>font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH;  ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH;  ?>ion.rangeSlider.css">
    <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH;  ?>ion.rangeSlider.skinFlat.css">
    <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH;  ?>jquery.bxslider.css">
    <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH;  ?>jquery.fancybox.css">
    <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH;  ?>flexslider.css">
    <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH;  ?>swiper.css">
    <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH;  ?>swiper.css">
    <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH;  ?>style.css">
    <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH;  ?>media.css">
    <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH;  ?>profile.css">
  <style type="text/css">
  .regClass{width:75% !important;}
  .dang{color:red;}
  </style>
</head>
<body>
<!-- Header - start -->
<header class="header">
<?php $this->load->view(HEADER_PATH);  ?>

</header>
<!-- Header - end -->


<!-- Main Content - start -->
<div class="container">
    <div class="row profile">
		<div class="col-md-3">
			<!--sidebar start -->
            <div class="profile-sidebar">
				<?php $this->load->view(USER_NAVBAR_PATH); ?>
			</div>
            <!--sidebar end -->
		</div>
		<div class="col-md-9">
            <div class="profile-content">
            <!--Profile content here -->
            <div class=" col-md-12 col-lg-12 "> 
                  
                 
                    <!--Navigation section module start -->
                  <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                                <li class="active"><a href="<?php echo base_url(); ?>profile"><i class="fa fa-user-circle"></i>&nbsp;Profile</a></li>
                                <li class="completed"><a href="<?php echo base_url(); ?>profile"><i class="fa fa-key"></i>&nbsp;Change password</a></li>
                        </ul>
                  </nav>
                  <!--Navigation section module end -->
                  <!-- Forms module section code start -->
            <form action="" method="post" id="create_form" enctype="multipart/form-data" >
           
            <div class="row">
                                        <div class="form-group  formm">
                                            <input type="hidden" name="userid" id="userid" value="<?php echo ''; ?>"/>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <label for="">Old Password</label>
                                                    <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old password" maxlength="30" autocomplete="off"/>
                                                    <span class="dang" id="old_password_error"></span>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <label for="">New password</label>
                                                    <input type="password"  class="form-control" id="current_password" name="current_password" placeholder="Enter Password" maxlength="30" autocomplete="off"/>
                                                    <span class="dang" id="current_password_error"></span>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <label for="">Re-enter Password</label>
                                                    <input type="password"  class="form-control" id="current_password_re" name="current_password_re" placeholder="Re-enter password" maxlength="30" autocomplete="off"/>
                                                    <span class="dang" id="current_password_re_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            
            
             <!-- Button section start -->
             <div class="row">
            <div class="col-lg-6 loadingSection"></div>                    
                    <div class="col-lg-6 btn_class ">
                    <button class="btn btn-primary pull-right">Update Password</button>
                    </div>
            </div>
            <!-- Button section end -->
            </form>
                </div>
                <!--Profile content end here -->
            </div>
		</div>
	</div>
</div>
<!-- Main Content - end -->


<!-- Footer - start -->
<footer class="footer-wrap">
    <?php $this->load->view(FOOTER_PATH);  ?>

</footer>
<script src="<?php echo ADMIN_JS_PATH;  ?>project.js"></script>

</body>
<script type="text/javascript">
$('#create_form').on('submit',function(e){
        e.preventDefault();
        str = true;
        $('#old_password_error,#current_password_error,#current_password_re_error').text('');
        var old_password=$('#old_password').val();
        var current_password=$('#current_password').val();
        var current_password_re=$('#current_password_re').val();

        if(old_password==''){$('#old_password_error').text('Please enter old password');str=false;}
        if(current_password==''){$('#current_password_error').text('Please enter new password');str=false;}
        if(current_password_re==''){$('#current_password_re_error').text('Please re-enter password');str=false;}
        if(old_password!='' && current_password_re!='') 
        {
            if(old_password==current_password_re)
            {
                $('#current_password_error').text('Old password should not be same as current password');str=false;
            } 
        }           
        if(current_password!='' && current_password_re!='') 
        {
            if(current_password!=current_password_re)
            {
                $('#current_password_re_error').text('New password & Re-enter password not matched');str=false;
            } 
        } 
        if(str==true)
        {
            var formdetails = JSON.stringify($('#create_form').serializeObject());
            $.ajax({
                        dataType: 'JSON',
                        method: 'post',
                        data: formdetails,
                        processData: false,
                        cache: false,
                        encType: false,
                        url: "<?php echo base_url(); ?>Userapi/changePassword",
                        success: function (s) {
                            console.log(s)
                            if (s.code == 200)
                                {
                                    $('.loadingSection').html(s.description).css({'color': 'green'});
                                    setTimeout(function () {
                                        window.location = location.href;
                                    }, 2000);
                                }
                                else
                                {
                                    $('.loadingSection').html(s.description).css({'color': 'red'});
                                    $('.btn_class').show('');
                                }

                        },
                        error: function (e) {
                            console.log(e);
                        }
                    });
        }
        return str;
});

</script>

</html>