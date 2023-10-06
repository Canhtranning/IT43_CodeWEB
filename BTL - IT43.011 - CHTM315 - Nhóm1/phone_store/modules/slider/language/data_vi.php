<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Việt Tí (quocvietposcovn@gmail.com)
 * @Copyright (C) 2017 Việt Tí. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 12/04/2018 11:40
 */

if (!defined('NV_ADMIN')) {
    die('Stop!!!');
}

/**
 * Note:
 * 	- Module var is: $lang, $module_file, $module_data, $module_upload, $module_theme, $module_name
 * 	- Accept global var: $db, $db_config, $global_config
 */

$db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_blocks (bid, title, description) VALUES(1, 'Home slider', 'Silder trang chủ')");
$db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows (id, bid, title, description, link, target, image, start_time, end_time, status) VALUES (1, 1, 'Ảnh 1', 'Việt Tí Online: chia sẻ mã nguồn chọn lọc', 'http://quocviet.net/', '_blank', 'slide_1.jpg', " . NV_CURRENTTIME . ", 0, 1)");
$db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows (id, bid, title, description, link, target, image, start_time, end_time, status) VALUES (2, 1, 'Ảnh 2', 'Việt Tí Online: chia sẻ kinh nghiệm cuộc sống', 'http://quocviet.net', '_blank', 'slide_2.jpg', " . NV_CURRENTTIME . ", 0, 1)");
$db->query("INSERT INTO " . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_rows (id, bid, title, description, link, target, image, start_time, end_time, status) VALUES (3, 1, 'Ảnh 3', 'Việt Tí Online: tải mã nguồn miễn phí', 'http://quocviet.net', '_blank', 'slide_3.jpg', " . NV_CURRENTTIME . ", 0, 1)");