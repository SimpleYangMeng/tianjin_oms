<div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;">载货单详细</h3>        
    </div>


<style type="text/css">
    <!--
    .tabContent {
        display: none;
    }

    .imgWrap {
        width: 76px;
        height: 76px;
        margin: 0px;
        border: 0 none;
    }
    .center{
        text-align: center;
    }
    .right{
        text-align: right;
    }
    .tableborder th {text-align: right;}
    -->
</style>
<script type="text/javascript">
$(function(){
	$(".tab").click(function(){
		$(".tabContent").hide();
		$(this).parent().addClass("active");
		$(this).parent().siblings().removeClass("active");
		$("#"+$(this).attr("id").replace("tab_","")).show();
	});
	$("#detail").show();
});
</script>
<div style="margin-right: 0px;" class="nbox_c marB10">
    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <tbody>
        <tr>
            <th>载货单号</th>
            <td><{$row.sb_code}></td>
            <th>状态</th>
            <td><{$status[$row.status]}></td>
        </tr>
        <tr>
            <th>申报口岸</th>
            <td><{$row.decl_port}>&nbsp;<{$row.decl_port_name}></td>
            <th>进出口岸</th>
            <td><{$row.ie_port}>&nbsp;<{$row.ie_port_name}></td>
        </tr>
        <tr>
            <th>车牌号</th>
            <td><{$row.car_no}></td>
			<th>总件数</th>
            <td><{$row.pack_no}></td>
        </tr>
		<tr>
            <th>总重量</th>
            <td><{$row.total_wt}></td>
			<th>车自重 </th>
            <td><{$row.car_wt}></td>
        </tr>
		<tr>
            <th>单证总数</th>
            <td><{$row.form_num}></td>
			<th>辅助系统载货单号</th>
            <td><{$row.fzxt_code}></td>
        </tr>
		<tr>
            <th>申报单位代码</th>
            <td><{$row.agent_code}></td>
			<th>申报单位名称</th>
            <td><{$row.agent_name}></td>
        </tr>
		<tr>
            <th>经营单位代码</th>
            <td><{$row.trade_code}></td>
			<th>经营单位名称</th>
            <td><{$row.trade_name}></td>
        </tr>
		<tr>
            <th>仓储企业单位代码</th>
            <td><{$row.wh_code}></td>
			<th>仓储企业单位名称</th>
            <td><{$row.wh_name}></td>
        </tr>
		<tr>
            <th>收发货人代码</th>
            <td><{$row.owner_code}></td>
			<th>收发货人名称</th>
            <td><{$row.owner_name}></td>
        </tr>
		<{if $row.mark_delete gte 1}>
		<tr>
            <th>申报删除状态</th>
            <td><{$deleteStatus[$row.mark_delete]}></td>
			<th>申请单编号</th>
            <td><{$row.mark_delete_code}></td>
        </tr>
		<tr>
            <th>申请原因</th>
            <td colspan="3"><{$row.mark_delete_reason}></td>
        </tr>
		<{/if}>
        </tbody>
    </table>
</div>


<div class="tabs_header">
    <ul class="tabs">
        <li class='active'>
            <a href="javascript:void(0);" id='tab_detail' class='tab'><span>货物清单</span></a>
        </li>
        <li><a href="javascript:void(0);" id='tab_log' class='tab'><span><{t}>Log<{/t}></span></a></li>
    </ul>
</div>

<div class='tabContent' id='detail'>
    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <thead>
        <tr>
            <th>载货单号</th>
            <th>物品清单号</th>
			<th>订单编号</th>
            <th>物流单编号</th>
            <th>支付单编号</th>
            <th>交易订单号</th>
        </tr>
        </thead>
        <tbody id='loadData'>
        <{foreach from=$detail item=item}>
        <tr>
            <td><{$item.sb_code}></td>
            <td><{$item.form_id}></td>
            <td><{$item.order_code}></td>
            <td><{$item.wb_code}></td>
			<td><{$item.po_code}></td>
			<td><{$item.order_reference_no}></td>
        </tr>
        <{/foreach}>
        </tbody>
    </table>
</div>

<div class='tabContent' id='log'>
    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <thead>
        <tr>
            <th>载货单号</th>
            <th>原始状态</th>
            <th>修改后的状态</th>
            <th>描述</th>
            <th>发生时间</th>
            <th><{t}>AccessIP<{/t}></th>
        </tr>
        </thead>
        <tbody id='loadData'>
        <{foreach from=$log item=row}>
        <tr>
            <td><{$row.sb_code}></td>
			<td><{$status[$row.sbl_status_from]}></td>
            <td><{$status[$row.sbl_status_to]}></td>
            <td><{$row.sbl_note}></td>
            <td><{$row.sbl_add_time}></td>
            <td><{$row.sbl_ip}></td>
        </tr>
        <{/foreach}>
        </tbody>
    </table>
</div>

<div class='clear'></div>

<script>
$(function(){
    
    $("#detail").alterBgColor();
	$("#asnlog").alterBgColor();
    $("#detailbatch").alterBgColor();
    $("#asnTracking").alterBgColor();
});
</script>