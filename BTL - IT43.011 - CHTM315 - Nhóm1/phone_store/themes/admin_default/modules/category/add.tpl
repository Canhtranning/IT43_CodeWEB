<!-- BEGIN: main -->
<form action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
	   	<!-- BEGIN: error -->
	   	<div class="alert alert-warning">
			<strong>{ERROR} </strong> 
		</div>
		<!-- END: error -->
	   	
	   	<legend>Thêm danh mục</legend>
	   	
	   	<input type="hidden" class="form-inline" name="id" value="{POST.id}">
	
		<div class="form-group">
			<label for="">{LANG.name}:</label>
			<input type="text" class="form-inline" name="name" value="{POST.name}">
		</div>
		
		<div class="radio">
		{LANG.status} :
		<label>
			<input type="radio" name="active" id="input" value="0" checked="checked">
			Ẩn
		</label>
		<label>
			<input type="radio" name="active" id="input" value="1" checked="checked">
			Hiện
		</label>
	</div>
    <div class="text-center"><input class="btn btn-primary" name="submit" type="submit" value="{LANG.save}" /></div>
</form>
<!-- END: main -->