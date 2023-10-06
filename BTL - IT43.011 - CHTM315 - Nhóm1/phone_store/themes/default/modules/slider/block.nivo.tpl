<!-- BEGIN: main -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/slider/nivo/default.css" media="all"/>
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/slider/nivo/nivo-slider.css" media="all"/>
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/slider/nivo/jquery.min-1.10.2.js" type="text/javascript"></script>
<script src="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/slider/nivo/jquery.nivo.slider-3.2.js" type="text/javascript"></script>
<script type="text/javascript">
var jQuery_1102 = $.noConflict(true);
    jQuery_1102(window).load(function() {
        jQuery_1102('#slider').nivoSlider();
    });
    jQuery_1102.fn.nivoSlider.defaults = {
        effect: 'random',
        slices: {numrow},
        boxCols: 8,
        boxRows: 4,
        animSpeed: 800,
        pauseTime: 6000,
        startSlide: 0,
        directionNav: true,
        controlNav: false,
        controlNavThumbs: false,
        pauseOnHover: true,
        manualAdvance: false,
        prevText: 'Prev',
        nextText: 'Next',
        randomStart: false,
        beforeChange: function(){},
        afterChange: function(){},
        slideshowEnd: function(){},
        lastSlide: function(){},
        afterLoad: function(){}
    };	
    </script>
<style>
.slider-wrapper { 
	width: 100%; 
	margin: 0 auto;
}
</style>
<div class="slider-wrapper theme-default">
<div id="slider" class="nivoSlider">
<!-- BEGIN: loop -->
<!-- BEGIN: image_only --><img src="{ROW.image}" data-thumb="{ROW.image}" title="{ROW.description}" /><!-- END: image_only -->
<!-- BEGIN: image_link --><a href="{ROW.link}"<!-- BEGIN: target --> target="{ROW.target}"<!-- END: target -->>
<img src="{ROW.image}" data-thumb="{ROW.image}" title="{ROW.description}" />
</a><!-- END: image_link -->
<!-- END: loop -->
</div></div>
<!-- END: main -->