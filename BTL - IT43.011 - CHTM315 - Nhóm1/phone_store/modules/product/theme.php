<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2020 VINADES.,JSC. All rights reserved
 * @License: Not free read more http://nukeviet.vn/vi/store/modules/nvtools/
 * @Createdate Sat, 31 Oct 2020 02:20:33 GMT
 */

if (!defined('NV_IS_MOD_SAMPLES')) {
    die('Stop!!!');
}

/**
 * nv_theme_samples_main()
 *
 * @param mixed $array_data
 * @return
 */
function nv_theme_samples_main($array_data)
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

/**
 * nv_theme_samples_detail()
 *
 * @param mixed $array_data
 * @return
 */
function nv_theme_samples_detail($array_data)
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

/**
 * nv_theme_samples_search()
 *
 * @param mixed $array_data
 * @return
 */
function nv_theme_samples_search($array_data)
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
/**
 * nv_theme_samples_search()
 *
 * @param mixed $array_data
 * @return
 */
function nv_theme_samples_cart($array_data, $result, $error, $alert, $post)
{
    global $module_info, $lang_module, $lang_global, $op, $module_name;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
    $xtpl->assign('OP', $op);
    $xtpl->assign('MODULE_NAME', $module_name);
    $xtpl->assign('POST', $post);
    //in ra sp trong giỏ hàng
    foreach ($_SESSION['cart_item'] as $key_cart => $val_cart_item)
    {
        $val_cart_item['format_price'] = number_format($val_cart_item['price']);
        $total_bill += $val_cart_item['price'];

        $xtpl->assign('VAL_CART_ITEM', $val_cart_item);
        $xtpl->parse('main.dataLoop');
    }
    //in tổng bill
    $xtpl->assign('TOTAL_BILL', number_format($total_bill));

    /* Xuất giá trị payment_method ra site */
    $array_payment = [];
    $array_payment[1] = 'Tiền mặt';
    $array_payment[2] = 'Chuyển khoản';
    $array_payment[3] = 'Thẻ tín dụng';
    foreach ($array_payment as $key => $value)
    {
        $xtpl->assign('PAYMENT', [
            'key' => $key,
            'value' => $value
        ]);
        $xtpl->parse('main.pmLoop');
    }
    /* End payment_method */

    /* BEGIN xuất ra province*/
    foreach ($result as $data)
    {
        $data['selected'] = ($data['id'] == $post['province']) ? 'selected' : '';
        $xtpl->assign('DATA_PROVINCE', $data);
        $xtpl->parse('main.loopProvince');
    }
    /* END code xuất ra site */
    /* Hiển thị err */
    $xtpl->assign('ERROR', implode('<br>', $error));

    if (!empty($error)) {
        //hiển thị khối main.error
        $xtpl->parse('main.error');
    }
    /* end err */

    /* Hiển thị alert */
    if (!empty($alert)) {
        $xtpl->assign('ALERT', $alert);
        //hiển thị khối main.alert
        $xtpl->parse('main.alert');
    }
    /* end alert */

    $xtpl->parse('main');
    return $xtpl->text('main');
}
/**
 * nv_theme_samples_search()
 *
 * @param mixed $array_data
 * @return
 */
function nv_theme_samples_category($array_data)
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

/**
 * nv_theme_samples_main()
 *
 * @param mixed $array_data
 * @return
 */
