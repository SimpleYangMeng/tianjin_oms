<?php /* Smarty version Smarty-3.1.13, created on 2016-03-15 15:17:35
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\merchant\views\product\print.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2522756e7b70f544a31-57172676%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '097caa9eae7c08206cc16062d57250778e287bcc' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\merchant\\views\\product\\print.tpl',
      1 => 1455677482,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2522756e7b70f544a31-57172676',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'productData' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56e7b70f5fcc47_75674433',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56e7b70f5fcc47_75674433')) {function content_56e7b70f5fcc47_75674433($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>跨境电子商务经营主体和商品备案管理工作规范</title>
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <!-- 可选的Bootstrap主题文件（一般不用引入） -->
    <link rel="stylesheet" href="/bootstrap/css/bootstrap-theme.min.css">
    <!-- luffy主文件 -->
    <link rel="stylesheet" href="/bootstrap/css/bootstrap-luffy.css">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="/bootstrap/js/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <style type="text/css">
        p{ margin: 0 0 6px;}
    </style>
</head>
<body>
<div class="container">
<div class="row">
    <div class="bs-example-luffy bs-example1-luffy">
        <h1 class="text-center">跨境电子商务商品备案信息</h1>
        <table class="table-bordered table">
            <colgroup>
                <col class="col-xs-3">
                <col class="col-xs-3">
                <col class="col-xs-3">
                <col class="col-xs-3">
            </colgroup>
            <tr>
                <th colspan="5">第1项  经营主体信息</th>
            </tr>
            <tr>
                <td>企业备案号</td>
                <td colspan="4"><?php echo $_smarty_tpl->tpl_vars['productData']->value['customer_code'];?>
</td>
            </tr>
            <tr>
                <th colspan="5">第2项  基本信息</th>
            </tr>
            <tr>
                <td colspan="5">
                    <p>HS编码：<?php echo $_smarty_tpl->tpl_vars['productData']->value['hs_code'];?>
</p>
                    <p>产品名称：<?php echo $_smarty_tpl->tpl_vars['productData']->value['product_title'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['productData']->value['product_title_en'];?>
</p>
                    <p>生产国家/地区：<?php echo $_smarty_tpl->tpl_vars['productData']->value['country_code_of_origin'];?>
</p>
                </td>                
            </tr>
            <tr>
                <th colspan="5">第3项   其他属性信息</th>
            </tr>
            <tr>
                <td colspan="5">
                    <p>品牌：<?php echo $_smarty_tpl->tpl_vars['productData']->value['brand'];?>
 </p>
                    <p>规格型号：<?php echo $_smarty_tpl->tpl_vars['productData']->value['product_model'];?>
</p>
                    <p>供应商：<?php echo $_smarty_tpl->tpl_vars['productData']->value['enterprises_name'];?>
</p>
                    <p>产品大类：<?php echo $_smarty_tpl->tpl_vars['productData']->value['goods_categories'];?>
</p>
                    <p>进出口标志：<?php echo $_smarty_tpl->tpl_vars['productData']->value['ie_type'];?>
</p>
                    <p>商品货号：<?php echo $_smarty_tpl->tpl_vars['productData']->value['product_sku'];?>
</p>
                    <p>生产企业：<?php echo $_smarty_tpl->tpl_vars['productData']->value['enterprises_name'];?>
</p>
                    <p>主要成分：<?php echo $_smarty_tpl->tpl_vars['productData']->value['element'];?>
</p>
                    <p>用途：<?php echo $_smarty_tpl->tpl_vars['productData']->value['use_way'];?>
</p>
                    <p>包装单位：<?php echo $_smarty_tpl->tpl_vars['productData']->value['g_unit'];?>
</p>
                    <p>最小包装单位：<?php echo $_smarty_tpl->tpl_vars['productData']->value['pu_code'];?>
</p>
                    <p>属地检验检疫机构：<?php echo $_smarty_tpl->tpl_vars['productData']->value['ins_unit_code'];?>
</p>
                    <p>其他：<?php echo $_smarty_tpl->tpl_vars['productData']->value['product_description'];?>
</p>
                </td>                
            </tr>
            <tr>
                <th colspan="5">第4项   资质证明信息</th>
            </tr>
            <tr>
                <td colspan="5">
                    <p>商品或生产企业取得的认证、注册、备案等资质：</p>
                    <p>商品取得的自由销售证明、第三方检验鉴定证书：</p>
                    <p>产品说明的中文对照资料：</p>
                    <p>消费警示：</p>
                    <p>其他可提供的证明材料：</p>
                </td>
            </tr>
            <tr>
                <th colspan="5">第5项   是否符合我国法律法规和标准要求的申明</th>
            </tr>
            <tr>
                <td colspan="5">
                    <p><?php if (isset($_smarty_tpl->tpl_vars['productData']->value['is_law_regulation'])&&($_smarty_tpl->tpl_vars['productData']->value['is_law_regulation']==1)){?>是<?php }else{ ?>否<?php }?></p>
                </td>
            </tr>
        </table>
    </div>    
</div>

</div>
</body>
</html><?php }} ?>