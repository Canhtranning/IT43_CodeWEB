<!-- BEGIN: main -->
<form action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post">
    <table class="table table-hover">
		<thead>
			<tr>
				<th class="text-center text-nowrap">{LANG.stt}</th>
				<th class="text-center text-nowrap">{LANG.name}</th>
				<th class="text-center text-nowrap">{LANG.status}</th>
				<th class="text-center text-nowrap">{LANG.active}</th>
			</tr>
		</thead>
		<tbody>
		<!-- BEGIN: loop -->
			<tr>
				<td class="text-center text-nowrap">{ROW.stt}</td>
				<td class="text-center text-nowrap">{ROW.name}</td>
				<td class="text-center text-nowrap">{ROW.active}</td>
				<td class="text-center text-nowrap">
                    <a href="{ROW.url_edit}" class="btn btn-default btn-sm"><i class="fa fa-edit"></i> Sửa</a>
                    <a href="{ROW.url_delete}"  class="btn btn-danger btn-sm delete"><i class="fa fa-trash-o"></i> Xóa</a>
                </td>
			</tr>
			<!-- END: loop -->
		</tbody>
	</table>
</form>
<script>
$(document).ready(function(){
	$('.delete').click(function(){
		if(confirm("Bạn có muốn xóa không?")){
			return true;
		}else{
			return false;
	}});
});

</script>
<!-- END: main -->