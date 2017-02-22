<style type="text/css">
.tabContent { width: 100%; }
.imgWrap {width: 76px; height: 76px; margin: 0px; border: 0 none; }
.tableborder th {text-align: right;}
table.sTable { width: 100%;}
table.sTable th { text-align: center;}
table td.center {text-align: center;}
</style>
<div class="content-box  ui-tabs  ui-corner-all ui-widget ui-widget-content">
    <div>
        <div class="content-box-header">
            <h3  class="clearborder" style="margin-left:5px;">运单详情</h3>
        </div>
    </div>
    <div style="margin-right: 0px;" class="nbox_c marB10 cl">
    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <tr>
            <th width="160">运单编号：</th>
            <td width="400" colspan="3"><span class="blue"><{$wbData.wb_code}></span></td>
        </tr>
        <tr>
            <th width="160">电商企业代码：</th>
            <td width="400"><span class="blue"><{$wbData.customer_code}></span></td>
            <th width="160">物流企业代码：</th>
            <td><span class="blue"><{$wbData.logistic_customer_code}></span></td>
        </tr>
        <tr>
            <th>交易订单号：</th>
            <td><span class="blue"><{$wbData.reference_no}></span></td>
            <th>运单号：</th>
            <td><span class="blue"><{$wbData.log_no}></span></td>
        </tr>
        <tr>
            <th>运输方式：</th>
            <td><span class="blue"><{$wbData.traf_mode_name}></span></td>
            <th>运输工具：</th>
            <td><span class="blue"><{$wbData.ship_name}></span></td>
        </tr>
        <tr>
            <th>航班航次号：</th>
            <td><span class="blue"><{$wbData.voyage_no}></span></td>
            <th>提运单号：</th>
            <td><span class="blue"><{$wbData.bill_no}></span></td>
        </tr>
        <tr>
            <th>发货人：</th>
            <td><span class="blue"><{$wbData.shipper}></span></td>
            <th>发货人电话：</th>
            <td><span class="blue"><{$wbData.shipper_telephone}></span></td>
        </tr>
        <tr>
            <th>发货人所在国：</th>
            <td><span class="blue"><{$wbData.shipper_country}></span></td>
            <th>发货人地址：</th>
            <td><span class="blue"><{$wbData.shipper_address}></span></td>
        </tr>
        <tr>
            <th>收货人：</th>
            <td><span class="blue"><{$wbData.consignee}></span></td>
            <th>收货人所在国：</th>
            <td><span class="blue"><{$wbData.consignee_country}></span></td>
        </tr>
        <tr>
            <th>收货人地址（省）：</th>
            <td><span class="blue"><{$wbData.consignee_province}></span></td>
            <th>收货人地址（市）：</th>
            <td><span class="blue"><{$wbData.consignee_city}></span></td>
        </tr>
        <tr>
            <th>收货人地址（区）：</th>
            <td><span class="blue"><{$wbData.consignee_district}></span></td>
            <th>收货人地址：</th>
            <td><span class="blue"><{$wbData.consignee_address}></span></td>
        </tr>
        <tr>
            <th>收货人电话：</th>
            <td><span class="blue"><{$wbData.consignee_telephone}></span></td>
            <th>海关状态：</th>
            <td><span class="blue"><{$wbData.app_status}></span></td>
        </tr>
        <tr>
            <th>申报类型：</th>
            <td><span class="blue"><{$wbData.app_type}></span></td>
            <th>主管海关代码：</th>
            <td><span class="blue"><{$wbData.customs_code}></span></td>
        </tr>
        <tr>
            <th>运费：</th>
            <td><span class="blue"><{$wbData.freight}></span></td>
            <th>订单商品货款：</th>
            <td><span class="blue"><{$wbData.goods_value}></span></td>
        </tr>
        <tr>
            <th>保价费：</th>
            <td><span class="blue"><{$wbData.insure_fee}></span></td>
            <th>币制：</th>
            <td><span class="blue"><{$wbData.currency_code}></span></td>
        </tr>
        <tr>
            <th>毛重：</th>
            <td><span class="blue"><{$wbData.weight}></span></td>
            <th>净重：</th>
            <td><span class="blue"><{$wbData.net_weight}></span></td>
        </tr>
        <tr>
            <th>件数：</th>
            <!-- <td><span class="blue"><{$wbData.pack_no}></span> 件(piece)</td> -->
            <td><span class="blue"><{$wbData.pack_no}></span></td>
            <th>包裹单信息：</th>
            <td><span class="blue"><{$wbData.parcel_info}></span></td>
        </tr>
        <tr>
            <th>商品信息：</th>
            <td><span class="blue"><{$wbData.goods_info}></span></td>
            <th>检验检疫状态：</th>
            <td><span class="blue"><{$wbData.ciq_status}></span></td>
        </tr>
        <tr>
            <th>备注：</th>
            <td colspan="3"><span class="blue"><{$wbData.note}></span></td>
        </tr>
        <{if $wbData.ciq_reject_reason neq ''}>
        <tr>
            <th>商检错误回执</th>
            <td colspan="3"><{$wbData.ciq_reject_reason}></td>
        </tr>
        <{/if}>
    </table>
    </div>

    <!-- log begin-->
    <div class="cl">
        <div class="tabs_header cl content-box-header" style="margin: 10px 0 4px;">
            <ul class="tabs cl" style="padding-top: 2px;">
                <li class='active'><a href="javascript:;" id='tab_log' class='tab'><span>运单日志</span></a></li> 
            </ul>
        </div>
        <div class='tabContent'>
            <table width="100%" cellspacing="0" cellpadding="0" class="formtable tableborder sTable">
                <thead>
                <tr>
                    <th>变化前状态</th>
                    <th>变化后状态</th>
                    <th>检疫类型</th>
                    <th>操作时间</th>
                    <th>操作IP</th>
                    <th>操作人</th>
                    <th>备注</th>
                </tr>
                </thead>
                    <tbody>
                        <{if !empty($wbLogData)}>
                            <{foreach from=$wbLogData item=wbLog name=wbLog}>
                                <tr>
                                    <{if $wbLog.status_type eq '1'}>
                                    <td class="text_center"><{$wbLog.wb_status_from}></td>
                                    <td class="text_center"><{$wbLog.wb_status_to}></td>
                                    <{else}>
                                    <td class="text_center"><{$wbLog.wb_ciq_status_from}></td>
                                    <td class="text_center"><{$wbLog.wb_ciq_status_to}></td>
                                    <{/if}>
                                    <td class="text_center"><{if $wbLog.status_type eq '1'}>海关<{else}>检验检疫<{/if}></td>
                                    <td class="text_center"><{$wbLog.wb_add_time}></td>
                                    <td class="text_center"><{$wbLog.wb_ip}></td>
                                    <td class="text_center"><{$wbLog.account_name}></td>
                                    <td class="text_center"><{$wbLog.wb_comments}></td>
                                </tr>
                            <{/foreach}>
						<{else}>
							<tr><td colspan="6">暂无日志</td></tr>                          
                        <{/if}>
                    </tbody>
            </table>
        </div>
    </div>
    <!-- log end-->
</div>