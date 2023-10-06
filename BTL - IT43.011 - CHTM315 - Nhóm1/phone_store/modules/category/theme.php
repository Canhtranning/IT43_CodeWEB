<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2020 VINADES.,JSC. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Tue, 10 Nov 2020 06:56:08 GMT
 */

if (!defined('NV_IS_MOD_ALBUM')) {
    die('Stop!!!');
}

/**
 * nv_theme_album_main()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_album_main($array_data)
{
    global $module_info, $lang_module, $lang_global, $op;



    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
    
    if (!empty($array_data)) {
        $i = 1;
        foreach ($array_data as $row){
            $row['stt'] = $i;
            //$row['active'] = !empty($array_active[$row['active']]) ? $array_active[$row['active']] : '';
            
            $xtpl->assign('ROW', $row);
            $xtpl->parse('main.loop');
            $i++;
        }
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 * nv_theme_album_detail()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_album_detail($array_data)
{
    global $module_info, $lang_module, $lang_global, $op;

    

    //------------------
    // Viết code vào đây
    //------------------

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**
 * nv_theme_album_search()
 * 
 * @param mixed $array_data
 * @return
 */
function nv_theme_album_search($array_data)
{
    global $module_info, $lang_module, $lang_global, $op;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);

    //------------------
    // Viết code vào đây
    //------------------

    $xtpl->parse('main');
    return $xtpl->text('main');
}
