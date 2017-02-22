<?php /* Smarty version Smarty-3.1.13, created on 2016-03-18 19:52:20
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\merchant\views\personitem\person-item-add.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3005056ebebf4100081-97302957%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '506f35ac6c7add7323662ef396fb6736af44d503' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\merchant\\views\\personitem\\person-item-add.tpl',
      1 => 1455677482,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3005056ebebf4100081-97302957',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'iePorts' => 0,
    'w' => 0,
    'formType' => 0,
    'companyInfo' => 0,
    'wrapType' => 0,
    'traf' => 0,
    'c' => 0,
    'country' => 0,
    'orderInfo' => 0,
    'customer' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56ebebf4319047_24689866',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56ebebf4319047_24689866')) {function content_56ebebf4319047_24689866($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\block.t.php';
if (!is_callable('smarty_modifier_date_format')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\modifier.date_format.php';
?><style>
.width180 {
    width: 180;
}
form span {
    color: red;
}
.topButDiv #dialog_link {
    float: left;
    display: block;
    padding: 10px;
    margin-bottom: 5px;
}
.product-item input.w100 {
    width: 100px;
}
.product-item input.w120 {
    width: 120px;
}
.product-item input.w80 {
    width: 80px;
}

</style>
<script type="text/javascript" src="/js/artTemplate/template.js"></script>
<script src="/js/jquery-ui-timepicker-addon.js" type="text/javascript"></script>
<script type="text/javascript" src="/js/jquery-fileUpload.js"></script>

<form action="/merchant/personal-items/add-save" method='POST' id='orderForm' class="pageForm required-validate">
    <fieldset>
        <div style="margin:0 0 10px 0" class="nbox_c marB10">
            <table cellspacing="0" cellpadding="0" class="tableborder formtable" id='item_table'>
                <thead>
                <tr id="error" style="display:none">
                    <td colspan="12" id="product-table-message_tip" class="error">
                    </td>
                </tr>
                <tr>
                    <td style="width: 10px;">No</td>
                    <td style="width: 80px;">料件号</td>
                    <td style="width: 120px;">序号</td>
                    <td style="width: 100px;">商品流水号</td>
                    <td style="width: 140px;">海关备案编号</td>
                    <td style="width: 60px;">行邮税号</td>
                    <td style="width: 70px;">海关商品编码</td>
                    <td style="width: 80px;">商品名称</td>
                    <td style="width: 60px;">规格型号</td>
                    <td style="width: 60px;">申报单价</td>
                    <td style="width: 60px;">币制</td>
                    <td style="width: 60px;">申报数量</td>
                    <td style="width: 60px;">申报单位</td>
                    <td style="width: 60px;">原产国</td>
                    <td style="width: 60px;">操作 <img src='/images/plus_sign.gif'style="margin-left:8px;margin-bottom:-5px;cursor: pointer;" onclick="addProduct()"/></td>
                </tr>
                    <!--
                        <tr>
                            <td colspan="10"   style="text-align:center"><span  style="color:red">请选择产品</span></td>
                        </tr>
                    -->
                </thead>
            </table>
            <div class="clear"></div>
        </div>
        <table class="pageFormContent">
            <tbody>
                <tr>
                    <td class="form_title nowrap text_right">企业清单内部编号：</td>
                    <td><input class="text-input width140 ui-autocomplete-input" type="text" id="pim_reference_no" name="pim_reference_no" value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)){?><?php echo $_smarty_tpl->tpl_vars['data']->value['pim_reference_no'];?>
<?php }?>"></td>
                </tr>
                <tr>
                    <td style="text-align: right" width='175'>申报口岸：</td>
                    <td width='245'><select name="declare_ie_port"
                                            id='declare_ie_port' class="text-input width155">
                            <option value="">-Select-</option> <?php  $_smarty_tpl->tpl_vars['w'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['w']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['iePorts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['w']->key => $_smarty_tpl->tpl_vars['w']->value){
$_smarty_tpl->tpl_vars['w']->_loop = true;
?>
                                <option value='<?php echo $_smarty_tpl->tpl_vars['w']->value['ie_port'];?>
'><?php echo $_smarty_tpl->tpl_vars['w']->value['ie_port_name'];?>
</option>
                            <?php } ?>
                        </select> <span><strong>*</strong></span></td>
                    <td class="form_title nowrap text_right">业务类型：</td>
                    <td width='245'>
                        <select name="form_type" class="width155">
                            <option value="">-Select-</option> <?php  $_smarty_tpl->tpl_vars['w'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['w']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['formType']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['w']->key => $_smarty_tpl->tpl_vars['w']->value){
$_smarty_tpl->tpl_vars['w']->_loop = true;
?>
                                <option value='<?php echo $_smarty_tpl->tpl_vars['w']->value['form_type'];?>
'><?php echo $_smarty_tpl->tpl_vars['w']->value['form_type_name'];?>
</option>
                            <?php } ?>
                        </select>
                        <span><strong>*</strong></span>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right" width='175'>电商企业代码：</td>
                    <td width='245'><input name="customer_code" id='customer_code'
                                           class="text-input width140" value="" /> <span><strong>*</strong></span>
                    </td>

                    <td style="text-align: right" width='175'>电商企业名称：</td>
                    <td width='245'><input name="enp_name" id='enp_name'
                                           class="text-input width140" value="" /> <span><strong>*</strong></span>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right" width='175'>仓储企业代码：</td>
                    <td width='245'>
                        <input type="hidden" name="storage_customer_code" value="<?php echo $_smarty_tpl->tpl_vars['companyInfo']->value['customer_code'];?>
" />
                        <span class="blue"><?php echo $_smarty_tpl->tpl_vars['companyInfo']->value['customer_code'];?>
</span>
                    </td>
                    <td style="text-align: right" width='175'>仓储企业名称：</td>
                    <td width='245'>
                        <input type="hidden" name="storage_name" value="<?php echo $_smarty_tpl->tpl_vars['companyInfo']->value['trade_name'];?>
" />
                        <span class="blue"><?php echo $_smarty_tpl->tpl_vars['companyInfo']->value['trade_name'];?>
</span></td>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right" width='175'>申报单位代码：</td>
                    <td width='245'>
                        <input type="hidden" name="agent_customer_code" value="<?php echo $_smarty_tpl->tpl_vars['companyInfo']->value['customer_code'];?>
" />
                        <span class="blue"><?php echo $_smarty_tpl->tpl_vars['companyInfo']->value['customer_code'];?>
</span>
                    </td>
                    <td style="text-align: right" width='175'>申报单位名称：</td>
                    <td width='245'>
                        <input type="hidden" name="agent_name" value="<?php echo $_smarty_tpl->tpl_vars['companyInfo']->value['trade_name'];?>
" />
                        <span class="blue"><?php echo $_smarty_tpl->tpl_vars['companyInfo']->value['trade_name'];?>
</span></td>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right" width='175'>物流企业代码：</td>
                    <td width='245'>
                        <input type="text" class="text-input width140" name="logistic_customer_code" value="" />
                    </td>
                    <td style="text-align: right" width='175'>支付企业代码：</td>
                    <td width='245'>
                        <input type="text" class="text-input width140" name="pay_customer_code" value="" />
                        </td>
                    </td>
                </tr>

                <tr>
                    </td>
                    <td style="text-align: right" width='175'>交易订单号：</td>
                    <td width='245'><input name="reference_no" id='reference_no'
                                           class="text-input width140" value="" /> <span><strong>*</strong></span>
                    </td>
                    <td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
wb_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td width='245'><input name="log_no" id='log_no'
                                           class="text-input width140" value="" /> <span><strong>*</strong></span>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
支付单号<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td width='245'><input name="pay_no" id='pay_no'
                        class="text-input width140" value="" /> <span><strong>*</strong></span>
                    </td>
                    <td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
wrap_type<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td width='245'>
                        <select name="wrap_type" id='wrap_type' class="text-input width155">
                            <option value="">-Select-</option> <?php  $_smarty_tpl->tpl_vars['w'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['w']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['wrapType']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['w']->key => $_smarty_tpl->tpl_vars['w']->value){
$_smarty_tpl->tpl_vars['w']->_loop = true;
?>
                                <?php if ($_smarty_tpl->tpl_vars['w']->value['wrap_type']!=''){?>
                                <option value='<?php echo $_smarty_tpl->tpl_vars['w']->value['wrap_type'];?>
'><?php echo $_smarty_tpl->tpl_vars['w']->value['wrap_type_name'];?>
</option>
                                <?php }?>
                            <?php } ?>
                        </select>
                         <span><strong>*</strong></span>
                    </td>
                </tr>
                <!--<tr>
                    <td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
exit_time<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td width='245'><input type="text"
                        class="datepicker text-input width140" value="" name="exit_time"
                        id="exit_time" readonly="readonly" /> <span><strong>*</strong></span>
                    </td>
                </tr>-->

                <tr>
                    <!--<td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
declare_time<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td width='245'><input type="text"
                        class="datepicker text-input width140" value=""
                        name="declare_time" id="declare_time" readonly="readonly" /> <span><strong>*</strong></span>
                    </td>-->
                    <td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ImportexportPorts<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td width='245'><select name="ie_port" id='ie_port'
                        class="text-input width155">
                            <option value="">-Select-</option> <?php  $_smarty_tpl->tpl_vars['w'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['w']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['iePorts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['w']->key => $_smarty_tpl->tpl_vars['w']->value){
$_smarty_tpl->tpl_vars['w']->_loop = true;
?>
                            <option value='<?php echo $_smarty_tpl->tpl_vars['w']->value['ie_port'];?>
'><?php echo $_smarty_tpl->tpl_vars['w']->value['ie_port_name'];?>
</option>
                            <?php } ?>
                    </select> <span><strong>*</strong></span></td>
                    <td style="text-align: right" width='175'>运输方式：</td>
                    <td width='245'><select class="text-input width155"
                                            id="traf_mode" name="traf_mode"> <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['traf']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
                                <option value='<?php echo $_smarty_tpl->tpl_vars['c']->value['tfm_id'];?>
'<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)&&$_smarty_tpl->tpl_vars['data']->value['traf']==$_smarty_tpl->tpl_vars['c']->value['tfm_id']){?> selected<?php }elseif($_smarty_tpl->tpl_vars['c']->value['traf_mode_name']=='公路运输'){?>
                                selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['traf_mode_name'];?>
</option> <?php } ?>
                        </select> <span><strong>*</strong></span></td>
                </tr>

                <tr>
                    <td style="text-align: right" width='175'>发件人国家：</td>
                    <td width='245'>
                        <select name="ship_trade_country" class="text-input width155">
                            <option value="">-Select-</option>
                            <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['country']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
                                <option value='<?php echo $_smarty_tpl->tpl_vars['c']->value['country_id'];?>
'<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)&&$_smarty_tpl->tpl_vars['orderInfo']->value['oab_country_id']==$_smarty_tpl->tpl_vars['c']->value['country_id']){?>
                                selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['country_code'];?>
 <?php echo $_smarty_tpl->tpl_vars['c']->value['country_name'];?>
</option>
                            <?php } ?>
                        </select>
                        <span><strong>*</strong></span>
                    <td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ship_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td width='245'><input name="ship_name" id='ship_name'
                        class="text-input width140" value="" /> <span><strong>*</strong></span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right" width='175'>发件人城市：</td>
                    <td width='245'>
                        <input name="ship_city" class="text-input width140">
                    </td>
                    <td style="text-align: right" width='175'>报关员：</td>
                    <td width='245'>
                        <input name="declare_no" class="text-input width140" value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['account_name'];?>
">
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right" width='175'>启运国：</td>
                    <td width='245'>
                        <select name="outset_country_id" class="text-input width155">
                            <option value="">-Select-</option>
                            <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['country']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
                                <option value='<?php echo $_smarty_tpl->tpl_vars['c']->value['country_id'];?>
'<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)&&$_smarty_tpl->tpl_vars['orderInfo']->value['oab_country_id']==$_smarty_tpl->tpl_vars['c']->value['country_id']){?>
                                selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['country_code'];?>
 <?php echo $_smarty_tpl->tpl_vars['c']->value['country_name'];?>
</option>
                            <?php } ?>
                        </select>
                        <span><strong>*</strong></span>
                    </td>
                    <td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
抵运国<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td width='245'><select name="aim_country_name"
                        id='aim_country_name' class="text-input width155">
                            <option value="">-Select-</option> <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['country']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
                            <option value='<?php echo $_smarty_tpl->tpl_vars['c']->value['country_id'];?>
'<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)&&$_smarty_tpl->tpl_vars['orderInfo']->value['oab_country_id']==$_smarty_tpl->tpl_vars['c']->value['country_id']){?>
                                selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['country_code'];?>
 <?php echo $_smarty_tpl->tpl_vars['c']->value['country_name'];?>
</option>
                            <?php } ?>
                    </select> <span><strong>*</strong></span></td>
                </tr>



                <tr>
                    <td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
The_recipient_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td width='245'><input name="receive_name" id='receive_name'
                        class="text-input width140" value="" /> <span><strong>*</strong></span>
                    </td>
                    <td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
tel_of_consignee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td width='245'><input name="receive_telphone"
                        id='receive_telphone' class="text-input width140" value="" /> <span><strong>*</strong></span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ReciveCountry<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td width='245'><select name="receive_country_name"
                        id='receive_country_name' class="text-input width155">
                            <option value="">-Select-</option> <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['country']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
                            <option value='<?php echo $_smarty_tpl->tpl_vars['c']->value['country_id'];?>
'<?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)&&$_smarty_tpl->tpl_vars['orderInfo']->value['oab_country_id']==$_smarty_tpl->tpl_vars['c']->value['country_id']){?>
                                selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['country_code'];?>
 <?php echo $_smarty_tpl->tpl_vars['c']->value['country_name'];?>
</option>
                            <?php } ?>
                    </select> <span><strong>*</strong></span></td>
                    <td style="text-align: right" width='175'>收件人省份：</td>
                    <td width='245'><input name="receive_state" id='receive_state'
                        class="text-input width140" value="" /> <span><strong>*</strong></span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right" width='175'>收件人城市：</td>
                    <td width='245'><input name="receive_city" id='receive_city'
                        class="text-input width140" value="" /> <span><strong>*</strong></span>
                    </td>
                    <td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
receive_id_number<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td width='245'><input name="receive_id_number"
                        id='receive_id_number' class="text-input width140" value="" /> <span><strong>*</strong></span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right" width='175'>录入单位：</td>
                    <td width='245'><input name="input_company" id='input_company'
                                           class="text-input width140" value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['company'];?>
" /> <span><strong>*</strong></span>
                    </td>
                    <td style="text-align: right" width='175'>单位地址：</td>
                    <td width='245'><input name="agent_address"
                                           id='agent_address' class="text-input width140" value="<?php echo $_smarty_tpl->tpl_vars['companyInfo']->value['customer_address'];?>
" /> <span><strong>*</strong></span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right" width='175'>邮编：</td>
                    <td width='245'><input name="agent_post" id='agent_post'
                                           class="text-input width140" value="<?php echo $_smarty_tpl->tpl_vars['companyInfo']->value['customer_postno'];?>
" /> <span><strong>*</strong></span>
                    </td>
                    <td style="text-align: right" width='175'>电话：</td>
                    <td width='245'><input name="agent_tel" id='agent_tel' class="text-input width140" value="<?php echo $_smarty_tpl->tpl_vars['companyInfo']->value['customer_telephone'];?>
" /> <span><strong>*</strong></span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right" width='175'>运费：</td>
                    <td width='245'>
                        <input name="freight" id='freight' class="text-input width140" value="0" />
                    </td>
                    <td style="text-align: right" width='175'>保费：</td>
                    <td width='245'>
                        <input name="insure_fee" id='insure_fee' class="text-input width140" value="0" />
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right" width='175'>监管场所代码：</td>
                    <td width='245'><input name="customs_field" id='customs_field'
                                           class="text-input width140" value="" />
                    </td>
                    <td style="text-align: right" width='175'>录入员：</td>
                    <td width='245'><input name="input_no"
                                           id='input_no' class="text-input width140" value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['account_name'];?>
"  />
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right" width='175'>净重：</td>
                    <td width='245'><input name="net_wt" id='net_wt'
                                           class="text-input width140" value="" />
                    </td>
                    <td style="text-align: right" width='175'>毛重：</td>
                    <td width='245'><input name="gross_wt"
                                           id='gross_wt' class="text-input width140" value="" />
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right" width='175'>件数：</td>
                    <td width='245'><input name="pack_no" id='pack_no'
                                           class="text-input width140" value="" />
                    </td>
                    <td style="text-align: right" width='175'>进出境日期：</td>
                    <td width='245'><input name="i_e_date" id='i_e_date'
                                           class="datepicker text-input width140" value="<?php echo smarty_modifier_date_format(time(),"%Y-%m-%d");?>
" readonly />
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right" width='175'>录入时间：</td>
                    <td width='245'><input name="input_date" id='input_date'
                                           class="datepicker text-input width140" value="<?php echo smarty_modifier_date_format(time(),"%Y-%m-%d");?>
" readonly/>
                    </td>
                    <td style="text-align: right" width='175'>申报日期：</td>
                    <td width='245'><input name="declare_date" id='declare_date'
                                           class="datepicker text-input width140" value="<?php echo smarty_modifier_date_format(time(),"%Y-%m-%d");?>
" readonly />
                    </td>
                </tr>
                <tr>
                    <td style="text-align: right" width='175'>收件人地址：</td>
                    <td colspan="3"><textarea style="width: 580px; height: 70px;"
                                              name="receiving_address" ></textarea></td>
                </tr>

                <tr>
                    <td style="text-align: right" width='175'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
note<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td colspan="3"><textarea style="width: 580px; height: 70px;"
                            name="note" ></textarea></td>
                </tr>
                <tr>
                    <td style="text-align: right">&nbsp;</td>
                    <td colspan='3'><a href="javascript:;" class="button tijiao"
                        id="orderbutton" onclick="addSubmit();return false;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
submit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a><?php if (isset($_smarty_tpl->tpl_vars['orderInfo']->value)){?><input type="hidden" name='ordersCode'
                        value="<?php echo $_smarty_tpl->tpl_vars['orderInfo']->value['order_code'];?>
"><?php }?></td>
                </tr>
            </tbody>
        </table>
    </fieldset>
</form>

<script id="product-excel-list" type="text/html">
    {{each error as product key}}
    <p class="product-table-return-message">
        <span class="msg-box n-default-product n-right"><span class="msg-wrap n-error" role="alert"><span class="n-msg ">备案编号[{{key}}]:</span></span></span>
        {{each product as e}}
        <span class="msg-box n-default-product n-right"><span class="msg-wrap n-error" role="alert"><span class="n-msg ">{{e}}</span></span></span>
        {{/each}}
    </p>
    {{/each}}
</script>

<script id="product-list-success" type="text/html">
    <tr class="product-table-return-message product-item" id='tr_{{key}}'>
        <td>{{key}}</td>
        <td>
            <input type="text" value="{{goods_id}}" class="w80" name="product[{{key}}][goods_id]" onblur='showProduct(this)' key="{{key}}" />
        </td>
        <td>
            <input type="text" value="{{g_no}}" class="w120" name="product[{{key}}][g_no]" />
        </td>
        <td>
            {{ciq_g_no}}
            <input type="text" value="{{ciq_g_no}}" class="w100" name="product[{{key}}][ciq_g_no]" onblur='checkRepeat(this)'/>
        </td>
        <td>
            {{registerID}}
            <input type="hidden" value="{{registerID}}" name="product[{{key}}][registerID]" />
        </td>
        <td>
            {{gt_code}}
            <input type="hidden" value="{{gt_code}}" name="product[{{key}}][gt_code]" />
        </td>
        <td>
            {{hs_code}}
            <input type="hidden" value="{{hs_code}}" name="product[{{key}}][hs_code]" />
        </td>
        <td>
            {{g_name_cn}}
            <input type="hidden" value="{{g_name_cn}}" name="product[{{key}}][g_name_cn]" />
        </td>
        <td>
            {{g_model}}
            <input type="hidden" value="{{g_model}}" name="product[{{key}}][g_model]" />
        </td>
        <td>
            <input type="text" value="{{price}}" name="product[{{key}}][price]" class='medium-input'/>
        </td>
        <td>
            {{curr}}
            <input type="text" value="{{curr}}" name="product[{{key}}][curr]" class='medium-input'/>
        </td>
        <td>
            <input type="text" value="{{g_qty}}" name="product[{{key}}][g_qty]" class='medium-input'/>
        </td>
        <td>
            <input type="text" value="" name="product[{{key}}][g_uint]" class='medium-input'/>
        </td>
        <td>
            {{countryName}}
            <input type="hidden" value="{{country}}" name="product[{{key}}][country]" />
        </td>
         <td><img src="/images/minus_sign.gif" style="margin-left:8px;margin-top:5px;position:absolute;cursor: pointer;" onclick="deleteProudt(this)"/></td>
    </tr>
</script>


<!-- 选择产品dialog begin -->
<div id="dialog" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
选择商品<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
">
    <table class="form-table" style="width: 100%;" border="1">
        <tr>
            <td colspan="2">
                <span>下载模板：</span>
                <a href="/template/person-itemproduct.xlsx" target="_blank">商品上传模板</a>
            </td>
        </tr>
        <tr>
            <td class="form_title nowrap text_right">
                选择要上传的文件
            </td>
            <td class="form_input">
                <input type="file" class="input-file" id="dialogInputForExcel" />
            </td>
        </tr>
        <tr>
            <td colspan="3"><input type="button" id="dialogButtonForExcel" value="上传" class="form-input "></td>
        </tr>
    </table>
</div>
<!-- 选择产品 dialog end -->

<script type="text/javascript">
    $(function(){
        $(".datepicker").datepicker({ dateFormat: "yy-mm-dd"});
    })
//省份
/*$("#receive_state").autocomplete({
    minLength: 0,
    source: function(request, response) {
            var term = request.term;
            if(term) {
                term = term.toUpperCase();
                $("#receive_state").val(term);
            }
            $.post('/merchant/order/province', {'country_id':$('#receive_country_name').val(),'term':term},function(data){
                response(data);
        }, 'json');
    }
}).focus(function() {
    $('#receive_state').autocomplete("search", "");
});

//城市
$("#receive_city").autocomplete({
    minLength: 0,
    source: function(request, response) {
            var term = request.term;
            if(term) {
                term = term.toUpperCase();
                $("#receive_city").val(term);
            }
            $.post('/merchant/order/city', {'country_id':$('#receive_country_name').val(),'province_id':$("#receive_state").val(),'term':term},function(data){
                response(data);
        }, 'json');
    }
}).focus(function() {
    $('#receive_city').autocomplete("search", "");
});*/



