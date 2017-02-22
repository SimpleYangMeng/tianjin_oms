<style type="text/css">
    .tableborder th{
        text-align: right;
        height: 20px;
        line-height: 20px;
        padding:5px;
    }
    .tableborder td{
        text-align: left;
        height: 20px;
        line-height: 20px;
        padding:5px;
    }
    .message-warning
    {
        color: #5f5200;
		padding:5px;
		min-height:300px;
		
    }
    .error
    {
        margin: 0;
        padding: 8px 0 0 0;
        height: 1%;
        display: block;
        clear: both;
        overflow: hidden;
        color: #FF0000;
        padding-left: 20px;
    }
</style>
<div id="detail-import-header" style="height:150px;">
	<div style="width:48%;float:left;">
		<form action="/logistic/loading-order/import-preview" method="post" id="detailForm" enctype="multipart/form-data">
			<table cellspacing="0" cellpadding="0" class="tableborder" style="width:100%;">
				<tr>
				<th>个人物品清单:</th>
				<td><input type="file" name="detailInput" id="detailInput" />
				<font style="color:red;"><{t}>please_select_xls_file<{/t}></font>
				</td>
				</tr>
				<tr>
				<th><{t}>sample_file_download<{/t}>:</th>
				<td>
				<img src="/images/download.png" style="width:25px;"><span style="color:#999"><{t}>download_templete<{/t}>:</span><a  style="color:#666666;text-decoration:underline;" href="/logistic/loading-order/download-templete/id/1">模板</a>
				</td>
				</tr>
				<tr>
				<td colspan="2">
				<input type="submit" class="button buttonheight" value="上传" />		
				</td></tr>
			</table>
		</form>
	</div>
	<div style="width:48%;float:left;margin-left:5px;">
		<form action="/logistic/loading-order/product-import-preview" method="post" id="productForm" enctype="multipart/form-data">
			<table cellspacing="0" cellpadding="0" class="tableborder" style="width:100%;">
				<tr>
				<th>商品明细:</th>
				<td><input type="file" name="productInput" id="productInput" />
				<font style="color:red;"><{t}>please_select_xls_file<{/t}></font>
				</td>
				</tr>
				<tr>
				<th><{t}>sample_file_download<{/t}>:</th>
				<td>
				<img src="/images/download.png" style="width:25px;"><span style="color:#999"><{t}>download_templete<{/t}>:</span><a  style="color:#666666;text-decoration:underline;" href="/logistic/loading-order/download-templete/id/2">模板</a>
				</td>
				</tr>
				<tr>
				<td colspan="2">
				<input type="submit" class="button buttonheight" value="上传" />		
				</td></tr>
			</table>
		</form>
	</div>
	<div style="clear:both;"></div>
</div>

<div id="detail-import-body" style="display:none;">
<table cellspacing="0" cellpadding="0" class="tableborder"  style="width:100%;">
	<thead>
	<tr style="background-color: rgb(170, 255, 255);">
		<th align="center" bgcolor="#AAFFFF"><{t}>no<{/t}></th>
		<th align="center" bgcolor="#AAFFFF">物品清单号</th>
		<th align="center" bgcolor="#AAFFFF">物品清单内部编号</th>
		<th align="center" bgcolor="#AAFFFF">订单关联单号</th>
		<th align="center" bgcolor="#AAFFFF">支付单号</th>
		<th align="center" bgcolor="#AAFFFF">运单号</th>
	</tr>
	</thead>
	<tbody id='detailAjaxResult'>
	</tbody>
</table>
</div>

<div id="product-import-body" style="display:none;margin-top:10px;">
<table cellspacing="0" cellpadding="0" class="tableborder"  style="width:100%;">
	<thead>
	<tr style="background-color: rgb(170, 255, 255);">
		<th align="center" bgcolor="#AAFFFF">商品序号</th>
		<th align="center" bgcolor="#AAFFFF">报关单号</th>
		<th align="center" bgcolor="#AAFFFF">出入库单编号</th>
		<th align="center" bgcolor="#AAFFFF">商品中文名称</th>
	</tr>
	</thead>
	<tbody id='productAjaxResult'>
	</tbody>
</table>
</div>

<script type="text/javascript">
$('#detailForm').on('submit', function() {
	if(!$('#detailInput').val()){
		alertTip('<{t}>make_sure_that_you_have_selected_a_file<{/t}>');
		return false;
	}else{
		$(this).ajaxSubmit({
			type: 'POST',
			url: '/logistic/loading-order/import-preview',
			dataType:'json',
			success: function(json) {
				if(1 == json.ask){
					var i 		= 1;
					var html 	= '';
					$.each(json.data,function(key,val){
						html	+= '<tr>';
						html	+= '<td>'+i+'</td>';
						html	+= '<td>'+val.pim_code+'</td>';
						html	+= '<td>'+val.pim_reference_no+'</td>';
						html	+= '<td>'+val.order_reference_no+'</td>';
						html	+= '<td>'+val.po_code+'</td>';
						html	+= '<td>'+val.wb_code+'</td>';
						html	+= '</tr>';
					});
					$("#detail-import-body").show();
				}else{
					var message	= json.message;
					$.each(json.error,function(key,val){
						message	+= val+'<br/>';
					})
					alertTip(message);
					return false;
				}
				$("#detailAjaxResult").html(html);
			}
		});
	}
	return false;
});
$('#productForm').on('submit', function() {
	if(!$('#productInput').val()){
		alertTip('<{t}>make_sure_that_you_have_selected_a_file<{/t}>');
		return false;
	}else{
		$(this).ajaxSubmit({
			type: 'POST',
			url: '/logistic/loading-order/product-import-preview',
			dataType:'json',
			success: function(json) {
				if(1 == json.ask){
					var i 		= 1;
					var html 	= '';
					$.each(json.data,function(key,val){
						html	+= '<tr>';
						html	+= '<td>'+val.gNo+'</td>';
						html	+= '<td>'+val.declNumber+'</td>';
						html	+= '<td>'+val.formId+'</td>';
						html	+= '<td>'+val.nameCn+'</td>';
						html	+= '</tr>';
					});
					$("#product-import-body").show();
				}else{
					var message	= json.message;
					$.each(json.error,function(key,val){
						message	+= val+'<br/>';
					})
					alertTip(message);
					return false;
				}
				$("#productAjaxResult").html(html);
			}
		});
	}
	return false;
});
</script>