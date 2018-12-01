
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
                                <li class="primary"><a href="<?php echo base_url(); ?>orders">Manage Orders</a></li>
                                <li class="active"><a href="javascript:void(0)"><?php echo $order_num; ?></a></li>
                        </ul>
                  </nav>
                  <!--Navigation section module end -->
                  <div class="row">
                  <div class="clearfix">&nbsp;</div>
                  <?php
				//echo $orders_details;exit;
				        $order_req=  json_decode($orders_details);
                $order_response=$order_req->order_result;
                
                $productsReq = $order_req->order_products;    
                ?>
                  <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <address>
                                <strong><?php echo fetch_ucfirst($order_response->user_name); ?></strong>
                                <br>
                                <?php echo fetch_ucfirst($order_response->phone_number); ?>,
                                <br>
                                <?php echo fetch_ucfirst($order_response->address); ?>,
                                <br>
                                <?php echo fetch_ucfirst($order_response->area); ?>,
                                <p><?php echo fetch_ucfirst($order_response->city); ?>, <?php echo fetch_ucfirst($order_response->state); ?></p>
                                <p><?php echo fetch_ucfirst($order_response->country); ?>, <?php echo fetch_ucfirst($order_response->pincode); ?></p>
                            </address>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                            <p><b>No.of items&nbsp;:&nbsp;</b><?php echo $order_response->cart_item_count; ?></p>
                            <p>
                                <em><b>Ordered Date&nbsp;:&nbsp;</b> <?php echo date('d M, Y ',strtotime($order_response->created_on)); ?></em>
                            </p>
                            <p>
                                <b><em>Order Num #&nbsp;:&nbsp;</b> <?php echo $order_response->order_num; ?></em>
                            </p>
                            <p>
                                <b><em>Order Price&nbsp;:&nbsp;</b> Rs. <?php echo $order_response->order_total; ?></em>
                            </p>
                        </div>
                    </div>
                    <div class="clerfix"></div>
                    <hr>
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
                     <th>Product</th>
                     <th>Product Name</th>
                     <th>Price (<i class="fa fa-inr"></i>)</th>
                     <th>Qty</th>
                     <th>Shipping (<i class="fa fa-inr"></i>)</th>
                     <th>Sub Total (<i class="fa fa-inr"></i>)</th>
                   
                   </thead>
    <tbody>
    <?php
    if($productsReq->code==SUCCESS_CODE){ 
        $sno=1; foreach($productsReq->product_result as $product_response){
            $product_name=  fetch_ucwords($product_response->book_title);
            $product_id=$product_response->product_id;
            $product_link=base_url().'details/'.url_title($product_name).'/'.base64_encode($product_id);
        ?>
        <tr>
                <td><?php echo $sno; ?></td>
                <td><img src="<?php echo PRODUCT_PATH.$product_response->book_image; ?>" width="70" height="70" /></td>
            <td><a href="<?php echo $product_link; ?>">&nbsp;&nbsp;<?php echo substr($product_name,0,30); ?>s</td>
            <td><?php echo $product_response->product_price; ?></td>
            <td><?php echo $product_response->product_qty; ?></td>
            <td>Rs.<?php echo $product_response->deliver_chage; ?></td>
            <td>Rs.<?php echo $product_response->cart_price; ?></td>
            
            
        </tr>
        <?php $sno++; } } else{ ?>
        <td colspan="7"><div class="alert alert-danger text-center">No results found..!</div></td>
        <?php } ?>
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
</script>
</html>