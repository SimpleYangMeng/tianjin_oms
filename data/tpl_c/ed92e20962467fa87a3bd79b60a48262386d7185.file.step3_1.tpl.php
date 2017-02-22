<?php /* Smarty version Smarty-3.1.13, created on 2016-03-22 12:00:53
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\default\views\register\step3_1.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2442256d7dc7a21d1d0-61836844%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ed92e20962467fa87a3bd79b60a48262386d7185' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\default\\views\\register\\step3_1.tpl',
      1 => 1458619249,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2442256d7dc7a21d1d0-61836844',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56d7dc7a33a2c4_80271607',
  'variables' => 
  array (
    'custom' => 0,
    'item' => 0,
    'organizations' => 0,
    'coitem' => 0,
    'agent' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56d7dc7a33a2c4_80271607')) {function content_56d7dc7a33a2c4_80271607($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\block.t.php';
?><link rel="stylesheet" type="text/css" href="/diyUpload/css/webuploader.css">
<link rel="stylesheet" type="text/css" href="/diyUpload/css/diyUpload.css">
<script type="text/javascript" src="/diyUpload/js/webuploader.html5only.min.js"></script>
<script type="text/javascript" src="/diyUpload/js/diyUpload.js"></script>
<style>
form { font-size:1.2em;}
form strong,.form-strong{ font-style:normal; font-weight:normal;}
.form-p{float:left; }
.form-label { overflow:hidden; text-align:right; float:left; width:120px; height:30px; line-height:30px;}
.webuploader-pick{ padding: 5px 15px; }
.form-label-area { overflow:hidden; /*width:110px; */height:30px; line-height:30px; font-weight: bold; font-size: 11px;}
.form-label-area .blue { color: #0088CC; font-weight: 100; }
.form-p .fb_label { cursor: pointer; margin-right: 26px;}
.form-p .fb_label input { height:24px; }
.parentFileBox>.diyButton { text-align: left;}
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
                    <label class="form-label">企业经营类别：</label>
                    <select id="customertype" name="customertype" class="text-input2" style="width:195px">
                    <option value="">请选择...</option>
                    <option value="1">电商企业</option>
                    <option value="2">物流企业</option>
                    <option value="3">支付企业</option>
                    <option value="4">仓储企业</option>
                    <option value="5">监管场所</option>
                    <option value="6">电商平台企业</option>
                    <option value="7">报关企业</option>
                    </select>&nbsp;<strong class="form-strong">*</strong>
                    <strong style="color: #FF0000;"><a class="verifyChange" href="javascript:void(0);"></a></strong>
                </p>
                <p class="form-p">
                    <label class="form-label">主管海关：</label>
                    <select id="customs_code" name="customs_code" class="text-input2" style="width:195px">
                        <option value="">请选择...</option>
                        <?php if ($_smarty_tpl->tpl_vars['custom']->value!=''){?>
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['custom']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['ie_port'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['ie_port_name'];?>
</option>
                            <?php } ?>
                        <?php }?>
                    </select>
                    <strong class="form-strong">*</strong>
                </p>
                <p class="form-p">
                    <label class="form-label">属地检验检疫机构：</label>
                    <select id="ciqOrgTypeCode" name="ciqOrgTypeCode" class="text-input2" style="width:195px">
                        <option value="">请选择...</option>
                        <?php  $_smarty_tpl->tpl_vars['coitem'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['coitem']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['organizations']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['coitem']->key => $_smarty_tpl->tpl_vars['coitem']->value){
$_smarty_tpl->tpl_vars['coitem']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['coitem']->key;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['coitem']->value['organization_code'];?>
" selected="selected"><?php echo $_smarty_tpl->tpl_vars['coitem']->value['organization_name'];?>
</option>
                        <?php } ?>
                        <!--
                        <option value="120010">天津局保税区办事处</option>
                        <option value="120020">天津局天津国际机场办事处</option>
                        <option value="120100">塘沽局本部</option>
                        <option value="120200">天津经济技术开发区局本部</option>
                        <option value="120300">天津东港局本部</option>
                        <option value="120400">天津静海局本部</option>
                        <option value="120500">天津宝坻局本部</option>
                        -->
                    </select>
                    <strong class="form-strong">*</strong>
                </p>
                <!--
                <p style="display:none;" class="form-p">
                    <label class="form-label">报检单位名称：</label>
                    <input class="text-input" type="text" id="ins_unit_name" name="ins_unit_name">
                    <strong class="form-strong">*</strong>
                </p>
                <p style="display:none;" class="form-p">
                    <label class="form-label">报检单位代码： </label>
                    <input class="text-input" type="text" id="ins_unit_code" name="ins_unit_code">
                    <strong class="form-strong">*</strong>
                </p>
                -->
                <p class="form-p">
                    <label class="form-label"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
企业名称<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</label>
                    <input class="text-input" type="text" id="trade_name" name="trade_name">
                    <strong class="form-strong">*</strong>
                </p>
                <p class="form-p">
                    <label class="form-label"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
企业英文名称<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</label>
                    <input class="text-input" type="text" id="trade_name_en" name="trade_name_en">
                    <strong class="form-strong">&nbsp;</strong>
                </p>
                <!--
                <p class="form-p">
                    <label class="form-label">组织机构代码：</label>
                    <input class="text-input" type="text" id="trade_co" name="trade_co">
                    <strong class="form-strong">*</strong>

                </p>
                -->
                <p class="form-p">
                    <label class="form-label">企业注册地址：</label>
                    <input class="text-input" type="text" id="address" name="address">
                    <strong class="form-strong">*</strong>
                </p>
                <p class="form-p">
                    <label class="form-label">邮政编码：</label>
                    <input class="text-input" type="text" id="postcode" name="postcode">
                    <strong class="form-strong">*</strong>
                </p>
                <p class="form-p">
                    <label class="form-label">营业执照签发单位：</label>
                   <input class="text-input" type="text" id="bus_lc_sign_unit" name="bus_lc_sign_unit">
                    <strong class="form-strong">*</strong>
                </p>
                <p class="form-p">
                    <label class="form-label">营业执照编号：</label>
                    <input class="text-input" type="text" id="bus_lic_reg_num" name="bus_lic_reg_num"> 
                    <strong class="form-strong">*</strong>
                </p>
                <!--
                <p class="form-p">
                    <label class="form-label">社会信用代码：</label>
                    <input class="text-input" type="text" id="credit_code" name="credit_code"> 
                    <strong class="form-strong">&nbsp;</strong>
                </p>
                -->
                <p class="form-p">
                    <label class="form-label">企业海关编码： </label>
                    <input class="text-input" type="text" id="customs_reg_num" name="customs_reg_num"> <strong class="form-strong" id="customs_reg_num_tip">*</strong>
                    <!-- <strong class="form-strong">*</strong> -->
                </p>
                <p class="form-p">
                    <select id="here" name="here" class="text-input2" style="width:118px;">
                        <option value=''>请选择</option>>
                        <option value="1">组织机构代码</option>
                        <option value="2">社会信用代码</option>
                    </select>
                    <span id="here-l"><strong class="form-strong">*</strong><strong class="form-strong">(二选一)</strong>营业执照编号/社会信用代码</span>
                </p>
                <div class="clear"></div> 
                <p class="form-p">
                    <label class="form-label">单位联系人手机：</label>
                    <input class="text-input" type="text" id="telphone" name="telphone">
                    <strong class="form-strong">*</strong>
                </p>
                <p class="form-p">
                    <label class="form-label">单位联系人：</label>
                    <input class="text-input" type="text" id="bus_name" name="bus_name">
                    <strong class="form-strong">*</strong>
                </p>
                <p class="form-p">
                    <label class="form-label">单位联系人邮箱：</label>
                    <input class="text-input" type="text" id="contact_man_email" name="contact_man_email">
                    <strong class="form-strong">*</strong>
                </p>
                <span id="agent_id" style="display:none;">
                <p class="form-p">
                    <label class="form-label">代理申报单位：</label>
                    <select id="agent" name="agent" class="text-input2" style="width:195px">
                        <option value="">请选择...</option>
                        <?php if ($_smarty_tpl->tpl_vars['agent']->value!=''){?>
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['agent']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['customer_code'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['trade_name'];?>
</option>
                            <?php } ?>
                        <?php }?>
                    </select>
                    <strong class="form-strong">*</strong>
                </p>
                </span>
                <span id="agent_id-k" style="display:none;">
                <p class="form-p">
                    <label class="form-label">代理申报单位：</label>
                    <select id="agen-k" name="agent-k" class="text-input2" style="width:195px">
                        <option value="">请选择...</option>
                        <?php if ($_smarty_tpl->tpl_vars['agent']->value!=''){?>
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['agent']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['customer_code'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['trade_name'];?>
</option>
                            <?php } ?>
                        <?php }?>
                    </select>
                    <strong class="form-strong">*</strong>
                </p>
                </span>
                <!--   
                <p class="form-p">
                    <label class="form-label">企业网址：</label>
                   <input class="text-input" type="text" id="web_address" name="web_address">
                    <strong class="form-strong">*</strong>
                </p> 
                -->
                <p class="form-p">
                    <label class="form-label">企业法人：</label>
                    <input class="text-input" type="text" id="corporate" name="corporate">
                    <strong class="form-strong">*</strong>
                </p>

                <p class="form-p">
                    <label class="form-label">企业法人证件号码：</label>
                    <input class="text-input" type="text" id="corporate_num" name="corporate_num">
                    <strong class="form-strong">*</strong>
                </p>

                <p class="form-p">
                    <label class="form-label">企业法人联系电话：</label>
                    <input class="text-input" type="text" id="corporate_phone" name="corporate_phone">
                    <strong class="form-strong">*</strong>
                </p>

                <p class="form-p">
                    <label class="form-label">有效期：</label>
                    <input class="text-input datetimeyear" type="text" id="yz_date" name="yz_date" placeholder="" readonly>
                    <strong class="form-strong">*</strong>
                </p>
                <span id="block-l">
                </span>
                <span id="block-w">
                </span>
                <span id="block-z">
                </span>
                <span id="block-c">
                </span>
                <span id="block-j">
                </span>
                <span id="block-k">
                    <!-- <p style="display:none;" class="form-p"><label class="form-label">申报单位代码：</label><input class="text-input" type="text" id="agent_code" name="agent_code"> <strong class="form-strong">*</strong></p>
                    <p style="display:none;" class="form-p"><label class="form-label">申报单位名称： </label><input class="text-input" type="text" id="agent_name" name="agent_name"> <strong class="form-strong">*</strong></p> -->
                    <!-- <p class="form-p"><label class="form-label">电商平台网站：</label><input class="text-input" type="text" id="bus_web_address" name="bus_web_address"> <strong class="form-strong">*</strong></p>
                    <p class="form-p"><label class="form-label">网店名称：</label><input class="text-input" type="text" id="eshop_name" name="eshop_name"> <strong class="form-strong">*</strong></p>
                    <p class="form-p"><label class="form-label">经营产品：</label><input class="text-input" type="text" id="bus_scope" name="bus_scope"> <strong class="form-strong">*</strong></p> -->
                    <!---->
            <!-- <table cellspacing="0" cellpadding="0" class="tableborder formtable" id='item_table'>
                <thead>
                <tr id="error" style="display:none">
                    <td colspan="12" id="product-table-message_tip" class="error">
                    </td>
                </tr>
                <tr>
                    <td>电商平台网站</td>
                    <td>网店名称</td>
                    <td>经营商品</td>
                    <td>操作 <img src='/images/plus_sign.gif'style="margin-left:8px;margin-bottom:-5px;cursor: pointer;" onclick="addProduct()"/></td>
                </tr>

                </thead>
            </table> -->
                    <!---->
                    <!-- <p class="form-p"><label class="form-label">ICP备案号：</label><input class="text-input" type="text" id="cn_icp_code" name="cn_icp_code"> <strong class="form-strong">*</strong></p> -->
                </span>

                <span id="block">
                </span>
                
                <p class="form-p">
                    <label class="form-label">业务类型：</label>
                    <label class="fb_label"><input id="business_type-a" name="business_type[]" val="" type="checkbox" value="1"><span>保税进口</span></label>
                    <label class="fb_label"><input id="business_type-b" name="business_type[]" val="business_type" type="checkbox" value="2"><span>保税出口</span></label>
                    <strong class="form-strong">*</strong>
                </p>
                <!--<p class="form-p">
                    <label class="form-label ysbg">是否报关企业：</label>
                    <span class="is_customs_dec"></span>
                    <input style="line-height:30px;height:30px;" id="is_customs_dec_y" name="is_customs_dec_y" type="checkbox" value="1">是
                    <input id="is_customs_dec_n" name="is_customs_dec_n" type="checkbox" value="0" checked="checked">否 
                    <strong class="form-strong">*</strong>
                </p>-->
                
                <p class="form-p">
                    <label class="form-label">检验检疫编码：</label>
                    <input class="text-input" type="text" id="ciq_num" name="ciq_num">
                    <!--<strong class="form-strong">*</strong>-->
                </p>
                <p class="clear" style="margin:3px 24px">
                    <label class="form-label" style="font-size:12px;">备注：</label>
                    <textarea id="note_s" name="note_s" style="width:75% !important;height:60px;"></textarea>
                </p>
                <div class="clear" style="margin:3px 24px">
                    <div for="file" class="clear form-label-area">工商执照(<span class="blue">请上传工商执照正面，单张大小请不要超过300KB.</span>):</div>
                    <div id="attashed1" class="clear"></div>
                </div>
                <div id="block-none" style="display:none;">
                    <div class="clear" style="margin:3px 24px">
                        <div for="file" class="form-label-area">企业质量承诺书声明(<span class="blue">请上传企业质量承诺书声明，数量不超过 3 张，单张大小请不要超过300KB.</span>):</div>
                        <div id="attashed2" ></div>
                    </div>
                    <div class="clear" style="margin:3px 24px">
                        <div for="file" class="form-label-area">企业质量管理制度(<span class="blue">请上传企业质量管理制度，数量不超过 3 张，单张大小请不要超过300KB.</span>):</div>
                        <div id="attashed3" ></div>
                    </div>
                    <div class="clear" style="margin:3px 24px">
                        <div for="file" class="clear form-label-area">质量诚信经营承诺书(<span class="blue">请上传质量诚信经营承诺书，数量不超过 3 张，单张大小请不要超过300KB.</span>):</div>
                        <div id="attashed4" class="clear"></div>
                    </div>
                </div>
                <div class="clear"></div>
               <!--  <p class="form-p">
                    <label class="form-label-">是否需要平台身份验证:
                        <strong class="form-strong"></strong>
                    </label>
                    <input name="Fruit" type="checkbox" value="" />
                    <strong></strong>
                </p> -->
				<div class="clear"></div>			
                <p class="form-p" style="width: 100%; text-align: center;">
                    <input type="button" class="button text-input" value="提交" style="width:80px;" id="registersub">
                </p>
				<p class="clear"/>
				<ul id="registerinfo"></ul>
				<div class="clear"></div>
            </fieldset>
            <span id="img" style="display:none;"></span>
        </form>
    </div>
</div>
<script type="text/javascript" type="text/javascript">
var opt_val = '';
var opt_here = '';
var getAgent = $("#agent_id").html();
var getAgentK = $("#agent_id-k").html();
$(function(){
		$('#registersub').bind('click',checkForm);
        //check ecommerce value
        $('#customertype').change(function(){ 
            opt_val = $(this).children('option:selected').val();
            if(opt_val == 1){
                var addAgent = getAgent.replace("agent", "agents");
                $("#block").html(addAgent+'<p style="display:none;" class="form-p"><label class="form-label">申报单位代码：</label><input class="text-input" type="text" id="agent_code" name="agent_code"> <strong class="form-strong">*</strong></p><p style="display:none;" class="form-p"><label class="form-label">申报单位名称： </label><input class="text-input" type="text" id="agent_name" name="agent_name"> <strong class="form-strong">*</strong></p><table cellspacing="0" cellpadding="0" class="tableborder formtable" id="item_table"><thead><tr id="error" style="display:none"><td colspan="12" id="product-table-message_tip" class="error"></td></tr><tr><td>电商平台网站</td><td>网店名称</td><td>经营商品</td><td>操作 <img src="/images/plus_sign.gif"style="margin-left:8px;margin-bottom:-5px;cursor: pointer;" onclick="addProduct()"/></td></tr></thead></table><p class="form-p"><label class="form-label">ICP备案号：</label><input class="text-input" type="text" id="cn_icp_code" name="cn_icp_code"> <strong class="form-strong">*</strong></p>');
                $('#agents').change(function(){ 
                    agent_val = $(this).children('option:selected').val();
                    agent_name = $(this).children('option:selected').html();
                    $("#agent_name").val(agent_name);
                    $("#agent_code").val(agent_val);
                })
                $('#customs_reg_num_tip').html();
            }else{
                $("#block").html("");
                $('#customs_reg_num_tip').html('');
            }
            if(opt_val == 2){
                $("#block-w").html('<p class="form-p"><label class="form-label">快递业务许可证：</label><input class="text-input" type="text" id="exp_bus_lic" name="exp_bus_lic"> <strong class="form-strong">*</strong></p>');
            }else{
                $("#block-w").html("");
            }
            
            if(opt_val == 3){
                $("#block-z").html('<p class="form-p"><label class="form-label">支付业务许可证： </label><input class="text-input" type="text" id="pay_bus_lic" name="pay_bus_lic"> <strong class="form-strong">*</strong></p>');
            }else{
                $("#block-z").html("");
            }
            if(opt_val == 4){
                $('#customs_reg_num_tip').html('*');
                $("#block-c").html('<p class="form-p"><label class="form-label">仓库面积：</label><input class="text-input" type="text" id="warehouse_area" name="warehouse_area" value=""> <strong class="form-strong">*</strong></p>');
            }else{
                $("#block-c").html("");
            }
            if(opt_val == 5){
                $("#block-j").html('<p class="form-p"><label class="form-label">监管场所证书编号：</label><input class="text-input" type="text" id="reg_sit_cer_no" name="reg_sit_cer_no"> <strong class="form-strong">*</strong></p>');
            }else{
                $("#block-j").html("");
            }
            if(opt_val == 6){
                var addAgentK = getAgentK.replace("agent-k", "agents-a");
                $("#block-k").html(addAgentK+'<p style="display:none;" class="form-p"><label class="form-label">申报单位代码：</label><input class="text-input" type="text" id="agent_code-k" name="agent_code"> <strong class="form-strong">*</strong></p><p style="display:none;" class="form-p"><label class="form-label">申报单位名称： </label><input class="text-input" type="text" id="agent_name-k" name="agent_name"> <strong class="form-strong">*</strong></p><table cellspacing="0" cellpadding="0" class="tableborder formtable" id="item_table"><thead><tr id="error" style="display:none"><td colspan="12" id="product-table-message_tip" class="error"></td></tr><tr><td>电商平台网站</td><td>网店名称</td><td>经营商品</td><td>操作 <img src="/images/plus_sign.gif"style="margin-left:8px;margin-bottom:-5px;cursor: pointer;" onclick="addProduct()"/></td></tr></thead></table><p class="form-p"><label class="form-label">ICP备案号：</label><input class="text-input" type="text" id="cn_icp_code" name="cn_icp_code"> <strong class="form-strong">*</strong></p>');
                $('[name="agents-a"]').change(function(){ 
                    agent_val = $(this).children('option:selected').val();
                    agent_name = $(this).children('option:selected').html();
                    $("#agent_name-k").val(agent_name);
                    $("#agent_code-k").val(agent_val);
                })
            }else{
                $("#block-k").html("");
            }

            if(opt_val == 1 || opt_val == 6){
                $("#block-none").show();
                var result = '';    
                
                $('#attashed2').diyUpload({
                    url:'/register/uplodeimg',
                    success:function( data ) {
                        result = $("#img").html()+'<input name="attashed2[]" value='+data.id+' /><input name="attashedType2[]" value='+data.type+' /><input name="attashedName2[]" value='+data.atname+' />';
                        $("#img").html(result);
                        result = '';
                    },
                    error:function( err ) {
                        console.info( err );    
                    },
                    //文件上传方式
                    method:"POST",
                    chunked:true,
                    // 分片大小
                    chunkSize:512 * 1024,
                    //最大上传的文件数量
                    fileNumLimit:3,
                    //单个文件大小(单位字节)
                    fileSingleSizeLimit: 300 * 1024,
                    //总文件大小
                    fileSizeLimit: 900 * 1024,
                });
                $('#attashed3').diyUpload({
                    url:'/register/uplodeimg',
                    success:function( data ) {
                        result = $("#img").html()+'<input name="attashed3[]" value='+data.id+' /><input name="attashedType3[]" value='+data.type+' /><input name="attashedName3[]" value='+data.atname+' />';
                        $("#img").html(result);
                        result = '';
                    },
                    error:function( err ) {
                        console.info( err );    
                    },
                    //文件上传方式
                    method:"POST",
                    chunked:true,
                    // 分片大小
                    chunkSize:512 * 1024,
                    //最大上传的文件数量
                    fileNumLimit:3,
                    //单个文件大小(单位字节)
                    fileSingleSizeLimit: 300 * 1024,
                    //总文件大小
                    fileSizeLimit: 900 * 1024,
                }); 
                $('#attashed4').diyUpload({
                    url:'/register/uplodeimg',
                    success:function( data ) {
                        result = $("#img").html()+'<input name="attashed4[]" value='+data.id+' /><input name="attashedType4[]" value='+data.type+' /><input name="attashedName4[]" value='+data.atname+' />';
                        $("#img").html(result);
                        result = '';
                    },
                    error:function( err ) {
                        console.info( err );    
                    },
                    //文件上传方式
                    method:"POST",
                    chunked:true,
                    // 分片大小
                    chunkSize:512 * 1024,
                    //最大上传的文件数量
                    fileNumLimit:3,
                    //单个文件大小(单位字节)
                    fileSingleSizeLimit: 300 * 1024,
                    //总文件大小
                    fileSizeLimit: 900 * 1024,
                }); 
            }else{
                $("#block-none").hide();
            }
        }).change();

        //组织机构代码 社会信用代码二选一
        $('#here').change(function(){ 
            opt_here = $(this).children('option:selected').val();
            //组织机构代码
            if(opt_here == 1){
                $("#here-l").html('<input class="text-input" type="text" id="trade_co" name="trade_co" /><strong class="form-strong">*</strong>');    
            }
            //社会信用代码
            if(opt_here == 2){
                $("#here-l").html('<input class="text-input" type="text" id="credit_code" name="credit_code" /><strong class="form-strong">*</strong>');
            }
            if(opt_here == ''){
                $("#here-l").html('<strong class="form-strong">(二选一)</strong>组织机构代码/社会信用代码<strong class="form-strong">*</strong>');
            }
        })

        $('#agent').change(function(){ 
            agent_val = $(this).children('option:selected').val();
            agent_name = $(this).children('option:selected').html();
            $("#agent_name").val(agent_name);
            $("#agent_code").val(agent_val);
        }).change();

        $('#ciqOrgTypeCode').change(function(){ 
            ins_unit_name = $(this).children('option:selected').html();
            ins_unit_code = $(this).children('option:selected').val();
            $("#ins_unit_code").val(ins_unit_code);
            $("#ins_unit_name").val(ins_unit_name);
        })

        // $('#is_customs_dec_y').change(function(){ 
        //     if ($("#is_customs_dec_y").attr("checked")) {
        //         $(".is_customs_dec").html('<input class="text-input" type="text" id="cus_dec_ent_num" name="cus_dec_ent_num"> <strong class="form-strong">*</strong>');
        //     }else{
        //         $(".is_customs_dec").html('');
        //     }
        // })
        /*$('#is_customs_dec_y').change(function(){
            if ($(this).attr("checked")) {
                $("#is_customs_dec_n").removeAttr("checked");
                $(".is_customs_dec").html('<input class="text-input" type="text" id="cus_dec_ent_num" name="cus_dec_ent_num"> <strong class="form-strong">*</strong>');
                $(".ysbg").text('报关企业资格证号：');
            }else{
                $(this).removeAttr("checked");
                $("#is_customs_dec_n").attr("checked", true);  
                $(".is_customs_dec").html('');
                $(".ysbg").text('是否报关企业：');
            }
        })
        $('#is_customs_dec_n').change(function(){ 
            if ($(this).attr("checked")) {
                $("#is_customs_dec_y").removeAttr("checked");
                $(".is_customs_dec").html('');
                $(".ysbg").text('是否报关企业：');
            }else{
                $(this).removeAttr("checked");
                $("#is_customs_dec_y").attr("checked", true);  
                $(".is_customs_dec").html('<input class="text-input" type="text" id="cus_dec_ent_num" name="cus_dec_ent_num"> <strong class="form-strong">*</strong>');
                $(".ysbg").text('报关企业资格证号：');
            }
        })*/

        $(".datetime").datepicker({
            datetimepicker: true,        
            changeMonth: true,        
            changeYear: true,        
            dateFormat: 'yy-m-d',        
            // timeFormat: 'hh:mm:00',        
            stepHour: 2,        
            stepMinute: 10,        
            stepSecond: 10,        
            dayNamesMin: [ "日","一", "二", "三", "四", "五", "六"],        
            monthNamesShort: ["一", "二", "三", "四", "五", "六", "七", "八", "九", "十", "十一", "十二"]
            // timeText: '选择时间',
            // hourText: '小时',
            // minuteText: '分钟',
            // secondText: '秒',
            // millisecText: '毫秒',
            // currentText: '当前时间',
            // closeText: '确定',
            // ampm: false
        });
        $(".datetimeyear").datepicker({
            datetimepicker: true,
            changeMonth: false,
            changeYear: true,
            /*onClose : function(dateText, inst){
                var datearr =dateText.split('-');
                var year = datearr[0];
                var month = datearr[1];
                if(parseInt(month)>7){
                    year = parseInt(year)+parseInt(1);
                }
                var dateString = year+'-07-31';
                $(this).datepicker( "setDate", dateString );
            },*/
            dateFormat: 'yy-mm-dd',
            // timeFormat: 'hh:mm:00',
            stepHour: 2,
            stepMinute: 10,
            stepSecond: 10,
            dayNamesMin: [ "日","一", "二", "三", "四", "五", "六"],
            monthNamesShort: ["一", "二", "三", "四", "五", "六", "七", "八", "九", "十", "十一", "十二"]
            // timeText: '选择时间',
            // hourText: '小时',
            // minuteText: '分钟',
            // secondText: '秒',
            // millisecText: '毫秒',
            // currentText: '当前时间',
            // closeText: '确定',
            // ampm: false
        });
	});

    //提示信息
    function alertTip(tip, reloadinfo) {
        var reloadinfo =  reloadinfo||1;
		if(reloadinfo==1){$('#registerinfo').empty();}
		if(reloadinfo==3){
			$('#registerinfo').empty();
			$('<li class="success">'+tip+'</li>').appendTo($('#registerinfo').show());
			return;
		}
		$('<li class="error">'+tip+'</li>').appendTo($('#registerinfo').show());
        setTimeout(function (){
            $('#registerinfo').slideUp('slow');
        }, 3000);
		return false;
    }

    function getCbVal(){
        var text="";  
        $("input[val=ct_type]").each(function() {  
            if ($(this).attr("checked")) {  
                text += Number($(this).val());  
            }  
        }); 
        return text;
    }

    function checkForm(){
        var bus_lc_sign_unit = $("[name='bus_lc_sign_unit']").val();
        var customertype = $("[name='customertype']").val();
        var agents = $("#agents").val();
        var lastname = $("[name='lastname']").val();
        var telphone = $("[name='telphone']").val();
        var postcode = $("[name='postcode']").val();
        // var web_address = $("[name='web_address']").val();
        var bus_lic_reg_num = $("[name='bus_lic_reg_num']").val();
        var credit_code = $("[name='credit_code']").val();
        var corporate = $("[name='corporate']").val();
        var custom_code = $("[name='custom_code']").val();
        var agent_name = $("[name='agent_name']").val();
        var agent_code = $("[name='agent_code']").val();
        var agent_code_k = $("#agent_code-k").val();
        var agent_name_k = $("#agent_name-k").val();
        var customs_reg_num = $("[name='customs_reg_num']").val();
        var bus_name = $("[name='bus_name']").val();
        var contact_man_email = $("[name='contact_man_email']").val();
        var address = $("[name='address']").val();
        var eshop_name = $("[name='eshop_name']").val();
        var corporate_num = $("[name='corporate_num']").val();
        var trade_name = $("[name='trade_name']").val();
		var trade_co = $("[name='trade_co']").val();
        var bus_web_address = $("[name='bus_web_address']").val();
        var cn_icp_code = $("[name='cn_icp_code']").val();
        var corporate_phone = $("[name='corporate_phone']").val();
        var yz_date = $("[name='yz_date']").val();
        var pay_bus_lic = $("[name='pay_bus_lic']").val();
        var exp_bus_lic = $("[name='exp_bus_lic']").val();
        var warehouse_area = $("[name='warehouse_area']").val();
        var reg_sit_cer_no = $("[name='reg_sit_cer_no']").val();

        // var business_type = $("#business_type").attr("checked");
        
        var customs_code = $("[name='customs_code']").val();
        var ciqOrgTypeCode = $("[name='ciqOrgTypeCode']").val();

        if(opt_val == 1){
            if($("#bus_web_address").length==0){
                alertTip("请添加 电商平台网站、网店名称、经营商品");
                return false;
            }
            var str ='';
            $("#item_table tr input").each(function(){
                if($(this).val()==""){
                    str += $(this).val() + "-";
                }
            });
            if(str!=""){
                alertTip("电商平台网站、网店名称、经营商品不能为空!(请检查填写)");
                return false;
            }
        }

        if(opt_val == 6){
            if($("#bus_web_address").length==0){
                alertTip("请添加 电商平台网站、网店名称、经营商品");
                return false;
            }
            var str ='';
            $("#item_table tr input").each(function(){
                if($(this).val()==""){
                    str += $(this).val() + "-";
                }
            });
            if(str!=""){
                alertTip("电商平台网站、网店名称、经营商品不能为空!(请检查填写)");
                return false;
            }
        }
        if(customertype==""){
            alertTip("请选择企业经营类别");
            return false;
        }
        if(customs_code==""){
            alertTip("请选择主管海关");
            return false;
        }
        if(ciqOrgTypeCode==""){
            alertTip("请选择属地检验检疫机构");
            return false;
        }
        if(trade_name==""){
            alertTip("企业名称不能为空");
            return false;
        }
        /*
        if(trade_co==""){
            alertTip("组织机构代码不能为空");
            return false;
        }
        */
        if(address==""){
            alertTip("企业注册地址不能为空");
            return false;
        }
        if(postcode==""){
            alertTip("邮政编码不能为空");
            return false;
        }
        if(bus_lc_sign_unit==""){
            alertTip("营业执照签发单位不能为空");
            return false;
        }
        if(bus_lic_reg_num==""){
            alertTip("营业执照编号不能为空");
            return false;
        }
        if(opt_val == 4){
            if(customs_reg_num==""){
                alertTip("企业海关编码不能为空");
                return false;
            }
        }
        //组织机构代码 社会信用代码二选一
        if(opt_here == ''){
            alertTip("请选择 组织机构代码或统一社会信用代码(二选一)");
            return false;
        }else{
            if(opt_here == 1){
                if(trade_co == ""){
                    alertTip("组织机构代码不能为空");
                    return false;
                }
            }
            if(opt_here == 2){
                if(credit_code == ""){
                    alertTip("社会信用代码不能为空");
                    return false;
                }
            }
        }
        if(telphone==""){
            alertTip("单位联系人手机不能为空");
            return false;
        }
        if(bus_name==""){
            alertTip("单位联系人不能为空");
            return false;
        }
        if(contact_man_email==""){
            alertTip("单位联系人邮箱不能为空");
            return false;
        }
        
        if(corporate==""){
            alertTip("企业法人不能为空");
            return false;
        }
        if(corporate_num==""){
            alertTip("企业法人证件号码不能为空");
            return false;
        }
        if(corporate_phone==""){
            alertTip("企业法人联系电话不能为空");
            return false;
        }
        if(yz_date==""){
            alertTip("有效期不能为空");
            return false;
        }
        if(agents==""){
            $('#customertype').change();
        }
        if(agents==""){
            alertTip("申报单位不能为空");
            return false;
        }
        if(opt_val == 3){
            if(pay_bus_lic==""){
                alertTip("支付业务许可证不能为空");
                return false;
            }
        }
        if(opt_val == 2){
            if(exp_bus_lic==""){
                alertTip("快递业务许可证不能为空");
                return false;
            }
        }       
        if(warehouse_area==""){
            alertTip("仓库面积不能为空");
            return false;
        }
        if(opt_val == 5){
            if(reg_sit_cer_no==""){
                alertTip("监管场所证书编号不能为空");
                return false;
            }
        }
        // alert(business_type);
        // if(business_type==""){
        //     alertTip("请选择业务类型");
        //     return false;
        // }

        if(!$("#business_type-a").attr("checked") && !$("#business_type-b").attr("checked")){
            alertTip("请选择业务类型");
            return false;
        }

        /*if(!$("#is_customs_dec_y").attr("checked") && !$("#is_customs_dec_n").attr("checked")){
            alertTip("请勾选是否报关企业");
            return false;
        }

        if($("#is_customs_dec_y").attr("checked") && !$("#cus_dec_ent_num").val()){
            alertTip("报关企业资格证号不能为空");
            return false;
        }*/
        

        
        // if(web_address==""){
        //     alertTip("企业网址不能为空");
        //     return false;
        // } 
        if(address==""){
            alertTip("地址不能为空");
            return false;
        }
        if(opt_val == 1){
            if(agent_code==""){
                alertTip("申报单位代码不能为空");
                return false;
            }
            if(agent_name==""){
                alertTip("申报单位名称不能为空");
                return false;
            }
            if(bus_web_address==""){
                alertTip("电商平台网站不能为空");
                return false;
            }
            if(eshop_name==""){
                alertTip("网店名称不能为空");
                return false;
            } 
            if(cn_icp_code==""){
                alertTip("ICP备案号不能为空");
                return false;
            }               
        }
        if(opt_val == 6){
            if(agent_code_k==""){
                alertTip("申报单位代码不能为空");
                return false;
            }
            if(agent_name_k==""){
                alertTip("申报单位名称不能为空");
                return false;
            }
            if(bus_web_address==""){
                alertTip("电商平台网站不能为空");
                return false;
            }
            if(eshop_name==""){
                alertTip("网店名称不能为空");
                return false;
            } 
            if(cn_icp_code==""){
                alertTip("ICP备案号不能为空");
                return false;
            }               
        }
        /*if(customs_reg_num==""){
            alertTip("企业海关编码不能为空");
            return false;
        }*/

        /*if(opt_val == 4){

        }
        */
        var ciq_num = $('#ciq_num').val();
        if(ciq_num != ''){
            if( ciq_num.length != 10 ){
                alertTip('检验检疫编码为10位');
                return false;
            }
        }

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
                        $.each(json.error, function(key, item){
                            alertTip(item, 2);
                            //重新登陆
                            if(item == '登陆账号验证邮箱为空或者登陆账号和邮箱账户不符，请核对后登陆'){
                                var gotoURL ='window.location.href="/login"';
                                setTimeout(gotoURL, 2000);
                            }
                        });
                    }
                }
            }
        });		
    }

