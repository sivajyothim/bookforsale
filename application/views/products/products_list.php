
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="format-detection" content="telephone=no">
        <title><?php echo $url_title; ?></title>

        <link href="https://fonts.googleapis.com/css?family=PT+Serif:400,400i,700,700ii%7CRoboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic" rel="stylesheet">

        <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH; ?>font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH; ?>bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH; ?>ion.rangeSlider.css">
        <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH; ?>ion.rangeSlider.skinFlat.css">
        <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH; ?>jquery.bxslider.css">
        <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH; ?>jquery.fancybox.css">
        <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH; ?>flexslider.css">
        <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH; ?>swiper.css">
        <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH; ?>swiper.css">
        <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH; ?>style.css">
        <link rel="stylesheet" href="<?php echo FRONT_CSS_PATH; ?>media.css">

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


                <ul class="b-crumbs">
                    <li>
                        <a href="<?php echo base_url(); ?>">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <?php echo $menu; ?>
                        </a>
                    </li>

                </ul>
                <h1 class="main-ttl"><span><?php echo $menu; ?></span></h1>
                <!-- Catalog Sidebar - start -->
                <div class="section-sb">

                    <!-- Catalog Categories - start -->
                    <div class="section-sb-current">
                        
                        <ul class="section-sb-list" id="section-sb-list">
                            
                            <?php
                            $header_menu_req = json_decode($header_menu);
                            if ($header_menu_req->code == SUCCESS_CODE) {
                                foreach ($header_menu_req->menu_result as $menu_res) {
                                     $menulink = base_url() . 'menu/' . url_title($menu_res->menu_title) . '/' . base64_encode($menu_res->menu_id);
                                    ?>
                                    <li class="categ-1 has_child">
                                        <a href="<?php echo $menulink; ?>">
                                            <span class="categ-1-label"><?php echo fetch_ucfirst($menu_res->menu_title); ?></span>
                                            <span class="section-sb-toggle"><span class="section-sb-ico"></span></span>
                                        </a>
                                        <ul>
                                            <?php
                                            foreach ($menu_res->submenu as $sub_res) {
                                                $submenulink = base_url() . 'submenu/' . url_title($sub_res->subgroup_title) . '/' . base64_encode($sub_res->subgroup_id);
                                                ?>
                                                <li class="categ-2">
                                                    <a href="<?php echo $submenulink; ?>">
                                                        <span class="categ-2-label"><?php echo fetch_ucfirst($sub_res->subgroup_title); ?></span>
                                                    </a>
                                                </li>
                                            <?php } ?>

                                        </ul>
                                    </li>
                                <?php }
                            } ?>

                        </ul>
                    </div>
                    <!-- Catalog Categories - end -->

                    <!-- Filter - start -->
                    <div class="section-filter">
                        <button id="section-filter-toggle" class="section-filter-toggle" data-close="Hide Filter" data-open="Show Filter">
                            <span>Show Filter</span> <i class="fa fa-angle-down"></i>
                        </button>
                        <div class="section-filter-cont">
<!--                            <div class="section-filter-price">
                                <div class="range-slider section-filter-price" data-min="0" data-max="1000" data-from="200" data-to="800" data-prefix="$" data-grid="false"></div>
                            </div>-->
                            <div class="section-filter-item opened">
                                <p class="section-filter-ttl">Region / University <i class="fa fa-angle-down"></i></p>
                                <div class="section-filter-fields">
                                    <p class="section-filter-field">
                                        <input id="section-filter-checkbox2-1" value="on" type="checkbox">
                                        <label class="section-filter-checkbox" for="section-filter-checkbox2-1">University</label>
                                    </p>
                                    <p class="section-filter-field">
                                        <input id="section-filter-checkbox2-2" value="on" type="checkbox">
                                        <label class="section-filter-checkbox" for="section-filter-checkbox2-2">Region</label>
                                    </p>
                                    
                                    
                                </div>
                            </div>
