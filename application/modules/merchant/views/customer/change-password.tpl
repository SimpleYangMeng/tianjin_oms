<style type="text/css">
    #infoform label{
        line-height: 20px;
    }
    #infoform .fm-req{
        margin-bottom: 10px;
    }
    #orderForm tbody span.error{
        top:auto;
    }
    span.error{
        top:auto;
        left:158px;
    }
	.regForm{
		margin-left:15px;
	}
</style>


<div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <h3 style="margin-left:5px"><{t}>ChangePassword<{/t}></h3>
        <div class="clear"></div>
    </div>

<div class="regForm">
    				<form action="/merchant/customer/change-password" method="post"  id="infoform" class="fm-layout"
          enctype="multipart/form-data"  >
		  
		  			<table>
						<tr>
							<th>
								<label for="old_password"><{t}>oldpassword<{/t}>：</label>
							</th>
							<td>
								<input type="password"  class="text-input fix-medium-input"  value=""  name="old_password" id="old_password" size="25" />
							</td>
						</tr>
						
						<tr>
							<th>
								<label for="new_password1"><{t}>newpassword<{/t}>：</label>
							</th>
							<td>
								<input type="password"  class="text-input fix-medium-input"  value=""  name="new_password1" id="new_password1" size="25" />&nbsp;<{t}>change_password_tip<{/t}>
							</td>
						</tr>
						
						<tr>
							<th>
								<label for="new_password2"><{t}>confirm_again<{/t}>：</label>
							</th>
							
							<td>
								<input type="password"  class="text-input fix-medium-input"  value=""  name="new_password2" id="new_password2" size="25" />
							</td>
						</tr>
						<tr>
							<th>&nbsp;
							</th>
							<td >
							
									<input type="hidden" class="text-input fix-medium-input"  value="<{$account_code}>" name="account_code">
									
									<a  class="button tijiao"  onclick="formSubmit();return false;" /><{t}>submit<{/t}></a>							
							</td>
						</tr>
					</table>
        			
       				
        			
        			
        			
    				</form>
					</div>				


</div>

<div class="fm-req" id="returnMsg" style="margin-top: 5px;margin-left:60px;color:red;"></div>
<script>
$('#returnMsg').dialog({
			autoOpen: false,
			modal: false,
			bgiframe:true,
			width: 400,		
			resizable: true			
			});
</script>

<script type="text/javascript">
    $(function(){
        $('[name="new_password1"]').val("");
        $('[name="new_password2"]').val("");
        $("[name='old_password']").val("");
    })

    function formSubmit(){
        new_password1 = $('[name="new_password1"]').val();
        new_password2 = $('[name="new_password2"]').val();
        old_password = $("[name='old_password']").val();
        account_code = $('[name="account_code"]').val();
        if(new_password1.length<6){
            alert("<{t}>change_password_tip<{/t}>");
            return false;
        }
        if(old_password==""||new_password1==""||new_password2==""){
			alert("<{t}>please_enter_old_password_new_password<{/t}>");
            return false;
        }
        if(new_password1!=new_password2){
            alert("<{t}>the_two_passwords_you_entered_do_not_match<{/t}>");
            return false;
        }
        if(old_password==new_password1){
            alert("<{t}>old_and_new_password_cannot_be_the_same<{/t}>");
            return false;
        }
        pass = true;
        $.ajax({
            type:'post',
            async:false,
            url:'/merchant/customer/checkpwd/password/'+old_password+"/account_code/"+account_code,
            //data:'password='+old_password+"&customer_code="+customer_code,
            dataType:'json',
            success:function(json){
                if(json=="0"){
                    alert("<{t}>the_old_password_is_incorrect<{/t}>");
                    pass = false;
                }
            }
        })
        if(!pass) return pass;
        formData = $("#infoform").serialize();
        $.ajax({
            type:'post',
            async:false,
            url:'/merchant/customer/change-password',
            data:formData,
            dataType:'json',
            success:function(json){
                $('[name="old_password"]').val("");
                $('[name="new_password1"]').val("");
                $('[name="new_password2"]').val("");
                $("#returnMsg").html(json.message);
				$('#returnMsg').dialog('open');
            }
        })
    }
</script>
