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

</head>
<body>
<!-- Header - start -->
<header class="header">

   <?php $this->load->view(HEADER_PATH); ?>

</header>
<!-- Header - end -->


<!-- Main Content - start -->
<main>
    <section class="container">


        <!-- Slider -->
        <div class="fr-slider-wrap">
            <div class="fr-slider">
                <ul class="slides">
                    <?php $sliderReq = json_decode($slider_details);
                    if($sliderReq->code == SUCCESS_CODE):
                        foreach($sliderReq->slider_result as $sliderRes):
                    ?>
                    <li>
                        <img style="height:500px;width:100%" src="<?php echo SLIDER_PATH.$sliderRes->slider_picture;  ?>" alt="">
                        <div class="fr-slider-cont">
                            <h3></h3>
                            <p> </p>
                            <!-- <p class="fr-slider-more-wrap">
                                <a class="fr-slider-more" href="#"></a>
                            </p> -->
                        </div>
                    </li>
                        <?php endforeach; endif; ?>
                </ul>
            </div>
        </div>


        <!-- Popular Products -->
        <?php $book_req = json_decode($book_details);
if($book_req->code == 200 ){
    $i=0;
    foreach($book_req->menu_products as $menu_res){
    ?>
        <div class="fr-pop-wrap">

            <h3 class="component-ttl"><span><?php echo $menu_res->menu_title; ?> </span></h3>

            

            <div class="fr-pop-tab-cont">

                <p data-frpoptab-num="1" class="fr-pop-tab-mob active" data-frpoptab="#frpoptab-tab-1">All Categories</p>
                <div class="flexslider prod-items fr-pop-tab" id="frpoptab-tab-<?php echo $i;?>">

                    <ul class="slides">
<!--looping start -->
<?php
    foreach($menu_res->products as $book_res){
        $book_id = $book_res->book_id;
        $book_name = fetch_ucfirst($book_res->book_title);
        $book_link = base_url().'details/'.url_title($book_name).'/'.base64_encode($book_id);
?>
                        <li class="prod-i">
                            <div class="prod-i-top">
                                <a href="product.html" class="prod-i-img"><!-- NO SPACE --><img src="<?php echo PRODUCT_PATH.$book_res->book_image; ?>" alt="<?php echo $book_name; ?>"><!-- NO SPACE --></a>
                                <p class="prod-i-info">
                                    <a href="javascript:void(0)" onclick="addToWishList('<?php echo $book_id; ?>')" class="prod-i-favorites"><span>Wishlist</span><i class="fa fa-heart"></i></a>
                                    <!-- <a href="<?php echo $book_link; ?>" class="qview-btn prod-i-qview"><span>Quick View</span><i class="fa fa-search"></i></a> -->
                                     
                                </p>
                                <p class="prod-i-addwrap">
                                    <a href="<?php echo $book_link; ?>" class="prod-i-add">Go to detail</a>
                                </p>
                            </div>
                            <h3>
                                <a href="<?php echo $book_link; ?>"><?php echo $book_name; ?></a>
                            </h3>
                            
                            <p class="prod-i-price">
    <b>Rs. <?php echo $book_res->selling_price; ?> <?php if($book_res->selling_price < $book_res->mrp) {?>(<strike><?php echo $book_res->mrp; ?></strike>)<?php } ?></b>
                            </p>
                            
                        </li>
<?php } ?>
<!--looping end -->
                    </ul>


                </div>
    <?php $i++; } } ?>
                
            </div><!-- .fr-pop-tab-cont -->
 <div class="banner-bottom">
        <img src="<?php echo ADDS_PATH.'banner_hor.png';?>"/>
        </div>

        </div><!-- .fr-pop-wrap -->


         
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