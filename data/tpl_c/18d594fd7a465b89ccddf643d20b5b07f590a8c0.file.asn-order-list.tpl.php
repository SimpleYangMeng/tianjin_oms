<?php /* Smarty version Smarty-3.1.13, created on 2014-07-02 15:49:33
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/order/asn-order-list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17411963153b3b98daadcf7-66660452%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '18d594fd7a465b89ccddf643d20b5b07f590a8c0' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/order/asn-order-list.tpl',
      1 => 1396509521,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17411963153b3b98daadcf7-66660452',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page' => 0,
    'pageSize' => 0,
    'orders_status' => 0,
    'params' => 0,
    'orderType' => 0,
    'k' => 0,
    'w' => 0,
    'shipType' => 0,
    'st' => 0,
    'warehouse' => 0,
    'result' => 0,
    'item' => 0,
    'row' => 0,
    'count' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53b3b98dc31df4_75314046',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b3b98dc31df4_75314046')) {function content_53b3b98dc31df4_75314046($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><style type="text/css">
    .btn:hover, .btn:focus, .btn-active, .btn-sub {
        background-color: #666;
        color: #FFFFFF;
    }
</style>



<div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CollectingOrderList<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
    </div>
    <form name="searchASNorderForm"  method="post" action="/merchant/order/list-asn-order" id="pagerForm">
        <input type="hidden" name="page" value="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" id="page" />
        <input type="hidden" name="pageSize" value="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" id="pageSizes" />
        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['orders_status']->value;?>
" name="orders_status" class='status'>
        <div class="searchBar">
            <table  class="left" cellspacing="5" cellpadding="5">
                <tbody>
                <tr>
                    <td><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
/<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
TradingOrderNo<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</td>
                    <td><input type="text" class="text-input width160" name="new_reference_no" id='orders_code' value="<?php echo $_smarty_tpl->tpl_vars['params']->value['new_reference_no'];?>
"></td>
                    <!--<th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderType<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</th>
                    <td>
                        <select name="order_type" class="text-input width180">
                            <option value=''>-Select-</option>
                            <?php  $_smarty_tpl->tpl_vars['w'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['w']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['orderType']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['w']->key => $_smarty_tpl->tpl_vars['w']->value){
$_smarty_tpl->tpl_vars['w']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['w']->key;
?>
                            <option value='<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
'<?php if (isset($_smarty_tpl->tpl_vars['params']->value)&&$_smarty_tpl->tpl_vars['params']->value['order_type']==$_smarty_tpl->tpl_vars['k']->value){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['w']->value;?>
</option>
                            <?php } ?>
                        </select>
                    </td>-->
                    <td><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
shippingMethod<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</td>
                    <td align='left'>
                        <select name="shipping_method" class="text-input width180">
                            <option value="">-<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
all<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
-</option>
                            <?php  $_smarty_tpl->tpl_vars['st'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['st']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['shipType']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['st']->key => $_smarty_tpl->tpl_vars['st']->value){
$_smarty_tpl->tpl_vars['st']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['st']->key;
?>
                            <?php if ($_smarty_tpl->tpl_vars['st']->value=="CNAM"||$_smarty_tpl->tpl_vars['st']->value=="CNEMS"||$_smarty_tpl->tpl_vars['st']->value=="NEUB"){?>
                            <option value='<?php echo $_smarty_tpl->tpl_vars['st']->value;?>
' <?php if (isset($_smarty_tpl->tpl_vars['params']->value)&&$_smarty_tpl->tpl_vars['params']->value['sm_code']==$_smarty_tpl->tpl_vars['st']->value){?> selected<?php }?> ><?php echo $_smarty_tpl->tpl_vars['st']->value;?>
</option>
                            <?php }?>
                            <?php } ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <!--<th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
warehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</th>
                    <td><select name="warehouse_id" class="text-input width180">
                        <option value="">-Select-</option>
                        <?php  $_smarty_tpl->tpl_vars['w'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['w']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['warehouse']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['w']->key => $_smarty_tpl->tpl_vars['w']->value){
$_smarty_tpl->tpl_vars['w']->_loop = true;
?>
                        <option value='<?php echo $_smarty_tpl->tpl_vars['w']->value['warehouse_id'];?>
' <?php if (isset($_smarty_tpl->tpl_vars['params']->value)&&$_smarty_tpl->tpl_vars['params']->value['warehouse_id']==$_smarty_tpl->tpl_vars['w']->value['warehouse_id']){?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['w']->value['warehouse_code'];?>
</option>
                        <?php } ?>
                    </select>
                    </td>-->
                    <td><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
createDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</td>
                    <td colspan="3">
                        <input type="text" class="datepicker text-input width140" value="<?php echo $_smarty_tpl->tpl_vars['params']->value['add_time_start'];?>
" name="add_time_start" readonly="true">~
                        <input type="text" class="datepicker text-input width140" value="<?php echo $_smarty_tpl->tpl_vars['params']->value['add_time_end'];?>
" name="add_time_end" readonly="true">
                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['orders_status']->value;?>
" name="orders_status" class="status">
                        <a  onclick="do_search();return false;" class="button"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
                        <a type="button" class="button" value="0" id="foldToggle"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Expand<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
/<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Collapse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
    </form>

</div>



<div class="clear"></div>



    <form  method="post" id='orderDataForm'>
        <table id="loadData"  class="table" width="100%" layoutH="138">
            <thead class="caption">
            <tr>
                <th style="text-align:center;" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                <th style="text-align:center;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CustomerReference<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                <th style="text-align:center;" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderType<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                <th style="text-align:center;" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
shippingMethod<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                <th style="text-align:center;" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
consignee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
state<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                <th style="text-align:center;" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
createDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                <th style="text-align:center;" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
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
                <tr class="" target="pid" rel="<?php echo $_smarty_tpl->tpl_vars['item']->value['order_id'];?>
"  >
                    <td style="width:30px;text-align:center" nowrap="nowrap"><a href="javascript:void(0);" onclick="showProduct('<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
')"><?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
</a></td>
                    <td style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['item']->value['reference_no'];?>
</td>
                    <td style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['item']->value['order_type_text'];?>
</td>
                    <td style="text-align:center">
                        <?php echo $_smarty_tpl->tpl_vars['item']->value['sm_code'];?>

                    </td>
                    <td style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['item']->value['state'];?>
</td>
                    <td style="text-align:center" nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['item']->value['add_time'];?>
</td>
                    <td style="text-align:center">
                    <input type="checkbox" name="oid" state="<?php echo $_smarty_tpl->tpl_vars['item']->value['state'];?>
"  orderCode="<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
" reference_no="<?php echo $_smarty_tpl->tpl_vars['item']->value['reference_no'];?>
" orderId="<?php echo $_smarty_tpl->tpl_vars['item']->value['order_id'];?>
" shipType="<?php echo $_smarty_tpl->tpl_vars['item']->value['sm_code'];?>
" countryName="<?php echo $_smarty_tpl->tpl_vars['item']->value['country_name'];?>
" createDate="<?php echo $_smarty_tpl->tpl_vars['item']->value['add_time'];?>
" class="actionOrder" />
                    </td>
                </tr>
                <tr class="order_product son"    id="<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
" status="0">
                    <td colspan="7" >
                        <table style="float:left;width:100%; margin:0;padding:0;border:1px solid #CCCCCC;border-collapse:collapse;">
                            <tr>
                                <td  style="text-align:center"  nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
productBarcode1<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
                                <td  style="text-align:center"  nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
quantity<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
                                <td  style="text-align:center"  nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductCategory<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
                                <td  style="text-align:center"  nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
totalweight<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 (KG)</td>
                                <td  style="text-align:center"  nowrap="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
declaredValue<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
                            </tr>
                            <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['item']->value['order_product']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                            <tr>
                                <td style="text-align:center" nowrap="nowrap">
                                    <a class="edit"  title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" rel="productView"
                                       target="navTab" href="/merchant/product/detail?productId=<?php echo $_smarty_tpl->tpl_vars['row']->value['product_id'];?>
">
                                        <span><?php echo $_smarty_tpl->tpl_vars['row']->value['product_barcode'];?>
</span>
                                    </a></td>
                                <td style="text-align:center" nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['row']->value['op_quantity'];?>
</td>
                                <td style="text-align:center" nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['row']->value['category_name'];?>
</td>
                                <td style="text-align:center" nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['row']->value['totalWeight'];?>
</td>
                                <td style="text-align:center" nowrap="nowrap"><!--<?php echo $_smarty_tpl->tpl_vars['row']->value['totalValue'];?>
(<?php echo $_smarty_tpl->tpl_vars['row']->value['currency_code'];?>
)--></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </td>
                </tr>
                <?php } ?>
            <?php }else{ ?>
            <tr>
                <td colspan="7"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
NoDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
            </tr>
            <?php }?>
            
            </tbody>
        </table>
    </form>

<div class="pagination" id="Pagination1" targetType="navTab" totalCount="<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
" numPerPage="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" currentPage="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" ajaxfun='pageselectCallback'></div>


<script>
$(function(){
    var total = $('#Pagination1').attr('totalcount');
    var currencypage=$('#Pagination1').attr('currentpage');
    var pageSize = $('#pageSizes').val()||$('#Pagination1').attr('numperpage');

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
        $("[name='page']").val(page_index+1);
        /*var from = $('#from').val();
        var sku = $("input[name='sku']").val();
        var title = $("input[name='title']").val();
        var type = $("#type").val();*/
        //var page_index = page_index||$('#current').val();
        getOrderList();
        return false;
    }
    return false;
});

