<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Login</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="<?php echo ADMIN_VENDOR_PATH;  ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo ADMIN_VENDOR_PATH;  ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?php echo ADMIN_VENDOR_PATH;  ?>line-awesome/css/line-awesome.min.css" rel="stylesheet" />
    <link href="<?php echo ADMIN_VENDOR_PATH;  ?>themify-icons/css/themify-icons.css" rel="stylesheet" />
    <link href="<?php echo ADMIN_VENDOR_PATH;  ?>animate.css/animate.min.css" rel="stylesheet" />
    <link href="<?php echo ADMIN_VENDOR_PATH;  ?>toastr/toastr.min.css" rel="stylesheet" />
    <link href="<?php echo ADMIN_VENDOR_PATH;  ?>bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <!-- THEME STYLES-->
    <link href="<?php echo ADMIN_ASSETS; ?>css/main.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <style>
        body {
            background-color: #4a5ab9;
        }

        .login-content {
            max-width: 900px;
            margin: 100px auto 50px;
        }

        .auth-head-icon {
            position: relative;
            height: 60px;
            width: 60px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            background-color: #fff;
            color: #5c6bc0;
            box-shadow: 0 5px 20px #d6dee4;
            border-radius: 50%;
            transform: translateY(-50%);
            z-index: 2;
        }
    </style>
</head>

<body>
    <div class="row login-content">
        <div class="col-6 bg-white">
            <div class="text-center">
                <span class="auth-head-icon"><i class="la la-user"></i></span>
            </div>
            <div class="ibox m-0" style="box-shadow: none;">
           
                <form class="ibox-body" id="admin_login_form"  method="POST">
                    <h4 class="font-strong text-center mb-5">LOG IN</h4>
                    <div class="form-group mb-4">
                        <input class="form-control form-control-air" type="text" name="username" id="username" maxlength="60" placeholder="Email / Mobile">
                        <div class="text-danger pull-left" id="username_error"></div>
                    </div>
                    <div class="form-group mb-4">
                        <input class="form-control form-control-air" type="password" id="userpassword" placeholder="password" name="userpassword">
                        <div class="text-danger pull-left" id="userpassword_error"></div>
						<br><input type="hidden" name="continue" value="true">
                    </div>
                    <!--<div class="flexbox mb-5">
                        <span>
                            <label class="ui-switch switch-icon mr-2 mb-0">
                                <input type="checkbox" checked="">
                                <span></span>
                            </label>Remember</span>
                        <a class="text-primary" href="forgot_password.html">Forgot password?</a>
                    </div>-->
                    <div class="text-center">
                        <div class="submissionMessage pull-left"></div>
                        <button class="btn btn-primary btn-rounded btn-block btn-air" id="signin_submit">LOGIN</button>
                    </div>
                </form>
            </div>
        </div>
       
    </div>
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- CORE PLUGINS-->
    <script src="<?php echo ADMIN_VENDOR_PATH;  ?>jquery/dist/jquery.min.js"></script>
    <script src="<?php echo ADMIN_VENDOR_PATH;  ?>popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo ADMIN_VENDOR_PATH;  ?>bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo ADMIN_VENDOR_PATH;  ?>metisMenu/dist/metisMenu.min.js"></script>
    <script src="<?php echo ADMIN_VENDOR_PATH;  ?>jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo ADMIN_VENDOR_PATH;  ?>jquery-idletimer/dist/idle-timer.min.js"></script>
    <script src="<?php echo ADMIN_VENDOR_PATH;  ?>toastr/toastr.min.js"></script>
    <script src="<?php echo ADMIN_VENDOR_PATH;  ?>jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="<?php echo ADMIN_VENDOR_PATH;  ?>bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="<?php echo ADMIN_PROJECT_PATH; ?>project.js"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <!-- CORE SCRIPTS-->
    <script src="<?php echo ADMIN_JS_PATH;  ?>app.min.js"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <!-- <script>
        $(function() {
            $('#login-form').validate({
                errorClass: "help-block",
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                },
                highlight: function(e) {
                    $(e).closest(".form-group").addClass("has-error")
                },
                unhighlight: function(e) {
                    $(e).closest(".form-group").removeClass("has-error")
                },
            });
        });
    </script> -->
    <script type="text/javascript">
   $('#admin_login_form').on('submit',function(e){
       e.preventDefault();
       str=true;
       $('#username_error,#userpassword_error').html('');
       var username=$('#username').val();
       var userpassword=$('#userpassword').val();
       if(username==''){$('#username_error').html('Please enter email/mobile');str=false;}
       if(userpassword==''){$('#userpassword_error').html('Please enter password');str=false;}
       if(userpassword!='' && (userpassword.length<6)){$('#userpassword_error').html('Enter password with min 6 characters');str=false;}
       if(username!='')
       {
           if(isNaN(username) && email_check(username)==0)
           {
                $('#username').focus();
                $('#username_error').html('Entered email is invalid');str=false;
           }
           if(!isNaN(username) && mobile_check(username)==0)
           {
                $('#username').focus();
                $('#username_error').html('Entered mobile is invalid');str=false;
           }
        }

        if(str==true)
        {
            //var formdetails = JSON.stringify($('#admin_login_form').serializeObject());
            // alert(formdetails);
              $.ajax({
                        dataType:"JSON",
                        type:"POST",
                        data:new FormData(this),
                        url:"<?php echo ADMIN_LINK; ?>Welcome/adminLogin",
                        contentType:false,
                        cache:false,
                        processData:false,
                        success:function(s){
                        console.log(s);
                        switch(s.code)
                        {
                          case 200:
                                    $('#signin_submit').hide();
                                    $('.submissionMessage').html(s.description).css({'color':'green','font-size':'15px'});
                                    window.location="<?php echo ADMIN_LINK; ?>";
                              break;
                          case 204:
                                $('.submissionMessage').html(s.description).css({'color':'red','font-size':'15px'});
                                $('#signin_submit').show();
                                    break;
                          case 575:
                          case 301:$('.submissionMessage').html(s.description).css({'color':'red','font-size':'15px'});
                                    $('#signin_submit').show();
                              break;
                        }
                },
                error:function(er){
                    console.log(er);
                }
            });
        }
        return str;
   });
   </script>
</body>


<!-- Mirrored from admincast.com/adminca/preview/admin_1/html/login-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 24 Jun 2018 21:27:18 GMT -->
</html>