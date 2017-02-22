<?php /* Smarty version Smarty-3.1.13, created on 2014-07-02 15:38:22
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/receiving/jihuo-detail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:204402997753b3b6eebe8bd6-70257051%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'db75b8c6b14f49bd3b0b44a1922b298606438642' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/receiving/jihuo-detail.tpl',
      1 => 1396509567,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '204402997753b3b6eebe8bd6-70257051',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'detail' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53b3b6eec2c0c8_65978787',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b3b6eec2c0c8_65978787')) {function content_53b3b6eec2c0c8_65978787($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><table cellspacing="0" cellpadding="0" class="formtable tableborder">
    <thead>
    <tr>
        <th class="center"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
        <th class="center"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CustomerReference<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
        <th class="center"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
current_warehouse<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
        <th class="center"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
current_status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
        <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
createDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
        <th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
lastEditTime<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
    </tr>
    </thead>
    <tbody>
    <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['detail']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
    <tr>
        <td class="center"><a href="/merchant/order/detail/ordersCode/<?php echo $_smarty_tpl->tpl_vars['row']->value['order_code'];?>
" onclick="parent.openMenuTab('/merchant/order/detail/ordersCode/<?php echo $_smarty_tpl->tpl_vars['row']->value['order_code'];?>
','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(<?php echo $_smarty_tpl->tpl_vars['row']->value['order_code'];?>
)','orderdetail<?php echo $_smarty_tpl->tpl_vars['row']->value['order_code'];?>
');return false;" ><?php echo $_smarty_tpl->tpl_vars['row']->value['order_code'];?>
</a></td>
        <td class="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['reference_no'];?>
</td>
        <td class="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['warehouse_name'];?>
</td>
        <td class="center"><?php echo $_smarty_tpl->tpl_vars['row']->value['status_to_str'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['row']->value['add_time'];?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['row']->value['update_time'];?>
</td>
    </tr>
    <?php } ?>
    </tbody>
</table><?php }} ?>