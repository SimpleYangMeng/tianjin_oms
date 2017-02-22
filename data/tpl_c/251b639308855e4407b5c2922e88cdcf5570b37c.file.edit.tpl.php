<?php /* Smarty version Smarty-3.1.13, created on 2016-03-18 19:41:02
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\merchant\views\customer\edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2153656ebe94edae480-55839331%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '251b639308855e4407b5c2922e88cdcf5570b37c' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\merchant\\views\\customer\\edit.tpl',
      1 => 1455677483,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2153656ebe94edae480-55839331',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'customerAddress' => 0,
    'country' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56ebe94ee8faa6_81496781',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56ebe94ee8faa6_81496781')) {function content_56ebe94ee8faa6_81496781($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\block.t.php';
?><style>
	.fm-req{margin-top:10px;}
	.fm-opt{margin-top:10px;}
</style>

<style type="text/css">
    #infoform label{
        line-height: 20px;
    }
	#infoform .fm-opt{}
    #infoform .fm-req{
        margin-bottom: 10px;
    }
    #orderForm tbody span.error{
        top:auto;
    }
    span.error{
        top:auto;
        left:158px;
    }
</style>


<div class="content-box closed-box ui-tabs ui-widget ui-widget-content ui-corner-all">
 	<div class="content-box-header">
        <h3 style="margin-left:5px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
contact_baseinfo<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
        <div class="clear"></div>
    </div>

	
		
		<form name="addAcount" action="/merchant/customer/edit" method="post" id="infoform" class="fm-layout"  enctype="multipart/form-data"  style="padding-left:20px" >
		<fieldset>
			
			<table>
				<tr>
					<th class="form_title nowrap text_right"><label for="cab_firstname"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
lastName2<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</label></th>
					<td class="form_input">						
						<input type="text" id="cab_lastname" name="cab_lastname" class="text-input fix-medium-input" value="<?php echo $_smarty_tpl->tpl_vars['customerAddress']->value['cab_lastname'];?>
" />
						<strong class="red">*</strong>					
					</td>
				</tr>
				
				
				<tr>
					<th class="form_title nowrap text_right">
						<label for="cab_lastname"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
firstName2<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</label>

					
					</th>
					<td class="form_input">

						<input type="text" id="cab_firstname" name="cab_firstname" class="text-input fix-medium-input" value="<?php echo $_smarty_tpl->tpl_vars['customerAddress']->value['cab_firstname'];?>
" />
						<strong class="red">*</strong>						
					
					</td>
				</tr>
				
				
				<tr>
					<th class="form_title nowrap text_right">
						<label for="cab_phone"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
phone<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</label>
					</th>
					<td class="form_input">
						<input type="text" id="cab_phone" name="cab_phone" class="text-input fix-medium-input" value="<?php echo $_smarty_tpl->tpl_vars['customerAddress']->value['cab_phone'];?>
" />
                		<strong class="red">*</strong>	
					
					</td>
				</tr>
				
				
				<tr>
					<th class="form_title nowrap text_right">
						<label for="cab_fax"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
fax<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</label>
					</th>
					<td class="form_input">
						<input type="text" id="cab_fax" name="cab_fax" class="text-input fix-medium-input" value="<?php echo $_smarty_tpl->tpl_vars['customerAddress']->value['cab_fax'];?>
" />
                		<strong class="red"></strong>
					</td>
				</tr>	
				
				
				<tr>
					<th class="form_title nowrap text_right">
						 <label for="country"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
country<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：<strong></strong></label>
					</th>
					<td class="form_input">
						<select id="country" name="country" class="validate[required]" style="width:105px;">
							<option value=""><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pleaseSelected<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
country<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
							<?php if ($_smarty_tpl->tpl_vars['country']->value!=''){?>
							<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['country']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['country_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['item']->value['country_id']==$_smarty_tpl->tpl_vars['customerAddress']->value['cab_country_id']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['country_name'];?>
</option>
								<?php } ?>
							<?php }?>
						</select>
						<strong class="red">*</strong>
					</td>
					
				</tr>
				
				<tr>
					<th class="form_title nowrap text_right">
						<label for="cab_state"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
state<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</label>
					</th>
					<td class="form_input">
						<input type="text" id="cab_state" name="cab_state" class="text-input fix-medium-input" value="<?php echo $_smarty_tpl->tpl_vars['customerAddress']->value['cab_state'];?>
" />
						<strong class="red">*</strong>					
					
					</td>
				
				</tr>
				
				<tr>
					<th class="form_title nowrap text_right">
						<label for="cab_city"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
city<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</label>
					</th>
					
					<td class="form_input">
						<input type="text" id="cab_city" name="cab_city" class="text-input fix-medium-input" value="<?php echo $_smarty_tpl->tpl_vars['customerAddress']->value['cab_city'];?>
" />
						<strong class="red">*</strong>
					</td>
				</tr>
				
				
				<tr>
					<th class="form_title nowrap text_right">
						<label for="postcode"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
postalCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</label>
					</th>
					<td class="form_input">
						<input type="text" id="postcode" name="postcode" class="text-input fix-medium-input" value="<?php echo $_smarty_tpl->tpl_vars['customerAddress']->value['cab_postcode'];?>
" />
						<strong class="red"></strong>					
					</td>
				</tr>		
				
				<tr>
					<th class="form_title nowrap text_right">
						<label for="cab_street_address1"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
address<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</label>
					</th>
					
					<td class="form_input">
						<input type="text" id="cab_street_address1" name="cab_street_address1" class="text-input fix-medium-input" value="<?php echo $_smarty_tpl->tpl_vars['customerAddress']->value['cab_street_address1'];?>
" />
						<strong class="red">*</strong>
					</td>
					
				
			</table>		
			
		</fieldset>

		<div class="fm-submit" style="margin-top:10px; padding-left:46px">
			
			<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['customerAddress']->value['cab_id'];?>
">
			<a  class="button tijiao"  onclick="dosubmit();return false;" /><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
submit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
		</div>
	</form>			
			
			
	
			
						
			

<div class="infoTips" id="tips" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
InformationTips<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
">
			
</div>
</div>
<script>
$('#tips').dialog({
			autoOpen: false,
			modal: false,
			bgiframe:true,
			position:[50,50],
			width: 400,				
			resizable: true			
			});
</script>


<script>
    $(function () {
        $("#infoform")[0].reset();

        //验证电话
        $('#cab_phone').blur(function (){
            var emialRegular = /^0\d{2,3}-?\d{7,8}$/;
            if(!emialRegular.test($(this).val())){
                $(this).next().css('color','red');
                $(this).next().text('电话填写错误');
                $(this).focus();
            }else {
                $(this).next().css('color','green');
                $(this).next().text('√');
            }
        });
        //验证邮编
        $('#postcode').blur(function (){
            var emialRegular = /^[1-9][0-9]{5}$/;
            if(!emialRegular.test($(this).val())){
                $(this).next().css('color','red');
                $(this).next().text('邮编填写错误');
                $(this).focus();
            }else {
                $(this).next().css('color','green');
                $(this).next().text('√');
            }
        });

    });
			
	function dosubmit(){
		//return false;	
		///merchant/product/add-save
		var errorHtml = '';
		if($.trim($('#cab_lastname').val())==''){
			errorHtml +='<p><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
lastName2<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
require<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</p>';
		}
		if($.trim($('#cab_firstname').val())==''){
			errorHtml +='<p><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
firstName2<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
require<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</p>';
		}
		if($.trim($('#cab_phone').val())==''){
			errorHtml +='<p><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
phone<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
require<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</p>';
		}
		if($.trim($('#country').val())==''){
			errorHtml +='<p><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
country<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
require<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</p>';
		}
		if($.trim($('#cab_state').val())==''){
			errorHtml +='<p><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
state<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
require<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</p>';
		}
		if($.trim($('#cab_city').val())==''){
			errorHtml +='<p><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
city<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
require<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</p>';
		}
		if($.trim($('#postcode').val())==''){
			errorHtml +='<p><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
postalCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
require<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</p>';
		}
		if($.trim($('#cab_street_address1').val())==''){
			errorHtml +='<p><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
address<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
 <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
require<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</p>';
		}
		if(errorHtml!=''){
			alertTip(errorHtml);
			return false;
		}
					var options = {
					//target:'#combinetips', //后台将把传递过来的值赋给该元素
					url:'/merchant/customer/edit', //提交给哪个执行
					type:'POST',
					dataType:'json',
					//dataType:'html',
					success: function(data){
						var html ="";
						
						if(data.ask==1){
							html += data.message+'</br></br>';
							
							$("#tips").html(html);			
						}else{													
							
							html+=data.message+"<br/>";				
							$.each(data.error,function(idx,vitem){
								html+=vitem+"<br/>";
							});
							
							
							$("#tips").html(html);
						
						}
						
						$('#tips').dialog('open');
						
					
					
					
					}}; //显示操作提示
		
					$("#infoform").ajaxSubmit(options); 
					return false;
		
				
		}  //end of function			
</script><?php }} ?>