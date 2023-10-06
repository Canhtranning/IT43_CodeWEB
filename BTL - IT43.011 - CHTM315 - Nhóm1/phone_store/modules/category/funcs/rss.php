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

$channel = [];
$items = [];

$channel['title'] = $module_info['custom_title'];
$channel['link'] = NV_MY_DOMAIN . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name;
$channel['atomlink'] = NV_MY_DOMAIN . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=rss';
$channel['description'] = !empty($module_info['description']) ? $module_info['description'] : $global_config['site_description'];

/*
if ($module_info['rss']) {
    $catid = 0;
    if (isset($array_op[1])) {
        $alias_cat_url = $array_op[1];
        $cattitle = '';
        foreach ($global_array_cat as $catid_i => $array_cat_i) {
            if ($alias_cat_url == $array_cat_i['alias']) {
                $catid = $catid_i;
                break;
            }
        }
    }

    $db->sqlreset()->select('id, catid, publtime, title, alias, hometext, homeimgthumb, homeimgfile')->order('publtime DESC')->limit(30);

    if (!empty($catid)) {
        $channel['title'] = $module_info['custom_title'] . ' - ' . $global_array_cat[$catid]['title'];
        $channel['link'] = NV_MY_DOMAIN . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=rss/' . $alias_cat_url;
        $channel['description'] = $global_array_cat[$catid]['description'];

        $db->from(NV_PREFIXLANG . '_' . $module_data . '_' . $catid)->where('status=1');
    } else {
        $db->from(NV_PREFIXLANG . '_' . $module_data . '_rows')->where('status=1 AND inhome=1');
    }

    $result = $db->query($db->sql());
    while (list($id, $listcatid, $publtime, $title, $alias, $hometext, $homeimgfile) = $result->fetch(3)) {
        $arr_catid = explode(',', $listcatid);
        $catid_i = end($arr_catid);
        $catalias = $global_array_cat[$catid_i]['alias'];
        $rimages = (!empty($homeimgfile)) ? '<img src="' . NV_MY_DOMAIN . NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_name . '/' . $homeimgfile . '" width="100" align="left" border="0">' : '';
        $items[] = [
            'title' => $title,
            'link' => NV_MY_DOMAIN . NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $catalias . '/' . $alias . '-' . $id,
            'guid' => $module_name . '_' . $id,
            'description' => $rimages . $hometext,
            'pubdate' => $publtime
        ];
    }
}
*/

nv_rss_generate($channel, $items);
die();
