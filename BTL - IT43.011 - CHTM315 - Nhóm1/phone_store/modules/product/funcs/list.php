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






/* CODE PHÂN TRANG PAGINATION*/
//gán số lượng hiển thị mỗi trang
$perpage = 5;
//nhận biến page từ url
$page = $nv_Request->get_int('page', 'get', 1);
// đếm dòng dữ liệu trong bảng 

    
    $db->sqlreset()
    ->select('COUNT(*)')
    ->from('nv4_vi_book_product');

    
    $sql = $db->sql();
//đếm số bản ghi
$total = $db->query($sql)->fetchColumn();


/* END PAGINATION  */

/* In ra từng trang dữ liệu */

$db->select('*')
    ->limit($perpage)
    ->offset(($page - 1) * $perpage);

    
    $sql = $db->sql();
    $result = $db->query($sql);
/* End */

/* Link pagination */
$base_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=list';


$generate_page = nv_generate_page($base_url, $total, $perpage, $page);

/* End link pagination */

$contents = nv_theme_samples_list($array_data, $result, $total, $generate_page);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
