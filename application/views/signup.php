
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <title><?php echo PROJECT_NAME; ?></title>

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
  <style type="text/css">
  .regClass{width:75% !important;}
  </style>
</head>
<body>
<!-- Header - start -->
<header class="header">
<?php $this->load->view(HEADER_PATH);  ?>

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
                <span>Registration / Login</span>
            </li>
        </ul>
        <h1 class="main-ttl"><span>Registration / Login</span></h1>
        <div class="auth-wrap">
            <div class="auth-col">
                <h2>Login</h2>
                <form method="post" class="login" nam="user_signin" id="user_signin">
                <input type="hidden" name="app" id="app" value="web"/>
                    <p>
                        <label for="username">Email/Mobile<span class="required">*</span></label><input placeholder="Email / Mobile" type="text" name="loginusername" id="login_username" maxlength="60" autocomplete="off"  value="" class="regClass"/>
                        <div class="text-danger text-center" id="login_username_error"></div>
                    </p>
                    <p>
                        <label for="password">Password <span class="required">*</span></label><input placeholder="Enter password" type="password" name="loginpassword" id="login_password" maxlength="20" autocomplete="off"  value="" class="regClass"/>
                        <div class="text-danger text-center" id="login_password_error"></div>
                    </p>
                    <div class="clearfix">&nbsp;</div>
                    <p class="auth-submit loginBtnSection">
                        <input type="submit" value="Login">

                    </p>
                    <div class="loginHideSection"></div>
                    <p class="auth-lost_password">
                        <a href="<?php  echo base_url(); ?>vendor-forgotpassword">Lost your password?</a>
                    </p>
                </form>
            </div>
            <div class="auth-col">
                <h2>Register</h2>
                <form method="post" class="register" id="user_register_form" name="user_register_form">
                    <p>
                        <label for="reg_email">User Name <span class="required">*</span></label><input class="regClass" placeholder="User name" type="text" name="username" id="username" maxlength="60" autocomplete="off"  value="" />
                        <div class="text-danger text-center" id="username_error"> </div>
                    </p>
                    <p>
                        <label for="reg_password">Email <span class="required">*</span></label> <input class="regClass" placeholder="Email" type="text" name="useremail" id="useremail" maxlength="60" autocomplete="off"  value="" />
                        <div class="text-danger text-center" id="useremail_error"></div>
                    </p>
                    <p>
                        <label for="reg_password">Mobile <span class="required">*</span></label><input class="regClass" placeholder="Mobile Number" type="text" name="usermobile" id="usermobile" maxlength="10" autocomplete="off"  value=""/>
                        <div class="text-danger text-center" id="usermobile_error"></div>
                    </p>
                    <p>
                        <label for="reg_password">Password <span class="required">*</span></label>  <input class="regClass" placeholder="Enter password" type="password" name="userpassword" id="userpassword" maxlength="20" autocomplete="off"  value=""/>
                        <div class="text-danger text-center" id="userpassword_error"></div>
                    </p>
                    <p>
                        <label for="reg_password">Re-enter Password <span class="required">*</span></label> <input class="regClass" placeholder="Re-enter password" type="password" name="confirm_password" id="confirm_password" maxlength="20" autocomplete="off"  value=""/>
                        <div class="text-danger text-center" id="confirm_password_error"> </div>
                    </p>
                    <div class="clearfix">&nbsp;</div>
                    <p class="auth-submit submitBtnSection">
                        <input type="submit" value="Register">
                    </p>
                    <p><div class="signupHideSection"></div></p>
                </form>
            </div>
        </div>



    </section>
</main>
<!-- Main Content - end -->


<!-- Footer - start -->
<footer class="footer-wrap">
    <?php $this->load->view(FOOTER_PATH);  ?>

</footer>
<script src="<?php echo ADMIN_JS_PATH;  ?>project.js"></script>

