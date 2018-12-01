
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="format-detection" content="telephone=no">
        <title><?php echo $url_title; ?></title>

        <link href="https://fonts.googleapis.com/css?family=PT+Serif:400,400i,700,700ii%7CRoboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic" rel="stylesheet">


        <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH; ?>font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH; ?>bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH; ?>ion.rangeSlider.css">
        <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH; ?>ion.rangeSlider.skinFlat.css">
        <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH; ?>jquery.bxslider.css">
        <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH; ?>jquery.fancybox.css">
        <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH; ?>flexslider.css">
        <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH; ?>swiper.css">
        <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH; ?>swiper.css">
        <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH; ?>style.css">
        <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH; ?>media.css">
        <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH; ?>profile.css">
        <style type="text/css">
            .regClass{width:75% !important;}
        </style>
    </head>
    <body>
        <!-- Header - start -->
        <header class="header">
            <?php $this->load->view(HEADER_PATH); ?>

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
                                    <li class="completed"><a href="<?php echo base_url(); ?>profile"><i class="fa fa-user-circle"></i>&nbsp;Profile</a></li>

                                </ul>
                            </nav>
                            <!--Navigation section module end -->
                            <!-- Forms module section code start -->
                            <form action="" method="post" id="create_form" enctype="multipart/form-data" >

                                <!--section start -->
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="email">User name <sup class="error">*</sup>:</label>
                                            <input type="text" class="form-control" id="username" name="username" maxlength="60" placeholder="Enter user name" autocomplete="off"/>
                                        </div>
                                        <div class="error" id="username_error"></div>
                                    </div>                
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email<sup class="error">*</sup>:</label>
                                            <input type="text" class="form-control" id="useremail" name="useremail" maxlength="60" placeholder="User email" autocomplete="off"/>
                                        </div>
                                        <div class="error" id="useremail_error"></div>
                                    </div>

                                </div>
                                <!--section end -->
                                <!--section start -->
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="email">Mobile <sup class="error">*</sup>:</label>
                                            <input type="text" class="form-control numnber_class" id="usermobile" name="usermobile" maxlength="10" placeholder="Mobile number" autocomplete="off"/>
                                        </div>
                                        <div class="error" id="usermobile_error"></div>
                                    </div>                
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="email">Address<sup class="error">*</sup>:</label>
                                            <textarea class="form-control" id="address" name="address" maxlength="200" placeholder="Address" autocomplete="off"></textarea>
                                        </div>
                                        <div class="error" id="address_error"></div>
                                    </div>

                                </div>
                                <!--section end -->
                                <!--section start -->
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="email">Landmark <sup class="error">*</sup>:</label>
                                            <input type="text" class="form-control" id="landmark" name="landmark" maxlength="80" placeholder="Landmark" autocomplete="off"/>
                                        </div>
                                        <div class="error" id="landmark_error"></div>
                                    </div>                
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="email">Area<sup class="error">*</sup>:</label>
                                            <input type="text" class="form-control" id="area" name="area" maxlength="80" placeholder="Area" autocomplete="off"/>
                                        </div>
                                        <div class="error" id="area_error"></div>
                                    </div>

                                </div>
                                <!--section end -->
                                <!--section start -->
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="email">City <sup class="error">*</sup>:</label>
                                            <input type="text" class="form-control" id="city" name="city" maxlength="80" placeholder="Landmark" autocomplete="off"/>
                                        </div>
                                        <div class="error" id="city_error"></div>
                                    </div>                
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="email">State<sup class="error">*</sup>:</label>
                                            <input type="text" class="form-control" id="state" name="state" maxlength="80" placeholder="State" autocomplete="off"/>
                                        </div>
                                        <div class="error" id="state_error"></div>
                                    </div>

                                </div>
                                <!--section end -->
                                <!--section start -->
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label for="email">Pincode <sup class="error">*</sup>:</label>
                                            <input type="text" class="form-control number_class" id="pincode" name="pincode" maxlength="6" placeholder="Pincode" autocomplete="off"/>
                                        </div>
                                        <div class="error" id="pincode_error"></div>
                                    </div>                
                                    <input type="hidden" name="country" id="country" value="india"/>

                                </div>
                                <!--section end -->
                                <!-- Button section start -->
                                <div class="row">
                                    <div class="col-lg-6 loadingSection"></div>                    
                                    <div class="col-lg-6 btn_class ">
                                        <button class="btn btn-primary pull-right">Update profile</button>
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
            <?php $this->load->view(FOOTER_PATH); ?>

        </footer>
        <script src="<?php echo ADMIN_JS_PATH; ?>project.js"></script>

    </body>
    <script type="text/javascript">
        $('#create_form').on('submit', function (e) {
            e.preventDefault();
            str = true;
            $('#username_error,#mobile_error,#pincode_error,#country_error,#state_error,#city_error,#area_error,#address_error').text('');
            var username = $('#username').val();
            var address = $('#address').val();

            var usermobile = $('#usermobile').val();
            var checkmobile = mobile_check(usermobile);
            var pincode = $('#pincode').val();
            var checkpincode = pincode_check(pincode);
            var address = $('#address').val();
            var area = $('#area').val();
            var city = $('#city').val();
            var state = $('#state').val();
            var country = $('#country').val();
            if (username == '') {
                $('#username_error').text('Please Enter Name');
                str = false;
            }
            if (username != '' && !namepattern.test(username)) {
                $('#username_error').text('Please Enter Valid Name');
                str = false;
            }

            if (checkmobile == false) {
                $('#mobile_error').text('Please Enter 10 digit Valid Mobile Number');
                str = false;
            }
            if (checkpincode == false) {
                $('#pincode_error').text('Please enter 6 digit pincode');
                str = false;
            }
            if (address == '') {
                $('#address_error').text('Please Enter Address');
                str = false;
            }
            if (area == '') {
                $('#area_error').text('Please Enter Area');
                str = false;
            }
            if (city == '') {
                $('#city_error').text('Please Choose City');
                str = false;
            }
            if (state == '') {
                $('#state_error').text('Please choose State');
                str = false;
            }

            if (str == true)
            {

                var formdetails = JSON.stringify($('#create_form').serializeObject());
                $('.btn_class').hide('');
                $('.loadingSection').html('Please wait...').css({'color': 'blue'});
                $.ajax({
                    dataType: 'JSON',
                    method: 'post',
                    data: formdetails,
                    processData: false,
                    cache: false,
                    encType: false,
                    url: "<?php echo base_url(); ?>Userapi/updateProfile",
                    success: function (s) {
                        console.log(s)
                        if (s.code == 200)
                        {
                            $('.loadingSection').html(s.description).css({'color': 'green'});
                            setTimeout(function () {
                                window.location = location.href;
                            }, 2000);
                        } else
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
    <script type="text/javascript">

        $(document).ready(function () {
            var userid = "<?php echo $this->session->userdata(USER_SESS_CODE . 'userid'); ?>";
            if (userid != '0')
            {
                getUserDetails(userid);
            }

        });
        function getUserDetails(s)
        {
            $.getJSON("<?php echo base_url(); ?>Userapi/getProfileDetails/" + s, function (r) {
                console.log(r);
                if (r.code == 200)
                {
                    var userres = r.user_details;
                    $('#username').val(userres.username);
                    $('#useremail').val(userres.email);
                    $('#usermobile').val(userres.mobile);
                    $('#pincode').val(userres.pincode);
                    $('#address').val(userres.address);
                    $('#area').val(userres.area);
                    $('#country').val(userres.country);
                    $('#city').val(userres.city);
                    $('#state').val(userres.state);
                    $('#country').val(userres.country);
                    $('#landmark').val(userres.landmark);
                }
            });
        }

    </script>

</html>