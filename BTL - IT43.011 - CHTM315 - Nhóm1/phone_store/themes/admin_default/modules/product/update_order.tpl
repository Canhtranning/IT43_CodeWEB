
<!-- BEGIN: main -->
<!-- BEGIN: alert -->
    <div class='alert alert-warning' role="alert">{ALERT}</div>
<!-- END: alert -->

<!-- BEGIN: error -->
    <div class='alert alert-danger' role="alert">{ERROR}</div>
<!-- END: error -->
<form action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post" enctype="multipart/form-data">
    <input type="hidden" class="form-control" name="id" value="{POST.id}">

    <div class="form-group">
        <label for="">Tên khách hàng: </label>
        <input type="text" class="form-control" name="name" value="{POST.name}">
    </div>
    <div class="form-group">
        <label for="">Email: </label>
        <input type="text" class="form-control" name="email" value="{POST.email}">
       
    </div>
    <div class="form-group ">
        <label for="">Số điện thoại: </label>
        <input type="text" class="form-control" name="phone" value="{POST.phone}">
    </div>
    
    <div class="form-group">
        <label for="">Địa chỉ: </label>
        <input type="text" class="form-control" name="address" value="{POST.address}">
    </div>
    <div class="form-group">
        <label for="">Lưu ý đơn hàng: </label>
        <textarea class="form-control" name="order_note">{POST.order_note}</textarea>
    </div>
    <div class="form-group">
        <label for="">Phương Thức Thanh Toán: </label>
        <select name="payment_method" class="form-control">
            <option value="">Chọn Phương Thức</option>
            <!-- BEGIN: pmLoop -->
            <option value="{PAYMENT.key}" {PAYMENT.selected}>{PAYMENT.value}</option>
            <!-- END: pmLoop -->
        </select>
    </div>
    <div class="form-group">
        <label for="">Trạng thái đơn hàng: </label>
        <select name="active" class="form-control">
            <option value="">Chọn Trạng Thái</option>
            <!-- BEGIN: activeLoop -->
            <option value="{ACTIVE.key}" {ACTIVE.selected}>{ACTIVE.value}</option>
            <!-- END: activeLoop -->
        </select>
    </div>
    
    <!-- order_detail -->
  <div class="well">  
    <h2>Thông tin đơn hàng</h2>
    <div class="form-inline">
      <label for="">Lựa chọn sản phẩm để thêm vào đơn hàng: </label>
      <select class="form-control" name="add_product" id="add_product">
        <option value="">Chọn sản phẩm</option>
        <!-- BEGIN: productLoop -->
        <option value="{PRODUCT.id}" data-image="{PRODUCT.image}" price={PRODUCT.price} data-id="{PRODUCT.id}" >{PRODUCT.name} - {PRODUCT.format_price}</option>
        <!-- END: productLoop -->
      </select>
      <a href="#" class="btn btn-success" id="add_to_cart">Thêm vào đơn hàng</a>
    </div>
    <hr>
    <div class="table-responsive">          
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID đơn hàng</th>
            <th>ID sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Số lượng</th>
            <th>Giá sản phẩm</th>
            <th>Thành tiền</th>
            <th>Hành Động</th>
            
          </tr>
        </thead>
        <tbody id="list-cart-product">
        <!-- BEGIN: dataLoop -->
          <tr id="tr-{DATA.product_id}">
            <td>{DATA.order_id}</td>
            <td>
              <input type="hidden" class="form-control" name="product_ids[]" value="{DATA.product_id}">

              {DATA.product_id}
            
            </td>
            <td>{DATA.name}</td>
            <td>
                <img src="{DATA.image}" class="img-thumbnail" style="width: 75px">
            </td>
            <td>
              <input type="number" class="form-control" name="product_quantity[]" value="{DATA.quantity}" min=1 max=5>
            </td>
            <td>{DATA.format_price} đ
                <i class="product_price" style="display:none;">{DATA.price}</i>
            </td>
            
            <td class="product_price_total">{DATA.line_price} đ</td>
            <td class="text-center">
              
              <a href="{DATA.url_delete}" class="delete btn btn-danger" onclick="nv_remove_from_cart()">Xóa</a>
            </td>
          </tr>
      <!-- END: dataLoop -->
      </tbody>
    </table>
    
  </div>
  <div class="form-group">
      <label for="">Tổng giá trị đơn hàng: </label>
      <h1 class="" id="payment-price">
                {POST.total_price_format} đ
      </h1>
      <input type="hidden" class="form-control" name="total_price" value="{POST.total_price}">
  </div>
