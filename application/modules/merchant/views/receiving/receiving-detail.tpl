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
        //$(".tabContent").eq(0).show();
        $("#detail").show();
    });
    //-->
</script>
<div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;">入库单详细</h3>        
    </div>
<div style="margin-right: 0px;" class="nbox_c marB10">
    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <tbody>
        <tr>
            <th class="center">入库单号</th>
            <td><{$asnRow.receiving_code}></td>
            <th>企业清单内部编号</th>
            <td><{$asnRow.list_no}></td>
        </tr>
        <tr>
            <th>仓库账册号</th>
            <td><{$asnRow.warehouse_code}></td>
            <th>状态</th>
            <td><{$asnStatus[$asnRow.receiving_status]}></td>
        </tr>
        <tr>
            <th>海关状态</th>
            <td><{$customsStatus[$asnRow.customs_status]}></td>
            <th>检验检疫状态</th>
            <td><{$ciqStatus[$asnRow.ciq_status]}></td>
        </tr>
        <tr>
            <th>关联单证类型</th>
            <td><{if isset($receivingType[$asnRow.receiving_type])}><{$receivingType[$asnRow.receiving_type]}><{/if}></td>
			<th>关联单证单号</th>
            <td><{$asnRow.declaration_number}></td>
        </tr>
        <tr>
            <th>申报口岸</th>
            <td><{$asnRow.decl_port_name}></td>
            <th>进出口岸</th>
            <td><{$asnRow.ie_port_name}></td>
        </tr>
        <tr>
            <th>起运国</th>
            <td><{$asnRow.trade_country_name}></td>
			<th>目的港</th>
            <td><{$asnRow.destination_port_name}></td>
        </tr>
		<tr>
        </tr>
        <tr>
            <th>进出口类型</th>
            <td ><{if $asnRow.ie_mode eq 'I'}>进口<{elseif $asnRow.ie_mode eq 'E'}>出口<{/if}></td>
            <th>监管方式</th>
            <td><{$asnRow.trade_mode_name}></td>
        </tr>
		<tr>
            <th>成交方式</th>
            <td ><{$asnRow.trans_mode_name}></td>
            <th>业务类型</th>
            <td><{$asnRow.form_type_name}></td>
        </tr>
        <tr>
            <th>外包装种类</th>
            <td><{$asnRow.wrap_type_name}></td>
            <th>运输方式</th>
            <td><{$asnRow.traf_mode_name}></td>
        </tr>
		<tr>
            <th>运输工具名称</th>
            <td><{$asnRow.traf_name}></td>
            <th>航次</th>
            <td><{$asnRow.voyage_no}></td>
        </tr>
        <tr>
			<th>经营单位代码</th>
			<td><{$asnRow.trade_co}></td>
			<th>经营单位名称</th>
			<td><{$asnRow.trade_name}></td>
        </tr>
        <tr>
            <th>申报单位代码</th>
            <td><{$asnRow.agent_code}></td>
            <th>申报单位名称</th>
            <td><{$asnRow.agent_name}></td>
        </tr>
		
        <tr>
            <th>收（发）货单位</th>
            <td><{$asnRow.owner_code}></td>
            <th>收（发）货单位名称</th>
            <td><{$asnRow.owner_name}></td>
        </tr>
		<tr>
            <th>毛重 </th>
            <td><{$asnRow.roughweight}></td>
            <th>净重 </th>
            <td><{$asnRow.net_weight}></td>
        </tr>
        <tr>
            <th>件数</th>
            <td><{$asnRow.pack_no}></td>
            <th>入库日期</th>
            <td><{$asnRow.import_date}></td>
        </tr>
        <tr>
            <th>是否有废旧物品</th>
            <td><{if $asnRow.waste_flag eq 'N'}>否<{elseif $asnRow.waste_flag eq 'Y'}>是<{/if}></td>
            <th>是否带有植物性包装及铺垫材料</th>
            <td><{if $asnRow.pack_flag eq 'N'}>否<{elseif $asnRow.pack_flag eq 'Y'}>是<{/if}></td>
        </tr>
        <tr>
            <th>报检单号</th>
            <td><{$asnRow.law_no}></td>
            <th>电商企业代码</th>
            <td><{$asnRow.ebc_no}></td>
        </tr>
        <tr>
            <th>启运口岸</th>
            <td><{$asnRow.desp_port_name}>(<{$asnRow.desp_port}>)</td>
            <th>入境口岸</th>
            <td><{$asnRow.entry_port_name}>(<{$asnRow.entry_port}>)</td>
        </tr>
        <tr>
            <th>施检机构</th>
            <td><{$asnRow.check_org_code_name}>(<{$asnRow.check_org_code}>)</td>
            <th>目的机构</th>
            <td><{$asnRow.org_code_name}>(<{$asnRow.org_code}>)</td>
        </tr>
        <tr>
            <th>申报人名称</th>
            <td><{$asnRow.decl_person}></td>
            <th>提货单号</th>
            <td><{$asnRow.ciq_bill_no}></td>
        </tr>
        <tr>
            <th>检疫</th>
            <td>
            <{if $asnRow.quarantine eq '0'}>未接收
            <{else if $asnRow.quarantine eq '1'}>待检疫
            <{else if $asnRow.quarantine eq '2'}>合格
            <{else if $asnRow.quarantine eq '3'}>不合格
            <{/if}>
            </td>
            <th>查验</th>
            <td>
            <{if $asnRow.check eq '-1'}>未接收
            <{else if $asnRow.check eq '0'}>未查验
            <{else if $asnRow.check eq '1'}>待查验
            <{else if $asnRow.check eq '2'}>合格 
            <{else if $asnRow.check eq '3'}>不合格 
            <{/if}>
            </td>
        </tr>
        <tr>
			<th>提运单号</th>
            <td><{$asnRow.bill_no}></td>
			<th>备注</th>
            <td><{$asnRow.receiving_description}></td>
        </tr>
        <{if $asnRow.ciq_reject_reason neq ''}>
        <tr>
            <th>商检错误回执</th>
            <td colspan="3"><{$asnRow.ciq_reject_reason}></td>
        </tr>
        <{/if}>
        </tbody>
    </table>
