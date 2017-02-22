<div class="content-box closed-box ui-tabs ui-widget ui-widget-content ui-corner-all">
 	<div class="content-box-header">
        <h3 style="margin-left:5px"><{if empty($data)}><{t}>add_taxation_guarantee<{/t}><{else}><{t}>edit_taxation_guarantee<{/t}><{/if}></h3>
        <div class="clear"></div>
    </div>
	<form method="post" id="tgForm" class="pageForm required-validate">
	<input type="hidden" name="tg_id" value="<{if !empty($data)}><{$data.tg_id}><{/if}>" />
		<fieldset>
	        <table>
				<tbody>
					<tr>
						<td class="form_title nowrap text_right"><{t}>g_type<{/t}>：</td>
						<td class="form_input">
                           <select class="text-input" style="width: 214px;"  id="g_type" name="g_type">
		                        <{foreach from=$cTypes item=c name=c key=k}>
		                            <option <{if !empty($data) && $data.g_type == $k}>selected="selected"<{/if}> value='<{$k}>'><{$c}></option>
		                        <{/foreach}>
		                    </select>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><{t}>customer_code<{/t}>：</td>
						<td class="form_input">
							<input name="customer_code" id="customer_code" class="fix-medium1-input text-input" type="text" size="45" placeholder="<{t}>customer_code<{/t}>" value="<{if !empty($data)}><{$data.customer_code}><{else}><{$companyInfo.customer_code}><{/if}>" />
							<strong>*</strong>
							<a href="#" class="tip" title="<{t}>customer_code<{/t}>" onclick="return false;"><img src="/images/help.png"></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><{t}>customer_company_name<{/t}>：</td>
						<td class="form_input">
							<input name="customer_company_name" id="customer_company_name" class="fix-medium1-input text-input" type="text" size="45" placeholder="无需填写，填写代码自动获取;" value="<{if !empty($data)}><{$data.trade_name}><{else}><{<{$companyInfo.trade_name}>}><{/if}>"  readonly="readonly" />
							<strong>*</strong>
							<a href="#" class="tip" title="<{t}>customer_company_name<{/t}>" onclick="return false;"><img src="/images/help.png"></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><{t}>tg_bank_name<{/t}>：</td>
						<td class="form_input" id="bank-name">
							<input type="text" name="tg_bank_name" id="tg_bank_name" class="text-input fix-medium1-input" placeholder="<{t}>请输入担保银行名称<{/t}>" value="<{if !empty($data)}><{$data.tg_bank_name}><{/if}>" />
							<!--
							<select class="text-input" style="width: 214px;" id="tg_bank_name" name="tg_bank_name">
		                        <{foreach from=$banks item=c name=c}>
		                            <option value="<{$c.bank_name_cn}>"<{if !empty($data) && $data.tg_bank_name==$c.bank_name_cn}> selected="selected"<{/if}>>
		                            	<{$c.bank_name_cn}>
		                            </option>
		                        <{/foreach}>
		                    </select>
		                    -->
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><{t}>tg_v_time<{/t}>：</td>
						<td class="form_input">
							<input type="text" name="tg_v_time" id="tg_v_time" class="datepicker text-input fix-medium1-input" readonly="readonly" placeholder="<{t}>2015-12-31<{/t}>" value="<{if !empty($data)}><{$data.tg_v_time}><{/if}>" />
							<strong>*</strong>
							<a href="#" class="tip" title="<{t}>tg_v_time<{/t}>" onclick="return false;"><img src="/images/help.png"></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><{t}>tg_limit_time<{/t}>：</td>
						<td class="form_input">
							<input type="text" name="tg_limit_time" id="tg_limit_time" class="datepicker text-input fix-medium1-input" placeholder="<{t}>2015-12-31<{/t}>" value="<{if !empty($data)}><{$data.tg_limit_time}><{/if}>" />
							<strong>*</strong>
							<a href="#" class="tip" title="<{t}>tg_limit_time<{/t}>" onclick="return false;"><img src="/images/help.png"></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><{t}>currency_code<{/t}>：</td>
						<td class="form_input">
                           <select class="text-input" style="width: 214px;" id="currency_code" name="currency_code">
		                        <{foreach from=$currency item=c name=c}>
		                            <option value='<{$c.code}>'<{if !empty($data) && $data.currency_code==$c.code}> selected<{elseif $c.code=='RMB'}> selected<{/if}>><{$c.code}> <{$c.name}></option>
		                        <{/foreach}>
		                    </select>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><{t}>tg_value<{/t}>：</td>
						<td class="form_input">
							<input name="tg_value" id="tg_value" class="fix-medium1-input text-input" type="text" size="45" placeholder="<{t}>0.00<{/t}>" value="<{if !empty($data)}><{$data.tg_value}><{/if}>" />
							<strong>*</strong>
							<a href="#" class="tip" title="<{t}>tg_value<{/t}>" onclick="return false;"><img src="/images/help.png"></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><{t}>guarantee_basis<{/t}>：</td>
						<td class="form_input">
							<input name="guarantee_basis" id="guarantee_basis" class="fix-medium1-input text-input" type="text" size="45" placeholder="<{t}>guarantee_basis_notice<{/t}>" value="<{if !empty($data)}><{$data.guarantee_basis}><{/if}>" />
							<strong>*</strong>
							<a href="#" class="tip" title="<{t}>guarantee_basis_notice<{/t}>" onclick="return false;"><img src="/images/help.png"></a>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><{t}>customs_code<{/t}>：</td>
						<td class="form_input">
                           <select class="text-input" style="width: 214px;"  id="customs_code" name="customs_code">
		                        <{foreach from=$customsCodes item=c key=k name=a}>
		                            <option value='<{$c.ie_port}>'<{if !empty($data) && $data.customs_code==$c.ie_port}> selected<{/if}>><{$c.ie_port_name}>-<{$c.ie_port}></option>
		                        <{/foreach}>
		                    </select>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><{t}>note<{/t}>：</td>
						<td class="form_input">
							<textarea name="note" id="note" cols="40" rows="4"><{if !empty($data)}><{$data.note}><{/if}></textarea>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><{t}>storage_customer_code<{/t}>：</td>
						<td class="form_input">
						<{if empty($data)}>
							<input type="hidden" name="storage_customer_code" value="<{$companyInfo.customer_code}>" />
							<span class="blue"><{$customer.code}></span>
						<{else}>
							<input type="hidden" name="storage_customer_code" value="<{$data.storage_customer_code}>" />
							<span class="blue"><{$data.storage_customer_code}></span>
						<{/if}>
						</td>
					</tr>
					<tr>
						<td class="form_title nowrap text_right"><{t}>storage_customer_company_name<{/t}>：</td>
						<td class="form_input">
							<{if empty($data)}>
								<input type="hidden" name="storage_customer_company_name" value="<{$companyInfo.trade_name}>" />
								<span class="blue"><{$companyInfo.trade_name}></span>
							<{else}>
								<input type="hidden" name="storage_customer_company_name" value="<{$data.storage_customer_company_name}>" />
								<span class="blue"><{$data.storage_customer_company_name}></span>
							<{/if}>
						</td>
					</tr>
               		<tr>
						<td class="form_title"></td>
						<td colspan="2" class="form_input">
							<input type="hidden" name="add_customer_code" value="<{$customer.code}>">
							<{if empty($data)}>
								<a href="javascript:void(0)" class="button tijiao" onclick="addSubmit();return false;"><{t}>submit<{/t}></a>
							<{else}>
								<a href="javascript:void(0)" class="button tijiao" onclick="editSubmit(<{$data.tg_id}>);return false;"><{t}>DistributorOperationSave<{/t}></a>
							<{/if}>
						</td>
					</tr>
				</tbody>
	        </table>
        </fieldset>
        <div class="clear"></div>
        <div class="infoTips" id="commonPayTip" title="<{t}>InformationTips<{/t}>"></div>
	</form>
