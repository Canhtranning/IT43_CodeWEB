<!-- BEGIN: main -->
<h1>Giỏ hàng</h1>
<!-- BEGIN: error -->
    <div class='alert alert-warning' role="alert">{ERROR}</div>
    
<!-- END: error -->
<!-- BEGIN: alert -->
    <div class='alert alert-info' role="alert">{ALERT}</div>
<!-- END: alert -->
<form action="{NV_BASE_SITEURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">

    <div class="col-xs-18 col-sm-18 col-md-18">
    <!-- BEGIN: dataLoop -->
    
      <div class="media">
        <div class="media-left media-middle">
            <a href="#">
                <img class="media-object" src="{VAL_CART_ITEM.image}" alt="{VAL_CART_ITEM.name}">
            </a>
        </div>
        <div class="media-body">
            <h2 class="media-heading">{VAL_CART_ITEM.name}</h2>
            <h4>{LANG.price}: <i>{VAL_CART_ITEM.format_price}</i> {LANG.vnd}</h4>
            <i class="product_price" style="display:none;">{VAL_CART_ITEM.price}</i>
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="input-group">
                            <input type="hidden" class="form-control" name="product_ids[]" aria-label="..." value="{VAL_CART_ITEM.id}"/>
                            <span class="input-group-addon">
                                {LANG.quantity}:
                            </span>
                            <input type="number" class="form-control" name="product_quantity[]" aria-label="..." value="{VAL_CART_ITEM.quantity}" min=1 max=5 />
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-md-4 col-md-offset-3">
                        <div class="input-group">
                        
                            <a href="{DATA.url_delete}" class="remove btn btn-danger" onclick="nv_remove_from_cart({VAL_CART_ITEM.id}, 'remove')">
                                <em class="fa fa-trash-o margin-right"></em>
                                Xóa
                            </a>
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
            
            <h1 class="text-right product_price_total" >
                {LANG.into_money}: {VAL_CART_ITEM.format_price} {LANG.vnd}
                
            </h1>
        </div>
    </div>
    
    <hr>
    <!-- END: dataLoop -->
        <h2>{LANG.total_price}: <b id="payment-price">{TOTAL_BILL}</b> {LANG.vnd}</h2>
    <hr>
    
    </div>
    
    <div class="col-xs-6 col-sm-6 col-md-6">
    <div class="panel panel-danger">
        <div class="panel-body">
            <h1>Thông tin khách hàng</h1>
        <div class="row">
            <div >
                <label for=""><i class="fa fa-star" aria-hidden="true"></i> {LANG.name_user}: </label>
                <input type="text" class="form-control" name="name" value="{POST.name}">
            </div>
        </div>
        <div class="row">
            <div>
                <label for=""><i class="fa fa-star" aria-hidden="true"></i> {LANG.email}: </label>
                <input type="text" class="form-control" name="email" value="{POST.email}">
            
            </div>
        </div>
        <div class="row">
            <div>
                <label for=""><i class="fa fa-star" aria-hidden="true"></i> {LANG.phone}: </label>
                <input type="text" class="form-control" name="phone" value="{POST.phone}">
            </div>
        </div>
        <div class="row">
            <div>
                    <label for=""> <i class="fa fa-star" aria-hidden="true"></i> {LANG.address}: </label>

                    <select name="province" id="province" class="form-control">
                        <option value="">---Chọn Thành Phố---</option>
                        <!-- BEGIN: loopProvince -->
                            <option value="{DATA_PROVINCE.id}" {DATA_PROVINCE.selected}>{DATA_PROVINCE.title}</option>
                        <!-- END: loopProvince -->
                    </select>
                </div>
            </div>
            <div class="row">
                <div >
                    <select name="district" id="district" class="form-control">
                        <option value="">---Chọn Quận---</option>
                        
                    </select>
                </div>
            </div>
            <div class="row">

                <div>
                    <select name="ward" id="ward" class="form-control">
                        <option value="">---Chọn Phường---</option>
                        
                    </select>
                </div>
            </div>
            <div class="row">
                <div >
                    <label for="">{LANG.order_note}: </label>
                    <textarea class="form-control" name="order_note">{POST.order_note}</textarea>
                </div>
            </div>
            <div class="row">
                <div>
                    <label for=""><i class="fa fa-star" aria-hidden="true"></i> {LANG.payment_method}: </label>
                    <select name="payment_method" class="form-control">
                        <option value="">Chọn Phương Thức</option>
                        <!-- BEGIN: pmLoop -->
                        <option value="{PAYMENT.key}">{PAYMENT.value}</option>
                        <!-- END: pmLoop -->
                    </select>
                </div>
            </div>
            
        <div class="text-center" ><input style="margin-top:10px;" class="btn btn-primary" name="submit" type="submit" value="Đặt hàng" /></div>
        </div>
     </div>
     </div>
    </form>
<link rel="stylesheet" href="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.css">
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/select2/select2.min.js"></script>
<script type="text/javascript">
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
                    var tr = t.closest("div.media");
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
                    tr.find("h1.product_price_total").text('Thành tiền: ' + new Intl.NumberFormat().format(tt) + ' đ');
                    //khi tổng giá trị mỗi sản phẩm thay đổi thì cập nhật lại tổng giá trị đơn hàng
                    total += tt;
                });
                //in ra trong giỏ hàng tổng giá trị của đơn hàng bằng biến total
                $("#payment-price").text(new Intl.NumberFormat().format(total));


            }
function nv_remove_from_cart(id, action) {
    $("body").on("click", "a.remove", function (e) {
            var xn = confirm('Bạn có chắc chắn muốn xóa sản phẩm khỏi giỏ hàng?');
            if (xn == true) {
            //xóa dòng sản phẩm chứa nút remove vừa click
            $(this).closest("div.media").remove();
            //chạy hàm updateCart để update lại giỏ hàng
            updateCart();
            $.ajax({
                url: nv_base_siteurl + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=cart',
                method: 'POST',
                dataType:"text",
                data: {id: id, action: action},
                success: function(data) {
                    alert('xóa sản phẩm khỏi giỏ hàng thành công');
                }
            });
        
            return true;
    
            } else { 
                return false; 
            }
    });
}

$(document).ready(function() {
          
            $('#province').select2();
            $('#district').select2();
            $('#ward').select2();
            $('#province').change(function () {
                var province_id  = $(this).val();
                $.ajax({
                    url: nv_base_siteurl + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=cart',
                    method: 'POST',
                    dataType:"text",
                    data: {province_id: province_id},
                    success: function(data) {
                        $('#district').html(data);
                    }
                })
            });
            $('#district').change(function () {
                var district_id  = $(this).val();
                $.ajax({
                    url: nv_base_siteurl + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=cart',
                    method: 'POST',
                    dataType:"text",
                    data: {district_id: district_id},
                    success: function(data) {
                        $('#ward').html(data);
                    }
                })
            });
            $('#province').change(function () {
                var district_id  = $(this).val();
                $.ajax({
                    url: nv_base_siteurl + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=cart',
                    method: 'POST',
                    dataType:"text",
                    data: {district_id: district_id},
                    success: function(data) {
                        $('#ward').html(data);
                    }
                })
            });
            $("body").on("change", "input[name='product_quantity[]']", function () {
                //gán biến quantity = số lượng sản phẩm trong giỏ hàng
                var quantity = $(this).val();
                //ép kiểu biến quantity về số nguyên
                quantity = parseInt(quantity);
                //nếu số lượng sản phẩm >0 hoặc <100
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