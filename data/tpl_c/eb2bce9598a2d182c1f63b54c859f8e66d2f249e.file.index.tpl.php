<?php /* Smarty version Smarty-3.1.13, created on 2016-05-13 10:03:53
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\default\views\login\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:556656c3e1ed130aa3-59017552%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eb2bce9598a2d182c1f63b54c859f8e66d2f249e' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\default\\views\\login\\index.tpl',
      1 => 1463103223,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '556656c3e1ed130aa3-59017552',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56c3e1ed1ad284_42289899',
  'variables' => 
  array (
    'lang' => 0,
    'feedBacks' => 0,
    'item' => 0,
    'noticeData' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56c3e1ed1ad284_42289899')) {function content_56c3e1ed1ad284_42289899($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>天津跨境贸易电子商务综合服务平台</title>
    <?php if ($_smarty_tpl->tpl_vars['lang']->value=='en_US'){?>
    <link href="/dwz/themes/css/login_en.css" rel="stylesheet" type="text/css" />
    <?php  }else{ if (!isset($_smarty_tpl->tpl_vars['lang'])) $_smarty_tpl->tpl_vars['lang'] = new Smarty_Variable(null);if ($_smarty_tpl->tpl_vars['lang']->value = 'zh'){?>
    <link href="/dwz/themes/css/login.css" rel="stylesheet" type="text/css" />
    <?php }}?>
    <link rel="stylesheet" href="/css/login.css" type="text/css"/>
</head>
<body>
<script type="text/javascript">
if(self!=top){top.location=self.location;}
</script>
<div class="backLoginContainer">
    <div class="top">
        <div class="content">
            <marquee scrollamount="3" onmouseover="this.stop()" onmouseout="this.start()">
                <ul class="feed_back_list cl">
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['feedBacks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                        <li class="leftloat">
                            <a href="/feed-back/view/?feedbackId=<?php echo $_smarty_tpl->tpl_vars['item']->value['feedback_id'];?>
">
                                <span>[<?php echo $_smarty_tpl->tpl_vars['item']->value['message_type'];?>
]</span>
                                <span><?php echo $_smarty_tpl->tpl_vars['item']->value['message'];?>
</span>
                                <!--<span>答:<?php echo $_smarty_tpl->tpl_vars['item']->value['receipt'];?>
</span>-->
                                <span>状态:<?php echo $_smarty_tpl->tpl_vars['item']->value['ciq_status'];?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['item']->value['add_time'];?>
</span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </marquee>
        </div>
    </div>
    <div class="bannerContainer"></div>
    <!-- 主体部分-->
    <div class="mainContainer">
        <div class="min_width mainWrap">
            <div class="loginBox">
                <form id="formLogin" method="post" action="/login/check" onsubmit="return false;">
                    <p class="top"></p>
                    <div class="bottomMain">
                        <div id="errorMsg"></div>
                        <div id="errorPrint">
                            <span id="errorTip"></span><a target="_blank" href="" id="downLoadDoc">下载检验检疫企业主体备案表格</a>
                        </div>
                        <div class="mid">
                            <div class="inputBox clearfix">
                                <i class="icon name"></i>
                                <input type="text" class="input" placeholder="邮箱" name="username"/>
                            </div>
                            <div class="inputBox clearfix">
                                <i class="icon pwd"></i>
                                <input type="password" name="password" placeholder="密码" class="input"/>
                            </div>
                            <p><a href="javascript:" class="submit" id="loginForm">登 录</a></p>
                            <p class="link" style="margin-top: 8px;">
                                <a style="margin-right:4px;" href="/register">备案</a>
                                <a style="margin-left:4px;" href="/forget-password" >忘记密码</a>
                                <a style="margin-left:4px;" href="/feed-back">咨询与投诉</a>
                            <!-- <a  href="/id/submit-identification" >提交身份证明</a> -->
                            </p>
                            <p class="link" style="margin-top: 2px;">
                                <a style="margin-left:4px;" href="/template/检验检疫企业双备表格.doc" >下载检验检疫企业双备表格</a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
            <div class='login-notice cl'>
                <div class="notice-inc leftloat"></div>
                <div class="notice-text leftloat">
                    <ul class="line">
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['noticeData']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                            <li><a href="/notice/view/?snId=<?php echo $_smarty_tpl->tpl_vars['item']->value['sn_id'];?>
">[<?php echo $_smarty_tpl->tpl_vars['item']->value['sn_notice_serial_no'];?>
]<?php echo $_smarty_tpl->tpl_vars['item']->value['sn_title'];?>
<span><?php echo $_smarty_tpl->tpl_vars['item']->value['sn_add_time'];?>
</span></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footerContainer">
        <div class="min_width">
            <p>Copyright&copy;2015 &nbsp; &nbsp;All Rights Reserved</p>
        </div>
    </div>
</div>
<script src="/dwz/js/jquery-1.7.2.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript">

	$(function(){
		$(".verifyChange").click(function(){
			$('#verifyImg').attr("src","/login/verify-code?"+Math.random());	
		});
        $('#loginForm').live('click',formSubmit);
        $('input[name=password]').keydown(function(e){
			if(e.keyCode==13){
			   formSubmit(); //处理事件
			}
		});
	});

    //登陆验证
    function formSubmit(){
        username = $("[name='username']").val();
        password = $("[name='password']").val();
    //    verify = $("[name='verify']").val();
        if(username==""){
            $("#errorMsg").html("登录账号不能为空");
            return false;
        }
        if(password==""){
            $("#errorMsg").html("登录密码不能为空");
            return false;
        }
		/*
        if(verify==""){
            $("#errorMsg").html("验证码不能为空");
            return false;
        }
		*/
        formData = $("#formLogin").serialize();
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
                //邮件未激活
                }else if(json.ask=='3'){
                    $('input[name=password]').val('');
                    $('#errorTip').html(json.errorMsg);
                    $('#errorMsg').hide();
                    $('#errorPrint').show();
                }else if(json.ask=='2'){
                    $('input[name=password]').val('');
                //    $('input[name=verify]').val('');
                    $('#errorTip').text(json.errorMsg);
                    $('#errorMsg').hide();
                    $('#errorPrint').show();
                }else {
					$('input[name=password]').val('');
				//	$('input[name=verify]').val('');
					var randNumber = parseInt(10*Math.random());
				//	$("#verifyImg").attr('src',"/login/verify-code"+'/rand/'+randNumber);    
                    $('#errorTip').text(json.errorMsg);
                    $('#errorPrint').show();
                }
                if(json.customer_code == undefined){
                    $('#downLoadDoc').hide();
                }else {
                    $('#downLoadDoc').attr('href', "/default/index/print/customerCode/"+json.customer_code);
                }
            }
        })
    }
    
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

    //公告滚动
    $(function(){
        //定义滚动区域
        var _wrap = $('ul.line'); 
        //定义滚动间隙时间
        var _interval = 2000; 
        //需要清除的动画
        var _moving; 
        //当鼠标在滚动区域中时,停止滚动
        _wrap.hover(function(){
            clearInterval(_moving); 
        },function(){
            _moving=setInterval(function(){
                //此变量不可放置于函数起始处,li:first取值是变化的
                var _field=_wrap.find('li:first');
                //取得每次滚动高度(多行滚动情况下,此变量不可置于开始处,否则会有间隔时长延时)
                var _h=_field.height();
                //通过取负margin值,隐藏第一行
                _field.animate({marginTop:-_h+'px'}, 600, function(){
                    //隐藏后,将该行的margin值置零,并插入到最后,实现无缝滚动
                    _field.css('marginTop',0).appendTo(_wrap);
                })
            },_interval)//滚动间隔时间取决于_interval
        }).trigger('mouseleave');//函数载入时,模拟执行mouseleave,即自动滚动
    });

</script>	
</body>
</html><?php }} ?>