<?php /* Smarty version Smarty-3.1.13, created on 2014-07-02 14:07:54
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/default/header-inner.tpl" */ ?>
<?php /*%%SmartyHeaderCode:190006207753b3a1ba21edf5-28307665%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c142e71fac9613b60f8d4cd895ac65ff970d409a' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/default/header-inner.tpl',
      1 => 1396509380,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '190006207753b3a1ba21edf5-28307665',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53b3a1ba223e53_36874198',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b3a1ba223e53_36874198')) {function content_53b3a1ba223e53_36874198($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?>        <div id="home">
            <a href="/merchant" title="Home"></a>
        </div>
		<div id="menutablist" style="height:40px; float:left; display:inline;margin-left:180px"></div>
        <ul id="quick" style="display:none">
            <li>
                <a href="#" title="Products"><span class="normal"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
HelpCenter<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span></a>
            </li>
			<!--
            <li>
                <a href="#" title="Products"><span class="normal">条目2</span></a>
            </li>
			-->
        </ul>
     <?php }} ?>