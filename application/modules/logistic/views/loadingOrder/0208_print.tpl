<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>天津跨境贸易电子商务综合服务平台-载货单打印</title>
    <style type="text/css">
        table {border:none;}
        tr { line-height: 28px; }
        .formtable{background-color: #ffffff;border: 1px solid #ccc;float: left;width: 100%;}
        .tableborder{border-bottom: 1px solid #000000;border-collapse: collapse;border-top: 1px solid #000000;}
        .formtable th{color: #000000;font-weight: bold;text-align: center;}
        .formtable td{line-height: 1.5em; padding: 5px; text-align: left;vertical-align: top; color: #000000;text-align: center;}
        .tableborder td, .tableborder th{border: 1px solid #000000;height: 20px;line-height: 20px;}
        .main-table { text-align: left; }
        .tableborder th{height: 30px;}
    </style>
</head>
<body>
    <div style="width: 900px; text-align: center; margin: 0 auto;">
        <table width="900" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td align="center">
                    <img src="/logistic/loading-order/barcode?drawText=&code=<{$shipBatch.sb_code}>" />
                </td>
            </tr> 
            <tr>
                <td>
                    <table width="900" border="0" cellpadding="0" cellspacing="0" align="center" class="main-table">
                        <tr height="50">
                            <td colspan="4" style="font-size: 20px; text-align: center; font-weight: 700">跨境电商出区后报关核放单(载货清单)</td>
                        </tr>
                        <tr>
                            <td width="220" align="right">仓储企业名称：</td>
                            <td width="260" align="left"><{$shipBatch.wh_name}></td>
                            <td width="220" align="right">仓储企业编码：</td>
                            <td width="" align="left"><{$shipBatch.wh_code}></td>
                        </tr>
                        <tr>
                            <td align="right">经营企业名称：</td>
                            <td align="left"><{$shipBatch.trade_name}></td>
                            <td align="right">经营企业编码：</td>
                            <td align="left"><{$shipBatch.trade_code}></td>
                        </tr>
                        <tr>
                            <td align="right">核放单(载货清单)编号：</td>
                            <td align="left"><{$shipBatch.sb_code}></td>
                            <td align="right">报关申请编号：</td>
                            <td align="left"><{$shipBatch.refercence_form_id}></td>
                        </tr>
                        <tr>
                            <td align="right">报关单编号：</td>
                            <td align="left"><{$shipBatch.ref_loader_no}></td>
                            <td align="right">车牌号：</td>
                            <td align="left"><{$shipBatch.car_no}></td>
                        </tr>
                        <tr>
                            <td align="right">件数：</td>
                            <td align="left"><{$shipBatch.pack_no}></td>
                            <td align="right">包装种类：</td>
                            <td align="left">纸箱</td>
                        </tr>
                        <tr>
                            <td align="right">毛重（千克）：</td>
                            <td align="left"><{$shipBatch.total_wt}></td>
                            <td align="right">净重（千克）：</td>
                            <td align="left"><{$shipBatch.total_wt}></td>
                        </tr>
                        <tr>
                            <td align="right"><strong>所属区域：</strong></td>
                            <td align="left" colspan="3"><strong>天津保税区</strong></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <{if !empty($shipBatchProduct) }>
            <tr>
                <td style="padding-top: 20px;">
                    <table width="900" border="0" cellpadding="0" cellspacing="0" align="center" class="formtable tableborder">
                        <tr>
                            <th width="60">序号</th>
                            <th width="100">商品编码</th>
                            <th width="140">商品名称</th>
                            <th width="80">商品规格</th>
                            <th width="80">载货数量</th>
                            <th width="80">申报单位</th>
                            <th width="100">第一法定数量</th>
                            <th width="100">第一法定单位</th>
                        </tr>
                        <{foreach from=$shipBatchProduct item=product name=product key=key}>
                        <tr>
                            <td><{$key + 1}></td>
                            <td><{$product.code_ts}></td>
                            <td><{$product.g_name_cn}></td>
                            <td><{$product.g_model}></td>
                            <td><{$product.g_qty}></td>
                            <td><{$product.g_unit}></td>
                            <td><{$product.qty_1}></td>
                            <td><{$product.unit_1}></td>
                        </tr>
                        <{/foreach}>
                    </table>
                </td>
            </tr>
            <{/if}>
            <tr>
                <td style="padding-top: 20px;">
                    <table width="900" border="0" cellpadding="0" cellspacing="0" align="center" class="formtable tableborder">
                        <tr>
                            <th width="300">集装箱号</th>
                            <th width="300">铅封号</th>
                            <th>尺寸</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>