//保存
function addSubmit(){
    // alertTip('保存成功~');
    var id = $('#id').val();
    $.ajax({
        type:"post",
        dataType:"json",
        async:false,
        url:'/merchant/personal-items/add-save',
        data:$('#orderForm').serialize(),
        success:function(json){
            // if(json.ask==1){
            //     alertTip('保存成功~');
            //     // if(id==''){
            //     //     orderForm.reset();
            //     // }
            // }
            var msg = '';
            if(json.ask==0){
                msg+=json.message+'<br />';
                $.each(json.error,function(k,v){
                    msg += v+'<br />';
                });
            }else{
                msg = json.message;
                $('#orderForm')[0].reset();
                $('select').each(function(){
                    $(this).trigger('update');
                })

            }
            alertTip(msg);
        }
    });
}

//得到订单信息 -- 暂未用
function getOrderList(){
    var orderData = $("#pagerForm").serialize();
    // alert(orderData);
    //orderData+="&warehouse_id=" + $('#warehouseId').val();
    if($('.aimwarehouses').size()>0){
        orderData += "&to_warehouse=" + $('[name=to_warehouse]').val();
    }
    orderData += "&from=asn";
    $.ajax({
        type:'post',
        url:'/merchant/product/repository?customer=true',
        data:orderData,
        dataType:'html',
        success:function(html){
            $("#dialog").html(html);
        }
    });
    $('#dialog').dialog('open');
}
//未选择产品
function getRipOfNodataRow(){
     var dataRows = $("#orderproducts tr:not(.norowdata)").size();
     
     if(dataRows>0){
       $('.norowdata').remove();
     }else{         
        var html='<tr class="norowdata">\n';
           html+='<td colspan="6" style="text-align:center;"><b><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
not_select_product_yet<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</b></td></tr>';
            $("#orderproducts").append(html);       
     }
}



