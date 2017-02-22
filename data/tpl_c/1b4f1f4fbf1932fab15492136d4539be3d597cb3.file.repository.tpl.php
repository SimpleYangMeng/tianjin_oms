<?php /* Smarty version Smarty-3.1.13, created on 2014-07-02 15:28:39
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/product/repository.tpl" */ ?>
<?php /*%%SmartyHeaderCode:47550510053b3b4a72f4f27-92751698%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1b4f1f4fbf1932fab15492136d4539be3d597cb3' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/product/repository.tpl',
      1 => 1398047599,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '47550510053b3b4a72f4f27-92751698',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page' => 0,
    'from' => 0,
    'pageSize' => 0,
    'params' => 0,
    'category' => 0,
    'item' => 0,
    'result' => 0,
    'count' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53b3b4a73eb458_09111772',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b3b4a73eb458_09111772')) {function content_53b3b4a73eb458_09111772($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><div class="content-box  ui-tabs  ui-corner-all">
	<form action="/merchant/product/repository" method="post" id="pagerForm">
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
ProductSKU<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：<input type="text" name="sku" class="text-input fix-small-input" value="<?php echo $_smarty_tpl->tpl_vars['params']->value['product_sku'];?>
"/>
					</td>
					<td nowrap="nowrap">
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pname<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：<input type="text" name="title" class="text-input fix-small-input" value="<?php echo $_smarty_tpl->tpl_vars['params']->value['product_title'];?>
"/>
					</td>				
					<td nowrap="nowrap">
					
						<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductCategory<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
						<select class="combox" name="type" id="type" >
							<option value=""><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
all<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
							<?php if ($_smarty_tpl->tpl_vars['category']->value!=''){?>
								<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['category']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
									<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['pc_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['params']->value['pc_id']==$_smarty_tpl->tpl_vars['item']->value['pc_id']){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value["pc_name"];?>
</option>
								<?php } ?>
							<?php }?>
						</select>
					</div>
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
				<th align="center" width="150" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductSKU<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
				<th align="center" width='180' ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pname<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
				<th align="center" width="250"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductCategory<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
				<th align="center" width="200"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
addTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
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
						<td><?php echo $_smarty_tpl->tpl_vars['item']->value['product_sku'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['item']->value['product_title'];?>
</td>				
						<td>
                            <?php echo $_smarty_tpl->tpl_vars['item']->value["pc_name"];?>

						</td>
						<td nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['item']->value['product_add_time'];?>
</td>
						<td align="center"><input type="checkbox" name="pid"  productSku="<?php echo $_smarty_tpl->tpl_vars['item']->value['product_sku'];?>
" productId="<?php echo $_smarty_tpl->tpl_vars['item']->value['product_id'];?>
" productName="<?php echo $_smarty_tpl->tpl_vars['item']->value['product_title'];?>
" category="<?php echo $_smarty_tpl->tpl_vars['item']->value['pc_name'];?>
" productWeight="<?php echo $_smarty_tpl->tpl_vars['item']->value['product_weight'];?>
" option="{id:<?php echo $_smarty_tpl->tpl_vars['item']->value['product_id'];?>
,sku:'<?php echo $_smarty_tpl->tpl_vars['item']->value['product_sku'];?>
'}"  class="<?php echo $_smarty_tpl->tpl_vars['from']->value;?>
actionSku" /></td>
					</tr>					
				<?php } ?>	
			<?php }?>
		</tbody>
	</table>
		<div class="panelBar">
		<!--<div class="pages">
			
			<span>显示</span>
			<select class="combox" name="numPerPage" onchange="dialogPageBreak({numPerPage:this.value})">
				<option value="20" <?php if ($_smarty_tpl->tpl_vars['pageSize']->value==20){?>selected<?php }?>>20</option>
				<option value="50" <?php if ($_smarty_tpl->tpl_vars['pageSize']->value==50){?>selected<?php }?>>50</option>
				<option value="100" <?php if ($_smarty_tpl->tpl_vars['pageSize']->value==100){?>selected<?php }?>>100</option>
			</select>
			
			<span>条，共<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
条数据</span>

		</div>!-->
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
		var sku = $("input[name='sku']").val();
		var title = $("input[name='title']").val();
		var type = $("#type").val();
        //var page_index = page_index||$('#current').val();
		getProductListBoxData(from,page_index+1,pageSize,sku,title,type);
		return false;
	}
	
	

	
	
});

	function do_search(){
		var from = $('#from').val();	
		var sku = $("input[name='sku']").val();
		var title = $("input[name='title']").val();
		var type = $("#type").val();
        var pageSize = $('#pageSizes').val()||$('#Pagination1').attr('numperpage');
		getProductListBoxData(from,1,pageSize,sku,title,type);
	
	}
	
	$(function(){     
    	$("#loadData").alterBgColor();	
    	keepTheInterface();
		$('#dialog').dialog({
			autoOpen: false,
			modal: false,
			bgiframe:true,
			position:['center','top'],
			width: 900,	
			height:'auto',
			draggable:true,			
			resizable: true			
		});
		//$('.ui-dialog').draggable();
		
	});
	
	/*选则项要跟页面一致*/
	function keepTheInterface(){
	
		var pre_id_name ='#orderproduct';
		if($('#from').val()=='asn'){
			pre_id_name ='#asnproduct';
		}
		if($('#from').val()=='productCombine'){
			pre_id_name ='#subProduct';
		}			
		
		//alert($('#from').val());	
		
		var pids = $("input[name='pid']");
		//alert(pids.size());
		if(pids.size()==0){return;}		
			pids.each(function(i){
				_this = $(this);				
				var product_id = _this.attr('productid');
				//alert($("#orderproduct"+product_id).size());						
				if($(pre_id_name+product_id).size()==0){					
					_this.attr("checked",false);					
				}else{
					_this.attr("checked",true);
				}
				/*
				if($("#asnproduct"+product_id).size()==0){					
					_this.attr("checked",false);
				}else{
					_this.attr("checked",true);
				}
				*/			
				
			}); 
			resetbgcolor();
	}		
	
	
	
	
	function resetbgcolor(){

		var pids = $("input[name='pid']");
		if(pids.size()==0){return;}		
		pids.each(function(i){
				_this = $(this);
				if(_this.is(':checked')){								
					set_tr_class(_this.parent().parent(), true);
				}else{			
					set_tr_class(_this.parent().parent(), false);	
				}
				//alert(_this.parent().parent().attr('rel'));
		});	
	}	
</script><?php }} ?>