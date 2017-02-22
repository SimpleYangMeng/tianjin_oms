<?php /* Smarty version Smarty-3.1.13, created on 2014-07-03 08:11:56
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/product/safe-inventory-list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:92574533853b49fcca7a950-69005888%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a0730ac9c264ee0c3ec00231a5e34772a01bdca0' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/product/safe-inventory-list.tpl',
      1 => 1398047828,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '92574533853b49fcca7a950-69005888',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pageSize' => 0,
    'condition' => 0,
    'warehouse' => 0,
    'row' => 0,
    'result' => 0,
    'count' => 0,
    'page' => 0,
    'url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53b49fccc05404_65631963',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b49fccc05404_65631963')) {function content_53b49fccc05404_65631963($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><div class="content-box  ui-tabs  ui-corner-all ui-widget ui-widget-content">
    <div class="content-box-header" style="margin-top:5px">
        <h3 style="margin-left:5px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SafetyStockList<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
        <div class="clear"></div>
    </div>
    <form action="/merchant/product/safe-inventory-list" method="post"  id="pagerForm">
        <input type="hidden" name="page" value="1" id="page" />

        <input type="hidden" name="pageSize" value="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" id="pageSizes" />
        <table class="left searchbartable" id="searchbox">
            <tr>
                <th>
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductSKU<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
                </th>
                <td >
                    <input type="text" name="product_sku" class="text-input width140 leftloat" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['product_sku_like'];?>
"   />
                </td>
                <th>
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
warehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
                </th>
                <td>
                    <select class="text-input width155" name="warehouse_id">
                        <option value=""><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
all<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
                        <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['warehouse']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['warehouse_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['condition']->value['warehouse_id']==$_smarty_tpl->tpl_vars['row']->value['warehouse_id']){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['row']->value['warehouse_name'];?>
</option>
                        <?php } ?>

                    </select>
                </td>
                <td>
                    <div  style="float: left; margin-left: 10px; "> <a onclick="$('#pagerForm').submit()" class="button"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a> <a onclick="addSafeInventory();" class="button"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
add<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a> <a onclick="batchUpload();" class="button"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
batch_upload<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
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
        <th align="center" nowrap="nowrap" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductSKU<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
        <th align="center" nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
warehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
        <th align="center" nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SafetyStock<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
        <th align="center" nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
addTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
        <th align="center" nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
updateTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
        <th align="center" nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
operate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
    </tr>
    </thead>


    <tbody>
    <?php if ($_smarty_tpl->tpl_vars['result']->value!=''){?>
    <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
        <tr>
            <td style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['row']->value['product_sku'];?>
</td>
            <td style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['row']->value['warehouse_name'];?>
</td>
            <td style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['row']->value['safe_number'];?>
</td>
            <td style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['row']->value['add_time'];?>
</td>
            <td style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['row']->value['update_time'];?>
</td>
            <td style="text-align:center">
                <a class="edit" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
edit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="editSf('<?php echo $_smarty_tpl->tpl_vars['row']->value['si_id'];?>
','<?php echo $_smarty_tpl->tpl_vars['row']->value['product_sku'];?>
','<?php echo $_smarty_tpl->tpl_vars['row']->value['warehouse_id'];?>
','<?php echo $_smarty_tpl->tpl_vars['row']->value['safe_number'];?>
')" href="javascript:void(0);">
                    <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
edit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span>
                </a>
                <a class="edit" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
delete<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" onclick="if(!confirm('<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
AreYouSureToDelete<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
'))return false;" href="/merchant/product/delete-safe-inventory/si_id/<?php echo $_smarty_tpl->tpl_vars['row']->value['si_id'];?>
">
                    <span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
delete<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span>
                </a>

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

<div id="editSafeInventory" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
edit_safety_stock<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" style="display:none">
    <form action="/merchant/product/edit-safe-inventory" method="post"  id="editForm">
        <input type="hidden" name="si_id" value="" />
        <table style="border:0px solid #F3F3F3;">
            <tr>
                <th>
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
warehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
                </th>
                <td>
                    <select id="editFormWarehouseId" class="text-input width195" name="warehouse_id" disabled>
                        <option value=""><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pleaseSelected<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
                        <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['warehouse']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['warehouse_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['condition']->value['warehouse_id']==$_smarty_tpl->tpl_vars['row']->value['warehouse_id']){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['row']->value['warehouse_name'];?>
</option>
                        <?php } ?>

                    </select>
                </td>
            </tr>
            <tr>
                <th>
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
skuCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
                </th>
                <td>
                    <input id="editFormProductSku" type="text" name="product_sku" class="text-input width180 leftloat" value="" disabled />
                </td>
            </tr>
            <tr>
                <th>
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SafetyStock<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
                </th>
                <td>
                    <input id="editFormSafeNumber" type="text" name="safe_number" class="text-input width180 leftloat" value="" />
                </td>
            </tr>
        </table>
    </form>

</div>

<div id="importSafeInventory" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
batch_import_safety_stock<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" style="display:none">
    <form action="/merchant/product/batch-input-safe-number" method="post" id="SafeInputForm">
        <table>
            <tr>
                <td>
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
export_xls<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</td><td><input type="file" name="XMLForInput" />
                </td>
                <td>
                </td>
            </tr>
            <tr>

                <td>&nbsp;</td>
                <td><p>
                    <img src="/images/download.png" style="width:25px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
download_templete<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:	<a  style="text-decoration:underline;" href="/merchant/product/product-sf-templete"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
product_template<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
                </p>
                </td>
            </tr>


        </table>
    </form>

    <table cellspacing="0" cellpadding="0" class="formtable tableborder">
        <thead>
        <tr>
            <th width='70'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
skuCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th width='200'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
notice1<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
        </tr>
        </thead>
        <tbody id='orderproductserror'>

        </tbody>
    </table>

    <div id="message" style="text-align: center;margin-top: 20px;margin-left: 20px;margin-right: 20px;background: #F56D04;padding: 10px;display: none;">

    </div>


</div>

<div id="addSafeInventory" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
add_safety_stock<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" style="display:none">
    <div class="modelcontent" style="display: block;">
        <div>
            <a style="display: block; padding: 10px; width: 60px; margin-bottom: 5px; float: left;" class="ui-state-default  ui-corner-all" id="dialog_link" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductInfo<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" href="#"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SelectProduct<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
            <span style="margin-left: 5px; margin-top: 12px; display: block; float: left; color: red; font-size: 1.1em;" class="jiahuowarehouse1">*</span>
        </div>

        <form id="addForm" class="pageForm required-validate" method="POST" action="/merchant/product/add-safe-inventory">

        <div class="nbox_c marB10" style="margin-right:0px;">
            <table class="pageFormContent">
                <tr class="jiahuowarehouse" style="display: table-row;">
                    <td width="175" style="text-align:right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
warehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td colspan="3">
                        <select id="addFormWarehouseId" class="text-input width195" name="warehouse_id">
                            <option value=""><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pleaseSelected<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
                            <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['warehouse']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['warehouse_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['condition']->value['warehouse_id']==$_smarty_tpl->tpl_vars['row']->value['warehouse_id']){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['row']->value['warehouse_name'];?>
</option>
                            <?php } ?>

                        </select>
                        <span style="color: red;">*</span>
                    </td>
                </tr>
            </table>
        </div>

        <div class="nbox_c marB10" style="margin-right:0px;">
            <table cellspacing="0" cellpadding="0" class="formtable tableborder" style="display: table;">
                <thead>
                <tr>
                    <th width="200" align="center"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
skuCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                    <th align="center"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
productTitle<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                    <th align="center" width="150"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SafetyStock<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                    <th align="center" width="100"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
operate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                </tr>
                </thead>
                <tbody id="orderproducts">

                </tbody>
            </table>
            <div class="clear"></div>
        </div>

        </form>
    </div>
</div>

<div id="dialog" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SelectProduct<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" style="display:none">
</div>
<script>

    function addSafeInventory(){
        $("#addSafeInventory").dialog('open');
    }

    function editSafeInventory(){
        $("#editSafeInventory").dialog('open');
    }

    function batchUpload(){
        $("#importSafeInventory").dialog('open');
    }

</script>


<script>
    var importok = "0";
    $(function(){

        getProductListBoxData('order');

        //产品浏览
        $('#dialog_link').click(function(){
            //$('#dialog').html();
            $('#dialog').dialog('open');
            return false;
        });


        $(".orderactionSku").live("click", function () {
            var productId = $(this).attr("productId");
            var productSku = $(this).attr("productSku");
            var productName = $(this).attr("productName");
            var category = $(this).attr("category");
            var productWeight = $(this).attr("productWeight");
            if ($(this).is(':checked')){
                if($("#orderproduct"+productId).size()==0){
                    if ($("#orderproduct" + productId).size() == 0) {
                        var html = '';
                        html += '<tr id="orderproduct' + productId + '" class="product_sku">';
                        html += '<td style="text-align: center;"><a href="/merchant/product/detail/productId/'+productId+'" target="_blank">' + productSku + '</a><input type="hidden" name="product_sku[' + productId + ']" value="' + productSku + '"><input type="hidden" name="product_id[' + productId + ']" value="' + productId + '"/></td>';
                        html += '<td style="text-align: center;" title="'+productName+'">' + productName + '</td>';
                        html += '<td style="text-align: center;" ><input type="text" class="inputbox inputMinbox" name="safeNumber[' + productId + ']"  value="" size="6">&nbsp;<strong style="color: red;">*</strong></td>';
                        html += '<td style="text-align: center;" ><a class="productDel" href="javascript:;" title="delete"><img src="/images/icon_del.gif"></a></td>';
                        html += '</tr>';
                        $("#orderproducts").append(html);
                    }
                }
            }else{
                if($("#orderproduct"+productId).size()>0){
                    $("#orderproduct"+productId).remove();
                }
            }
        });

        $(".productDel").live("click",function(){
            $(this).parent().parent().remove();
        });

        //按默认类
        $("#productlist").alterBgColor();
        $("#searchbox").switchToAdvancedSearch({button_id:'.switch_search_model',class_name:'advanced_element',cookName:"safe_inventory_search_mode"});

        $('#dialog').dialog({
            autoOpen: false,
            modal: false,
            bgiframe:true,
            width: 850,
            height:500,
            resizable: true
        });
        $('#importSafeInventory').dialog({
            autoOpen: false,
            modal: false,
            bgiframe:true,
            width: 700,
            height:500,
            resizable: true,
            close:function(){
                if(importok=="1"){
                    window.location.href='/merchant/product/safe-inventory-list';
                }else{
                    reseterrorrow();
                }

            },buttons:{
                '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
close<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
                    $('#SafeInputForm').resetForm();
                    $("#message").html("");
                    $("#message").hide();
                    $('#importSafeInventory').dialog('close');
                },'<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Determine<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
                    do_import_action();
                }
            }/*buttons*/

        });

        $('#addSafeInventory').dialog({
            autoOpen: false,
            modal: false,
            bgiframe:true,
            width: 850,
            height:500,
            resizable: true,
            buttons:[
                {
                    text: "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
cancel<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",
                    click: function () {
                        $(this).dialog("close");
                    }
                },
                {
                    text: "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Determine<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",
                    click: function () {
                        var data = $("#addForm").serialize();
                        var product_sku = $("#addFormProductSku").val();
                        var warehouse_id = $("#addFormWarehouseId").val();
                        var safe_number = $("[name='safe_number']").val();
                        var errorMessage = "";
                        if(warehouse_id==""){
                            errorMessage+="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Warehouse_required<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
                        }
                        if(errorMessage!=""){
                            alertTipWrong(errorMessage);
                            return false;
                        }
                        $.ajax({
                            type:"POST",
                            async:false,
                            dataType:'json',
                            url:"/merchant/product/add-safe-inventory",
                            data:data,
                            success:function(json){
                                if(json.state=="0"){
                                    var html = "";
                                    $.each(json.error,function(k,v){
                                        html+=v+"<br>";
                                    })
                                    alertTipWrong(html);
                                }else{
                                    var html = "";
                                    $.each(json.message,function(k,v){
                                        html+=v+"<br>";
                                    })
                                    alertTip(html);
                                }
                            }
                        })
                    }
                }
            ], close: function () {
                $(this).dialog("close");
            }
        });

        $('#editSafeInventory').dialog({
            autoOpen: false,
            modal: false,
            bgiframe:true,
            width: 400,
            height:300,
            resizable: true,
            buttons:[
                {
                    text: "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
cancel<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",
                    click: function () {
                        $(this).dialog("close");
                    }
                },
                {
                    text: "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Determine<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",
                    click: function () {
                        var data = $("#editForm").serialize();
                        var product_sku = $("#editFormProductSku").val();
                        var warehouse_id = $("#editFormWarehouseId").val();
                        var safe_number = $("[name='safe_number']").val();
                        var errorMessage = "";
                        if(warehouse_id==""){
                            errorMessage+="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Warehouse_required<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
                        }
                        if(product_sku==""){
                            errorMessage+="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
product_sku_required<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
                        }
                        if(safe_number==""){
                            errorMessage+="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
safety_stock_required<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
                        }
                        if(errorMessage!=""){
                            alertTipWrong(errorMessage);
                            return false;
                        }
                        $.ajax({
                            type:"POST",
                            async:false,
                            dataType:'json',
                            url:"/merchant/product/edit-safe-inventory",
                            data:data,
                            success:function(json){
                                if(json.state=="0"){
                                    var html = "";
                                    $.each(json.error,function(k,v){
                                        html+=v+"<br>";
                                    })
                                    alertTipWrong(html);
                                }else{
                                    alertTip(json.message);
                                    //window.location.href='/merchant/product/safe-inventory-list';
                                }
                            }
                        })
                    }
                }
            ], close: function () {
                $(this).dialog("close");
            }
        });

    })

    /*导入动作*/
    function do_import_action(){

        if($("input[name='XMLForInput']").val()=='')
        {
            alert("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_select_file<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
");
            return;
        }
        $('#SafeInputForm').ajaxSubmit({
            dataType:'json',
            success:function(json){
                if(json.ask==1){
                    var html = "";
                    $.each(json.data,function(k,v){
                        html+="<tr>";
                        html+="<td>"+ v.product_sku+"</td>";
                        html+="<td>"+ v.error+"</td>";
                        html+="</tr>";
                    })
                    $("#orderproductserror").html(html);
                    importok = "1";
                }else if(json.ask==0){
                    html = "<tr><td colspan='2'>"+json.message+"</td> </tr>";
                    $("#orderproductserror").html(html);
                    importok = "0";
                }else{
                    html = "<tr><td colspan='2'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
file_format_error_or_file_content_is_wrong<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td> </tr>";
                    importok = "0";
                }
                $('#SafeInputForm').resetForm();
            },
            error:function(json){
                alertTipWrong("not submit!");
            }
        });

    }

    function reseterrorrow(){

        $("#orderproductserror").empty();

    }

    function del(){

    }

    function editSf(si_id,product_sku,warehouse_id,safe_number){
        $("#editSafeInventory").dialog('open');
        $('[name="si_id"]').val(si_id);
        $("#editFormProductSku").val(product_sku);
        $("#editFormWarehouseId").val(warehouse_id);
        $("#editFormSafeNumber").val(safe_number);
    }

    function alertTip(tip,width,height,notflash) {
        width = width?width:500;
        height = height?height:'auto';
        $('<div title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
notice<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"><p align="">' + tip + '</p></div>').dialog({
            autoOpen: true,
            width: width,
            height: height,
            modal: true,
            show:"slide",
            buttons: {
                '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
close<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
                    $(this).dialog('close');
                }
            },
            close: function() {
                window.location.href='/merchant/product/safe-inventory-list';
            }
        });
    }

    function alertTipWrong(tip,width,height,notflash){
        width = width?width:500;
        height = height?height:'auto';
        $('<div title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
notice<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"><p align="">' + tip + '</p></div>').dialog({
            autoOpen: true,
            width: width,
            height: height,
            modal: true,
            show:"slide",
            buttons: {
                '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
close<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
                    $(this).dialog('close');
                }
            },
            close: function() {

            }
        });
    }

</script>


<script>
    $(function(){
        //$("#productlist").colResizable();
    });
</script><?php }} ?>