readAsText.init({
    url:"/merchant/personal-items/find-product",
    element:'#dialogInputForExcel',
    triggerElement: '#dialogButtonForExcel',
    success:function(json){
        $('.product-table-return-message').remove();
        $('#product-table-message_tip').hide();        
        if(json.ask == 0){
            var msghtml = template('product-excel-list', json);
            $('#product-table-message_tip').html(msghtml);
            $('#product-table-message_tip').show();
            $('#product-table-message_tip').parent().show();
        }else if(json.ask == 1){
            var successHtml = template('product-list-success', json);
            $(successHtml).appendTo('.tableborder');
        }
        $('#dialog').dialog('close');
    }
});
var sucss={
        'key':1,
        'goods_id':'',
        'registerID':'',
        'gt_code':'',
        'g_no':'',
        'hs_code':'',
        'price':'',
        'curr':'',
        'g_name_cn':'',
        'g_model':'',
        'g_uint_name':'',
        'country':''
 };
function addProduct(){
var html=template('product-list-success',sucss);
    $("#item_table").append(html);
     sucss['key']++;
    replaceMinus();
}
function replaceMinus(){
    var last=$("#item_table").find('tr');
    for(var i=2;i<last.length;i++){
        var index=i-1;
        $("#tr_"+index).find("td:last").html('');
    }
    if(last.length>=3){
        var p=last.length-2;
     $("#tr_"+p).find("td:last").html('<img src="/images/minus_sign.gif" style="margin-left:8px;margin-top:5px;position:absolute;cursor: pointer;" onclick="deleteProudt(this)"/>');
    }
}
function showProduct(obj){
    var goods_id=$(obj).val();
    var key=$(obj).attr('key');
    if(goods_id){
        /*
        var has=0;
        $("[name*='goods_id']").each(function(){
           if($.trim($(this).val())==goods_id){
               has++;
           }
        });
        if(has>=2){
            window.alert('对应底账料件号已经填写');
            return false;
        }
        */
        $.ajax({
            data:{'goodsId':goods_id},
            type:'Post',
            url:'/merchant/personal-items/get-item',
            dataType:'json',
            success:function(json){
                if(json.ask!='1'){
                    alertTip(json.message);
                }else{
                    var tplData={'key':key};
                    for(var k in json.data){
                        tplData[k]=json.data[k];
                    }
                   var html=template('product-list-success',tplData);
                   $("#tr_"+key).replaceWith(html);
                   $("#tr_"+key).find("input[type='text']").eq(1).focus();
                    replaceMinus();
                }
            }
        });
    }
}
function deleteProudt(obj){
    $(obj).parents('tr').remove();
     sucss['key']-=1;
      replaceMinus();
}

