<?php /* Smarty version Smarty-3.1.13, created on 2014-07-10 09:09:14
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/purchaseOrder/supplyAuxiliaryInput.tpl" */ ?>
<?php /*%%SmartyHeaderCode:105194758753bde7baaccb27-92436171%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '555382fb98e5005df3502700a03cfcf9c19eb242' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/purchaseOrder/supplyAuxiliaryInput.tpl',
      1 => 1404895720,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '105194758753bde7baaccb27-92436171',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page' => 0,
    'from' => 0,
    'pageSize' => 0,
    'params' => 0,
    'result' => 0,
    'item' => 0,
    'selected_supplier_code' => 0,
    'count' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53bde7bab751b8_89074299',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53bde7bab751b8_89074299')) {function content_53bde7bab751b8_89074299($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><div class="content-box  ui-tabs  ui-corner-all">
	<form action="/merchant/purchase-order/supplycode-auxiliary-input" method="post" id="pagerForm">
        <input type="hidden" name="page" value="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" id="page" />
		<input type="hidden" id="from" name="from" value="<?php echo $_smarty_tpl->tpl_vars['from']->value;?>
">
        <input type="hidden" name="pageSize" value="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" id="pageSizes" />
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td nowrap="nowrap">
                        
						<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
supplier_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：<input type="text" name="s_supplier_code" class="text-input fix-small-input" value="<?php echo $_smarty_tpl->tpl_vars['params']->value['supplier_code'];?>
"/>
					</td>
					
					
					<td nowrap="nowrap">
                        
						<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Supplier<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：<input type="text" name="s_supplier_name" class="text-input fix-small-input" value="<?php echo $_smarty_tpl->tpl_vars['params']->value['supplier_name'];?>
"/>
					</td>
					
				
					<td nowrap="nowrap">
					<a  class="button" href="#" onclick="do_search();return false;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
					
					</td>
				</tr>
			</table>
			
		</div>
	</form>



	<table class="table list" width="100%"  id="loadData" style="margin-bottom:10px;margin-top:15px">
		<thead class="caption">
			<tr>
				<th align="center" width='180' ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
supplier_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
				<th align="center" width='180' ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Supplier<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
				<th align="center" width="50"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Use<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
			
			</tr>
		</thead>
		<tbody>
			<?php if (count($_smarty_tpl->tpl_vars['result']->value)>0){?>
				<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
					<tr>
						<td><?php echo $_smarty_tpl->tpl_vars['item']->value['distributor_code'];?>
</td>	
						<td><?php echo $_smarty_tpl->tpl_vars['item']->value['distributor_name'];?>
</td>				
						<td style="text-align:center;width:30px"><input type="radio" name="pid"  supply_code="<?php echo $_smarty_tpl->tpl_vars['item']->value['distributor_code'];?>
"   class="<?php echo $_smarty_tpl->tpl_vars['from']->value;?>
actionSku" <?php if ($_smarty_tpl->tpl_vars['selected_supplier_code']->value==$_smarty_tpl->tpl_vars['item']->value['distributor_code']){?>checked<?php }?> /></td>
					</tr>					
				<?php } ?>	
			<?php }?>
		</tbody>
	</table>
		<div class="panelBar">
	
        <div class="pagination" id="Pagination1" totalCount="<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
" numPerPage="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" currentPage="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" ajaxfun='pageselectCallback'>
		</div>
		<div class="clear"></div>
		</div>
		
		</div>
		
	<script type="text/javascript">
	$(function(){
	//此demo通过Ajax加载分页元素
    var total = $('#Pagination1').attr('totalcount');
    var currencypage=$('#Pagination1').attr('currentpage');
    var pageSize = $('#pageSizes').val()||$('#Pagination1').attr('numperpage');
	var from = $('#from').val();

	var initPagination = function() {
		var num_entries = total;
		// 创建分页
		$("#Pagination1").pagination(num_entries, {
			num_edge_entries: 1, //边缘页数
			num_display_entries: 4, //主体页数
			callback: pageselectCallback,
			items_per_page: pageSize, //每页显示1项
			prev_text: "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Previous<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",
			next_text: "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Next<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",
			current_page:currencypage-1
		});
	 };
	 
	initPagination();
	function pageselectCallback(page_index, jq){
		
		var supplier_code = $("input[name='s_supplier_code']").val();
		var supplier_name = $("input[name='s_supplier_name']").val();		
        //var page_index = page_index||$('#current').val();
		getPurchaseOrderData(page_index+1,pageSize,supplier_code,supplier_name);
		return false;
	}
	
	

	
	
});

	function do_search(){	
			
		var supplier_code = $("input[name='s_supplier_code']").val();
		var supplier_name = $("input[name='s_supplier_name']").val();
        var pageSize = $('#pageSizes').val()||$('#Pagination1').attr('numperpage');
		getPurchaseOrderData(1,pageSize,supplier_code,supplier_name);
	
	}
	
$(function(){
   //按默认类   
    $("#loadData").alterBgColor();	
	var default_supplier_code = $('#supply_code').val();
	//$("input[name='s_supplier_code']").val(default_supplier_code);
	keepTheInterface();	
    //do_search();
});


	
	/*选则项要跟页面一致*/
	function keepTheInterface(){
		var default_supplier_code = $('#supply_code').val();		
		var pids = $("input[name='pid']");
		//alert(pids.size());
		if(pids.size()==0){return;}		
			pids.each(function(i){
				_this = $(this);				
				var supply_code = _this.attr('supply_code');
										
				if(default_supplier_code == supply_code){												
					_this.attr("checked",true);	
					set_tr_class(_this.parent().parent(), true);				
				}else{
					set_tr_class(_this.parent().parent(), false);	
					//_this.attr("checked",false);
				}
				/*
				if($("#asnproduct"+product_id).size()==0){					
					_this.attr("checked",false);
				}else{
					_this.attr("checked",true);
				}
				*/			
				
			}); 
			
	}		
	
	
	
	
	


	</script><?php }} ?>