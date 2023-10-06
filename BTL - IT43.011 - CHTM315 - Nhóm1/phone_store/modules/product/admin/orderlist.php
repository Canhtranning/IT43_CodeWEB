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

$page_title = $lang_module['order.list'];

$post['name'] = $nv_Request->get_title('name', 'get', '');
$post['email'] = $nv_Request->get_title('email', 'get', '');
$post['phone'] = $nv_Request->get_title('phone', 'get', '');

$post['payment_method'] = $nv_Request->get_int('payment_method', 'get', 0);
$post['active'] = $nv_Request->get_int('active', 'get', '');
$success = $nv_Request->get_int('success', 'get', 0);
/* CODE PHÂN TRANG PAGINATION*/
//gán số lượng hiển thị mỗi trang
$perpage = 5;
//nhận biến page từ url
$page = $nv_Request->get_int('page', 'get', 1);
// đếm dòng dữ liệu trong bảng nv4_vi_book_orders

//Tìm kiếm theo category_id
if (!empty($post['email']))
{
    $email_search_query = ' AND email=' . $post['email'];
}
//Tìm kiếm theo phone
if (!empty($post['phone']))
{
    $phone_search_query = ' AND phone=' . $post['phone'];
}
//Tìm kiếm theo payment_method
if (!empty($post['payment_method']))
{
    $payment_method_search_query = ' AND payment_method=' . $post['payment_method'];
}
//Tìm kiếm theo active
if (!empty($post['active']))
{
    $active_search_query = ' AND active=' . $post['active'];
}

$db->sqlreset()
    ->select('COUNT(*)')
    ->from('nv4_vi_book_orders')
    ->where('name LIKE ' . "'%". $post['name']  . "%'" . $email_search_query . $phone_search_query . $payment_method_search_query . $active_search_query);

$sql = $db->sql();
//đếm số bản ghi
$total = $db->query($sql)->fetchColumn();


/* lấy id và action để kiểm tra delete */
$post['action'] = $nv_Request->get_title('action', 'get', '');
$post['id'] = $nv_Request->get_title('id', 'post, get', '');
$checksess = $nv_Request->get_title('checksess', 'post, get', '');
/* DELETE Sản phẩm */
if (!empty($post['action']) && $post['action'] == 'delete' && $post['id']>0 && $checksess == md5($post['id'] . NV_CHECK_SESSION))
{
    
    //xóa csdl trong bảng orders
    $sql = "DELETE FROM `nv4_vi_book_orders` WHERE `id`=:id";
    $s = $db->prepare($sql);
    $s->bindParam('id', $post['id']);
    $s->execute();

    //xóa csdl trong bảng order_detail
    $sql = "DELETE FROM `nv4_vi_book_order_detail` WHERE `order_id`=:id";
    $s = $db->prepare($sql);
    $s->bindParam('id', $post['id']);
    $s->execute();

    $alert = 'Xóa thành công';
    
}
/* END DELETE */

$xtpl = new XTemplate('orderlist.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
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
    $xtpl->parse('list.activeLoop');
}
/* End active */
/* Xuất giá trị payment_method ra site */
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
    $xtpl->parse('list.pmLoop');
}
/* End payment_method */

/* In dữ liệu ra orderlist */
$db->select('*')
    ->limit($perpage)
    ->offset(($page - 1) * $perpage)
    ->where('name LIKE ' . "'%". $post['name']  . "%'" . $email_search_query . $phone_search_query . $payment_method_search_query . $active_search_query)
    ->order('id DESC');
    
    $sql = $db->sql();
    $result = $db->query($sql);
//hiển thị payment_method
foreach ($result as $data)
{
    switch ($data['payment_method']) {
        case 2:
            $data['payment_method'] = 'Chuyển khoản';
            break;
        case 3:
            $data['payment_method'] = 'Thẻ tín dụng';
            break;
        default:
            $data['payment_method'] = 'Tiền mặt';
            break;
    }
    //hiển thị active
    $data['active'] = $data['active'] == 2 ? 'Đã Giao Hàng' : 'Chưa giao hàng';
    $data['total_price'] = number_format($data['total_price']);
    $data['url_edit'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=update_order&amp;action=edit&amp;id=' . $data['id'];
    $data['url_delete'] = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=orderlist&amp;action=delete&amp;id=' . $data['id'] . '&checksess=' . md5($data['id'] . NV_CHECK_SESSION);
    $xtpl->assign('DATA', $data);
    $xtpl->parse('list.dataLoop');
}

/* Link pagination */
$base_url = NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=orderlist';

//Phân trang khi chuyển trang không bị mất lọc
if (!empty($post['name']))
{
    $base_url .= '&name=' . $post['name'];
}
if (!empty($post['email']))
{
    $base_url .= '&email=' . $post['email'];
}
if (!empty($post['phone']))
{
    $base_url .= '&phone=' . $post['phone'];
}
if (!empty($post['payment_method']))
{
    $base_url .= '&payment_method=' . $post['payment_method'];
}
if (!empty($post['active']))
{
    $base_url .= '&active=' . $post['active'];
}
$generate_page = nv_generate_page($base_url, $total, $perpage, $page);
$xtpl->assign('GENERATE_PAGE', $generate_page);

if ($total > 5 )
{
    $xtpl->parse('list.page');
}
/* END pagination */
//Hiển thị thông báo
if (!empty($alert))
{
    $xtpl->assign('ALERT', $alert);
    $xtpl->parse('list.alert');
}

if ($success == 1)
{   
    $order_id = $nv_Request->get_int('order_id', 'get', 0);
    $success_info = 'Sửa thông tin đơn hàng id ' . $order_id . ' thành công';
    $xtpl->assign('SUCCESS', $success_info);
    $xtpl->parse('list.success');
}

$xtpl->parse('list');
$contents = $xtpl->text('list');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
