<?php /* Smarty version Smarty-3.1.13, created on 2014-07-04 08:06:55
         compiled from "/home/apache/www/import/oms/application/modules/default/views/idcards/submit-identification.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17713530353b5f01f7e3184-37527864%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c28448d16fb4fa04a2eb8ed343b60f84282943c5' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/default/views/idcards/submit-identification.tpl',
      1 => 1396509274,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17713530353b5f01f7e3184-37527864',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'info' => 0,
    'error' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53b5f01f825f19_03160531',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b5f01f825f19_03160531')) {function content_53b5f01f825f19_03160531($_smarty_tpl) {?><div class="grid-780 grid-780-pd fn-hidden fn-clear">
    <div class="flow-steps">
        <h3>
          海关清关入境包裹，请配合提交收件人身份证明
        </h3>
    </div>
	
	<div style="color:#333; font-size:14px; background-color:#eee;padding:10px;border:1px solid #999; line-height:165%">

 &nbsp;&nbsp;&nbsp;&nbsp;据中华人民共和国海关总署《中华人民共和国海关对进出境快件监管办法》（第 147 号令）第二十二条规定：个人物品类进出境快件报关时，运营人应当向海关提交《中华人民共和国海关进出境快件个人物品申报单》、每一进出境快件的分运单、进境快件收件人或出境快件发件人身份证件影印件和海关需要的其它单证。根据以上规定，快件寄送个人物品入境时应提供收件人身份证影印件和其他通关所需文件给指定物流公司，由物流公司负责代为办理个人物品的通关手续，并完成派送工作。

我们承诺，所有身份证信息属于公民个人隐私保护信息，仅用于海关进口申报之用途。 

	
	</div>
	
	<div style="margin-top:10px;margin-bottom:10px">请您输入交易订单号和收件人姓名并进行确认，之后按提示上传身份证明（只需花您一分钟时间）</div>
    <div class="grid-780 fn-clear">
       
        <form id="registerForm" class="fm-layout" method="post" action="/id/submit-identification">
		
			<table>
				<tr>
					<td>交易订单号：</td>
					<td><input  type="text" class="text-input validate[required]" id="reference_no" name="reference_no"></td>
				</tr>
				<tr>
					<td>收件人姓名：</td><td><input  type="text" class="text-input validate[required]" id="consignee_person" name="consignee_person"></td>
				</tr>				
				<tr>
					<td>验证码：</td>
					<td>
					<input  type="text" class=" text-input validate[required]" id="verify" name="verify">
                    <img class="verifyChange" id="verifyImg"  style="vertical-align:middle; border:1px solid #000" title="点击以更新验证码" src="/register/verify-code">
                    <a class="verifyChange" href="javascript:void(0);">看不清？换过一个</a>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
					<input type="submit" class="button text-input" value="确定" style="width:80px;"  />
					</td>
				</tr>
				
				<tr>
					<td>&nbsp;</td>
					<td style="color:#FF0000">
					<?php  $_smarty_tpl->tpl_vars['error'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['error']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['info']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['error']->key => $_smarty_tpl->tpl_vars['error']->value){
$_smarty_tpl->tpl_vars['error']->_loop = true;
?>
    					<?php echo $_smarty_tpl->tpl_vars['error']->value;?>
<br/>
    				<?php } ?>						
					</td>
				</tr>				
				
								
			</table>          
        </form>
    </div>
</div>




<script type="text/javascript">
	$(function(){
		$(".verifyChange").click(function(){
			$('#verifyImg').attr("src","/register/verify-code?"+Math.random());
		});
		
	});	
	
	
</script><?php }} ?>