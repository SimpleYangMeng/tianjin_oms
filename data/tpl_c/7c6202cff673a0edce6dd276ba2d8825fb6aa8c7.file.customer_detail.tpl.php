<?php /* Smarty version Smarty-3.1.13, created on 2016-12-19 09:41:10
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\merchant\views\customer\customer_detail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3175258573ab689e889-64600368%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7c6202cff673a0edce6dd276ba2d8825fb6aa8c7' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\merchant\\views\\customer\\customer_detail.tpl',
      1 => 1455677483,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3175258573ab689e889-64600368',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'customer' => 0,
    'ieport' => 0,
    'business' => 0,
    'session_name' => 0,
    'sessionid' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_58573ab6ad2637_88649106',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58573ab6ad2637_88649106')) {function content_58573ab6ad2637_88649106($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\block.t.php';
?><script src="/dwz/uploadify/scripts/jquery.uploadify.min.js" type="text/javascript"></script>
<link href="/dwz/uploadify/css/uploadify.css" rel="stylesheet" type="text/css" media="screen"/>
<style>
.selected{ background-color:#CC9933;}
</style>

<style>
    form strong{color:red;}
    .imgWrap2 {
        width: 100px;
        height: 76px;
        margin: 0px;
        border: 0 none;
    }
    td{
        text-align: left;
    }
    .depotForm td {
        border: 1px solid #91bcdf;
        line-height: 1.5em;
        padding: 5px;
        vertical-align: top;
    }
    .depot_path {
        text-align: right;
        width: 200px;
    }
</style>
<div id="content" xmlns="http://www.w3.org/1999/html">

<div class="content-box closed-box ui-tabs ui-widget ui-widget-content ui-corner-all">
<div class="content-box-header">
    <h3 style="margin-left:5px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
account_baseinfo<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
    <div class="clear"></div>
</div>

    <div class="depotState" style="margin-top:0px;">

        <table width="100%" cellspacing="0" cellpadding="0" border="1" class="depotForm">
            <tbody>
                <tr>
                    <td width="200" class="depot_path">企业类型：</td>
                    <?php if ($_smarty_tpl->tpl_vars['customer']->value['is_ecommerce']==1){?>
                        <td width="22%">电商企业</td>
                        <?php }elseif($_smarty_tpl->tpl_vars['customer']->value['is_shipping']==1){?>
                        <td width="22%">物流企业
                        <?php }elseif($_smarty_tpl->tpl_vars['customer']->value['is_pay']==1){?>
                        <td width="22%">支付企业
                        <?php }elseif($_smarty_tpl->tpl_vars['customer']->value['is_storage']==1){?>
                        <td width="22%">仓储企业
                        <?php }elseif($_smarty_tpl->tpl_vars['customer']->value['is_supervision']==1){?>
                        <td width="22%">监管场所
                        <?php }elseif($_smarty_tpl->tpl_vars['customer']->value['is_platform']==1){?>
                        <td width="22%">电商平台企业
                        <?php }else{ ?>
                        <td width="22%">
                    <?php }?>
                <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
主管海关<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td><?php echo $_smarty_tpl->tpl_vars['ieport']->value['ie_port_name'];?>
</td>
                <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
企业英文名<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['trade_name_en'];?>
</td>
                <!-- <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
进出口类型<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <?php if ($_smarty_tpl->tpl_vars['customer']->value['ie_type']=='I'){?>
                <td>进口</td>
                <?php }elseif($_smarty_tpl->tpl_vars['customer']->value['is_shipping']==1){?>.
                <td>出口</td>
                <?php }?> -->
            </tr>
            <tr>
                <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
企业名称<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['trade_name'];?>
</td>
                <td class="depot_path">组织机构代码：</td>
                <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['trade_co'];?>
</td>
                <td class="depot_path">企业注册地址：</td>
                <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_address'];?>
</td>
            </tr>
            <tr>
                <td class="depot_path">邮政编码：</td>
                <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_postno'];?>
</td>
                <td class="depot_path">联系电话：</td>
                <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_telephone'];?>
</td>
                <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
联系人姓名<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['bus_name'];?>
</td>
            </tr>
            <tr>
                <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
营业执照编号<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['bus_lic_reg_num'];?>
</td>
                <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
企业网址<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['web_address'];?>
</td>
                <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
registerTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_reg_time'];?>
</td>
            </tr>
            <tr>
                <td class="depot_path">检验检疫备案号：</td>
                <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['ciq_reg_num'];?>
</td>
                <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
检验检疫锁定<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td><?php if ($_smarty_tpl->tpl_vars['customer']->value['ciq_is_lock']=="1"){?>已锁定<?php }else{ ?>未锁定<?php }?></td>
                <td width="10%" class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
海关备案号<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['customs_seq_id'];?>
</td>
            </tr>
            <?php if ($_smarty_tpl->tpl_vars['customer']->value['is_ecommerce']=="1"){?>
                <tr>
                    <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
申报单位名称<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['agent_name'];?>
</td>
                    <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
申报单位代码<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td colspan="3"><?php echo $_smarty_tpl->tpl_vars['customer']->value['agent_code'];?>
</td>
                </tr>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['customer']->value['is_ecommerce']=="1"){?>
                <tr>
                    <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
店铺名称<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['eshop_name'];?>
</td>
                    <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
电商平台网站<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['bus_web_address'];?>
</td>
                    <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ICP备案号<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['cn_icp_code'];?>
</td>
                </tr>
            <?php }?>
            <tr>
                <td class="depot_path">邮箱：</td>
                <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_email'];?>
</td>
                <td width="10%" class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
企业代码<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td width="20%"><?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_code'];?>
</td>
                <td width="10%" class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
统一社会信用代码<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td width="20%"><?php echo $_smarty_tpl->tpl_vars['customer']->value['credit_code'];?>
</td>
            </tr>
            
            <tr>
                <td class="depot_path">企业法人或负责人：</td>
                <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['corporate'];?>
</td>
                <td class="depot_path">企业法人或负责人证件号码：</td>
                <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['corporate_num'];?>
</td>
                <td class="depot_path">企业法人或负责人联系电话：</td>
                <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['corporate_phone'];?>
</td>
            </tr>
            <tr>
                <?php if ($_smarty_tpl->tpl_vars['customer']->value['is_storage']=="1"||$_smarty_tpl->tpl_vars['customer']->value['is_ecommerce']=="1"){?>
                    <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
企业海关编码<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['customs_reg_num'];?>
</td>
                    <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
检验检疫编码<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['ciq_num'];?>
</td>
                <?php }?> 
                <?php if ($_smarty_tpl->tpl_vars['customer']->value['is_pay']=="1"){?>
                    <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
支付业务许可证<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td colspan="5"><?php echo $_smarty_tpl->tpl_vars['customer']->value['pay_bus_lic'];?>
</td>
                <?php }?> 
                <?php if ($_smarty_tpl->tpl_vars['customer']->value['is_shipping']=="1"){?>
                    <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
快递业务许可证<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td colspan="5"><?php echo $_smarty_tpl->tpl_vars['customer']->value['exp_bus_lic'];?>
</td>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['customer']->value['is_storage']=="1"){?>
                    <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
仓库面积<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['warehouse_area'];?>
㎡</td>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['customer']->value['is_supervision']=="1"){?>
                    <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
监管场所批准证书编号<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td colspan="5"><?php echo $_smarty_tpl->tpl_vars['customer']->value['is_supervision'];?>
</td>
             <!--    <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
业务类型<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td><?php echo $_smarty_tpl->tpl_vars['business']->value;?>
</td> -->
                <?php }?>
            </tr>
             <tr>
                
                <?php if ($_smarty_tpl->tpl_vars['customer']->value['is_supervision']=="1"||$_smarty_tpl->tpl_vars['customer']->value['is_storage']=="1"||$_smarty_tpl->tpl_vars['customer']->value['is_ecommerce']=="1"){?>
                    <td class="depot_path">有效期：</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['validity_date'];?>
</td>
                    <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
业务类型<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td colspan="3"><?php echo $_smarty_tpl->tpl_vars['business']->value;?>
</td>
                <?php }else{ ?>
                    <td class="depot_path">有效期：</td>
                    <td colspan="5"><?php echo $_smarty_tpl->tpl_vars['customer']->value['validity_date'];?>
</td>
                <?php }?>
                <!--
                <?php if ($_smarty_tpl->tpl_vars['customer']->value['is_storage']=="1"){?>
                    <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
业务类型<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['business']->value;?>
</td>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['customer']->value['is_ecommerce']=="1"){?>
                    <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
业务类型<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['business']->value;?>
</td>
                <?php }?>
                -->
            </tr> 
            <tr>
                <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
updateTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_update_time'];?>
</td>
                <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
lastPassTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['password_update_time'];?>
</td>
                <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
lastLoginTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['last_login_time'];?>
</td>
            </tr>
            <tr>
                <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
备注<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td colspan="6"><?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_note'];?>
</td>
            </tr>
            <!--<tr>
                <td class="depot_path"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
备注<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td><?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_note'];?>
</td>
            </tr>-->
            <?php if ($_smarty_tpl->tpl_vars['customer']->value['ciq_reject_reason']!=''){?>
            <tr>
            <td class="depot_path">备案失败回执：</td>
            <td colspan="5"><?php echo $_smarty_tpl->tpl_vars['customer']->value['ciq_reject_reason'];?>
</td>
            </tr>
            <?php }?>
            </tbody>
        </table>
        <div class="clr"></div>
    </div>
    <div class="depotState">
</div>
<script>
  $('#file_upload').uploadify({
		'swf'      : '/dwz/uploadify/scripts/uploadify.swf',
		//'uploader' : '/customer/customer/uploadimg',
		'uploader' : '/index/uploadimg',
        'buttonText': '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
LocalPictures<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
',
        'fileTypeExts': '*.jpg;*.png;*.gif',
        'formData' : { '<?php echo $_smarty_tpl->tpl_vars['session_name']->value;?>
' : '<?php echo $_smarty_tpl->tpl_vars['sessionid']->value;?>
','customerCode':'<?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_code'];?>
' },
        'scriptData' : { '<?php echo $_smarty_tpl->tpl_vars['session_name']->value;?>
': '<?php echo $_smarty_tpl->tpl_vars['sessionid']->value;?>
','customerCode':'<?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_code'];?>
' },
        'debug':false,		
        'onUploadSuccess':function(file,data,response){
            //alert(data);
            var obj = jQuery.parseJSON(data);
            _loadImage(obj.data);
           // alert(data);
            //alert( 'id: ' + file.id+ ' - 索引: ' + file.index+ ' - 文件名: ' + file.name　+ ' - 文件大小: ' + file.size+ ' - 类型: ' + file.type+ ' - 创建日期: ' + file.creationdate+ ' - 修改日期: ' + file.modificationdate+ ' - 文件状态: ' + file.filestatus　+ ' - 服务器端消息: ' + data+ ' - 是否上传成功: ' + response);
        },
        'onUploadError':function(file, errorCode, errorMsg, errorString) {
               // alert('The file ' + file.name + ' could not be uploaded: ' + errorString+':errorCode:'+errorCode);
        }
  });
  
  
function _loadImage(serverData) {
	$("#pic_wrapper").empty();
    var url = serverData.url;	
    var imgWrap = $("<div class='imgWrap' style='height:160px;'></div>");
//	var fancybox = 	$("<a class='fancybox' href='"+serverData.url+"' data-fancybox-group='gallery' ></a>");
//	var img = $("<img src='"+serverData.thumb+"'/>");
//	fancybox.append(img);
    var input = $("<input type='hidden' name='picUrl[]' value='"+serverData.file_path+"'>");
	
    var img = new Image();
    img.src = url;
    var wrapWidth = 140;
    var wrapHeight = 140;
    var marginLeft = 0;
    var marginTop = 0;
    var width_ = height_ = 0;
    img.onload = function () {
        var width  = this.width;
        var height = this.height;

        var  scale_org = wrapWidth/wrapHeight;

        if (wrapWidth / width > wrapHeight / height)
        {
            height_ = wrapHeight;
            width_ = width  * wrapHeight/height;
        } else
        {
            width_ = wrapWidth;
            height_ = height * wrapWidth/width;
        }
        marginLeft = (wrapWidth-width_)/2+1;
        marginTop = (wrapHeight-height_)/2+1;
        //alert(height_);
        img.style.width=width_+"px";
        img.style.height=height_+"px";
        img.style.marginLeft=marginLeft+"px";
        img.style.marginTop=marginTop+"px";
        imgWrap.append(img);
    };

    img.onerror = function () {
        this.onload = this.onerror = null;
    };



    imgWrap.append(input);
    imgWrap.append('<img class="web_wrap_del" src="/images/minus_sign.gif" style="cursor: pointer;" alt="delete" class="deleteImage">');


    $("#pic_wrapper").append(imgWrap);

}  


    $(".imgWrap").live("dblclick",function(){
        $(this).remove();
    });
    $(".deleteImage").live("click",function(){
        $(this).parent(".imgWrap").remove();
    })
    $(".web_wrap_del").live('click',function(){
        $(this).parent().remove();
    });



 	$('.cbcheckAll').die('click').live('click',function(){
        if ($(this).is(':checked')) {
            $(".cb_arr").attr('checked', true);
			
        } else {
            $(".cb_arr").attr('checked', false);
        }
		changeTrColor();
    });
	

	
	
	/*伴随全选按钮是否选中而变色*/
	function changeTrColor(){
	
		$(".cb_arr").each(function(){
				_this = $(this);
				if($('.cbcheckAll').is(':checked')){			
					set_tr_class(_this.parent().parent(), true);			
				}else{			
					set_tr_class(_this.parent().parent(), false);		
				}					
						
		});		
	}
	

