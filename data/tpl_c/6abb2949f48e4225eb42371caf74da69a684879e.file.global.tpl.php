<?php /* Smarty version Smarty-3.1.13, created on 2014-07-02 14:07:54
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/default/global.tpl" */ ?>
<?php /*%%SmartyHeaderCode:44662334753b3a1baa32881-53389073%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6abb2949f48e4225eb42371caf74da69a684879e' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/default/global.tpl',
      1 => 1398048657,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '44662334753b3a1baa32881-53389073',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'currency' => 0,
    'aBalance' => 0,
    'customerAPIArray' => 0,
    'customer_id' => 0,
    'warehouseBH' => 0,
    'v' => 0,
    'asnStatBHAll' => 0,
    'warehouseJH' => 0,
    'asnStatJHAll' => 0,
    'orderStatBH' => 0,
    'orderStatJH' => 0,
    'asnStatJH' => 0,
    'asnStatBH' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53b3a1babc6117_50077737',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b3a1babc6117_50077737')) {function content_53b3a1babc6117_50077737($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><style type="text/css">
.ntitle {	
	padding: 0 10px;
	background: #F1F1F1;
	height: 30px;
	line-height: 30px;
}

h2.ntitle {
	font-size: 14px;
	font-weight: bold;
	line-height: 30px;
}

/*index*/
.nbox_c {	
	float: left;
	margin: 0px 0px 20px 0px;
	padding: 0px;
	width: 100%;
	border: 0px solid #DDD;
	overflow: hidden;
	border: 1px solid #D8D8D8;
}


.formtable {
	width: 100%;
	/*table-layout: fixed;*/
	border: 0px;
}

.formtable th, .formtable td {
	padding: 5px 10px;
	border-bottom: 0px solid #F2F2F2;
	vertical-align: top;
	line-height: 1.5em;
	word-wrap: break-word;
	word-break: break-all;
}


.right-title {
	background: #F1F1F1;
	font-size: 14px;
	font-weight: bold;
	height: 20px;
	padding: 12px 0 8px 13px;
	text-shadow: 1px 1px 1px #FFFFFF;
}
</style>


<div class="content-box  ui-tabs  ui-corner-all ">
 		<div class="content-box-header">
        	<h3 style="margin-left:5px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
globalBillboard<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
        	<div class="clear"></div>
 		</div>	
	
		<div style=" width: 45%;  float: left;  margin: 10px 0px 0px 15px; ">
			<div class="nbox_c">
				<div class="ntitle">
					<span style="display:block; float: left;">
						<h2 class="ntitle" style="padding-left: 0px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
balance_information<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h2>
					</span>
				</div>
				<table cellspacing="0" cellpadding="0" class="formtable">
					<tbody>
						<tr>
							<td><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
available_amount<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(<?php echo $_smarty_tpl->tpl_vars['currency']->value;?>
)</td>
							<td width="120" style="text-align:right;"><?php echo $_smarty_tpl->tpl_vars['aBalance']->value['cb_value'];?>
</td>
						</tr>					
						<tr>
							<td><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Amountfrozen<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(<?php echo $_smarty_tpl->tpl_vars['currency']->value;?>
)</td>
							<td width="120" style="text-align:right;"><?php echo $_smarty_tpl->tpl_vars['aBalance']->value['cb_hold_value'];?>
</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:right;">
								<a href="/merchant/finance/list"  onclick="parent.openMenuTab('/merchant/finance/list','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CurrencyBalance<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
','CurrencyBalance');return false;">More</a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>			
		</div>
		
		<div style='width:46%; float:right; margin: 10px 15px 0px 0px;'>
			
			<div class="nbox_c" style="height:116px;">
				<div class="ntitle">
					<span style="display:block; float: left;">
						<h2 class="ntitle" style="padding-left: 0px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
