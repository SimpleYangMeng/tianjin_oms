<style>
	.fm-req{margin-top:10px;}
	.fm-opt{margin-top:10px;}
</style>

<style type="text/css">
    #infoform label{
        line-height: 20px;
    }
	#infoform .fm-opt{}
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
</style>


<div class="content-box closed-box ui-tabs ui-widget ui-widget-content ui-corner-all">
 	<div class="content-box-header">
        <h3 style="margin-left:5px"><{t}>contact_baseinfo<{/t}></h3>
        <div class="clear"></div>
    </div>

	
		
		<form name="addAcount" action="/merchant/customer/edit" method="post" id="infoform" class="fm-layout"  enctype="multipart/form-data"  style="padding-left:20px" >
		<fieldset>
			
			<table>
				<tr>
					<th class="form_title nowrap text_right"><label for="cab_firstname"><{t}>lastName2<{/t}>：</label></th>
					<td class="form_input">						
						<input type="text" id="cab_lastname" name="cab_lastname" class="text-input fix-medium-input" value="<{$customerAddress.cab_lastname}>" />
						<strong class="red">*</strong>					
					</td>
				</tr>
				
				
				<tr>
					<th class="form_title nowrap text_right">
						<label for="cab_lastname"><{t}>firstName2<{/t}>：</label>

					
					</th>
					<td class="form_input">

						<input type="text" id="cab_firstname" name="cab_firstname" class="text-input fix-medium-input" value="<{$customerAddress.cab_firstname}>" />
						<strong class="red">*</strong>						
					
					</td>
				</tr>
				
				
				<tr>
					<th class="form_title nowrap text_right">
						<label for="cab_phone"><{t}>phone<{/t}>：</label>
					</th>
					<td class="form_input">
						<input type="text" id="cab_phone" name="cab_phone" class="text-input fix-medium-input" value="<{$customerAddress.cab_phone}>" />
                		<strong class="red">*</strong>	
					
					</td>
				</tr>
				
				
				<tr>
					<th class="form_title nowrap text_right">
						<label for="cab_fax"><{t}>fax<{/t}>：</label>
					</th>
					<td class="form_input">
						<input type="text" id="cab_fax" name="cab_fax" class="text-input fix-medium-input" value="<{$customerAddress.cab_fax}>" />
                		<strong class="red"></strong>
					</td>
				</tr>	
				
				
				<tr>
					<th class="form_title nowrap text_right">
						 <label for="country"><{t}>country<{/t}>：<strong></strong></label>
					</th>
					<td class="form_input">
						<select id="country" name="country" class="validate[required]" style="width:105px;">
							<option value=""><{t}>pleaseSelected<{/t}> <{t}>country<{/t}></option>
							<{if $country neq ""}>
							<{foreach from=$country item=item}>
								<option value="<{$item['country_id']}>" <{if $item['country_id'] eq $customerAddress.cab_country_id}>selected="selected"<{/if}>><{$item['country_name']}></option>
								<{/foreach}>
							<{/if}>
						</select>
						<strong class="red">*</strong>
					</td>
					
				</tr>
				
				<tr>
					<th class="form_title nowrap text_right">
						<label for="cab_state"><{t}>state<{/t}>：</label>
					</th>
					<td class="form_input">
						<input type="text" id="cab_state" name="cab_state" class="text-input fix-medium-input" value="<{$customerAddress.cab_state}>" />
						<strong class="red">*</strong>					
					
					</td>
				
				</tr>
				
				<tr>
					<th class="form_title nowrap text_right">
						<label for="cab_city"><{t}>city<{/t}>：</label>
					</th>
					
					<td class="form_input">
						<input type="text" id="cab_city" name="cab_city" class="text-input fix-medium-input" value="<{$customerAddress.cab_city}>" />
						<strong class="red">*</strong>
					</td>
				</tr>
				
				
				<tr>
					<th class="form_title nowrap text_right">
						<label for="postcode"><{t}>postalCode<{/t}>：</label>
					</th>
					<td class="form_input">
						<input type="text" id="postcode" name="postcode" class="text-input fix-medium-input" value="<{$customerAddress.cab_postcode}>" />
						<strong class="red"></strong>					
					</td>
				</tr>		
				
				<tr>
					<th class="form_title nowrap text_right">
						<label for="cab_street_address1"><{t}>address<{/t}>：</label>
					</th>
					
					<td class="form_input">
						<input type="text" id="cab_street_address1" name="cab_street_address1" class="text-input fix-medium-input" value="<{$customerAddress.cab_street_address1}>" />
						<strong class="red">*</strong>
					</td>
					
				
			</table>		
			
		</fieldset>

		<div class="fm-submit" style="margin-top:10px; padding-left:46px">
			
			<input type="hidden" name="id" value="<{$customerAddress['cab_id']}>">
			<a  class="button tijiao"  onclick="dosubmit();return false;" /><{t}>submit<{/t}></a>
		</div>
	</form>			
			
			
	
			
						
			

