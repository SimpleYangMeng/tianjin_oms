<?php /* Smarty version Smarty-3.1.13, created on 2014-07-18 13:06:25
         compiled from "/home/apache/www/import/oms/application/modules/default/views/register/step4.tpl" */ ?>
<?php /*%%SmartyHeaderCode:134703720553c8ab5165ccc4-87218587%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7d1bd684dcb21c1726fae28f575f72fcb345bd45' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/default/views/register/step4.tpl',
      1 => 1396509313,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '134703720553c8ab5165ccc4-87218587',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53c8ab51690be2_65378035',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53c8ab51690be2_65378035')) {function content_53c8ab51690be2_65378035($_smarty_tpl) {?><div class="grid-780 grid-780-pd fn-hidden fn-clear">
    <div class="flow-steps">
        <ol class="num4">
            <li ><span class="first">注册账号</span></li>
            <li ><span>邮箱验证</span></li>
			<li ><span>注册条款</span></li>
            <li><span>完善资料</span></li>
            <li class="current"><span>注册完成</span></li>
        </ol>
    </div>
    <div class="grid-780 fn-clear" style="border:0px solid #D3D3D3;">
        <!-- <p class="msg">您的资料已经完善完毕，请登陆系统进行操作！<a href="/login">登陆</a></p> -->
		<p class="msg">您的账号正在审核中。</p>
    </div>
</div>
<?php }} ?>