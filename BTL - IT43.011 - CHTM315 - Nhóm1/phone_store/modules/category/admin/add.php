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

$post =[];
$error=[];
$suc=[];


$post['id'] = $nv_Request->get_int('id', 'post,get', '');

if($nv_Request->isset_request("submit", "post")){
    $post['name'] = $nv_Request->get_title('name', 'post', '');
    $post['active'] = $nv_Request->get_int('active', 'post', 1);

    $row = "SELECT `id`, `name` FROM `nv4_vi_book_category` where `name`=".$db->quote($post['name']);
    $result = $db->query($row)->fetch();

    if(empty($post['name'])){
        $error[]= $lang_module['error_name'];
//     }else if($result['name'] == $post['name']) {
//         $error[]= $lang_module['error_name_exist'];
    }

    $post['name'] = $nv_Request->get_title('name', 'post', '');
    if(empty($error)){
        if($post['id'] > 0){
            //update
            try {
                $sql = "UPDATE `nv4_vi_book_category` SET `name`= :name,`active`= :active, `updated_at`= :update_at WHERE `id` =" .$post['id'];
                $s = $db->prepare($sql);
                $s->bindValue('update_at', NV_CURRENTTIME);
                $s->bindParam('name', $post['name']);
                $s->bindParam('active', $post['active']);
                $exe = $s->execute();

                $error[]= $lang_module['succ_U'];
            } catch (Exception $e) {
                echo '<pre><code>';
                print_r($e);
                echo '</code></pre>';
            }

        }else{
            //insert
            //         try {
            $row = "SELECT `id`, `name` FROM `nv4_vi_book_category` where `name`=".$db->quote($post['name']);
            $result = $db->query($row)->fetch();

            if($result['name'] == $post['name']) {
                $error[]= $lang_module['error_name_exist'];
            }else{
            $sql = "INSERT INTO `nv4_vi_book_category`(`name`, `weight`, `active`, `created_at`) VALUES (:name, :weight, :active, :created_at)";

            $s = $db->prepare($sql);
            $s->bindValue('weight', 1);
            $s->bindValue('created_at', NV_CURRENTTIME);
            $s->bindParam('name', $post['name']);
            $s->bindParam('active', $post['active']);
            $exe = $s->execute();

            $error[]= $lang_module['succ_I'];


            //         } catch (Exception $e) {
            //             echo '<pre><code>';
            //             print_r($e);
            //             echo '</code></pre>';
            //         }
            //     }
            }
        }
    }else{
            $error[]= $lang_module['error'];
        }

}else if ($post['id'] > 0) {
    $sql = "SELECT * FROM `nv4_vi_book_category` WHERE id = " .$post['id'];
    $post = $db->query($sql)->fetch();
}


//------------------------------
// ViÃ¡ÂºÂ¿t code xÃ¡Â»Â­ lÃƒÂ½ chung vÃƒÂ o Ã„â€˜ÃƒÂ¢y
//------------------------------

$xtpl = new XTemplate('add.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);

$xtpl->assign('POST', $post);
$xtpl->assign('ERROR', implode('<br>',$error));
if(!empty($error)){
    $xtpl->parse('main.error');
}

//-------------------------------
// ViÃ¡ÂºÂ¿t code xuÃ¡ÂºÂ¥t ra site vÃƒÂ o Ã„â€˜ÃƒÂ¢y
//-------------------------------

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
