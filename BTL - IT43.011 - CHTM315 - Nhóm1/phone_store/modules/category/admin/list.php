<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2020 VINADES.,JSC. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Tue, 10 Nov 2020 06:56:08 GMT
 */

if (!defined('NV_IS_FILE_ADMIN')) {
    die('Stop!!!');
}

$page_title = $lang_module['main'];

if($nv_Request->isset_request("active", "post,get")){
    $id = $nv_Request->get_int("id", "post,get", 0);
    if($id >0){
       $db->query("DELETE FROM `nv4_vi_book_category` WHERE id =" .$id);
    }
}

$db->sqlreset()
    ->select('*')
    ->from('nv4_vi_book_category')
    ->order("id ASC");
$sql = $db->sql();

$result= $db->query($sql);
$array_row = $result->fetchAll();

//------------------------------
// Viết code xử lý chung vào đây
//------------------------------

$xtpl = new XTemplate('list.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);

if (!empty($array_row)) {
    $i = 1;
    foreach ($array_row as $row){
        $row['stt'] = $i;
        $row['active'] = !empty($array_active[$row['active']]) ? $array_active[$row['active']] : '';
        $row['url_edit'] = NV_BASE_ADMINURL .'index.php?'. NV_LANG_VARIABLE .'='. NV_LANG_DATA .'&amp;'. NV_NAME_VARIABLE .'='. $module_name .'&amp;'. NV_OP_VARIABLE .'=add&amp;id='. $row['id']; 
        $row['url_delete'] = NV_BASE_ADMINURL .'index.php?'. NV_LANG_VARIABLE .'='. NV_LANG_DATA .'&amp;'. NV_NAME_VARIABLE .'='. $module_name .'&amp;'. NV_OP_VARIABLE .'=list&amp;id='. $row['id']. '&active=delete&checksess='. md5($row['id'] .$NV_CHECK_SESSION); 
        $xtpl->assign('ROW', $row);
        $xtpl->parse('main.loop');
        $i++;
    }
}

//-------------------------------
// Viết code xuất ra site vào đây
//-------------------------------

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
