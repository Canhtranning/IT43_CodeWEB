<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2020 VINADES.,JSC. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Tue, 10 Nov 2020 06:56:08 GMT
 */

if (!defined('NV_IS_MOD_SAMPLES')) {
    die('Stop!!!');
}

$page_title = $module_info['site_title'];
$key_words = $module_info['keywords'];

$row_order =[];
$post = $error = [];

if($nv_Request->isset_request("change_province", "post,get")){
    $id_province = $nv_Request->get_int('id_province', 'post,get', 0);
    if($id_province > 0){
        $sql = "SELECT `id`, `title` FROM `nv4_vi_location_district` WHERE idprovince = " . $id_province . " ORDER BY weight ASC";
        $result= $db->query($sql);
        $html='';
        while ($province = $result->fetch() ) {
            $html .= '<option value="'.$province['id'].'">'.$province['title'].'</option>';
        }
        die($html);
    }else {
        die("ERR");
    }
}

if($nv_Request->isset_request("change_district", "post,get")){
    $id_district = $nv_Request->get_int('id_district', 'post,get', 0);
    if($id_district > 0){
        $sql = "SELECT `id`, `title` FROM `nv4_vi_location_ward` WHERE iddistrict = " . $id_district . " ORDER BY weight ASC";
        $result= $db->query($sql);
        $html='';
        while ($district = $result->fetch() ) {
            $html .= '<option value="'.$district['id'].'">'.$district['title'].'</option>';
        }
        die($html);
    }else {
        die("ERR");
    }
}

$sql ="SELECT `id`, `title` FROM `nv4_vi_location_province` ORDER BY weight ASC";
$result= $db->query($sql);
$array_province = [];
while ($province = $result->fetch() ) {
//     print_r($province);
    $array_province[$province['id']]= $province;
}



if($nv_Request->isset_request("submit", "post")){
    $post['id'] = $nv_Request->get_int('id', 'post', '');
    $post['name_user'] = $nv_Request->get_title('name_user', 'post', '');
    $post['email'] = $nv_Request->get_title('email', 'post', '');
    $post['phone'] = $nv_Request->get_int('phone', 'post', '');
    $post['address'] = $nv_Request->get_title('address', 'post', '');
    $post['quantity'] = $nv_Request->get_int('quantity', 'post', '');
    $post['price'] = $nv_Request->get_int('price', 'post', '');
    $post['order_note'] = $nv_Request->get_title('order_note', 'post', '');
    $post['province'] = $nv_Request->get_int('province', 'post', '');
    $post['district'] = $nv_Request->get_int('district', 'post', '');
    $post['ward'] = $nv_Request->get_int('ward', 'post', '');
    
    if(empty($post['name_user'])) {
        $error[]= $lang_module['error_name_user'];
    }
    
    if(empty($post['email'])) {
        $error[]= $lang_module['error_email'];
    }elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
        $error[]= $lang_module['error_email_@'];
    }
    
    if(empty($post['phone'])) {
        $error[]= $lang_module['error_phone'];
    }
    
    if(empty($post['province']) || empty($post['district']) || empty($post['ward'])) {
        $error[]= $lang_module['error_address'];
    }
    
    if($post['quantity'] <= 0 || $post['quantity'] > 10) {
        $error[]= $lang_module['error_quantity'];
    }elseif(is_float($post['quantity'])) {
        $error[]= $lang_module['error_quantity_float'];
    }elseif(is_string($post['quantity'])) {
        $error[]= $lang_module['error_quantity_str'];
    }
    

    
    $total_price= $post['quantity'] * $post['price'];
    
    $sql = "SELECT `id`, `title` FROM `nv4_vi_location_ward` WHERE id = " . $post['ward'];
    $ward= $db->query($sql)->fetch();
    
    $sql = "SELECT `id`, `title` FROM `nv4_vi_location_district` WHERE id = " . $post['district'] ;
    $district = $db->query($sql)->fetch();
    
    $sql ="SELECT `id`, `title` FROM `nv4_vi_location_province` WHERE id = " . $post['province'];
    $province = $db->query($sql)->fetch();
    

    if(empty($error)){
       
           $sql = "INSERT INTO `nv4_vi_book_orders`(`name`, `email`, `phone`, `address`, `total_price`, `order_note`, `payment_method`, `weight`, `active`, `created_at`) VALUES (:name, :email, :phone, :address, :total_price, :order_note, :payment_method, :weight, :active, :created_at)";
           $s = $db->prepare($sql);
           
           $s->bindParam('name', $post['name_user'] );
           $s->bindParam('email', $post['email']);
           $s->bindParam('phone', $post['phone']);
           $s->bindValue('address', $province['title'] .'-'. $district['title'] .'-'. $ward['title']);
           $s->bindParam('total_price', $total_price);
           $s->bindParam('order_note', $post['order_note']);
           $s->bindValue('payment_method', 1);
           $s->bindValue('active', 1);
           $s->bindValue('weight', 1);
           $s->bindValue('created_at', NV_CURRENTTIME);
           
           $exe = $s->execute();
           if ($exe) {
//                try {
               $sql = "SELECT id FROM `nv4_vi_book_orders`";
               $orders = $db->query($sql)->fetch();
               
               $sql = "INSERT INTO `nv4_vi_book_order_detail`(`order_id`, `product_id`, `quantity`, `price`) VALUES (:order_id, :product_id, :quantity, :price)";
               $s = $db->prepare($sql);
               $s->bindParam('order_id', $orders['id']);
               $s->bindParam('product_id', $post['id'] );
               $s->bindParam('quantity', $post['quantity'] );
               $s->bindParam('price', $post['price'] );
               $exe = $s->execute();
               $error[]= $lang_module['succ_I']; 
//                } catch (PDOException $e) {
//                    print_r($e);
//                }
           }
       
        
    }
    
}

$id = $nv_Request->get_title('id', 'post, get', '');

$sql = "SELECT * FROM `nv4_vi_book_product` WHERE id = " .$id;
$row_order = $db->query($sql)->fetch();
//------------------
// Viết code vào đây
//------------------

$contents = nv_theme_album_order($row_order, $post, $error, $array_province);



include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
