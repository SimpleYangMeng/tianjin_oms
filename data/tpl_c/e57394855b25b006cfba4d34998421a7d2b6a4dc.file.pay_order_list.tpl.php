<?php /* Smarty version Smarty-3.1.13, created on 2015-11-16 09:23:03
         compiled from "D:\www\import_oms\branches\tianjin\application\modules\pay\views\payOrder\pay_order_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2553356458d34da4775-10635235%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e57394855b25b006cfba4d34998421a7d2b6a4dc' => 
    array (
      0 => 'D:\\www\\import_oms\\branches\\tianjin\\application\\modules\\pay\\views\\payOrder\\pay_order_list.tpl',
      1 => 1447406231,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2553356458d34da4775-10635235',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56458d34f423a4_45350586',
  'variables' => 
  array (
    'page' => 0,
    'pageSize' => 0,
    'condition' => 0,
    'payOrderStatus' => 0,
    'key' => 0,
    'item' => 0,
    'country' => 0,
    'c' => 0,
    'result' => 0,
    'row' => 0,
    'count' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56458d34f423a4_45350586')) {function content_56458d34f423a4_45350586($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\import_oms\\branches\\tianjin\\libs\\Smarty\\plugins\\block.t.php';
?><style type="text/css">
	table { border-collapse: collapse; border-spacing: 0; }
	label { cursor: pointer;}
	.table-list { background: #FFFFFF;}
	.table-list td,.table-list th{padding-left:6px;padding-right:6px;}
	.table-list tbody td,.table-list .btn{/*border-bottom: #4098CA 1px solid;*/ padding-top:5px; padding-bottom:5px;}
	.table-list tr:hover,.table-list table tbody tr:hover{ background:#fbffe4;}
	.table-list .input-text-c{ padding:0; height:18px;}
	.table-list tr.on,.table-list tr.on td,.table-list tr.on th,.table-list td.on,.table-list th.on{background:#fdf9e5;}
	.table-list td.center {text-align: center;}
	.td-line{border:1px solid #4098CA}
	.td-line td,.td-line th{border:1px solid #4098CA}
	.show_view_span { color: #0066CC;}
</style>
<div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pay_order_list<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
    </div>
    <div class="pageHeader">
        <form action="/pay/pay-order/pay-order-list" method="post" id="pagerForm">
            <input type="hidden" name="page" value="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" id="page" />
            <input type="hidden" name="pageSize" value="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" id="pageSizes"/>
            <div class="searchBar">
                <table>
                    <tr>
                        <td><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                        <td style="text-align: left;">
                            <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['order_code'];?>
" name="order_code" id="order_code" class="text-input width140 "/>
                        </td>
						<td><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
customerCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                        <td style=" text-align:left">
                            <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['customer_code'];?>
" name="customer_code" class="text-input width140 "/>
                        </td>
                        
                        <td><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
addTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                        <td style="text-align: left;">
							<input type="text" name="add_start_time" class="datepicker text-input width140" readonly="readonly" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['add_start_time'];?>
" />
							<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
	
							<input type="text" name="add_end_time" class="datepicker text-input width140" readonly="readonly" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['add_end_time'];?>
" />
                        </td>
                       
                    </tr>
                    <tr>
                    	<td><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
cosignee_telephone<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                        <td style=" text-align:left">
                            <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['cosignee_telephone'];?>
" name="cosignee_telephone" class="text-input width140 "/>
                        </td>
                        
						<td><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pay_order_status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                        <td style=" text-align:left">
                            <select name="status" id="status" class="fix-medium2-input"  >
								<option value=""><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pleaseSelected<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
...</option>
									<?php if ($_smarty_tpl->tpl_vars['payOrderStatus']->value!=''){?> 
										<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['payOrderStatus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?> 
											<option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"<?php if (isset($_smarty_tpl->tpl_vars['condition']->value)&&($_smarty_tpl->tpl_vars['condition']->value['status']==$_smarty_tpl->tpl_vars['key']->value)&&!empty($_smarty_tpl->tpl_vars['condition']->value['status'])){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</option>
										<?php } ?>
									<?php }?>
							</select>
                        </td>
                        
                        <td><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
cosignee_country<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                        <td style=" text-align:left">
                            <select name="cosignee_country_id" id='cosignee_country_id' class="text-input fix-medium2-input">
				                <option value="">--ALL--</option>
				                <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['country']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
				                	<option value='<?php echo $_smarty_tpl->tpl_vars['c']->value['country_id'];?>
' <?php if (isset($_smarty_tpl->tpl_vars['condition']->value)&&$_smarty_tpl->tpl_vars['condition']->value['cosignee_country_id']==$_smarty_tpl->tpl_vars['c']->value['country_id']){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['country_code'];?>
 <?php echo $_smarty_tpl->tpl_vars['c']->value['country_name'];?>
</option>
								<?php } ?>
							</select>
							<a class="button" id="serachBut" href="#" onclick="$('#pagerForm').submit();return false;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</div>
<form  method="post" enctype="multipart/form-data" id='DataForm'>
    <table class="table list" width="100%"  style="margin-top:5px;" id="finance-list-box">
        <thead>
	        <tr>
	            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
	            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
customerCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
	            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pay_order_status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
	            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
goods_purchase_price<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
				<th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
order_goods_freight<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
				<th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
cosignee_country<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
	            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
cosignee_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
	            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
cosignee_telephone<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
	            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
addTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
	            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
operate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
	        </tr>
        </thead>
        <tbody class="table-list">
        <?php if ($_smarty_tpl->tpl_vars['result']->value!=''&&count($_smarty_tpl->tpl_vars['result']->value)!=0){?>
        <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
            <tr>
                <td class="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['order_code'];?>
</td>
                <td class="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['customer_code'];?>
</td>
                <td class="center"><?php if ($_smarty_tpl->tpl_vars['row']->value['status']==1){?>正常<?php }elseif($_smarty_tpl->tpl_vars['row']->value['status']==2){?>禁用<?php }elseif($_smarty_tpl->tpl_vars['row']->value['status']==-1){?>删除<?php }?></td>
                <td class="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['goods_value'];?>
</td>
                <td class="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['freight_fee'];?>
</td>
				<td class="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['cosignee_country'];?>
</td>
                <td class="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['cosignee_name'];?>
</td>
                <td class="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['cosignee_telephone'];?>
</td>
                <td class="center" width="200"><?php echo $_smarty_tpl->tpl_vars['row']->value['add_time'];?>
</td>
                <td class="center" width="180">
					<a href="javascript:editById(<?php echo $_smarty_tpl->tpl_vars['row']->value['po_id'];?>
);">编辑</a>
					<span class="pipe">|</span>
					<a href="javascript:viewById(<?php echo $_smarty_tpl->tpl_vars['row']->value['po_id'];?>
);">查看</a>
					<span class="pipe">|</span>
					<a href="javascript:deleteById(<?php echo $_smarty_tpl->tpl_vars['row']->value['po_id'];?>
);">删除</a>
                </td>
            </tr>
            <?php } ?>
		<?php }else{ ?>
			<tr>
				 <td class="center" colspan="10">暂无无数据</td>
			</tr>
        <?php }?>
        </tbody>
    </table>
