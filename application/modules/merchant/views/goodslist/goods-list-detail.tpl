<div class="content-box  ui-tabs  ui-corner-all" >
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;">个人物品清单</h3>
    </div>
<div style="margin-right: 0px; padding: 6px;" class="content-box nbox_c marB10 product_detail cl">
    <table cellspacing="0" cellpadding="0" class="formtable tableborder" width='100%'>       
        <tr>
            <th width="16%">物品清单号:</th>
            <td width="16%"><{$personItemRow.pim_code}></td>
            <th width="16%">清单内部编号:</th>
            <td width="16%"><{$personItemRow.pim_reference_no}></td>
            <th width="16%">业务类型:</th>
            <td>进口出区</td>
        </tr>

        <tr>
            <th>电商企业</th>
            <td><{$personItemRow.customer_code}></td>
            <th>物流企业</th>
            <td><{$personItemRow.logistic_customer_code}></td>
            <th>支付企业</th>
            <td><{$personItemRow.pay_customer_code}></td>
        </tr>

        <tr>            
            <th>仓储企业</th>
            <td><{$personItemRow.storage_customer_code}></td>
            <th>运单编号</th>
            <td><{$personItemRow.wb_code}></td>
            <th>物流编号</th>
            <td><{$personItemRow.log_no}></td>
        </tr>

        <tr>            
            <th>支付编号</th>
            <td><{$personItemRow.po_code}></td>
            <th>申报单位</th>
            <td><{$personItemRow.agent_name}></td>
            <th>订单序列</th>
            <td><{$personItemRow.order_code}></td>
        </tr>

        <tr>
            <th>状态</th>
            <td><{$statusRows[$personItemRow.status]}></td>
            <th>进出境日期</th>
            <td><{$personItemRow.i_e_date}></td>
            <th>申报日期</th>
            <td><{$personItemRow.declare_time}></td>
        </tr>

        <tr>
            <th>进出口口岸</th>
            <td><{$personItemRow.ie_port}></td>
            <th>申报口岸</th>
            <td><{$personItemRow.declare_ie_port}></td>
            <th>出入港区运输方式</th>
            <td><{if isset($personItemRow.traf_mode.traf_mode_name)}><{/if}></td>
        </tr>

        <tr>
            <th>外包装类型</th>
            <td></td>
            <th>发件人</th>
            <td colspan="3"><{$personItemRow.ship_name}></td>            
        </tr>

        <tr>
            <th>发件人海关国家</th>
            <td><{$personItemRow.ship_trade_country}></td>
            <th>抵运国家</th>
            <td><{$personItemRow.aim_country}></td>
            <th>发件人城市</th>
            <td><{$personItemRow.ship_city}></td>
        </tr>       

        <tr>
            <th>收件人姓名</th>
            <td><{$personItemRow.receive_name}></td>
            <th>州/区域</th>
            <td><{$personItemRow.receive_state}></td>
            <th>收件人国家</th>
            <td><{$personItemRow.receive_country}></td>
        </tr>

        <tr>
            <th>收件人地址</th>
            <td><{$personItemRow.receiving_address}></td>
            <th>收件人city</th>
            <td><{$personItemRow.receive_city}></td>
            <th>收件人身份证信息</th>
            <td><{$personItemRow.receive_id_number}></td>
        </tr>

        <tr>
            <th>收件人电话</th>
            <td><{$personItemRow.receive_telphone}></td>
            <th>录入单位</th>
            <td><{$personItemRow.input_company}></td>
            <th>报关员</th>
            <td><{$personItemRow.declare_no}></td>
        </tr>

        <tr>
            <th>单位地址</th>
            <td><{$personItemRow.agent_address}></td>
            <th>邮编</th>
            <td><{$personItemRow.agent_post}></td>
            <th>子账号电话</th>
            <td><{$personItemRow.agent_tel}></td>
        </tr>

        <tr>
            <th>运费</th>
            <td><{$personItemRow.freight}></td>
            <th>保费</th>
            <td><{$personItemRow.insure_fee}></td>
            <th>监管场所代码</th>
            <td><{$personItemRow.customs_field}></td>
        </tr>

        <tr>
            <th>净重</th>
            <td><{$personItemRow.net_wt}></td>
            <th>毛重</th>
            <td><{$personItemRow.gross_wt}></td>
            <th>录入员</th>
            <td><{$personItemRow.input_no}></td>
        </tr>

        <tr>
            <th>件数</th>
            <td><{$personItemRow.pack_no}></td>
            <th>录入时间</th>
            <td colspan="3"><{$personItemRow.input_date}></td>
        </tr>

        <tr>
            <th>添加时间</th>
            <td><{$personItemRow.pim_add_time}></td>
            <th>最后更新时间</th>
            <td colspan="3"><{$personItemRow.pim_update_time}></td>            
        </tr>

        <tr>
            <th>备注</th>
            <td colspan="5"><{$personItemRow.note}></td>            
        </tr>
    </table>