function set_tr_class(element, selected) {
    if (selected) {		
		if(!element.hasClass('selected')){
        	element.attr("class", "selected " + element.attr("class"));
		}
    } else {
        var css = element.attr("class");
        var position = css.indexOf('selected');

        element.attr("class", css.substring(position + 9));
    }
	
}	


$(function(){

 $('#exportTypeBox').dialog({
            autoOpen: false,
            modal: false,
            bgiframe:true,
            width: 850,
			position:[50,50],
            resizable: false,
            close:function(){
                //alert('close');
            },buttons:{
                '关闭': function() {
                    $('#exportTypeBox').dialog('close');
                },'确定': function() {

                    var exportType = $('[name=exportType]:checked').val();
                    //var exportformat = $('[name=exportformat]:checked').val();
					var exportformat = 'xls';				
                    $('.dateformate').val(exportformat);
                    if(exportType=='1'){
                        //选择的订单               

                        var param = $("#dataForm").serialize();						
                        var checkedSizesize = $('.cb_arr:checked').size();
                        if(checkedSizesize<=0){
                            alertTip("请选择至少一条交易记录",'500','auto','1');
                            return;
                        }
                        //alert($('#pagerForm').attr('action'));

                        $('#dataForm').attr('action','/customer/customer/export-transaction-records/customer_code/<?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_code'];?>
');
                        $('#dataForm').attr('method','POST');
                        $('#dataForm').submit();				
                        //$('#orderDataForm').removeAttr('action');
                        //$('#orderDataForm').removeAttr('method');

                    }else if(exportType=='0'){
                        //全部的订单
						
                        $('#pagerForm').attr('action','/customer/customer/export-transaction-records/customer_code/<?php echo $_smarty_tpl->tpl_vars['customer']->value['customer_code'];?>
');
                        $('#pagerForm').attr('method','POST');
                        $('#pagerForm').submit();
                       
                        //$('#orderDataForm').removeAttr('method');

                    }
                    return;
                }
            }
        });	
});	
</script>
<div>
<?php }} ?>