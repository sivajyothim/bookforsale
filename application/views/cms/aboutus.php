
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
                <span><?php echo $main_title; ?></span>
            </li>
        </ul>
        <h1 class="main-ttl"><span><?php echo $main_title; ?></span></h1>
        <!-- Contacts - start -->
        <br>


        <!-- Contacts Info - end -->


        <!-- Contact Form -->
        <p>
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
</p>
  <p>Why do we use it?
It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>      

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
        $('#username_error,#useremail_error,#usermobile_error,#subject_error,#description_error').html('');
        var fullname = $('#username').val();
        var email = $('#useremail').val();
        var mobile = $('#usermobile').val();
        var subject = $('#subject').val();
        var description = $('#description').val();

        if(fullname==''){str=false;$('#username_error').html('Please enter username');}
        if(email==''){str=false;$('#useremail_error').html('Please enter email');}
        if(mobile==''){str=false;$('#usermobile_error').html('Please enter mobile');}
        if(subject==''){str=false;$('#subject_error').html('Please enter subject');}
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
                url: "<?php echo base_url(); ?>Cms/insertContactRequest",
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
