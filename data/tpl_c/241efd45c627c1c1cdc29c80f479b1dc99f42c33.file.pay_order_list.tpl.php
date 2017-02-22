<?php /* Smarty version Smarty-3.1.13, created on 2016-03-04 10:31:21
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\pay\views\payOrder\pay_order_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:576456d8ecc89de8f5-15226908%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '241efd45c627c1c1cdc29c80f479b1dc99f42c33' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\pay\\views\\payOrder\\pay_order_list.tpl',
      1 => 1457058677,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '576456d8ecc89de8f5-15226908',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56d8ecc8cd19e9_30066541',
  'variables' => 
  array (
    'page' => 0,
    'pageSize' => 0,
    'condition' => 0,
    'appStatus' => 0,
    'key' => 0,
    'item' => 0,
    'customerLogin' => 0,
    'ciqStatus' => 0,
    'appStatusGroupRows' => 0,
    'appStatusRow' => 0,
    'result' => 0,
    'row' => 0,
    'payOrderAppTypes' => 0,
    'count' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56d8ecc8cd19e9_30066541')) {function content_56d8ecc8cd19e9_30066541($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\block.t.php';
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
            <input type="hidden" name="app_status" id="app_status" value="" />
            <div class="searchBar">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
payNo<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                        <td style="text-align: left;">
                            <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['pay_no'];?>
" name="pay_no" id="pay_no" class="text-input width110 "/>
                        </td>
                        <!-- <td><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
app_status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
                        <td style="text-align: left;">
                        	<select name='app_status'>
                        		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['appStatus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                        		<option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" <?php if (isset($_smarty_tpl->tpl_vars['condition']->value['app_status'])&&$_smarty_tpl->tpl_vars['condition']->value['app_status']==$_smarty_tpl->tpl_vars['key']->value){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</option>
                        		<?php } ?>
                        	</select>
                        </td> -->
                        <?php if (isset($_smarty_tpl->tpl_vars['customerLogin']->value['customer_priv']['is_pay'])&&$_smarty_tpl->tpl_vars['customerLogin']->value['customer_priv']['is_pay']==1){?>
						<td>电商企业代码：</td>
                        <td style="text-align:left">
                            <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['customer_code'];?>
" name="customer_code" class="text-input width110 "/>
                        </td>
                        <?php }else{ ?>
                        <td>支付企业<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
customerCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                        <td style="text-align:left">
                            <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['pay_customer_code'];?>
" name="pay_customer_code" class="text-input width110 "/>
                        </td>
                        <?php }?>
                        <td><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
addTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                        <td style="text-align: left;">
							<input type="text" name="add_start_time" class="datepicker text-input width110" readonly="readonly" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['add_start_time'];?>
" />
							<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
	
							<input type="text" name="add_end_time" class="datepicker text-input width110" readonly="readonly" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['add_end_time'];?>
" />
                        </td>
					</tr>
					<tr>                       
                        <td><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
po_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                        <td style="text-align: left;">
                            <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['po_code'];?>
" name="po_code" id="po_code" class="text-input width110 "/>
                        </td>
                        <td><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
reference_no<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                        <td style="text-align: left;">
                            <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['reference_no'];?>
" name="reference_no" id="reference_no" class="text-input width110 "/>
                        </td>
                        <td>检验检疫状态：</td>
                        <td style="text-align: left;">
                            <select name="ciq_status">
                                <option value="" <?php if ($_smarty_tpl->tpl_vars['condition']->value['ciq_status']===''){?>selected<?php }?>>全部</option>
                                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ciqStatus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['condition']->value['ciq_status']!==''&&$_smarty_tpl->tpl_vars['condition']->value['ciq_status']==$_smarty_tpl->tpl_vars['key']->value){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</option>
                                <?php } ?>
                            </select>
                            <a class="button" id="serachBut" href="javascript:void(0);" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</div>

<div class="btn_wrap">
	<input class="statusBtn btn <?php if (empty($_smarty_tpl->tpl_vars['condition']->value['app_status'])&&!is_numeric($_smarty_tpl->tpl_vars['condition']->value['app_status'])){?>btn-active<?php }?>" value="全部(<?php echo $_smarty_tpl->tpl_vars['appStatusGroupRows']->value['app_statusTotal'];?>
)" name="app_status" type='button' />
    <?php  $_smarty_tpl->tpl_vars['appStatusRow'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['appStatusRow']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['appStatus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['appStatusRow']->key => $_smarty_tpl->tpl_vars['appStatusRow']->value){
$_smarty_tpl->tpl_vars['appStatusRow']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['appStatusRow']->key;
?>
	    <?php if (isset($_smarty_tpl->tpl_vars['appStatusGroupRows']->value[$_smarty_tpl->tpl_vars['key']->value])){?>
	    	<input class="statusBtn btn<?php if ($_smarty_tpl->tpl_vars['condition']->value['app_status']==$_smarty_tpl->tpl_vars['key']->value&&is_numeric($_smarty_tpl->tpl_vars['condition']->value['app_status'])){?> btn-active<?php }?>" value="<?php echo $_smarty_tpl->tpl_vars['appStatusRow']->value;?>
(<?php echo $_smarty_tpl->tpl_vars['appStatusGroupRows']->value[$_smarty_tpl->tpl_vars['key']->value];?>
)" type='button' ref='<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
'>
	    <?php }else{ ?>
	    	<input class="statusBtn btn<?php if ($_smarty_tpl->tpl_vars['condition']->value['app_status']==$_smarty_tpl->tpl_vars['key']->value&&is_numeric($_smarty_tpl->tpl_vars['condition']->value['app_status'])){?> btn-active<?php }?>" value="<?php echo $_smarty_tpl->tpl_vars['appStatusRow']->value;?>
(0)" type='button' ref='<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
'>
	    <?php }?>
    <?php } ?>
</div>

<form  method="post" enctype="multipart/form-data" id='DataForm'>
    <table class="table list" width="100%"  style="margin-top:5px;" id="finance-list-box">
        <thead>
	        <tr>
                <th style="width: 160px;">
                <?php if (isset($_smarty_tpl->tpl_vars['customerLogin']->value['customer_priv']['is_pay'])&&$_smarty_tpl->tpl_vars['customerLogin']->value['customer_priv']['is_pay']==1){?>
                电商<?php }else{ ?>支付<?php }?><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
企业代码<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                </th>
                <th style="width: 70px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
payNo<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                <th style="width: 60px;">平台单号</th>
	            <th style="width: 70px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
reference_no<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
	            
				<th style="width: 60px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pay_amount<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
				<th style="width: 70px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
cosignee_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
	            <th style="width: 70px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
cosignee_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
	            <th style="width: 60px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
app_type<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
	            <th style="width: 140px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
状态<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
	            <th style="width: 120px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
addTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
	            <th style="width: 80px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
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
            	<?php if (isset($_smarty_tpl->tpl_vars['customerLogin']->value['customer_priv']['is_pay'])&&$_smarty_tpl->tpl_vars['customerLogin']->value['customer_priv']['is_pay']==1){?>
                <td class="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['customer_data'];?>
</td>
                <?php }else{ ?>
                <td class="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['pay_customer_data'];?>
</td>
                <?php }?>
                <td class="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['pay_no'];?>
</td>
                <td class="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['po_code'];?>
</td>
                <td class="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['reference_no'];?>
</td>
                
                <td class="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['pay_amount'];?>
</td>
				<td class="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['cosignee_code'];?>
</td>
                <td class="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['cosignee_name'];?>
</td>
                <td class="center"><?php echo $_smarty_tpl->tpl_vars['payOrderAppTypes']->value[$_smarty_tpl->tpl_vars['row']->value['app_type']];?>
</td>
                <td class="center">海关：<?php echo $_smarty_tpl->tpl_vars['appStatus']->value[$_smarty_tpl->tpl_vars['row']->value['app_status']];?>
<br/>检验检疫：<?php echo $_smarty_tpl->tpl_vars['ciqStatus']->value[$_smarty_tpl->tpl_vars['row']->value['ciq_status']];?>
</td>
                <td class="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['add_time'];?>
</td>
                <td class="center">
					<a href="javascript:viewById(<?php echo $_smarty_tpl->tpl_vars['row']->value['po_id'];?>
);">查看</a>
						<?php if (isset($_smarty_tpl->tpl_vars['customerLogin']->value['customer_priv']['is_pay'])&&$_smarty_tpl->tpl_vars['customerLogin']->value['customer_priv']['is_pay']==1){?>
							<?php if ($_smarty_tpl->tpl_vars['row']->value['app_status']==3||$_smarty_tpl->tpl_vars['row']->value['app_status']==1){?>
								<span class="pipe">|</span>
								<a href="javascript:editById(<?php echo $_smarty_tpl->tpl_vars['row']->value['po_id'];?>
);">编辑</a>
								<!--
								<span class="pipe">|</span>
								<a href="javascript:deleteById(<?php echo $_smarty_tpl->tpl_vars['row']->value['po_id'];?>
);">删除</a>
								-->
							<?php }?>
						<?php }?>
                </td>
            </tr>
            <?php } ?>
		<?php }else{ ?>
			<tr>
				 <td class="center" colspan="11">暂无无数据</td>
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
	<div class="cl">
		<table cellpadding="0" cespacing="0" border="0" width="100%" class="formtable tableborder">
			<tbody>
				<tr>
					<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
po_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td align="left" colspan="3"><span class="show_view_span blue" id="po_code_span"></span></td>
				</tr>
				<tr>
					<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
payNo<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td align="left"><span class="show_view_span blue" id="pay_no_span"></span></td>
					<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CustomerReference<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td align="left"><span class="show_view_span blue" id="reference_no_span"></span></td>
				</tr>
				<tr>
					<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
app_type<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td align="left"><span class="show_view_span blue" id="app_type_span"></span></td>
					<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
app_time<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td align="left"><span class="show_view_span blue" id="app_time_span"></span></td>
				</tr>
				<tr>
					<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
customer_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td align="left"><span class="show_view_span blue" id="customer_code_span"></span></td>
					<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
enp_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td align="left"><span class="show_view_span blue" id="enp_name_span"></span></td>
				</tr>
				<tr>
					<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
电商平台代码<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td align="left"><span class="show_view_span blue" id="ecommerce_platform_customer_code_span"></span></td>
					<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ecommerce_platform_customer_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td align="left"><span class="show_view_span blue" id="ecommerce_platform_customer_name_span"></span></td>
				</tr>
				<tr>
					<!--
					<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pay_type<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td align="left"><span class="show_view_span blue" id="pay_type_span"></span></td>
					-->
                    <td align="right">支付企业<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
代码<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td align="left"><span class="show_view_span blue" id="pay_customer_code_span"></span></td>
					<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pay_enp_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td align="left"><span class="show_view_span blue" id="pay_enp_name_span"></span></td>
					
				</tr>
				<tr>
					<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
app_status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td align="left"><span class="show_view_span blue" id="app_status_span"></span></td>
					<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
add_time<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td align="left"><span class="show_view_span blue" id="add_time_span"></span></td>
				</tr>
				<tr>
					<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
cosignee_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td align="left"><span class="show_view_span blue" id="cosignee_name_span"></span></td>
					<td align="right">支付币制：</td>
					<td align="left"><span class="show_view_span blue" id="pay_currency_code_span"></span></td>
				</tr>
				<tr>
					<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
cosignee_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td align="left"><span class="show_view_span blue" id="cosignee_code_span"></span></td>
					<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pay_amount<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td align="left"><span class="show_view_span blue" id="pay_amount_span"></span></td>
				</tr>
				<tr>
                    <td align="right">检验检疫状态：</td>
                    <td align="left"><span class="show_view_span blue" id="ciq_status_span"></span></td>
					<td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
note<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
					<td align="left"><span class="show_view_span blue" id="note_span"></span></td>
				</tr>
			</tbody>
		</table>
	</div>

	<!-- log begin-->
    <div class="cl">
        <div class="tabs_header cl content-box-header" style="margin: 4px 0 4px;">
            <ul class="tabs cl" style="padding-top: 2px;">
                <li class='active'><a href="javascript:;" class='tab'><span>支付单日志</span></a></li> 
            </ul>
        </div>
        <div class='tabContent'>
            <table width="100%" cellspacing="0" cellpadding="0" class="formtable tableborder sTable">
                <thead>
	                <tr>
	                    <th>变化前状态</th>
	                    <th>变化后状态</th>
	                    <th>操作时间</th>
	                    <th>操作IP</th>
	                    <th>操作人</th>
                        <th>类型</th>
	                    <th>备注</th>
	                </tr>
                </thead>
                <tbody id="payOrderLogList"></tbody>
            </table>
        </div>
    </div>
    <!-- log end-->

</div>
<script>
$(function(){
    //按默认类
    $("#finance-list-box").alterBgColor();
    $('#export').bind('click',function(){
        $('#export_dialog').dialog('open');
    });

    //切换提交
    $('.statusBtn').click(function (){
    	var appStatus = ($(this).attr('ref'));
    	$('#app_status').val(appStatus);
		$('#serachBut').click();
    });

    //表单提交
    $('#serachBut').click(function (){
    	/*
    	if($('#app_status').val() == 0){
    		$('#app_status').val(0);
    	}
    	*/
    	$('#pagerForm').submit();
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
	var logHtml = '';
	var myoptions = {
		url:'/pay/pay-order/get-data-by-poid',
		type:'POST',
		cache:false,		
		dataType:'json',
		processData:true,
		data:{'poId': poId},
		success: function(json){
			if(json.ask != 0){
				$.each( json.data, function(key, val) {
					//写入数据
					$('#'+key+'_span').html(val);
				});

				//写入日志
				if(json.log){
					$.each(json.log, function(logKey, logVal){
						logHtml += '<tr>';
                        if(logVal.status_type == '1'){
                            logHtml += '<td>' + logVal.pl_status_from + '</td>';
                            logHtml += '<td>' + logVal.pl_status_to + '</td>';
                        }else{
                            logHtml += '<td>' + logVal.ciq_status_from + '</td>';
                            logHtml += '<td>' + logVal.ciq_status_to + '</td>';
                        }
						logHtml += '<td>' + logVal.pl_add_time + '</td>';
						logHtml += '<td>' + logVal.pl_ip + '</td>';
						logHtml += '<td>' + logVal.account_name + '</td>';
                        logHtml += '<td>' + (logVal.status_type == '1' ? '海关' : '检验检疫') + '</td>';
						logHtml += '<td>' + logVal.pl_comments + '</td>';
						logHtml += '</tr>';
					});
				}

				$('#payOrderLogList').html(logHtml);
				veiwDialog.dialog({
						title: '查看详情(View details)',
						autoOpen: true,
				        position: ['center', 100],
				        width: 800,
				        height: 'auto',
				        modal: true,
				        show: "slide",
				        buttons: {
				        	'关闭(Close)': function () {
				                $(this).dialog('close');
				            }
				        }
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
                    	if( json.ask == 0 ){
                    		alertTip(json.message);
                    		self.dialog('close')
                    	}else{
                    		$('#serachBut').click();
                    	}
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