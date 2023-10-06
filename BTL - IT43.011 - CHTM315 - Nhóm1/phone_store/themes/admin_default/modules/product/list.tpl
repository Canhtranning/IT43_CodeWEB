<!-- BEGIN: list -->
<!-- BEGIN: success -->
    <div class='alert alert-info' role="alert">{SUCCESS}</div>
<!-- END: success -->
<div class="container">

    <h1>Tìm kiếm:</h1>
    <!-- search -->
    <form action="{NV_BASE_ADMINURL}index.php?" method="get" name="search_products">
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
            <div class="col-xs-12 col-md-2">
                <div class="form-group">
                    <a href="#" class="btn btn-danger" id="clear_search">Xóa bộ lọc</a>
                </div>
            </div>
            <div class="col-xs-12 col-md-2">
              <div class="form-group">
                  <a href="{ADD_LINK}" class="btn btn-success" id="clear_search">Thêm</a>
              </div>
          </div>
        </div>
    </form>
    <!-- search -->

  <!-- list product -->
<div class="well">
  <div class="table-responsive">
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">Ảnh sản phẩm</th>
        <th class="text-center">Tên sản phẩm</th>

        <th class="text-center">Giá sản phẩm</th>


        <th class="text-center">Danh mục</th>
        <th class="text-center">Trạng Thái</th>
        <th class="text-center">Hành Động</th>

      </tr>
    </thead>
    <tbody>
    <!-- BEGIN: dataLoop -->
      <tr>
        <td>{DATA.id}</td>

        <td class="text-center"><img src="{DATA.image}" style="width: 80px;"></td>
        <td>{DATA.name}</td>
        <td>{DATA.price}</td>


        <td>{DATA.category}</td>
        <td>{DATA.active}</td>
        <td class="text-center">
          <a href="{DATA.url_edit}" class="edit btn btn-warning btn-xs btn_edit">
          <em class="fa fa-edit margin-right"></em>
            Sửa
          </a>
          <a href="{DATA.url_delete}" class="delete btn btn-danger btn-xs">
          <em class="fa fa-trash-o margin-right"></em>
          Xóa
          </a>
        </td>
      </tr>
    <!-- END: dataLoop -->
    </tbody>
  </table>
  <!-- list product -->
  </div>
  <!-- BEGIN: page -->
    {GENERATE_PAGE}
  <!-- END: page -->
  </div>
</div>
<script type='text/javascript'>

      $(document).ready(function() {
          $('.delete').click(function() {

              var xn = confirm('Bạn có chắc chắn muốn xóa?');
              if (xn == true) {
                return true;

              } else {
                return false;
              }
          });
         $('#clear_search').on('click', function (e) {
                e.preventDefault();
                $("input[name='name']").val('');
                $("select[name='category_id']").val('');
                $("select[name='active']").val('');

                $("form[name='search_products']").trigger("submit");
          });
      });
</script>
<!-- END: list -->