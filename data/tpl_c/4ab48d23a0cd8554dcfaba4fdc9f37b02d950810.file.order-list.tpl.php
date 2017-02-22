<?php /* Smarty version Smarty-3.1.13, created on 2016-03-15 15:16:50
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\merchant\views\order\order-list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1744756e7b6e210b549-94492468%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4ab48d23a0cd8554dcfaba4fdc9f37b02d950810' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\merchant\\views\\order\\order-list.tpl',
      1 => 1455677483,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1744756e7b6e210b549-94492468',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'conditioin' => 0,
    'page' => 0,
    'pageSize' => 0,
    'iePortRows' => 0,
    'iePortRow' => 0,
    'ciqStatus' => 0,
    'key' => 0,
    'item' => 0,
    'statusGroupRows' => 0,
    'orderStatus' => 0,
    'appStatusRow' => 0,
    'newOrdersRows' => 0,
    'newOrdersRow' => 0,
    'count' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56e7b6e24d22f5_48947457',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56e7b6e24d22f5_48947457')) {function content_56e7b6e24d22f5_48947457($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\block.t.php';
?><div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <?php if ($_smarty_tpl->tpl_vars['conditioin']->value['ie_type']=='BI'){?>
        <h3 class="clearborder" style="margin-left:5px;">保税进口订单列表</h3>
        <?php }else{ ?>
        <h3 class="clearborder" style="margin-left:5px;">保税进口订单列表</h3>
        <?php }?>
    </div>



    <div class="pageHeader">
        <form action="/merchant/order/list" method="post" id="pagerForm">
            <input type="hidden" name="page" value="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" id="page" />
            <input type="hidden" name="pageSize" value="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" id="pageSizes"/>
            <input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['conditioin']->value['ie_type'];?>
" id="_type"/>

            <div class="searchBar">
                <table>
                    <tr>
                        <td class="form_input">
                            <div>
                                <label>订单编号：
                                    <input type="text" name="order_code" value="<?php echo $_smarty_tpl->tpl_vars['conditioin']->value['order_code'];?>
" class="text-input fix-small-input"/>
                                </label>
                                <label>交易订单号：
                                    <input type="text" name="reference_no" value="<?php echo $_smarty_tpl->tpl_vars['conditioin']->value['reference_no'];?>
" class="text-input fix-small-input"/>
                                </label>                         
                                <label>主管海关：
                                    <select name="customs_code">
                                        <option value="">请选择</option>
                                        <?php  $_smarty_tpl->tpl_vars['iePortRow'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['iePortRow']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['iePortRows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['iePortRow']->key => $_smarty_tpl->tpl_vars['iePortRow']->value){
$_smarty_tpl->tpl_vars['iePortRow']->_loop = true;
?>
                                        <?php if ($_smarty_tpl->tpl_vars['iePortRow']->value['ie_port']==$_smarty_tpl->tpl_vars['conditioin']->value['customs_code']){?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['iePortRow']->value['ie_port'];?>
" selected="selected"><?php echo $_smarty_tpl->tpl_vars['iePortRow']->value['ie_port'];?>
 == <?php echo $_smarty_tpl->tpl_vars['iePortRow']->value['ie_port_name'];?>
</option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['iePortRow']->value['ie_port'];?>
"><?php echo $_smarty_tpl->tpl_vars['iePortRow']->value['ie_port'];?>
 == <?php echo $_smarty_tpl->tpl_vars['iePortRow']->value['ie_port_name'];?>
</option>
                                        <?php }?>
                                        <?php } ?>
                                    </select>
                                </label> 
                            </div>
                            <div style="margin-top: 10px;">
                                <label>添加时间：                      
                                <input type="text" name="start_time" value="<?php echo $_smarty_tpl->tpl_vars['conditioin']->value['order_add_time'];?>
" class="datepicker text-input width140" readonly="true"/>
                                </label>    
                                <label><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                                <input type="text" name="end_time" value="<?php echo $_smarty_tpl->tpl_vars['conditioin']->value['order_end_time'];?>
" class="datepicker text-input width140" readonly="true"/>
                                </label>   
                                <label>检验检疫状态：
                                    <select name="ciq_status">
                                        <option value="" <?php if ($_smarty_tpl->tpl_vars['conditioin']->value['ciq_status']===''){?>selected<?php }?>>全部</option>
                                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['ciqStatus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['conditioin']->value['ciq_status']!==''&&$_smarty_tpl->tpl_vars['conditioin']->value['ciq_status']==$_smarty_tpl->tpl_vars['key']->value){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</option>
                                        <?php } ?>
                                    </select>
                                </label>
                                <a class="button" href="#" onclick="$('#pagerForm').submit();return false;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>                          
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</div>

<div class="btn_wrap">    
    <input class="statusBtn btn <?php if (empty($_smarty_tpl->tpl_vars['conditioin']->value['order_status'])&&!is_numeric($_smarty_tpl->tpl_vars['conditioin']->value['order_status'])){?>btn-active<?php }?>" value="全部(<?php echo $_smarty_tpl->tpl_vars['statusGroupRows']->value['order_statusTotal'];?>
)" name="order_status" type='button'>
    <?php  $_smarty_tpl->tpl_vars['appStatusRow'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['appStatusRow']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['orderStatus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['appStatusRow']->key => $_smarty_tpl->tpl_vars['appStatusRow']->value){
$_smarty_tpl->tpl_vars['appStatusRow']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['appStatusRow']->key;
?>
    <?php if (isset($_smarty_tpl->tpl_vars['statusGroupRows']->value[$_smarty_tpl->tpl_vars['key']->value])){?>
    <input class="statusBtn btn<?php if ($_smarty_tpl->tpl_vars['conditioin']->value['order_status']==$_smarty_tpl->tpl_vars['key']->value&&is_numeric($_smarty_tpl->tpl_vars['conditioin']->value['order_status'])){?> btn-active<?php }?>" value="<?php echo $_smarty_tpl->tpl_vars['appStatusRow']->value;?>
(<?php echo $_smarty_tpl->tpl_vars['statusGroupRows']->value[$_smarty_tpl->tpl_vars['key']->value];?>
)" name="order_status" type='button' ref='<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
'>
    <?php }else{ ?>
    <input class="statusBtn btn<?php if ($_smarty_tpl->tpl_vars['conditioin']->value['order_status']==$_smarty_tpl->tpl_vars['key']->value&&is_numeric($_smarty_tpl->tpl_vars['conditioin']->value['order_status'])){?> btn-active<?php }?>" value="<?php echo $_smarty_tpl->tpl_vars['appStatusRow']->value;?>
(0)" name="order_status" type='button' ref='<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
'>
    <?php }?>
    <?php } ?>
</div>

<form  method="post" enctype="multipart/form-data" id='DataForm'>
    <table class="table list formtable tableborder" width="100%"  style="margin-top:5px;" id="finance-list-box">
        <thead>
        <tr>
            <th>交易订单号</th>
            <th>订单编号</th>
            <th>主管海关</th>
            <th>状态</th>          
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        <?php if (isset($_smarty_tpl->tpl_vars['newOrdersRows']->value)&&!empty($_smarty_tpl->tpl_vars['newOrdersRows']->value)){?>
        <?php  $_smarty_tpl->tpl_vars['newOrdersRow'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['newOrdersRow']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['newOrdersRows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['newOrdersRow']->key => $_smarty_tpl->tpl_vars['newOrdersRow']->value){
$_smarty_tpl->tpl_vars['newOrdersRow']->_loop = true;
?>
        <tr>
            <td class="text_center" style="vertical-align:middle"><?php echo $_smarty_tpl->tpl_vars['newOrdersRow']->value['reference_no'];?>
</td>
            <td class="text_center" style="vertical-align:middle"><?php echo $_smarty_tpl->tpl_vars['newOrdersRow']->value['order_code'];?>
</td>
            <td class="text_center" style="vertical-align:middle"><?php echo $_smarty_tpl->tpl_vars['newOrdersRow']->value['customs_code'];?>
</td>
            <td class="text_center" style="vertical-align:middle">海关：<?php echo $_smarty_tpl->tpl_vars['newOrdersRow']->value['status'];?>
<br/>检验检疫：<?php echo $_smarty_tpl->tpl_vars['newOrdersRow']->value['ciq_status'];?>
</td>         
            <td class="text_center" style="vertical-align:middle"><?php echo $_smarty_tpl->tpl_vars['newOrdersRow']->value['add_time'];?>
</td>            
            <td class="text_center" style="vertical-align:middle">
                
            <?php if (isset($_smarty_tpl->tpl_vars['conditioin']->value['order_status'])&&$_smarty_tpl->tpl_vars['conditioin']->value['order_status']=='2'){?>
                <a href="javascript:void(0);" onclick="parent.openMenuTab('/merchant/order/edit/order_code/<?php echo $_smarty_tpl->tpl_vars['newOrdersRow']->value['order_code'];?>
','编辑订单:<?php echo $_smarty_tpl->tpl_vars['newOrdersRow']->value['order_code'];?>
','<?php echo $_smarty_tpl->tpl_vars['newOrdersRow']->value['order_code'];?>
');return false;">修改 </a>
            <?php }?>
               

                <a href="javascript:void(0);" onclick="parent.openMenuTab('/merchant/order/view/order_code/<?php echo $_smarty_tpl->tpl_vars['newOrdersRow']->value['order_code'];?>
','查看订单:<?php echo $_smarty_tpl->tpl_vars['newOrdersRow']->value['order_code'];?>
','<?php echo $_smarty_tpl->tpl_vars['newOrdersRow']->value['order_code'];?>
');return false;">查看 </a>
                
            </td>
        </tr>
        <?php } ?>
        <?php }?>
        </thead>
        <tbody>
        </tbody>
    </table>
</form>
<div class="pagination" targetType="navTab" totalCount="<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
" numPerPage="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" currentPage="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"  pageNumShown="10"></div>



<?php }} ?>