<div class="grid-780 grid-780-pd fn-hidden fn-clear" style="border:1px solid #ddd;height:400px;width:780px; padding:20px;">
    <div class="flow-steps">
        <h3 style=" border-bottom:1px solid #666">
          -海关清关入境包裹，请配合提交收件人身份证明
        </h3>
    </div>
    <div class="grid-780 fn-clear">
        
        <form id="registerForm" class="fm-layout"   style="margin-top:30px" method="post" action="/id/submit-identification-preview/session_code/<{$history_idcard_array.session_code}>">
		
			<table style="float:left">
				<tr>
					<td style="text-align:right;width:190px">交易订单号：</td><td><{$history_idcard_array.temp_order_code}></td>
				</tr>
				<tr>
					<td style="text-align:right">身份证名字：</td><td><{$history_idcard_array.idcard_name}></td>
				</tr>
				<tr>
					<td style="text-align:right">身份证号码：</td><td><{$history_idcard_array.idcard_number}></td>
				</tr>
								
				
				<tr>
					<td style="text-align:right; vertical-align:middle" valign="middle">身份证正反两面复印件上传：</td><td><a target="_blank"  title="点击看大图" href="<{$history_idcard_array.front_side_idcard}>"><img src="<{$history_idcard_array.front_side_idcard}>"  height="50"/></a></td>
				</tr>			
						
				<tr>
					<td>&nbsp;</td>
					<td><input name="needver" type="hidden" value="0"/>
					
					<input name="reference_no" type="hidden" value="<{$history_idcard_array.temp_order_code}>"/>
					<input name="consignee_person" type="hidden" value="<{$history_idcard_array.idcard_name}>"/>
					
					<input type="submit" class="submit" class="button text-input" value="已预览无误，立刻上传" style="width:160px;"  /> <input type="button" class="submit" class="button text-input" value="发现有错误，返回重新选择图片" style="width:190px;"  onclick="returnback();"/><span id="wait" style="display:none;color:red">身份证复印件已成功上传，请稍等，页面正在跳转</span></td>
				</tr>
				
				<tr id="infobox">
					<td>&nbsp;</td>
					<td style="color:#FF0000">
					<{foreach from=$info item=error }>
    					<{$error}><br/>
    				<{/foreach}>					</td>
				</tr>				
			</table>  


			<table style="float:left;">
				<tr>
					<td style="text-align:right">收件人省份：</td><td><{$orderAddress.oab_state}></td>
				</tr>

				<tr>
					<td style="text-align:right">收件人城市：</td><td><{$orderAddress.oab_city}></td>
				</tr>
				
				<tr>
					<td style="text-align:right">收件人电话：</td><td><{$orderAddress.oab_phone}></td>
				</tr>
				<tr>
					<td style="text-align:right">收件人邮编：</td><td><{$orderAddress.oab_postcode}></td>
				</tr>	
				<tr>
					<td style="text-align:right">收件人地址：</td><td><{$orderAddress.oab_street_address1}></td>
				</tr>															
			</table>  			
   
        </form>
    </div>
</div>




<script type="text/javascript">
	<{if $ispost eq '1'}>
		$('#wait').show();
		$('#infobox').hide();
		$('.submit').hide();
		setTimeout("redirect_submit_idcard_step_one();",3000);
	 	
	<{/if}>
	function redirect_submit_idcard_step_one(){
		location.href="/id/submit-identification";
	}
	
	function returnback(){
		$('#registerForm').attr('action','/id/submit-identification');
		$('#registerForm').submit();
	}
</script>