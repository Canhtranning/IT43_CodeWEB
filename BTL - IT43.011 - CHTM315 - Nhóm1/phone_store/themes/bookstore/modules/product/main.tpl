<!-- BEGIN: main -->

<!-- search -->
<div class="well">
<!-- search -->
    <form action="{NV_BASE_SITEURL}index.php?" method="get" name="search_products">
        <input type="hidden" name="{NV_LANG_VARIABLE}" value="{NV_LANG_DATA}">
        <input type="hidden" name="{NV_NAME_VARIABLE}" value="{MODULE_NAME}">
        <input type="hidden" name="{NV_OP_VARIABLE}" value="{OP}">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="form-group">
                    <input class="form-control" type="text" value="{POST.name}" maxlength="64" name="name" placeholder="Tìm kiếm theo tên">
                </div>
            </div>

            <div class="col-xs-12 col-md-6">
                <div class="form-group">
                    <select class="form-control" name="category_id" id="category_id" tabindex="-1" aria-hidden="true">
                        <option value="0" selected="selected" data-select2-id="2">-- Tất cả Danh mục --</option>
                        <!-- BEGIN: catloop -->
                        <option value="{ROW_CAT.id}" {ROW_CAT.selected}>{ROW_CAT.name}</option>
                        <!-- END: catloop -->
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="form-group">
                    <select class="form-control" name="active">
                        <option value=""> -- Tất cả Trạng thái -- </option>
                        <!-- BEGIN: activeLoop -->
                        <option value="{ACTIVE.key}" {ACTIVE.selected}>{ACTIVE.value}</option>
                        <!-- END: activeLoop -->


                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-md-2">
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Tìm kiếm">
                </div>
            </div>
            
        </div>
  </form>
  <!-- search -->
</div>
  <!-- search -->

<div class="col-xs-5 col-sm-5 col-md-5 ">
<div class="panel panel-default">
	<!-- Default panel contents -->
	<div class="panel-heading text-center"><h1> <i class="fa fa-briefcase"></i> - {LANG.category_id}</h1></div>
    <!-- BEGIN: cate -->
    <table class="table">
		<td>
            <h3> <i class="fa fa-book"></i> - <a href ="{CATE.url_product}">{CATE.name} </a> <span class="text-red">({CATE.num})</span></h3>
        </td>
    </table>
    <!-- END: cate -->

</div>
</div>



<div class="col-xs-19 col-sm-19 col-md-19">
<!-- BEGIN: loop -->
<div class="col-xs-8 col-sm-8 col-md-8 text-center">
<div class="thumbnail">
        <div class="thumbnail item">
            <div class="panel item-img" >
                    <img src="{ROW.image}" class="img-responsive">
                    <div class="product-thumb-info-act">
                        <div class="icon">
                            <a href="{ROW.url_detail}" class="detail" title="Chi tiết sản phẩm">
                                <span><i class="fa fa-external-link"></i></span>
                            </a>
                            <a href="" role="button" class="cart"  onclick="nv_add_to_cart({ROW.id}, 'add')" title="Giỏ hàng">
                                <span><i class="fa fa-shopping-cart"></i></span>
                            </a>
                        </div>
                    </div>

            </div>
        </div>

        <div class="panel">
            <div style="height:50px"><h3 class="name"><a href="{ROW.url_detail}" class="detail" title="Chi tiết sản phẩm">{ROW.name} </a></h3></div>
            <div><h3>{ROW.price} {LANG.vnd} </h3></div>

    </div>

</div>
</div>

<!-- END: loop -->

</div>

<div class="text-center">
        <!-- BEGIN: page -->
            {GENERATE_PAGE}
        <!-- END: page -->
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