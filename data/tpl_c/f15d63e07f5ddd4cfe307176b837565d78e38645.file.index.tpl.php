<?php /* Smarty version Smarty-3.1.13, created on 2016-02-17 11:25:04
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\merchant\views\product\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2966556c3e810e12e89-21025072%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f15d63e07f5ddd4cfe307176b837565d78e38645' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\merchant\\views\\product\\index.tpl',
      1 => 1455677482,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2966556c3e810e12e89-21025072',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pageSize' => 0,
    'customs' => 0,
    'item' => 0,
    'condition' => 0,
    'ieType' => 0,
    'k' => 0,
    'checkOrg' => 0,
    'ciqStatus' => 0,
    'customsStatus' => 0,
    'productStatus' => 0,
    'result' => 0,
    'customShow' => 0,
    'count' => 0,
    'page' => 0,
    'url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56c3e8110ee102_10912858',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56c3e8110ee102_10912858')) {function content_56c3e8110ee102_10912858($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\block.t.php';
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
            <table class="left searchbartable" id="searchbox" style="word-wrap:break-word;table-layout:fixed;">
                <tr>
                    <th  class="nowrap">
                        <span class="nowrap">主管海关代码：</span>
                    </th>
                    <td>
                        <select name="customs_code" class="text-input width155">
                            <option value=''>全部</option>
                                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['customs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['ie_port'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['condition']->value)&&($_smarty_tpl->tpl_vars['condition']->value['customs_code']==$_smarty_tpl->tpl_vars['item']->value['ie_port'])){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['ie_port_name'];?>
</option>
                                <?php } ?>
                        </select>
                        <div class="simplesearchsubmit" style="display:inline-block;"> 
                                <a onclick="searchForm()" class="button"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>   
                                <!-- <a onclick="exportData()" class="button"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
export<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>  -->
                                <a class="switch_search_model"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
switch_to_advanced_search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a> 
                        </div>
                    </td>
                    <!--123-->
                        <th  class="advanced_element">
                            进出口类型：
                        </th>
                        <td>
                            <span class="advanced_element">
                                <select class="text-input width155" name="ie_type">
                                    <option value="">全部</option>
                                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ieType']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" <?php if (($_smarty_tpl->tpl_vars['k']->value==$_smarty_tpl->tpl_vars['condition']->value['ie_type'])){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value;?>

                                        </option>
                                    <?php } ?>
                                </select>
                            </span>
                            
                        </td>
                        <!--123-->


                    <th  class="nowrap advanced_element">
                        <span class="advanced_element">属地检验检疫机构：</span>
                    </th>
                    <td>
                        <span class="advanced_element">
                            <select name="ins_unit_code" class="fix-medium2-input" style="width: 155px;">
                                <option value="">全部</option>
                                <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['checkOrg']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['organization_code'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['condition']->value)&&($_smarty_tpl->tpl_vars['condition']->value['ins_unit_code']==$_smarty_tpl->tpl_vars['item']->value['organization_code'])){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['organization_name'];?>

                                </option>
                                <?php } ?>
                            </select>
                        </span>
                    </td>
                    
                    <!--<th  class="nowrap advanced_element">
                        <span class="advanced_element"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
productTitle<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</span>
                    </th>
                    <td>
                        <span class="advanced_element"><input type="text" name="title" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['product_title'];?>
" class='text-input width140'/></span>
                    </td>-->
                    <!-- <th class="nowrap">
                        <span class="advanced_element">海关编码：</span>
                    </th>
                    <td>
                        <span class="advanced_element">
                            <input type="text" name='hs_code' value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['hs_code'];?>
" class='text-input width155'/>
                        </span>
                    </td> -->
                </tr>
                <tr class="advanced_element">
                    <th  class="nowrap advanced_element">
                        <span class="advanced_element">海关备案编号：</span>
                    </th>
                    <td>
                        <span class="advanced_element">
                        <input type="text advanced_element" name="registerID" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['registerID'];?>
" class='text-input width140'>
                            </span>
                    </td>
                    <th>检验检疫状态：</th>
                    <td>
                        <span class="advanced_element">
                           <select class="text-input width155" name="ciqStatus">
                               <option value="">全部</option>
                               <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ciqStatus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                                   <option value="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" <?php if (isset($_smarty_tpl->tpl_vars['condition']->value)&&($_smarty_tpl->tpl_vars['condition']->value['product_status']===$_smarty_tpl->tpl_vars['k']->value)){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</option>
                               <?php } ?>

                           </select>
                        </span>
                    </td>
                    <th>海关状态：</th>
                    <td>
                        <span class="advanced_element">
                           <select class="text-input width155" name="customsStatus">
                               <option value="">全部</option>
                               <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['customsStatus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                                   <option value="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" <?php if (isset($_smarty_tpl->tpl_vars['condition']->value)&&($_smarty_tpl->tpl_vars['condition']->value['product_status']===$_smarty_tpl->tpl_vars['k']->value)){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</option>
                               <?php } ?>

                           </select>
                        </span>
                    </td>
                </tr>
                <tr class="advanced_element"> 
                        <th  class="nowrap">
                            <span class="advanced_element">海关商品编码：</span>
                        </th>
                        <td>
                            <input type="text" name='hs_code' value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['hs_code'];?>
" class='text-input width155'/>
                        </td>
                        <th >
                            商品状态：
                        </th>
                        <td>
                            <span class="advanced_element">
                               <select class="text-input width155" name="productStatus">
                                   <option value="">全部</option>
                                   <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['productStatus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                                       <option value="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" <?php if (isset($_smarty_tpl->tpl_vars['condition']->value)&&($_smarty_tpl->tpl_vars['condition']->value['product_status']===$_smarty_tpl->tpl_vars['k']->value)){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</option>
                                   <?php } ?>

                               </select>
                            </span>
                        </td>
                        
                        <th>
                            <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
addTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：

                        </th>
                        <td colspan="2">
                            <input type="text" name="start_time" class="datepicker text-input width140" readonly="true"   value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['product_add_time'];?>
" /> &nbsp;<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
&nbsp;
                            <input type="text" name="end_time" class="datepicker text-input width140" readonly="true"   value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['product_end_time'];?>
" />
                        </td>
                  </tr>
                 <tr class="advanced_element">
                     <th  class="nowrap advanced_element">
                         <span class="advanced_element"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
productTitle<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</span>
                     </th>
                     <td>
                         <span class="advanced_element"><input type="text" name="title" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['product_title'];?>
" class='text-input width140'/></span>
                     </td>
                  </tr>
                  <tr >  
                        <td colspan="6" >
                            <div class="advancedsearchsubmit">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a onclick="searchForm()" class="button"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a> 
                            <!-- <a onclick="exportData()" class="button"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
export<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>  -->
                            <a class="switch_search_model"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
switch_to_advanced_search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
                             </div> 
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
            <th style="width:8em" align="center" nowrap="nowrap" >主管海关代码</th>
            <th style="width:14em" align="center" >电商企业代码</th>
            <th  style="width:6em" align="center" nowrap="nowrap">海关备案编号</th>
            <th  style="width:6em" align="center" nowrap="nowrap">属地检验检疫机构</th>
            <th style="width:14em" align="center" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
productTitle<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            
            
            <th  style="width:6em" align="center" nowrap="nowrap">海关商品编码</th>
            <th style="width:10em" align="center" nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
productBarcode1<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
          
            <th style="width:5em" align="center" nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
productStatus<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th style="width:5em" align="center" nowrap="nowrap">检验检疫状态</th>
            <th style="width:5em" align="center" nowrap="nowrap">海关状态</th>
            <th width="120" align="center" nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
addTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th>检验检疫备案编号</th>
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
                    <?php if (isset($_smarty_tpl->tpl_vars['customShow']->value[$_smarty_tpl->tpl_vars['item']->value['customs_code']])){?>
                    <?php echo $_smarty_tpl->tpl_vars['customShow']->value[$_smarty_tpl->tpl_vars['item']->value['customs_code']];?>

                    <?php }?>
                </td>
                <td style="text-align: center"><?php echo $_smarty_tpl->tpl_vars['item']->value['customer_code'];?>
</td>
                <td   style="text-align:center">
                    <?php echo $_smarty_tpl->tpl_vars['item']->value['registerID'];?>

                </td>
                <td   style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['item']->value['ins_unit_name'];?>
</td>
                <td   style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['item']->value['product_title'];?>
</td>
                
                
                  <td   style="text-align:center">
                    <?php echo $_smarty_tpl->tpl_vars['item']->value['hs_code'];?>

                </td>
                <td   style="text-align:left">&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['product_barcode'];?>
</td>
                <td   style="text-align:center">
                    <?php echo $_smarty_tpl->tpl_vars['productStatus']->value[$_smarty_tpl->tpl_vars['item']->value['product_status']];?>

                </td>
                <td   style="text-align:center">
                    <?php if (isset($_smarty_tpl->tpl_vars['ciqStatus']->value[$_smarty_tpl->tpl_vars['item']->value['ciq_status']])){?>
                    <?php echo $_smarty_tpl->tpl_vars['ciqStatus']->value[$_smarty_tpl->tpl_vars['item']->value['ciq_status']];?>

                    <?php }?>
                </td>
                <td   style="text-align:center">
                    <?php if (isset($_smarty_tpl->tpl_vars['customsStatus']->value[$_smarty_tpl->tpl_vars['item']->value['customs_status']])){?>
                    <?php echo $_smarty_tpl->tpl_vars['customsStatus']->value[$_smarty_tpl->tpl_vars['item']->value['customs_status']];?>

                    <?php }?>
                </td>
                <td  style="text-align:center" class="nowrap"><?php echo $_smarty_tpl->tpl_vars['item']->value['product_add_time'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['inspection_code'];?>
</td>
                <td  style="text-align:center" nowrap="nowrap">
                    <a class="edit" onclick="parent.openMenuTab('/merchant/product/detail?productId=<?php echo $_smarty_tpl->tpl_vars['item']->value['product_id'];?>
','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(<?php echo $_smarty_tpl->tpl_vars['item']->value['registerID'];?>
)','productdetail<?php echo $_smarty_tpl->tpl_vars['item']->value['product_id'];?>
');return false;"
                        title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" ><span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
view<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span></a>
                    <span class="pipe">|</span>
                    <a class="edit" href="/merchant/product/print?productId=<?php echo $_smarty_tpl->tpl_vars['item']->value['product_id'];?>
" target="_blank">下载CIQ备案表格</a>
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
    var from1   = $("#pagerForm");
    from1.attr('action','/merchant/product/export');
    from1.submit();
}
function searchForm(){
    var from1   = $("#pagerForm");
    from1.attr('action','/merchant/product/index');
    from1.submit();
}

$(function(){
   //按默认类   
    $("#productlist").alterBgColor();
    $("#searchbox").switchToAdvancedSearch({button_id:'.switch_search_model',class_name:'advanced_element',cookName:"productlist_search_mode"});
    
})
$(function(){
    $('.switch_search_model').click(function(){
        $('#pagerForm')[0].reset();
        $('#pagerForm').find('input').not('[name="page"]').each(function(){
            if($(this).attr('name') != 'page' && $(this).attr('name') != 'pageSize'){
                $(this).val('');
            }     
        })
        $('#pagerForm').find('select').each(function(){
            $(this).find('option:selected').attr('selected',false);
            $(this).find('option:first').attr('selected','selected');
            $(this).trigger('update');
            //$(this).siblings('.b-custom-select').find('.b-custom-select__title__text').text($(this).find('option:first').text())
        })
    })
})
$(function(){  
    //$("#productlist").colResizable();  
}); 
</script><?php }} ?>