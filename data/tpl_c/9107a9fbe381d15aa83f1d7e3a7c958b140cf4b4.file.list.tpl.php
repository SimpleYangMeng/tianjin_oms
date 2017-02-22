<?php /* Smarty version Smarty-3.1.13, created on 2015-11-13 15:11:39
         compiled from "D:\www\import_oms\branches\tianjin\application\modules\merchant\views\inventory\list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1651356458d2bba03d3-62649512%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9107a9fbe381d15aa83f1d7e3a7c958b140cf4b4' => 
    array (
      0 => 'D:\\www\\import_oms\\branches\\tianjin\\application\\modules\\merchant\\views\\inventory\\list.tpl',
      1 => 1446298491,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1651356458d2bba03d3-62649512',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page' => 0,
    'pageSize' => 0,
    'condition' => 0,
    'allWarehouse' => 0,
    'item' => 0,
    'result' => 0,
    'lang' => 0,
    'count' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56458d2bdce026_89293079',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56458d2bdce026_89293079')) {function content_56458d2bdce026_89293079($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\import_oms\\branches\\tianjin\\libs\\Smarty\\plugins\\block.t.php';
?><div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
inventory_query<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>        
    </div>   

	

	<div class="pageHeader">
    <form action="/merchant/inventory/list" method="post" id="pagerForm">
        <input type="hidden" name="page" value="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" id="page" />
        <input type="hidden" name="pageSize" value="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" id="pageSizes"/>

        <div class="searchBar">
            <table>
                <tr>
      
					<td style="text-align:right;color:#000">
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
skuCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
                    </td>
                    <td style="text-align: left;">
                        <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['product_sku'];?>
" name="product_sku_s" class="text-input width140 "/>
                       
                    </td>				
					<td style="text-align:right;color:#000">
					<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
the<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
warehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
					</td>
                    <td style=" text-align:left">
                        <select class="text-input width155" name="warehouse_id_s">
                            <option value=""><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
all<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
							<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['allWarehouse']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['warehouse_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['condition']->value['warehouse_id']==$_smarty_tpl->tpl_vars['item']->value['warehouse_id']){?>selected<?php }?>  ><?php echo $_smarty_tpl->tpl_vars['item']->value['warehouse_name'];?>
</option>
                        	<?php } ?>
						</select>
							
						
						 
                    </td>
                    <td style="text-align:right;color:#000">
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
productTitle<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
                    </td>
                    <td style="text-align: left;">
                        <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['product_title'];?>
" name="product_title" class="text-input width140 "/>
                    </td>
					
					</tr>
					<tr>
					<td>&nbsp;</td>
					<td style=" text-align:left"  colspan="10">
						<a class="button" href="#" onclick="$('#pagerForm').submit();return false;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
						<a type="button" class="button" id="export" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
export<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
inventory_record<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>	
						
                    </td>
                </tr>
            </table>
            
        </div>
    </form>
</div>

</div>
	 <form  method="post" enctype="multipart/form-data" id='DataForm'>
    <table class="table list" width="100%"  style="margin-top:5px;" id="finance-list-box">
        <thead>
        <tr>
          	<th style="text-align:center;width:30px;">                   
                    <input type="checkbox" class="checkAll">
            </th>		
            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
skuCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
productTitle<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th>物流仓储企业</th>
            
            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Pending<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Available<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SafetyStock<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            
            <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
shipment_occupation<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            
            
            <th  style="width:160px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pqoUpdateTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
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
            <tr>
			     <td width="30" style="text-align:center;"><input type="checkbox" name="Arr[]" ref="<?php echo $_smarty_tpl->tpl_vars['item']->value['pi_id'];?>
" class="Arr" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['pi_id'];?>
" /></td>
                <td >
                    <a class="edit" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"  onclick="parent.openMenuTab('/merchant/product/detail?productId=<?php echo $_smarty_tpl->tpl_vars['item']->value['product_id'];?>
','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(<?php echo $_smarty_tpl->tpl_vars['item']->value['product_sku'];?>
)','productdetail<?php echo $_smarty_tpl->tpl_vars['item']->value['product_id'];?>
');return false;" href="/merchant/product/detail?productId=<?php echo $_smarty_tpl->tpl_vars['item']->value['product_id'];?>
">
                        <?php echo $_smarty_tpl->tpl_vars['item']->value['product_sku'];?>

                    </a>
                </td>
                <td><?php if ($_smarty_tpl->tpl_vars['lang']->value=='en_US'){?><?php echo $_smarty_tpl->tpl_vars['item']->value['product_title_en'];?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['item']->value['product_title'];?>
<?php }?></td>
                <td>
                    <?php echo $_smarty_tpl->tpl_vars['item']->value['warehouse_name'];?>

                </td>
               
                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['pi_pending'];?>
</td>
                <td><?php if ($_smarty_tpl->tpl_vars['item']->value['pi_sellable']<$_smarty_tpl->tpl_vars['item']->value['safe_number']){?><font color="red"><?php echo $_smarty_tpl->tpl_vars['item']->value['pi_sellable'];?>
</font><?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['item']->value['pi_sellable'];?>
<?php }?></td>
                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['safe_number'];?>
</td>
                
                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['pi_reserved'];?>
</td>
                <!--<td><?php echo $_smarty_tpl->tpl_vars['item']->value['user_code'];?>
</td>-->
                <!--<td><?php echo $_smarty_tpl->tpl_vars['item']->value['fee_id'];?>
</td>-->
                
               
                <td  class="nowrap"><?php echo $_smarty_tpl->tpl_vars['item']->value['pi_update_time'];?>
</td>
                
            </tr>
            <?php } ?>
        <?php }?>
        </tbody>
    </table>
	</form>
	<div class="clear"></div>
    <div class="panelBar">
        <div class="pagination" targetType="navTab" totalCount="<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
" numPerPage="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" currentPage="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"  pageNumShown="10"></div>
    </div>


	<div id="export_dialog" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Export_inventory_records<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" style="display:none">
	<input type="radio" name="exportType" value="1" checked="checked"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
selected_inventory_records<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<input type="radio" name="exportType" value="0"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
all<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

 
	</div>
<script>

$(function(){    
    $('#export_dialog').dialog({
        autoOpen: false,
        modal: false,
        bgiframe:true,
        width: 850,
        resizable: true,
        close:function(){
            //alert('close');
        },buttons:{
            '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
close<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
                $('#export_dialog').dialog('close');
            },'<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Determine<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {

                var exportType = $('[name=exportType]:checked').val();               
                if(exportType=='1'){
                    //选择的订单
                   /* var exportformat = $('[name=exportformat]').val();
                    param+="&exportType="+exportType;
                    param+="&exportformat="+exportformat;

                    alert(exportType);*/

                    var param = $("#DataForm").serialize();
                    var checkedSizesize = $('.Arr:checked').size();
                    if(checkedSizesize<=0){
                        alertTip("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
at_least_select_one_inventory_record<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",'500','auto','1');
                        return;
                    }
                    //alert($('#pagerForm').attr('action'));

                    $('#DataForm').attr('action','/merchant/inventory/export');
                    $('#DataForm').attr('method','POST');
                    $('#DataForm').submit();

                    $('#DataForm').removeAttr('action');
                    //$('#orderDataForm').removeAttr('method');

                }else if(exportType=='0'){
                    //全部的订单
                    $('#pagerForm').attr('action','/merchant/inventory/export');
                    $('#pagerForm').attr('method','POST');
                    $('#pagerForm').submit();

                    $('#pagerForm').attr('action','/merchant/inventory/list');
                    //$('#orderDataForm').removeAttr('method');

                }
                return;
            }
        }
    });
});

$(function(){
   //按默认类   
    $("#finance-list-box").alterBgColor();
		$('#export').bind('click',function(){
        $('#export_dialog').dialog('open');
   });
    
});




</script>
<script>

  //全选
    $('.checkAll').die('click').live('click',function(){
        if ($(this).is(':checked')) {
            $(".Arr").attr('checked', true);
			
        } else {
            $(".Arr").attr('checked', false);
        }
		changeTrColor();
    });
	
	/*伴随全选按钮是否选中而变色*/
	function changeTrColor(){
	
		$(".Arr").each(function(){
				_this = $(this);
				if($('.checkAll').is(':checked')){			
					set_tr_class(_this.parent().parent(), true);			
				}else{			
					set_tr_class(_this.parent().parent(), false);		
				}					
						
		});		
	}

</script>



<?php }} ?>