interface_info<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h2>
					</span>
                    <span id="interface" style="display:block; float: right; ">
                        <?php if ($_smarty_tpl->tpl_vars['customerAPIArray']->value['ca_token']){?>
                            <a onclick="changeToken('<?php echo $_smarty_tpl->tpl_vars['customer_id']->value;?>
');" href="javascript:void(0);"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
change_interface_info<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
                        <?php }else{ ?>
                            <a onclick="requireToken('<?php echo $_smarty_tpl->tpl_vars['customer_id']->value;?>
');" href="javascript:void(0);"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
request_interface_info<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
                        <?php }?>
                    </span>
				</div>
				<table cellspacing="0" cellpadding="0" class="formtable">
					<tbody>
						<tr>
							<td style="width:50px;">Token</td>
							<td id="ca_token"><?php echo $_smarty_tpl->tpl_vars['customerAPIArray']->value['ca_token'];?>
</td>
						</tr>					
						<tr>
							<td>Key</td>
							<td id="ca_key"><?php echo $_smarty_tpl->tpl_vars['customerAPIArray']->value['ca_key'];?>
</td>
						</tr>
					</tbody>
				</table>
			</div>
									
		</div>			
			
		<div class='clear'></div>
		
		<div class="right-title"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
not_finish_tasks<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>
		
		
		<div style=" width: 45%;  float: left;  margin: 10px 0px 0px 10px; ">			
		<div class="nbox_c">
			<div class="ntitle">
				<span style="display:block; float: left;">
					<h2 class="ntitle" style="padding-left: 0px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
