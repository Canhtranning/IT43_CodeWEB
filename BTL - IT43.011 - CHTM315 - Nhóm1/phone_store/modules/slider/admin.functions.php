<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Việt Tí (quocvietposcovn@gmail.com)
 * @Copyright (C) 2017 Việt Tí. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 12/04/2018 11:40
 */

if (! defined('NV_ADMIN') or ! defined('NV_MAINFILE') or ! defined('NV_IS_MODADMIN')) {
    die('Stop!!!');
}

$allow_func = array( 'main', 'list', 'manager' );

define('NV_IS_FILE_ADMIN', true);
