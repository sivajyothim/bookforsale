
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="format-detection" content="telephone=no">
        <title><?php echo $url_title ?></title>

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
                        <span><?php echo $title; ?></span>
                    </li>
                </ul>
                <?php
                $req = json_decode($book_details);
                $book_res = $req->product_result;
                $book_id = $book_res->book_id;
                $book_name = fetch_ucfirst($book_res->book_title);
                ?>
                <h1 class="main-ttl"><span><?php echo fetch_ucfirst($book_res->book_title); ?></span></h1>
                <!-- Single Product - start -->
                <div class="prod-wrap">

                    <!-- Product Images -->
                    <div class="prod-slider-wrap">
                        <div class="prod-slider">
                            <ul class="prod-slider-car">
                                <li>
                                    <a data-fancybox-group="product" class="fancy-img" href="<?php echo PRODUCT_PATH . $book_res->book_image; ?>" style="height:642px;width:500px"/>
                                    <img src="<?php echo PRODUCT_PATH . $book_res->book_image; ?>" alt="" style="height:642px;width:500px"/>
                                    </a>
                                </li>

                            </ul>
                        </div>

                    </div>

                    <!-- Product Description/Info -->
                    <div class="prod-cont">
                        <div class="prod-cont-txt">
                            <b><?php echo $book_name; ?>	</b><br/>
                            <?php echo $book_res->description; ?>
                        </div>
                        <p class="prod-actions">
                            <a href="#" class="prod-favorites"><i class="fa fa-heart"></i> Wishlist</a>

                        </p>

                        <div class="prod-info">
                            <p class="prod-price">
                                <b class="item_current_price">Rs.<?php echo $book_res->selling_price; ?></b>
                            </p>

                            <p class="prod-addwrap">
                                <a href="javascript:void(0)" onclick="addToCart('<?php echo $book_id; ?>')" class="prod-add">Add to cart</a>
                            </p>
                        </div>
                        <ul class="prod-i-props">
                            <li>
                                <b>Menu : </b> <?php echo $book_res->menu_title; ?>
                            </li>
                            <li>
                                <b>Sub Menu : </b> <?php echo $book_res->submenu; ?>
                            </li>
                            <li>
                                <b>Year : </b> <?php echo ($book_res->published_year != '') ? $book_res->published_year : '-'; ?>
                            </li>
                            <li>
                                <b>Region / University: </b><?php echo ($book_res->region_name != '') ? fetch_ucfirst($book_res->region_name) : '-'; ?>
                            </li>
                            <li>
                                <b>Medium : </b> <?php echo ($book_res->language != '') ? $book_res->language : '-'; ?>
                            </li>
                            <li>
                                <b>Author  : </b> <?php echo ($book_res->author_name != '') ? $book_res->author_name : '-'; ?>
                            </li>
                            <li>
                                <b>Published Year: </b> <?php echo ($book_res->published_year != '') ? $book_res->published_year : '-'; ?>
                            </li>
                            <li>
                                <b>Age: </b> <?php echo ($book_res->book_age != '') ? $book_res->book_age : '-'; ?>
                            </li>
                            <li>
                                <b>Available Stock: </b><?php echo ($book_res->stock != '') ? $book_res->stock : '-'; ?>
                            </li>
                            <li><a href="#" class="prod-showprops">All Features</a></li>
                        </ul>
                    </div>

                    <!-- Product Tabs -->
                    <div class="prod-tabs-wrap">
                        <ul class="prod-tabs">
                            <li><a data-prodtab-num="1" class="active" href="#" data-prodtab="#prod-tab-1">Description</a></li>
                            <li><a data-prodtab-num="2" id="prod-props" href="#" data-prodtab="#prod-tab-2">Features</a></li>
