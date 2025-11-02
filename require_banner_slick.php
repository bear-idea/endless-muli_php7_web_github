<link href="<?php echo $SiteBaseUrl ?>assets/plugins/slick/slick.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $SiteBaseUrl ?>assets/plugins/slick/slick-theme.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $SiteBaseUrl; ?>assets/plugins/slick/slick.min.js"></script>
<style>
.slick-slide .image{padding:10px;}
.slick-slide img{border:5px solid #FFF;display:block;width:100%;}
.slick-slide img.slick-loading{border:0 }
.slick-slider{  vertical-align:central;}
.slick-slider div { }
</style>
<div class="container">
<div class="slider your-class">
					<div><h3><img name="" src="http://hover-machine.com/site/hover/image/product/201612300943261.jpg"  alt="" /></h3></div>
					<div><h3><img name="" src="http://hover-machine.com/site/playweb/image/bannershow/201605041118101.jpg" width="300" height="300" alt="" /></h3></div>
					<div><h3><img name="" src="http://hover-machine.com/site/playweb/image/bannershow/201605041118101.jpg" width="300" height="300" alt="" /></h3></div>
                    <div><h3><img name="" src="http://hover-machine.com/site/playweb/image/bannershow/201605041118101.jpg" width="300" height="300" alt="" /></h3></div>
                    <div><h3><img name="" src="http://hover-machine.com/site/playweb/image/bannershow/201605041118101.jpg" width="300" height="300" alt="" /></h3></div>
				
				</div>
                </div>

  

  <script type="text/javascript">
    $(document).ready(function(){
      $('.your-class').slick({
  centerMode: true,
  centerPadding: '100px',
  slidesToShow: 3,
  responsive: [
    {
      breakpoint: 1200,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }
  ]
});
    });
  </script>