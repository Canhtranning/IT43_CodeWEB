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

$row_cate = [];
$row_cate=[];

$id = $nv_Request->get_int('id', 'post, get', '');

$sql = "SELECT id, name FROM `nv4_vi_book_category`";
$qurey_cate = $db->query($sql);
$row_cate = [];
while ($cate = $qurey_cate->fetch()) {
    $sql = "SELECT COUNT(*) FROM `nv4_vi_book_product` where `category_id` = " . $cate['id'];
    $row_count = $db->query($sql)->fetchColumn();
    //có từng số lượng sản phẩm theo cat id r. gans lai vao cat ddo
    $cate['num'] = $row_count;
    $row_cate[$cate['id']] = $cate;
} // co num r thif hien thi ra css lai

$sql = "SELECT * FROM nv4_vi_book_product where category_id = " .$id;
$row_product = $db->query($sql)->fetchAll();

//------------------
// Viết code vào đây
//------------------

$contents = nv_theme_album_product($row_cate,$row_product);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
