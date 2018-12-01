<script type="text/javascript">
    let lasturl = "<?php $url= base_url();; ?>";
    </script>
    <input type="hidden" id="lasturl" value="<?php echo base_url(); ?>"/>
    <div class="container f-menu-list">
      <div class="row row-30">
          <div class="col-md-4 col-xl-5">
            <div class="pr-xl-4"><a class="brand" href="index.html"><img class="brand-logo-light" src="<?php echo LOGO_PATH; ?>" alt="" width="140" height="37" srcset="images/agency/logo-retina-inverse-280x74.png 2x"></a>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, and <a href="<?php echo base_url().'aboutus'; ?>" style="color:orange">more ...</a></p>
              <!-- Rights-->

            </div>
          </div>
          <div class="col-md-4">
            <h5>Contacts</h5>
            <dl class="contact-list">
              <dt>Address:</dt>
              <dd>Sri kunj apartment, Ayyappa Society,opp petrol bunk, Madhapur.</dd>
            </dl>
            <dl class="contact-list">
              
              <dd>Email: <a href="mailto:#"><?php echo SITE_DOMAIN; ?></a></dd>
            </dl>
            <dl class="contact-list">
              <dd> phones : <a href="tel:#"><?php echo SITE_PHONE; ?></a>
              </dd>
            </dl>
            
          </div>
          <div class="col-md-4 col-xl-3">
            <h5>Links</h5>
            <ul class="nav-list">
              <li><a href="<?php echo base_url(); ?>aboutus">About</a></li>
              <li><a href="<?php echo base_url(); ?>terms">Terms & Conditions</a></li>
              <li><a href="<?php echo base_url(); ?>privacypolicy">privacy Policy</a></li>
              <li><a href="<?php echo base_url(); ?>contactus">Contact us</a></li>
              <li><a href="<?php echo base_url(); ?>requestbook">Request Book</a></li>
            </ul>
          </div>
          <br/>
          <div class="f-subscribe">
              <h3>Subscribe to news</h3>
              <form class="f-subscribe-form" action="" method="post" id="subscribe_form">
                  <input placeholder="Your e-mail" type="text" name="subscribe_email" id="subscribe_email" maxlength="60" autocomplete="off"/>
                  <button type="submit"><i class="fa fa-paper-plane"></i></button>
              </form>
              <p class="error" id="subscribe_email_error"></p>
              <p>Enter your email address if you want to receive our newsletter. Subscribe now!</p>
          </div>
        </div>
      </div>

    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <ul class="social-icons nav navbar-nav">
                    <li>
                        <a href="http://facebook.com/" rel="nofollow" target="_blank">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="http://google.com/" rel="nofollow" target="_blank">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </li>
                    <li>
                        <a href="http://twitter.com/" rel="nofollow" target="_blank">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="http://vk.com/" rel="nofollow" target="_blank">
                            <i class="fa fa-vk"></i>
                        </a>
                    </li>
                    <li>
                        <a href="http://instagram.com/" rel="nofollow" target="_blank">
                            <i class="fa fa-instagram"></i>
                        </a>
                    </li>
                </ul>
                <div class="footer-copyright">
                    <i><a href="<?php echo DESIGNED_LINK; ?>"><?php echo DESIGNED_BY; ?></a></i> © Copyright 2018
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery plugins/scripts - start -->
<script src="<?php echo FRONT_JS_PATH;  ?>jquery-1.11.2.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?php echo FRONT_JS_PATH;  ?>jquery.bxslider.min.js"></script>
<script src="<?php echo FRONT_JS_PATH;  ?>fancybox/fancybox.js"></script>
<script src="<?php echo FRONT_JS_PATH;  ?>fancybox/helpers/jquery.fancybox-thumbs.js"></script>
<script src="<?php echo FRONT_JS_PATH;  ?>jquery.flexslider-min.js"></script>
<script src="<?php echo FRONT_JS_PATH;  ?>swiper.jquery.min.js"></script>
<script src="<?php echo FRONT_JS_PATH;  ?>jquery.waypoints.min.js"></script>
<script src="<?php echo FRONT_JS_PATH;  ?>progressbar.min.js"></script>
<script src="<?php echo FRONT_JS_PATH;  ?>ion.rangeSlider.min.js"></script>
<script src="<?php echo FRONT_JS_PATH;  ?>chosen.jquery.min.js"></script>
<script src="<?php echo FRONT_JS_PATH;  ?>jQuery.Brazzers-Carousel.js"></script>
<script src="<?php echo FRONT_JS_PATH;  ?>plugins.js"></script>
<script src="<?php echo FRONT_JS_PATH;  ?>main.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhAYvx0GmLyN5hlf6Uv_e9pPvUT3YpozE"></script>
<script src="<?php echo FRONT_JS_PATH;  ?>gmap.js"></script>
<!-- jQuery plugins/scripts - end -->

<script type="text/javascript">
function addToCart(productid)
{
    $.ajax({
			type:'POST',
			dataType:'JSON',
			data:{'cartid':productid,'qty':1},
			url:"<?php echo base_url(); ?>addtocart",
            success:function(cr)
            {
            	console.log(cr);
            	if(cr.code==200 )
        		{
                  alert(cr.description);
                  setTimeout(function(){window.location="<?php echo base_url(); ?>checkout"},2000);
        		}
            	if(cr.code==222)
        		{
                    alert(cr.description);
        		}
            	if(cr.code=='204' || cr.code=='301' || cr.code=='422')
        		{
            		alert(cr.description);
        		}
            },
			error:function(err){
				console.log(err)
			}
		});
}

$('#subscribe_form').on('submit',function(e){
e.preventDefault();
let str=true;
$('#subscribe_email_error').html('');
 let subscribe_email = $('#subscribe_email').val();
 if(subscribe_email==''){$('#subscribe_email_error').html('Please enter email').css({'color':'red'});str=false;}
 if(str==true)
 {
   $('#subscribe_email_error').html('Please wait..!').css({'color':'blue'});
   $.ajax({
     type:'POST',
     dataType:'JSON',
     data:{'subscribeid':subscribe_email},
     url:"<?php echo base_url(); ?>Cms/subscribeme",
           success:function(cr)
           {
             console.log(cr);
             if(cr.code==200 )
           {
              $('#subscribe_email').val('');
                 $('#subscribe_email_error').html(cr.description).css({'color':'green'});
                 setTimeout(function(){$('#subscribe_email_error').html('');},2000);
           }
             if(cr.code==222)
           {
                    $('#subscribe_email_error').html(cr.description).css({'color':'red'});
           }
             if(cr.code=='204' || cr.code=='301' || cr.code=='422')
           {
                $('#subscribe_email_error').html(cr.description).css({'color':'red'});
           }
           },
     error:function(err){
       console.log(err)
     }
   });
 }
return str;
});

$('#headerSearchForm').on('submit',function(e){
e.preventDefault();
 let searchtitle = $('#searchproduct').val();
 if(searchtitle != '')
 {
    window.location="<?php echo base_url(); ?>search/"+searchtitle;
 }
});
</script>
