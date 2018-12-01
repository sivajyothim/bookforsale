<?php
$user_login='';
if($this->userid= $this->session->userdata(USER_SESS_CODE.'userid')!='')
{
    $user_login=$this->userid= $this->session->userdata(USER_SESS_CODE.'userid');
}
?>
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
                <span>Cart</span>
            </li>
        </ul>
        <h1 class="main-ttl"><span>Cart</span></h1>
        <!-- Cart Items - start -->
        <form action="#">

            <div class="cart-items-wrap">
                <table class=" table table-responsive table-border">
                    <thead>
                    <tr>
                        <td class="cart-image">Photo</td>
                        <td class="cart-ttl">Products </td>
                        <td class="cart-price">Price</td>
                        <td class="cart-quantity">Quantity</td>
                        <td class="cart-summ">Sub Total</td>
                        <td class="cart-del">Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $cartReq = json_decode($checkout_details);
                    if($cartReq->code==SUCCESS_CODE){
                        foreach($cartReq->cart_result as $cart_res){
                            $cartid = $cart_res->cart_id;
                            $product_name = $cart_res->book_title;
                            $cartid=  $cart_res->cart_id;
                            $product_link = base_url().'details/'.url_title($product_name).'/'.base64_encode($cart_res->product_id);
                    ?>
                    <tr>
                        <td class="cart-image">
                            <a href="<?php echo $product_link; ?>">
                                <img src="<?php echo PRODUCT_PATH.$cart_res->book_image; ?>" style="height:61px;width:80px" alt="Similique delectus totam">
                            </a>
                        </td>
                        <td class="cart-price">
                            <a href="<?php echo $product_link; ?>"><?php echo $product_name; ?></a>
                            
                        </td>
                        <td class="cart-price">
                            <b>Rs.<?php echo $cart_res->product_price; ?></b>
                        </td>
                        <td class="cart-price">
                            <b><?php echo $cart_res->product_qty; ?></b>
                        </td>
                        
                        <td class="cart-summ">
                            <b>Rs. <?php echo ($cart_res->cart_price); ?></b>
                            <p>Deliver Charge : <?php echo ($cart_res->product_delivercharge); ?> </p>
                        </td>
                        <td >
                            <a onclick="return confirm('confirm to delete ?')" href="<?php echo base_url(); ?>deletecart/<?php echo $cartid; ?>">Remove Book</a>
                        </td>
                    </tr>
                        <?php } } else { ?>
                        <tr>
                        <td colspan="6"><div class="alert alert-danger text-center">No Books  found in your cart. Please add ..!</div></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php
            $statistics = json_decode($cart_details);
            
            ?>
            <div class="col-lg-4  pull-right">
            <table class="table-responsive">
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
                <tr>
                    <td>Total :</td>
                    <td>Rs.<?php echo $statistics->total; ?></td>
                </tr>
            </table>
            </div>
            
            <div class="cart-submit" style="display:none">
                <div class="cart-coupon">
                    <input placeholder="your coupon" type="text">
                    <a class="cart-coupon-btn" href="#"><img src="img/ok.png" alt="your coupon"></a>
                </div>
                
            </div>
            <div class="clearfix">&nbsp;</div>
            <div class="cart-submit pull-right">
                <?php
               //print_r($this->session->all_userdata());
                ?>
                <?php
                if($user_login!=''){
                ?>
                <a href="<?php echo base_url(); ?>shipping" class="cart-submit-btn">Checkout</a>
                <?php } else { ?>
                <a href="<?php echo base_url(); ?>signup" class="cart-submit-btn">Checkout</a>
                <?php } ?>
                <a href="<?php echo base_url(); ?>clearcart" onclick="return confirm('Confirm to clear the cart data ?')" class="cart-clear">Clear cart</a>
            </div>
        </form>
        <!-- Cart Items - end -->

    </section>
</main>
<!-- Main Content - end -->


<!-- Footer - start -->
<footer class="footer-wrap">
<?php $this->load->view(FOOTER_PATH); ?>

</footer>
<!-- Footer - end -->



</body>
</html>