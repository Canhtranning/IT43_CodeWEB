<!-- BEGIN: main -->
<div class="container">
	<div class="row">
		<div>
			<div class="col-xs-8 col-sm-8 col-md-8 text-center">
				<img src="{ROWDETAIL.image}" alt="" class="avt" style=" border: red 1px solid ">
			</div>
			<div class="col-xs-8 col-sm-8 col-md-8 ">
				<h1>{ROWDETAIL.name}</h1>
				<br>
				<div class="container">
				<h2>
					   {ROWDETAIL.price} {LANG.vnd}

				</h2>
				<p>{LANG.category_id}: {ROWCATE.name}</p>
				</div>
				<p>
					<a href="#" class="btn btn-danger" onclick="nv_add_to_cart({ROWDETAIL.id}, 'add')"><i class="fa fa-shopping-cart"></i> Add to cart</a>
				</p>
                <br>
                <p>{LANG.content}: {ROWDETAIL.content}</p>
			</div>
			<div class="col-xs-8 col-sm-8 col-md-8">
            <h1 class="text-center">Một số sản phẩm liên quan</h1>
            <!-- BEGIN: row_rd -->
				<div class="thumbnail">

                    <h3 class="text-center">{ROWRD.name}</h3>
                    <a href="{ROWRD.url_detail}"><img src="{ROWRD.image}" alt="" class="avt"></a>
                </div>
            <!-- END: row_rd -->
			</div>
		</div>
	</div>
    </div>

<script type="text/javascript">
function nv_add_to_cart(id, action) {
  $.ajax({
          url: nv_base_siteurl + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=cart',
          method: 'POST',
          dataType:"text",
          data: {id: id, action: action},
          success: function(data) {
              alert(data);
          }
        });
}

</script>
<!-- END: main -->