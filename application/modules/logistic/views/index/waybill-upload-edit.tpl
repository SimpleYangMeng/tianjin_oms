<script type="text/javascript">
//全选
function checkAll1(){
    if($('#checkAll').is(':checked')){
        $('.checked').attr('checked',true).addClass('selected');
    }else{
        $('.checked').attr('checked',false)
    }
}
//提交
function submitBatch(){
    var checked = false;
    $('.checked').each(function(){
        if($(this).is(':checked')){
            checked = true;
        }
    })
    if(checked == false){
		alertTip('请选择需要导入的运单~');
		return false;
    }
	$('#datafrom').submit();
}
</script> 
<style type="text/css">
table { border-collapse: collapse; border-spacing: 0; }
label { cursor: pointer;}
.table-list { background: #FFFFFF;}
.table-list td,.table-list th{padding-left:3px;padding-right:3px; text-align: center;}
.table-list thead th{ height:36px; background:#4098CA; border-bottom:1px solid #d5dfe8; font-weight:700; color: #FFFFFF;}
.table-list tbody td,.table-list .btn{border-bottom: #4098CA 1px solid; padding-top:5px; padding-bottom:5px;}
.table-list tr:hover,.table-list table tbody tr:hover{ background:#fbffe4;}
.table-list .input-text-c{ padding:0; height:18px;}
.table-list tr.on,.table-list tr.on td,.table-list tr.on th,.table-list td.on,.table-list th.on{background:#fdf9e5;}
.td-line{border:1px solid #4098CA}
.td-line td,.td-line th{border:1px solid #4098CA}
.content-box-header h3{color: #4098CA; margin-left: 5px;}
</style>
<div class="content-box ui-tabs ui-widget ui-widget-content ui-corner-all">
<div class="content-box-header cl">
	<h3><{t}>uploadWaybill<{/t}></h3>
</div>
<form id="datafrom" action="/logistic/index/import" method="post">
<table cellpadding="0" cellspacing="0" width="100%" class="table-list">
	<thead>
		<tr>
			<th><input id="checkAll" checked="checked" onclick="checkAll1();" type="checkbox"></th>
		    <th>序号</th>
		    <th>客户代码</th>
		    <th>交易单号</th>
			<th>运费</th> 
		    <th>订单商品货款</th>
		    <th>币种</th>
		    <th>保价费</th>
		    <th>毛重</th>
		    <th>净重</th>
		    <th>件数</th>
		    <th>包裹单信息</th>
		    <th>商品信息</th>
		    <th>收货人名称</th>
		    <th>收货人电话</th>
		    <th>发货人</th>
		    <th>发货人电话</th>
		    <th>备注</th>
		</tr>
	</thead>
	<tbody>
	<{foreach from=$uploadData item=waybill key=key}>
		<tr>
			<td width="10">
				<input class="checked" type="checkbox" checked="true" value="<{$key}>" name="select[]">
			</td>
			<td width="20"><{$key}></td>
			<td width="100"><{$waybill.customerCode}></td>
			<td width="100"><{$waybill.referenceNo}></td>
			<td width="100"><{$waybill.freight}></td>
			<td width="100"><{$waybill.goodsValue}></td>
			<td width="100"><{$waybill.currencyCode}></td>
			<td width="100"><{$waybill.insureFee}></td>
			<td width="100"><{$waybill.weight}></td>
			<td width="100"><{$waybill.netWeight}></td>
			<td width="100"><{$waybill.packNo}></td>
			<td width="100"><{$waybill.parcelInfo}></td>
			<td width="100"><{$waybill.goodsInfo}></td>
			<td width="100"><{$waybill.consignee}></td>
			<td width="100"><{$waybill.consigneeTelephone}></td>
			<td width="100"><{$waybill.shipper}></td>
			<td width="100"><{$waybill.shipperTelephone}></td>
			<td width="100"><{$waybill.note}></td>
		</tr>
	<{/foreach}>
	</tbody>
</table>
<div style="margin: 0 auto; text-align: center; margin-top: 10px;">
	<input id="checkbuttom" onclick="submitBatch();" class='button' type="button" value="导入运单" />
</div>
</form>
</div>
