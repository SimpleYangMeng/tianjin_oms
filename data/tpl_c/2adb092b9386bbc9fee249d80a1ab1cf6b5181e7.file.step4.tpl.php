<?php /* Smarty version Smarty-3.1.13, created on 2016-03-16 10:32:33
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\default\views\register\step4.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1022956e8c5c10cf372-42244462%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2adb092b9386bbc9fee249d80a1ab1cf6b5181e7' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\default\\views\\register\\step4.tpl',
      1 => 1455677484,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1022956e8c5c10cf372-42244462',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56e8c5c1131f84_31706488',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56e8c5c1131f84_31706488')) {function content_56e8c5c1131f84_31706488($_smarty_tpl) {?><div class="grid-780 grid-780-pd fn-hidden fn-clear">
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
		<p class="msg">您的账号<span style="color:#FF6600;font-weight:700;"><?php echo $_smarty_tpl->tpl_vars['data']->value['email'];?>
</span>正在审核中。</p>
    </div>
</div>
<?php }} ?>