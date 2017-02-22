<?php /* Smarty version Smarty-3.1.13, created on 2014-07-02 19:15:50
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/product/product-create-combine.tpl" */ ?>
<?php /*%%SmartyHeaderCode:131021531053b3e9e659d251-26279274%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '991a5095dc8fb072f07b302d2443e96802c39a48' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/product/product-create-combine.tpl',
      1 => 1396509543,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '131021531053b3e9e659d251-26279274',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'action' => 0,
    'product_id' => 0,
    'productCombineInfo' => 0,
    'sub' => 0,
    'actionLabel' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53b3e9e66bf4f3_34310489',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b3e9e66bf4f3_34310489')) {function content_53b3e9e66bf4f3_34310489($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><style>
  #subProducts .textInput{
      float:none;;
  }
</style>
<div class="content-box closed-box ui-tabs ui-widget ui-widget-content ui-corner-all">
        <div class="content-box-header">
                <h3 style="margin-left:5px"><?php echo $_smarty_tpl->tpl_vars['action']->value;?>
</h3>
                <div class="clear"></div>
        </div>
        <form method="post" action="/merchant/product/combine" id="productCombinebForm" class="pageForm required-validate">
                <table >
                        <tbody>
                                <tr>
                                        <td class="form_title"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
skuCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                                        <td class="form_input"><input name="product_id" value="<?php echo $_smarty_tpl->tpl_vars['product_id']->value;?>
" type="hidden" id="product_id">
                                                <?php if (isset($_smarty_tpl->tpl_vars['productCombineInfo']->value)&&$_smarty_tpl->tpl_vars['productCombineInfo']->value['product_sku']){?>												
                                                <input name="product_sku" id="product_sku" class="required text-input fix-medium-input readonly inputbox"  type="text" value="<?php if (isset($_smarty_tpl->tpl_vars['productCombineInfo']->value)&&$_smarty_tpl->tpl_vars['productCombineInfo']->value['product_sku']){?><?php echo $_smarty_tpl->tpl_vars['productCombineInfo']->value['product_sku'];?>
<?php }?>" readonly  />
                                                <?php }else{ ?>
                                                <input name="product_sku" id="product_sku" class="required text-input fix-medium-input" type="text" placeholder="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Please_input_combinations_of_SKU<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"/>   
                                                <?php }?> <strong>*</strong> <a href="#"  class="tip" title="(<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
combinations_bar_tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
)" onclick="return false;"><img src="/images/help.png"></a></td>
                                </tr>
                                <tr>
                                        <td class="form_title"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CombineProductName<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                                        <td class="form_input"><input name="product_title_cn" id="product_title_cn" class="required text-input fix-medium-input" placeholder="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Please_enter_the_name_of_the_Chinese_combination_products<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" type="text"  value="<?php if (isset($_smarty_tpl->tpl_vars['productCombineInfo']->value)&&$_smarty_tpl->tpl_vars['productCombineInfo']->value['product_title']){?><?php echo $_smarty_tpl->tpl_vars['productCombineInfo']->value['product_title'];?>
<?php }?>" />
                                                <strong>*</strong>  <a href="#"  class="tip" title="(<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
product_name_tip<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
)" onclick="return false;"><img src="/images/help.png"></a></td>
                                </tr>
                                <tr>
                                        <td class="form_title"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
currencyNameEn<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                                        <td class="form_input"><input name="product_title_en" id="product_title_en" type="text"  class="text-input fix-medium-input" placeholder="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Please_enter_the_name_of_the_English_combination_products<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"  value="<?php if (isset($_smarty_tpl->tpl_vars['productCombineInfo']->value)&&$_smarty_tpl->tpl_vars['productCombineInfo']->value['product_title_en']){?><?php echo $_smarty_tpl->tpl_vars['productCombineInfo']->value['product_title_en'];?>
<?php }?>" /> <strong style=" visibility:hidden;">*</strong>&nbsp;<a href="#"  class="tip" title="(请输入产品的英文名称，建议使用网站英文品名)" onclick="return false;"><img src="/images/help.png"></a></td>
                                </tr>
                        
                        <tr>
                                <td class="form_title">&nbsp;</td>
                                <td class="form_input"><a href="#" id="dialog_link" class="ui-state-default  ui-corner-all"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SelectProduct<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a> </td>
                        </tr>
                        
                        <tr>
                                <td class="form_title">&nbsp;</td>
                                <td class="form_input">							
								
								<table id="subProducts" border="1" width="400">
									<?php if (isset($_smarty_tpl->tpl_vars['productCombineInfo']->value)&&$_smarty_tpl->tpl_vars['productCombineInfo']->value['subs']){?> 
									<?php  $_smarty_tpl->tpl_vars['sub'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sub']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['productCombineInfo']->value['subs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sub']->key => $_smarty_tpl->tpl_vars['sub']->value){
$_smarty_tpl->tpl_vars['sub']->_loop = true;
?>
									
										<tr id="subProduct<?php echo $_smarty_tpl->tpl_vars['sub']->value['pcr_product_id'];?>
">
									
										<th> <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CombineSonSku<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</th>
										<td  style="text-align:left">
										<input type='text' class='readonly inputbox' readonly value='<?php echo $_smarty_tpl->tpl_vars['sub']->value['pcr_product_sku'];?>
' size='28'>
										</td>
										<th >
										 <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
quantity<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:
										 </th>
										 <td style="text-align:left">
										 <input type='text' class='inputbox inputMinbox' name='sub[<?php echo $_smarty_tpl->tpl_vars['sub']->value['pcr_product_id'];?>
]' value='<?php echo $_smarty_tpl->tpl_vars['sub']->value['pcr_quantity'];?>
' size='5' /> 
										</td>
										
										<td style="text-align:left">
										 <img title='Delete' product_id='<?php echo $_smarty_tpl->tpl_vars['sub']->value['pcr_product_id'];?>
' class='subProductDel' src='/images/icon_del.gif'/>
										</td>
										
										
										</tr>                         
												
                                		<?php } ?> 
									<?php }?> 
								
								
								</table>
								
								<!--
								<div id="subProducts" style="float:left;"> 
								
								<?php if (isset($_smarty_tpl->tpl_vars['productCombineInfo']->value)&&$_smarty_tpl->tpl_vars['productCombineInfo']->value['subs']){?> 
								<?php  $_smarty_tpl->tpl_vars['sub'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sub']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['productCombineInfo']->value['subs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sub']->key => $_smarty_tpl->tpl_vars['sub']->value){
$_smarty_tpl->tpl_vars['sub']->_loop = true;
?>
                                                <div id="subProduct<?php echo $_smarty_tpl->tpl_vars['sub']->value['pcr_product_id'];?>
" style="border:1px solid #ff0000"> 
												 <span>&nbsp;&nbsp;&nbsp;&nbsp;<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CombineSonSku<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</span>
												 <span>
                                                        <input type="text" size="28" value="<?php echo $_smarty_tpl->tpl_vars['sub']->value['pcr_product_sku'];?>
"  class="readonly text-input fix-medium-input" readonly="readonly" size="28" />
														
                                                        &nbsp;&nbsp;&nbsp;<span style="font-weight: bold;">Quantity:</span>&nbsp;&nbsp;<input type="text" class="text-input fix-small-input" size="5" value="<?php echo $_smarty_tpl->tpl_vars['sub']->value['pcr_quantity'];?>
" name="sub[<?php echo $_smarty_tpl->tpl_vars['sub']->value['pcr_product_id'];?>
]" size="5" />                                           
                                                        
														&nbsp;<a href='javascript:;' title='Delete' class='subProductDel'><img src='/images/icon_del.gif'/></a>
														
														
                                                        </span> 
														
												</div>
												<div class="clear"></div>
                                <?php } ?> 
								<?php }?>
                                                
                                </div>
								!-->
										
										
								</td>
                        </tr>
                        <tr>
                                <td class="form_title">&nbsp;</td>
                                <td class="form_input"><a  class="button tijiao" onclick="do_combine_submit()"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
submit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a> </td>
                        </tr>
                        </tbody>
                        
                </table>
        </form>
        <div class="infoTips" id="combinetips" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
InformationTips<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"> </div>
        <div id="dialog" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SelectProduct<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"> </div>
</div>


<script type="text/javascript">

	var actionLabel = '<?php echo $_smarty_tpl->tpl_vars['actionLabel']->value;?>
';
    //console.log(actionLabel);

	$(function(){
		/*选择产品的复选框单击*/
        $(".productCombineactionSku").live("click", function(){
            var productSku = $(this).attr("productSku");
            var productId = $(this).attr("productId");
            if($(this).is(':checked')){
                if($("#subProduct"+productId).size()==0){
                     $("#subProducts").append("<tr id='subProduct"+productId+"'><th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
son_SKU<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</th><td style='text-align:left'><input type='text' class='readonly inputbox' readonly value='"+productSku+"' size='28'> </td> <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
quantity<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</th><td style='text-align:left'><input type='text' class='inputbox inputMinbox' name='sub["+productId+"]' value='1' size='5'> </td><td style='text-align:left'><img title='Delete' product_id='"+ productId +"' class='subProductDel' src='/images/icon_del.gif'/></td></tr>");
					//$("#subProducts").append("<div id='subProduct"+productId+"'><span> &nbsp;&nbsp;&nbsp;&nbsp;子sku:&nbsp;</span><span><input type='text' id='orderproduct"+ productId +"' class='readonly text-input fix-medium-input' readonly value='"+productSku+"' size='28'> &nbsp;&nbsp;&nbsp;<span style='font-weight:bold;'>Quantity:</span>&nbsp;&nbsp;<input type='text' class='text-input fix-small-input' name='sub["+productId+"]' value='1' size='5'><a href='javascript:;' product_id='"+ productId+"' title='Delete' class='subProductDel'>&nbsp;<img src='/images/icon_del.gif'/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class='clear'></div></div>");
                }
            }else{
                if($("#subProduct"+productId).size()>0){
                    $("#subProduct"+productId).remove();
                }
            }
        });
		/*取消子sku*/
        $(".subProductDel").live("click",function(){
			_this = $(this);
			var product_id = _this.attr('product_id');
			$('#subProduct'+product_id).remove();
			//$(this).parent().parent.remove();
			//alert($(this).parent().attr('id'));
            //$(this).parent().remove();
			keepTheInterface();
        });
        
 		/*----------------产品弹出框的功能---------2013-08-19 colin yang---------------*/
		
		
		// 产品浏览的对话框			
		$('#dialog').dialog({
			autoOpen: false,
			modal: false,			
			bgiframe:true,
			position:[50,50],
			width: 850,	
			height:'auto',
			resizable: true			
		});
		
		$('#combinetips').dialog({
			autoOpen: false,
			modal: false,
			bgiframe:true,
			position:[50,50],
			width: 400,	
			minHeight:100,
			height:'auto',	
			resizable: true			
		});	
						
			//产品浏览
		$('#dialog_link').click(function(){					
					$('#dialog').dialog('open');
					getProductListBoxData('productCombine'); 					
					return false;
		});     
		
		  
        
	});
	
	/*对话框内部切换数据 分页*/
	function dialogSearch(form){
		
		var $form = $(form);		
		getProductListBoxData('productCombine',2,50);
	//if (form[DWZ.pageInfo.pageNum]) form[DWZ.pageInfo.pageNum].value = 1;
	//$.pdialog.reload($form.attr('action'), {data: $form.serializeArray()});
		return false;
	}
	
		
		
		
		
		
	function do_combine_submit(){
    //return false;	
	///merchant/product/add-save
             	//$('.mytip').emptyTip();
				var options = {
				//target:'#combinetips', //后台将把传递过来的值赋给该元素
				url:'/merchant/product/combine', //提交给哪个执行
				type:'POST',
				dataType:'json',
				//dataType:'html',
				success: function(data){
					var html ="";
					//alert(data);return;
					if(data.ask==1){
						html += data.message+'</br></br>';
						if(actionLabel=='add'){
							html += '<button class="button buttonheight" onclick="parent.openMenuTab('+'\'/merchant/product/combine\',\'<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CombineProductAdd<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
\',\'CombineProductAdd\',\'1\')"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CombineProductAdd1<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</button>';
							
							var productId = data.productId || '';
							var product_sku =  data.product_sku || '';
							
							if(productId!=''){
								html += '<button class="button buttonheight" onclick="parent.openMenuTab('+'\'/merchant/product/combine/productId/';
								html+=productId;
								html+='\',\'<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
edit_combine_product<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(';
								html+=product_sku;
								html+=')\',\'productcombineedit';
								html+=productId;
								html+='\',\'1\')"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
edit_combine_product<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</button>';
							}
													
							//html += '<a href="/merchant/product"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductList<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>';
						}//=='add'){
						
						if(actionLabel=='update'){
							html += '<button class="button buttonheight" onclick="parent.openMenuTab('+'\'/merchant/product/combine\',\'<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CombineProductAdd<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
\',\'CombineProductAdd\',\'1\')"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CombineProductAdd1<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</button>';							
							var productId = data.productId || '';
							var product_sku =  data.product_sku || '';
							if(productId!=''){
								html += '<button class="button buttonheight" onclick="parent.openMenuTab('+'\'/merchant/product/combine/productId/';
								html+=productId;
								html+='\',\'<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
edit_combine_product<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(';
								html+=product_sku;
								html+=')\',\'productcombineedit';
								html+=productId;
								html+='\',\'1\')"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
edit_combine_product<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</button></br>';
							}							
							//html += '<a href="/merchant/product"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductList<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>';
						}		//update				 
						$("#combinetips").dialog({close:function(){ gotoproductlist(); }});
						$("#combinetips").html(html);			
					}else{													
						
						
						html+=data.message+"<br/>";
						
						try{				
								$.each(data.error,function(idx,vitem){
						 			html+=vitem+"<br/>";
								});
						}catch(e){
								
						}						
						//alert(html);
						$("#combinetips").dialog({close:null});
						$("#combinetips").html(html);
					
					}
					
					$('#combinetips').dialog('open');
					
				
				
				
				}}; //显示操作提示
	
				$("#productCombinebForm").ajaxSubmit(options); 
				return false;
	
		    
	}  //end of function		
		


	
function gotoproductlist(){
	parent.openMenuTab('/merchant/product','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductList<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
','ProductList','1');
}			
			
			
</script><?php }} ?>