<div class="content-box  ui-tabs  ui-corner-all  ui-widget ui-widget-content">
    <div class="content-box-header">
        <h3 style="margin-left:5px">料件级库存</h3>
        <div class="clear"></div>
    </div>
    <div style="margin-right: 0px;" class="nbox_c marB10 cl">
        <table cellspacing="0" cellpadding="0" class="formtable tableborder">
            <tbody>
                <tr>
                    <th>料件号：</th>
                    <td><{$productInventoryRow.goods_id}></td>      
                    <th>入库总数量：</th>
                    <td><{$productInventoryRow.stock_in_all}></td>              
                </tr>
                <tr>
                    <th>入库待集报数量</th>
                    <td><{$productInventoryRow.stock_in_td}></td>
                    <th>出库出境总数量</th>
                    <td><{$productInventoryRow.stock_out_all}></td>
                </tr>
                <tr>
                    <th>可出库存</th>
                    <td><{$productInventoryRow.stock_qty}></td>
                    <th>待出库存</th>
                    <td><{$productInventoryRow.stock_frozen}></td>
                </tr>
                <tr>
                    <th>出库待集报数量</th>
                    <td><{$productInventoryRow.stock_out_td}></td>
                    <th>待减数量</th>
                    <td><{$productInventoryRow.amount_to_reduce}></td>
                </tr>
                <tr>
                    <th>海关商品备案号</th>
                    <td><{$productInventoryRow.cus_goods_id}></td>
                    <th>收（发）货单位</th>
                    <td><{$productInventoryRow.owner_code}></td>
                </tr>
                <tr>
                    <th>商品编码</th>
                    <td><{$productInventoryRow.code_ts}></td>                    
                    <th>原产国</th>
                    <td><{$productInventoryRow.origin_country}></td>
                </tr>
                <tr>
                    <th>规格型号</th>
                    <td><{$productInventoryRow.g_model}></td>
                    <th>申报单位</th>
                    <td><{$productInventoryRow.stock_unit}></td>
                </tr>
                <tr>
                    <th>币制</th>
                    <td><{$productInventoryRow.curr}></td>
                    <th>进出口类型</th>
                    <td><{$productInventoryRow.ie_type}></td>
                </tr>
                <tr>
                    <th>法定单位</th>
                    <td><{$productInventoryRow.unit_1}></td>
                    <th>法定数量</th>
                    <td><{$productInventoryRow.qty_1}></td>
                </tr>
                <tr>
                    <th>第二单位</th>
                    <td><{$productInventoryRow.unit_2}></td>
                    <th>第二数量</th>
                    <td><{$productInventoryRow.qty_2}></td>
                </tr>
                <tr>
                    <th>征免方式</th>
                    <td><{$productInventoryRow.duty_mode}></td>
                    <th>用途</th>
                    <td><{$productInventoryRow.use_to}></td>
                </tr>
                <tr>
                    <th>申报单价</th>
                    <td><{$productInventoryRow.decl_price}></td>
                    <th>英文名称</th>
                    <td><{$productInventoryRow.g_name_en}></td>
                </tr>
                <tr>
                    <th>中文名称</th>
                    <td colspan="3"><{$productInventoryRow.g_name_cn}></td>
                    
                </tr>
            </tbody>
        </table>
    </div>
</div>