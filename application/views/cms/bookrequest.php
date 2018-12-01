
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
<style media="screen">
  .required{color:red;}
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
                <span>Book Request</span>
            </li>
        </ul>
        <h1 class="main-ttl"><span>Book Request</span></h1>
        <!-- Contacts - start -->
        <br>


        <!-- Contacts Info - end -->


        <!-- Contact Form -->
        <div class="contactform-wrap">
            <form action="" method="post" name="contactform" id="contactform" enctype="multipart/form-data" class="form-validate">
                <h3 class="component-ttl component-ttl-ct component-ttl-hasdesc"><span>Send Book Enqueiry</span></h3>
                <p class="component-desc component-desc-ct"></p>
                <p>
                    <label for="reg_email">Book Title <span class="required">*</span></label>
                    <input class="regClass" placeholder="Book Title" type="text" name="book_title" id="book_title" maxlength="60" autocomplete="off"  value="" />
                    <div class="text-danger text-center" id="book_title_error"> </div>
                </p>

                <p>
                    <label for="reg_email">Author <span class="required"></span></label>
                    <input class="regClass" placeholder="Author name" type="text" name="author" id="author" maxlength="60" autocomplete="off"  value="" />
                    <div class="text-danger text-center" id="author_error"> </div>
                </p>

                <p>
                    <label for="reg_email">Edition <span class="required"></span></label>
                    <input class="regClass" placeholder="Edition" type="text" name="edition" id="edition" maxlength="60" autocomplete="off"  value="" />
                    <div class="text-danger text-center" id="edition_error"> </div>
                </p>
                    <input type="hidden" name="expected_date" id="expected_date" value="1">
                

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
                    <label for="reg_password">Description<span class="required">*</span></label>
                    <textarea class="regClass" placeholder="Enter description"  name="description" id="description" maxlength="200" autocomplete="off"  value=""></textarea>
                    <div class="text-danger text-center" id="description_error"></div>
                </p>
                <div class="clearfix">&nbsp;</div>
                <p class="auth-submit submitBtnSection pull-right">
                    <input type="submit" value="Send Request">
                </p>
                <p><div class="signupHideSection"></div></p>
            </form>
        </div>


    </section>
</main>
<!-- Main Content - end -->


<!-- Footer - start -->
<footer class="footer-wrap">
    <?php $this->load->view(FOOTER_PATH);  ?>

</footer>
<script src="<?php echo ADMIN_JS_PATH;  ?>project.js"></script>
<script type="text/javascript">
$('#contactform').on('submit',function(e){
e.preventDefault();
str = true;
        $('#username_error,#useremail_error,#usermobile_error,#book_title_error,#description_error').html('');
        var fullname = $('#username').val();
        var email = $('#useremail').val();
        var mobile = $('#usermobile').val();
        var book_title = $('#book_title').val();
        var description = $('#description').val();

        if(book_title==''){str=false;$('#book_title_error').html('Please enter book title');}
        if(fullname==''){str=false;$('#username_error').html('Please enter username');}
        if(email==''){str=false;$('#useremail_error').html('Please enter email');}
        if(mobile==''){str=false;$('#usermobile_error').html('Please enter mobile');}

        if(description==''){str=false;$('#description_error').html('Please enter description');}

        if(fullname!='' && (fullname.length < 3)){str=false;$('#username_error').html('Enter name with min 3 characters ');}
        //if(fullname!=''  && (alphabets_check(fullname)==0)){str=false;$('#username_error').html('Please enter valid user name');}
        if(email!='' && (email_check(email)==0)){str=false;$('#useremail_error').html('Enter valid email');}
        if(mobile!='' && (mobile_check(mobile)==0)){str=false;$('#usermobile_error').html('Enter valid mobile number');}

        if (str == true)
        {

            $('.submitBtnSection').hide('');
            $('.signupHideSection').html('Please wait...').css({'color': 'blue'});

            var formdetails = JSON.stringify($('#contactform').serializeObject());
            $.ajax({
                dataType: 'JSON',
                type: 'post',
                data:formdetails,
                url: "<?php echo base_url(); ?>Cms/insertBookRequest",
                success: function (s) {
                    //alert(s.description);
                    console.log(s);
                    if (s.code == 200)
                    {
                        $('.signupHideSection').html(s.description).css({'color': 'green'});
                        setTimeout(function () {
                            window.location = location.href;
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
</script>

</body>
</html>
