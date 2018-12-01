
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
                                <li class="completed"><a href="<?php echo base_url(); ?>profile"><i class="fa fa-user-circle"></i>&nbsp;Profile</a></li>
                                <li class="active"><a href="<?php echo base_url(); ?>managebooks"><i class="fa fa-book"></i>&nbsp;Books</a></li>
                                <li><a href="javascript:void(0);"><i class="fa fa-plus-circle"></i>&nbsp;Crate Book</a></li>
                        </ul>
                  </nav>
                  <!--Navigation section module end -->
                  <!-- Forms module section code start -->
            <form action="" method="post" id="create_form" enctype="multipart/form-data" >
            <h3>Basic Details</h3><hr>
                  <!--section start -->
                  <div class="row">
                        
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="email">Menu<sup class="error">*</sup>:</label>
                                <select name="menu" id="menu" class="form-control" onchange="getSubGroups(this.value)">
                                <option value="0">Choose Menu</option>
                                <?php
                                $menu_req=json_decode($menu_details);
                                if($menu_req->code==200):
                                    foreach($menu_req->menu_result as $menu_res):
                                ?>
                                <option value="<?php echo $menu_res->id; ?>"><?php echo $menu_res->menu_title; ?></option>
                                <?php endforeach; endif; ?>
                                </select>
                            </div>
                            <div class="error" id="menu_error"></div>
                        </div>

                       <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="email">Sub group<sup class="error">*</sup>:</label>
                                <select name="subgroup" id="subgroup" class="form-control" onchange="updateCourseYear(this.value)">
                                <option value="0">Choose Sub group</option>
                                 </select>
                            </div>
                            <div class="error" id="subgroup_error"></div>
                        </div>
                       
                  </div>
            <!--section end -->
            <!-- Section start  -->
            <div class="row">
            <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="email">Book Title<sup class="error">*</sup>:</label>
                                <input type="text" class="form-control" id="title" name="title" maxlength="100" placeholder="Enter Title" autocomplete="off"/>
                            </div>
                            <div class="error" id="title_error"></div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="email">Year<sup class="error">*</sup>:</label>
                                <select name="courseyear" id="courseyear" class="form-control">
                                <option value="0">Choose Course year</option>
                                 </select>
                            </div>
                            <div class="error" id="courseyear_error"></div>
                        </div>
            </div>
            <!-- Section end -->
              <!--section start -->
              <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="email">Region/Universiry<sup class="error">*</sup>:</label>
                                <select name="region" id="region" class="form-control">
                                <option value="0">Choose Region</option>
                                <?php
                                $region_req=json_decode($region_details);
                                if($region_req->code==200):
                                    foreach($region_req->region_result as $region_res):
                                ?>
                                <option value="<?php echo $region_res->id; ?>"><?php echo $region_res->submenu_title; ?></option>
                                <?php endforeach; endif; ?>
                                </select>
                            </div>
                            <div class="error" id="region_error"></div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="email">Region/Universiry Name <sup class="error">*</sup>:</label>
                                <input type="text" class="form-control" id="region_name" name="region_name" maxlength="80" placeholder="Enter Region name" autocomplete="off"/>
                            </div>
                            <div class="error" id="region_name_error"></div>
                        </div>
                  </div>
            <!--section end -->

             <!--section start -->
             <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="email">Author <sup class="error">*</sup>:</label>
                                <input type="text" class="form-control" id="author" name="author" maxlength="60" placeholder="Enter Author" autocomplete="off"/>
                            </div>
                            <div class="error" id="author_error"></div>
                        </div>                
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="email">Published Year<sup class="error">*</sup>:</label>
                                <input type="text" class="form-control" id="published_year" name="published_year" maxlength="12" placeholder="2017-2018" autocomplete="off"/>
                            </div>
                            <div class="error" id="published_year_error"></div>
                        </div>
                        
                  </div>
            <!--section end -->

             <!--section start -->
             <div class="row">
                        
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="email">Medium / Language<sup class="error">*</sup>:</label>
                                <select name="language" id="language" class="form-control">
                                <option value="0">Choose Language</option>
                                <?php
                                $language_req=json_decode($language_details);
                                if($language_req->code==200):
                                    foreach($language_req->language_result as $language_res):
                                ?>
                                <option value="<?php echo $language_res->id; ?>"><?php echo $language_res->language; ?></option>
                                <?php endforeach; endif; ?>
                                </select>
                            </div>
                            <div class="error" id="language_error"></div>
                        </div>

                       <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="email">Book Age <sup class="error">*</sup>:</label>
                                <input type="text" class="form-control" id="age" name="age" maxlength="15" placeholder="1 Year / New etc" autocomplete="off"/>
                            </div>
                            <div class="error" id="age_error"></div>
                        </div>
                       
                  </div>
            <!--section end -->
            <h3>Inventory Details</h3><hr>
              <!--section start -->
              <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="email">MRP <sup class="error">*</sup>:</label>
                                <input type="text" class="form-control number_class" id="mrp" name="mrp" maxlength="20" placeholder="Enter MRP" autocomplete="off"/>
                            </div>
                            <div class="error" id="mrp_error"></div>
                        </div>                
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="email">Selling Price<sup class="error">*</sup>:</label>
                                <input type="text" class="form-control number_class" id="selling_price" name="selling_price" maxlength="12" placeholder="Selling Price" autocomplete="off"/>
                            </div>
                            <div class="error" id="selling_price_error"></div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="email">No of Books<sup class="error">*</sup>:</label>
                                <input type="text" class="form-control number_class" id="stock" name="stock" maxlength="12" placeholder="No.of books" autocomplete="off"/>
                            </div>
                            <div class="error" id="stock_error"></div>
                        </div>
                        
                  </div>
            <!--section end -->
             <!--section start -->
             <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="email">Length<sup class="error">*</sup>:</label>
                                <input type="text" class="form-control number_class" id="length" name="length" maxlength="12" placeholder="Length" autocomplete="off"/>
                            </div>
                            <div class="error" id="length_error"></div>
                        </div> 
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="email">Width<sup class="error">*</sup>:</label>
                                <input type="text" class="form-control number_class" id="width" name="width" maxlength="12" placeholder="Width" autocomplete="off"/>
                            </div>
                            <div class="error" id="width_error"></div>
                        </div>
                       <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <label for="email">Height<sup class="error">*</sup>:</label>
                                <input type="text" class="form-control number_class" id="height" name="height" maxlength="20" placeholder="Height" autocomplete="off"/>
                            </div>
                            <div class="error" id="height_error"></div>
                        </div>     
                        
                  </div>
            <!--section end -->
             <!--section start -->
             <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="email">Book Weight (Grms)<sup class="error">*</sup>:</label>
                                <input type="text" class="form-control number_class" id="book_weight" name="book_weight" maxlength="20" placeholder="Wight of book - 200 Grms" autocomplete="off"/>
                            </div>
                            <div class="error" id="mrp_error"></div>
                        </div>                
                        
                        
                  </div>
            <!--section end -->
            <h3>General Details</h3><hr>
            <div class="row">
            <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="email">About Book<sup class="error"></sup>:</label>
                                <textarea class="form-control" id="description" name="description"  placeholder="Description" autocomplete="off"></textarea>
                                <br>Note : Mobile number & Email ids are not allowed  in About Book.
                            </div>
                            <div class="error" id="description_error"></div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label for="email">Upload Image<sup class="error">*</sup>:</label>
                                <input type="file" class="form-control" id="book_image" name="book_image" accept="image/*"/>
                            </div>
                            <div class="error" id="book_image_error"></div>
                        </div>    
            </div>

            <!-- Button section start -->
            <div class="row">
            <div class="col-lg-6 loadingSection"></div>                    
                    <div class="col-lg-6 btn_class ">
                    <button class="btn btn-primary pull-right">Create Book</button>
                    </div>
            </div>
            <!-- Button section end -->
            </form>
                  <!-- Forms module section code end -->
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
        $('#menu_error,#region_error,#region_name_error,#title_error,#published_year_error,#age_error,#language_error,#mrp_error,#selling_price_error,#stock_error,#length_error,#width_error,#height_error,#book_weight_error,#description_error,#book_image_error').html('');
        
        let menu = $('#menu').val();
        let subgroup = $('#subgroup').val();
        let courseyear = $('#courseyear').val();
        let region = $('#region').val();
        let region_name = $('#region_name').val();
        let title = $('#title').val();
        let published_year = $('#published_year').val();
        let age = $('#age').val();
        let language = $('#language').val();
        let mrp = $('#mrp').val();
        let selling_price = $('#selling_price').val();
        let stock = $('#stock').val();
        let length = $('#length').val();
        let width = $('#width').val();
        let height = $('#height').val();
        let book_weight = $('#book_weight').val();
        let description = $('#description').val();
        let book_image = $('#book_image').val();
        let author = $('#author').val();
         

        if(menu=='' || menu=='0'){str=false;$('#menu_error').html('Please choose menu');}
        if(subgroup=='' || subgroup=='0'){str=false;$('#subgroup_error').html('Please choose subgroup');}
       // if(courseyear=='' || courseyear=='0'){str=false;$('#courseyear_error').html('Please choose year');}
        if(region=='' || region=='0'){str=false;$('#region_error').html('Please choose region');}
        if(region_name==''){str=false;$('#region_name_error').html('Please enter region name');}
        if(title==''){str=false;$('#title_error').html('Please enter book title');}
        //if(published_year==''){str=false;$('#published_year_error').html('Please enter published year');}
        if(age==''){str=false;$('#age_error').html('Please enter age');}
        if(language=='' || language=='0'){str=false;$('#language_error').html('Please choose language');}
        if(mrp==''){str=false;$('#mrp_error').html('Please enter MRP');}
        if(selling_price==''){str=false;$('#selling_price_error').html('Please enter selling price');}
        if(stock==''){str=false;$('#stock_error').html('Please enter stock');}
        if(length==''){str=false;$('#length_error').html('Please enter book length');}
        if(width==''){str=false;$('#width_error').html('Please enter width');}
        if(height==''){str=false;$('#height_error').html('Please enter height');}
        if(book_weight=='' || book_weight=='0'){str=false;$('#book_weight_error').html('Please enter weight');}
        if(book_image==''){str=false;$('#book_image_error').html('Please upload book image');}
        if(author==''){str=false;$('#author_error').html('Please enter author name');}
    
       
        if (str == true)
        {
           
            $('.btn_class').hide('');
            $('.loadingSection').html('Please wait...').css({'color': 'blue'});

            $.ajax({
                dataType: "JSON",
                type: "POST",
                data: new FormData(this),
                url: "<?php echo base_url(); ?>Books/insertBook",
                contentType: false,
                cache: false,
                processData: false,
                success: function (s) {
                    //alert(s.description);
                    console.log(s);
                    if (s.code == 200)
                    {
                        $('.loadingSection').html(s.description).css({'color': 'green'});
                        setTimeout(function () {
                            window.location = "<?php echo base_url(); ?>managebooks";
                        }, 2000);
                    }
                    else
                    {
                        $('.loadingSection').html(s.description).css({'color': 'red'});
                        $('.btn_class').show('');
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
<script type="text/javascript">
function getSubGroups(menuid)
{
    let html='';
            $.ajax({
                    dataType: 'JSON',
                    type: 'post',
                    data:{'menuid':menuid},
                    url: "<?php echo base_url(); ?>User/subgrouplist/"+menuid,
                    success: function (s) 
                    {   
                        console.log(s);
                        html += '<option value="0">Choose Sub group</option>';
                        if (s.code == 200)
                        {
                            var data = s.subgrop_result;
                            console.log(data);
                            for (var i = 0, len = s.subgrop_result.length; i < len; ++i) 
                            {
                                dispdata= data[i]['subgroup_id'];
                                html += '<option data-courseyear="' + data[i]['years'] + '" value="' + dispdata + '">' + data[i]['subgroup_title'] + '</option>';
                            }
                        }
                        else
                        {
                            html += '<option value="">No results found</option>';
                        }
                        console.log(html);
                        $('#subgroup').html(html);
                    },
                    error:function(e){console.log(s); }
            });
}

function updateCourseYear(subid)
{
    let html='';
    html += '<option value="0">Choose Year</option>';
    let year = $("#subgroup option:selected").attr('data-courseyear');
    if(year > 0)
    {
        for (var i = 1, len = year; i <= len; ++i) 
        {
            
            html += '<option  value="' + i + '">' +i+ ' - year</option>';
        }
        $('#courseyear').html(html);
    }
}
</script>
</html>