<!-- BEGIN: main -->

<div class="row">
    <!-- BEGIN: dataLoop -->

        <div class="col-sm-6 col-md-6">
            <div class="thumbnail">
                <img src="{DATA.image}" alt="...">
                <div class="caption">
                    <h3>{DATA.name}</h3>
                    <p>...</p>
                    <a href="#" class="btn btn-primary" role="button" onclick="nv_add_to_cart({DATA.id}, 'add')">Add to cart</a>
                </div>
            </div>
        </div>
      <!-- END: dataLoop -->

</div>

  <!-- BEGIN: page -->
    {GENERATE_PAGE}
  <!-- END: page -->

<script type="text/javascript">
function nv_add_to_cart(id, action) {
  $.ajax({
          url: nv_base_siteurl + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=cart',
          method: 'POST',
          dataType:"text",
          data: {id: id, action: action},
          success: function(data) {
              alert('abc');
          }
        });
}

</script>



<!-- END: main -->