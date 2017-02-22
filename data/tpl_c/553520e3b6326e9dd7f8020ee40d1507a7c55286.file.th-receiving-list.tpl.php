<?php /* Smarty version Smarty-3.1.13, created on 2015-11-13 15:39:33
         compiled from "D:\www\import_oms\branches\tianjin\application\modules\merchant\views\receiving\th-receiving-list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2089564593b50f33f3-66026608%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '553520e3b6326e9dd7f8020ee40d1507a7c55286' => 
    array (
      0 => 'D:\\www\\import_oms\\branches\\tianjin\\application\\modules\\merchant\\views\\receiving\\th-receiving-list.tpl',
      1 => 1446274897,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2089564593b50f33f3-66026608',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page' => 0,
    'pageSize' => 0,
    'params' => 0,
    'warehouseArr' => 0,
    'wh' => 0,
    'customerLogin' => 0,
    'customer' => 0,
    'AsnStatusArr' => 0,
    'k' => 0,
    'v' => 0,
    'receiving_status' => 0,
    'result' => 0,
    'item' => 0,
    'count' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_564593b537d346_08589356',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_564593b537d346_08589356')) {function content_564593b537d346_08589356($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\import_oms\\branches\\tianjin\\libs\\Smarty\\plugins\\block.t.php';
if (!is_callable('smarty_modifier_date_format')) include 'D:\\www\\import_oms\\branches\\tianjin\\libs\\Smarty\\plugins\\modifier.date_format.php';
?><style type="text/css">
    .btn:hover, .btn:focus, .btn-active, .btn-sub {
        background: #5998D7;
        color: #333;
    }
    .clear{
        clear: both;
    }
    .print{
        margin: 5px;
    }
    .condiv{
        float: left;
        margin-bottom: 5px;
        margin-left: 5px;
        width: 220px;
    }
    .changewidth .width140{
        width:130px;
    }
    .changewidth .width155{
        width:140px;
    }
    .condatediv{
        float: left;
        margin-bottom: 5px;
        margin-left: 5px;
    }
</style>

<div class="content-box  ui-tabs  ui-corner-all  ui-widget ui-widget-content" >
    <div class="content-box-header">
        <h3 style="margin-left:5px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ReturnASNList<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
        <div class="clear"></div>
    </div>
    <form name="searchASNForm"  method="post" action="/merchant/receiving/listth" id="pagerForm">
        <input type="hidden" name="page" value="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" id="page" />
        <input type="hidden" name="pageSize" value="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" id="pageSizes" />
        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['params']->value['receiving_status'];?>
" name="receiving_status">
        <div class="searchBar ">
            <table class="searchbartable" cellspacing="2" cellpadding="2"  border="0" id="searchbox">
                <tr>
                    <td  align="right" nowrap="nowrap" width="140" class="text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ReceiveCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
/<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CustomerReference2<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td    style="text-align:left;"><input class="text-input width140 leftloat" type="text"  name="receiving_code" value="<?php echo $_smarty_tpl->tpl_vars['params']->value['receiving_code_like'];?>
">
					<div class="simplesearchsubmit" style="float:left;margin-top:4px;">
						<a  onclick="$('#pagerForm').submit()" class="button"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a> 
						<a  class="button export" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
export<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
						<a class="switch_search_model"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
switch_to_advanced_search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>					</div>					</td>
                    <td align="right" nowrap="nowrap"><span  class="advanced_element"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
order_code_or_tranction_order_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</span></td>
                    <td >
                        <span  class="advanced_element">
                            <input type="text" class="text-input width140" value="<?php echo $_smarty_tpl->tpl_vars['params']->value['order_key_code'];?>
" name="order_key_code" />
                        </span>
                    </td>
                </tr>
                <tr  class="advanced_element">
                    <td align="right" nowrap="nowrap" class="text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DeliveryWarehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td>
                        <select name="warehouseId" class="text-input width155">
                            <option value="">-<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
all<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
-</option>
                            <?php  $_smarty_tpl->tpl_vars['wh'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['wh']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['warehouseArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['wh']->key => $_smarty_tpl->tpl_vars['wh']->value){
$_smarty_tpl->tpl_vars['wh']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['wh']->key;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['wh']->value['warehouse_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['wh']->value['warehouse_id']==$_smarty_tpl->tpl_vars['params']->value['warehouse_id']){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['wh']->value['warehouse_name'];?>
</option>
                            <?php } ?>
                        </select>
                    </td>
                    <td nowrap="nowrap" width="140" style="text-align: right;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
customerCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td nowrap="nowrap">
                        <select class="text-input width135" name='customerCode'>
                            <?php if ($_smarty_tpl->tpl_vars['customerLogin']->value['customer_type']!='1'){?>
                                <option value=''>全部</option>
                            <?php }?>
                            <?php  $_smarty_tpl->tpl_vars['customer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customer']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customerLogin']->value['priv_customer_code_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customer']->key => $_smarty_tpl->tpl_vars['customer']->value){
$_smarty_tpl->tpl_vars['customer']->_loop = true;
?>
                                    <option value='<?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
' <?php if ($_smarty_tpl->tpl_vars['customer']->value==$_smarty_tpl->tpl_vars['params']->value['customerCode']){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['customer']->value;?>
</option>
                            <?php } ?>
                       </select>
                    </td>
                </tr>
                <tr  class="advanced_element">
                    <td   class="text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
createDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                    <td colspan="5" style=" text-align:left;">
                        <input type="text" class="datepicker text-input width140" value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['params']->value['created_start'],'%Y-%m-%d');?>
" name="created_start" readonly="true">&nbsp;<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
&nbsp;
                        <input type="text" class="datepicker text-input width140" value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['params']->value['created_end'],'%Y-%m-%d');?>
" name="created_end" readonly="true">
                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['params']->value['receiving_status'];?>
" name="receiving_status" id="receiving_status">                    </td>
                </tr>
				<tr  class="advanced_element">
					<td colspan="6" style="  text-align:left">
							<div class="advancedsearchsubmit">	
					            <a  onclick="$('#pagerForm').submit()" class="button"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a> 
								<a  class="button export" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
export<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
								<a class="switch_search_model"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
switch_to_advanced_search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>							</div>					</td>
				</tr>
            </table>
           

        </div>
    </form>

</div>


<div class="btn_wrap">
    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['AsnStatusArr']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
    <input  class="statusBtn btn<?php if ($_smarty_tpl->tpl_vars['params']->value['receiving_status']==$_smarty_tpl->tpl_vars['k']->value){?> btn-active<?php }?>" value="<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
"
            name="<?php echo $_smarty_tpl->tpl_vars['v']->value;?>
" type='button' ref='<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
' id='statusBtn<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
' >
    <?php } ?>
</div>



<?php if ($_smarty_tpl->tpl_vars['params']->value['receiving_status']=='1'){?>
<div class="bulk-actions align-left" style="margin-top: 5px;  border-radius: 4px 4px 4px 4px;">
<select name="dropdown" class="text-input width140" id="batchSelect">
<option value=''><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectOperating<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
<option value='bacthConfirm'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BatchConfirm<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
</select>
<a class="button" href="#" id="batchSubmit"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Confirm<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
</div>
<?php }elseif($_smarty_tpl->tpl_vars['params']->value['receiving_status']=='2'){?>
<div class="bulk-actions align-left"  style="margin-top: 5px; border-radius: 4px 4px 4px 4px;">
<select name="dropdown" class="text-input width140" id="batchSelect">
    <option value=''><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
PleaseSelectOperating<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
    <option value='movepending'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
MoveToPendingAudit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
    <option value='movedraft'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
MoveDraft<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
</select>
    <a class="button" href="#" id="batchSubmit"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Confirm<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
</div>
<?php }?>
<div class="clear"></div>

    <div class="grid">
        <form  method="post" id='asnDataForm'>
            <table   style="margin-top: 10px;"  class="table" width="100%"  id="loadData">
                <thead>
                <tr>
                    <th style="text-align:center;width:25px"><input type="checkbox" class="asncheckAll"></th>
                    <th  ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ReceiveCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                    <th  ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CustomerReference2<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
					
                    <th  ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
DeliveryWarehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                    <th  ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ASNType<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                    <th  ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
createDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
				<?php if ($_smarty_tpl->tpl_vars['receiving_status']->value=='8'){?>
				<th style="text-align:center;" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
               
				<?php }else{ ?>
				 <th style="text-align:center;" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
operate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
				<?php }?>
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
                        <td style="text-align:center;width:25px"><input type="checkbox" name="AsnArr[]" ref="<?php echo $_smarty_tpl->tpl_vars['item']->value['receiving_code'];?>
" class="AsnArr" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['receiving_code'];?>
" /></td>
                        <td style="text-align:center;">
                            <a class="view" href="/merchant/receiving/detail?ASNCode=<?php echo $_smarty_tpl->tpl_vars['item']->value['receiving_code'];?>
"
                              onclick="parent.openMenuTab('/merchant/receiving/detail?ASNCode=<?php echo $_smarty_tpl->tpl_vars['item']->value['receiving_code'];?>
','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ASNDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(<?php echo $_smarty_tpl->tpl_vars['item']->value['receiving_code'];?>
)','receivedetail<?php echo $_smarty_tpl->tpl_vars['item']->value['receiving_code'];?>
');return false;" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ASNDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"><span><?php echo $_smarty_tpl->tpl_vars['item']->value['receiving_code'];?>
</span></a>
                        </td>
                        <td style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['item']->value['reference_no'];?>
</td>
						
                        <td style="text-align:center">
                            <?php echo $_smarty_tpl->tpl_vars['item']->value['warehouse'];?>

                        </td>
                        <td style="text-align:center"><?php echo $_smarty_tpl->tpl_vars['item']->value['typetext'];?>
</td>
                        <td style="text-align:center" nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['item']->value['receiving_add_time'];?>
</td>
                        <td style="text-align:center">

					<?php if ($_smarty_tpl->tpl_vars['receiving_status']->value=='8'){?>
					
						<?php if ($_smarty_tpl->tpl_vars['item']->value['receiving_status']=='0'){?>
						删除
						<?php }elseif($_smarty_tpl->tpl_vars['item']->value['receiving_status']=='1'){?>	
						草稿					
						<?php }elseif($_smarty_tpl->tpl_vars['item']->value['receiving_status']=='2'){?>
						确认	
						<?php }elseif($_smarty_tpl->tpl_vars['item']->value['receiving_status']=='3'){?>
						等审核						
						<?php }elseif($_smarty_tpl->tpl_vars['item']->value['receiving_status']=='4'){?>						
						已审核
						<?php }elseif($_smarty_tpl->tpl_vars['item']->value['receiving_status']=='5'){?>
						在途
						<?php }elseif($_smarty_tpl->tpl_vars['item']->value['receiving_status']=='6'){?>						
						收货中
						<?php }elseif($_smarty_tpl->tpl_vars['item']->value['receiving_status']=='7'){?>
						收货完成
						<?php }else{ ?>
						未知
						<?php }?>
               
					<?php }else{ ?>						
					
                            <?php if ($_smarty_tpl->tpl_vars['item']->value['receiving_status']=='1'){?>
                            <a class="edit" href="/merchant/receiving/create?ASNCode=<?php echo $_smarty_tpl->tpl_vars['item']->value['receiving_code'];?>
"
                                  onclick="parent.openMenuTab('/merchant/receiving/create?ASNCode=<?php echo $_smarty_tpl->tpl_vars['item']->value['receiving_code'];?>
','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
editAsn<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(<?php echo $_smarty_tpl->tpl_vars['item']->value['receiving_code'];?>
)')" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
editAsn<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" ><span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
edit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span></a>
                            <a class="delete" onclick="deleteAsn('/merchant/receiving/delete/ASNCode/<?php echo $_smarty_tpl->tpl_vars['item']->value['receiving_code'];?>
')"
                               target="ajaxTodo" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ConfirmDelete<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"><span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
delete<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span></a>
                            <?php }elseif($_smarty_tpl->tpl_vars['item']->value['receiving_status']=='2'){?>
                            <?php }elseif($_smarty_tpl->tpl_vars['item']->value['receiving_status']=='4'){?>
                            <!--<a class="confirm" href="/merchant/receiving/print?ASNCode=<?php echo $_smarty_tpl->tpl_vars['item']->value['receiving_code'];?>
"
                               title='<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Confirm<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
ASN' target="_blank"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
printList<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>-->
                            <?php }elseif($_smarty_tpl->tpl_vars['item']->value['receiving_status']=='5'){?>
                            <a class="confirm" href="/merchant/receiving/reprint?ASNCode=<?php echo $_smarty_tpl->tpl_vars['item']->value['receiving_code'];?>
"
                               title='<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
RePrint<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' target="_blank"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
RePrint<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
                            <?php }elseif($_smarty_tpl->tpl_vars['item']->value['receiving_status']=='6'){?>
                            <!--<a class="confirm" href="/merchant/receiving/deal-asn?ASNCode=<?php echo $_smarty_tpl->tpl_vars['item']->value['receiving_code'];?>
"
                               title='<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
HandelASN<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
' target="navTab" rel='dealAsn'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
HandelASN<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>-->
                            <?php }?>

                            <a class="view"   onclick="parent.openMenuTab('/merchant/receiving/detail?ASNCode=<?php echo $_smarty_tpl->tpl_vars['item']->value['receiving_code'];?>
','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ASNDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(<?php echo $_smarty_tpl->tpl_vars['item']->value['receiving_code'];?>
)');return false;" href="/merchant/receiving/detail?ASNCode=<?php echo $_smarty_tpl->tpl_vars['item']->value['receiving_code'];?>
"
                               target="navTab" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ASNDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" width='800' height='600'><span><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
view<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span></a>
							   <?php }?>				   
							   
							   
							  
                        </td>
                    </tr>
                    <?php } ?>
                <?php }else{ ?>
                <tr>
                    <td colspan="10" style="text-align:center"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
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

	<div id="dialog" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
export<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CurrencyBalance<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" style="display:none">
		<input type="radio" name="exportType" value="1" checked="checked"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
selectedASN<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 <input type="radio" name="exportType" value="0"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
all<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

	</div>





<script>
$(function(){
   //按默认类   
    $("#loadData").alterBgColor();
	$("#searchbox").switchToAdvancedSearch({button_id:'.switch_search_model',class_name:'advanced_element',cookName:"bh_receiving_search_mode"});
    
})
</script>

<script>

	$(function(){
        $('#dialog').dialog({
            autoOpen: false,
            modal: false,
            bgiframe:true,
            width: 850,
			position:[50,50],
            resizable: false,
            close:function(){
                //alert('close');
            },buttons:{
                '<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
close<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {
                    $('#dialog').dialog('close');
                },'<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Determine<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
': function() {

                    var exportType = $('[name=exportType]:checked').val();
                    //var exportformat = $('[name=exportformat]:checked').val();
					var exportformat = 'xls';				
                    $('.dateformate').val(exportformat);
                    if(exportType=='1'){
                        //选择的订单               

                        var param = $("#cbDataForm").serialize();						
                        var checkedSizesize = $('.AsnArr:checked').size();
                        if(checkedSizesize<=0){
                            alertTip("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pleaseOne<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",'500','auto','1');
                            return;
                        }
                        //alert($('#pagerForm').attr('action'));

                        $('#asnDataForm').attr('action','/merchant/receiving/th-export');
                        $('#asnDataForm').attr('method','POST');
                        $('#asnDataForm').submit();				
                        //$('#orderDataForm').removeAttr('action');
                        //$('#orderDataForm').removeAttr('method');

                    }else if(exportType=='0'){
                        //全部的订单
                        $('#pagerForm').attr('action','/merchant/receiving/th-export');
                        $('#pagerForm').attr('method','POST');
                        $('#pagerForm').submit();
                        $('#pagerForm').attr('action','/merchant/receiving/listth');
                        //$('#orderDataForm').removeAttr('method');

                    }
                    return;
                }
            }
        });	
        $('.export').bind('click',function(){
            $('#dialog').dialog('open');
        });	  
    	
	});
</script>


<script type="text/javascript" src="/loadjs/loadjs/name/receiving"></script><?php }} ?>