</form>
<div class="clear"></div>
<div class="panelBar">
    <div class="pagination" targetType="navTab" totalCount="<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
" numPerPage="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" currentPage="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"  pageNumShown="10"></div>
</div>

<div id="veiwDialog" style="display: none">
	<table cellpadding="0" cespacing="0" border="0" width="100%">
	<tbody>
		<tr>
			<td width="100" align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
			<td width="160" align="left"><span class="show_view_span" id="order_code_span"></span></td>
			<td width="120" align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
customerCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
			<td align="left"><span class="show_view_span" id="customer_code_span"></span></td>
		</tr>
		<tr>
			<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CustomerReference2<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
			<td align="left"><span class="show_view_span" id="reference_no_span"></span></td>
			<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pay_order_status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
			<td align="left"><span class="show_view_span" id="status_span"></span></td>
		</tr>
		<tr>
			<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
goods_purchase_price<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
			<td align="left"><span class="show_view_span" id="goods_value_span"></span></td>
			<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
order_goods_freight<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
			<td align="left"><span class="show_view_span" id="freight_fee_span"></span></td>
		</tr>
		<tr>
			<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Currency<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
			<td align="left"><span class="show_view_span" id="pay_currency_code_span"></span></td>
			<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
cosignee_country<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
			<td align="left"><span class="show_view_span" id="cosignee_country_id_span"></span></td>
		</tr>
		<tr>
			<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
