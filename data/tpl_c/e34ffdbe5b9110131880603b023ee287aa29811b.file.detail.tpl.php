<?php /* Smarty version Smarty-3.1.13, created on 2016-12-19 09:43:18
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\merchant\views\product\detail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1388158573b36d7de67-28666187%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e34ffdbe5b9110131880603b023ee287aa29811b' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\merchant\\views\\product\\detail.tpl',
      1 => 1463103215,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1388158573b36d7de67-28666187',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'productRow' => 0,
    'ieType' => 0,
    'iePortInfo' => 0,
    'currency' => 0,
    'productStatus' => 0,
    'customsStatus' => 0,
    'ciqStatus' => 0,
    'productLog' => 0,
    'row' => 0,
    'orderProduct' => 0,
    'productImage' => 0,
    'attachedType' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_58573b3711a537_25354803',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58573b3711a537_25354803')) {function content_58573b3711a537_25354803($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\block.t.php';
?><style>
    <!--
    .tabContent {
        display: none;
    }

    .imgWrap {
        width: 100px;
        height: 76px;
        margin: 0px;
        border: 0 none;
    }
.images-box { min-height: 90px; border: 1px #aaaaaa dashed; box-sizing: border-box; /*overflow: scroll;*/}
.images-box > div { display: inline-block; box-orient: horizontal; box-pack: center; box-align: center; position: relative; }
.images-box > div > .img {margin: 5px; max-width: 80px; max-height: 80px; -moz-border-bottom-colors: none; -moz-border-left-colors: none; -moz-border-right-colors: none; -moz-border-top-colors: none; background-color: #fff; border-bottom-color: #3c763d; border-bottom-left-radius: 4px; border-bottom-right-radius: 4px; border-bottom-style: solid; border-bottom-width: 1px; border-image-outset: 0 0 0 0; border-image-repeat: stretch stretch; border-image-slice: 100% 100% 100% 100%; border-image-source: none; border-image-width: 1 1 1 1; border-left-color: #3c763d; border-left-style: solid; border-left-width: 1px; border-right-color: #3c763d; border-right-style: solid; border-right-width: 1px; border-top-color: #3c763d; border-top-left-radius: 4px; border-top-right-radius: 4px; border-top-style: solid; border-top-width: 1px; display: inline-block; line-height: 1.42857; max-width: 100%; padding-bottom: 4px; padding-left: 4px; padding-right: 4px; padding-top: 4px; transition-delay: 0s; transition-duration: 0.2s; transition-property: all; transition-timing-function: ease-in-out; float: left;}
.images-box > div > span.img { width: 80px; height: 80px; background-color: #3c763d; font-size: 24px; font-weight: bold; text-align: center; line-height: 80px;}
.images-box > div > .img:hover{opacity:0.2;}
.images-box > div > .opacity  {opacity:0.2;}
.images-box > div > div { position: absolute; width: 100%; box-pack: center; box-align: center; left: 0; top: 0; text-align: center; font-weight: bold; }
.images-box > div > a{ background-image: url(/images/icons/icon_missing.png); height: 17px; width: 17px; display: block; position: absolute; z-index: 99; right: 4px; top: 4px;}

    -->
</style>


<link rel="stylesheet" type="text/css" href="/js/fancybox/jquery.fancybox.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/js/fancybox/jquery.fancybox-thumbs.css" />

<script type="text/javascript" src="/js/fancybox/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="/js/fancybox/jquery.fancybox-thumbs.js"></script>

<div class="content-box  ui-tabs  ui-corner-all" >
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>        
    </div>
<div style="margin-right: 0px; padding: 6px;" class="content-box nbox_c marB10 product_detail cl">
    <table cellspacing="0" cellpadding="0" class="formtable tableborder" width='100%'>
        <tbody>
        <tr>
            <th>进出口类型：</th>
            <td><?php echo $_smarty_tpl->tpl_vars['ieType']->value[$_smarty_tpl->tpl_vars['productRow']->value['ie_type']];?>
&nbsp;&nbsp;【 <?php echo $_smarty_tpl->tpl_vars['productRow']->value['ie_type'];?>
 】</td>
            <th>主管海关代码：</th>
            <td><?php echo $_smarty_tpl->tpl_vars['iePortInfo']->value['ie_port_name'];?>
&nbsp;&nbsp;【 <?php echo $_smarty_tpl->tpl_vars['productRow']->value['customs_code'];?>
 】</td>
        </tr>
        <tr>
            <th>属地检验检疫机构</th>
            <td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['ins_unit_name'];?>
</td>
            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pname<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</th>
            <td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['product_title'];?>
</td>
        </tr>
        <tr>
            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
productBarcode1<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</th>
            <td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['product_barcode'];?>
</td>
            <th>电商企业代码：</th>
            <td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['customer_code'];?>
</td>
        </tr>
        <tr>
            <th>电商企业名称：</th>
            <td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['enp_name'];?>
</td>
            <th>申报单位企业代码：</th>
            <td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['storage_customer_code'];?>
</td>
        </tr>
        <tr>
            <th>申报单位企业名称：</th>
            <td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['storage_enp_name'];?>
</td>        
            <th>申报单位操作人代码：</th>
            <td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['storage_account_code'];?>
</td>
        </tr>
        <tr>
            <th>品牌:</th>
            <td ><?php echo $_smarty_tpl->tpl_vars['productRow']->value['brand'];?>
</td>        
            <th>商品货号：</th>
            <td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['product_sku'];?>
</td>
        </tr>
         <tr>
            <th>申报单位：</th>
            <td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['product_uom'];?>
&nbsp;&nbsp;【<?php echo $_smarty_tpl->tpl_vars['productRow']->value['pu_code'];?>
】</td>
            <th>法定单位：</th>
            <td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['first_uom'];?>
&nbsp;&nbsp;【<?php echo $_smarty_tpl->tpl_vars['productRow']->value['g_unit'];?>
】</td>
        </tr>
        <tr>
            <th>第二单位:</th>
            <td ><?php echo $_smarty_tpl->tpl_vars['productRow']->value['second_uom'];?>
&nbsp;&nbsp;【<?php echo $_smarty_tpl->tpl_vars['productRow']->value['second_unit'];?>
】</td>
            <th>毛重(KG)：</th>
            <td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['product_weight'];?>
</td>
        </tr>
        <tr>
            <th>净重(KG)：</th>
            <td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['product_net_weight'];?>
</td>
            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
申报币制<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</th>
            <td><?php echo $_smarty_tpl->tpl_vars['currency']->value[$_smarty_tpl->tpl_vars['productRow']->value['currency_code']];?>
&nbsp;&nbsp;【<?php echo $_smarty_tpl->tpl_vars['productRow']->value['currency_code'];?>
】</td> 
        </tr>
        <tr>
            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
declaredValue<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</th>
            <td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['product_declared_value'];?>
</td>
            <th>规格型号:</th>
            <td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['product_model'];?>
</td>
        </tr>
        <tr>
            <th>海关商品编码：</th>
            <td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['hs_code'];?>
</td>
            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
productStatus<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</th>
            <td>
                <?php if (isset($_smarty_tpl->tpl_vars['productStatus']->value[$_smarty_tpl->tpl_vars['productRow']->value['product_status']])){?>
                    <?php echo $_smarty_tpl->tpl_vars['productStatus']->value[$_smarty_tpl->tpl_vars['productRow']->value['product_status']];?>

                <?php }else{ ?>
                    <?php echo $_smarty_tpl->tpl_vars['productRow']->value['product_status'];?>

                <?php }?>
            </td>
        </tr>
        <tr>
            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
country_code_of_origin<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</th>
            <?php if (isset($_smarty_tpl->tpl_vars['productRow']->value['country_code_of_origin_name'])){?>
            <td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['country_code_of_origin'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['productRow']->value['country_code_of_origin_name'];?>
</td>
            <?php }else{ ?>
            <td></td>
            <?php }?>        
            <th>海关状态：</th>
            <td>
                <?php if (isset($_smarty_tpl->tpl_vars['customsStatus']->value[$_smarty_tpl->tpl_vars['productRow']->value['customs_status']])){?>
                    <?php echo $_smarty_tpl->tpl_vars['customsStatus']->value[$_smarty_tpl->tpl_vars['productRow']->value['customs_status']];?>

                <?php }else{ ?>
                    <?php echo $_smarty_tpl->tpl_vars['productRow']->value['customs_status'];?>

                <?php }?>
            </td>
        </tr>
        <tr>
            <th>检验检疫状态：</th>
            <td>
                <?php if (isset($_smarty_tpl->tpl_vars['ciqStatus']->value[$_smarty_tpl->tpl_vars['productRow']->value['ciq_status']])){?>
                    <?php echo $_smarty_tpl->tpl_vars['ciqStatus']->value[$_smarty_tpl->tpl_vars['productRow']->value['ciq_status']];?>

                <?php }else{ ?>
                    <?php echo $_smarty_tpl->tpl_vars['productRow']->value['ciq_status'];?>

                <?php }?>
            </td>        
            <th>主要成分：</th>
            <td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['element'];?>
</td>
        </tr>
        <tr>
            <th>用途：</th>
            <td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['use_way'];?>
</td>
            <th>生产企业：</th>
            <td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['enterprises_name'];?>
</td>
        </tr>
        <tr>
            <th>供应商：</th>
            <td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['supplier'];?>
</td>
            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
goodsTaxCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</th>
            <?php if (isset($_smarty_tpl->tpl_vars['productRow']->value['gt_code'])&&$_smarty_tpl->tpl_vars['productRow']->value['gt_code']){?>
            <td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['gt_name'];?>
&nbsp;&nbsp;【<?php echo $_smarty_tpl->tpl_vars['productRow']->value['gt_code'];?>
】</td>
            <?php }else{ ?>
            <td></td>
            <?php }?>
        </tr>
        <tr>
            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
parcelTax<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</th>
            <td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['parcel_tax'];?>
</td>
            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductAddTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</th>
            <td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['product_add_time'];?>
</td>
        </tr>
        <tr>
            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
LastUpdatedProducts<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</th><td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['product_update_time'];?>
</td>
            <th>海关备案编号：</th>
            <td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['registerID'];?>
</td>
        </tr>
		<tr>
            <th>是否锁定：</th><td><?php if ($_smarty_tpl->tpl_vars['productRow']->value['is_lock']=='N'){?>否<?php }elseif($_smarty_tpl->tpl_vars['productRow']->value['is_lock']=='Y'){?>是<?php }?></td>
            <th>海关品名：</th>
            <td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['hs_goods_name'];?>
</td>
        </tr>
        <tr>
            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
remark<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</th>
            <td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['product_description'];?>
</td>
            <th>检验检疫备案编号：</th>
            <td><?php echo $_smarty_tpl->tpl_vars['productRow']->value['inspection_code'];?>
</td>
        </tr>
        <?php if ($_smarty_tpl->tpl_vars['productRow']->value['ciq_reject_reason']!=''){?>
        <tr>
            <th>商检错误回执：</th>
            <td colspan="3"><?php echo $_smarty_tpl->tpl_vars['productRow']->value['ciq_reject_reason'];?>
</td>
        </tr>
        <?php }?>
        </tbody>
    </table>
</div>



<div class="tabs_header cl content-box-header" style="margin: 10px 0 4px;">
    <ul class="tabs cl" style="padding-top: 2px;">
        <li class='active'>  <a href="javascript:;" id='tab_productlog' class='tab'><span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductLogs<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span></a></li>
        <li><a href="javascript:;" id='tab_orderProduct' class='tab'><span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductOrders<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span></a></li>
        <li><a href="javascript:;" id='tab_productImage' class='tab'><span>附件信息</span></a></li>
    </ul>
</div>

<div class='tabContent' id='productlog'>
    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <thead>
        <tr>
            <th align="center" width="100px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
LogType<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th align="center" width="100px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
operater<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th align="center" width="150px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
addTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th align="center" width="100px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
AccessIP<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th align="center" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
remark<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
        </tr>
        </thead>
        <tbody>
        <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['productLog']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
        <tr>
            <td><?php if ($_smarty_tpl->tpl_vars['row']->value['pl_type']=="1"){?><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
StateModification<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php }else{ ?><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ContentModification<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php }?></td>
            <td><?php if ($_smarty_tpl->tpl_vars['row']->value['customer_id']>0){?><?php echo $_smarty_tpl->tpl_vars['row']->value['account_name'];?>
<?php }else{ ?><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
system<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php }?></td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['pl_add_time'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['pl_ip'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['pl_note'];?>
</td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
	
</div>


<!--产品订单-->
<div class='tabContent' id='orderProduct'>
    <table  cellspacing="0" cellpadding="0" class="formtable tableborder" >
        <thead>
        <tr>
            <th align="center" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th align="center" >海关备案编号</th>
            <th align="center" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
quantity<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>           
         <!--    <th align="center" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
addTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th align="center" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
lastEditTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th> -->
        </tr>
        </thead>
        <tbody>
        <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['orderProduct']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
        <tr>
            <td style='text-align:center'><?php echo $_smarty_tpl->tpl_vars['row']->value['order_code'];?>
</td>
            <td  style='text-align:center'><?php echo $_smarty_tpl->tpl_vars['productRow']->value['registerID'];?>
</td>
            <td  style='text-align:center'><?php echo $_smarty_tpl->tpl_vars['row']->value['quantity'];?>
</td>           
   <!--          <td  style='text-align:center'><?php echo $_smarty_tpl->tpl_vars['row']->value['op_add_time'];?>
</td>
            <td  style='text-align:center'><?php echo $_smarty_tpl->tpl_vars['row']->value['op_update_time'];?>
</td> -->
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>




<div class='tabContent' id='productImage'>
   <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <thead>
        <tr>
            <th>附件名称</th>
            <th>附件类型</th>
            <th>附件内容</th>
            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
addTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
        </tr>
        </thead>
        <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['productImage']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
        <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['pa_name'];?>
</td>
            <td><?php if (isset($_smarty_tpl->tpl_vars['attachedType']->value[$_smarty_tpl->tpl_vars['row']->value['pa_type']])){?><?php echo $_smarty_tpl->tpl_vars['attachedType']->value[$_smarty_tpl->tpl_vars['row']->value['pa_type']];?>
<?php }?></td>
            <td>
                <div class="imgWrap" style=" white-space: nowrap; ">
                    
                    <a
                    <?php if ($_smarty_tpl->tpl_vars['row']->value['pa_file_type']=="img"){?>
                        href="/merchant/product/view-attach/aid/<?php echo $_smarty_tpl->tpl_vars['row']->value['pa_id'];?>
"
                    <?php }else{ ?>
                        href="<?php echo $_smarty_tpl->tpl_vars['row']->value['pa_path'];?>
"
                    <?php }?> style="width:76px;" target="_blank">
                        <img 
                        <?php if ($_smarty_tpl->tpl_vars['row']->value['pa_file_type']=="img"){?>
                            src="data:image/png;base64,<?php echo $_smarty_tpl->tpl_vars['row']->value['pa_content'];?>
"
                        <?php }else{ ?>
                            src="<?php echo $_smarty_tpl->tpl_vars['row']->value['pa_path'];?>
"
                        <?php }?>
                             style="width: 100px; height: 75px; margin-left: 1px; margin-top: 1px;">
                    </a>
                </div>
            </td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['pa_update_time'];?>
</td>
        </tr>
        <?php } ?>
    </table>
</div>


<div class='clear'></div>
</div>


</div>
<script type="text/javascript">

    $(function(){
		//$(".tabContent").show();
        $(".tab").click(function(){
            $(".tabContent").hide();
			// $(".tabContent").show();
			//return;
            $(this).parent().addClass("active");
            $(this).parent().siblings().removeClass("active");
            $("#"+$(this).attr("id").replace("tab_","")).show();
        });



        //$(".tabContent").eq(0).show();
        $("#productlog").show();

        $('.fancybox').fancybox({
            prevEffect	: 'none',
            nextEffect	: 'none',
            loop : true,
            autoPlay : false,
            helpers	: {
                title	: {
                    type: 'outside'
                },
                overlay	: {
                    opacity : 0.8,
                    css : {
                        'background-color' : '#000'
                    }
                },
                thumbs	: {
                    width	: 100,
                    height	: 100
                }
            }
        });

    });
	
	var product_sku = "";
	//page,rec_num,pageSize,url,page_size_max
    function multiPage(page,total,pageSize,url,page_size_max){
        var html = '<div url="'+url+'" pagenumshown="10" currentpage="'+page+'" numperpage="'+pageSize+'" totalcount="'+total+'" targettype="navTab" class="pagination">';
        html+='<a href="#" class="prev" onclick="loadData(1,'+pageSize+',\''+url+'\')"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
home<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>';

        totalPage = Math.ceil(total/pageSize);
        pnl = 6;
        page = parseInt(page);
        page = (page<1 || page>totalPage)?1:page;
        start_page = page-3>0?page-3:1;
        end_page = page+2>=6?page+2:6;
        if(end_page>totalPage) end_page = totalPage;
        if(page>1){
            prePage = parseInt(page)-1;
            html+='<a href="#" class="prev" onclick="loadData('+prePage+','+pageSize+',\''+url+'\')">&lt; <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Previous<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>';
        }else{
            html+='<a href="#" class="prev">&lt; <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Previous<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>';
        }
        for(i=start_page;i<=end_page;i++){
            if(i==page){
                html+='<span class="current">'+page+'</span>';
            }else{
                html+='<a href="#" onclick="loadData('+i+','+pageSize+',\''+url+'\')">'+i+'</a>';
            }
        }
        if(page<end_page){
            nextPage = parseInt(page)+1;
            html+='<a href="#" class="next" onclick="loadData('+nextPage+','+pageSize+',\''+url+'\')"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Next<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 &gt;</a>';
        }else{
            html+='<a href="#" class="next"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Next<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 &gt;</a>';
        }
        html+='<a href="#" class="last" onclick="loadData('+totalPage+','+pageSize+',\''+url+'\')"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
LastPage<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>';
        html+='<label><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Show<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
&nbsp;<input type="text" onkeydown="return onlyNum(this)" onchange="changePageSize(this,'+page+',\''+url+'\')" style="width:25px;ime-mode:Disabled;" value="'+pageSize+'" id="pageSize">&nbsp;    </label>';
        html+='<label style="margin-left:0px;padding-left:0px"><span style="padding-right:0px;margin-right:0px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Total<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</span><span style="font-weight:bold; margin:0;padding-left:0px">'+totalPage+'</span></label>';
        html+='<div class="clear"></div>';
        html+="</div>";
        return html;
    }

    function onlyNum(obj){
        return true;
    }

    function changePageSize(obj,page,url){
        pageSize = $(obj).val();
        var reg1 =  /^\d+$/;
        if(!pageSize.match(reg1)){
            alert('<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
numeric<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
            return false;
        }
        $.ajax({
            type:'Post',
            async: false,
            url:url,
            data:'page='+page+'&pageSize='+pageSize,
            dataType:'json',
            success:function(json){
                var html="";
                $.each(json.data,function(k,v){
                    html+="<tr>";
                    html+="<td>"+product_sku+"</td>";
                    html+="<td>"+ v.warehouse_name+"</td>";
                    html+="<td>"+ v.pil_onway+"</td>";
                    html+="<td>"+v.pil_pending+"</td>";
                    html+="<td>"+v.pil_sellable+"</td>";
                    html+="<td>"+v.pil_unsellable+"</td>";
                    html+="<td>"+v.pil_reserved+"</td>";
                    html+="<td>"+v.pil_shipped+"</td>";
                    html+="<td>"+v.pil_expire+"</td>";
                    html+="<td>"+v.from_it_code+"</td>";
                    html+="<td>"+v.to_it_code+"</td>";
                    html+="<td>"+v.pil_quantity+"</td>";
                    html+="<td>"+v.pil_add_time+"</td>";
                    html+="</tr>";
                });
                var pagination = multiPage(json.page,json.total,json.pageSize,json.url,1000);
                html+='<tr>';
                html+='<td colspan="11">'+pagination+'</td>';
                html+='</tr>';
                $("#inventoryLogData").html(html);
                $("#inventoryLog>table").alterBgColor();
            }
        });
    }

    function loadData(page,pageSize,url){
        $.ajax({
            type:'Post',
            async: false,
            url:url,
            data:'page='+page+'&pageSize='+pageSize,
            dataType:'json',
            success:function(json){
                var html="";
                $.each(json.data,function(k,v){
                    html+="<tr>";
                    html+="<td>"+product_sku+"</td>";
                    html+="<td>"+ v.warehouse_code+"</td>";
                    html+="<td>"+ v.pil_onway+"</td>";
                    html+="<td>"+v.pil_sellable+"</td>";
                   
                    html+="<td>"+v.pil_reserved+"</td>";
                    html+="<td>"+v.pil_shipped+"</td>";
                    html+="<td>"+v.from_it_code+"</td>";
                    html+="<td>"+v.to_it_code+"</td>";
                    html+="<td>"+v.pil_quantity+"</td>";
                    html+="<td>"+v.pil_add_time+"</td>";
                    html+="</tr>";
                });
                var pagination = multiPage(json.page,json.total,json.pageSize,json.url,1000);
                html+='<tr>';
                html+='<td colspan="11">'+pagination+'</td>';
                html+='</tr>';
                $("#inventoryLogData").html(html);
                $("#inventoryLog>table").alterBgColor();
            }
        });
    }
    //-->
</script>
<script>
$(function(){
   //按默认类   
    $("table").alterBgColor();
    
})
</script><?php }} ?>