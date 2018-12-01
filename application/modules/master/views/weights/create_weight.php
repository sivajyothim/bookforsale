<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title><?php echo $url_title;  ?></title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="<?php echo ADMIN_VENDOR_PATH;  ?>bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo ADMIN_VENDOR_PATH;  ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?php echo ADMIN_VENDOR_PATH;  ?>line-awesome/css/line-awesome.min.css" rel="stylesheet" />
    <link href="<?php echo ADMIN_VENDOR_PATH;  ?>themify-icons/css/themify-icons.css" rel="stylesheet" />
    <link href="<?php echo ADMIN_VENDOR_PATH;  ?>animate.css/animate.min.css" rel="stylesheet" />
    <link href="<?php echo ADMIN_VENDOR_PATH;  ?>toastr/toastr.min.css" rel="stylesheet" />
    <link href="<?php echo ADMIN_VENDOR_PATH;  ?>bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="<?php echo ADMIN_VENDOR_PATH;  ?>dataTables/datatables.min.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="<?php echo ADMIN_ASSETS; ?>css/main.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <style>
    .error{color:red;}
    </style>
</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <header class="header">
        <?php $this->load->view(ADMIN_HEADER_PATH); ?>
        </header>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
        <nav class="page-sidebar" id="sidebar">
        <?php $this->load->view(ADMIN_SIDEBAR_PATH); ?>
        </nav>
        <!-- END SIDEBAR-->
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-heading">
                <h1 class="page-title"><?php echo $main_title; ?></h1>
                <!--<ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html"><i class="la la-home font-20"></i></a>
                    </li>
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item">Datatables</li>
                </ol>-->
            </div>
            <div class="page-content fade-in-up">
                <div class="ibox">
                    <div class="ibox-body">
                       
                        <div class="row">
                        <div class="col-md-6">
                        <div class="ibox ibox-fullheight">
                            <div class="ibox-head">
                                <div class="ibox-title"><?php echo $main_title; ?></div>
                            </div>
                            <form class="form-info" action="" id="create_form" enctype="multipart/form-data" name="create_form">
                                <div class="ibox-body">
                                    <div class="row">
                                        <div class="col-sm-6 form-group mb-4">
                                            <label>Weight (Grams) <sup class="error">*</sup></label>
                                            <input class="form-control number_class" type="text" placeholder="200 Grms" name="title" id="title" maxlength="10" autocomplete="off"/>
                                            <div class="error" id="title_error"></div>
                                        </div>
                                        <div class="col-sm-6 form-group mb-4">
                                            <label>Price <sup class="error">*</sup></label>
                                            <input class="form-control number_class" type="text" placeholder="price" name="price" id="price" maxlength="6" autocomplete="off"/>
                                            <div class="error" id="price_error"></div>
                                        </div>

                                       
                                    </div>

                                <div class="ibox-footer hideclass">
                                    <button class="btn btn-info mr-2" type="submit">Submit</button>
                                    <button class="btn btn-secondary" type="reset">Cancel</button>
                                </div>
                                <div class="disp_msg"></div>
                            </form>
                        </div>
                    </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
            <footer class="page-footer">
            <?php $this->load->view(ADMIN_FOOTER_PATH); ?>
        </div>
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
    <!-- PAGE LEVEL PLUGINS-->
    <script src="<?php echo ADMIN_VENDOR_PATH;  ?>dataTables/datatables.min.js"></script>
    <!-- CORE SCRIPTS-->
    <script src="<?php echo ADMIN_JS_PATH;  ?>app.min.js"></script>
    <script src="<?php echo ADMIN_JS_PATH;  ?>project.js"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script>
        $(function() {
            $('#datatable').DataTable({
                pageLength: 10,
                fixedHeader: true,
                responsive: true,
                "sDom": 'rtip'
            });

            var table = $('#datatable').DataTable();
            $('#key-search').on('keyup', function() {
                table.search(this.value).draw();
            });
            $('#type-filter').on('change', function() {
                table.column(6).search($(this).val()).draw();
            });
        });
    </script>
    <script type="text/javascript">
    $('#create_form').on('submit', function (e) {
        e.preventDefault();
        str = true;
        $('#title_error').html('');
        var title= $('#title').val();
        var price= $('#price').val();

        if (title == 0 || title == '') {  $('#title_error').html('Please enter weight');  str = false; }
        if (price == 0 || price == '') {  $('#price_error').html('Please enter price');  str = false; }
        
        if (str == true)
        {

          $('.hideclass').hide();
         $('.disp_msg').html('Please wait....').css({'color': 'blue'});
            $.ajax({
                dataType: "JSON",
                type: "POST",
                data: new FormData(this),
                url: "<?php echo ADMIN_LINK; ?>Settings/insertweight",
                contentType: false,
                cache: false,
                processData: false,
                success: function (s) {
                    //  console.clear()
                    console.log(s);
                    switch (s.code)
                    {
                        case 200:
                            $('.hideclass').hide();
                            $('.disp_msg').html(s.description).css({'color': 'green', 'font-size':
                                        '15px'});
                            setTimeout(function () {
                                window.location = "<?php echo ADMIN_LINK . 'Settings/weight'; ?>";
                            }, 2000);

                            break;
                        case 204:
                            $('.disp_msg').html(s.description).css({
                                'color': 'red', 'font-size':
                                        '15px'});
                            $('.hideclass').show();
                            break;
                        case 575:
                        case 301:
                            $('.disp_msg').html(s.description).css({
                                'color': 'red', 'font-size':
                                        '15px'});
                            $('.hideclass').show();
                            break;
                        case 422:
                            $('.disp_msg').html(s.description).css({
                                'color': 'red', 'font-size':
                                        '15px'});
                            $('.hideclass').show();
                            break;
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