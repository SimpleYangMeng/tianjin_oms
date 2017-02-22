<?php /* Smarty version Smarty-3.1.13, created on 2016-03-03 10:14:27
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\logistic\views\loadingOrder\print.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2509156d6cfcea323a0-63626071%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ec29d03c1998ad02191ed6c8517099a848518348' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\logistic\\views\\loadingOrder\\print.tpl',
      1 => 1456971265,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2509156d6cfcea323a0-63626071',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56d6cfceaaea91_74263258',
  'variables' => 
  array (
    'shipBatch' => 0,
    'shipBatchProduct' => 0,
    'key' => 0,
    'product' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56d6cfceaaea91_74263258')) {function content_56d6cfceaaea91_74263258($_smarty_tpl) {?><!DOCTYPE html>
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
                    <img src="/logistic/loading-order/barcode?drawText=&code=<?php echo $_smarty_tpl->tpl_vars['shipBatch']->value['sb_code'];?>
" />
                </td>
            </tr> 
            <tr>
                <td>
                    <table width="680" border="0" cellpadding="0" cellspacing="0" align="center" class="main-table">
                        <tr height="50">
                            <td colspan="4" style="font-size: 20px; text-align: center; font-weight: 700">入区核放单(载货清单)</td>
                        </tr>
                        <tr>
                            <td width="240" align="right">报关申请单编号：</td>
                            <td width="300" align="left"><?php echo $_smarty_tpl->tpl_vars['shipBatch']->value['ref_loader_no'];?>
</td>
                            <td width="330" align="right">核放单(载货清单)编号：</td>
                            <td width="" align="left"><?php echo $_smarty_tpl->tpl_vars['shipBatch']->value['sb_code'];?>
</td>
                        </tr>
                        <tr>
                            <td align="right">仓储企业名称：</td>
                            <td align="left"><?php echo $_smarty_tpl->tpl_vars['shipBatch']->value['wh_name'];?>
</td>
                            <td align="right">仓储企业编码：</td>
                            <td align="left"><?php echo $_smarty_tpl->tpl_vars['shipBatch']->value['wh_code'];?>
</td>
                        </tr><tr>
                            <td align="right">车牌号：</td>
                            <td align="left"><?php echo $_smarty_tpl->tpl_vars['shipBatch']->value['car_no'];?>
</td>
                            <td align="right">集装箱号：</td>
                            <td align="left"></td>
                        </tr><tr>
                            <td align="right">件数：</td>
                            <td align="left"><?php echo $_smarty_tpl->tpl_vars['shipBatch']->value['pack_no'];?>
</td>
                            <td align="right">包装种类：</td>
                            <td align="left"></td>
                        </tr><tr>
                            <td align="right">毛重：</td>
                            <td align="left"><?php echo $_smarty_tpl->tpl_vars['shipBatch']->value['total_wt'];?>
</td>
                            <td align="right">净重：</td>
                            <td align="left"><?php echo $_smarty_tpl->tpl_vars['shipBatch']->value['total_wt'];?>
</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <?php if (!empty($_smarty_tpl->tpl_vars['shipBatchProduct']->value)){?>
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
                        <?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['shipBatchProduct']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
$_smarty_tpl->tpl_vars['product']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['product']->key;
?>
                        <tr>
                            <td><?php echo $_smarty_tpl->tpl_vars['key']->value+1;?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['product']->value['code_ts'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['product']->value['g_name_cn'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['product']->value['g_model'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['product']->value['g_qty'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['product']->value['g_unit'];?>
</td>
                        </tr>
                        <?php } ?>
                    </table>
                </td>
            </tr>
            <?php }?>
        </table>
    </div>
</body>
</html><?php }} ?>