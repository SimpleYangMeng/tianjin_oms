<?php /* Smarty version Smarty-3.1.13, created on 2016-02-17 14:20:54
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\storage\views\guarantee\list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2098056c41146bc1d13-25847662%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '202484685b8bbb67561d870e0c03d4465232e54c' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\storage\\views\\guarantee\\list.tpl',
      1 => 1455677486,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2098056c41146bc1d13-25847662',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'currency' => 0,
    'c' => 0,
    'data' => 0,
    'cTypes' => 0,
    'k' => 0,
    'status' => 0,
    'key' => 0,
    'item' => 0,
    'jsoncTypes' => 0,
    'jsonStatus' => 0,
    'customerLogin' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56c41146d31b32_46570566',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56c41146d31b32_46570566')) {function content_56c41146d31b32_46570566($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\block.t.php';
?><style type="text/css">
.adt{ width: 180px; height: 30px; border: none; }
th{ border: 1px solid #CCCCCC; height: 30px; text-align: center; }
#loadData>tr>td{ border:1px solid #CCCCCC; height:30px; }
.b-custom-select__title__text { margin-top: 3px;}
</style>
<script src="/js/init-my-page.js" type="text/javascript"></script>
<div class="content">
    <div class="content-box  ui-tabs  ui-corner-all ui-widget ui-widget-content">
        <div class="content-box-header">
            <h3  class="clearborder" style="margin-left:5px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
list_taxation_guarantee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
        </div>
        <div class="box-body">
            <form name="searchWaybillForm"  method="post" action="/storage/taxation-guarantee/list" id="pagerForm">
                <input type="hidden" name="page" value="1" id="page" />
                <input type="hidden" name="pageSize" value="20" id="pageSizes" />
                <table>
                    <tr>
						<td class="nowrap text_right" nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
customer_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</td>
						<td>
							 <input type="text" name="customer_code" id="customer_code" value="" class="text-input width100 "/>
						</td>
                        <!--
						<td class="nowrap text_right" nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
currency_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</td>
						<td>
							 <select class="text-input" id="currency_code" name="currency_code">
		                        <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['currency']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
		                            <option value='<?php echo $_smarty_tpl->tpl_vars['c']->value['code'];?>
'<?php if (!empty($_smarty_tpl->tpl_vars['data']->value)&&$_smarty_tpl->tpl_vars['data']->value['currency_code']==$_smarty_tpl->tpl_vars['c']->value['code']){?> selected<?php }elseif($_smarty_tpl->tpl_vars['c']->value['code']=='RMB'){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['name'];?>
 <?php echo $_smarty_tpl->tpl_vars['c']->value['code'];?>
</option>
		                        <?php } ?>
		                    </select>
						</td>
                        -->
						<td class="nowrap text_right" nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
guarantee_basis<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</td>
						<td>
							 <input type="text" name="guarantee_basis" id="guarantee_basis" value="" class="text-input width140 "/>
						</td>
                        <!--
                        <td class="nowrap text_right" nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
g_type<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</td>
                        <td>
                            <select class="text-input" id="g_type" name="g_type">
                                <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cTypes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['c']->key;
?>
                                    <option value='<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['c']->value;?>
</option>
                                <?php } ?>
                            </select>
                        </td>
                        -->
                        <td class="nowrap text_right" nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
createDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</td>
                        <td>
                            <input type="text" name="add_start_time" id="add_start_time" class="datepicker text-input width110" readonly="readonly" value="" />
                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
   
                            <input type="text" name="add_end_time" id="add_end_time" class="datepicker text-input width110" readonly="readonly" value="" />
                        </td>
                    </tr>
                    <tr>
                        <td class="nowrap text_right" nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</td>
                        <td>
                             <select class="text-input form_input" id="status" name="status">
                                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['status']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                                    <option value='<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</option>
                                <?php } ?>
                            </select>
                        </td>
                        <td><a class="button searchList">搜索</a></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <br/>
	<div class="box-body box">
	<form name="dataForm"  method="post" action="/storage/taxation-guarantee/list" id="inspectionForm">
	<div class="searchBar ">
		<table class="table table-bordered table-hover">
			<thead>
                <tr>
                    <!--<th style="width:2%;"><input type="checkbox" class="check-all"></th>-->
                    <th style="width:3%;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
g_type<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                    <th style="width:4%;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
guarantee_basis<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                    <th style="width:4%;">申报单位</th>
                    <!--<th style="width:4%;">企业名称</th>-->
                    <th style="width:4%;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
tg_value<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                    <th style="width:4%;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
currency_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                    <th style="width:4%"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
tg_bank_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                    <th style="width:6%;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
add_time<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                    <th style="width:4%;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                    <th style="width:5%;">操作</th>
                </tr>
			</thead>
			<tbody id="loadData" style="text-align:center;background-color:#F3F3F3;">
                 <tr>
                    <td colspan="15" style="border:1px solid #CCCCCC;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
NoDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
                </tr>
            </tbody>
		</table>
		</div>
	</form>
	</div>
	<div class="clear"></div>
	<div class="pagination"></div>
</div>
<!-- view begin-->
<div id="veiwDialog" style="display: none">
	<table cellpadding="0" cespacing="0" border="0" width="100%" class="formtable tableborder">
	<tbody>
		<tr>
			<td width="100" align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
g_type<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
			<td width="200" align="left"><span class="show_view_span blue" id="g_type_span"></span></td>
			<td width="120" align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
customs_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
			<td align="left"><span class="show_view_span blue" id="customs_code_span"></span></td>
		</tr>
		<tr>
            <td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
customer_company_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td align="left"><span class="show_view_span blue" id="customer_company_name_span"></span></td>
			<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
customer_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
			<td align="left"><span class="show_view_span blue" id="customer_code_span"></span></td>
		</tr>
            <td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
storage_customer_company_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td align="left"><span class="show_view_span blue" id="storage_customer_company_name_span"></span></td>
            <td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
storage_customer_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td align="left"><span class="show_view_span blue" id="storage_customer_code_span"></span></td>
		<tr>
        </tr>
        <tr>
			<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
tg_value<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
			<td align="left"><span class="show_view_span blue" id="tg_value_span"></span></td>
            <td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
currency_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td align="left"><span class="show_view_span blue" id="currency_code_span"></span></td>
		</tr>
		<tr>
			<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
tg_bank_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
			<td align="left"><span class="show_view_span blue" id="tg_bank_name_span"></span></td>
            <td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td align="left" colspan="3"><span class="show_view_span blue" id="status_span"></span></td>
			
		</tr>
		<tr>
			<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
tg_limit_time<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
			<td align="left"><span class="show_view_span blue" id="tg_limit_time_span"></span></td>
            <td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
tg_v_time<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td align="left"><span class="show_view_span blue" id="tg_v_time_span"></span></td>
		</tr>
		
        <tr>
            <td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
add_time<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td align="left"><span class="show_view_span blue" id="add_time_span"></span></td>
            <td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
updateTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td align="left"><span class="show_view_span blue" id="update_time_span"></span></td>
        </tr>
        <tr>
            <td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
guarantee_basis<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td align="left" colspan="3"><span class="show_view_span blue" id="guarantee_basis_span"></span></td>
        </tr>
        <tr>
            <td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
note<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
            <td align="left" colspan="3"><span class="show_view_span blue" id="note_span"></span></td>
        </tr>
	</tbody>
	</table>
</div>
<!-- view end-->
<script type="text/javascript">
    var jsoncTypes = <?php echo $_smarty_tpl->tpl_vars['jsoncTypes']->value;?>
;
	var jsonStatus = <?php echo $_smarty_tpl->tpl_vars['jsonStatus']->value;?>
;
    $(function(){
        loadData(0);
        $('.searchList').click(function(){
            loadData(0);
        });
        //切换搜索
        /*
        $('#currency_code').change(function (){
            $('.searchList').click();
        });
        $('#g_type').change(function (){
            $('.searchList').click();
        });
        */
        
        $('#status').change(function (){
            $('.searchList').click();
        });
        
        $('.check-all').click(function(){
            if($(this).is(':checked')){
                $('.check-single').prop('checked',true);
            }else{
                $('.check-single').prop('checked',false);
            }
        });

        //删除
        $('.deleteById').click(function(){
            var id = $(this).attr('data');
            width = 400;
            height = 'auto';
            $('<div title="提示(Esc退出)"><p align="center" style="color:red;">确定删除？</p></div>').dialog({
                autoOpen: true,
                width: width,
                height: height,
                modal: true,
                show:"slide",
                position:"top",
                buttons: {
                	'取消':function(){
                        $(this).dialog('close');
                    },
                    '确认': function() {
                        $(this).dialog('close');
                        deleteById(id);
                    }
                },
                close:function(){
                    $('.ui-dialog').remove();
                }
            });
        })
    });

    //加载数据
    function loadData(page,pageSize){
        var serachData = {
        	'page': page, 
        	'pageSize': pageSize, 
        	'g_type': $('#g_type').val(), 
        	'customer_code': $('#customer_code').val(), 
        	'currency_code': $('#currency_code').val(), 
        	'guarantee_basis': $('#guarantee_basis').val(),
        	'status': $('#status').val(),
            'add_start_time': $('#add_start_time').val(),
            'add_end_time': $('#add_end_time').val()
		};
        $('#loadData').html('');
        $.ajax({
            type:'post',
            dataType:'json',
            async:false,
            url: '/storage/taxation-guarantee/list',
            data: serachData,
            success:function(json){
                var html = '';
                paginationTotal = json.total;
                if(json.ask==1){
                    if(json.data.length>0){
                        $.each(json.data, function(k, v){
                            html += '<tr>';
                            /*
                            html += '<td style="text-align:center;width:2%;">';
                            html += '<input type="checkbox" class="check-single" value="'+v.order_code+'" name="oc">';
                            html += '</td>';
                            */
                            html += '<td style="text-align:center;width:3%;">'+ jsoncTypes[v.g_type] +'</td>';
                            html += '<td style="text-align:center;width:3%;">'+ v.guarantee_basis +'</td>';
                            html += '<td style="text-align:center;width:10%;">'+ v.storage_customer_code +'-'+ v.storage_customer_company_name +'</td>';
                        //    html += '<td style="text-align:center;width:12%;">'+ v.customer_code +'-'+ v.customer_company_name + '</td>';
                            html += '<td style="text-align:center;width:3%;">'+ v.tg_value +'</td>';
                            html += '<td style="text-align:center;width:3%;">'+ v.currency_code +'</td>';
                            html += '<td style="text-align:center;width:6%;">'+ v.tg_bank_name+'-'+ v.tg_bank_code +'</td>';
							html += '<td style="text-align:center;width:6%;">'+ v.add_time +'</td>';
							html += '<td style="text-align:center;width:3%;">'+ jsonStatus[v.status] +'</td>';
                            html += '<td style="text-align:center;width:5%;">';
                            html += '<a href="javascript:;" onclick="viewById(' + v.tg_id + ')">查看</a>';
                            /*
                            <?php if (isset($_smarty_tpl->tpl_vars['customerLogin']->value['customer_priv']['is_storage'])&&$_smarty_tpl->tpl_vars['customerLogin']->value['customer_priv']['is_storage']==1){?>
                            	//未发送状态的数据才能修改
								if(v.status == 0){
                            		html += '<span class="pipe">|</span><a onclick="parent.openMenuTab(\'/storage/taxation-guarantee/add?tg_id='+v.tg_id+'\',\'编辑税费担保\',\'edit_'+ v.tg_id +'\');return false;" href="#/storage/taxation-guarantee/add">编辑</a>';
                                    html += '<span class="pipe">|</span><a class="deleteById" data="'+v.tg_id+'">删除</a>';
                        		}else {
                                    html += '<span class="pipe">|</span><span>编辑</span>';
                                    html += '<span class="pipe">|</span><span>删除</span>';
                                }
                            <?php }?>
                            */
                            html += '</td>';
                            html += '</tr>';
                        });
                    }else{
                        html = '<tr><td colspan="15" style="border:1px solid #CCCCCC;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
NoDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td></tr>';
                    }
                }else{
                    html = '<tr><td colspan="15" style="border:1px solid #CCCCCC;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
NoDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td></tr>';
                }
                $('#loadData').html(html);
            }
        })
    }
    
	//删除
    function deleteById(id){
        $.ajax({
            type:'post',
            dataType:'json',
            async:false,
            url:'/storage/taxation-guarantee/delete',
            data:{'tg_id': id},
            success:function(json){
                if(json.ask==1){
                    loadData(0);
                }
                alertTip(json.message);
            }
        })
    }

    //查看详情
	function viewById(tg_id){
		var veiwDialog = $('#veiwDialog');
		var myoptions = {
			url:'/storage/taxation-guarantee/view',
			type:'POST',
			cache:false,		
			dataType:'json',
			processData:true,
			data:{'tg_id': tg_id},
			success: function(json){
				if(json.ask != 0){
					$.each( json.data, function(key, val) {
						$('#'+key+'_span').html(val);
						veiwDialog.dialog({
							title: '查看详情(View details)',
							autoOpen: true,
					        position: ['center', 100],
					        width: 740,
					        height: 'auto',
					        modal: true,
					        show: "slide",
					        buttons: {
					        	'关闭(Close)': function () {
					                $(this).dialog('close');
					            }
					        }
						});
					});
				}else{
					alertTip("get data error");
				}
			},
			error:function(a,b,c){
				alertTip("system error");
			}
		};
		$.ajax(myoptions);
	}
</script><?php }} ?>