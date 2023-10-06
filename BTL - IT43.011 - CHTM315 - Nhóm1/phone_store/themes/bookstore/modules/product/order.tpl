<!-- BEGIN: main -->
<h1 class="text-center"> Hóa Đơn </h1>

    <!-- BEGIN: error -->
        <div class="alert alert-warning">
            <strong>{ERROR} </strong> 
        </div>
    <!-- END: error -->
    
    <form action="{NV_BASE_SITEURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post" enctype="multipart/form-data">
        <div class="col-xs-16 col-sm-16 col-md-16">        
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{LANG.stt}</th>
                        <th>{LANG.name}</th>
                        <th>{LANG.img}</th>
                        <th>{LANG.quantity}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{ROWORDER.stt}</td>
                        <td>{ROWORDER.name}</td>
                        <td><img src="{ROWORDER.image}"></td>
                        <td><input type="text" name="quantity" value="{POST.quantity}"></td>
                    </tr>
                </tbody>
                             
                 </table>
                 <tr>
                    <th>{LANG.total_price} :<td>{ROWORDER.total_price}</th></th>
                </tr>  
        </div>
   

    <div class="col-xs-8 col-sm-8 col-md-8">
        <div class="thumbnail">
            <input type="hidden" class="form-control" name="id" value="{ROWORDER.id}">
            <input type="hidden" class="form-control" name="price" value="{ROWORDER.price}">        
            <div class="form-group ">
			        <label for="">{LANG.name_user}: </label>
			        <input type="text" class="form-control" name="name_user" value="{POST.name_user}">
			    </div>
			    
			    <div class="form-group ">
			        <label for="">{LANG.email}: </label>
			        <input type="text" class="form-control" name="email" value="{POST.email}">
			    </div>
			    
			    <div class="form-group ">   
			        <label for="">{LANG.phone}: </label>
			        <input type="text" class="form-control" name="phone" value="{POST.phone}">
			    </div>
			    
			    <div class="form-group ">
                <div><label for="">{LANG.address}: </label></div>
			        
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <select name="province" id="province" class="form-control" onchange="change_province()">
                            <option value="0">--Chọn tỉnh--</option>
                            <!-- BEGIN: province -->
                                <option value="{PROVINCE.key}">{PROVINCE.title}</option>
                            <!-- END: province -->
                        </select>
			       </div>
                   <div class="col-xs-8 col-sm-8 col-md-8">
                        <select name="district" id="district" class="form-control" onchange="change_district()">
                            <option value="">--Chọn huyện--</option>
                        </select>
                   </div>
                   <div class="col-xs-8 col-sm-8 col-md-8">
                        <select name="ward" id="ward" class="form-control">
                            <option value="">--Chọn xã--</option>
                        </select>
                   </div>
			    </div>
                
                <div class="form-group ">
                    <label for="">{LANG.order_note}: </label>
                    <textarea name="order_note" id="input" class="form-control" rows="3"></textarea>
                </div>
                
                <div>
                    <button type="submit" name="submit" class="btn btn-primary">Buy</button>
                </div>
            </div>
        </div>
    <script type="text/javascript">
        function change_province(){
            var id_province = $('#province').val();
              $.ajax({url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=order&change_province=1&id_province=' + id_province, success: function(result){
              if(result != "ERR"){
                $("#district").html(result);
                }
              }});
        }
        
         function change_district(){
            var id_district = $('#district').val();
              $.ajax({url: script_name + '?' + nv_name_variable + '=' + nv_module_name + '&' + nv_fc_variable + '=order&change_district=1&id_district=' + id_district, success: function(result){
              if(result != "ERR"){
                $("#ward").html(result);
                }
              }});
        }
        
   </script>
</form>
<!-- END: main -->
