<?php /* Smarty version Smarty-3.1.13, created on 2014-07-03 17:57:30
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/order/jh-order-list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:93576442853b3b6bb74f602-94371312%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dc40c31bfe8c199494007f7a5d0dda2354f86d36' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/order/jh-order-list.tpl',
      1 => 1404381403,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '93576442853b3b6bb74f602-94371312',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53b3b6bba58290_01082812',
  'variables' => 
  array (
    'page' => 0,
    'pageSize' => 0,
    'orders_status' => 0,
    'params' => 0,
    'warehouse' => 0,
    'w' => 0,
    'targetWarehouse' => 0,
    'shipType' => 0,
    'st' => 0,
    'orderStatusArr' => 0,
    'k' => 0,
    'v' => 0,
    'result' => 0,
    'item' => 0,
    'row' => 0,
    'count' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b3b6bba58290_01082812')) {function content_53b3b6bba58290_01082812($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><style type="text/css">
    .btn:hover, .btn:focus, .btn-active, .btn-sub {
        background: #5998D7;
        color: #333;
    }
	table td{border:1px solid none;}
</style>
<div class="content-box  ui-tabs  ui-corner-all ui-widget ui-widget-content">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CollectingOrderList<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
    </div>
    <form name="searchASNForm"  method="post" action="/merchant/order/listjh" id="pagerForm">
        <input type="hidden" name="page" value="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" id="page" />
        <input type="hidden" name="pageSize" value="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" id="pageSizes" />
        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['orders_status']->value;?>
" name="orders_status" class='status'>
        <input type="hidden" value="1" name="order_mode_type" id="order_mode_type">
        <input type="hidden" value="xls" name="dateformate" class='dateformate'>
        <div class="searchBar">
            <table  class="left searchbartable" cellspacing="2" cellpadding="2" id="searchbox" >
                <tbody>
                <tr>
                    <td nowrap="nowrap" class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
/<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
TradingOrderNo<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td>
                        <input type="text" class="text-input width120 leftloat" name="orders_code" id='orders_code' value="<?php echo $_smarty_tpl->tpl_vars['params']->value['order_code'];?>
">
					</td>
                    <td colspan="2">
                        <div class="simplesearchsubmit" style="float:left; margin-top:4px;">
                            <a  onclick="$('#pagerForm').submit()" class="button"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
                            <a type="button" class="button foldToggle" value="0"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Expand<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
/<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Collapse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
                            <a type="button" class="button export" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
order_export<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a> <a class="switch_search_model">切换到高级搜索</a>
                        </div>
                    </td>
                   
                </tr>

                <tr  class="advanced_element">
                    <td class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DeliveryWarehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td>
                        <select name="warehouse_id" class="text-input width135" style="width:135px;">
                            <option value="">-<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
all<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
-</option>
                            <?php  $_smarty_tpl->tpl_vars['w'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['w']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['warehouse']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['w']->key => $_smarty_tpl->tpl_vars['w']->value){
$_smarty_tpl->tpl_vars['w']->_loop = true;
?>
                            <option value='<?php echo $_smarty_tpl->tpl_vars['w']->value['warehouse_id'];?>
' <?php if (isset($_smarty_tpl->tpl_vars['params']->value)&&$_smarty_tpl->tpl_vars['params']->value['warehouse_id']==$_smarty_tpl->tpl_vars['w']->value['warehouse_id']){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['w']->value['warehouse_name'];?>
</option>
                            <?php } ?>
                        </select>
                    </td>
                    <td class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Targetwarehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td>
                        <select name="to_warehouse_id" class="text-input width135" style="width:135px;">
                            <option value="">-<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
all<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
-</option>
                            <?php  $_smarty_tpl->tpl_vars['w'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['w']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['targetWarehouse']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['w']->key => $_smarty_tpl->tpl_vars['w']->value){
$_smarty_tpl->tpl_vars['w']->_loop = true;
?>
                            <option value='<?php echo $_smarty_tpl->tpl_vars['w']->value['warehouse_id'];?>
' <?php if (isset($_smarty_tpl->tpl_vars['params']->value)&&$_smarty_tpl->tpl_vars['params']->value['to_warehouse_id']==$_smarty_tpl->tpl_vars['w']->value['warehouse_id']){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['w']->value['warehouse_name'];?>
</option>
                            <?php } ?>
                        </select>

                    </td>
                </tr>

                <tr  class="advanced_element">
                    <td class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
shippingMethod<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td align='left'>
                        <select name="shipping_method" class="text-input width135" style="width:135px;">
                            <option value="">-<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
all<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
-</option>
                            <?php  $_smarty_tpl->tpl_vars['st'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['st']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['shipType']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['st']->key => $_smarty_tpl->tpl_vars['st']->value){
$_smarty_tpl->tpl_vars['st']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['st']->key;
?>
                            <option value='<?php echo $_smarty_tpl->tpl_vars['st']->value;?>
' <?php if (isset($_smarty_tpl->tpl_vars['params']->value)&&$_smarty_tpl->tpl_vars['params']->value['sm_code']==$_smarty_tpl->tpl_vars['st']->value){?> selected<?php }?> ><?php echo $_smarty_tpl->tpl_vars['st']->value;?>
</option>
                            <?php } ?>
                        </select>
                    </td>
                    <td class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
createDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td >
                        <input type="text" class="datepicker text-input width120" value="<?php echo $_smarty_tpl->tpl_vars['params']->value['add_time_start'];?>
" name="add_time_start" readonly="true">&nbsp;<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
&nbsp;
                        <input type="text" class="datepicker text-input width120" value="<?php echo $_smarty_tpl->tpl_vars['params']->value['add_time_end'];?>
" name="add_time_end" readonly="true">
                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['orders_status']->value;?>
" name="orders_status" class="status">

                    </td>
                </tr>

                <tr class="advanced_element">
                    <td class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ShippingTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td colspan="3">
                        <input type="text" class="datepicker text-input width120" value="<?php echo $_smarty_tpl->tpl_vars['params']->value['shipDateFor'];?>
" name="shipDateFor" readonly="true">&nbsp;<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
&nbsp;
                        <input type="text" class="datepicker text-input width120" value="<?php echo $_smarty_tpl->tpl_vars['params']->value['shipDateTo'];?>
" name="shipDateTo" readonly="true">

                    </td>
                </tr>
				
				<tr class="advanced_element">
					<td colspan="6">
					   <div class="advancedsearchsubmit">
					    	<a  onclick="$('#pagerForm').submit()" class="button"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
                        	<a type="button" class="button foldToggle" value="0"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Expand<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
/<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Collapse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
                        	<a type="button" class="button export" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
order_export<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a> <a class="switch_search_model"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
switch_to_advanced_search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a> 					   
					   
					   </div>

						
						
					</td>
				</tr>
					
                </tbody>
            </table>

        </div>
    </form>

</div>


<div class="btn_wrap">
    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['orderStatusArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
    <input class="statusBtn btn<?php if ($_smarty_tpl->tpl_vars['orders_status']->value==$_smarty_tpl->tpl_vars['k']->value){?> btn-active<?php }?>" value="<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
" type='button' ref='<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
' id='statusBtn<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
'>
    <?php } ?>
</div>

<div class="bulk-actions align-left"  style="margin-top: 10px;margin-bottom:10px; border-radius: 4px 4px 4px 4px;">
<?php if ($_smarty_tpl->tpl_vars['orders_status']->value=="0"){?>
    <!--<select name="dropdown" class="text-input width120" id="batchSelect">
        <option value=''><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectOperating<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
        <option value='deleteToDraft'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
MoveDraft<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>-->
        <!--<option value='bacthDelete'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BatchDelete<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>-->
    <!--</select>-->
    <a class="button" href="#" onclick="movedraft();"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
MoveDraft<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
    <!--<a class="button" href="#" id="batchSubmit"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
submit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>-->
<?php }elseif($_smarty_tpl->tpl_vars['orders_status']->value=='1'){?>
   <!--<select name="dropdown" class="text-input width120" id="batchSelect">
        <option value=''><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectOperating<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
        <option value='bacthConfirm'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BatchConfirm<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
        <option value='bacthDelete'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BatchDelete<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
    </select>
    <a class="button" href="#" id="batchSubmit"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
submit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>-->
    <a class="button" href="#" onclick="bacthConfirm();"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BatchConfirm<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
    <a class="button" href="#" onclick="bacthDelete();"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BatchDelete<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>

<?php }elseif($_smarty_tpl->tpl_vars['orders_status']->value=='2'){?>
    <!--<select name="dropdown" class="text-input width120" id="batchSelect">
        <option value=''><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectOperating<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>-->
        <!--<option value='submitOrder'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SubmitOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option> -->
        <!--<option value='movedraft'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
MoveDraft<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
    </select>-->
    <!--<a class="button" href="#" id="batchSubmit"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
submit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>-->
    <!--<a class="button" href="#" onclick="submitOrder();"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SubmitOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>-->
    <a class="button" href="#" onclick="movedraft();"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
MoveDraft<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
<!--</div>-->
<?php }elseif($_smarty_tpl->tpl_vars['orders_status']->value=='3'){?>

    <!--<select name="dropdown" class="text-input width120" id="batchSelect">
        <option value=''><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectOperating<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
        <option value='submitOrder'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SubmitOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
    </select>
    <a class="button" href="#" id="batchSubmit"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
submit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>-->
    <a class="button" href="#" onclick="submitOrder();"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SubmitOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
<!--</div>-->
<?php }elseif($_smarty_tpl->tpl_vars['orders_status']->value=="4"){?>
    <a class="button" href="#" onclick="batchPrintCode();"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
batch_printLabel<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
<?php }?>
</div>
<div class="clear"></div>



    <form  method="post" id='orderDataForm' enctype="multipart/form-data">
        <table id="loadData"  class="table" width="100%" layoutH="138">
            <thead class="caption">
            <tr>
                <th style="text-align:center;width:30px;"><input type="checkbox" class="ordercheckAll"></th>
                <th  style="text-align:center;width:8em" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
				<th  style="text-align:center;width:11em" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CustomerReference<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                <?php if ($_smarty_tpl->tpl_vars['params']->value['order_status_from']=='8,9,10,11,12'||$_smarty_tpl->tpl_vars['params']->value['order_status_from']=='13'){?>
				<th style="text-align:center;" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ServiceTrackingNumber<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
				<?php }?>
                <th style="text-align:center;width:6em" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
shippingMethod<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                <th style="text-align:center;width:6em" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DeliveryWarehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                <th style="text-align:center;width:6em" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
consignee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
state<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                
				<?php if ($_smarty_tpl->tpl_vars['orders_status']->value=='8,9,10,11,12'){?>
				<th style="text-align:center;" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
charged_weight<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
				<?php }?>				
				<th style="text-align:center;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BuyerIdNumber<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                <th style="text-align:center;" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
createDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
				<?php if ($_smarty_tpl->tpl_vars['orders_status']->value=='18'){?>
				<th style="text-align:center;" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
               
				<?php }else{ ?>
				 <th style="text-align:center;" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
operate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
				<?php }?>                
				
            </tr>
            </thead>
            <tbody>
            <?php if ($_smarty_tpl->tpl_vars['result']->value!=''){?>
            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                <tr target="pid" rel="<?php echo $_smarty_tpl->tpl_vars['item']->value['order_id'];?>
">
                    <td width="30" style="text-align:center;"><input type="checkbox" name="orderArr[]" ref="<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
" class="orderArr" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
" /></td>
                    <td style="width:30px;text-align:center" nowrap="nowrap">&nbsp;<a href="javascript:void(0);" onclick="showProduct('<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
')"><?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
</a>&nbsp;</td>
                    <td style="width:30px;text-align:center" nowrap="nowrap">&nbsp;<a href="javascript:void(0);" onclick="showProduct('<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
')"><?php echo $_smarty_tpl->tpl_vars['item']->value['reference_no'];?>
</a>&nbsp;</td>                    
					<?php if ($_smarty_tpl->tpl_vars['params']->value['order_status_from']=='8,9,10,11,12'||$_smarty_tpl->tpl_vars['params']->value['order_status_from']=='13'){?>
					<td style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['item']->value['tracking_number'];?>
</td>
					<?php }?>
                    <td style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['item']->value['sm_code'];?>
</td>
                    <td style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['item']->value['warehouse_name'];?>
</td>
                    <td style="text-align:center;" ><?php echo $_smarty_tpl->tpl_vars['item']->value['province_name'];?>
</td>
                    
					<?php if ($_smarty_tpl->tpl_vars['orders_status']->value=='8,9,10,11,12'){?>
							<td style="text-align:center"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['item']->value['charged_weight'])===null||$tmp==='' ? 0 : $tmp);?>
 KG</td>
					<?php }?>
					<td style="text-align:center;"><?php echo $_smarty_tpl->tpl_vars['item']->value['idNumber'];?>
</td>
					<td style="text-align:center" nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['item']->value['add_time'];?>
</td>
                    <td style="text-align:center">
						<?php if ($_smarty_tpl->tpl_vars['orders_status']->value=='18'){?>
					
						<?php if ($_smarty_tpl->tpl_vars['item']->value['order_status']=='0'){?>
						删除
						<?php }elseif($_smarty_tpl->tpl_vars['item']->value['order_status']=='1'){?>	
						草稿					
						<?php }elseif($_smarty_tpl->tpl_vars['item']->value['order_status']=='2'){?>
						确认						
						<?php }elseif($_smarty_tpl->tpl_vars['item']->value['order_status']=='4'){?>						
						已提交
						<?php }elseif($_smarty_tpl->tpl_vars['item']->value['order_status']=='5'||$_smarty_tpl->tpl_vars['item']->value['order_status']=='6'||$_smarty_tpl->tpl_vars['item']->value['order_status']=='7'){?>
						操作中
						<?php }elseif($_smarty_tpl->tpl_vars['item']->value['order_status']=='8'||$_smarty_tpl->tpl_vars['item']->value['order_status']=='9'||$_smarty_tpl->tpl_vars['item']->value['order_status']=='10'||$_smarty_tpl->tpl_vars['item']->value['order_status']=='11'||$_smarty_tpl->tpl_vars['item']->value['order_status']=='12'){?>						
						仓库出货
						<?php }elseif($_smarty_tpl->tpl_vars['item']->value['order_status']=='13'){?>
						已签收
						<?php }else{ ?>
						未知
						<?php }?>
               
					<?php }else{ ?>					
                        <!--<a class="button" href="/merchant/order/create?ordersCode=<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
" target="dialog" rel="dlg_page9" max="true" minable='false' resizable='false'><span>修改</span></a>-->
                        <!--<a class="edit" href="/merchant/order/create?ordersCode=<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
" target="navTab" rel=''  title="修改订单" ><span>修改</span></a>-->
                        <a class="edit" href="/merchant/order/detail?ordersCode=<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
"   onclick="parent.openMenuTab('/merchant/order/detail?ordersCode=<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
)','orderdetail<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
');return false;" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"  ><span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
view<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span></a>

                        <!--<a class="delete" href="/merchant/order/del?productId=<?php echo $_smarty_tpl->tpl_vars['item']->value['product_id'];?>
" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a>-->
                        <?php if ($_smarty_tpl->tpl_vars['item']->value['order_status']=='1'){?>
                        <a class="edit" href="/merchant/order/create?ordersCode=<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
"  onclick="parent.openMenuTab('/merchant/order/create?ordersCode=<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
EditOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
)','orderedit<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
');return false;" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
EditOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"  ><span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
edit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span></a>

                        <?php }elseif($_smarty_tpl->tpl_vars['item']->value['order_status']=='2'){?>

                        <?php }?>
						<?php }?>
                    </td>
                </tr>
                <tr class="order_product son"    id="<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
" status="0">
                    <td colspan="10" >
                        <table style="float:left;width:100%; margin:0;padding:0;border:1px solid #CCCCCC;border-collapse:collapse;">
                            <tr class="son">
                                <td  style="text-align:center"  nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
skuCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
                                <td  style="text-align:center"  nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
quantity<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
                                <td  style="text-align:center"  nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductCategory<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
                                <td  style="text-align:center"  nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
totalweight<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(KG)</td>
                                <td  style="text-align:center"  nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
declaredValue<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
                            </tr>
                            <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item']->value['order_product']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                            <tr  class="son">
                                <td style="text-align:center" nowrap="nowrap">
                                    <a class="edit"   onclick="parent.openMenuTab('/merchant/product/detail?productId=<?php echo $_smarty_tpl->tpl_vars['row']->value['product_id'];?>
','产品详细(<?php echo $_smarty_tpl->tpl_vars['row']->value['product_sku'];?>
)','productdetail<?php echo $_smarty_tpl->tpl_vars['row']->value['product_id'];?>
');return false;" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" rel="productView"
                                        href="/merchant/product/detail?productId=<?php echo $_smarty_tpl->tpl_vars['row']->value['product_id'];?>
">
                                        <span><?php echo $_smarty_tpl->tpl_vars['row']->value['product_sku'];?>
</span>
                                    </a></td>
                                <td style="text-align:center" nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['row']->value['op_quantity'];?>
</td>
                                <td style="text-align:center" nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['row']->value['category_name'];?>
</td>
                                <td style="text-align:center" nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['row']->value['totalWeight'];?>
</td>
                                <td style="text-align:center" nowrap="nowrap"><!--<?php echo $_smarty_tpl->tpl_vars['row']->value['totalValue'];?>
!-->&nbsp;</td>
                            </tr>
                            <?php } ?>
                        </table>
                    </td>
                </tr>
                <?php } ?>
            <?php }else{ ?>
            <tr>
                <td colspan="10"  style="text-align:center;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
NoDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
            </tr>
            <?php }?>
            
            </tbody>
        </table>
    </form>

    <!--<div class="panelBar">
        <div class="pages">
            <span>显示</span>
            <select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
                <option value="10" <?php if ($_smarty_tpl->tpl_vars['pageSize']->value==10){?>selected<?php }?>>10</option>
                <option value="20" <?php if ($_smarty_tpl->tpl_vars['pageSize']->value==20){?>selected<?php }?>>20</option>
                <option value="50" <?php if ($_smarty_tpl->tpl_vars['pageSize']->value==50){?>selected<?php }?>>50</option>
                <option value="100" <?php if ($_smarty_tpl->tpl_vars['pageSize']->value==100){?>selected<?php }?>>100</option>
            </select>
            <span>条，共<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
条数据</span>
        </div>
    </div>-->
<div class="clear"></div>	
<div class="pagination" targetType="navTab" totalCount="<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
" numPerPage="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" currentPage="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"></div>

<div id="dialog" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
order_export<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" style="display:none">
    <input type="radio" name="exportType" value="1" checked="checked"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
selected_orders<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<input type="radio" name="exportType" value="0"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
all<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <!--<input type="radio" name="exportformat" value="csv">csv
    <input type="radio" name="exportformat" value="xls" checked="checked">xls-->
</div>
<script>
$(function(){
   //按默认类   
    $("#loadData").alterBgColor();
	$("#searchbox").switchToAdvancedSearch({button_id:'.switch_search_model',class_name:'advanced_element',cookName:"bhlist_search_mode"});
    
})
</script>
<!--<script type="text/javascript" src='/js/order.js'></script>-->
<script type="text/javascript" src='/loadjs/loadjs/name/order'></script>
<script>
    $(function(){  
      	//$("#loadData").colResizable();

        $('#dialog').dialog({
            autoOpen: false,
            modal: false,
            bgiframe:true,
            width: 850,
            resizable: true,
            close:function(){
                //alert('close');
            },buttons:{
                '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
close<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
                    $('#dialog').dialog('close');
                },'<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Determine<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {

                    var exportType = $('[name=exportType]:checked').val();
                    //var exportformat = $('[name=exportformat]:checked').val();
					var exportformat = 'xls';				
                    $('.dateformate').val(exportformat);
                    if(exportType=='1'){
                        //选择的订单
                        /* var exportformat = $('[name=exportformat]').val();
                         param+="&exportType="+exportType;
                         param+="&exportformat="+exportformat;

                         alert(exportType);*/

                        var param = $("#orderDataForm").serialize();						
                        var checkedSizesize = $('.orderArr:checked').size();
                        if(checkedSizesize<=0){
                            alertTip("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectAtLeastOneOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",'500','auto','1');
                            return;
                        }
                        //alert($('#pagerForm').attr('action'));

                        $('#orderDataForm').attr('action','/merchant/order/export');
                        $('#orderDataForm').attr('method','POST');
                        $('#orderDataForm').submit();						
                        //$('#orderDataForm').removeAttr('action');
                        //$('#orderDataForm').removeAttr('method');

                    }else if(exportType=='0'){
                        //全部的订单
                        $('#pagerForm').attr('action','/merchant/order/export');
                        $('#pagerForm').attr('method','POST');
                        $('#pagerForm').submit();
                        $('#pagerForm').attr('action','/merchant/order/listjh');
                        //$('#orderDataForm').removeAttr('method');

                    }
                    return;
                }
            }
        });
        $('.export').bind('click',function(){

            $('#dialog').dialog('open');
        });
    }); 
</script><?php }} ?>