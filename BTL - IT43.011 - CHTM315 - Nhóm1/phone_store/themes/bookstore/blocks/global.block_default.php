<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Mr.Thinh (thinhwebhp@gmail.com)
 * @Copyright (C) 2014 Mr.Thinh. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Tuesday, 21 June 2016 12:41:32 GMT
 */

if (! defined('NV_MAINFILE')) {
    die('Stop!!!');
}

if (! nv_function_exists('nv_theme_contact')) {
    function nv_theme_contact_config($module, $data_block, $lang_block)
    {
    	$html = '<tr>';
        $html .= '	<td>' . $lang_block['name'] . '</td>';
        $html .= '	<td><input type="text" name="config_name" class="form-control" value="' . $data_block['name'] . '"/></td>';
        $html .= '</tr>';
		
		$html .= '<tr>';
        $html .= '	<td>' . $lang_block['url'] . '</td>';
        $html .= '	<td><input type="text" name="config_url" class="form-control" value="' . $data_block['url'] . '"/></td>';
        $html .= '</tr>';

        return $html;
    }

    function nv_theme_contact_submit($module, $lang_block)
    {
        global $nv_Request;
        $return = array();
        $return['error'] = array();
		$return['config']['name'] = $nv_Request->get_title('config_name', 'post');
		$return['config']['url'] = $nv_Request->get_title('config_url', 'post');
        return $return;
    }

    function nv_theme_contact($block_config)
    {
        global $global_config, $site_mods, $lang_global, $lang_block;

        if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/blocks/global.block_default.tpl')) {
            $block_theme = $global_config['module_theme'];
        } elseif (file_exists(NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/blocks/global.block_default.tpl')) {
            $block_theme = $global_config['site_theme'];
        } else {
            $block_theme = 'default';
        }

        $xtpl = new XTemplate('global.block_default.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/blocks');
        $xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);
        $xtpl->assign('LANG', $lang_block);
        $xtpl->assign('TEMPLATE', $block_theme);
        $xtpl->assign('DATA', $block_config);
		
        if (! empty($block_config['name'])) {
            $xtpl->parse('main.name');
        }
		if (! empty($block_config['url'])) {
            $xtpl->parse('main.url');
        }
        $xtpl->parse('main');
        return $xtpl->text('main');
    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_theme_contact($block_config);
}