<div class="infoTips" id="tips" title="<{t}>InformationTips<{/t}>">
			
</div>
</div>
<script>
$('#tips').dialog({
			autoOpen: false,
			modal: false,
			bgiframe:true,
			position:[50,50],
			width: 400,				
			resizable: true			
			});
</script>


<script>
    $(function () {
        $("#infoform")[0].reset();

        //验证电话
        $('#cab_phone').blur(function (){
            var emialRegular = /^0\d{2,3}-?\d{7,8}$/;
            if(!emialRegular.test($(this).val())){
                $(this).next().css('color','red');
                $(this).next().text('电话填写错误');
                $(this).focus();
            }else {
                $(this).next().css('color','green');
                $(this).next().text('√');
            }
        });
        //验证邮编
        $('#postcode').blur(function (){
            var emialRegular = /^[1-9][0-9]{5}$/;
            if(!emialRegular.test($(this).val())){
                $(this).next().css('color','red');
                $(this).next().text('邮编填写错误');
                $(this).focus();
            }else {
                $(this).next().css('color','green');
                $(this).next().text('√');
            }
        });

    });
			
	function dosubmit(){
		//return false;	
		///merchant/product/add-save
		var errorHtml = '';
		if($.trim($('#cab_lastname').val())==''){
			errorHtml +='<p><{t}>lastName2<{/t}> <{t}>require<{/t}></p>';
		}
		if($.trim($('#cab_firstname').val())==''){
			errorHtml +='<p><{t}>firstName2<{/t}> <{t}>require<{/t}></p>';
		}
		if($.trim($('#cab_phone').val())==''){
			errorHtml +='<p><{t}>phone<{/t}> <{t}>require<{/t}></p>';
		}
		if($.trim($('#country').val())==''){
			errorHtml +='<p><{t}>country<{/t}> <{t}>require<{/t}></p>';
		}
		if($.trim($('#cab_state').val())==''){
			errorHtml +='<p><{t}>state<{/t}> <{t}>require<{/t}></p>';
		}
		if($.trim($('#cab_city').val())==''){
			errorHtml +='<p><{t}>city<{/t}> <{t}>require<{/t}></p>';
		}
		if($.trim($('#postcode').val())==''){
			errorHtml +='<p><{t}>postalCode<{/t}> <{t}>require<{/t}></p>';
		}
		if($.trim($('#cab_street_address1').val())==''){
			errorHtml +='<p><{t}>address<{/t}> <{t}>require<{/t}></p>';
		}
		if(errorHtml!=''){
			alertTip(errorHtml);
			return false;
		}
					var options = {
					//target:'#combinetips', //后台将把传递过来的值赋给该元素
					url:'/merchant/customer/edit', //提交给哪个执行
					type:'POST',
					dataType:'json',
					//dataType:'html',
					success: function(data){
						var html ="";
						
						if(data.ask==1){
							html += data.message+'</br></br>';
							
							$("#tips").html(html);			
						}else{													
							
							html+=data.message+"<br/>";				
							$.each(data.error,function(idx,vitem){
								html+=vitem+"<br/>";
							});
							
							
							$("#tips").html(html);
						
						}
						
						$('#tips').dialog('open');
						
					
					
					
					}}; //显示操作提示
		
					$("#infoform").ajaxSubmit(options); 
					return false;
		
				
		}  //end of function			
</script>