$('#attashed1').diyUpload({
    url:'/register/uplodeimg',
    success:function( data ) {
        result = $("#img").html()+'<input name="attashed1[]" value='+data.id+' /><input name="attashedType1[]" value='+data.type+' /><input name="attashedName1[]" value='+data.atname+' />';
        $("#img").html(result);
        result = '';
    },
    error:function( err ) {
        console.info( err );  
    },
    //文件上传方式
    method:"POST",
    chunked:true,
    // 分片大小
    chunkSize:512 * 1024,
    //最大上传的文件数量
    fileNumLimit:1,
    //单个文件大小(单位字节)
    fileSingleSizeLimit: 300 * 1024,
    //总文件大小
    fileSizeLimit:300 * 1024,
});


//添加电商网址
function addProduct(){
    var html='<tr><td><input class="text-input" type="text" id="bus_web_address" name="bus_web_address[]"> <strong class="form-strong">*</strong></td><td><input class="text-input" type="text" id="eshop_name" name="eshop_name[]"> <strong class="form-strong">*</strong></td><td><input class="text-input" type="text" id="bus_scope" name="bus_scope[]"> <strong class="form-strong">*</strong></td><td><img src="/images/minus_sign.gif" style="margin-left:8px;margin-top:5px;position:absolute;cursor: pointer;" onclick="deleteProudt(this)"></td></tr>';
        $("#item_table").append(html);
        //  sucss['key']++;
        // replaceMinus();
}

function deleteProudt(obj){
    $(obj).parents('tr').remove();
}
</script><?php }} ?>