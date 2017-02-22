<?php /* Smarty version Smarty-3.1.13, created on 2015-11-13 15:02:38
         compiled from "D:\www\import_oms\branches\tianjin\application\modules\merchant\views\product\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2048256458b0e534074-51459943%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8143f69fe968a2fb76a5af07b5c839711dc0af33' => 
    array (
      0 => 'D:\\www\\import_oms\\branches\\tianjin\\application\\modules\\merchant\\views\\product\\index.tpl',
      1 => 1446292359,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2048256458b0e534074-51459943',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pageSize' => 0,
    'condition' => 0,
    'user' => 0,
    'customerList' => 0,
    'customer' => 0,
    'result' => 0,
    'item' => 0,
    'lang' => 0,
    'count' => 0,
    'page' => 0,
    'url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56458b0e73df70_14095218',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56458b0e73df70_14095218')) {function content_56458b0e73df70_14095218($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\import_oms\\branches\\tianjin\\libs\\Smarty\\plugins\\block.t.php';
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
					
					 <div class="simplesearchsubmit" style="float:left;margin-top:4px;"> <a onclick="searchForm()" class="button"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>   <a onclick="exportData()" class="button"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
export<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a> <a class="switch_search_model"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
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
productStatus<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</span>
                    </th>
                  <td><span class="advanced_element">
                       <select class="text-input width155" name="status">
                          <option value="">全部</option>
						  <option value="2" <?php if ($_smarty_tpl->tpl_vars['condition']->value['product_status']=='2'){?>selected<?php }?>>草稿</option>
                          <option value="3" <?php if ($_smarty_tpl->tpl_vars['condition']->value['product_status']=='3'){?>selected<?php }?>>已提交</option>
                          <option value="0" <?php if ($_smarty_tpl->tpl_vars['condition']->value['product_status']=='0'){?>selected<?php }?>>备案中</option>
                          <option value="1" <?php if ($_smarty_tpl->tpl_vars['condition']->value['product_status']=='1'){?>selected<?php }?>>已备案</option>
                         
                      </select>
					  </span>
                  </td>
                  </tr>

                <tr class="advanced_element">               
                     <th  class="nowrap">
                        <span class="advanced_element">客户代码：</span>
                    </th>
                    <td>
                        <select class="text-input width155" name="customer_code">
                          <?php if ($_smarty_tpl->tpl_vars['user']->value['customer_type']!=1){?><option value="">全部</option><?php }?>
                         <?php  $_smarty_tpl->tpl_vars['customer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customer']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customerList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customer']->key => $_smarty_tpl->tpl_vars['customer']->value){
$_smarty_tpl->tpl_vars['customer']->_loop = true;
?>
                         <option value="<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['condition']->value['customer_code']==$_smarty_tpl->tpl_vars['customer']->value){?>selected<?php }?> ><?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
</option>
                         <?php } ?>
                      </select>
                    </td>
                    <th >
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
addTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
              		
                    </th>		
                    <td colspan="3">


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
					
						 <div class="advancedsearchsubmit">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onclick="searchForm()" class="button"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a> <a onclick="exportData()" class="button"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
export<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
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
            <th style="width:14em" align="center" >客户代码</th>
            <th  style="width:6em" align="center" nowrap="nowrap">海关备案编号</th>
            <th style="width:10em" align="center" nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
productBarcode1<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
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
                <td style="text-align: center"><?php echo $_smarty_tpl->tpl_vars['item']->value['customer_code'];?>
</td>
                <td   style="text-align:center">
                    <?php echo $_smarty_tpl->tpl_vars['item']->value['registerID'];?>

                </td>
                <td   style="text-align:left">&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['product_barcode'];?>
</td>
                
                <td   style="text-align:center">
                    <?php if ($_smarty_tpl->tpl_vars['item']->value['product_status']==2){?>
                    	草稿
                    <?php }elseif($_smarty_tpl->tpl_vars['item']->value['product_status']==3){?>
                    	确认
                    <?php }elseif($_smarty_tpl->tpl_vars['item']->value['product_status']==0){?>
                      备案中
                    <?php }elseif($_smarty_tpl->tpl_vars['item']->value['product_status']==1){?>
                    已备案
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

                    <?php if (0==$_smarty_tpl->tpl_vars['item']->value['product_type']&&2==$_smarty_tpl->tpl_vars['item']->value['product_status']){?>
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

function exportData(){
	var from1	= $("#pagerForm");
	from1.attr('action','/merchant/product/export');
	from1.submit();
}
function searchForm(){
	var from1	= $("#pagerForm");
	from1.attr('action','/merchant/product/index');
	from1.submit();
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