<?php /* Smarty version Smarty-3.1.13, created on 2015-11-16 09:29:23
         compiled from "D:\www\import_oms\branches\tianjin\application\modules\merchant\views\product\hscodeAuxiliaryInput.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2004856493173781e44-61325450%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '217b1123de8272b3ace4e39fcc563981c08f6fe9' => 
    array (
      0 => 'D:\\www\\import_oms\\branches\\tianjin\\application\\modules\\merchant\\views\\product\\hscodeAuxiliaryInput.tpl',
      1 => 1446033128,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2004856493173781e44-61325450',
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
    'globals_hs_code' => 0,
    'count' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56493173858ed3_06449855',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56493173858ed3_06449855')) {function content_56493173858ed3_06449855($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\import_oms\\branches\\tianjin\\libs\\Smarty\\plugins\\block.t.php';
?><!--海关编码辅助输入!-->
<div class="content-box  ui-tabs  ui-corner-all">
	<form action="/merchant/product/hscode-auxiliary-input" method="post" id="pagerForm">
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
CustomsCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：<input type="text" name="s_hs_code" class="text-input fix-small-input" value="<?php echo $_smarty_tpl->tpl_vars['params']->value['hs_code'];?>
"/>
					</td>
					
					
					<td nowrap="nowrap">
                        
						<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pname<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：<input type="text" name="p_name" class="text-input fix-small-input" value="<?php echo $_smarty_tpl->tpl_vars['params']->value['p_name'];?>
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
CustomsCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
				<th align="center" width='180' ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pname<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
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
						<td><?php echo $_smarty_tpl->tpl_vars['item']->value['hs_code'];?>
</td>	
						<td><?php echo $_smarty_tpl->tpl_vars['item']->value['p_name'];?>
</td>				
						<td align="center"><input type="checkbox" name="pid"  hs_code="<?php echo $_smarty_tpl->tpl_vars['item']->value['hs_code'];?>
"   class="<?php echo $_smarty_tpl->tpl_vars['from']->value;?>
actionSku" <?php if ($_smarty_tpl->tpl_vars['globals_hs_code']->value==$_smarty_tpl->tpl_vars['item']->value['hs_code']){?>checked<?php }?> /></td>
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
		var from = $('#from').val();	
		var p_name = $("input[name='p_name']").val();
		
        //var page_index = page_index||$('#current').val();
		getHScodeListBoxData(from,page_index+1,pageSize,p_name);
		return false;
	}
	
	

	
	
});

	function do_search(){
		var from = $('#from').val();	
		var p_name = $("input[name='p_name']").val();
		var s_hs_code = $("input[name='s_hs_code']").val();
        var pageSize = $('#pageSizes').val()||$('#Pagination1').attr('numperpage');
		getHScodeListBoxData(from,1,pageSize,p_name,s_hs_code);
	
	}
	
$(function(){
   //按默认类   
    $("#loadData").alterBgColor();
    
})
	</script><?php }} ?>