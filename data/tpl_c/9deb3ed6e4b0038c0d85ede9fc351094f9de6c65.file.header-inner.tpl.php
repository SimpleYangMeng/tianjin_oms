<?php /* Smarty version Smarty-3.1.13, created on 2016-02-17 11:08:19
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\merchant\views\default\header-inner.tpl" */ ?>
<?php /*%%SmartyHeaderCode:637756c3e423b516f1-04689817%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9deb3ed6e4b0038c0d85ede9fc351094f9de6c65' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\merchant\\views\\default\\header-inner.tpl',
      1 => 1455677482,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '637756c3e423b516f1-04689817',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56c3e423b5dcf6_02486489',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56c3e423b5dcf6_02486489')) {function content_56c3e423b5dcf6_02486489($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\block.t.php';
?><div id="home">
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
</ul><?php }} ?>