cosignee_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
			<td align="left"><span class="show_view_span" id="cosignee_name_span"></span></td>
			<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
cosignee_address<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
			<td align="left"><span class="show_view_span" id="cosignee_address_span"></span></td>
		</tr>
		<tr>
			<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
cosignee_telephone<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
			<td align="left"><span class="show_view_span" id="cosignee_telephone_span"></span></td>
			<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pro_amount<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
			<td align="left"><span class="show_view_span" id="pro_amount_span"></span></td>
		</tr>
		<tr>
			<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pro_remark<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
			<td align="left" colspan="3"><span class="pro_remark_span" id="pro_amount_span"></span></td>
		</tr>
		<tr>
     		<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
note<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
			<td align="left" colspan="3"><span class="pro_remark_span" id="note_span"></span></td>
		</tr>
	</tbody>
	</table>
</div>
<script>
$(function(){
    //按默认类
    $("#finance-list-box").alterBgColor();
    $('#export').bind('click',function(){
        $('#export_dialog').dialog('open');
    });
});

//全选
$('.checkAll').die('click').live('click',function(){
    if ($(this).is(':checked')) {
        $(".Arr").attr('checked', true);

    } else {
        $(".Arr").attr('checked', false);
    }
    changeTrColor();
});

//伴随全选按钮是否选中而变色
function changeTrColor(){
    $(".Arr").each(function(){
        _this = $(this);
        if($('.checkAll').is(':checked')){
            set_tr_class(_this.parent().parent(), true);
        }else{
            set_tr_class(_this.parent().parent(), false);
        }
    });
}

//编辑
function editById(poId){
	parent.openMenuTab('/pay/pay-order/edit?poId='+poId, '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
编辑支付单<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
', 'pay-order-edit', '0');
}

//查看详情
function viewById(poId){
	var veiwDialog = $('#veiwDialog');
	var myoptions = {
		url:'/pay/pay-order/get-data-by-poid',
		type:'POST',
		cache:false,		
		dataType:'json',
		processData:true,
		data:{'poId': poId},
		success: function(json){
			if(json.state != 0){
				$.each( json.data, function(key, val) {
					$('#'+key+'_span').html(val);
					veiwDialog.dialog({
						title: '查看详情(View details)',
						autoOpen: true,
				        position: ['center', 100],
				        width: 640,
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
//删除
function deleteById(poId) {
    if (poId == '' || poId == undefined) {
    	alertTip('500 Data Error.');
		return false;
    }
    $('<div title="Tips-确认删除(Confirm deletion)？" class="dialog-confirm-del-alert-tip"><p style="text-align:left; color: red;">确认删除(Confirm deletion)？</p></div>').dialog({
        autoOpen: true,
        position: ['center', 100],
        width: 400,
        height: 'auto',
        modal: true,
        show: "slide",
        buttons: {
        	'取消(Cancel)': function () {
                $(this).dialog('close');
            },
            '确定(Ok)': function () {
            	var self = $(this);
                $.ajax({
                    type: "post",
                    async: false,
                    dataType: "json",
                    url: '/pay/pay-order/del',
                    data: {'opId': poId},
                    success: function (json) {
                    	/*
                    	if( json.state != 0 ){
                    		alertTip(json.message);
                    		self.dialog('close')
                    	}
                    	*/
                    	$('#serachBut').click();
                    }
                });
			//	$(this).dialog('close');
            }
        },
        close: function () {
            $(this).detach();
        }
    });
}
</script><?php }} ?>