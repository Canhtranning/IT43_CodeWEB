<!-- BEGIN: main -->
<!-- BEGIN: alert -->
    <div class='alert alert-info' role="alert">{ALERT}</div>
<!-- END: alert -->
<!-- BEGIN: error -->
    <div class='alert alert-danger' role="alert">{ERROR}</div>
<!-- END: error -->
<form action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post" enctype="multipart/form-data">
    <input type="hidden" class="form-control" name="id" value="{POST.id}">
    <input type="hidden" class="form-control" name="oldImage" value="{POST.image}{POST.oldImage}">

    <div class="form-group">
        <label for="">Tên sản phẩm: </label>
        <input type="text" class="form-control" name="name" value="{POST.name}">
    </div>
    <div class="form-group">
        <label for="">Ảnh sản phẩm: </label>
        <input type="file" class="form-control" name="image" value="{POST.image}">
        <!-- BEGIN: image -->
            <img src="{POST.image}" />
            
        <!-- END: image -->
        <!-- BEGIN: oldImage -->
            <img src="{POST.oldImage}" />
        <!-- END: oldImage -->
    </div>
    <div class="form-group ">
        <label for="">Giá: </label>
        <input type="number" class="form-control number-separator" name="price" value="{POST.price}">
    </div>
    
    <div class="form-group">
        <label for="">Slug: </label>
        <input type="text" class="form-control" name="slug" value="{POST.slug}">
    </div>
    <div class="form-group">
        <label for="">Trạng thái: </label>
        <select name="active" class="form-control">
            <option value="">Chọn Trạng Thái</option>
            <!-- BEGIN: activeLoop -->
            <option value="{ACTIVE.key}" {ACTIVE.selected}>{ACTIVE.value}</option>
            <!-- END: activeLoop -->
        </select>
    </div>
    <div class="form-group">
        <label for="">Danh mục: </label>
        <select name="category_id" class="form-control">
            <option value="">Chọn danh mục</option>
            <!-- BEGIN: loopCat -->
            <option value="{DATA.id}" {DATA.selected}>{DATA.name}</option>
            <!-- END: loopCat -->
        </select>
    </div>
    <div class="form-group">
        <label for="">Mô tả: </label>
        <textarea class="form-control" name="content">{POST.content}</textarea>
    </div>
    <div class="text-center" ><input style="margin-top:10px;" class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" /></div>
</form>
<!-- END: main -->