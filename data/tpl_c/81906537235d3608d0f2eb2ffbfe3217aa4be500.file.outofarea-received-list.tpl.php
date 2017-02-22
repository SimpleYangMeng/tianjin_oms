<?php /* Smarty version Smarty-3.1.13, created on 2014-07-10 15:12:27
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/purchaseOrder/outofarea-received-list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:118839186753bdf8df970d93-95931344%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '81906537235d3608d0f2eb2ffbfe3217aa4be500' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/purchaseOrder/outofarea-received-list.tpl',
      1 => 1404976327,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '118839186753bdf8df970d93-95931344',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53bdf8dfa864f7_42991822',
  'variables' => 
  array (
    'page' => 0,
    'pageSize' => 0,
    'params' => 0,
    'result' => 0,
    'item' => 0,
    'count' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53bdf8dfa864f7_42991822')) {function content_53bdf8dfa864f7_42991822($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
if (!is_callable('smarty_modifier_date_format')) include '/home/apache/www/import/oms/libs/Smarty/plugins/modifier.date_format.php';
?><style type="text/css">
    .btn:hover, .btn:focus, .btn-active, .btn-sub {
        background:#5998D7;
        color: #333;
    }
    .clear{
        clear: both;
    }
    .print{
        margin: 5px;
    }
</style>

<div class="content-box  ui-tabs  ui-corner-all  ui-widget ui-widget-content">
    <div class="content-box-header">
        <h3 style="margin-left:5px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
out_of_area_received_list<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
        <div class="clear"></div>
    </div>
    <form name="searchASNForm"  method="post" action="/merchant/purchase-order/outofarea-received-list" id="pagerForm">
        <input type="hidden" name="page" value="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" id="page" />
        <input type="hidden" name="pageSize" value="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" id="pageSizes" />
        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['params']->value['receiving_status'];?>
" name="receiving_status">
        <div class="searchBar">
            <table  class="border"  id="searchbox">
                <tbody>
                <tr>
                    <td  class="form_title"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
tracking_number<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td  class="form_input"><input class="text-input width180 leftloat" type="text"  name="tracking_number" value="<?php echo $_smarty_tpl->tpl_vars['params']->value['tracking_number'];?>
">
					
						<div class="simplesearchsubmit" style="float:left;">
						<a  onclick="$('#pagerForm').submit()" class="button"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
						<a type="button" class="button export" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
export<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
						<a class="switch_search_model">切换到高级搜索</a> 
						
						</div>
					
					
					
					</td>
                    <td  class="form_title"><span class="advanced_element"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
purchase_order_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</span></td>
                    <td  class="form_input" colspan="3"><span class="advanced_element"><input class="text-input width180" type="text"  name="po_code" value="<?php echo $_smarty_tpl->tpl_vars['params']->value['po_code'];?>
"></span></td>

                </tr>

               
					<tr  class="advanced_element">					
                    <td   class="form_title"><span class="advanced_element"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
createDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</span></td>
                    <td colspan="5"   class="form_input"  nowrap="nowrap">
					  <span class="advanced_element">
                        <input type="text" class="datepicker text-input width180" value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['params']->value['created_start'],'%Y-%m-%d');?>
" name="created_start" readonly="true">&nbsp;到&nbsp;
                        <input type="text" class="datepicker text-input width180" value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['params']->value['created_end'],'%Y-%m-%d');?>
" name="created_end" readonly="true">
                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['params']->value['receiving_status'];?>
" name="receiving_status" id="receiving_status">
						</span>
						

						<div class="advancedsearchsubmit">
						<a  onclick="$('#pagerForm').submit()" class="button"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
						<a type="button" class="button export" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
export<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
						<a class="switch_search_model">切换到高级搜索</a> 
                        
						</div>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
    </form>

</div>



<div class="clear"></div>

    <div class="grid">
        <form  method="post" id='DataForm'   target="_blank">
            <table   style="margin-top: 10px;"  class="table" width="100%"  id="loadData">
                <thead>
                <tr>
                    <th style="text-align:center;width:25px"><input type="checkbox" class="ordercheckAll"></th>
                    <th  ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
tracking_number<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                    <th  ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
express_company<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                    <th  ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
purchase_order_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                    <th  ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
sku<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
					<th  ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
QuantityReceived<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                    <th  ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
createDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
					<th  ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
					<th  ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ReceiveCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                    <th  ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
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
                    <tr target="pid">
                        <td style="text-align:center;width:25px"><input type="checkbox" name="orderArr[]" ref="<?php echo $_smarty_tpl->tpl_vars['item']->value['po_tb_id'];?>
" class="orderArr" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['po_tb_id'];?>
" /></td>
                        <td style="text-align:center;">
                           <span><?php echo $_smarty_tpl->tpl_vars['item']->value['tracking_number'];?>
</span>
                        </td>
                        <td style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['item']->value['express_company'];?>
</td>
                        <td style="text-align:center">
                            <?php echo $_smarty_tpl->tpl_vars['item']->value['po_code'];?>

                        </td>
                        <td style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['item']->value['product_sku'];?>
</td>
						<td style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['item']->value['received_quantity'];?>
</td>
                        <td style="text-align:center" nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['item']->value['create_time'];?>
</td>
						<td style="text-align:center" nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['item']->value['po_tb_status_text'];?>
</td>
						<td style="text-align:center" nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['item']->value['receiving_code'];?>
</td>
                        <td style="text-align:center">        	     
					
                            <a class="view" href="/merchant/purchase-order/purchase-received-detail?po_t_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['po_t_id'];?>
"
                               onclick="parent.openMenuTab('/merchant/purchase-order/purchase-received-detail?po_t_id=<?php echo $_smarty_tpl->tpl_vars['item']->value['po_t_id'];?>
','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PurchaseReceivedDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(<?php echo $_smarty_tpl->tpl_vars['item']->value['receiving_code'];?>
)','PurchaseReceivedDetail<?php echo $_smarty_tpl->tpl_vars['item']->value['po_t_id'];?>
');return false;" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PurchaseReceivedDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" ><span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
view<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span></a>
							   
							<?php if ($_smarty_tpl->tpl_vars['item']->value['po_tb_status']=='0'){?>
								<a href="" onclick="closePurchaseOrderTrackingBody('<?php echo $_smarty_tpl->tpl_vars['item']->value['po_tb_id'];?>
');return false;">转为已审核</a>
							<?php }?>   
							   
							   
                        </td>
                    </tr>
                    <?php } ?>
                <?php }else{ ?>
                <tr>
                    <td colspan="10"  style="text-align:center"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
NoDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
                </tr>
                <?php }?>

                </tbody>
            </table>
        </form>
    </div>
	<div class="clear"></div>
    <div class="pagination" targetType="navTab" totalCount="<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
" numPerPage="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" currentPage="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"></div>


<div id="exportdialog" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
export<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" style="display:none">
	<input type="radio" name="exportType" value="1" checked="checked"/> <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
selected<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 <input type="radio" name="exportType" value="0"/> <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
all<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

</div>



<script>
$(function(){
   //
    $("#loadData").alterBgColor();
	$("#searchbox").switchToAdvancedSearch({button_id:'.switch_search_model',class_name:'advanced_element'});
	
	

   $('#exportdialog').dialog({
        autoOpen: false,
        modal: false,
        bgiframe:true,
        width: 850,
        resizable: true,
		position:[50,150],
        close:function(){
            //alert('close');
        },buttons:{
            '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
close<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
                $('#exportdialog').dialog('close');
            },'<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Determine<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {

                var exportType = $('[name=exportType]:checked').val();
                var exportformat = $('[name=exportformat]:checked').val();
                $('.dateformate').val(exportformat);
                if(exportType=='1'){
                    //选择的订单
                   /* var exportformat = $('[name=exportformat]').val();
                    param+="&exportType="+exportType;
                    param+="&exportformat="+exportformat;

                    alert(exportType);*/

                    var param = $("#DataForm").serialize();
                    var checkedSizesize = $('.orderArr:checked').size();
                    if(checkedSizesize<=0){
                        alertTip("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pleaseOne<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",'500','auto','1');
                        return;
                    }
                    //alert($('#pagerForm').attr('action'));

                    $('#DataForm').attr('action','/merchant/purchase-order/outofarea-received-export');
                    $('#DataForm').attr('method','POST');
                    $('#DataForm').submit();

                    $('#DataForm').removeAttr('action');
                    $('#DataForm').removeAttr('method');

                }else if(exportType=='0'){
                    //全部的
                    $('#pagerForm').attr('action','/merchant/purchase-order/outofarea-received-export');
                    $('#pagerForm').attr('method','POST');
                    $('#pagerForm').submit();
                    $('#pagerForm').attr('action','/merchant/purchase-order/outofarea-received-list');
                    //$('#orderDataForm').removeAttr('method');

                }
                return;
            }
        }
    });	

   $('.export').bind('click',function(){

       $('#exportdialog').dialog('open');
   });	
    
})
</script>

<script type="text/javascript" src='/loadjs/loadjs/name/purchaseorderTracking'></script><?php }} ?>