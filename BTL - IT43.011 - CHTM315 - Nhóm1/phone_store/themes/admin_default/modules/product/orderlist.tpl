<!-- BEGIN: list -->
<!-- BEGIN: alert -->
    <div class='alert alert-info' role="alert">{ALERT}</div>
<!-- END: alert -->
<!-- BEGIN: success -->
    <div class='alert alert-info' role="alert">{SUCCESS}</div>
<!-- END: success -->
<h2>Danh sách đơn hàng</h2>
<!-- search -->
    <form action="{NV_BASE_ADMINURL}index.php?" method="get" name="search_orders">
      <input type="hidden" name="{NV_LANG_VARIABLE}" value="{NV_LANG_DATA}">
      <input type="hidden" name="{NV_NAME_VARIABLE}" value="{MODULE_NAME}">
      <input type="hidden" name="{NV_OP_VARIABLE}" value="{OP}">
      <div class="row">
            <div class="col-xs-12 col-md-3">
                <div class="form-group">
                    <input class="form-control" type="text" value="{POST.name}" maxlength="64" name="name" placeholder="Tìm kiếm theo tên">
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
                <div class="form-group">
                    <input class="form-control" type="text" value="{POST.email}" maxlength="64" name="email" placeholder="Tìm kiếm theo email">
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
                <div class="form-group">
                    <input class="form-control" type="text" value="{POST.phone}" maxlength="11" name="phone" placeholder="Tìm kiếm theo số điện thoại">
                </div>
            </div>
            
            <div class="col-xs-12 col-md-3">
                <div class="form-group">
                    <select class="form-control" name="payment_method">
                        <option value=""> -- Phương thức thanh toán -- </option>
                        <!-- BEGIN: pmLoop -->
                        <option value="{PAYMENT.key}" {PAYMENT.selected}>{PAYMENT.value}</option>
                        <!-- END: pmLoop -->

                       
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
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
        </div>
    </form>
    <!-- search -->
<div class="table-responsive">          
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Tên người mua</th>
        <th>Email</th>
        <th>Số điện thoại</th>
        <th>Địa Chỉ</th>
        <th>Tổng giá trị đơn hàng</th>
        <th>Ghi chú đơn hàng</th>
        <th>Phương Thức Thanh Toán</th>
        <th>Trạng thái đơn hàng</th>
        <th>Hành Động</th>
        
      </tr>
    </thead>
    <tbody>
    <!-- BEGIN: dataLoop -->
      <tr>
        <td>{DATA.id}</td>
        <td>{DATA.name}</td>
        <td>{DATA.email}</td>
        <td>{DATA.phone}</td>
        <td>{DATA.address}</td>
        <td>{DATA.total_price}</td>
        <td>{DATA.order_note}</td>
        <td>{DATA.payment_method}</td>
        <td>{DATA.active}</td>
        <td class="text-center">
        
          <a href="{DATA.url_edit}" class="edit btn btn-warning btn-xs">
          <em class="fa fa-edit margin-right"></em>
          Sửa
          </a>
          <a href="{DATA.url_delete}" class="delete btn btn-danger btn-xs">
          <em class="fa fa-trash-o margin-right"></em>
          Xóa
          </a>
        </p>  
        
      </tr>
    <!-- END: dataLoop -->
    </tbody>
  </table>
  <!-- BEGIN: page -->
    {GENERATE_PAGE}
  <!-- END: page -->
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
                $("input[name='phone']").val('');
                $("input[name='email']").val('');

                $("select[name='payment_method']").val('');
                $("select[name='active']").val('');                
                $("form[name='search_orders']").trigger("submit");
            });
      });
</script>
<!-- END: list -->