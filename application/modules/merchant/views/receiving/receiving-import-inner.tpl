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
<div id="detail-import-header" style="height:160px;">
	<div style="float:left;width:48%;">
	<form action="/merchant/receiving-upload/import-preview" method="post" id="detailForm" enctype="multipart/form-data">
		<table cellspacing="0" cellpadding="0" class="tableborder" style="width:100%;">
			<tr>
			<th>入库明细:</th>
			<td><input type="file" name="detailInput" id="detailInput" />
			<font style="color:red;"><{t}>please_select_xls_file<{/t}></font>
			</td>
			</tr>
			<tr>
			<th><{t}>sample_file_download<{/t}>:</th>
			<td>
			<img src="/images/download.png" style="width:25px;"><span style="color:#999"><{t}>download_templete<{/t}>:</span><a  style="color:#666666;text-decoration:underline;" href="/merchant/receiving-upload/download-templete/id/1">模板</a>
			</td>
			</tr>
			<tr>
			<td colspan="2">
			<input type="submit" class="button buttonheight" value="上传" />		
			</td></tr>
		</table>
	</form>
	</div>
	<div style="float:left;width:48%;padding-left:10px;">
	<form action="/merchant/receiving-upload/boat-import-preview" method="post" id="boatForm" enctype="multipart/form-data">
		<table cellspacing="0" cellpadding="0" class="tableborder" style="width:100%;">
			<tr>
			<th>集装箱信息:</th>
			<td><input type="file" name="boatInput" id="boatInput" />
			<font style="color:red;"><{t}>please_select_xls_file<{/t}></font>
			</td>
			</tr>
			<tr>
			<th><{t}>sample_file_download<{/t}>:</th>
			<td>
			<img src="/images/download.png" style="width:25px;"><span style="color:#999"><{t}>download_templete<{/t}>:</span><a  style="color:#666666;text-decoration:underline;" href="/merchant/receiving-upload/download-templete/id/2">模板</a>
			</td>
			</tr>
			<tr>
			<td colspan="2">
			<input type="submit" class="button buttonheight" value="上传" />		
			</td></tr>
		</table>
	</form>
	</div>
</div>

<div id="detail-import-body" style="display:none;">
<table cellspacing="0" cellpadding="0" class="tableborder"  style="width:100%;">
	<thead>
	<tr>
		<th colspan="7" style="text-align:left;">入库单明细</th>
	</tr>
	<tr style="background-color: rgb(170, 255, 255);">
		<th align="center" bgcolor="#AAFFFF"><{t}>no<{/t}></th>
		<th align="center" bgcolor="#AAFFFF">料件号</th>
		<th align="center" bgcolor="#AAFFFF">产品名称</th>
		<th align="center" bgcolor="#AAFFFF">申报数量</th>
		<th align="center" bgcolor="#AAFFFF">法定数量</th>
		<th align="center" bgcolor="#AAFFFF">申报单价</th>
		<th align="center" bgcolor="#AAFFFF">申报总价</th>
	</tr>
	</thead>
	<tbody id='detailAjaxResult'>
	</tbody>
	<tr>
		<th colspan="7" style="text-align:left;">集装箱信息</th>
	</tr>
	<tbody id='contaAjaxResult'>
	<tr>
		<th colspan="7" style="text-align:center;">无数据</th>
	</tr>
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
			url: '/merchant/receiving-upload/import-preview',
			dataType:'json',
			success: function(json) {
				var html	= '';
				$("#detail-import-body").hide();
				if(1 == json.ask){
					var html	= '';
					var i 		= 1;
					$.each(json.data,function(key,val){
						html	+= '<tr>';
						html	+= '<td>'+i+'</td>';
						html	+= '<td>'+val.goodsId+'</td>';
						html	+= '<td>'+val.nameCn+'</td>';
						html	+= '<td>'+val.gQty+'</td>';
						html	+= '<td>'+val.qty1+'</td>';
						html	+= '<td>'+val.declPrice+'</td>';
						html	+= '<td>'+val.declTotal+'</td>';
						html	+= '</tr>';
						i++;
					});
					$("#detail-import-body").show();
				}else{
					var message = json.message+'<br/>';
					if(null != json.error){
						$.each(json.error,function(item,val){
							message += val+'<br/>';
						})
					}
					alertTip(message);
					return false;
				}
				$("#detailAjaxResult").html(html);
			}
		});
	}
	return false;
});

$('#boatForm').on('submit', function() {
	if(!$('#boatInput').val()){
		alertTip('<{t}>make_sure_that_you_have_selected_a_file<{/t}>');
		return false;
	}else{
		$(this).ajaxSubmit({
			type: 'POST',
			url: '/merchant/receiving-upload/boat-import-preview',
			dataType:'json',
			success: function(json) {
				var html	= '<tr style="background-color: rgb(170, 255, 255);"><th>序号</th><th colspan="2">集装箱号</th><th colspan="2">规格</th><th colspan="2">自重</th></tr>';
				if(1 == json.ask){
					var i 		= 1;
					$.each(json.data,function(key,val){
						html	+= '<tr>';
						html	+= '<td>'+i+'</td>';
						html	+= '<td colspan="2">'+val.conta_id+'</td>';
						html	+= '<td colspan="2">'+val.conta_model+'</td>';
						html	+= '<td colspan="2">'+val.conta_wt+'</td>';
						html	+= '</tr>';
					});
					html +='<tr>';
					html += '<td colspan="7">集装箱数量:'+i+'</td>';
					html +='</tr>';
				}else{
					var message	= json.message;
					if(null != json.error){
						$.each(json.error,function(key,val){
							message	+= val+'<br/>';
						})
					}
					alertTip(message);
					return false;
				}
				$("#contaAjaxResult").html(html);
			}
		});
	}
	return false;
});

</script>