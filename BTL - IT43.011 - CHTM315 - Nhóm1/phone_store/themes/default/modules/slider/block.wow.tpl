<!-- BEGIN: main -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/slider/wow/engine/style.css" media="all"/>
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/slider/wow/engine/wowslider.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/slider/wow/engine/script.js"></script>

	<div id="wowslider-container1">
	<div class="ws_images"><ul>	
	<!-- BEGIN: loop -->
	<li>
		<!-- BEGIN: image_only --><img src="{ROW.image}" title="{ROW.description}" alt="{ROW.description}" /><!-- END: image_only -->
		<!-- BEGIN: image_link --><a href="{ROW.link}"<!-- BEGIN: target --> target="{ROW.target}"<!-- END: target -->>
		<img src="{ROW.image}" data-thumb="{ROW.image}" title="{ROW.description}" alt="{ROW.description}" />
		</a><!-- END: image_link -->		
	</li>		
	<!-- END: loop -->	
	</ul></div>
	<div class="ws_bullets"></div>
	<div class="ws_shadow"></div>
	</div>	
	<br />
	
	
	
<!-- END: main -->