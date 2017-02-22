<?php /* Smarty version Smarty-3.1.13, created on 2015-11-13 15:39:52
         compiled from "D:\www\import_oms\branches\tianjin\application\modules\default\views\login\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2985156455ebb757af4-20604678%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '137fbd8139a2eca70043703897d7f2db75e452d2' => 
    array (
      0 => 'D:\\www\\import_oms\\branches\\tianjin\\application\\modules\\default\\views\\login\\index.tpl',
      1 => 1447398270,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2985156455ebb757af4-20604678',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56455ebb96e0d7_75170701',
  'variables' => 
  array (
    'lang' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56455ebb96e0d7_75170701')) {function content_56455ebb96e0d7_75170701($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\import_oms\\branches\\tianjin\\libs\\Smarty\\plugins\\block.t.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>天津E跨境</title>
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
<style>
  html, body, div, span, applet, object, iframe,
    h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr,
    acronym, address, big, cite, code, del, dfn, em, font,
    img, ins, kbd, q, s, samp, small, strike, strong, sub, sup,
    tt, var, dl, dt, dd, ol, ul, li, fieldset, form, label, legend,
    table, caption, tbody, tfoot, thead, tr, th, td, input {
      font-family: "微软雅黑", tahoma, sans-serif;
    }
    
    a {
        text-decoration: none;
        color: #5c5a5a;
    }

#loginbox {
    background: url("/images/login-background.png") no-repeat;
    height: 620px;
    margin: 0 auto;
    width: 800px;
}

#downloadlink{
        background-repeat:no-repeat;
        width:800px; 
        height:30px;
        margin:0px auto; 
        text-align:right;
        margin-top:60px
    }
    
#downloadlink span {
        color: #5c5a5a;
        display: block;
        float: left;
        font-size: 22px;
        padding-left: 10px;
    }

#downloadlink a{
        color: #ff0000;
        display: inline-block;
        font-weight: bold;
        height: 30px;
        line-height: 30px;
        padding: 0;
        text-align: center;
        text-decoration: none;
        width: 92px;
        font-size: 15px;
}
    
.loginForm .selfTable {
    display: inline;
    /*float: left;*/
    margin-left: 440px;
}


.loginForm {
    display: block;
    /*float: left;*/
    margin-left: 0;
    margin-top: 1px;
    width: 240px;
    height:475px;
}

.loginForm .selfTable {
    display: inline;
   /* float: left;*/
    margin-left:0;
    width: 800px;
     margin-left: 35px;
}


.selfTable tr {
        height: 55px;
        line-height: 55px;      
    }

.selfTable td {
        font-size: 15px;
        height: 32px;
        line-height: 32px;
        padding: 0 0 0 10px;
        color: #5c5a5a;
        font-weight: bold;
    }

    
.loginForm .login_input {
        border-color: #ddd;
        border-radius: 5px;
        height: 40px;
        width: 225px;
    }

.loginForm input {
        border-style: solid;
        border-width: 1px;
        padding: 3px 2px;
         margin-top: 10px;
    }


.loginForm .code {
        border-color: #ddd;
        border-radius: 5px;
        height: 40px;
        width: 225px;
    }
#submitBtn {
        background: url("/images/button_highlight2.png") no-repeat;
        border: 0 !important;
        font-size: 22px;
        color: #ffffff !important;
        cursor: pointer;
        display: inline-block;
        padding: 6px !important;
        height:50px;
        width:130px;
    }
    
.register, .forgetbutton, .forgetbutton{
        background: none;
        border: 0 none !important;
        color: #5c5a5a;
        font-size: 15px;
        height: 30px;
        font-weight: bolder;
}



.languageSelect { 
    width:80px; 
    height:28px; 
    border:1px solid #ddd;
    border-radius: 5px;    
    }    
    
#sleHid { 
    display:block; 
    width:56px; 
    overflow:hidden; 
}     

#sleBG  {
     width:78px; 
     height:28px; 
     background: url("/images/lan-sl.png") no-repeat;
     display:block;
     border-radius: 5px;
 }
 
.official_link{
    background-color: #fff;
    /*border: 1px solid;*/
    height: 75px;
    margin: 0 auto;
    width: 450px; 
   
    }
    
.official_link ul li {
    float: left;
    width: 350px;
}
</style>

<form id="loginForm" method="post" action="/login/check" onsubmit="return false;">
    <div id="downloadlink">
		<span style=" text-align:left;">天津 E跨境</span>
	</div>
    <div id="loginbox">
        
        <div class="loginForm">
            
                <table class="selfTable">
				
                    <tr>
                        <td align="center" colspan="3" id="errorMsg" style="line-height: 25px;color: red;font-size: 12px;">
                        </td>
                    </tr>
                    
                    <tr>
                        <td align="right" style="width:65px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Account<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                        <td colspan="2" align="left"> <input type="text" class="login_input"  name="username" ></td>
                    </tr>
                    
                    <tr>
                        <td align="right" style="width:65px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
password<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                        <td colspan="2" align="left">
                            <input type="password" name="password"  class="login_input" />
                        </td>
                    </tr>
					<!--
                    <tr>
                        <td align="right"  nowrap="nowrap" class="nowrap" style="width:65px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Identifying_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                        <td align="left" style="width:180px;">
                            <input type="text" style="width:70px;" maxlength="5" size="5" class="code" id="verify" name="verify">
                             <img class="verifyChange" id="verifyImg" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
click_to_update_identifying_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" src="/login/verify-code" style="height:35px;border:0;vertical-align:middle;margin-top: 15px;">
                        </td>
                        <td align="left" style="line-height:1.3;padding-left:0;">
                            <span class="verifyChange" style="font-size:14px;cursor:pointer;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Cant_see<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br />
                           <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
change_img<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span>
                        </td>
                    </tr>
					-->

                    <tr>
                        <td align="right"  nowrap="nowrap" class="nowrap" style="width:65px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
lang<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                        <td align="left"  colspan="2">
                           
                                    <select onchange="changeLang(this.value);" class="languageSelect">								
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
                        <td>&nbsp;</td>
                        <td colspan="2" align="left" class="nowrap">
                            <input type="submit" value="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
login_in<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" class="newsub" id="submitBtn">
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan="2" align="left" class="registerInformation">  
                            <a class="register" href="/register"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
register<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                            
							<a href="/forget-password" class="forgetbutton"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Forget_the_password<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="/id/submit-identification" class="forgetbutton"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Submit_your_id_card<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
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
			/*
            if(verify==""){
                $("#errorMsg").html("验证码不能为空!");
                return false;
            }
			*/
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