<?php /* Smarty version Smarty-3.1.13, created on 2015-11-13 15:02:25
         compiled from "D:\www\import_oms\branches\tianjin\application\modules\merchant\views\default\left-menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1138356458b013bdb52-19898931%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '86b9a918ad8170ce5425a28126dca6b8228dbed1' => 
    array (
      0 => 'D:\\www\\import_oms\\branches\\tianjin\\application\\modules\\merchant\\views\\default\\left-menu.tpl',
      1 => 1446033128,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1138356458b013bdb52-19898931',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'menu' => 0,
    'module' => 0,
    'right' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56458b014ecbb8_43259860',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56458b014ecbb8_43259860')) {function content_56458b014ecbb8_43259860($_smarty_tpl) {?><div id="menu">
  <?php  $_smarty_tpl->tpl_vars['module'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['module']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['module']->key => $_smarty_tpl->tpl_vars['module']->value){
$_smarty_tpl->tpl_vars['module']->_loop = true;
?>
  <h6 id="h-menu-<?php echo $_smarty_tpl->tpl_vars['module']->value['slug'];?>
" class="selected"><a href="<?php echo $_smarty_tpl->tpl_vars['module']->value['link'];?>
"><span><?php echo $_smarty_tpl->tpl_vars['module']->value['display_name'];?>
</span></a></h6>
  <ul id="menu-<?php echo $_smarty_tpl->tpl_vars['module']->value['slug'];?>
" class="opened">
    <?php  $_smarty_tpl->tpl_vars['right'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['right']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['module']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['right']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['right']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['right']->key => $_smarty_tpl->tpl_vars['right']->value){
$_smarty_tpl->tpl_vars['right']->_loop = true;
 $_smarty_tpl->tpl_vars['right']->iteration++;
 $_smarty_tpl->tpl_vars['right']->last = $_smarty_tpl->tpl_vars['right']->iteration === $_smarty_tpl->tpl_vars['right']->total;
?>
      <li<?php if ($_smarty_tpl->tpl_vars['right']->last){?> class="last"<?php }?>>
      <?php if ('logout'==$_smarty_tpl->tpl_vars['right']->value['slug']){?>
      <a href="<?php echo $_smarty_tpl->tpl_vars['right']->value['link'];?>
" style= "display:none">
      <?php }elseif('change-password'==$_smarty_tpl->tpl_vars['right']->value['slug']){?>
      <a href="<?php echo $_smarty_tpl->tpl_vars['right']->value['link'];?>
" style= "display:none">
      <?php }else{ ?>
      <a href="#<?php echo $_smarty_tpl->tpl_vars['right']->value['link'];?>
" onclick="openMenuTab('<?php echo $_smarty_tpl->tpl_vars['right']->value['link'];?>
','<?php echo $_smarty_tpl->tpl_vars['right']->value['display_name'];?>
','<?php echo $_smarty_tpl->tpl_vars['right']->value['slug'];?>
');return false;">
      <?php }?>
      <?php echo $_smarty_tpl->tpl_vars['right']->value['display_name'];?>
</a></li>
    <?php } ?>
  </ul>
  <?php } ?>
</div><?php }} ?>