<!--                            <li><a data-prodtab-num="3" href="#" data-prodtab="#prod-tab-3">Video</a></li>
                            <li><a data-prodtab-num="4" href="#" data-prodtab="#prod-tab-4">Articles (6)</a></li>-->
                            <li><a data-prodtab-num="5" href="#" data-prodtab="#prod-tab-5">Reviews (0)</a></li>
                        </ul>
                        <div class="prod-tab-cont">

                            <p data-prodtab-num="1" class="prod-tab-mob active" data-prodtab="#prod-tab-1">Description</p>
                            <div class="prod-tab stylization" id="prod-tab-1">
                                <p><?php echo $book_res->description; ?></p>
                            </div>
                            <p data-prodtab-num="2" class="prod-tab-mob" data-prodtab="#prod-tab-2">Features</p>
                            <div class="prod-tab prod-props" id="prod-tab-2">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td><b>Menu : </b></td><td> <?php echo $book_res->menu_title; ?></td>
                                    </tr>
                                    <tr>
                                    <td> <b>Sub Menu : </b></td><td><?php echo $book_res->submenu; ?></td>
                                    </tr>
                                    <tr>
                                    <td> <b>Year : </b></td><td><?php echo ($book_res->published_year != '') ? $book_res->published_year : '-'; ?></td>
                                    </tr>
                                    <tr>
                                        <td> <b>Region / University: </b></td><td><?php echo ($book_res->region_name != '') ? fetch_ucfirst($book_res->region_name) : '-'; ?></td>
                                        </tr>
                                    <tr>
                                   <td>  <b>Medium : </b></td><td> <?php echo ($book_res->language != '') ? $book_res->language : '-'; ?></td>
                                    </tr>
                                    <tr>
                                   <td>  <b>Author  : </b> </td><td><?php echo ($book_res->author_name != '') ? $book_res->author_name : '-'; ?></td>
                                    </tr>
                                    <tr>
                                   <td>  <b>Published Year: </b></td><td> <?php echo ($book_res->published_year != '') ? $book_res->published_year : '-'; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Age: </b></td><td> <?php echo ($book_res->book_age != '') ? $book_res->book_age : '-'; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Available Stock: </b></td><td><?php echo ($book_res->stock != '') ? $book_res->stock : '-'; ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p data-prodtab-num="3" class="prod-tab-mob" data-prodtab="#prod-tab-3">Video</p>
                            <div class="prod-tab prod-tab-video" id="prod-tab-3">
                                <iframe width="853" height="480" src="https://www.youtube.com/embed/kaOVHSkDoPY?rel=0&amp;showinfo=0" allowfullscreen></iframe>
                            </div>
                            <p data-prodtab-num="4" class="prod-tab-mob" data-prodtab="#prod-tab-4">Articles (6)</p>
                            <div class="prod-tab prod-tab-articles" id="prod-tab-4">
                                <div class="flexslider post-rel-wrap" id="post-rel-car">
                                    <ul class="slides">
                                        <li class="posts-i">
                                            <a class="posts-i-img" href="post.html"><span style="background: url(http://placehold.it/354x236)"></span></a>
                                            <time class="posts-i-date" datetime="2017-01-01 08:18"><span>09</span> Feb</time>
                                            <div class="posts-i-info">
                                                <a class="posts-i-ctg" href="blog.html">Articles</a>
                                                <h3 class="posts-i-ttl"><a href="post.html">Adipisci corporis velit</a></h3>
                                            </div>
                                        </li>
                                        <li class="posts-i">
                                            <a class="posts-i-img" href="post.html"><span style="background: url(http://placehold.it/360x203)"></span></a>
                                            <time class="posts-i-date" datetime="2017-01-01 08:18"><span>05</span> Jan</time>
                                            <div class="posts-i-info">
                                                <a class="posts-i-ctg" href="blog.html">Reviews</a>
                                                <h3 class="posts-i-ttl"><a href="post.html">Excepturi ducimus recusandae</a></h3>
                                            </div>
                                        </li>
                                        <li class="posts-i">
                                            <a class="posts-i-img" href="post.html"><span style="background: url(http://placehold.it/360x224)"></span></a>
                                            <time class="posts-i-date" datetime="2017-01-01 08:18"><span>17</span> Apr</time>
                                            <div class="posts-i-info">
                                                <a class="posts-i-ctg" href="blog.html">Reviews</a>
                                                <h3 class="posts-i-ttl"><a href="post.html">Consequuntur minus numquam</a></h3>
                                            </div>
                                        </li>
                                        <li class="posts-i">
                                            <a class="posts-i-img" href="post.html"><span style="background: url(http://placehold.it/314x236)"></span></a>
                                            <time class="posts-i-date" datetime="2017-01-01 08:18"><span>21</span> May</time>
                                            <div class="posts-i-info">
                                                <a class="posts-i-ctg" href="blog.html">Articles</a>
                                                <h3 class="posts-i-ttl"><a href="post.html">Non ex sapiente excepturi</a></h3>
                                            </div>
                                        </li>
                                        <li class="posts-i">
                                            <a class="posts-i-img" href="post.html"><span style="background: url(http://placehold.it/318x236)"></span></a>
                                            <time class="posts-i-date" datetime="2017-01-01 08:18"><span>24</span> Jan</time>
                                            <div class="posts-i-info">
                                                <a class="posts-i-ctg" href="blog.html">Articles</a>
                                                <h3 class="posts-i-ttl"><a href="post.html">Veritatis officiis</a></h3>
                                            </div>
                                        </li>
                                        <li class="posts-i">
                                            <a class="posts-i-img" href="post.html"><span style="background: url(http://placehold.it/354x236)"></span></a>
                                            <time class="posts-i-date" datetime="2017-01-01 08:18"><span>08</span> Sep</time>
                                            <div class="posts-i-info">
                                                <a class="posts-i-ctg" href="blog.html">Reviews</a>
                                                <h3 class="posts-i-ttl"><a href="post.html">Ratione magni laudantium</a></h3>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <p data-prodtab-num="5" class="prod-tab-mob" data-prodtab="#prod-tab-5">Reviews (3)</p>
                            <div class="prod-tab" id="prod-tab-5">
                                <ul class="reviews-list">
                                    <li class="reviews-i existimg hide">
                                        <div class="reviews-i-img">
                                            <img src="http://placehold.it/120x120" alt="Averill Sidony">
                                            <div class="reviews-i-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <time datetime="2017-12-21 12:19:46" class="reviews-i-date">21 May 2017</time>
                                        </div>
                                        <div class="reviews-i-cont">
                                            <p>Numquam aliquam maiores ratione dolores ducimus, laborum hic similique delectus. Neque saepe nobis omnis laudantium itaque tempore voluptate harum error, illum nemo, reiciendis architecto, quam tenetur amet sit quisquam cum.<br>Pariatur cum tempore eius nulla impedit cumque odit quos porro iste a voluptas, optio alias voluptate minima distinctio facere aliquid quasi, vero illum tenetur sed temporibus eveniet obcaecati.</p>
                                            <span class="reviews-i-margin"></span>
                                            <h3 class="reviews-i-ttl">Averill Sidony</h3>
                                            <p class="reviews-i-showanswer"><span data-open="Show answer" data-close="Hide answer">Show answer</span> <i class="fa fa-angle-down"></i></p>
                                        </div>
                                        <div class="reviews-i-answer">
                                            <p>Thanks for your feedback!<br>
                                                Nostrum voluptate autem, eaque mollitia sed rem cum amet qui repudiandae libero quaerat veniam accusantium architecto minima impedit. Magni illo illum iure tempora vero explicabo, esse dolores rem at dolorum doloremque iusto laboriosam repellendus. <br>Numquam eius voluptatum sint modi nihil exercitationem dolorum asperiores maiores provident repellat magnam vitae, consequatur omnis expedita, accusantium voluptas odit id.</p>
                                            <span class="reviews-i-margin"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="alert alert-danger text-center"> No Reviews Found..!</div>
                                    </li>
                                    
                                </ul>
                                <div class="prod-comment-form">
                                    <h3>Add your review</h3>
                                    <form method="POST" action="#">
                                        <input type="text" placeholder="Name">
                                        <input type="text" placeholder="E-mail">
                                        <textarea placeholder="Your review"></textarea>
                                        <div class="prod-comment-submit">
                                            <input type="submit" value="Submit">
                                            <div class="prod-rating">
                                                <i class="fa fa-star-o" title="5"></i><i class="fa fa-star-o" title="4"></i><i class="fa fa-star-o" title="3"></i><i class="fa fa-star-o" title="2"></i><i class="fa fa-star-o" title="1"></i>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Single Product - end -->

                <!-- Related Products - start -->
                <div class="prod-related hide">
                    <h2><span>Related products</span></h2>
                    <div class="prod-related-car" id="prod-related-car">
                        <ul class="slides">
                            <li class="prod-rel-wrap">
                                <div class="prod-rel">
                                    <a href="product.html" class="prod-rel-img">
                                        <img src="http://placehold.it/300x311" alt="Adipisci aperiam commodi">
                                    </a>
                                    <div class="prod-rel-cont">
                                        <h3><a href="product.html">Adipisci aperiam commodi</a></h3>
                                        <p class="prod-rel-price">
                                            <b>$59</b>
                                        </p>
                                        <div class="prod-rel-actions">
                                            <a title="Wishlist" href="#" class="prod-rel-favorites"><i class="fa fa-heart"></i></a>
                                            <a title="Compare" href="#" class="prod-rel-compare"><i class="fa fa-bar-chart"></i></a>
                                            <p class="prod-i-addwrap">
                                                <a title="Add to cart" href="#" class="prod-i-add"><i class="fa fa-shopping-cart"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>



                                <div class="prod-rel">
                                    <a href="product.html" class="prod-rel-img">
                                        <img src="http://placehold.it/300x366" alt="Nulla numquam obcaecati">
                                    </a>
                                    <div class="prod-rel-cont">
                                        <h3><a href="product.html">Nulla numquam obcaecati</a></h3>
                                        <p class="prod-rel-price">
                                            <b>$48</b>
                                        </p>
                                        <div class="prod-rel-actions">
                                            <a title="Wishlist" href="#" class="prod-rel-favorites"><i class="fa fa-heart"></i></a>
                                            <a title="Compare" href="#" class="prod-rel-compare"><i class="fa fa-bar-chart"></i></a>
                                            <p class="prod-i-addwrap">
                                                <a title="Add to cart" href="#" class="prod-i-add"><i class="fa fa-shopping-cart"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>



                                <div class="prod-rel">
                                    <a href="product.html" class="prod-rel-img">
                                        <img src="http://placehold.it/370x300" alt="Dignissimos eaque earum">
                                    </a>
                                    <div class="prod-rel-cont">
                                        <h3><a href="product.html">Dignissimos eaque earum</a></h3>
                                        <p class="prod-rel-price">
                                            <b>$37</b>
                                        </p>
                                        <div class="prod-rel-actions">
                                            <a title="Wishlist" href="#" class="prod-rel-favorites"><i class="fa fa-heart"></i></a>
                                            <a title="Compare" href="#" class="prod-rel-compare"><i class="fa fa-bar-chart"></i></a>
                                            <p class="prod-i-addwrap">
                                                <a title="Add to cart" href="#" class="prod-i-add"><i class="fa fa-shopping-cart"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>



                                <div class="prod-rel">
                                    <a href="product.html" class="prod-rel-img">
                                        <img src="http://placehold.it/300x345" alt="Porro quae quasi">
                                    </a>
                                    <div class="prod-rel-cont">
                                        <h3><a href="product.html">Porro quae quasi</a></h3>
                                        <p class="prod-rel-price">
                                            <b>$85</b>
                                        </p>
                                        <div class="prod-rel-actions">
                                            <a title="Wishlist" href="#" class="prod-rel-favorites"><i class="fa fa-heart"></i></a>
                                            <a title="Compare" href="#" class="prod-rel-compare"><i class="fa fa-bar-chart"></i></a>
                                            <p class="prod-i-addwrap">
                                                <a title="Add to cart" href="#" class="prod-i-add"><i class="fa fa-shopping-cart"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </li>
                            <li class="prod-rel-wrap">
                                <div class="prod-rel">
                                    <a href="product.html" class="prod-rel-img">
                                        <img src="http://placehold.it/378x300" alt="Sunt temporibus velit">
                                    </a>
                                    <div class="prod-rel-cont">
                                        <h3><a href="product.html">Sunt temporibus velit</a></h3>
                                        <p class="prod-rel-price">
                                            <b>$115</b>
                                        </p>
                                        <div class="prod-rel-actions">
                                            <a title="Wishlist" href="#" class="prod-rel-favorites"><i class="fa fa-heart"></i></a>
                                            <a title="Compare" href="#" class="prod-rel-compare"><i class="fa fa-bar-chart"></i></a>
                                            <p class="prod-i-addwrap">
                                                <a title="Add to cart" href="#" class="prod-i-add"><i class="fa fa-shopping-cart"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>



                                <div class="prod-rel">
                                    <a href="product.html" class="prod-rel-img">
                                        <img src="http://placehold.it/300x394" alt="Harum illum incidunt">
                                    </a>
                                    <div class="prod-rel-cont">
                                        <h3><a href="product.html">Harum illum incidunt</a></h3>
                                        <p class="prod-rel-price">
                                            <b>$130</b>
                                        </p>
                                        <div class="prod-rel-actions">
                                            <a title="Wishlist" href="#" class="prod-rel-favorites"><i class="fa fa-heart"></i></a>
                                            <a title="Compare" href="#" class="prod-rel-compare"><i class="fa fa-bar-chart"></i></a>
                                            <p class="prod-i-addwrap">
                                                <a title="Add to cart" href="#" class="prod-i-add"><i class="fa fa-shopping-cart"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>



                                <div class="prod-rel">
                                    <a href="product.html" class="prod-rel-img">
                                        <img src="http://placehold.it/300x303" alt="Reprehenderit rerum">
                                    </a>
                                    <div class="prod-rel-cont">
                                        <h3><a href="product.html">Reprehenderit rerum</a></h3>
                                        <p class="prod-rel-price">
                                            <b>$210</b>
                                        </p>
                                        <div class="prod-rel-actions">
                                            <a title="Wishlist" href="#" class="prod-rel-favorites"><i class="fa fa-heart"></i></a>
                                            <a title="Compare" href="#" class="prod-rel-compare"><i class="fa fa-bar-chart"></i></a>
                                            <p class="prod-i-addwrap">
                                                <a title="Add to cart" href="#" class="prod-i-add"><i class="fa fa-shopping-cart"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>



                                <div class="prod-rel">
                                    <a href="product.html" class="prod-rel-img">
                                        <img src="http://placehold.it/300x588" alt="Quae quasi adipisci alias">
                                    </a>
                                    <div class="prod-rel-cont">
                                        <h3><a href="product.html">Quae quasi adipisci alias</a></h3>
                                        <p class="prod-rel-price">
                                            <b>$85</b>
                                        </p>
                                        <div class="prod-rel-actions">
                                            <a title="Wishlist" href="#" class="prod-rel-favorites"><i class="fa fa-heart"></i></a>
                                            <a title="Compare" href="#" class="prod-rel-compare"><i class="fa fa-bar-chart"></i></a>
                                            <p class="prod-i-addwrap">
                                                <a title="Add to cart" href="#" class="prod-i-add"><i class="fa fa-shopping-cart"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </li>
                            <li class="prod-rel-wrap">
                                <div class="prod-rel">
                                    <a href="product.html" class="prod-rel-img">
                                        <img src="http://placehold.it/300x416" alt="Maxime molestias necessitatibus nobis">
                                    </a>
                                    <div class="prod-rel-cont">
                                        <h3><a href="product.html">Maxime molestias necessitatibus nobis</a></h3>
                                        <p class="prod-rel-price">
                                            <b>$95</b>
                                        </p>
                                        <div class="prod-rel-actions">
                                            <a title="Wishlist" href="#" class="prod-rel-favorites"><i class="fa fa-heart"></i></a>
                                            <a title="Compare" href="#" class="prod-rel-compare"><i class="fa fa-bar-chart"></i></a>
                                            <p class="prod-i-addwrap">
                                                <a title="Add to cart" href="#" class="prod-i-add"><i class="fa fa-shopping-cart"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>



                                <div class="prod-rel">
                                    <a href="product.html" class="prod-rel-img">
                                        <img src="http://placehold.it/300x480" alt="Facilis illum">
                                    </a>
                                    <div class="prod-rel-cont">
                                        <h3><a href="product.html">Facilis illum</a></h3>
                                        <p class="prod-rel-price">
                                            <b>$150</b>
                                        </p>
                                        <div class="prod-rel-actions">
                                            <a title="Wishlist" href="#" class="prod-rel-favorites"><i class="fa fa-heart"></i></a>
                                            <a title="Compare" href="#" class="prod-rel-compare"><i class="fa fa-bar-chart"></i></a>
                                            <p class="prod-i-addwrap">
                                                <a title="Add to cart" href="#" class="prod-i-add"><i class="fa fa-shopping-cart"></i></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Related Products - end -->

            </section>
        </main>
        <!-- Main Content - end -->


        <!-- Footer - start -->
        <footer class="footer-wrap">
            <?php $this->load->view(FOOTER_PATH); ?>

        </footer>


    </body>
</html>