function do_search(){
    /*var from = $('#from').val();
    var sku = $("input[name='sku']").val();
    var title = $("input[name='title']").val();
    var type = $("#type").val();*/
    var pageSize = $('#pageSizes').val()||$('#Pagination1').attr('numperpage');
    //getProductListBoxData(from,1,pageSize,sku,title,type);
    getOrderList();
}

//得到订单信息
/*function getOrderList(){
    $.ajax({
        type:'post',
        url:'/merchant/order/list-asn-order',
        data:$('#pagerForm').serializeArray(),
        dataType:'html',
        success:function(html){
            $("#dialog").html(html);
        }
    });
}*/

	/*选则项要跟页面一致*/
	function keepTheInterface(){
		
		var pids = $("input[name='oid']");
		if(pids.size()==0){return;}		
			pids.each(function(i){
				_this = $(this);				
				var orderid = _this.attr('orderid');				
				if($("#asnorder"+orderid).size()==0){					
					_this.attr("checked",false);
				}else{
					_this.attr("checked",true);
				}
				
						
				
			}); 
			
			resetbgcolor();	
	
	}	
	function resetbgcolor(){

		var pids = $("input[name='oid']");
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
$(function(){
   //保持界面一致
   	keepTheInterface();  
    $("#loadData").alterBgColor();
    $('#dialog').dialog({
        autoOpen: false,
		position: ['center','top'],
        modal: false,
        bgiframe:true,
        width: 850,
		minHeight:100,
        resizable: false
    });
})
</script>
<!--<script type="text/javascript" src='/js/order.js'></script>-->
<script type="text/javascript" src='/loadjs/loadjs/name/order'></script>
<?php }} ?>