<!-- order_detail -->
</div>
    <div class="text-center" ><input style="margin-top:10px;" class="btn btn-primary submit" name="submit" type="submit" value="{LANG.save}" /></div>
</form>
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.css">
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js"></script>


<script type='text/javascript'>
function updateCart() {
                //gán biến total=0
                var total = 0;
                //duyệt qua các dòng input số lượng sản phẩm trong giỏ hàng
                $("input[name='product_quantity[]']").each(function (index, value) {
                    //in ra console thứ tự trong giỏ hàng
                    console.log(index);
                    //in ra console số lượng từng sản phẩm
                    console.log(value);
                    //gán t = dòng input số lượng sản phẩm trong giỏ hàng
                    var t = $(this);
                    //gán tr = dòng chứa sản phẩm
                    var tr = t.closest("tr");
                    //gán quantity = số lượng của sản phẩm 
                    var quantity = t.val();
                    //gán price = giá sản phẩm
                    var price = tr.find("i.product_price").text();
                    //làm tròn price
                    price = parseFloat(price);
                    //gán tt = số lượng * giá 
                    var tt = quantity*price;
                    //in ra console các biến quantity, price, tt
                    console.log(quantity);
                    console.log(price);
                    console.log(tt);
                    //in ra trong giỏ hàng ô tổng giá trị của sản phẩm = biến tt
                    tr.find(".product_price_total").text(new Intl.NumberFormat().format(tt) + ' đ');
                    //khi tổng giá trị mỗi sản phẩm thay đổi thì cập nhật lại tổng giá trị đơn hàng
                    total += tt;
                });
                //in ra trong giỏ hàng tổng giá trị của đơn hàng bằng biến total
                $("#payment-price").text(new Intl.NumberFormat().format(total) + ' đ');


            }

            
      $(document).ready(function() {
          updateCart();

          

          $('#add_product').select2();
          $("#add_to_cart").on("click", function (e) {
                //tạm dừng hành động chuyển trang
                e.preventDefault();
                //gán biến id = giá trị trong ô #add_product
                var id = $('#add_product').val();
                var price = $("[data-id=" + id + "]").attr('price');
                var order_id = $("[name=id]").val();
                var total_price = $("[name=total_price]").val();
                //ép kiểu id về số nguyên
                id = parseInt(id);
                // gán biến checkTr = độ dài của thẻ có id là tr-+product.id
                var checkTr = $("tbody#list-cart-product").find("#tr-"+id).length;
                // ép kiểu biến checkTr về số nguyên
                checkTr = parseInt(checkTr);

                //nếu id > 0 (người dùng đã chọn sản phẩm)
                //nếu checkTr < 1 (sản phẩm chưa có trong giỏ hàng)
                if (id > 0 && checkTr < 1) {
                  $.ajax({
                    url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=update_order',
                    method: 'POST',
                    dataType:"text",
                    data: {id: id, price: price, order_id: order_id, total_price: total_price},
                    success: function(data) {
                        location.reload();
                    }
                });
                } else {
                  alert('Thêm sản phẩm không thành công do chưa chọn sản phẩm hoặc sản phẩm đã tồn tại trong đơn hàng');
                }
            });

          $('.delete').click(function() {
              
              var xn = confirm('Bạn có chắc chắn muốn xóa?');
              if (xn == true) {
                updateCart();
                return true;
                
              } else { 
                return false; 
              }
              
          });
          
         $("body").on("change", "input[name='product_quantity[]']", function () {
                //gán biến quantity = số lượng sản phẩm trong giỏ hàng
                var quantity = $(this).val();
                //ép kiểu biến quantity về số nguyên
                quantity = parseInt(quantity);
                //nếu số lượng sản phẩm >0 hoặc <6
                if (quantity > 0 && quantity < 6) {
                    //chạy hàm updateCart để update lại giỏ hàng
                    updateCart();
                    //ngoài ra
                } else {
                    //chuyển giá trị trong ô số lượng sản phẩm về 1
                    $(this).val(1);
                    //alert thông báo lỗi
                    alert("chỉ được mua số lượng (1 đến 5)/một sản phẩm");
                    //chạy lại hàm updatecart
                    updateCart();
                }

            });
      });
</script>

<!-- END: main -->