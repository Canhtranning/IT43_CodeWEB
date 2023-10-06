<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2020 VINADES.,JSC. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Sat, 31 Oct 2020 02:20:33 GMT
 */

if (!defined('NV_IS_MOD_SAMPLES')) {
    die('Stop!!!');
}

$page_title = $module_info['site_title'];
$key_words = $module_info['keywords'];

$array_data = [];
$post=[];
$error=[];
$product_ids = [];
$product_quantities = [];

function check_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$cart_item_id = $nv_Request->get_int('id', 'post', 0);
$cart_item_action = $nv_Request->get_title('action', 'post', '');
$post['id'] = $cart_item_id;
$post['action'] = $cart_item_action;
$post['submit'] = $nv_Request->get_title('submit', 'post', '');
$post['name'] = check_input($nv_Request->get_title('name', 'post', ''));
$post['email'] = $nv_Request->get_title('email', 'post', '');
$post['phone'] = check_input($nv_Request->get_title('phone', 'post', ''));
$post['order_note'] = check_input($nv_Request->get_title('order_note', 'post', ''));
$post['payment_method'] = $nv_Request->get_int('payment_method', 'post', 0);
$post['province'] = $nv_Request->get_int('province', 'post', 0);
$post['district'] = $nv_Request->get_int('district', 'post', 0);
$post['ward'] = $nv_Request->get_int('ward', 'post', 0);

$product_quantities = $nv_Request->get_typed_array('product_quantity','post', '');

$product_ids = $nv_Request->get_typed_array('product_ids','post', '');




 /* BEGIN xuất ra province*/
 $sql_site_province = "SELECT id, title FROM `nv4_vi_location_province`";
 $s = $db->prepare($sql_site_province);
 $s->execute();
 $result = $s->fetchAll(PDO::FETCH_ASSOC);

 /* END code xuất ra site */
/* Ajax */
$province_id = $nv_Request->get_int('province_id', 'post', 0);
if (!empty($province_id))
    {
        $sql = "SELECT id, title FROM `nv4_vi_location_district` WHERE idprovince = $province_id";
        $s = $db->prepare($sql);
        $s->execute();
        $result = $s->fetchAll(PDO::FETCH_ASSOC);
        $html .= '<option value="">---Chọn Quận---</option>';
        foreach ($result as $data)
        {
            $data['selected'] = $data['id'] == $post['district'] ? 'selected' : '';
            $html .= '<option value=' . $data['id'] . $data['selected'] . '>' . $data['title'] . '</option>';
        }
        die($html);
    }
    $district_id = $nv_Request->get_int('district_id', 'post', 0);
    if (!empty($district_id))
    {

        $sql = "SELECT id, title FROM `nv4_vi_location_ward` WHERE iddistrict = $district_id";
        $s = $db->prepare($sql);
        $s->execute();
        $result = $s->fetchAll(PDO::FETCH_ASSOC);
        $html .= '<option value="">---Chọn phường---</option>';
        foreach ($result as $data)
        {
            $data['selected'] = $data['id'] == $post['ward'] ? 'selected' : '';
            $html .= '<option value=' . $data['id'] . $data['selected'] . '>' . $data['title'] . '</option>';
        }
        die($html);
    }
/* End of Ajax */


