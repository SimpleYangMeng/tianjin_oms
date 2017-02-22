<?php /* Smarty version Smarty-3.1.13, created on 2014-07-07 13:55:50
         compiled from "/home/apache/www/import/oms/application/modules/default/views/register/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:93763631153ba3666a0ef46-49736976%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '599d15b861e9e11f08ec769ce1bef8b55192a068' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/default/views/register/index.tpl',
      1 => 1396509312,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '93763631153ba3666a0ef46-49736976',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53ba3666a43b73_79919967',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53ba3666a43b73_79919967')) {function content_53ba3666a43b73_79919967($_smarty_tpl) {?><div class="grid-780 grid-780-pd fn-hidden fn-clear">
    <div class="flow-steps">
        <ol class="num4">
            <li class="current"><span class="first">注册账号</span></li>
            <li><span>邮箱验证</span></li>
			<li ><span>注册条款</span></li>
            <li><span>完善资料</span></li>
            <li><span>注册完成</span></li>
        </ol>
    </div>
    <div class="grid-780 fn-clear">
        <div class="hyzxzc_mmmmt">会员注册</div>
        <form id="registerForm" class="fm-layout" method="post" action="/register/save">
            <fieldset>
                <p class="form-p">
                    <label class="form-label">邮箱
                        <strong class="form-strong">*</strong>
                    </label>
                    <input  type="text" class="text-input validate[required]" id="username" name="username">
                    <strong></strong>
                </p>
                <p class="form-p">
                    <label class="form-label">密码
                        <strong class="form-strong">*</strong>
                    </label>
                    <input type="password" class="text-input validate[required]" id="userpwd" name="userpwd">
                    <strong></strong> 密码必须6位(包含6位)以上
                </p>
                <p class="form-p">
                    <label class="form-label">确认密码
                        <strong class="form-strong">*</strong>
                    </label>
                    <input  type="password" class="text-input validate[required]" id="repwd" name="repwd">
                    <strong></strong>
                </p>
                <p class="form-p">
                    <label class="form-label">验证码
                        <strong class="form-strong">*</strong> 
                    </label>
                    <input  type="text" class=" text-input validate[required]" id="verify" name="verify">
                    <img class="verifyChange" id="verifyImg" title="点击以更新验证码" src="/register/verify-code">
                    <strong style="color: #FF0000;"><a class="verifyChange" href="javascript:void(0);">看不清？换过一个</a></strong>
                </p>
                <p class="form-p">
                    <input type="button" class="button text-input" value="提交" style="width:80px;" id="registersub" />
                </p>
				<p>
					<ul id="registerinfo">
						
					</ul>
				
				</p>
				
            </fieldset>
        </form>
    </div>
</div>

<script type="text/javascript" language="javascript">
    function alertTip(tip, reloadinfo) {
	   var reloadinfo =  reloadinfo||1;
        /*$('<div title="Tip" class="alertTip"><p align="center">' + tip + '</p></div>').dialog({
            modal:true,
            width:350,
            buttons:{
                'close':function () {
                    $(this).dialog("close");
                    //window.location.href='/register/step?current=2';
                }
            },
            close:function (){
                $(this).dialog("destroy");
            }
        });
		*/
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
    function register(){
        var email =$('#username').val();
        var userpwd = $('#userpwd').val();
        var repwd = $('#repwd').val();
        var verify = $('#verify').val();
        if(email==""){
            alertTip("邮箱不能为空！");
            return false;
        }
        if(userpwd==""){
            alertTip("密码不能为空！");
            return false;
        }

        if(repwd==""){
            alertTip("确认密码不能为空！");
            return false;
        }
        if(verify==""){
            alertTip("验证码不能为空！");
            return false;
        }
        if(userpwd!=repwd){
            alertTip("密码输入不一致！");
            return false;
        }
        if(email!=''&& userpwd!='' && repwd!='' && verify!=''){
            if(userpwd==repwd){
                var formData = $('#registerForm').serialize();
                $.ajax({
                    type:"POST",
                    async:false,
                    dataType:"json",
                    data:formData,
                    url:'/register/save',
                    success:function(json) {
                        var html = '';
                        if(json.ask=='1'){
                            //html += "<p class='messageSuccess'><image src='/images/icons/icon_approve.png' /> "+json.message+"</p>";
                            //$('.orderMessage').html(json.message).show();
                            //$('#refundbillForm').resetForm();
                            alertTip(json.message,3);
							var gotoURL ='window.location.href="/register/step?current=2"';
							var t = setTimeout(gotoURL,2000);
							
                        }else{
						
							if(typeof(json.authcodeError) != 'undefined' && json.authcodeError ==1){
								$(".verifyChange").trigger('click');
							}
                            html +=json.message;
							if(html){alertTip(html,1)};
                            if(typeof(json.error) != 'undefined'){
							
								$('#registerinfo').empty();
                                $.each(json.error,function(key,item){
                                  
								   alertTip(item,2);
								    //html += "<p class='messageFail'><image src='/images/icons/icon_missing.png' /> "+item+"</p>";
                                })
                                //$('.orderMessage').html(html).show();
                            }
                           
                        }
                        //$('.submit').attr('disabled',false);
                    }
                });
            }
        }else{
            alertTip("数据有误！");
            return false;
        }
    }

	$(function(){
		$(".verifyChange").click(function(){
			$('#verifyImg').attr("src","/register/verify-code?"+Math.random());
		});
        $('input').die('blur');
		//$("#registerForm").validationEngine();
        $('#registersub').die('click').bind('click',register);
	})
</script><?php }} ?>