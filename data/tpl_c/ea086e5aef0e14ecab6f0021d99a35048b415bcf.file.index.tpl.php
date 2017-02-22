<?php /* Smarty version Smarty-3.1.13, created on 2014-07-02 14:07:46
         compiled from "/home/apache/www/import/oms/application/modules/default/views/login/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:161335355753b3a1b2274557-48935262%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ea086e5aef0e14ecab6f0021d99a35048b415bcf' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/default/views/login/index.tpl',
      1 => 1398154133,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '161335355753b3a1b2274557-48935262',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'lang' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53b3a1b22c2860_47620809',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b3a1b22c2860_47620809')) {function content_53b3a1b22c2860_47620809($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Import OMS</title>
<?php if ($_smarty_tpl->tpl_vars['lang']->value=='en_US'){?>
<link href="/dwz/themes/css/login_en.css" rel="stylesheet" type="text/css" />
<?php  }else{ if (!isset($_smarty_tpl->tpl_vars['lang'])) $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable(null);if ($_smarty_tpl->tpl_vars['lang']->value = 'zh'){?>
<link href="/dwz/themes/css/login.css" rel="stylesheet" type="text/css" />
<?php }}?>


</head>
<body>
<script type="text/javascript">
if(self!=top){top.location=self.location;}
</script>


<form id="loginForm" method="post" action="/login/check" onsubmit="return false;">
    <div id="loginbox">
        <div class="loginForm">
            
                <table class="selfTable">
				
					
                    <tr>
                        <td align="center" colspan="3" id="errorMsg" style="line-height: 25px;color: red;font-size: 12px;">
                        </td>
                    </tr>
                    <tr>
                        <td align="right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Account<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                        <td colspan="2" align="left">
                            <input type="text" class="login_input"  name="username">
                        </td>
                    </tr>
                    <tr>
                        <td align="right" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
password<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                        <td colspan="2" align="left">
                            <input type="password" name="password"  class="login_input" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right"  nowrap="nowrap" class="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Identifying_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                        <td align="left" style="width:30px;">
                            <input type="text"  maxlength="5" size="5" class="code" id="verify" name="verify">
                        </td>
                        <td align="left">
                            <img class="verifyChange" id="verifyImg" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
click_to_update_identifying_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" src="/login/verify-code">
                        </td>
                    </tr>


                    <tr>
                        <td align="right"  nowrap="nowrap" class="nowrap"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
lang<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                        <td align="left"  colspan="2">
                            <select onchange="changeLang(this.value);">								
								<option value="en_US" <?php if ($_smarty_tpl->tpl_vars['lang']->value=='en_US'){?>selected="selected"<?php }?>><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
English<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
								<option value="zh" <?php if ($_smarty_tpl->tpl_vars['lang']->value=='zh'){?>selected="selected"<?php }?>><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Chinese<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
						    </option>
                        </td>
                       
                    </tr>
										
					
                    <tr>
                        <td>
						
						


                        <td colspan="2" align="left" class="nowrap">
                            <input type="submit" value="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
login_in<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" class="newsub" id="submitBtn">
                            &nbsp;
                            <input type="button"  onclick="window.location.href='/register'" value="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
register<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" class="newsub">
							
							
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan="2" align="left">                           
							<a href="/forget-password" class="forgetbutton"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Forget_the_password<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
？</a>
							<a href="/id/submit-identification" class="forgetbutton">提交身份证明</a>
                        </td>
                    </tr>					
					
                </table>
            
        </div>
    </div>
</form>
	<script src="/dwz/js/jquery-1.7.2.js" type="text/javascript"></script>
	<script type="text/javascript" language="javascript">
		$(function(){
			$(".verifyChange").click(function(){
				$('#verifyImg').attr("src","/login/verify-code?"+Math.random());	
			});

            $('#loginForm').live('submit',formSubmit);

		})

        function formSubmit(){
            username = $("[name='username']").val();
            password = $("[name='password']").val();
            verify = $("[name='verify']").val();
            if(username==""){
                $("#errorMsg").html("账号不能为空!");
                return false;
            }
            if(password==""){
                $("#errorMsg").html("密码不能为空!");
                return false;
            }
            if(verify==""){
                $("#errorMsg").html("验证码不能为空!");
                return false;
            }
            formData = $("#loginForm").serialize();
            $.ajax({
                url:"/login/check",
                data:formData,
                type:'POST',
                dataType:"json",
                success:function(json){
                    if(json.ask=="1"){
                        window.location.href='/merchant';
                    }else if(json.ask=="-1"){
                        window.location.href='/register/step?current='+json.current;
                    }else{
						$('input[name=password]').val('');
						$('input[name=verify]').val('');
						var randNumber = parseInt(10*Math.random());
						$("#verifyImg").attr('src',"/login/verify-code"+'/rand/'+randNumber);
                        $("#errorMsg").html(json.errorMsg);
                    }
                }
            })
        }

	</script>
	
	
	
	<script type="text/javascript">
   
      	function changeLang(lang){
			if(lang==''){return;}
			
			$.ajax({
				type:'POST',
				url:'/index/change-lang',
				data:{'langCode':lang},
				dataType:'json',
				success:function(json){
					if(json=='1'){
                        window.location.reload();
                    }
				}
			});
	    }
		
    </script>	
</body>
</html><?php }} ?>