</div>


<div class="tabs_header">
    <ul class="tabs">
        <li class='active'>
            <a href="javascript:void(0);" id='tab_detail' class='tab'><span><{t}>ReceivingDetails<{/t}></span></a>
        </li>
		<{if !empty($container)}>
		<li><a href="javascript:void(0);" id='tab_container' class='tab'><span>集装箱明细</span></a></li>
		<{/if}>
		<{if $asnRow.receiving_status gt 1}>
		<li><a href="javascript:void(0);" id='tab_merge' class='tab'><span>归并项</span></a></li>
		<li><a href="javascript:void(0);" id='tab_asnlog' class='tab'><span><{t}>Log<{/t}></span></a></li>
		<{/if}>
    </ul>
</div>

<div class='tabContent' id='detail'>
<{include file="merchant/views/receiving/beihuo-detail.tpl"}>
</div>

<div class='tabContent' id='asnlog'>
    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <thead>
        <tr>
            <th><{t}>ReceiveCode<{/t}></th>
            <th><{t}>editContent<{/t}></th>
            <th><{t}>Operator<{/t}></th>
          
            <th><{t}>OriginalState<{/t}></th>
            <th><{t}>afterModifyStatus<{/t}></th>
            <th><{t}>occurTime<{/t}></th>
            <th><{t}>AccessIP<{/t}></th>
			<th>备注</th>
        </tr>
        </thead>
        <tbody id='loadData'>
        <{foreach from=$logs item=row}>
        <tr>
            <td><{$row.receiving_code}></td>
            <td><{if $row.rl_status_from neq $row.rl_status_to}><{t}>StateModification<{/t}><{else}><{t}>ContentModification<{/t}><{/if}></td>
            <td><{if $row.user_id > 0 }><{t}>system<{/t}><{else}><{$row.account_name}><{/if}></td>
            <td><{$asnStatus[$row.rl_status_from]}></td>
            <td><{$asnStatus[$row.rl_status_to]}></td>
            <td><{$row.rl_add_time}></td>
            <td><{$row.rl_ip}></td>
			<td><{$row.rl_note}></td>
        </tr>
        <{/foreach}>
        </tbody>
    </table>
</div>

<div class='tabContent' id='merge'>
    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <thead>
        <tr>
            <th>项号</th>
			<th>海关品名</th>
            <th>商品编码</th>
			<th>申报数量</th>
            <th>法定数量</th>
            <th>第二数量</th>
            <th>币值</th>
            <th>原产国</th>
        </tr>
        </thead>
        <tbody id='loadData'>
        <{foreach from=$merge item=row}>
        <tr>
            <td><{$row.merge_g_no}></td>
			<td><{$row.hs_name}></td>
            <td><{$row.code_ts}></td>
            <td><{$row.g_qty}></td>
			<td><{$row.qty_1}><{$productUom[$row.unit_1]['name']}></td>
			<td><{if $row.qty_2 gt 0}><{$row.qty_2}><{$productUom[$row.unit_2]['name']}><{/if}></td>
			<td><{$row.curr}></td>
            <td><{$countryCache[$row.origin_country]['country_name']}></td>
        </tr>
        <{/foreach}>
        </tbody>
    </table>
</div>

<div class='tabContent' id='container'>
    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <thead>
        <tr>
            <th>入库单号</th>
            <th>集装箱号</th>
			<th>规格</th>
            <th>自重</th>
        </tr>
        </thead>
        <tbody id='loadData'>
        <{foreach from=$container item=row}>
        <tr>
            <td><{$row.receiving_code}></td>
            <td><{$row.rc_no}></td>
            <td><{$row.rc_model}></td>
			<td><{$row.rc_weight}></td>
        </tr>
        <{/foreach}>
        </tbody>
    </table>
</div>


<div class='clear'></div>
</div>
</div>

<script>
$(function(){
    
    $("#detail").alterBgColor();
	$("#asnlog").alterBgColor();
    $("#detailbatch").alterBgColor();
    $("#asnTracking").alterBgColor();
});
</script>