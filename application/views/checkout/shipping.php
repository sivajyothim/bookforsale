
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="format-detection" content="telephone=no">
        <title><?php echo PROJECT_NAME; ?></title>

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
        <main>
            <section class="container stylization maincont">


                <ul class="b-crumbs">
                    <li>
                        <a href="<?php echo base_url(); ?>">
                            Home
                        </a>
                    </li>
                    <li>
                        <span>Shipping</span>
                    </li>
                </ul>
                <h1 class="main-ttl"><span>Shipping</span></h1>

                <div class='container'>
                    <div class='row' style='padding-top:25px; padding-bottom:25px;'>
                        <div class='col-md-12'>
                            <div id='mainContentWrapper'>
                                <div class="col-md-8 col-md-offset-2">
                                    <h2 style="text-align: center;">
                                        Review Your Order & Complete Checkout
                                    </h2>
                                    <hr/>
                                    <a href="<?php echo base_url(); ?>" class="btn btn-info" style="width: 100%;color:#fff;">Add More Books</a>
                                    <hr/>
                                    <div class="shopping_cart">
                                        <form class="form-horizontal" role="form" action="" method="post" name="order_form" id="order_form">
                                            <div class="panel-group" id="accordion">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Review
                                                                Your Order</a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseOne" class="panel-collapse collapse in">
                                                        <div class="panel-body">
                                                            <div class="items">
                                                                <div class="col-md-9">
                                                                    <table class="table-responsive table-striped">
                                                                        <?php
                                                                        $statistics = json_decode($cart_details);
                                                                        ?>
                                                                        <tr>
                                                                            <td>Total Items:</td>
                                                                            <td><?php echo $statistics->cart_count; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Sub Total:</td>
                                                                            <td>Rs.<?php echo $statistics->subtotal; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Deliver Charges:</td>
                                                                            <td>Rs.<?php echo $statistics->deliver_charges; ?></td>
                                                                        </tr>

                                                                    </table>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div style="text-align: center;">
                                                                        <h3>Order Total</h3>
                                                                        <h3><span style="color:green;">Rs.<?php echo $statistics->total; ?></span></h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <div style="text-align: center; width:100%;;"><a style="width:100%;color:#fff"
                                                                                                         data-toggle="collapse"
                                                                                                         data-parent="#accordion"
                                                                                                         href="#collapseTwo"
                                                                                                         class=" btn btn-success"
                                                                                                         onclick="$(this).fadeOut(); $('#payInfo').fadeIn();">Continue
                                                                to Billing Information»</a></div>
                                                    </h4>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Contact
                                                            and Billing Information</a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <b>Billing Information.</b>
                                                        <br/><br/>
                                                        <table class="table table-striped" style="font-weight: bold;">
                                                            <tr>
                                                                <td style="width: 175px;">
                                                                    <label for="id_email">User name:</label></td>
                                                                <td>
                                                                    <input type="text" class="form-control" id="username" name="username" maxlength="60" placeholder="Enter user name" autocomplete="off"/>
                                                                    <div class="error" id="username_error"></div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 175px;">
                                                                    <label for="id_first_name">Email:</label></td>
                                                                <td>
                                                                    <input type="text" class="form-control" id="useremail" name="useremail" maxlength="60" placeholder="User email" autocomplete="off"/>
                                                                    <div class="error" id="useremail_error"></div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 175px;">
                                                                    <label for="id_last_name">Mobile:</label></td>
                                                                <td>
                                                                    <input type="text" class="form-control numnber_class" id="usermobile" name="usermobile" maxlength="10" placeholder="Mobile number" autocomplete="off"/>
                                                                    <div class="error" id="usermobile_error"></div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 175px;">
                                                                    <label for="id_address_line_1">Address:</label></td>
                                                                <td>
                                                                    <textarea class="form-control" id="address" name="address" maxlength="200" placeholder="Address" autocomplete="off"></textarea>
                                                                    <div class="error" id="address_error"></div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 175px;">
                                                                    <label for="id_address_line_2">Landmark:</label></td>
                                                                <td>
                                                                    <input type="text" class="form-control" id="landmark" name="landmark" maxlength="80" placeholder="Landmark" autocomplete="off"/>
                                                                    <div class="error" id="landmark_error"></div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 175px;">
                                                                    <label for="id_city">Area:</label></td>
                                                                <td>
                                                                    <input type="text" class="form-control" id="area" name="area" maxlength="80" placeholder="Area" autocomplete="off"/>
                                                                    <div class="error" id="area_error"></div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 175px;">
                                                                    <label for="id_state">City:</label></td>
                                                                <td>
                                                                    <input type="text" class="form-control" id="city" name="city" maxlength="80" placeholder="Landmark" autocomplete="off"/>

                                                                    <div class="error" id="city_error"></div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 175px;">
                                                                    <label for="id_state">State:</label></td>
                                                                <td>
                                                                    <input type="text" class="form-control" id="state" name="state" maxlength="80" placeholder="State" autocomplete="off"/>

                                                                    <div class="error" id="state_error"></div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 175px;">
                                                                    <label for="id_postalcode">Postalcode:</label></td>
                                                                <td>
                                                                     <input type="text" class="form-control number_class" id="pincode" name="pincode" maxlength="6" placeholder="Pincode" autocomplete="off"/>
                                                                     <div class="error" id="pincode_error"></div>
                                                                     <input type="hidden" name="country" id="country" value="india"/>
                                                                </td>
                                                            </tr>
                                                           
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <div style="text-align: center;"><a data-toggle="collapse"
                                                                                            data-parent="#accordion"
                                                                                            href="#collapseThree"
                                                                                            class=" btn   btn-success" id="payInfo"
                                                                                            style="color:#fff;;width:100%;display: none;" onclick="$(this).fadeOut();
                                                                                                    document.getElementById('collapseThree').scrollIntoView()">Enter Payment Information »</a>
                                                        </div>
                                                    </h4>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                                            <b>Payment Information</b>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseThree" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <span class='payment-errors'></span>
                                                        <b>Choose Payment mode</b>&nbsp;&nbsp;<input type="radio" name="payment_mode" id="cod" value="cod" checked/>COD&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" name="payment_mode" id="online" value="online"/>Online
                                                        <div class="clearfix">&nbsp;</div>
                                                        <button type="submit" class="btn btn-success btn-lg btn_class" style="width:100%;">Pay
                                                            Now
                                                        </button>
                                                        <div class="loadingSection"></div>
                                                        <br/>
                                                        <div style="text-align: left;"><br/>
                                                           Please read <a style="font-weight:bold" herf="<?php echo base_url(); ?>terms">Terms & conditions</a> for  more details..
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>


            </section>
        </main>
        <!-- Main Content - end -->


        <!-- Footer - start -->
        <footer class="footer-wrap">
            <?php $this->load->view(FOOTER_PATH); ?>

        </footer>
        <script src="<?php echo ADMIN_JS_PATH; ?>project.js"></script>

    </body>
    <script type="text/javascript">
                                                                                                
    $('#order_form').on('submit', function (e) {
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

                var formdetails = JSON.stringify($('#order_form').serializeObject());
                $('.btn_class').hide('');
                $('.loadingSection').html('Please wait...').css({'color': 'blue'});
                $.ajax({
                    dataType: 'JSON',
                    method: 'post',
                    data: formdetails,
                    processData: false,
                    cache: false,
                    encType: false,
                    url: "<?php echo base_url(); ?>Cart/insertorder",
                    success: function (s) {
                        console.log(s)
                        if (s.code == 200)
                        {
                            $('.loadingSection').html(s.description).css({'color': 'green'});
                            setTimeout(function () {
                                window.location = s.redirect_url;
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