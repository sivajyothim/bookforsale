
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
                                 
                        </ul>
                  </nav>
                  <!--Navigation section module end -->
                  <div class="row">
                  <div class="col-lg-6 col-md-6 pull-right" style="margin-right:-26%">
                  <button  type="button" onclick="activateData(1,'books');" class="btn btn-success statusActivate">Acive</button>
                  <button type="button" onclick="activateData(0,'books');" class="btn btn-danger statusActivate">In-active</button>
                  </div>
                  
                  </div>
                  <!--table content -->
                  <div class="table-responsive">
                  <div class="col-lg-6 col-md-6">
                  <input class="form-control" id="myInput" type="text" placeholder="Search..">
                  
                  </div>
                  <div class="display_message_class"></div>
                
              <table id="mytable" class="table table-bordred table-striped">
                   
                   <thead style="font-weight:bold">
                   
                   <th ><input type="checkbox" id="checkall" /></th>
                   <th class="text-center" colspan="2">Book
                     Name</th>
                     <th>Author</th>
                     <th>Region</th>
                     <th>No.Of Books</th>
                      <th>Selling Price</th>
                      <th>Status</th>
                       <th>Action</th>
                   </thead>
    <tbody>
    <?php
    $book_req = json_decode($book_details);
    if($book_req->code == 200):
        foreach($book_req->book_result as $book_res):
            $bookid=$book_res->book_id;
            $title =ucfirst($book_res->book_title);
            $status_cls=$status='';
            switch($book_res->book_status)
            {
                case 1:$status_cls='success';$status='Live';break;
                case 0:$status_cls='danger';$status='In-active';break;
                case 3:$status_cls='warning';$status='Waiting for Approval';break;
            }
    ?>
    <tr>
    <td><input type="checkbox" name="multiple[]" class="checkthis" value="<?php echo $book_res->book_id; ?>" /></td>
    <td><img style="height:100px;width:100px" class="img-thumbnail"  src="<?php echo PRODUCT_PATH.$book_res->book_image; ?>"  alt="<?php echo $title; ?>" title="<?php echo $title; ?>"/></td>
    <td><?php echo $title; ?></td>
    <td><?php echo $book_res->author_name; ?></td>
    <td><?php echo $book_res->region_name; ?></td>
        <td <?php if($book_res->stock < 1){?>style="background-color:red;"<?php } ?>><?php echo $book_res->stock; ?></td>
    <td>Rs. <?php echo $book_res->selling_price; ?></td>
    
    <td>
    <button type="button" class="btn btn-sm btn-<?php echo $status_cls; ?>"><?php echo $status; ?></button>
    </td>
    <td> <a class="btn btn-primary btn-xs" data-title="Edit" href="<?php echo base_url(); ?>editbook/<?php echo url_title($title);?>/<?php echo base64_encode($book_res->book_id); ?>"><span class="glyphicon glyphicon-pencil"></span></a> 
      <a class="btn btn-danger btn-xs" data-title="Delete" onclick="return confirm('Confirm to delete the Book ?')" href="<?php echo base_url(); ?>Books/deletebook/<?php echo $book_res->book_id; ?>" ><span class="glyphicon glyphicon-trash"></span></a></td>
    </tr>
        <?php endforeach; else:?>
            <tr>
                <td colspan="9" class="alert alert-danger text-center">No results found..!</td>
            </tr>
        <?php endif; ?>
    
   
    
   
    
    </tbody>
        
</table>
                 <!--table content end-->
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
$(document).ready(function(){
$("#mytable #checkall").click(function () {
        if ($("#mytable #checkall").is(':checked')) {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });

        } else {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
    
    // $("[data-toggle=tooltip]").tooltip();
    $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#mytable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});


function activateData(s,t){updateStatus(s,t);}

function updateStatus(s,t)
{
    var data_array=new Array();
    $('input[name="multiple[]"]:checked').each(function(){data_array.push($(this).val());});
    var checklist=""+data_array;
    if(!isNaN(s) && (s=='1' || s=='0' || s=='5') && checklist!='')
    {
        $('.statusActivate,.statusDisable').prop('disabled',true);
         $.ajax({
             dataType:'JSON',
             method:'POST',
             data:JSON.stringify({'table':t,'status':s,'inputdata':checklist}),
             url:'<?php echo base_url();?>Books/booksstatuschange',
             success:function(w){
                 console.log(w);
                    switch(w.code)
                    {
                        case 200:
                            $('.display_message_class').html(w.description).addClass('alert alert-success fade in');
                            break;
                        case 204:
                        case 301:
                        case 422:
                        case 575:
                         $('.display_message_class').html(w.description).addClass('alert alert-danger fade in');
                            break;
                    }
                 setTimeout(function(){window.location=location.href;},3000);
             },
              error:function(e){console.log(e);$('.display_message_class').html(e).addClass('alert alert-warning fade in');}
         });
    }
    else
      {
            $('.display_message_class').html('* Please choose atleast one checkbox').addClass('alert alert-warning fade in');
            setTimeout(function(){$('.display_message_class').html('').removeClass('alert alert-warning fade in');},2000);
       }
}

</script>
</html>