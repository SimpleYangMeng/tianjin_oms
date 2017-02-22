<?php /* Smarty version Smarty-3.1.13, created on 2014-07-02 14:07:54
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/default/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:145609342153b3a1ba1fed79-02002551%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '354e7a1c98260b39f05a7a4138dfb882e7561e86' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/default/header.tpl',
      1 => 1396509380,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '145609342153b3a1ba1fed79-02002551',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'user' => 0,
    'lang' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53b3a1ba21aa92_83078199',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b3a1ba21aa92_83078199')) {function content_53b3a1ba21aa92_83078199($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><li><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
LoginAccount<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：<?php echo $_smarty_tpl->tpl_vars['user']->value['account_name'];?>
</li>
<li>
<?php if ($_smarty_tpl->tpl_vars['lang']->value=='en_US'){?>
<a onclick="changeLang('zh_CN')"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Chinese<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>  
<?php  }else{ if (!isset($_smarty_tpl->tpl_vars['lang'])) $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable(null);if ($_smarty_tpl->tpl_vars['lang']->value = 'zh'){?>
<a onclick="changeLang('en_US')"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
English<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>  
<?php }}?>
</li><?php }} ?>