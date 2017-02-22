<?php /* Smarty version Smarty-3.1.13, created on 2014-07-18 12:49:54
         compiled from "/home/apache/www/import/oms/application/modules/default/views/register/step3_1.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20258815853c8a7720cc017-22158130%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9347894ef5fab2cc27517a10fbb80fb2a4318a7d' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/default/views/register/step3_1.tpl',
      1 => 1396509312,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20258815853c8a7720cc017-22158130',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
    'currency' => 0,
    'item' => 0,
    'country' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53c8a77215b2b1_80509648',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53c8a77215b2b1_80509648')) {function content_53c8a77215b2b1_80509648($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><style>
form { font-size:1.2em;}
form strong,.form-strong{ font-style:normal; font-weight:normal;}
.form-p{float:left; }
.form-label { overflow:hidden; text-align:left;float:left;width:95px; height:30px;  line-height:30px;}
</style>
<div class="grid-780 grid-780-pd fn-hidden fn-clear">
    <div class="flow-steps">
        <ol class="num4">
            <li ><span class="first">注册账号</span></li>
            <li><span>邮箱验证</span></li>
			<li ><span>注册条款</span></li>
            <li class="current"><span>完善资料</span></li>
            <li><span>注册完成</span></li>
        </ol>
    </div>
    <div class="grid-780 fn-clear" style="border:1px solid #eee;">
        
        <form id="registerForm" class="fm-layout"  style="margin-top:10px;" method="post" action="/register/complete" >
            <fieldset>
                <p class="form-p">
                    <label class="form-label">账号：
                       
                    </label>
                    <input disabled="disabled" class="text-input" type="text"  id="username" name="username" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['code'];?>
">
                    <strong class="form-strong">*</strong>
                </p>
                <p class="form-p">
                    <label class="form-label">邮箱：
                       
                    </label>
                    <input class="text-input" type="text" id="email" name="email" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['email'];?>
" disabled="disabled">
                     <strong class="form-strong">*</strong>
                </p>
                <p class="form-p">
                    <label class="form-label">公司名称：
                       
                    </label>
                    <input class="text-input" type="text" id="companyname" name="companyname">
                     <strong class="form-strong">*</strong>
                </p>
             	<p class="form-p">
                    <label class="form-label">Logo地址：
                        <strong class="form-strong"></strong>
                    </label>
					 <input class="text-input3" type="file" id="logofile" name="logofile"  />
                    <!--<input class="text-input" type="text" id="logo" name="logo"  />-->
                    <strong></strong>Logo我们会打印到配货单中,建议300x100像素，白底图片。 
                </p>
                <p class="form-p">
                    <label class="form-label"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BusinessName<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
                        
                    </label>
                    <input class="text-input" type="text" id="trade_name" name="trade_name">
                    <strong class="form-strong">*</strong>
                </p>

                <p class="form-p">
                    <label class="form-label"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BusinessCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
                        
                    </label>
                    <input class="text-input" type="text" id="trade_co" name="trade_co">
                    <strong class="form-strong">*</strong>
					<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BusinessCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
为10位数字。
                </p>
						
                <p class="form-p">
                    <label class="form-label"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
EShopPlatform<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
                        
                    </label>
                    <input class="text-input" type="text" id="eshop_platform" name="eshop_platform">
                    <strong class="form-strong">*</strong>
                </p>

                <p class="form-p">
                    <label class="form-label"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
EShopName<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
                        
                    </label>
                    <input class="text-input" type="text" id="eshop_name" name="eshop_name">
                    <strong>*</strong> 
                </p>
										
												
                <p class="form-p">
                    <label class="form-label">交易币种：
                        
                    </label>
                    <select id="currency" name="currency" class="text-input2">
                    <option value="">请选择...</option>
                    <?php if ($_smarty_tpl->tpl_vars['currency']->value!=''){?>
                    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['currency']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['currency_code'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value["currency_name"];?>
</option>
                        <?php } ?>
                    <?php }?>
                    </select>&nbsp;<strong class="form-strong">*</strong>
                    <strong style="color: #FF0000;"><a class="verifyChange" href="javascript:void(0);"></a></strong>
                </p>
   				<div class="clear"></div>
				<!--
                <p class="form-p">
                    <label class="form-label">营业执照
                        <strong class="form-strong">*</strong>
                    </label>
                    <input type="file" id="license" class="text-input" name="license" />
                    <strong></strong>
                </p>
                <p class="form-p">
                    <label class="form-label">身份证件
                        <strong class="form-strong">*</strong>
                    </label>
                    <input type="file" id="identity" name="identity"  class="text-input" />
                    <strong></strong>
                </p>
                <p class="form-p">
                    <label class="form-label">报关注册登记证
                        <strong class="form-strong">*</strong>
                    </label>
                    <input type="file" id="customlsn" name="customlsn"  class="text-input" />
                    <strong></strong>
                </p>		
				!-->
                <p class="form-p">
                    <label class="form-label">姓氏：
                       
                    </label>
                    <input class="text-input" type="text" id="firstname" name="lastname">
                    <strong class="form-strong">*</strong>
                </p>
                <p class="form-p">
                    <label class="form-label">名字：
                       
                    </label>
                    <input class="text-input" type="text" id="lastname" name="firstname">
                     <strong class="form-strong">*</strong>
                </p>
                <p class="form-p">
                    <label class="form-label">电话：
                        
                    </label>
                    <input class="text-input" type="text" id="telphone" name="telphone">
                    <strong class="form-strong">*</strong>
                </p>
                <p class="form-p">
                    <label class="form-label">传真：
                        
                    </label>
                    <input class="text-input" type="text"id="fax" name="fax">
                    <strong class="form-strong"></strong>
                </p>
                <p class="form-p">
                    <label class="form-label">国家：
                        
                    </label>
                    <select id="country" name="country" class="text-input2">
                        <option value="">请选择国家</option>
                        <?php if ($_smarty_tpl->tpl_vars['country']->value!=''){?>
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['country']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['country_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['item']->value['country_name']=="中国"){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['country_name'];?>
</option>
                            <?php } ?>
                        <?php }?>
                    </select>
                    <strong class="form-strong">*</strong>
                </p>
				<div class="clear"></div>
                <p class="form-p">
                    <label class="form-label">省份：
                      
                    </label>
                    <input class="text-input" type="text" id="province" name="province">
                      <strong class="form-strong">*</strong>
                </p>
						
                <p class="form-p">
                    <label class="form-label">城市：
                        
                    </label>
                    <input class="text-input" type="text" id="city" name="city">
                    <strong class="form-strong">*</strong>
                </p>
                <p class="form-p">
                    <label class="form-label">地址：
                       
                    </label>
                    <input class="text-input" type="text" id="address" name="address">
                     <strong class="form-strong">*</strong>
                </p>
                <p class="form-p">
                    <label class="form-label">邮编：
                        
                    </label>
                   <input class="text-input" type="text" id="postcode" name="postcode">
                    <strong class="form-strong">*</strong>
                </p>
               <p class="form-p">
                    <label class="form-label">配货单声明：
                        <strong class="form-strong"></strong>
                    </label>
                   <textarea class="text-input" type="text" id="picking_statement"   name="picking_statement"></textarea>
                    <strong></strong>这段声明文字我们会打印到配货单中,长度最大为300个字符,行数限定在三行以内。
                </p>				

				<!--
                <p class="form-p">
                    <label class="form-label">电子签名
                        <strong class="form-strong"></strong>
                    </label>
                    <input class="text-input" type="text" id="signature" name="signature" />
                    <strong></strong>
                </p>
				!-->	
				<div class="clear"></div>			
            
                <p class="form-p">
                    <input type="button" class="button text-input" value="提交" style="width:80px;" id="registersub">
                </p>
				<p class="clear"/>
				<ul id="registerinfo">
						
				</ul>
				<div class="clear"></div>
            </fieldset>
        </form>
    </div>
</div>
<script type="text/javascript" language="javascript">
	$(function(){
		//$("#regform").validationEngine();
		$('#registersub').bind('click',checkForm);
	})

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

    function checkForm(){
        var companyname = $("[name='companyname']").val();
        var currency = $("[name='currency']").val();
        var firstname = $("[name='firstname']").val();
        var lastname = $("[name='lastname']").val();
        var telphone = $("[name='telphone']").val();
        var country = $("[name='country']").val();
        var state = $("[name='state']").val();
        var city = $("[name='city']").val();
        var postcode = $("[name='postcode']").val();
        var address = $("[name='address']").val();
		
		var trade_name = $("[name='trade_name']").val();
		var trade_co = $("[name='trade_co']").val();
		/*
		var license = $("#identity").val();
		var identity = $("#license").val();
		var customlsn = $("#customlsn").val();
		*/
        if(companyname==""){
            alertTip("公司名称不能为空！");
            return false;
        }
        if(trade_name==""){
            alertTip("经营单位名称不能为空!");
            return false;
        }
        if(trade_co==""){
            alertTip("备案企业编码不能为空!");
            return false;
        }	
		
		var eshop_platform = $("[name='eshop_platform']").val();
        if(eshop_platform==""){
            alertTip("销售电商平台不能为空!");
            return false;
        }		
		var eshop_name = $("[name='eshop_name']").val();
        if(eshop_name==""){
            alertTip("电商店铺名称不能为空!");
            return false;
        }		
		/*	
        if(license==""){
           alertTip("营业执照必须上传！");
            return false;
        }
		
        if(identity==""){
            alertTip("身份证必须上传！");
            return false;
        }	
        if(customlsn==""){
            alertTip("报关注册登记证必须上传！");
            return false;
        }	
		*/
        if(address==""){
            alertTip("地址不能为空!");
            return false;
        }
        if(currency==""){
            alertTip("交易币种不能为空！");
            return false;
        }
        if(firstname==""){
            alertTip("名字不能为空！");
            return false;
        }
        if(lastname==""){
            alertTip("姓氏不能为空！");
            return false;
        }
        if(telphone==""){
            alertTip("电话不能为空！");
            return false;
        }
        if(country==""){
            alertTip("国家不能为空！");
            return false;
        }
        if(state==""){
            alertTip("省份不能为空！");
            return false;
        }
        if(city==""){
            alertTip("城市不能为空！");
            return false;
        }
        if(postcode==""){
            alertTip("邮编不能为空！");
            return false;
        }
        if(address==""){
            alertTip("地址不能为空!");
            return false;
        }
		
		alertTip("");
 		
                $('#registerForm').ajaxSubmit(
				{
                    type:"POST",                    
                    dataType:"json",                    
                    url:'/register/complete',
                    success:function(json) {
						
						
                        var html = '';
                        if(json.ask=='1'){
                           
                            alertTip(json.message,3);
							var gotoURL ='window.location.href="/register/step?current=4"';
							var t = setTimeout(gotoURL,2000);
							
                        }else{
						
							if(typeof(json.authcodeError) != 'undefined' && json.authcodeError ==1){
								$(".verifyChange").trigger('click');
							}
                            html +=json.message;
                            if(typeof(json.error) != 'undefined'){
							
								$('#registerinfo').empty();
                                $.each(json.error,function(key,item){
                                  
								   alertTip(item,2);
								    //html += "<p class='messageFail'><image src='/images/icons/icon_missing.png' /> "+item+"</p>";
                                });
                                //$('.orderMessage').html(html).show();
                            }
                           
                        }
                        //$('.submit').attr('disabled',false);
                    }
                });		
		

    }
	
	
</script><?php }} ?>