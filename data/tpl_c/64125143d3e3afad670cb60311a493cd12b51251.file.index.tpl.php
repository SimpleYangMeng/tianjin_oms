<?php /* Smarty version Smarty-3.1.13, created on 2014-07-02 14:07:57
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/product/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:139576897553b3a1bdaf8cc8-51727127%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '64125143d3e3afad670cb60311a493cd12b51251' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/product/index.tpl',
      1 => 1402992950,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '139576897553b3a1bdaf8cc8-51727127',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pageSize' => 0,
    'condition' => 0,
    'category' => 0,
    'item' => 0,
    'result' => 0,
    'lang' => 0,
    'temp' => 0,
    'count' => 0,
    'page' => 0,
    'url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53b3a1bdcbdef4_95219223',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b3a1bdcbdef4_95219223')) {function content_53b3a1bdcbdef4_95219223($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><div class="content-box  ui-tabs  ui-corner-all ui-widget ui-widget-content">
<div class="content-box-header" style="margin-top:5px">
    <h3 style="margin-left:5px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductList<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
    <div class="clear"></div>
</div>
    <form action="/merchant/product/index" method="post"  id="pagerForm">
        <input type="hidden" name="page" value="1" id="page" />

        <input type="hidden" name="pageSize" value="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" id="pageSizes" />
            <table class="left searchbartable" id="searchbox">
                <tr>
                    <th  class="nowrap">
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductSKU<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
                    </th>
                    <td ><input type="text" name="sku" class="text-input width140 leftloat" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['product_sku'];?>
"   />
					
					 <div class="simplesearchsubmit" style="float:left;margin-top:4px;"> <a onclick="$('#pagerForm').submit()" class="button"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>  <a class="switch_search_model"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
switch_to_advanced_search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a> </div></td>
                    <th  class="nowrap">
                        <span class="advanced_element"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
productTitle<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</span>
                    </th>
                    <td><span class="advanced_element"><input type="text" name="title" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['product_title'];?>
" class='text-input width140'/></span></td>
 					<th  class="nowrap">
                      <span class="advanced_element"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductCategory<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</span>
                    </th>
                  <td><span class="advanced_element">
                      <select class="text-input width155" name="type">
                          <option value="">-<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
all<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
-</option>
                          <?php if ($_smarty_tpl->tpl_vars['category']->value!=''){?>
                          <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['category']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                              <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['pc_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['condition']->value['pc_id']==$_smarty_tpl->tpl_vars['item']->value['pc_id']){?>selected<?php }?> ><?php echo $_smarty_tpl->tpl_vars['item']->value["pc_name"];?>
</option>
                              <?php } ?>
                          <?php }?>
                      </select>
					  </span>
                  </td>
                  </tr>


     				<tr class="advanced_element">
                 
                  <th class="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
productStatus<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</th>
                  <td>
                      <select class="text-input width155" name="status">
                          <option value="">全部</option>
						  <option value="0" <?php if ($_smarty_tpl->tpl_vars['condition']->value['product_status']=='0'){?>selected<?php }?>>未备案</option>
                          <option value="1" <?php if ($_smarty_tpl->tpl_vars['condition']->value['product_status']=='1'){?>selected<?php }?>>正常</option>
                         
                      </select>
                  </td>

                  <th class="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductType2<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</th>
                  <td colspan="3">
                      <select class="text-input width155" name="product_type">
                          <option value="">全部</option>
						  <option value="0" <?php if ($_smarty_tpl->tpl_vars['condition']->value['product_type']=='0'){?>selected<?php }?>>普通产品</option>
                          <option value="1" <?php if ($_smarty_tpl->tpl_vars['condition']->value['product_type']=='1'){?>selected<?php }?>>组合产品</option>
                         
                      </select>
					 
                  </td>
                 
                </tr>

			   		<tr class="advanced_element">               
                   
                    <th >
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
addTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
              		
					</th>
					
					
					<td colspan="5">
					
							
					<input type="text" name="start_time" class="datepicker text-input width140" readonly="true"   value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['product_add_time'];?>
" /> &nbsp;<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
&nbsp;		
					<input type="text" name="end_time" class="datepicker text-input width140" readonly="true"   value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['product_end_time'];?>
" />
					
					</td>
					
                  </tr>
				  
				  <tr >  
				  
				  	<td colspan="6" >
					
						 <div class="advancedsearchsubmit">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onclick="$('#pagerForm').submit()" class="button"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>  <a class="switch_search_model"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
switch_to_advanced_search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a></div> 
					
					</td>
				  
				  </tr>
				  
				  
             
            </table>
        <div>

        </div>
    </form>

</div>






    <table  class="table" id="productlist"  style="margin-top:10px">
        <thead>
        <tr style="height:25px">
            <th style="width:8em" align="center" nowrap="nowrap" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductSKU<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th style="width:14em" align="center" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
productTitle<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th  style="width:6em" align="center" nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BarcodeType<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th style="width:10em" align="center" nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
productBarcode1<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th style="width:10em" align="center" nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductCategory<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th style="width:5em" align="center" nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
productStatus<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th width="120" align="center" nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
addTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th align='center' width="100"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
operate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
        </tr>
        </thead>


        <tbody>
        <?php if ($_smarty_tpl->tpl_vars['result']->value!=''){?>
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
            <tr target="pid"   rel="<?php echo $_smarty_tpl->tpl_vars['item']->value['product_id'];?>
">
                <td style="text-align:center;padding-left:5px">				
				<a class="edit" href="/merchant/product/detail?productId=<?php echo $_smarty_tpl->tpl_vars['item']->value['product_id'];?>
" onclick="parent.openMenuTab('/merchant/product/detail?productId=<?php echo $_smarty_tpl->tpl_vars['item']->value['product_id'];?>
','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(<?php echo $_smarty_tpl->tpl_vars['item']->value['product_sku'];?>
)','productdetail<?php echo $_smarty_tpl->tpl_vars['item']->value['product_id'];?>
');return false;" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" ><span><?php echo $_smarty_tpl->tpl_vars['item']->value['product_sku'];?>
</span></a>
                </td>
                <td   style="text-align:center"><?php if ($_smarty_tpl->tpl_vars['lang']->value=='en_US'){?><?php echo $_smarty_tpl->tpl_vars['item']->value['product_title_en'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['item']->value['product_title'];?>
<?php }?></td>
                <td   style="text-align:center">
                    <?php if ($_smarty_tpl->tpl_vars['item']->value['product_barcode_type']==0){?>
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DefaultType<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    <?php }elseif($_smarty_tpl->tpl_vars['item']->value['product_barcode_type']==1){?>
                    自定义类型
                    <?php }elseif($_smarty_tpl->tpl_vars['item']->value['product_barcode_type']==2){?>
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SequenceType<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                    <?php }?>
                </td>
                <td   style="text-align:left">&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['product_barcode'];?>
</td>
                <td  style="text-align:left">&nbsp;
                    <?php if ($_smarty_tpl->tpl_vars['category']->value!=''){?>
                    <?php  $_smarty_tpl->tpl_vars['temp'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['temp']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['category']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['temp']->key => $_smarty_tpl->tpl_vars['temp']->value){
$_smarty_tpl->tpl_vars['temp']->_loop = true;
?>
                        <?php if ($_smarty_tpl->tpl_vars['item']->value['pc_id']==$_smarty_tpl->tpl_vars['temp']->value['pc_id']){?>
                            <?php echo $_smarty_tpl->tpl_vars['temp']->value["pc_name"];?>

                            <?php }?>
                        <?php } ?>
                    <?php }?>
                </td>
                <td   style="text-align:center">
                    <?php if ($_smarty_tpl->tpl_vars['item']->value['product_status']==0){?>
                    	未备案
                    <?php }elseif($_smarty_tpl->tpl_vars['item']->value['product_status']==1){?>
                    	正常
                    <?php }?>
                </td>
                <td  style="text-align:center" class="nowrap"><?php echo $_smarty_tpl->tpl_vars['item']->value['product_add_time'];?>
</td>
                <td  style="text-align:center" nowrap="nowrap">
                    <?php if ($_smarty_tpl->tpl_vars['item']->value['have_asn']=='0'&&$_smarty_tpl->tpl_vars['item']->value['product_type']=='1'){?>
                    <a class="edit" href="/merchant/product/add?productId=<?php echo $_smarty_tpl->tpl_vars['item']->value['product_id'];?>
" onclick="parent.openMenuTab('/merchant/product/add?productId=<?php echo $_smarty_tpl->tpl_vars['item']->value['product_id'];?>
','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductModify<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(<?php echo $_smarty_tpl->tpl_vars['item']->value['product_sku'];?>
)','productedit<?php echo $_smarty_tpl->tpl_vars['item']->value['product_id'];?>
');return false;"><span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
edit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span></a>
                    <a class="delete" onclick="deleteProduct('/merchant/product/del/productId/<?php echo $_smarty_tpl->tpl_vars['item']->value['product_id'];?>
')"  target="ajaxTodo" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductModify<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"><span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
delete<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span></a>
                    <?php }?>			

                    <?php if (0==$_smarty_tpl->tpl_vars['item']->value['product_type']&&0==$_smarty_tpl->tpl_vars['item']->value['product_status']){?>
                    <a class="edit" href="/merchant/product/add?productId=<?php echo $_smarty_tpl->tpl_vars['item']->value['product_id'];?>
" onclick="parent.openMenuTab('/merchant/product/add?productId=<?php echo $_smarty_tpl->tpl_vars['item']->value['product_id'];?>
','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductModify<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(<?php echo $_smarty_tpl->tpl_vars['item']->value['product_sku'];?>
)','productedit<?php echo $_smarty_tpl->tpl_vars['item']->value['product_id'];?>
');return false;"><span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
edit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span></a>
                    <?php }?>

					<a class="edit" onclick="parent.openMenuTab('/merchant/product/detail?productId=<?php echo $_smarty_tpl->tpl_vars['item']->value['product_id'];?>
','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(<?php echo $_smarty_tpl->tpl_vars['item']->value['product_sku'];?>
)','productdetail<?php echo $_smarty_tpl->tpl_vars['item']->value['product_id'];?>
');return false;" 
                        title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" ><span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
view<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span></a>
                </td>
            </tr>
            <?php } ?>
        <?php }?>

        </tbody>

</table>

<div class="clear"></div>
<div class="pagination" targetType="navTab" totalCount="<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
" numPerPage="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" currentPage="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"  pageNumShown="10" url="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
"></div>


<script>
function deleteProduct(url){
    $('<div title="Note(Esc)"><p align=""><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
AreYouSureToDeleteTheProduct<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</p></div>').dialog({
        autoOpen: true,
        width: 300,
        height: 'auto',
        modal: true,
        show:"slide",
        buttons: {
            '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
cancel<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
':function(){
                $(this).dialog("close");
            },
            '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Determine<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
                $(this).dialog("close");
                $.ajax({
                    type:'POST',
                    url:url,
                    dataType:"json",
                    cache:false,
                    success:function(json){
                        if(json.ask=='1'){
                            alertTip(json.message);
                            $('#pagerForm').submit();
                        }else{
                            var html = '';
                            html+=json.message;
                            alertTip(json.message,'500','auto','1');
                        }
                    },
                    error:function(){
                        alertTip('<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
error<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
                    }
                });
            }
        },
        close: function() {

        }
    });

}
	</script>


<script>
$(function(){
   //按默认类   
    $("#productlist").alterBgColor();
	$("#searchbox").switchToAdvancedSearch({button_id:'.switch_search_model',class_name:'advanced_element',cookName:"productlist_search_mode"});
    
})
</script>


<script>
    $(function(){  
      	//$("#productlist").colResizable();  
    }); 
</script><?php }} ?>