</body>
<script type="text/javascript">
$('#user_register_form').on('submit',function(e){
e.preventDefault();
str = true;
        $('#username_error,#useremail_error,#usermobile_error,#userpassword_error,#confirm_password_error').html('');
        var fullname = $('#username').val();
        var email = $('#useremail').val();
        var mobile = $('#usermobile').val();
        var password = $('#userpassword').val();
        var confirm_password = $('#confirm_password').val();

        if(fullname==''){str=false;$('#username_error').html('Please enter username');}
        if(email==''){str=false;$('#useremail_error').html('Please enter email');}
        if(mobile==''){str=false;$('#usermobile_error').html('Please enter mobile');}
        if(password==''){str=false;$('#userpassword_error').html('Please enter password');}
        if(confirm_password==''){str=false;$('#confirm_password_error').html('Please enter confirm password');}

        if(fullname!='' && (fullname.length < 3)){str=false;$('#username_error').html('Enter name with min 3 characters ');}
        //if(fullname!=''  && (alphabets_check(fullname)==0)){str=false;$('#username_error').html('Please enter valid user name');}
        if(email!='' && (email_check(email)==0)){str=false;$('#useremail_error').html('Enter valid email');}
        if(mobile!='' && (mobile_check(mobile)==0)){str=false;$('#usermobile_error').html('Enter valid mobile number');}
        if(password!='' && confirm_password!='' && password!=confirm_password){str=false;$('#confirm_password_error').html('confirm password should be same with password');}
        if (str == true)
        {

            $('.submitBtnSection').hide('');
            $('.signupHideSection').html('Please wait...').css({'color': 'blue'});

            var formdetails = JSON.stringify($('#user_register_form').serializeObject());
            $.ajax({
                dataType: 'JSON',
                type: 'post',
                data:formdetails,
                url: "<?php echo base_url(); ?>Userapi/signup",
                success: function (s) {
                    //alert(s.description);
                    console.log(s);
                    if (s.code == 200)
                    {
                        $('.signupHideSection').html(s.description).css({'color': 'green'});
                        setTimeout(function () {
                            window.location = '';
                        }, 2000);
                    } else
                    {
                        $('.signupHideSection').html(s.description).css({'color': 'red'});


                            $('.submitBtnSection').show('');
                    }

                },
                error: function (er) {
                    console.log(er);
                }
            });
        }
return str;

});
$('#user_signin').on('submit',function(e){
e.preventDefault();
str = true;
let lasturl = "<?php $url= $_SERVER['HTTP_REFERER']; ?>";
        $('#login_username_error,#login_password_error').html('');
        var username = $('#login_username').val();
        var password = $('#login_password').val();
        if(username==''){str=false;$('#login_username_error').html('Please enter email / mobile');}
        if(password==''){str=false;$('#login_password_error').html('Please enter password');}
        //if(password!='' && (password_check(password)==0)){str=false;$('#login_password_error').html('Invalid credentials');}
        if(isNaN(username))
        {
            if(username!='' && (email_check(username)==0)){str=false;$('#login_username_error').html('Enter valid email');}
        }else
        {
            if(username!='' && (mobile_check(username)==0)){str=false;$('#login_username_error').html('Enter valid 10 digit mobile number');}
        }
        if (str == true)
        {
           $('.loginBtnSection').hide('');
           $('.loginHideSection').html('Please wait...').css({'color': 'blue'});
          var formdetails = JSON.stringify($('#user_signin').serializeObject());
            $.ajax({
                dataType: 'JSON',
                type: 'post',
                data:formdetails,
                url: "<?php echo base_url(); ?>Userapi/userLogin",
                success: function (s) {
                    //alert(s.description);
                    console.log(s);
                    if (s.code == 200)
                    {
                        $('.loginHideSection').html(s.description).css({'color': 'green'});
                        //alert(lasturl);
                        setTimeout(function () {
                            if(lasturl=="<?php echo base_url().'checkout'; ?>")
                            {
                                window.location = "<?php echo base_url().'checkout'; ?>";
                            }
                            else
                            {
                                window.location = s.redirection_link;
                            }

                        }, 2000);
                    } else
                    {
                        $('.loginHideSection').html(s.description).css({'color': 'red'});

                            $('.loginBtnSection').show('');
                    }

                },
                error: function (er) {
                    console.log(er);
                }
            });
        }
return str;

});
</script>
</html>