</div>
<script type="text/javascript">
$(function(){
	//公用提示信息
	$('#commonPayTip').dialog({
		autoOpen: false,
		modal: true,
		position:['center', 100],
		bgiframe:true,
		width: 600,		
		resizable: true,
		title: '提示信息(按ESC关闭)',
		buttons: {
	            '<{t}>close<{/t}>': function() {
	                $(this).dialog('close');
	            }
		},
		close: function() {
			// code here
		}
	});
	//根据code 获取公司名称
	$('#customer_code').blur(function (){
		var customer_code = $(this).val();
		var myoptions = {
			url: '/storage/taxation-guarantee/get-company-name-by-cus-code',
			type: 'POST',
			cache: false,		
			dataType: 'json',
			processData: true,
			data: {'customer_code': customer_code},
			success: function(json){
				if(json.ask==1){
					$('#customer_code').css({'border-color':''});
					$('#customer_company_name').val(json.data.trade_name);
				}else {
					$("#commonPayTip").html(json.message);
					$('#commonPayTip').dialog('open');
					$('#customer_company_name').val('');
					$('#customer_code').css({'border-color':'#a94442'});
				}
			}, error:function(a,b,c){
				$("#commonPayTip").html("system error");
				$('#commonPayTip').dialog('open');
			}
		}; 
		//显示操作提示
		$.ajax(myoptions);
	});

	//根据类型切换
	$('#g_type').change(function(){
		switch (this.value){
			case '1':
				$('#bank-name').html('<input type="text" name="tg_bank_name" id="tg_bank_name" class="text-input fix-medium1-input" placeholder="<{t}>请输入担保银行名称<{/t}>" value="<{if !empty($data)}><{$data.tg_bank_name}><{/if}>" />');
				break;
			case '2':
				$('#bank-name').html('<select class="text-input" style="width: 214px;" id="tg_bank_name" name="tg_bank_name"><{foreach from=$banks item=c name=c}><option value="<{$c.bank_name_cn}>"<{if !empty($data) && $data.tg_bank_name==$c.bank_name_cn}> selected="selected"<{/if}>><{$c.bank_name_cn}></option><{/foreach}></select>');
				break;
			default:
			$('#bank-name').html('<input type="text" name="tg_bank_name" id="tg_bank_name" class="text-input fix-medium1-input" placeholder="<{t}>请输入担保银行名称<{/t}>" value="<{if !empty($data)}><{$data.tg_bank_name}><{/if}>" />');
		}
	});
});

