<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2020 VINADES.,JSC. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Sat, 31 Oct 2020 02:20:33 GMT
 */

if (!defined('NV_IS_FILE_ADMIN')) {
    die('Stop!!!');
}

$page_title = $lang_module['update_order'];

function check_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$error = [];
$post = [];

$post['submit'] = $nv_Request->get_title('submit', 'post', '');
$post['name'] = check_input($nv_Request->get_title('name', 'post', ''));
$post['email'] = $nv_Request->get_title('email', 'post', '');
$post['phone'] = $nv_Request->get_title('phone', 'post', '');
$post['address'] = $nv_Request->get_title('address', 'post', '');
$post['order_note'] = check_input($nv_Request->get_title('order_note', 'post', ''));
$post['id'] = $nv_Request->get_int('id', 'post, get', 0);
$post['action'] = $nv_Request->get_title('action', 'get', '');
$post['payment_method'] = $nv_Request->get_int('payment_method', 'post', 0);
$post['order_note'] = $nv_Request->get_title('order_note', 'post', '');
$post['active'] = $nv_Request->get_title('active', 'post', '');

//lấy giá trị của mảng số lượng sp và mảng id sản phẩm
$product_quantities = $nv_Request->get_typed_array('product_quantity','post', '');
$product_ids = $nv_Request->get_typed_array('product_ids','post', '');



/* EDIT PRODUCT */
        //lấy dữ liệu trong database in ra form sửa
        try {
            if (!empty($post['action']) && $post['action'] == 'edit' && $post['id']>0)
            {
                $sql = "SELECT * FROM `nv4_vi_book_orders` WHERE id =" . $post['id'];
                $post = $db->query($sql)->fetch();
                $post['total_price_format'] = number_format($post['total_price']);
                
            }
        } catch (PDOException $e) {
            echo "<pre>";
            print_r($e);
            echo "</pre>";
        }
        
/* END EDIT PRODUCT */

/* UPDATE ORDER */
if(!empty($post['submit']))
{
    if (empty($post['name']))
    {
        $error[] = 'Bạn chưa nhập tên sản phẩm';
    }
    if (empty($post['email']))
    {
        $error[] = 'Bạn chưa nhập email';
    } else if (!preg_match("/^[a-z][a-z0-9_\.]{5,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/i", $post['email'])){
        $error[] = 'Email sai định dạng';
    }
    if (empty($post['phone']))
    {
        $error[] = 'Bạn chưa nhập số điện thoại';
    } else if (!preg_match('/[0-9][^#&<>\"~;$^%{}?a-zA-Z]{9,10}$/', $post['phone'])) {
        $error[] = 'số điện thoại không đúng định dạng';
    }
    if (empty($post['address']))
    {
        $error[] = 'Bạn chưa nhập địa chỉ';
    }
    
    if (empty($post['payment_method']))
    {
        $error[] = 'Bạn chưa nhập phương thức thanh toán';
    }
    if (empty($post['active']))
    {
        $error[] = 'Bạn chưa nhập trạng thái đơn hàng';
    }

    //xử lý mảng product_ids và product_quantity
    if (!empty($product_ids) && !empty($product_quantities))
    {
        $total_price_update = 0;
        foreach($product_ids as $product_ids_key => $productId) {
            //
            $quantity = $product_quantities[$product_ids_key];
            if ($quantity <= 0)
            {
                $error[] = 'Số lượng sản phẩm không đúng';
            }
            $sql = "SELECT * FROM `nv4_vi_book_product` WHERE id=" . $productId;
            $product = $db->query($sql)->fetch();
            $totalPriceProduct = $quantity*$product['price'];
            $total_price_update += $totalPriceProduct;
        }
    } else {
        $error[] = 'Bạn chưa nhập số lượng sản phẩm';
    }

    if (empty($error))
    {
        if ($post['id'] > 0) 
        {
            try {
                //update bảng orders
            $sql = "UPDATE `nv4_vi_book_orders` SET `name`=:name,`email`=:email,`phone`=:phone,`address`=:address,`total_price`=:total_price,`order_note`=:order_note,`payment_method`=:payment_method, `active`=:active WHERE `id`=" . $post['id'];
            $s = $db->prepare($sql);
            $s->bindParam('name', $post['name']);
            $s->bindParam('email', $post['email']);
            $s->bindParam('phone', $post['phone']);
            $s->bindParam('address', $post['address']);
            $s->bindValue('total_price', $total_price_update);
            $s->bindParam('order_note', $post['order_note']);
            $s->bindParam('payment_method', $post['payment_method']);
            $s->bindParam('active', $post['active']);
            
            if ($s->execute())
            {
                //update bảng order_detail
                foreach($product_ids as $product_ids_key => $productId) {
                    //
                    $quantity = $product_quantities[$product_ids_key];
                    
                    $sql = "UPDATE `nv4_vi_book_order_detail` SET `quantity`=:quantity WHERE `order_id`=" . $post['id'] . " AND `product_id`=" . $productId;
                    $s = $db->prepare($sql);
                    $s->bindValue('quantity', $quantity);
                    $s->execute();
                    
                        
                    
                    
                        
                    
                }
                $alert = 'Sửa Thành công';
                nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=orderlist&amp;success=1&amp;order_id=' . $post['id']);
            }
            } catch (PDOException $e) {
                echo "<pre>";
                print_r($e);
                echo "</pre>";
            }
            
                
                
        }
    }
}

/* lấy id và action để kiểm tra delete sản phẩm khỏi đơn hàng */

$post['order_id'] = $nv_Request->get_int('order_id', 'post, get', '');
$post['product_id'] = $nv_Request->get_int('product_id', 'get', 0);