<div class="section-filter-item " style="display:none">
                                <p class="section-filter-ttl">Material <i class="fa fa-angle-down"></i></p>
                                <div class="section-filter-fields">
                                    <p class="section-filter-field">
                                        <input id="section-filter-checkbox3-1" value="on" type="checkbox">
                                        <label class="section-filter-checkbox" for="section-filter-checkbox3-1">Cotton</label>
                                    </p>
                                    <p class="section-filter-field">
                                        <input id="section-filter-checkbox3-2" value="on" type="checkbox">
                                        <label class="section-filter-checkbox" for="section-filter-checkbox3-2">Spandex</label>
                                    </p>
                                    <p class="section-filter-field">
                                        <input id="section-filter-checkbox3-3" value="on" type="checkbox">
                                        <label class="section-filter-checkbox" for="section-filter-checkbox3-3">Polyester</label>
                                    </p>
                                    <p class="section-filter-field">
                                        <input id="section-filter-checkbox3-4" value="on" type="checkbox">
                                        <label class="section-filter-checkbox" for="section-filter-checkbox3-4">Acetate</label>
                                    </p>
                                    <p class="section-filter-field">
                                        <input id="section-filter-checkbox3-5" value="on" type="checkbox">
                                        <label class="section-filter-checkbox" for="section-filter-checkbox3-5">Microfiber</label>
                                    </p>
                                    <p class="section-filter-field">
                                        <input id="section-filter-checkbox3-6" value="on" type="checkbox">
                                        <label class="section-filter-checkbox" for="section-filter-checkbox3-6">Silk</label>
                                    </p>
                                    <p class="section-filter-field">
                                        <input id="section-filter-checkbox3-7" value="on" type="checkbox">
                                        <label class="section-filter-checkbox" for="section-filter-checkbox3-7">Fur</label>
                                    </p>
                                </div>
                            </div>








                        </div>
                    </div>
                    <!-- Filter - end -->

                </div>
                <!-- Catalog Sidebar - end -->
                <!-- Catalog Items | List V1 - start -->
                <div class="section-cont">

                    <!-- Catalog Topbar - start -->
                    <div class="section-top">

                        <!-- View Mode -->
                        <!-- <ul class="section-mode">
                                <li class="section-mode-gallery"><a title="View mode: Gallery" href="catalog-gallery.html"></a></li>
                                <li class="section-mode-list active"><a title="View mode: List" href="catalog-list.html"></a></li>
                                <li class="section-mode-table"><a title="View mode: Table" href="catalog-table.html"></a></li>
                        </ul> -->

                        <!-- Sorting -->
                        <!-- <div class="section-sortby">
                                <p>default sorting</p>
                                <ul>
                                        <li>
                                                <a href="#">sort by popularity</a>
                                        </li>
                                        <li>
                                                <a href="#">low price to high</a>
                                        </li>
                                        <li>
                                                <a href="#">high price to low</a>
                                        </li>
                                        <li>
                                                <a href="#">by title A <i class="fa fa-angle-right"></i> Z</a>
                                        </li>
                                        <li>
                                                <a href="#">by title Z <i class="fa fa-angle-right"></i> A</a>
                                        </li>
                                        <li>
                                                <a href="#">default sorting</a>
                                        </li>
                                </ul>
                        </div> -->

                        <!-- Count per page -->
                        <!-- <div class="section-count">
                                <p>12</p>
                                <ul>
                                        <li><a href="#">12</a></li>
                                        <li><a href="#">24</a></li>
                                        <li><a href="#">48</a></li>
                                </ul>
                        </div> -->

                    </div>
                    <!-- Catalog Topbar - end -->
                    <div class="prod-items section-items">
                        <!--Loop code start -->
                        <?php
                        $book_req = json_decode($book_details);
                        if ($book_req->code == SUCCESS_CODE) {
                            foreach ($book_req->product_result as $book_res) {
                                $book_id = $book_res->book_id;
                                $book_name = fetch_ucfirst($book_res->book_title);
                                $desclink = base_url() . 'details/' . url_title($book_name) . '/' . base64_encode($book_id);
                                ?>
                                <div class="prodlist-i">
                                    <a class="prodlist-i-img" href="<?php echo $desclink; ?>"><!-- NO SPACE --><img src="<?php echo PRODUCT_PATH . $book_res->book_image; ?>" style="height:300px;width:366px" alt="Nulla numquam obcaecati"><!-- NO SPACE --></a>
                                    <div class="prodlist-i-cont">
                                        <h3><a href="<?php echo $desclink; ?>"><?php echo $book_name; ?></a></h3>
                                        <div class="prodlist-i-txt">
        <?php echo ucfirst(substr($book_res->description, 0, 120)); ?></div>
                                        <br/>
                                        <div class="prodlist-i-action">

                                            <p class="prodlist-i-addwrap">
                                                <a href="javascript:void(0)" onclick="addToCart('<?php echo $book_id; ?>')" class="prodlist-i-add">Add to cart</a>
                                            </p>
                                            <span class="prodlist-i-price">
                                                <b>Rs.<?php echo $book_res->selling_price; ?><?php if ($book_res->selling_price < $book_res->mrp) { ?>(<strike><?php echo $book_res->mrp; ?></strike>)<?php } ?></b>
                                            </span>
                                        </div>
                                        <p class="prodlist-i-info">
                                            <a href="javascript:void(0)" onclick="addToWishList('<?php echo $book_id; ?>')" class="prodlist-i-favorites"><i class="fa fa-heart"></i> Add to wishlist</a>
                                            <a href="<?php echo $desclink; ?>" class="prodlist-i-favorites"><i class="fa fa-search"></i> View Details</a>
                                            

                                        </p>
                                    </div>

                                    <div class="prodlist-i-props-wrap">
                                        <ul class="prodlist-i-props">
                                            <li><b>Year&nbsp;:&nbsp;</b> <?php echo ($book_res->published_year != '') ? $book_res->published_year : '-'; ?></li>
                                            <li><b>Region / University&nbsp;:&nbsp;</b><?php echo ($book_res->region_name != '') ? fetch_ucfirst($book_res->region_name) : '-'; ?></li>
                                            <li><b>Medium&nbsp;:&nbsp;</b> <?php echo ($book_res->language != '') ? $book_res->language : '-'; ?></li>
                                            <li><b>Author&nbsp;:&nbsp;</b><?php echo ($book_res->author_name != '') ? $book_res->author_name : '-'; ?></li>
                                            <li><b>Published Year&nbsp;:&nbsp;</b> <?php echo ($book_res->published_year != '') ? $book_res->published_year : '-'; ?></li>
                                            <li><b>Book Age&nbsp;:&nbsp;</b> <?php echo ($book_res->book_age != '') ? $book_res->book_age : '-'; ?></li>
                                            <li><b>Available Stock&nbsp;:&nbsp;</b><?php echo ($book_res->stock != '') ? $book_res->stock : '-'; ?></li>

                                        </ul>
                                    </div>
                                </div>
                            <?php }
                        } else {
                            ?>
                            <div class="alert alert-danger text-center">No results Found..!</div>
<?php }
?>
                        <!--Loop code end -->
                    </div>

                    <!-- Pagination - start -->
                    <ul class="pagi hide">
                        <li class="active"><span>1</span></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li class="pagi-next"><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
                    </ul>
                    <!-- Pagination - end -->
                </div>

                <!-- Quick View Product - start -->
                <div class="qview-modal">
                    <div class="prod-wrap">
                        <a href="product.html">
                            <h1 class="main-ttl">
                                <span>Reprehenderit adipisci</span>
                            </h1>
                        </a>
                        <div class="prod-slider-wrap">
                            <div class="prod-slider">
                                <ul class="prod-slider-car">
                                    <li>
                                        <a data-fancybox-group="popup-product" class="fancy-img" href="http://placehold.it/500x525">
                                            <img src="http://placehold.it/500x525" alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a data-fancybox-group="popup-product" class="fancy-img" href="http://placehold.it/500x591">
                                            <img src="http://placehold.it/500x591" alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a data-fancybox-group="popup-product" class="fancy-img" href="http://placehold.it/500x525">
                                            <img src="http://placehold.it/500x525" alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a data-fancybox-group="popup-product" class="fancy-img" href="http://placehold.it/500x722">
                                            <img src="http://placehold.it/500x722" alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a data-fancybox-group="popup-product" class="fancy-img" href="http://placehold.it/500x722">
                                            <img src="http://placehold.it/500x722" alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a data-fancybox-group="popup-product" class="fancy-img" href="http://placehold.it/500x722">
                                            <img src="http://placehold.it/500x722" alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a data-fancybox-group="popup-product" class="fancy-img" href="http://placehold.it/500x722">
                                            <img src="http://placehold.it/500x722" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="prod-thumbs">
                                <ul class="prod-thumbs-car">
                                    <li>
                                        <a data-slide-index="0" href="#">
                                            <img src="http://placehold.it/500x525" alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a data-slide-index="1" href="#">
                                            <img src="http://placehold.it/500x591" alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a data-slide-index="2" href="#">
                                            <img src="http://placehold.it/500x525" alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a data-slide-index="3" href="#">
                                            <img src="http://placehold.it/500x722" alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a data-slide-index="4" href="#">
                                            <img src="http://placehold.it/500x722" alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a data-slide-index="5" href="#">
                                            <img src="http://placehold.it/500x722" alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a data-slide-index="6" href="#">
                                            <img src="http://placehold.it/500x722" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="prod-cont">
                            <p class="prod-actions">
                                <a href="#" class="prod-favorites"><i class="fa fa-heart"></i> Add to Wishlist</a>
                                <a href="#" class="prod-compare"><i class="fa fa-bar-chart"></i> Compare</a>
                            </p>
                            <div class="prod-skuwrap">
                                <p class="prod-skuttl">Color</p>
                                <ul class="prod-skucolor">
                                    <li class="active">
                                        <img src="img/color/blue.jpg" alt="">
                                    </li>
                                    <li>
                                        <img src="img/color/red.jpg" alt="">
                                    </li>
                                    <li>
                                        <img src="img/color/green.jpg" alt="">
                                    </li>
                                    <li>
                                        <img src="img/color/yellow.jpg" alt="">
                                    </li>
                                    <li>
                                        <img src="img/color/purple.jpg" alt="">
                                    </li>
                                </ul>
                                <p class="prod-skuttl">Sizes</p>
                                <div class="offer-props-select">
                                    <p>XL</p>
                                    <ul>
                                        <li><a href="#">XS</a></li>
                                        <li><a href="#">S</a></li>
                                        <li><a href="#">M</a></li>
                                        <li class="active"><a href="#">XL</a></li>
                                        <li><a href="#">L</a></li>
                                        <li><a href="#">4XL</a></li>
                                        <li><a href="#">XXL</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="prod-info">
                                <p class="prod-price">
                                    <b class="item_current_price">$238</b>
                                </p>
                                <p class="prod-qnt">
                                    <input type="text" value="1">
                                    <a href="#" class="prod-plus"><i class="fa fa-angle-up"></i></a>
                                    <a href="#" class="prod-minus"><i class="fa fa-angle-down"></i></a>
                                </p>
                                <p class="prod-addwrap">
                                    <a href="#" class="prod-add">Add to cart</a>
                                </p>
                            </div>
                            <ul class="prod-i-props">
                                <li>
                                    <b>SKU</b> 05464207
                                </li>
                                <li>
                                    <b>Manufacturer</b> Mayoral
                                </li>
                                <li>
                                    <b>Material</b> Cotton
                                </li>
                                <li>
                                    <b>Pattern Type</b> Print
                                </li>
                                <li>
                                    <b>Wash</b> Colored
                                </li>
                                <li>
                                    <b>Style</b> Cute
                                </li>
                                <li>
                                    <b>Color</b> Blue, Red
                                </li>
                                <li><a href="#" class="prod-showprops">All Features</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Quick View Product - end -->
            </section>
        </main>
        <!-- Main Content - end -->


        <!-- Footer - start -->
        <footer class="footer-wrap">
<?php $this->load->view(FOOTER_PATH); ?>

        </footer>
        <!-- Footer - end -->




        <!-- jQuery plugins/scripts - end -->

    </body>
</html>