//处理表单数据
function addSubmit(){
 	var formdata =  $("#tgForm").serialize();
	var myoptions = {
		url: '/storage/taxation-guarantee/add',
		type:'POST',
		cache:false,		
		dataType:'json',
		processData:true,
		data:formdata,
		//dataType:'html',
		success: function(json){
			var messages = '';
			if(typeof json.message=='object'){
				$.each(json.message,function(k,v){
					messages += v+'<br />';
				});
			}else{
				messages = json.message;
			}
			$("#commonPayTip").html(messages);
			$('#commonPayTip').dialog('open');
			if(json.ask==1){
				$('#tgForm')[0].reset();
			}
		}, error:function(a,b,c){
			$("#commonPayTip").html("system error");
			$('#commonPayTip').dialog('open');
		}
	}; 
	//显示操作提示
	$.ajax(myoptions); 
	return false;
}

//编辑
function editSubmit(tg_id){
	var formdata =  $("#tgForm").serialize();
	var poId = $('#poId').val();
	var myoptions = {		
		url:'/storage/taxation-guarantee/add', //提交给哪个执行
		type:'POST',
		cache:false,		
		dataType:'json',
		processData:true,
		data:formdata,
		//dataType:'html',
		success: function(json){
			if(json.ask==1){
				if(poId==''){
					tgForm.reset();
				}
			}
			var messages = '';
			if(typeof json.message=='object'){
				$.each(json.message,function(k,v){
					messages += v+'<br />';
				});
			}else{
				messages = json.message;
			}
			$("#commonPayTip").html(messages);
			$('#commonPayTip').dialog('open');
		}, error:function(a,b,c){
			$("#commonPayTip").html("system error");
			$('#commonPayTip').dialog('open');
		}
	}; 
	//显示操作提示
	$.ajax(myoptions); 
	return false;
}
</script>