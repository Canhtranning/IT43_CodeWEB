<!-- BEGIN: main -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/slider/carousel/animate.css" media="all"/>
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/slider/carousel/owl.carousel.css" media="all"/>
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/slider/carousel/style.css" media="all"/>
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/slider/carousel/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/slider/carousel/owl.carousel.js" type="text/javascript"></script>



	<div class="so-slider">
    <div class="container1">
        <div id="so-slideshow" class="module sohomepage-slider">
<div class="modcontent">
	<div id="sohomepage-slider">
		 <div class="so-homeslider sohomeslider-inner-1">

		<!-- BEGIN: loop -->
		<div class="item">
<!-- BEGIN: image_only --><img title="{ROW.description}" src="{ROW.image}" class="responsive"><!-- END: image_only -->
<!-- BEGIN: image_link --><a href="{ROW.link}" title="{ROW.description}"<!-- BEGIN: target --> target="{ROW.target}"<!-- END: target -->><img src="{ROW.image}" title="{ROW.description}" class="responsive"></a><!-- END: image_link -->
			<div class="sohomeslider-description">
				<div class="text pos-right text-sl11">
					<p class="des">{ROW.description}</p>   
				</div>        	
			</div>
		</div>	
		<!-- END: loop -->
		 
		</div>
	</div>
</div>				
		</div>
	</div> 
	</div> 



<script type="text/javascript">
var jQuery_211 = $.noConflict(true);
var owl = jQuery_211(".sohomeslider-inner-1");
var total_item = {numrow};
function customCenter() {
	jQuery_211(".owl2-item.active .item .sohomeslider-description .image ").addClass("img-active");
	jQuery_211(".owl2-item.active .item .sohomeslider-description .text .tilte ").addClass("title-active");
	jQuery_211(".owl2-item.active .item .sohomeslider-description .text .des").addClass("des-active");
}
function customPager() {
	jQuery_211(".owl2-item.active .item .sohomeslider-description .image ").addClass("img-active");
	jQuery_211(".owl2-item.active .item .sohomeslider-description .text .tilte ").addClass("title-active");
	jQuery_211(".owl2-item.active .item .sohomeslider-description .text .des").addClass("des-active");
}
jQuery_211(".sohomeslider-inner-1").owlCarousel2({
		animateIn: 'fadeIn',
		animateOut: 'fadeOut',		
		autoplay: true,
		autoplayTimeout: 5000,
		autoplaySpeed:  1000,
		smartSpeed: 500,
		autoplayHoverPause: true,
		startPosition: 0,
		mouseDrag:  true,
		touchDrag: true,
		dots: true,
		autoWidth: false,
		dotClass: "owl2-dot",
		dotsClass: "owl2-dots",
		loop: true,
		navText: ["Next", "Prev"],
		navClass: ["owl2-prev", "owl2-next"],
		responsive: {
		0:{	items: 1,
nav: total_item <= 1 ? false : ((true) ? true: false),
		},
		480:{ items: 1,
nav: total_item <= 1 ? false : ((true) ? true: false),
		},
		768:{ items: 1,
nav: total_item <= 1 ? false : ((true) ? true: false),
		},
		992:{ items: 1,
nav: total_item <= 1 ? false : ((true) ? true: false),
		},
		1200:{ items: 1,
nav: total_item <= 1 ? false : ((true) ? true: false),
		}
	},
	onInitialized : customPager,
	onTranslated  : customCenter,
});
</script>
<!-- END: main -->