function nv_theme_samples_list($array_data, $result, $total, $generate_page)
{
    global $module_info, $lang_module, $lang_global, $op, $module_name;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
    $xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
    $xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
    $xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
    $xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
    $xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
    $xtpl->assign('MODULE_NAME', $module_name);
    $xtpl->assign('OP', $op);

    foreach ($result as $data)
    {
        $data['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/'. $module_name . '/' . $data['image'];
        $data['price'] = number_format($data['price']);
        $data['active'] = $data['active'] == 1 ? 'Hết hàng' : 'Có hàng';

        $xtpl->assign('DATA', $data);

        $xtpl->parse('main.dataLoop');
    }

    $xtpl->assign('GENERATE_PAGE', $generate_page);

    if ($total > 5 )
    {
        $xtpl->parse('main.page');
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**

 * nv_theme_album_main()

 *
 * @param mixed $array_data
 * @return
 */

function nv_theme_album_main($array_data,$row_cate, $perpage, $page, $total, $category, $post)
{
    global $module_info, $lang_module, $lang_global, $op, $module_name;


    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
    $xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
    $xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
    $xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
    $xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
    $xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
    $xtpl->assign('MODULE_NAME', $module_name);
    $xtpl->assign('OP', $op);

    if (!empty($array_data)) {
        $i = 1;
        foreach ($array_data as $row){
            $row['stt'] = $i;
            $row['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/'. $module_name . '/' . $row['image'];
            $row['price'] = number_format($row['price']);
//             $row['name_substr'] = (str_word_count($row['name']) > 6) ? substr($row['name'], 0, 37).'...' : $row['name'];

//             $row['active'] = !empty($array_active[$row['active']]) ? $array_active[$row['active']] : '';
            $row['url_detail'] = NV_BASE_SITEURL .'index.php?'. NV_LANG_VARIABLE .'='. NV_LANG_DATA .'&amp;'. NV_NAME_VARIABLE .'='. $module_name .'&amp;'. NV_OP_VARIABLE .'=detail&amp;id='. $row['id'];
//             $row['url_delete'] = NV_BASE_ADMINURL .'index.php?'. NV_LANG_VARIABLE .'='. NV_LANG_DATA .'&amp;'. NV_NAME_VARIABLE .'='. $module_name .'&amp;'. NV_OP_VARIABLE .'=list&amp;id='. $row['id']. '&active=delete&checksess='. md5($row['id'] .$NV_CHECK_SESSION);
            $xtpl->assign('ROW', $row);
            $xtpl->parse('main.loop');
            $i++;
        }
    }

    if (!empty($row_cate)) {
        foreach ($row_cate as $cate){
//             $cate['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/'. $module_name . '/' . $cate['image'];
//             $cate['url_detail'] = NV_BASE_SITEURL .'index.php?'. NV_LANG_VARIABLE .'='. NV_LANG_DATA .'&amp;'. NV_NAME_VARIABLE .'='. $module_name .'&amp;'. NV_OP_VARIABLE .'=detail&amp;id='. $cate['id'];
            $cate['url_product'] = NV_BASE_SITEURL .'index.php?'. NV_LANG_VARIABLE .'='. NV_LANG_DATA .'&amp;'. NV_NAME_VARIABLE .'='. $module_name .'&amp;'. NV_OP_VARIABLE .'=product&amp;id='. $cate['id'];
            $xtpl->assign('CATE', $cate);
            $xtpl->parse('main.cate');
        }
    }

    foreach ($category as $row_cat)
    {
        $row_cat['selected'] = $post['category_id'] == $row_cat['id'] ? 'selected' : '';


        $xtpl->assign('ROW_CAT', $row_cat);
        $xtpl->parse('main.catloop');
    }
    /* End */
    /* Xuất giá trị active ra site */
    $array_active = [];
    $array_active[1] = 'Hết Hàng';
    $array_active[2] = 'Có Hàng';

    foreach ($array_active as $key => $value)
    {
        $xtpl->assign('ACTIVE', [
            'key' => $key,
            'value' => $value,
            'selected' => ($post['active'] == $key) ? 'selected' : '',
        ]);
        $xtpl->parse('main.activeLoop');
    }

    $base_url = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=main';
    //Phân trang khi chuyển trang không bị mất lọc
    if (!empty($post['name']))
    {
        $base_url .= '&name=' . $post['name'];
    }
    if (!empty($post['category_id']))
    {
        $base_url .= '&category_id=' . $post['category_id'];
    }
    if ($post['active'] > 0)
    {
        $base_url .= '&active=' . $post['active'];
    }
    $generate_page = nv_generate_page($base_url, $total, $perpage, $page);
    $xtpl->assign('GENERATE_PAGE', $generate_page);

    if ($total > 6 )
    {
        $xtpl->parse('main.page');
    }

    //------------------
    // Viết code vào đây
    //------------------

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**

 * nv_theme_album_detail()


 *
 * @param mixed $array_data
 * @return
 */

function nv_theme_album_detail($row_detail,$row_cate, $row_rd)
{
    global $module_info, $lang_module, $lang_global, $op, $module_name;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);

    $row_detail['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/'. $module_name . '/' . $row_detail['image'];
    $row_detail['price'] = number_format($row_detail['price']);
    $row_detail['url_order'] = NV_BASE_SITEURL .'index.php?'. NV_LANG_VARIABLE .'='. NV_LANG_DATA .'&amp;'. NV_NAME_VARIABLE .'='. $module_name .'&amp;'. NV_OP_VARIABLE .'=order&amp;id='. $row_detail['id'];

    $xtpl->assign('ROWDETAIL', $row_detail);

    if (!empty($row_rd)) {
        foreach ($row_rd as $rd){
            $rd['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/'. $module_name . '/' . $rd['image'];
            $rd['url_detail'] = NV_BASE_SITEURL .'index.php?'. NV_LANG_VARIABLE .'='. NV_LANG_DATA .'&amp;'. NV_NAME_VARIABLE .'='. $module_name .'&amp;'. NV_OP_VARIABLE .'=detail&amp;id='. $rd['id'];
            $xtpl->assign('ROWRD', $rd);
            $xtpl->parse('main.row_rd');
        }
    }

    $xtpl->assign('ROWCATE', $row_cate);
    //------------------
    // Viết code vào đây
    //------------------

    $xtpl->parse('main');
    return $xtpl->text('main');
}


function nv_theme_album_order($row_order, $post, $error, $array_province)
{
    global $module_info, $lang_module, $lang_global, $op, $module_name;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
    $xtpl->assign('MODULE_NAME', $module_name);
    $xtpl->assign('OP', $op);
    $i = 1;
    $row_order['stt'] = $i;
//     $row_order['quantity'] = !empty($row_order['quantity']) ? $row_order['quantity'] : 1;
    $row_order['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/'. $module_name . '/' . $row_order['image'];
    $row_order['total_price'] = number_format($row_order['price'] * $row_order['quantity'] );

    $xtpl->assign('ROWORDER', $row_order);

    foreach ($array_province as $key => $province){



        $xtpl->assign('PROVINCE', array(
            'key' => $key,
            'title' => $province['title']
        ));
        $xtpl->parse('main.province');
    }

//     $post['quantity'] = !empty($post['quantity']) ? $post['quantity'] : 1;
    $xtpl->assign('POST', $post);
    $xtpl->assign('ERROR', implode('<br>',$error));
    if(!empty($error)){
        $xtpl->parse('main.error');
    };




    //------------------
    // Viết code vào đây
    //------------------

    $xtpl->parse('main');
    return $xtpl->text('main');
}

function nv_theme_album_product($row_cate,$row_product)
{
    global $module_info, $lang_module, $lang_global,$module_name, $op;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
    $xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
    $xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
    $xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
    $xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
    $xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
    $xtpl->assign('MODULE_NAME', $module_name);
    $xtpl->assign('OP', $op);

    if (!empty($row_cate)) {
        foreach ($row_cate as $cate){
            //             $cate['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/'. $module_name . '/' . $cate['image'];
            //             $cate['url_detail'] = NV_BASE_SITEURL .'index.php?'. NV_LANG_VARIABLE .'='. NV_LANG_DATA .'&amp;'. NV_NAME_VARIABLE .'='. $module_name .'&amp;'. NV_OP_VARIABLE .'=detail&amp;id='. $cate['id'];
            $cate['url_product'] = NV_BASE_SITEURL .'index.php?'. NV_LANG_VARIABLE .'='. NV_LANG_DATA .'&amp;'. NV_NAME_VARIABLE .'='. $module_name .'&amp;'. NV_OP_VARIABLE .'=product&amp;id='. $cate['id'];
            $xtpl->assign('CATE', $cate);
            $xtpl->parse('main.cate');
        }
    }

    if (!empty($row_product)) {
        foreach ($row_product as $product){
            $product['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/'. $module_name . '/' . $product['image'];
            $product['price'] = number_format($product['price']);
//             $product['name_substr'] = (str_word_count($product['name']) > 6) ? substr($product['name'], 0, 37).'...' : $product['name'];
            $product['url_detail'] = NV_BASE_SITEURL .'index.php?'. NV_LANG_VARIABLE .'='. NV_LANG_DATA .'&amp;'. NV_NAME_VARIABLE .'='. $module_name .'&amp;'. NV_OP_VARIABLE .'=detail&amp;id='. $product['id'];
//             $product['url_detail'] = NV_BASE_SITEURL .'index.php?'. NV_LANG_VARIABLE .'='. NV_LANG_DATA .'&amp;'. NV_NAME_VARIABLE .'='. $module_name .'&amp;'. NV_OP_VARIABLE .'=product&amp;id='. $product['id'];
//             $cate['url_product'] = NV_BASE_SITEURL .'index.php?'. NV_LANG_VARIABLE .'='. NV_LANG_DATA .'&amp;'. NV_NAME_VARIABLE .'='. $module_name .'&amp;'. NV_OP_VARIABLE .'=detail&amp;id='. $cate['id'];
            $xtpl->assign('PRODUCT', $product);
            $xtpl->parse('main.product');
        }
    }

    //------------------
    // Viết code vào đây
    //------------------

    foreach ($row_cate as $row_cat)
    {
        $row_cat['selected'] = $post['category_id'] == $row_cat['id'] ? 'selected' : '';
        $xtpl->assign('ROW_CAT', $row_cat);
        $xtpl->parse('main.catloop');
    }
    /* End */
    /* Xuất giá trị active ra site */
    $array_active = [];
    $array_active[1] = 'Hết Hàng';
    $array_active[2] = 'Có Hàng';

    foreach ($array_active as $key => $value)
    {
        $xtpl->assign('ACTIVE', [
            'key' => $key,
            'value' => $value,
            'selected' => ($post['active'] == $key) ? 'selected' : '',
        ]);
        $xtpl->parse('main.activeLoop');
    }

    $xtpl->parse('main');
    return $xtpl->text('main');
}

function nv_theme_success($alert)
{
    global $module_info, $lang_module, $lang_global,$module_name, $op;

    $xtpl = new XTemplate($op . '.tpl', NV_ROOTDIR . '/themes/' . $module_info['template'] . '/modules/' . $module_info['module_theme']);
    $xtpl->assign('LANG', $lang_module);
    $xtpl->assign('GLANG', $lang_global);
    $xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
    $xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
    $xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
    $xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
    $xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
    $xtpl->assign('MODULE_NAME', $module_name);
    $xtpl->assign('OP', $op);

    $xtpl->assign('ALERT', $alert);

    $xtpl->parse('main');
    return $xtpl->text('main');
}

/**

 * nv_theme_album_search()

 *
 * @param mixed $array_data
 * @return
 */