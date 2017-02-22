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
    <div style="width: 680px; text-align: center; margin: 0 auto;">
        <table width="680" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td align="left">
                   <img src="/logistic/loading-order/barcode?drawText=&code=<{$shipBatch.sb_code}>" />
                </td>
            </tr> 
            <tr>
                <td>
                    <table width="680" border="0" cellpadding="0" cellspacing="0" align="center" class="main-table">
                        <tr height="50">
                            <td colspan="4" style="font-size: 20px; text-align: center; font-weight: 700">出区核放单(载货清单)</td>
                        </tr>
                        <tr>
                            <td width="240" align="right">报关申请单编号：</td>
                            <td width="300" align="left"><{$shipBatch.ref_loader_no}></td>
                            <td width="330" align="right">核放单(载货清单)编号：</td>
                            <td width="" align="left"><{$shipBatch.sb_code}></td>
                        </tr>
                        <tr>
                            <td align="right">仓储企业名称：</td>
                            <td align="left"><{$shipBatch.wh_name}></td>
                            <td align="right">仓储企业编码：</td>
                            <td align="left"><{$shipBatch.wh_code}></td>
                        </tr><tr>
                            <td align="right">车牌号：</td>
                            <td align="left"><{$shipBatch.car_no}></td>
                            <td align="right">集装箱号：</td>
                            <td align="left"></td>
                        </tr><tr>
                            <td align="right">件数：</td>
                            <td align="left"><{$shipBatch.pack_no}></td>
                            <td align="right">包装种类：</td>
                            <td align="left">纸箱</td>
                        </tr><tr>
                            <td align="right">毛重：</td>
                            <td align="left"><{$shipBatch.total_wt}></td>
                            <td align="right">净重：</td>
                            <td align="left"><{$shipBatch.total_wt}></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <{if !empty($shipBatchProduct) }>
            <tr>
                <td style="padding-top: 20px;">
                    <table width="680" border="0" cellpadding="0" cellspacing="0" align="center" class="formtable tableborder">
                        <tr>
                            <th width="40">项号</th>
                            <th width="100">商品编码</th>
                            <th width="140">商品名称</th>
                            <th width="80">商品规格</th>
                            <th width="40">数量</th>
                            <th width="60">记账单位</th>
                        </tr>
                        <{foreach from=$shipBatchProduct item=product name=product key=key}>
                        <tr>
                            <td><{$product.merge_no}></td>
                            <td><{$product.code_ts}></td>
                            <td><{$product.g_name_cn}></td>
                            <td><{$product.g_model}></td>
                            <td><{$product.g_qty}></td>
                            <td><{$product.g_unit}></td>
                        </tr>
                        <{/foreach}>
                    </table>
                </td>
            </tr>
            <{/if}>
        </table>
    </div>
</body>
</html>