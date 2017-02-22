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
		alertTip('请选择需要导入的支付单~');
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
	<h3><{t}>pay-order-batch-upload<{/t}></h3>
</div>
<form id="datafrom" action="/pay/pay-order/import" method="post">
<table cellpadding="0" cellspacing="0" width="100%" class="table-list">
	<thead>
		<tr>
			<th><input id="checkAll" checked="checked" onclick="checkAll1();" type="checkbox"></th>
		    <th>序号</th>
		    <th>订单号</th>
		    <th>客户代码</th>
		    <th>客户参考号</th> 
			<th>订单商品货款</th> 
		    <th>订单商品运费</th>
		    <th>货币币种</th>
		    <th>收货人姓名</th>
			<th>收货人电话</th> 
		    <th>优惠金额</th>
		</tr>
	</thead>
	<tbody>
	<{foreach from=$uploadData item=order key=key}>
		<tr>
			<td width="10">
				<input class="checked" type="checkbox" checked="true" value="<{$key}>" name="select[]">
			</td>
			<td width="20"><{$key}></td>
			<td width="100"><{$order.order_code}></td>
			<td width="100"><{$order.customer_code}></td>
			<td width="100"><{$order.reference_no}></td>
			<td width="100"><{$order.goods_value}></td>
			<td width="100"><{$order.freight_fee}></td>
			<td width="100"><{$order.pay_currency_code}></td>
			<td width="100"><{$order.cosignee_name}></td>
			<td width="100"><{$order.cosignee_telephone}></td>
			<td width="100"><{$order.pro_amount}></td>
		</tr>
	<{/foreach}>
	</tbody>
</table>
<div style="margin: 0 auto; text-align: center; margin-top: 10px;">
	<input id="checkbuttom" onclick="submitBatch();" class='button' type="button" value="导入支付单" />
</div>
</form>
</div>