$checksess = $nv_Request->get_title('checksess', 'post, get', '');
/* DELETE Sản phẩm trong order_detail */
if (!empty($post['action']) && $post['action'] == 'delete' && $post['product_id']>0 && $post['order_id']>0)
{
    
    //xóa csdl
    $sql = "DELETE FROM `nv4_vi_book_order_detail` WHERE `order_id`=:order_id AND `product_id` =:product_id";
    $s = $db->prepare($sql);
    $s->bindParam('order_id', $post['order_id']);
    $s->bindParam('product_id', $post['product_id']);
    
    if ($s->execute()) {
        $post['total_price_update'] = $nv_Request->get_int('total_price_update', 'get', 0);
        $sql = "UPDATE `nv4_vi_book_orders` SET `total_price`=:total_price_update WHERE `id`=:order_id";
        $s = $db->prepare($sql);
        $s->bindParam('order_id', $post['order_id']);
        $s->bindParam('total_price_update', $post['total_price_update']);
        $s->execute();
        nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=update_order&amp;action=edit&amp;id=' . $post['order_id']);
    }
    $alert = 'Xóa thành công';
    
    
}
/* END DELETE */

/* Ajax thêm sp vào đơn hàng */
$add_product = $nv_Request->get_int('id', 'post', 0);
$price = $nv_Request->get_int('price', 'post', 0);
$total_price = $nv_Request->get_int('total_price', 'post', 0);
if ($add_product > 0) {
    $sql = "INSERT INTO `nv4_vi_book_order_detail`(`order_id`, `product_id`, `quantity`, `price`) VALUES (:order_id, :product_id, :quantity, :price)";
    $s = $db->prepare($sql);
    $s->bindParam('order_id', $post['order_id']);
    $s->bindParam('product_id', $add_product);
    $s->bindValue('quantity', 1);
    $s->bindParam('price', $price);

    if ($s->execute())
    {
        $sql = "UPDATE `nv4_vi_book_orders` SET `total_price`=:total_price_update  WHERE id=:order_id";
        $s = $db->prepare($sql);
        $s->bindParam('order_id', $post['order_id']);
        $s->bindValue('total_price_update', ($total_price + $price));
        $s->execute();
        /* nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=update_order&amp;action=edit&amp;id=' . $post['order_id']); */
        
    }

}
/* End Ajax */

$xtpl = new XTemplate('update_order.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);
$xtpl->assign('POST', $post);

/* Xuất giá trị active ra site */
$array_active = [];
$array_active[1] = 'Chưa giao hàng';
$array_active[2] = 'Đã Giao hàng';

foreach ($array_active as $key => $value)
{
    $xtpl->assign('ACTIVE', [
        'key' => $key,
        'value' => $value,
        'selected' => ($post['active'] == $key) ? 'selected' : '',
    ]);
    $xtpl->parse('main.activeLoop');
}
/* End active */

/* In giá trị payment_method ra site */
$array_payment = [];
$array_payment[1] = 'Tiền mặt';
$array_payment[2] = 'Chuyển khoản';
$array_payment[3] = 'Thẻ tín dụng';
foreach ($array_payment as $key => $value)
{
    $xtpl->assign('PAYMENT', [
        'key' => $key,
        'value' => $value,
        'selected' => ($post['payment_method'] == $key) ? 'selected' : '',
    ]);
    $xtpl->parse('main.pmLoop');
}
/* End payment_method */

/* In danh sách sản phẩm trong nút thêm sản phẩm */
$sql = "SELECT id,name,image,price FROM `nv4_vi_book_product`";
$result = $db->query($sql);
foreach ($result as $product)
{
    $product['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/'. $module_name . '/' . $product['image'];
    $product['format_price'] = number_format($product['price']);

    $xtpl->assign('PRODUCT', $product);
    $xtpl->parse('main.productLoop');
}
/* End in danh sách sản phẩm */

//Lấy dữ liệu của bảng orders và order_detail đổ ra bảng sản phẩm trong đơn hàng
// detail.order_id, detail.product_id, detail.quantity, detail.price, product.name, product.image, 
$sql = "SELECT * FROM `nv4_vi_book_order_detail` LEFT JOIN `nv4_vi_book_product` ON nv4_vi_book_order_detail.product_id = nv4_vi_book_product.id WHERE `order_id`=" . $post['id'];
$result = $db->query($sql);

foreach ($result as $data)
{
    
    $data['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/'. $module_name . '/' . $data['image'];
    $data['line_price'] = number_format($data['price'] * $data['quantity']);
    $data['format_price'] = number_format($data['price']);
    $data['url_edit'] = '#';
    $data['url_delete'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=update_order&amp;action=delete&amp;order_id=' . $data['order_id'] . '&product_id=' . $data['product_id'] . '&total_price_update=' . ($post['total_price'] - ($data['price'] * $data['quantity'])) . '&checksess=' . md5($data['id'] . NV_CHECK_SESSION);
    /* echo "<pre>";
    print_r($data);
    echo "</pre>";
    die(); */
    $xtpl->assign('DATA', $data);
    $xtpl->parse('main.dataLoop');
}
/* Hiển thị cảnh báo lỗi và thông báo sửa thành công */
if (!empty($alert)) {
    $xtpl->assign('ALERT', $alert);
    $xtpl->parse('main.alert');
}
if (!empty($error)) {
    $xtpl->assign('ERROR', implode("<br>", $error));
    $xtpl->parse('main.error');
}
/* END thông báo */

/* if ($post['id'] > 0)
{ */
    
/* } */ 
//test git in vscode

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
