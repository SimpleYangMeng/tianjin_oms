<?php /* Smarty version Smarty-3.1.13, created on 2016-02-17 11:08:19
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\default\views\forgetpassword\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2392056c3e423ae51d2-38187443%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd5e605f169c8139fee78ce2a46bc588815d2626e' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\default\\views\\forgetpassword\\index.tpl',
      1 => 1455677485,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2392056c3e423ae51d2-38187443',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56c3e423b0ebc9_47556981',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56c3e423b0ebc9_47556981')) {function content_56c3e423b0ebc9_47556981($_smarty_tpl) {?><div class="grid-780 grid-780-pd fn-hidden fn-clear">
    <div class="flow-steps">
        <p class="forgetpassword1">
            
        </p>
    </div>
    <div class="grid-780 fn-clear">
        <div class="hyzxzc_mmmmt">忘记密码</div>
        <form id="registerForm" class="fm-layout" method="post" action="">
            <fieldset>
                <p class="form-p">
                    <label class="form-label">邮箱
                        <strong class="form-strong">*</strong>
                    </label>
                    <input  type="text" class="text-input validate[required]" id="username" name="username">
                    <strong></strong>
                </p>
              
               
                <p class="form-p">
                    <label class="form-label">验证码
                        <strong class="form-strong">*</strong>
                    </label>
                    <input  type="text" class=" text-input validate[required]" id="verify" name="verify">
                    <img class="verifyChange" id="verifyImg" title="点击以更新验证码" src="/register/verify-code">
                    <strong style="color: #FF0000;"><a class="verifyChange" href="javascript:void(0);">看不清？换一个</a></strong>
                </p>
                <p class="form-p">
                    <input type="button" class="button text-input" value="确定" style="width:80px;" id="registersub" />
                </p>
				<p>
					<ul id="registerinfo">
						
					</ul>
				
				</p>
				
            </fieldset>
        </form>
    </div>
</div>


<div id="dialog" title="获取验证码">
<form id="authForm" class="fm-layout" method="post" action="">
	  <fieldset>
            <p class="form-p">                   
            	<input type="button" class="button" id="getauthcode" value="获取验证码"/></p>	  
  			</p>
            <p class="form-p">
                <label class="form-label">验证码: </label>
            	<input type="text" class=" text-input" id="forget_password_authcode" name="forget_password_authcode">
            </p>	  
            <p class="form-p">
                <label class="form-label">图形验证码: </label>
            	<input type="text" class=" text-input validate[required]" id="verify2" name="verify2">
                <img class="verifyChange2" id="verifyImg2" title="点击以更新验证码" align="absmiddle" src="/register/verify-code">
                <strong style="color: #FF0000;"><a class="verifyChange2" href="javascript:void(0);">看不清？换一个</a></strong>
                <strong></strong>
            </p>
            <p class="form-p">
                <input type="button" class="button text-input" value="提交" style="width:80px;" id="registersub2" />
            </p>				
			<p>
				<ul id="registerinfo2">
					
				</ul>
			</p>
	   </fieldset>			
</form>
</div>

<script>
// 产品浏览的对话框	
$(document).ready(function(){		
		
		$('#dialog').dialog({
			autoOpen: false,
			modal:true,
			bgiframe:true,
			width: 700,		
			resizable: true,
			close: function() {
						$(".verifyChange").trigger('click');
						$('#verify').val('')
	    		   }
		});		
			    
});
</script>
<script type="text/javascript" language="javascript">
    function alertTip(tip, reloadinfo) {
	   var reloadinfo =  reloadinfo||1;        
		if(reloadinfo==1){$('#registerinfo').empty();}
		
		if(reloadinfo==3){
			$('#registerinfo').empty();
			$('<li class="success">'+tip+'</li>').appendTo($('#registerinfo').show());
			return;
		}
		$('<li class="error">'+tip+'</li>').appendTo($('#registerinfo').show());
		
	//	alert(tip);
		return false;
    }
	
    function alertTip2(tip, reloadinfo) {
	   var reloadinfo =  reloadinfo||1;        
		if(reloadinfo==1){$('#registerinfo2').empty();}
		
		if(reloadinfo==3){
			$('#registerinfo2').empty();
			$('<li class="success">'+tip+'</li>').appendTo($('#registerinfo2').show());
			return;
		}
		$('<li class="error">'+tip+'</li>').appendTo($('#registerinfo2').show());
		
	//	alert(tip);
		return false;
    }	
	/*第一步*/
    function forget_password(){
        var email =$('#username').val();        
        var verify = $('#verify').val();
        if(email==""){
            alertTip("邮箱不能为空！");
            return false;
        }
        
        if(verify==""){
            alertTip("验证码不能为空！");
            return false;
        }           
        	var formData = $('#registerForm').serialize();
            $.ajax({
   	                type:"POST",
                    async:false,
                    dataType:"json",
                    data:formData,
                    url:'/forget-password/confirm-user',
                    success:function(json) {
						
                        var html = '';
                        if(json.ask=='1'){                           
                            //alertTip(json.message,3);
							$('#dialog').dialog('open');
							$(".verifyChange2").trigger('click');
							//var gotoURL ='window.location.href="/register/step?current=2"';
							//var t = setTimeout(gotoURL,2000);
							
                        }else{
												
                           	$('#dialog').dialog('close');				
							if(typeof(json.authcodeError) != 'undefined' && json.authcodeError ==1){
								$(".verifyChange").trigger('click');
							}
						   
                            if(typeof(json.error) != 'undefined'){
								
								$('#registerinfo').empty();
                                $.each(json.error,function(key,item){
                                  
								   alertTip(item,2);
								   
                                })
                                //$('.orderMessage').html(html).show();
                            }
                           
                        }
                        //$('.submit').attr('disabled',false);
                    }
                });            
        
    }

	/*第二步*/
  function forget_password2(){
        var password_authcode =$('#forget_password_authcode').val();        
       	var email =$('#username').val();  
        if(email==""){
            alertTip2("邮箱不能为空！");
            return false;
        }
        
        if(password_authcode==""){
            alertTip2("请输入您注册邮件中收到的验证码！");
            return false;
        }           
        
            $.ajax({
   	                type:"POST",
                    async:false,
                    dataType:"json",
                    data:{password_authcode:password_authcode,email:email},
                    url:'/forget-password/confirmauth',
                    success:function(json) {						
                        var html = '';
                        if(json.ask=='1'){                           
                            alertTip2(json.message,3);
							var gotoURL ='window.location.href="/forget-password/reset"';
							var t = setTimeout(gotoURL,2000);
							
                        }else{
												
                           				
							if(typeof(json.authcodeError) != 'undefined' && json.authcodeError ==1){
								$(".verifyChange2").trigger('click');
							}
						   
                            if(typeof(json.error) != 'undefined'){
								
								$('#registerinfo').empty();
                                $.each(json.error,function(key,item){
                                  
								   alertTip2(item,2);
								   
                                })
                                //$('.orderMessage').html(html).show();
                            }
                           
                        }
                        //$('.submit').attr('disabled',false);
                    }
                });            
        
    }


	$(function(){
		$(".verifyChange").click(function(){
			$('#verifyImg').attr("src","/register/verify-code?"+Math.random());
		});
		$(".verifyChange2").click(function(){
			$('#verifyImg2').attr("src","/register/verify-code?"+Math.random());
		});		
        $('input').die('blur');
		//$("#registerForm").validationEngine();
        $('#registersub').die('click').bind('click',forget_password);
		$('#registersub2').die('click').bind('click',forget_password2);
		
		
		
		
	});
	
	var delay_minutes = 60;							
	var delayMovie = function(){
		_this = $('#getauthcode');	
		//var buttonText = '在获取验证码';	
		_this.val('在'+'('+delay_minutes+')秒后重新获取');								
		delay_minutes-=1;							
		if(delay_minutes>=0){
				setTimeout('delayMovie()',1000);
			}else{
				_this.css('color','#000');
				$('#getauthcode').bind('click',getAuthcode);
				_this.attr('value','重新获取验证码');
				delay_minutes=60;	
				alertTip2("");
		}
		//if(delay_minutes<=0 && !t){clearInterval(t);}
							
	}	
	$(function(){
		$('#getauthcode').bind('click',getAuthcode);	
	});
	
	//获取验证码的函数
	 function getAuthcode(){
 		 	var _this = $(this);		   
		    var username =$('#username').val();
			
       		if(username==""){
            	alertTip2("邮箱不能为空！");
            	return false;
        	}       
        		
			$.ajax({
   	                type:"POST",
                    async:false,
                    dataType:"json",					
                    data:{username:username},
                    url:'/forget-password/auth',
                    success:function(json) {
					
                     	var html = '';
                        if(json.ask=='1'){    
							_this.css('color','#ccc');
							_this.unbind('click');							                   
                            alertTip2(json.message,3);
							delayMovie();							
							//$('#dialog').dialog('open');
							//var gotoURL ='window.location.href="/register/step?current=2"';
							//var t = setTimeout(gotoURL,2000);
							
                        }else{			
                           				
							if(typeof(json.authcodeError) != 'undefined' && json.authcodeError ==1){
								$(".verifyChange2").trigger('click');
							}
						   
                            if(typeof(json.error) != 'undefined'){
								
								$('#registerinfo2').empty();
                                $.each(json.error,function(key,item){
                                  
								   alertTip2(item,2);
								   
                                });
                                //$('.orderMessage').html(html).show();
                            }
					   }
					
					
					
			}});//ajax	
		}		
</script><?php }} ?>