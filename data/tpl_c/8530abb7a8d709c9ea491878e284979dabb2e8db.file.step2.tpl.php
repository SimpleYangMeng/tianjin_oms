<?php /* Smarty version Smarty-3.1.13, created on 2014-07-18 09:07:59
         compiled from "/home/apache/www/import/oms/application/modules/default/views/register/step2.tpl" */ ?>
<?php /*%%SmartyHeaderCode:162942650753c8736faa2c57-45040351%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8530abb7a8d709c9ea491878e284979dabb2e8db' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/default/views/register/step2.tpl',
      1 => 1396509312,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '162942650753c8736faa2c57-45040351',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53c8736fadd976_48647424',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53c8736fadd976_48647424')) {function content_53c8736fadd976_48647424($_smarty_tpl) {?>
<div class="grid-780 grid-780-pd fn-hidden fn-clear">
    <div class="flow-steps">
        <ol class="num4">
            <li ><span class="first">注册账号</span></li>
            <li class="current"><span>邮箱验证</span></li>
			<li ><span>注册条款</span></li>
            <li><span>完善资料</span></li>
            <li><span>注册完成</span></li>
        </ol>
    </div>
    <div class="grid-780 fn-clear" style="border:0px solid #D3D3D3;">
        <p class="msg">验证邮件已发送至您的邮箱：<?php echo $_smarty_tpl->tpl_vars['data']->value['email'];?>
，若没有收到，您可以<a href="/register/resend">重新发送</a>，验证邮件以最后一封为准！</p>
        <p>&nbsp;</p>
        <p><span>用户须知:</span></p>
        <div class="tip">
            <p>1. 您可以使用该邮箱和验证后的客户代码登陆系统</p>
            <p>2. 如果没有收到邮件，请检查邮箱的垃圾收件箱</p>
            <!--<p>3. 如果该邮箱不是您的常用邮箱，可<a href="javascript:void(0);">更换邮箱</a></p>-->
        </div>
    </div>
</div>

<script type="text/javascript" language="javascript">
	$(function(){

	})	
</script><?php }} ?>