</div>

<div class="cl">
    <div class="tabs_header cl content-box-header" style="margin: 10px 0 4px;">
        <ul class="tabs cl" style="padding-top: 2px;">
            <li class='active'>  <a href="javascript:;" id='tab_productRows' class='tab'><span>清单产品</span></a></li>
            <li><a href="javascript:;" id='tab_log' class='tab'><span>清单日志</span></a></li> 
        </ul>
    </div>

    <div class='tabContent' id='productRows'>
        <table cellspacing="0" cellpadding="0" class="formtable tableborder">
            <thead>
            <tr>
                <th>企业商品货号</th>
                <th>海关商品备案编号</th>
                <th>对应底账料件号</th>
                <th>海关编码</th>
                <th>行邮税号</th>
                <th>商品名称</th>
                <th>规格型号</th>
                <th>数量</th>
                <th>单位</th>
                <th>单价</th>
                <th>总价</th>
                <th>币值</th>
                <th>原产国</th>
            </tr>
            </thead>
            <tbody>
            <{if $personItemProductRows}>
            <{foreach from=$personItemProductRows item=personItemProductRow name=personItemProductRow}>
                <tr>
                    <td class="text_center"><{$personItemProductRow.g_no}></td>
                    <td class="text_center"><{$personItemProductRow.registerID}></td>
                    <td class="text_center"><{$personItemProductRow.goods_id}></td>
                    <td class="text_center"><{$personItemProductRow.hs_code}></td>
                    <td class="text_center"><{$personItemProductRow.gt_code}></td>
                    <td class="text_center"><{$personItemProductRow.g_name_cn}></td>
                    <td class="text_center"><{$personItemProductRow.g_model}></td>
                    <td class="text_center"><{$personItemProductRow.g_qty}></td>
                    <td class="text_center"><{$personItemProductRow.g_uint}></td>
                    <td class="text_center"><{$personItemProductRow.price}></td>
                    <td class="text_center"><{$personItemProductRow.total_price}></td>
                    <td class="text_center"><{$personItemProductRow.curr}></td>
                    <td class="text_center"><{$personItemProductRow.country}></td>
                </tr>
            <{/foreach}>
            <{/if}>
            </tbody>

        </table>

    </div>

    <div class='tabContent' id='log'>
        <table cellspacing="0" cellpadding="0" class="formtable tableborder">
            <thead>
            <tr>
                <th align="center" width="100px"><{t}>operater<{/t}></th>
                <th align="center" width="150px"><{t}>addTime<{/t}></th>
                <th align="center" width="100px"><{t}>AccessIP<{/t}></th>
                <th align="center" ><{t}>remark<{/t}></th>
            </tr>
            </thead>
            <tbody>
            <{if $personItemLogRows}>
            <{foreach from=$personItemLogRows item=personItemLogRow name=personItemLogRow}>
            <{if $personItemLogRow.user_id == 0}>
                <td class="text_center">系统</td>
            <{else}>
                <td class="text_center"><{$personItemLogRow.account_name}></td>
            <{/if}>
                <td class="text_center"><{$personItemLogRow.pil_add_time}></td>
                <td class="text_center"><{$personItemLogRow.pil_ip}></td>
                <td class="text_center"><{$personItemLogRow.pil_comments}></td>
            <{/foreach}>
            <{/if}>
            </tbody>
        </table>

    </div>    
</div>


<script type="text/javascript">
$(function(){
    $(".tabContent").hide();
    $(".tab").click(function(){
        $(".tabContent").hide();
        $(this).parent().addClass("active");
        $(this).parent().siblings().removeClass("active");
        $("#"+$(this).attr("id").replace("tab_","")).show();
    });
    $(".tabContent").eq(0).show();
});
</script>