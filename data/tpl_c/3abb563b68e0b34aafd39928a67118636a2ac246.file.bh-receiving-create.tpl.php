<?php /* Smarty version Smarty-3.1.13, created on 2016-03-03 16:08:21
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\merchant\views\receiving\bh-receiving-create.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3039556d7f0f59cc417-28820452%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3abb563b68e0b34aafd39928a67118636a2ac246' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\merchant\\views\\receiving\\bh-receiving-create.tpl',
      1 => 1455677484,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3039556d7f0f59cc417-28820452',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'iePorts' => 0,
    'item' => 0,
    'country' => 0,
    'tradeModes' => 0,
    'transModes' => 0,
    'formtypes' => 0,
    'formtype' => 0,
    'receiving' => 0,
    'trafModes' => 0,
    'wrapTypes' => 0,
    'wrapType' => 0,
    'customer' => 0,
    'dPort' => 0,
    'ePort' => 0,
    'organization' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56d7f0f5c4cb52_22514176',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56d7f0f5c4cb52_22514176')) {function content_56d7f0f5c4cb52_22514176($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\block.t.php';
?><style type="text/css">
    .box td{
        text-align: left;
    }
    #ASNForm tbody th{
        text-align: right;
        height: 20px;
        line-height: 20px;
        padding:5px;

    }
    #ASNForm tbody td{
        text-align: left;
        height: 20px;
        line-height: 20px;
        padding:5px;
    }
    *#ASNForm tbody span.error{
        top:auto;
    }
    span.error{
        top:auto;
    }
    a.dialog_link {
        margin-bottom: 5px;
        margin-top: 5px;
        padding: 10px;
        text-align: center;
       
        float:left;
    }
    .asndetailstrong {
        color: #FF0000;
        display: block;
        float: left;
        margin-right: 20px;
        margin-top: 15px;
    }
    #subProducts .textInput{
        float:none;;
    }
</style>


<div class="content-box ui-tabs ui-widget ui-widget-content ui-corner-all asncontent" style="display:block;"> 
<div class="content-box-header">
    <h3 style="margin-left:5px">入库单新增</h3>
    <div class="clear"></div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("merchant/views/receiving/receiving-import-inner.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<form  action="/merchant/receiving/create" method="post"  id='ASNForm' name="createForm" >
    <div id="create-asn-center" >
        <table class="pageFormContent">
            <tbody>
            <tr class="ReferenceCode">
				<td  class="nowarp text_right">申报口岸：</td>
                <td>
                   <select name="decl_port" class="required width155" id="decl_port">
                        <option value="">-Select-</option>
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['iePorts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
						 <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['ie_port'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['ie_port_name'];?>
</option>
						<?php } ?>
                    </select>&nbsp;<strong class="red">*</strong>
                </td>
                <td  class="nowarp text_right">进出口岸：</td>
                <td>
                    <select name="ie_port" class="required width155" id="ie_port">
                        <option value="">-Select-</option>
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['iePorts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
						 <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['ie_port'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['ie_port_name'];?>
</option>
						<?php } ?>
                    </select>&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			
			<tr class="ReferenceCode">
				<td   class="nowarp text_right">起运国：</td>
                <td>
					<select name="trade_country" class="required width155" id="trade_country">
                        <option value="">-Select-</option>
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['country']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['country_code'];?>
" <?php if ($_smarty_tpl->tpl_vars['item']->value['country_id']==49){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['country_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['item']->value['country_name_en'];?>
</option>
                        <?php } ?>
                    </select>&nbsp;<strong class="red">*</strong>
				</td>
				<td   class="nowarp text_right">目的港：</td>
                <td>
					<select name="destination_port" class="required width155" id="destination_port">
                        <option value="">-Select-</option>
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['country']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['trade_country'];?>
" <?php if ($_smarty_tpl->tpl_vars['item']->value['country_id']==49){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['country_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['item']->value['country_name_en'];?>
</option>
                        <?php } ?>
                    </select>&nbsp;<strong class="red">*</strong>
				</td>
			</tr>
            <tr class="ReferenceCode">
				<td  class="nowarp text_right">进出口类型：</td>
                <td>
                   <select name="ie_flag" class="required width155" id="ie_flag">
                        <option value="">-Select-</option>
                        <option value="I">进口</option>
						<option value="E">出口</option>
                    </select>&nbsp;<strong class="red">*</strong>
                </td>
				<td class='nowrap text_right'>监管方式 :</td>
                <td>
                    <select name="trade_mode" class="required width155" id="trade_mode">
                        <option value="">-Select-</option>
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tradeModes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['trade_mode'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['trade_mode_name'];?>
</option>
                        <?php } ?>
                    </select>&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			
			<tr class="ReferenceCode">
				<td class='nowrap text_right'>成交方式  :</td>
                <td>
                    <select name="trans_mode" class="required width155" id="trans_mode">
                        <option value="">-Select-</option>
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['transModes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['trans_mode'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['trans_mode_name'];?>
</option>
                        <?php } ?>
                    </select>&nbsp;<strong class="red">*</strong>
                </td>
                
				<td class='nowrap text_right'>业务类型:</td>
                <td>
					<select name="form_type" class="required width155">
						<option value="">-Select-</option>
                        <?php  $_smarty_tpl->tpl_vars['formtype'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['formtype']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['formtypes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['formtype']->key => $_smarty_tpl->tpl_vars['formtype']->value){
$_smarty_tpl->tpl_vars['formtype']->_loop = true;
?>
							<?php if ($_smarty_tpl->tpl_vars['formtype']->value['form_type']=='I1A'||$_smarty_tpl->tpl_vars['formtype']->value['form_type']=='I2A'){?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['formtype']->value['form_type'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&($_smarty_tpl->tpl_vars['receiving']->value['form_type']==$_smarty_tpl->tpl_vars['formtype']->value['form_type'])){?>selected<?php }?> ><?php echo $_smarty_tpl->tpl_vars['formtype']->value['form_type_name'];?>
</option>
							<?php }?>
                        <?php } ?>
                    </select>&nbsp;<strong class="red">*</strong>
                </td>
            </tr>			
			<tr class="ReferenceCode">
				<td class='nowrap text_right'>运输方式:</td>
                <td>
                    <select name="traf_mode" class="required width155" id="traf_mode">
                        <option value="">-Select-</option>
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['trafModes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['traf_mode'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['traf_mode_name'];?>
</option>
                        <?php } ?>
                    </select>&nbsp;<strong class="red">*</strong>
                </td>
				<td  class="nowarp text_right">出入库类型：</td>
                <td>
                   <select name="ie_mode" class="required width155" id="ie_mode">
                        <option value="">-Select-</option>
                        <option value="I">入库</option>
						<option value="E">出库</option>
                    </select>&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
				<td class='nowrap text_right'>外包装类型:</td>
                <td>
                    <select name='wrap_type' class="required width155">
                        <option value=""><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pleaseSelected<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
...</option>
                        <?php  $_smarty_tpl->tpl_vars['wrapType'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['wrapType']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['wrapTypes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['wrapType']->key => $_smarty_tpl->tpl_vars['wrapType']->value){
$_smarty_tpl->tpl_vars['wrapType']->_loop = true;
?>
                        <?php if ($_smarty_tpl->tpl_vars['wrapType']->value['wrap_type']!=''){?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['wrapType']->value['wrap_type'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&($_smarty_tpl->tpl_vars['receiving']->value['wrap_type']==$_smarty_tpl->tpl_vars['wrapType']->value['wrap_type'])){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['wrapType']->value['wrap_type_name'];?>
</option>
                        <?php }?>
                        <?php } ?>
                    </select>&nbsp;<strong class="red">*</strong>
                </td>
				<td   class="nowarp text_right">企业清单内部编号：</td>
                <td>
					 <input type="text" size="60" class="text-input width155 " value="" name="list_no" id="list_no">&nbsp;<strong class="red">*</strong>
				</td>
            </tr>
			<tr>
				<td  class="nowarp text_right">运输工具名称：</td>
                <td>
                    <input name="traf_name" class="text-input width155 " id="traf_name">&nbsp;<strong class="red">*</strong>
                </td>
                
				<td class='nowrap text_right'>航次:</td>
                <td>
                    <input type="text" size="60" class="text-input width155 " value="" name="voyage_no" id="voyage_no">
                </td>
            </tr>
			<tr>
				<td class='nowrap text_right'>经营单位代码  :</td>
                <td>
                    <input type="text" size="60" class="text-input width155 " value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['code'];?>
" name="trade_co" id="trade_co" readonly>&nbsp;<strong class="red">*</strong>
                </td>
				<td class='nowrap text_right'>经营单位名称:</td>
                <td>
                    <input type="text" size="60" class="text-input width155 " value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['company'];?>
" name="trade_name" id="trade_name" readonly>&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr>
				<td class='nowrap text_right'>仓储企业代码  :</td>
                <td>
                    <input type="text" size="60" class="text-input width155 " value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['code'];?>
" name="storage_co" id="trade_co" readonly>&nbsp;<strong class="red">*</strong>
                </td>
				<td class='nowrap text_right'>仓储企业名称:</td>
                <td>
                    <input type="text" size="60" class="text-input width155 " value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['company'];?>
" name="storage_name" id="trade_name" readonly>&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
            <tr class="ReferenceCode">
               
				<td class='nowrap text_right'>申报单位代码  :</td>
				
                <td>
                   <input type="text" size="60" class="text-input width155 " value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['code'];?>
" name="agent_code" id="agent_code" readonly>&nbsp;<strong class="red">*</strong>
                </td>
				<td class='nowrap text_right'>申报单位名称:</td>
                <td>
                    <input type="text" size="60" class="text-input width155 " value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['company'];?>
" name="agent_name" id="agent_name" readonly>
					&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
                
				<td class='nowrap text_right'>收（发）货单位  :</td>
                <td>
                   <input type="text" size="60" class="text-input width155 " value="" name="owner_code" id="owner_code" >&nbsp;<strong class="red">*</strong>
                </td>
				 <td   class="nowarp text_right">收（发）货单位名称：</td>
                <td><input type="text" size="60" class="text-input width155 " value="" name="owner_name" id="owner_name" >&nbsp;<strong class="red">*</strong></td>
            </tr>
            <tr class="ReferenceCode">
                <td   class="nowarp text_right">提运单号：</td>
                <td><input type="text" size="60" class="text-input width155 " value="<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['bill_no']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['bill_no'];?>
<?php }?>" name="bill_no" id="bill_no"><strong class="red">*</strong></td>
				<td  class="nowarp text_right">仓库账册号 ：</td>
                <td>
                   <input type="text" size="60" class="text-input width155 " value="" name="warehouse_code" id="warehouse_code">&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
            
            <tr>
                <td style="text-align:right">总<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
roughweight<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td><input type="text"  placeholder="0.000" class="text-input width155" name='roughweight' value='<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['roughweight']&&$_smarty_tpl->tpl_vars['receiving']->value['roughweight']!=0){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['roughweight'];?>
<?php }?>'> KG <strong class="red">*</strong>&nbsp;&nbsp;&nbsp;
				
				<!--<img src="/images/help.png">-->
				
				</a></td>
				
				<td style="text-align:right">总净重：</td>
                <td><input type="text"  placeholder="0.000" class="text-input width155" name='net_weight' value='<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['netweight']&&$_smarty_tpl->tpl_vars['receiving']->value['netweight']!=0){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['netweight'];?>
<?php }?>'> KG &nbsp;<strong class="red">*</strong></td>
				
            </tr>
            
            <tr>
			  <td class="nowrap text_right">件数：</td>
			  <td>
				<input type="text" class="text-input width155" name="pack_no" id="pack_no" value="<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['pack_no']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['pack_no'];?>
<?php }?>" />&nbsp;<strong class="red">*</strong>
				&nbsp;&nbsp;&nbsp;&nbsp;
				
				<!--<img src="/images/help.png" /></a>-->
			  </td>
			  <td class="nowrap text_right">入库日期：</td>
			  <td>
				<input type="text"
						class="datepicker text-input width140" value=""
						name="import_date" id="import_date" readonly="readonly" />&nbsp;<strong class="red">*</strong>
			  </td>
			</tr>
			
			<tr>
			  <td class="nowrap text_right">是否有废旧物品：</td>
			  <td>
				<input type="radio" name="waste_flag" id="waste_flag1" value="Y"/>&nbsp;<label for="waste_flag1">是</label>
				<input type="radio" name="waste_flag" id="waste_flag0" value="N"/>&nbsp;<label for="waste_flag0">否</label>
				<strong class="red">*</strong>
				<!--<img src="/images/help.png" /></a>-->
			  </td>
			  <td class="nowrap text_right">是否带有植物性包装及铺垫材料:</td>
			  <td>
				<input type="radio" name="pack_flag" id="pack_flag1" value="Y"/>&nbsp;<label for="pack_flag1">是</label>
				<input type="radio" name="pack_flag" id="pack_flag0" value="N"/>&nbsp;<label for="pack_flag0">否</label>
				<strong class="red">*</strong>
			  </td>
			</tr>
			<tr>
			  <td class="nowrap text_right">报检单号：</td>
			  <td>
				<input type="text" class="text-input width155" name="law_no" id="law_no" />&nbsp;<strong class="red">*</strong>
				&nbsp;&nbsp;&nbsp;&nbsp;
			  </td>
			  <td class="nowrap text_right">电商企业代码：</td>
			  <td>
				<input type="text" class="text-input width140" name="ebc_no" id="ebc_no" />&nbsp;<strong class="red">*</strong>
			  </td>
			</tr>
			<tr>
			  <td class="nowrap text_right">启运口岸：</td>
			  <td>
				<select name="desp_port" class="required width155" id="desp_port">
					<option value="">-Select-</option>
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['dPort']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['port_code'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['port_name'];?>
</option>
					<?php } ?>
                </select>&nbsp;<strong class="red">*</strong>
			  </td>
			  <td class="nowrap text_right">入境口岸：</td>
			  <td>
				<select name="entry_port" class="required width155" id="entry_port">
					<option value="">-Select-</option>
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ePort']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['port_code'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['port_name'];?>
</option>
					<?php } ?>
                </select>&nbsp;<strong class="red">*</strong>
			  </td>
			</tr>
			<tr>
			  <td class="nowrap text_right">施检机构：</td>
			  <td>
				<select name="check_org_code" class="required width155" id="check_org_code">
					<option value="">-Select-</option>
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['organization']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['organization_code'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['organization_name'];?>
</option>
					<?php } ?>
                </select>&nbsp;<strong class="red">*</strong>
			  </td>
			  <td class="nowrap text_right">目的机构：</td>
			  <td>
				<select name="org_code" class="required width155" id="org_code">
					<option value="">-Select-</option>
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['organization']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['organization_code'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['organization_name'];?>
</option>
					<?php } ?>
                </select>&nbsp;<strong class="red">*</strong>
			  </td>
			</tr>
			<tr>
			  <td class="nowrap text_right">申报人名称：</td>
			  <td>
				<input type="text" class="text-input width155" name="decl_person" id="decl_person" value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['account_name'];?>
"/>&nbsp;<strong class="red">*</strong>
				&nbsp;&nbsp;&nbsp;&nbsp;
			  </td>
			  <td class="nowrap text_right">提货单号:</td>
			  <td><input type="text" class="text-input width155" name="ciq_bill_no" id="ciq_bill_no" />&nbsp;<strong class="red">*</strong></td>
			</tr>
            <tr >
                <td style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
remark<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td colspan="3"><textarea rows="5" cols="80" id="notes" name="notes"><?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['notes']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['notes'];?>
<?php }?></textarea></td>
            </tr>

            <tr>
                <td>&nbsp;</td>
                <td colspan="3"><a  href="#" class="button tijiao" id='asnbutton'  onclick="dosubmit();return false;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
submit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
                </td>
            </tr>

            </tbody>
        </table>

    </div>

</form>
</div>
<div id="dialog" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SelectProduct<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"></div>
<div class="infoTips" id="messageTip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
InformationTips<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
">

</div>
    <div id="asndetailDialog" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
import_by_xls<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" style="display:none">
        <form action="/merchant/product/batch-input" method="post" id="asndetailForm">
            <table>
                <tr><th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
export_xls<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</th>
                    <td><input type="file" name="XMLForInput" />
                    </td></tr>
                <tr>
                    <th></th>
                    <td>
                        <p><img style="width:25px;" src="/images/download.png"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
download_templete<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:<a href="/merchant/product/select-product-templete" style="text-decoration:underline;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
product_template<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a></p>
                        
                    </td>
                </tr>
            </table>

            <table cellspacing="0" cellpadding="0" class="formtable tableborder">
                <thead>
                <tr>
                    <th width='200'>产品备案号</th>
                    <th width='70'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
operate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                </tr>
                </thead>
                <tbody id='batchAddTips'>
                </tbody>
            </table>
        </form>
    </div>


<script type="text/javascript">

$(function(){
	$(".datepicker").datepicker({ dateFormat: "yy-mm-dd"});
})
	
$('#dialog').dialog({
	autoOpen: false,
	modal: false,
	bgiframe:true,
	width: 1000,
	minHeight:500,
	height:500,			
	resizable: true
});
   
function dosubmit(){
	var options = {
	url:'/merchant/receiving/create',
	type:'POST',
	dataType:'json',
	success: function(data){
		var html ="";						
		if(data.ask==1){						
			$( "#messageTip").dialog({
				autoOpen: false,
				position:[50,50],
				close: function(event, ui) {locationToList();}
			});
			$('<div title="提示(Tip)">'+data.msg+'</div>').dialog({
				autoOpen: true,
				close: function(event, ui) {locationToList();},
				width: '320',
				position:[50,50],
				height: 'auto',
				modal: true,
				buttons: {
					'关闭(close)': function () {
						locationToList();
					}
				}
			});
			$("#messageTip").html(html);
		}else{
			$("#messageTip").html('');
			if (typeof(data.message) != "undefined")
			{
				html+=data.message+"<br/>";
			}
							
			$.each(data.error,function(idx,vitem){
			 html+=vitem+"<br/>";
			});
			$("#messageTip").html(html);

			$('#messageTip').dialog('open');
		}				
	}}; //显示操作提示

	$("#ASNForm").ajaxSubmit(options); 
	
	return false;
}  //end of function
function locationToList(){
   var url = "/merchant/receiving/listbh";
   parent.openMenuTab(url,"入库单列表",'入库单列表','1');   
}

$('#messageTip').dialog({
	autoOpen: false,
	modal: false,
	bgiframe:true,
	position:[50,50],
	width: 400,
	position:[50,50],
	resizable: true			
});
</script><?php }} ?>