StockingASN<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h2>
				</span> 
				<span style="display:block; float: right; ">
					<select style="margin-top: 5px;" name="bhasn" onchange="getAsnDataBH(this.value)">
						<option value="0">-All-</option>
						<?php  $_smarty_tpl->tpl_vars["v"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["v"]->_loop = false;
 $_smarty_tpl->tpl_vars["k"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['warehouseBH']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["v"]->key => $_smarty_tpl->tpl_vars["v"]->value){
$_smarty_tpl->tpl_vars["v"]->_loop = true;
 $_smarty_tpl->tpl_vars["k"]->value = $_smarty_tpl->tpl_vars["v"]->key;
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['warehouse_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['warehouse_name'];?>
</option> 
						<?php } ?>
					</select>					
				</span>
			</div>
			<table cellspacing="0" cellpadding="0" class="formtable">
				<tbody id="asnDataBH">
				<?php  $_smarty_tpl->tpl_vars["v"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["v"]->_loop = false;
 $_smarty_tpl->tpl_vars["k"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['asnStatBHAll']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["v"]->key => $_smarty_tpl->tpl_vars["v"]->value){
$_smarty_tpl->tpl_vars["v"]->_loop = true;
 $_smarty_tpl->tpl_vars["k"]->value = $_smarty_tpl->tpl_vars["v"]->key;
?>
					<tr><td style="width:50%;"><?php echo $_smarty_tpl->tpl_vars['v']->value['text'];?>
</td><td style="text-align:right;"><?php echo $_smarty_tpl->tpl_vars['v']->value['num'];?>
</td></tr>					
				<?php } ?>					
					<tr>
						<td colspan="2" style="text-align:right;">
							<a href="/merchant/receiving/listbh" onclick="parent.openMenuTab('/merchant/receiving/listbh','备货ASN列表','StockingASNList');return false;">More</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
			
		<div class="nbox_c">
			<div class="ntitle">
				<span style="display:block; float: left;">
					<h2 class="ntitle" style="padding-left: 0px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CollectionASN<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h2>
				</span> 
				<span style="display:block; float: right; ">
					<select style="margin-top: 5px;" name="bhasn" onchange="getAsnDataJH(this.value)">
						<option value="0">-All-</option>
						<?php  $_smarty_tpl->tpl_vars["v"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["v"]->_loop = false;
 $_smarty_tpl->tpl_vars["k"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['warehouseJH']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["v"]->key => $_smarty_tpl->tpl_vars["v"]->value){
$_smarty_tpl->tpl_vars["v"]->_loop = true;
 $_smarty_tpl->tpl_vars["k"]->value = $_smarty_tpl->tpl_vars["v"]->key;
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['warehouse_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['warehouse_name'];?>
</option> 
						<?php } ?>
					</select>					
				</span>
			</div>
			<table cellspacing="0" cellpadding="0" class="formtable">
				<tbody id="asnDataJH">
				<?php  $_smarty_tpl->tpl_vars["v"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["v"]->_loop = false;
 $_smarty_tpl->tpl_vars["k"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['asnStatJHAll']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["v"]->key => $_smarty_tpl->tpl_vars["v"]->value){
$_smarty_tpl->tpl_vars["v"]->_loop = true;
 $_smarty_tpl->tpl_vars["k"]->value = $_smarty_tpl->tpl_vars["v"]->key;
?>
					<tr><td style="width:50%;"><?php echo $_smarty_tpl->tpl_vars['v']->value['text'];?>
</td><td style="text-align:right;"><?php echo $_smarty_tpl->tpl_vars['v']->value['num'];?>
</td></tr>					
				<?php } ?>					
					<tr>
						<td colspan="2" style="text-align:right;">
							<a href="/merchant/receiving/listjh" onclick="parent.openMenuTab('/merchant/receiving/listjh','集货ASN列表','CollectionASNList');return false;">More</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		
	</div>
	
	<div style='width:47%; float:right; margin: 10px 10px 0px 0px;'>
	
		<div style="float: right;" class="nbox_c">
			<div class="ntitle">
				<span style="display:block; float: left;">
					<h2 class="ntitle" style="padding-left: 0px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
StockingOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h2>
				</span> 
				<span style="display:block; float: right; ">
					<select style="margin-top: 5px;" name="bhorder" onchange="getOrderData(0, this.value)">
						<option value="0">-All-</option>
						<?php  $_smarty_tpl->tpl_vars["v"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["v"]->_loop = false;
 $_smarty_tpl->tpl_vars["k"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['warehouseBH']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["v"]->key => $_smarty_tpl->tpl_vars["v"]->value){
$_smarty_tpl->tpl_vars["v"]->_loop = true;
 $_smarty_tpl->tpl_vars["k"]->value = $_smarty_tpl->tpl_vars["v"]->key;
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['warehouse_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['warehouse_name'];?>
</option> 
						<?php } ?>
					</select>					
				</span>
			</div>
			<table cellspacing="0" cellpadding="0" class="formtable">
				<tbody id="orderDataBH">
				<?php  $_smarty_tpl->tpl_vars["v"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["v"]->_loop = false;
 $_smarty_tpl->tpl_vars["k"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['orderStatBH']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["v"]->key => $_smarty_tpl->tpl_vars["v"]->value){
$_smarty_tpl->tpl_vars["v"]->_loop = true;
 $_smarty_tpl->tpl_vars["k"]->value = $_smarty_tpl->tpl_vars["v"]->key;
?>
					<tr><td style="width:50%;"><?php echo $_smarty_tpl->tpl_vars['v']->value['text'];?>
</td><td style="text-align:right;"><?php echo $_smarty_tpl->tpl_vars['v']->value['num'];?>
</td></tr>					
				<?php } ?>					
					<tr>
						<td colspan="2" style="text-align:right;">
							<a href="/merchant/order/listbh" onclick="parent.openMenuTab('/merchant/order/listbh','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
StockingOrderList<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
','StockingOrderList');return false;">More</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	
		<div style="float: right;" class="nbox_c">
			<div class="ntitle">
				<span style="display:block; float: left;">
					<h2 class="ntitle" style="padding-left: 0px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CollectionOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h2>
				</span> 
				<span style="display:block; float: right; ">
					<select style="margin-top: 5px;" name="jhorder" onchange="getOrderData(1, this.value)">
						<option value="0">-All-</option>
						<?php  $_smarty_tpl->tpl_vars["v"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["v"]->_loop = false;
 $_smarty_tpl->tpl_vars["k"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['warehouseJH']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["v"]->key => $_smarty_tpl->tpl_vars["v"]->value){
$_smarty_tpl->tpl_vars["v"]->_loop = true;
 $_smarty_tpl->tpl_vars["k"]->value = $_smarty_tpl->tpl_vars["v"]->key;
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['warehouse_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['warehouse_name'];?>
</option> 
						<?php } ?>
					</select>					
				</span>
			</div>
			<table cellspacing="0" cellpadding="0" class="formtable">
				<tbody id="orderDataJH">
				<?php  $_smarty_tpl->tpl_vars["v"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["v"]->_loop = false;
 $_smarty_tpl->tpl_vars["k"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['orderStatJH']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["v"]->key => $_smarty_tpl->tpl_vars["v"]->value){
$_smarty_tpl->tpl_vars["v"]->_loop = true;
 $_smarty_tpl->tpl_vars["k"]->value = $_smarty_tpl->tpl_vars["v"]->key;
?>
					<tr><td style="width:50%;"><?php echo $_smarty_tpl->tpl_vars['v']->value['text'];?>
</td><td style="text-align:right;"><?php echo $_smarty_tpl->tpl_vars['v']->value['num'];?>
</td></tr>					
				<?php } ?>					
					<tr>
						<td colspan="2" style="text-align:right;">
							<a href="/merchant/order/listjh" onclick="parent.openMenuTab('/merchant/order/listjh','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CollectingOrderList<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
','CollectingOrderList');return false;">More</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	
	</div>
	<div class='clear'></div>
		
</div>

<!-- <div class="content-box  ui-tabs  ui-corner-all" style="margin-top:20px;">
	<div class="content-box-header">
		<h3 style="margin-left:5px">快速浏览您的未完成任务</h3>
		<div class="clear"></div>
	</div>
	
	<div style=" width: 45%;  float: left;  margin: 10px 0px 0px 10px; ">			
		<div class="nbox_c">
			<div class="ntitle">
				<span style="display:block; float: left;">
					<h2 class="ntitle" style="padding-left: 0px;">备货ASN</h2>
				</span> 
				<span style="display:block; float: right; ">
					<select style="margin-top: 5px;" name="bhasn" onchange="getAsnDataBH(this.value)">
						<option value="0">-All-</option>
						<?php  $_smarty_tpl->tpl_vars["v"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["v"]->_loop = false;
 $_smarty_tpl->tpl_vars["k"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['warehouseBH']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["v"]->key => $_smarty_tpl->tpl_vars["v"]->value){
$_smarty_tpl->tpl_vars["v"]->_loop = true;
 $_smarty_tpl->tpl_vars["k"]->value = $_smarty_tpl->tpl_vars["v"]->key;
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['warehouse_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['warehouse_name'];?>
</option> 
						<?php } ?>
					</select>					
				</span>
			</div>
			<table cellspacing="0" cellpadding="0" class="formtable">
				<tbody id="asnDataBH">
				<?php  $_smarty_tpl->tpl_vars["v"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["v"]->_loop = false;
 $_smarty_tpl->tpl_vars["k"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['asnStatBHAll']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["v"]->key => $_smarty_tpl->tpl_vars["v"]->value){
$_smarty_tpl->tpl_vars["v"]->_loop = true;
 $_smarty_tpl->tpl_vars["k"]->value = $_smarty_tpl->tpl_vars["v"]->key;
?>
					<tr><td style="width:50%;"><?php echo $_smarty_tpl->tpl_vars['v']->value['text'];?>
</td><td style="text-align:right;"><?php echo $_smarty_tpl->tpl_vars['v']->value['num'];?>
</td></tr>					
				<?php } ?>					
					<tr>
						<td colspan="2" style="text-align:right;">
							<a href="/merchant/receiving/listbh">More</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
			
		<div class="nbox_c">
			<div class="ntitle">
				<span style="display:block; float: left;">
					<h2 class="ntitle" style="padding-left: 0px;">集货ASN</h2>
				</span> 
				<span style="display:block; float: right; ">
					<select style="margin-top: 5px;" name="bhasn" onchange="getAsnDataJH(this.value)">
						<option value="0">-All-</option>
						<?php  $_smarty_tpl->tpl_vars["v"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["v"]->_loop = false;
 $_smarty_tpl->tpl_vars["k"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['warehouseJH']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["v"]->key => $_smarty_tpl->tpl_vars["v"]->value){
$_smarty_tpl->tpl_vars["v"]->_loop = true;
 $_smarty_tpl->tpl_vars["k"]->value = $_smarty_tpl->tpl_vars["v"]->key;
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['warehouse_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['warehouse_name'];?>
</option> 
						<?php } ?>
					</select>					
				</span>
			</div>
			<table cellspacing="0" cellpadding="0" class="formtable">
				<tbody id="asnDataJH">
				<?php  $_smarty_tpl->tpl_vars["v"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["v"]->_loop = false;
 $_smarty_tpl->tpl_vars["k"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['asnStatJHAll']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["v"]->key => $_smarty_tpl->tpl_vars["v"]->value){
$_smarty_tpl->tpl_vars["v"]->_loop = true;
 $_smarty_tpl->tpl_vars["k"]->value = $_smarty_tpl->tpl_vars["v"]->key;
?>
					<tr><td style="width:50%;"><?php echo $_smarty_tpl->tpl_vars['v']->value['text'];?>
</td><td style="text-align:right;"><?php echo $_smarty_tpl->tpl_vars['v']->value['num'];?>
</td></tr>					
				<?php } ?>					
					<tr>
						<td colspan="2" style="text-align:right;">
							<a href="/merchant/receiving/listjh">More</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		
	</div>
	
	<div style='width:47%; float:right; margin: 10px 10px 0px 0px;'>
	
		<div style="float: right;" class="nbox_c">
			<div class="ntitle">
				<span style="display:block; float: left;">
					<h2 class="ntitle" style="padding-left: 0px;">备货订单</h2>
				</span> 
				<span style="display:block; float: right; ">
					<select style="margin-top: 5px;" name="bhorder" onchange="getOrderData(0, this.value)">
						<option value="0">-All-</option>
						<?php  $_smarty_tpl->tpl_vars["v"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["v"]->_loop = false;
 $_smarty_tpl->tpl_vars["k"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['warehouseBH']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["v"]->key => $_smarty_tpl->tpl_vars["v"]->value){
$_smarty_tpl->tpl_vars["v"]->_loop = true;
 $_smarty_tpl->tpl_vars["k"]->value = $_smarty_tpl->tpl_vars["v"]->key;
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['warehouse_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['warehouse_name'];?>
</option> 
						<?php } ?>
					</select>					
				</span>
			</div>
			<table cellspacing="0" cellpadding="0" class="formtable">
				<tbody id="orderDataBH">
				<?php  $_smarty_tpl->tpl_vars["v"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["v"]->_loop = false;
 $_smarty_tpl->tpl_vars["k"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['orderStatBH']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["v"]->key => $_smarty_tpl->tpl_vars["v"]->value){
$_smarty_tpl->tpl_vars["v"]->_loop = true;
 $_smarty_tpl->tpl_vars["k"]->value = $_smarty_tpl->tpl_vars["v"]->key;
?>
					<tr><td style="width:50%;"><?php echo $_smarty_tpl->tpl_vars['v']->value['text'];?>
</td><td style="text-align:right;"><?php echo $_smarty_tpl->tpl_vars['v']->value['num'];?>
</td></tr>					
				<?php } ?>					
					<tr>
						<td colspan="2" style="text-align:right;">
							<a href="/merchant/order/listbh">More</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	
		<div style="float: right;" class="nbox_c">
			<div class="ntitle">
				<span style="display:block; float: left;">
					<h2 class="ntitle" style="padding-left: 0px;">集货订单</h2>
				</span> 
				<span style="display:block; float: right; ">
					<select style="margin-top: 5px;" name="jhorder" onchange="getOrderData(1, this.value)">
						<option value="0">-All-</option>
						<?php  $_smarty_tpl->tpl_vars["v"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["v"]->_loop = false;
 $_smarty_tpl->tpl_vars["k"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['warehouseJH']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["v"]->key => $_smarty_tpl->tpl_vars["v"]->value){
$_smarty_tpl->tpl_vars["v"]->_loop = true;
 $_smarty_tpl->tpl_vars["k"]->value = $_smarty_tpl->tpl_vars["v"]->key;
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['warehouse_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['warehouse_name'];?>
</option> 
						<?php } ?>
					</select>					
				</span>
			</div>
			<table cellspacing="0" cellpadding="0" class="formtable">
				<tbody id="orderDataJH">
				<?php  $_smarty_tpl->tpl_vars["v"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["v"]->_loop = false;
 $_smarty_tpl->tpl_vars["k"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['orderStatJH']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["v"]->key => $_smarty_tpl->tpl_vars["v"]->value){
$_smarty_tpl->tpl_vars["v"]->_loop = true;
 $_smarty_tpl->tpl_vars["k"]->value = $_smarty_tpl->tpl_vars["v"]->key;
?>
					<tr><td style="width:50%;"><?php echo $_smarty_tpl->tpl_vars['v']->value['text'];?>
</td><td style="text-align:right;"><?php echo $_smarty_tpl->tpl_vars['v']->value['num'];?>
</td></tr>					
				<?php } ?>					
					<tr>
						<td colspan="2" style="text-align:right;">
							<a href="/merchant/order/listjh">More</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	
	</div>
	<div class='clear'></div>
</div> -->

<script type="text/javascript">
//集货ASN
var asnStatJH = <?php echo $_smarty_tpl->tpl_vars['asnStatJH']->value;?>
;
function getAsnDataJH(warehouse_id) {
	var trs = '';
	$.each(asnStatJH[warehouse_id], function(key, row){
		trs += '<tr><td style="width:50%;">'+row.text+'</td><td style="text-align:right;">'+row.num+'</td></tr>';
	});
	trs += '<tr><td colspan="2" style="text-align:right;"><a href="/merchant/receiving/listjh">More</a></td></tr>';
	$('#asnDataJH').html(trs);
}
//备货ASN
var asnStatBH = <?php echo $_smarty_tpl->tpl_vars['asnStatBH']->value;?>
;
function getAsnDataBH(warehouse_id) {
	var trs = '';
	$.each(asnStatBH[warehouse_id], function(key, row){
		trs += '<tr><td style="width:50%;">'+row.text+'</td><td style="text-align:right;">'+row.num+'</td></tr>';
	});
	trs += '<tr><td colspan="2" style="text-align:right;"><a href="/merchant/receiving/listbh">More</a></td></tr>';
	$('#asnDataBH').html(trs);
}
//订单统计
function getOrderData(mode_type, warehouse_id) {
	$.post('/merchant/order/stat',{'mode_type':mode_type, 'warehouse_id':warehouse_id},function(data){
		var trs = '';
		$.each(data, function(key, row){
			trs += '<tr><td style="width:50%;">'+row.text+'</td><td style="text-align:right;">'+row.num+'</td></tr>';
		});
		if(mode_type==0) {
			trs += '<tr><td colspan="2" style="text-align:right;"><a href="/merchant/order/listbh">More</a></td></tr>';
			$('#orderDataBH').html(trs);
		} else if(mode_type==1) {
			trs += '<tr><td colspan="2" style="text-align:right;"><a href="/merchant/order/listjh">More</a></td></tr>';
			$('#orderDataJH').html(trs);
		}
	},'json');
}

function changeToken(id){
    $.ajax({
        async:true,
        type:'POST',
        url:'/merchant/customer/change-token/id/'+id,
        dataType:'json',
        success:function(json){
            if(json.state=="1"){
                $("#ca_token").html(json.data.token);
                $("#ca_key").html(json.data.key);
                alertTip('接口变更成功!');
            }else{
                alertTip('接口变更失败!');
            }
        }
    });
}

function requireToken(id){
    $.ajax({
        async:true,
        type:'POST',
        url:'/merchant/customer/require-token/id/'+id,
        dataType:'json',
        success:function(json){
            if(json.state=="1"){
                $("#ca_token").html(json.data.token);
                $("#ca_key").html(json.data.key);
                alertTip('接口申请成功!');
                $("#interface").html('<a onclick="changeToken(\'<?php echo $_smarty_tpl->tpl_vars['customer_id']->value;?>
\');" href="javascript:void(0);">变更接口信息</a>');
            }else{
                alertTip('接口申请失败!');
            }
        }
    });
}
</script><?php }} ?>