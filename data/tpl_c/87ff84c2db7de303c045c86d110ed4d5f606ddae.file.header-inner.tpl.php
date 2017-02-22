<?php /* Smarty version Smarty-3.1.13, created on 2015-11-13 15:02:25
         compiled from "D:\www\import_oms\branches\tianjin\application\modules\merchant\views\default\header-inner.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2827856458b011aed64-64144801%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '87ff84c2db7de303c045c86d110ed4d5f606ddae' => 
    array (
      0 => 'D:\\www\\import_oms\\branches\\tianjin\\application\\modules\\merchant\\views\\default\\header-inner.tpl',
      1 => 1446033128,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2827856458b011aed64-64144801',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56458b011b4e52_13768167',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56458b011b4e52_13768167')) {function content_56458b011b4e52_13768167($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\import_oms\\branches\\tianjin\\libs\\Smarty\\plugins\\block.t.php';
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