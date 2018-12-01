
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
                                <li class="active"><a href="<?php echo base_url(); ?>"><i class="fa fa-book"></i>&nbsp;Manage Transactions</a></li>
                                 
                        </ul>
                  </nav>
                  <!--Navigation section module end -->
                  <div class="row">
                  
                  </div>
                  <!--table content -->
                  <div class="table-responsive">
                  <div class="col-lg-6 col-md-6 pull-right">
                  <input class="form-control" id="myInput" type="text" placeholder="Search..">
                  <div class="clearfix">&nbsp;</div>  
                  </div>
                  <div class="display_message_class"></div>
                
              <table id="mytable" class="table table-bordred table-striped">
                   
                   <thead style="font-weight:bold">
                   <th>S.No</th>
                   <th class="text-center" >order No</th>
                     <th>Order Amount</th>
                     <th>Received Amount</th>
                     <th>Order Status</th>
                     <th>Payment Status</th>
                     <th>Created On</th>
                   </thead>
    <tbody>
    <?php
    $order_req = json_decode($transaction_details);
    if($order_req->code == 200):
        $sno=1;foreach($order_req->order_result as $order_res):
            $order_link = base_url().'orderdetails/'.url_title($order_res->order_num).'/'.base64_encode($order_res->order_id);
    ?>
    <tr>
            <td><?php echo $sno; ?></td>
        <td><?php echo $order_res->order_num; ?></td>
        <td><?php echo $order_res->cart_item_count; ?></td>
        <td>Rs.<?php echo $order_res->order_total; ?></td>
        <td><?php echo $order_res->order_status_message; ?></td>
        <td><?php echo date('d-M-Y, h:i',strtotime($order_res->created_on)); ?></td>
        <td><?php echo ($order_res->order_status ==6)?date('d-M-Y, h:i',strtotime($order_res->delivered_on)):'--'; ?></td>
        <td><a href="<?php echo $order_link; ?>" class="btn btn-sm btn-success">View Order Details</a></td>
        
    </tr>
        <?php $sno++; endforeach;else: ?>
            <tr>
                <td colspan="8" class="alert alert-danger text-center">No results found..!</td>
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