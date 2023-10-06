<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2020 VINADES.,JSC. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Tue, 10 Nov 2020 06:56:08 GMT
 */

if (!defined('NV_IS_MOD_RSS')) {
    die('Stop!!!');
}

$rssarray = [];

/*
$result2 = $db->query('SELECT catid, parentid, title, alias, numsubcat, subcatid FROM ' . NV_PREFIXLANG . '_' . $module_data . '_cat ORDER BY weight');
while (list($catid, $parentid, $title, $alias, $numsubcat, $subcatid) = $result2->fetch(3)) {
    $rssarray[$catid] = [
        'catid' => $catid,
        'parentid' => $parentid,
        'title' => $title,
        'alias' => $alias,
        'numsubcat' => $numsubcat,
        'subcatid' => $subcatid,
        'link' => NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_title . '&amp;' . NV_OP_VARIABLE . '=rss/' . $alias
    ];
}
*/
