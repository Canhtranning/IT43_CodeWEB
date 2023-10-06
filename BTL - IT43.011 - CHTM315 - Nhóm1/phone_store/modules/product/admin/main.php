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



$page_title = $lang_module['main'];



function check_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$error = [];
$post = [];


$post['submit'] = $nv_Request->get_title('submit', 'post', '');
$post['name'] = check_input($nv_Request->get_title('name', 'post', ''));
$post['price'] = $nv_Request->get_int('price', 'post', 0);
$post['slug'] = check_input($nv_Request->get_title('slug', 'post', ''));
$post['category_id'] = $nv_Request->get_int('category_id', 'post', 0);
$post['content'] = check_input($nv_Request->get_title('content', 'post', ''));
$post['id'] = $nv_Request->get_int('id', 'post, get', 0);
$post['action'] = $nv_Request->get_title('action', 'get', '');
$post['active'] = $nv_Request->get_int('active', 'post', 1);
/* EDIT PRODUCT */
        //lấy dữ liệu trong database in ra form sửa
        try {
            if (!empty($post['action']) && $post['action'] == 'edit' && $post['id']>0)
            {
                $sql = "SELECT * FROM `nv4_vi_book_product` WHERE id =" . $post['id'];
                $post = $db->query($sql)->fetch();
                if (!empty($post['image'])) {
                    $post['image'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/'. $module_name . '/' . $post['image'];
                }

            }
        } catch (PDOException $e) {
            echo "<pre>";
            print_r($e);
            echo "</pre>";
        }

/* END EDIT PRODUCT */
if(!empty($post['submit']))
{
    if (empty($post['name']))
    {
        $error[] = 'Bạn chưa nhập tên sản phẩm';
    } else {
        $sql = "SELECT `name` FROM `nv4_vi_book_product` EXCEPT SELECT `name` FROM `nv4_vi_book_product` WHERE `id`=" . $post['id'];
        $result = $db->query($sql);
        foreach ($result as $data)
        {
            if ($post['name'] == $data['name'])
            {
                $error[] = 'tên sản phẩm đã tồn tại';
            }
        }
    }
    if (empty($post['price']))
    {
        $error[] = 'Bạn chưa nhập giá';
    }
    if (empty($post['content']))
    {
        $error[] = 'Bạn chưa nhập mô tả';
    }
    if (empty($post['slug']))
    {
        $error[] = 'Bạn chưa nhập slug';
    } else {
        $sql = "SELECT `slug` FROM `nv4_vi_book_product` EXCEPT SELECT `slug` FROM `nv4_vi_book_product` WHERE `id`=" . $post['id'];
        $result = $db->query($sql);
        foreach ($result as $data)
        {
            if ($post['slug'] == $data['slug'])
            {
                $error[] = 'slug đã tồn tại';
            }
        }
    }
    if (empty($post['category_id']))
    {
        $error[] = 'Bạn chưa nhập danh mục';
    }
    if (empty($post['active']))
    {
        $error[] = 'Bạn chưa nhập trạng thái';
    }

    /* UPLOAD AVATAR */
    if ($nv_Request->isset_request('submit', 'post')) {
        if (isset($_FILES, $_FILES['image'], $_FILES['image']['tmp_name']) and is_uploaded_file($_FILES['image']['tmp_name']))
        {
            // Khởi tạo Class upload
            $upload = new NukeViet\Files\Upload($admin_info['allow_files_type'], $global_config['forbid_extensions'], $global_config['forbid_mimes'], NV_UPLOAD_MAX_FILESIZE, NV_MAX_WIDTH, NV_MAX_HEIGHT);

            // Thiết lập ngôn ngữ, nếu không có dòng này thì ngôn ngữ trả về toàn tiếng Anh
            $upload->setLanguage($lang_global);

            // Tải file lên server
            if (empty($error)) {
                $upload_info = $upload->save_file($_FILES['image'], NV_UPLOADS_REAL_DIR . '/product' . '/temp', false, $global_config['nv_auto_resize']);
            }
            if ($upload_info['error'] == '' && empty($error)) {
                $image = new NukeViet\Files\Image(NV_UPLOADS_REAL_DIR . '/product' . '/temp' . '/' . $upload_info['basename'], NV_MAX_WIDTH, NV_MAX_HEIGHT);

                $image->resizeXY(200, 200);
                $newname = $upload_info['basename'];
                $quality = 100;
                $image->save(NV_UPLOADS_REAL_DIR . '/product' . '/', $newname, $quality);
                $image->close();
                $info = $image->create_Image_info;
                //lấy biến
                $image = $newname;
            } else {
                $error[] = $upload_info['error'];
            }
        }
    }
    //Kiểm tra nếu không có file tải lên hoặc không có ảnh cũ thì hiển thị lỗi
    $post['oldImage'] = $nv_Request->get_title('oldImage', 'post', '');
    if (empty($newname) && empty($nv_Request->get_title('oldImage', 'post', '')))
    {
        $error[] = 'Bạn chưa chọn hình ảnh sản phẩm';
    }

    /* END UPLOAD */

    if (empty($error))
    {
        if ($post['id'] > 0) {
            // nếu có file tải lên thì update image mới, nếu  không có file tải lên thì không update image
            if (!empty($newname))
            {
                try {
                    $sql = "UPDATE `nv4_vi_book_product` SET `name`=:name,`image`=:image,`price`=:price,`content`=:content,`slug`=:slug,`category_id`=:category_id, `active`=:active  WHERE `id`=" . $post['id'];
                    $s = $db->prepare($sql);
                    $s->bindParam('name', $post['name']);
                    $s->bindParam('image', $image);
                    $s->bindParam('price', $post['price']);
                    $s->bindParam('content', $post['content']);
                    $s->bindParam('slug', $post['slug']);
                    $s->bindParam('category_id', $post['category_id']);
                    $s->bindParam('active', $post['active']);
                    $s->execute();
                    } catch (PDOException $e) {
                        echo "<pre>";
                        print_r($e);
                        echo "</pre>";
                        die();
                    }
                    $alert = 'Sửa Thành Công';
                    nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=list&amp;success=1&amp;product_id=' . $post['id']);
            } else if (empty($newname))
                    {
                        try {
                            $sql = "UPDATE `nv4_vi_book_product` SET `name`=:name,`price`=:price,`content`=:content,`slug`=:slug,`category_id`=:category_id, `active`=:active WHERE `id`=" . $post['id'];
                            $s = $db->prepare($sql);
                            $s->bindParam('name', $post['name']);

                            $s->bindParam('price', $post['price']);
                            $s->bindParam('content', $post['content']);
                            $s->bindParam('slug', $post['slug']);
                            $s->bindParam('category_id', $post['category_id']);
                            $s->bindParam('active', $post['active']);
                            $s->execute();
                            } catch (PDOException $e) {
                                echo "<pre>";
                                print_r($e);
                                echo "</pre>";
                                die();
                            }
                            $alert = 'Sửa Thành Công';
                            nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=list&amp;success=1&amp;product_id=' . $post['id']);
                    }

        } else {
            try {
                $sql = "INSERT INTO `nv4_vi_book_product` (`name`, `image`, `price`, `content`, `slug`, `category_id`, `active`) VALUES (:name , :image, :price , :content , :slug , :category_id, :active)";
                $s = $db->prepare($sql);
                $s->bindParam('name', $post['name']);
                $s->bindParam('image', $image);
                $s->bindParam('price', $post['price']);
                $s->bindParam('content', $post['content']);
                $s->bindParam('slug', $post['slug']);
                $s->bindParam('category_id', $post['category_id']);
                $s->bindParam('active', $post['active']);
                $s->execute();
                } catch (PDOException $e) {
                    echo "<pre>";
                    print_r($e);
                    echo "</pre>";
                    die();
                }
                $alert = 'Thêm Thành Công';
                $product_id = $db->lastInsertId();
                nv_redirect_location(NV_BASE_ADMINURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=list');
        }


    }
}



//------------------------------
// Viết code xử lý chung vào đây
//------------------------------

$xtpl = new XTemplate('main.tpl', NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/modules/' . $module_file);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('NV_LANG_VARIABLE', NV_LANG_VARIABLE);
$xtpl->assign('NV_LANG_DATA', NV_LANG_DATA);
$xtpl->assign('NV_BASE_ADMINURL', NV_BASE_ADMINURL);
$xtpl->assign('NV_NAME_VARIABLE', NV_NAME_VARIABLE);
$xtpl->assign('NV_OP_VARIABLE', NV_OP_VARIABLE);
$xtpl->assign('MODULE_NAME', $module_name);
$xtpl->assign('OP', $op);



$xtpl->assign('POST', $post);
if (!empty($post['image']))
{
    $xtpl->parse('main.image');
}
if (!empty($post['oldImage']))
{
    $xtpl->parse('main.oldImage');
}

$sql = "SELECT id,name FROM `nv4_vi_book_category`";
$result = $db->query($sql);
foreach ($result as $data)
{
    $data['selected'] = $data['id'] == $post['category_id'] ? 'selected' : '';
    $xtpl->assign('DATA', $data);
    $xtpl->parse('main.loopCat');
}

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
/* End active */


if (!empty($alert)) {
    $xtpl->assign('ALERT', $alert);
    $xtpl->parse('main.alert');
}
if (!empty($error)) {
    $xtpl->assign('ERROR', implode("<br>", $error));
    $xtpl->parse('main.error');
}

//-------------------------------
// Viết code xuất ra site vào đây
//-------------------------------

$xtpl->parse('main');
$contents = $xtpl->text('main');

include NV_ROOTDIR . '/includes/header.php';
echo nv_admin_theme($contents);
include NV_ROOTDIR . '/includes/footer.php';