//验证检验检疫备案号重复
function checkRepeat(obj){
    var ciq_g_no=$(obj).val();
    if(ciq_g_no){
        var num=0;
        $("[name*='ciq_g_no']").each(function(){
           if( $.trim($(this).val()) == ciq_g_no ){
               num++;
           }
        });
        if(num >=2 ){
            alertTip( '检验检疫备案号<span class="blue">' + ciq_g_no + '</span>已填写，请核对');
        }
    }
}

$(function(){
    var dayNamesMin = ['日', '一', '二', '三', '四', '五', '六'];
    var monthNamesShort = ['01月', '02月', '03月', '04月', '05月', '06月', '07月', '08月', '09月', '10月', '11月', '12月'];
    $.timepicker.regional['ru'] = {
        timeText: '选择时间',
        hourText: '小时',
        minuteText: '分钟',
        secondText: '秒',
        millisecText: '毫秒',
        currentText: '当前时间',
        closeText: '确定',
        ampm: false
    };
    $.timepicker.setDefaults($.timepicker.regional['ru']);

    $('#input_date').datetimepicker({
        dayNamesMin: dayNamesMin,
        monthNamesShort: monthNamesShort,
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });

    //时间控件
    $(".datepicker").datepicker({ dateFormat: "yy-mm-dd"});

    //产品浏览
    $('#dialog_link').click(function(){
        //获取产品信息
        $('#dialog').dialog('open');
    });

    //选择产品
    $(".orderactionSku").live("click", function () {
        var productId = $(this).attr("productId");
        var productSku = $(this).attr("productSku");
        var productName = $(this).attr("productName");
        var category = $(this).attr("category");
        var productWeight = $(this).attr("productWeight");
        var warehouse_id = $("[name='warehouse_id']").val();
        var to_warehouse_id = $("[name='to_warehouse_id']").val();
        if ($(this).is(':checked')){
            if($("#orderproduct"+productId).size()==0){
                if ($("#orderproduct" + productId).size() == 0) {
                    var html = '';
                    html += '<tr id="orderproduct' + productId + '" class="product_sku">';
                    html += '<td><a onclick="window.parent.openMenuTab(\'merchant/product/detail/productId/' + productId + '\',\'产品详情\',\'product-detail\');return false;">' + productSku + '</a><input type="hidden" name="product_sku[' + productId + ']" value="' + productSku + '"></td>';
                    html += '<td title="'+productName+'">' + productName + '</td>';
                    html += '<td><input type="text" class="inputbox inputMinbox" name="sku[' + productId + ']" onkeyup="changeWeight('+productId+','+productWeight+',this.value)" value="1" size="6">&nbsp;<strong>*</strong></td>';
                    html += '<td id="sku'+productId+'">'+productWeight+'</td>';
                    // 不分仓库了，所有的交易价格、成交单价都必填
                    html += '<td><input type="text" class="inputbox inputMinbox price" name="price['+productId+']" size="6"><span class="red">*</span> </td>';
                    html += '<td><input type="text" class="inputbox inputMinbox total_price" name="total_price['+productId+']" size="6" disabled="disabled"><span class="red">*</span> </td>';
                    html += '<td><a class="productDel" href="javascript:;" title="delete"><img src="/images/icon_del.gif"></a></td>';
                    html += '</tr>';
                    $("#orderproducts").append(html);
                }
            }
        }else{
            if($("#orderproduct"+productId).size()>0){
                $("#orderproduct"+productId).remove();
            }
        }
        //if(typeof(countWeight)!='undefined'){countWeight();}
        if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}
    });
    
    //导入XML
    $('#xls_input_link').click(function(){
        $('#XLSInputBox').dialog('open');
    });
    $("input[name*='goods_id']").live('keydown',function(event){
        if(event.keyCode=='13'){
            showProduct($(this));
        }
    })
    $("#item_table input[type='text']").live('keydown',function(event){
        var inputList=$("#item_table input[type='text']");
        if(event.keyCode=='13'){
           var index=inputList.index($(this));
           console.log(index);
           inputList.eq(index+1).focus();
        }
    })
    $('#XLSInputBox').dialog({
        autoOpen: false,
        modal: false,
        bgiframe:true,
        width: 900,
        height:500,
        resizable: true,
        close:function(){
        //  reseterrorrow();
        },buttons:{
            '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
close<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
                    $('#XLSInputBox').dialog('close');
            },'<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Determine<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
            //  do_import_action();
            }       
        }
    });
    
    //产品dialog 由 noleftlayout 模板里面 getProductListBoxData(…) 方法导入数据
    $('#dialog').dialog({
            autoOpen: false,
            position: ['center','top'],
            modal: true,
            bgiframe:true,
            width: 850,
            minHeight:100,
            resizable: false
    });


    //删除产品
    $(".productDel").live("click",function(){
        $(this).parent().parent().remove();     
        if(typeof(keepTheInterface)!='undefined'){keepTheInterface();}
        //if(typeof(countWeight)!='undefined'){countWeight();}
        if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}
    });
    
    //计算总价
    $('[name^="sku["],[name^="price["]').live('keyup', function () {
        var attrName = $(this).attr('name');
        var pattern  = /\[(\d+)\]/;
        var matches  = attrName.match(pattern);
        var pid      = matches[1];
        var quantity = $('[name="sku[' + pid + ']"]').val();
        var price    = $('[name="price[' + pid + ']"]').val();
        var total    = quantity * price;

        if (!isNaN(total)) {
          total = total.toFixed(2);
        }

        $('[name="total_price[' + pid + ']"]').val(total);
    });
    //countWeight();
});

</script>
<?php }} ?>