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

$array_data = [];

$row_cate=[];

/* CODE PHÂN TRANG PAGINATION*/
//gán số lượng hiển thị mỗi trang
$perpage = 6;
//nhận biến page từ url
$post = $array_search = [];
$post['name'] = $nv_Request->get_title('name', 'post, get', '');
$post['category_id'] = $nv_Request->get_int('category_id', 'post, get', 0);
$post['active'] = $nv_Request->get_int('active', 'post, get', '');
$page = $nv_Request->get_int('page', 'get', 1);
$search_query = '';

if (!empty($post['name'])) {
    $array_search[] = ' name LIKE ' . "'%". $post['name']  . "%'";
}
//Tìm kiếm theo category_id
if (!empty($post['category_id']))
{
    $array_search[] = ' category_id=' . $post['category_id'];
}
//Tìm kiếm theo active
if ($post['active'] > 0)
{
    $array_search[] = ' active=' . $post['active'];
}


$db->sqlreset()
->select('COUNT(*)')
->from('nv4_vi_book_product');

if (!empty($array_search)) {
    $db->where(implode(' AND ', $array_search));
}

$sql = $db->sql();
//đếm số bản ghi
$total = $db->query($sql)->fetchColumn();


//HIển thị sách
$db->sqlreset()
->select('*')
->from('nv4_vi_book_product');
if (!empty($array_search)) {
    $db->where(implode(' AND ', $array_search));
}
$db->limit($perpage)
->offset(($page - 1) * $perpage);
$sql = $db->sql();

$result= $db->query($sql);
$array_data = $result->fetchAll();

//Hiển thị danh sách
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

/* In danh sách category ra form tìm kiếm */
$sql = "SELECT * FROM `nv4_vi_book_category`";
$category = $db->query($sql);

$contents = nv_theme_album_main($array_data,$row_cate, $perpage, $page, $total, $category, $post);

include NV_ROOTDIR . '/includes/header.php';
echo nv_site_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