/*session Giỏ hàng */
if(!empty($post))
{
    if(!empty($post['action']))
    {
        switch($post['action'])
        {
            case 'add' :
                if($cart_item_id > 0)
                {
                    $sql = "SELECT * FROM `nv4_vi_book_product` WHERE id=" . $post['id'];
                    $product = $db->query($sql)->fetch();
                    if (!empty($product['image']))
                    {
                        $product['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/'. $module_name . '/' . $product['image'];

                    }

                    $product_id = $product['id'];
                    if (!empty($_SESSION['cart_item']))
                    {
                        if (isset($_SESSION['cart_item'][$product_id]))
                        {
                            //sản phẩm đã tồn tại trong giỏ hàng
                            echo 'sản phẩm đã tồn tại trong giỏ hàng';
                            die();
                        } else {
                            //Sản phẩm chưa tồn tại trong giỏ hàng
                                //gán biến cart_item bằng array thông tin sản phẩm người dùng muốn thêm vào giỏ hàng
                            $cart_item = array();
                            $cart_item['id'] = $product['id'];
                            $cart_item['name'] = $product['name'];
                            $cart_item['image'] = $product['image'];
                            $cart_item['price'] = $product['price'];
                            $cart_item['quantity'] = 1;
                            //cập nhật session của sản phẩm vừa thêm vào giỏ hàng
                            $_SESSION['cart_item'][$product_id] = $cart_item;

                            die('Thêm sản phẩm vào giỏ hàng thành công');
                        }
                    }  else {
                        // gán dữ liệu cho $_SESSION['cart_item'] khi chưa có dữ liệu
                        $_SESSION['cart_item'] = array();
                        $product_id = $product['id'];
                        //gán biến cart_item bằng array thông tin sản phẩm người dùng muốn thêm vào giỏ hàng
                        $cart_item = array();
                        $cart_item['id'] = $product['id'];
                        $cart_item['name'] = $product['name'];
                        $cart_item['image'] = $product['image'];
                        $cart_item['price'] = $product['price'];
                        $cart_item['quantity'] = 1;
                        $_SESSION['cart_item'][$product_id] = $cart_item;
                        die('Thêm sản phẩm vào giỏ hàng thành công');

                    }
                }
                break;
            case 'remove' :
                if($post['id'] > 0)
                {
                    $product_id = $post['id'];
                    if (isset($_SESSION['cart_item'][$product_id]))
                        {
                            //hủy id của sản phẩm cần xóa
                            unset($_SESSION['cart_item'][$product_id]);
                        }
                }
                break;
            default:
                echo 'action không tồn tại';
                die;

        }
    }
}
/* End session giỏ hàng */

/* create order */
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
    } else if ((!preg_match('/[0-9][^#&<>\"~;$^%{}?a-zA-Z]{9,10}$/', $post['phone'])) || !is_numeric($post['phone'])) {
        $error[] = 'số điện thoại không đúng định dạng';
    }
    if (empty($post['payment_method']))
    {
        $error[] = 'Bạn chưa nhập phương thức thanh toán';
    }

    if (empty($post['province']) || empty($post['province']) || empty($post['province']))
    {
        $error[] = 'Bạn chưa nhập địa chỉ';
    } else {
        $sql = "SELECT title FROM `nv4_vi_location_province` WHERE id =" . $post['province'];
        $province = $db->query($sql)->fetch();

        $sql = "SELECT title FROM `nv4_vi_location_district` WHERE id =" . $post['district'];
        $district = $db->query($sql)->fetch();

        $sql = "SELECT title FROM `nv4_vi_location_ward` WHERE id =" . $post['ward'];
        $ward = $db->query($sql)->fetch();
    }
    //xử lý mảng product_id và product_quantity
    if (!empty($product_ids) && !empty($product_quantities))
    {
        $post['total_price'] = 0;
        foreach($product_ids as $product_ids_key => $productId) {
            //
            $quantity = $product_quantities[$product_ids_key];
            $sql = "SELECT * FROM `nv4_vi_book_product` WHERE id=" . $productId;
            $product = $db->query($sql)->fetch();
            $totalPriceProduct = $quantity*$product['price'];
            $post['total_price'] += $totalPriceProduct;
        }
    } else {
        $error[] = 'Bạn chưa nhập số lượng sản phẩm';
    }


    if (empty($error))
    {
        $sql = "INSERT INTO `nv4_vi_book_orders` (`name`,`email`,`phone`,`address`,`total_price`,`order_note`,`payment_method`, `active`)  VALUES (:name, :email, :phone, :address, :total_price, :order_note, :payment_method, :active)";
        $s = $db->prepare($sql);
        $s->bindParam('name', $post['name']);
        $s->bindParam('email', $post['email']);
        $s->bindParam('phone', $post['phone']);
        $s->bindValue('address', $ward['title'] . ', ' . $district['title'] . ', ' . $province['title']);
        $s->bindValue('total_price', $post['total_price']);
        $s->bindParam('order_note', $post['order_note']);
        $s->bindParam('payment_method', $post['payment_method']);
        $s->bindValue('active', 1);
        if ($s->execute())
        {
            //lấy ra id vừa insert
            $order_id = $db->lastInsertId();

            foreach($product_ids as $product_ids_key => $productId) {
                //creat order_detail
                $quantity = $product_quantities[$product_ids_key];
                $sql = "SELECT price FROM `nv4_vi_book_product` WHERE id=" . $productId;
                $product = $db->query($sql)->fetch();
                    $sql = "INSERT INTO `nv4_vi_book_order_detail` (`order_id`,`product_id`,`quantity`,`price`)  VALUES (:order_id, :product_id, :quantity, :price)";
                    $s = $db->prepare($sql);
                    $s->bindValue('order_id', $order_id);
                    $s->bindValue('product_id', $productId);
                    $s->bindValue('quantity', $quantity);
                    $s->bindValue('price', $product['price']);
                    $s->execute();

                    unset($_SESSION['cart_item']);
                    $alert = 'Đặt hàng thành công';
                    $url = NV_BASE_SITEURL;
                    $contents = nv_theme_alert($lang_global['site_info'] , $alert, 'info', $url, $lang_module['info_redirect_click'], 5);
                    include NV_ROOTDIR . '/includes/header.php';
                    echo nv_site_theme($contents);
                    include NV_ROOTDIR . '/includes/footer.php';
            }

        }
    }
}
/* End create order*/

/* if ($cart_item_id > 0)
{
    $post = serialize($post);
     $post = json_encode($post);
    $nv_Request->set_Session("cart_item", $post);
    $post2 = $nv_Request->get_title('cart_item', 'session', '');
    if($post2 !='') {
        $post2 = json_decode($post2,true);
        print_r($post2);die;
    }

    die('ERR');
     $_SESSION['cart_item'][$cart_item_id] = $post;
    echo "<pre>";
    print_r($_SESSION['cart_item']);
    echo "</pre>";
    die();

} */

$contents = nv_theme_samples_cart($array_data, $result, $error, $alert, $post);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
