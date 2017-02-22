<?php /* Smarty version Smarty-3.1.13, created on 2014-07-03 11:23:19
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/customer/baseinfo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:86555769453b4cca7b31789-74361971%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e2e870747957b080b8446e7b5ad003595f19b110' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/customer/baseinfo.tpl',
      1 => 1398047828,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '86555769453b4cca7b31789-74361971',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'userInfo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53b4cca7bdd194_61013981',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b4cca7bdd194_61013981')) {function content_53b4cca7bdd194_61013981($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><style>
	.fm-req{margin-top:10px;}
	.fm-opt{margin-top:10px;}
</style>


<div class="content-box closed-box ui-tabs ui-widget ui-widget-content ui-corner-all">
 	<div class="content-box-header">
        <h3 style="margin-left:5px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
account_baseinfo<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>
        <div class="clear"></div>
    </div>

	
			
			<form action="/merchant/customer/edit"  id="customeredit" method="post"   class="fm-layout"  enctype="multipart/form-data"  style="padding-left:20px;" >

		
			<table>
				<tr>
					<th class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
account_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</th>
					<td> <?php echo $_smarty_tpl->tpl_vars['userInfo']->value['customer_code'];?>
</td>
				</tr>
				
				<tr>
					<th class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
email_address<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</th>
					<td><?php echo $_smarty_tpl->tpl_vars['userInfo']->value['customer_email'];?>
</td>
				</tr>
				
				<tr>
					<th class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
company_name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</th>
					<td><?php echo $_smarty_tpl->tpl_vars['userInfo']->value['customer_company_name'];?>
</td>
				</tr>
				
				<tr>
					<th class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BusinessName<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</th>
					<td> <?php echo $_smarty_tpl->tpl_vars['userInfo']->value['trade_name'];?>
</td>
				</tr>	
				
				<tr>
					<th class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BusinessCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</th>
					<td><?php echo $_smarty_tpl->tpl_vars['userInfo']->value['trade_co'];?>
</td>
				</tr>
				
				<tr>
					<th class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
EShopPlatform<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</th>
					<td><?php echo $_smarty_tpl->tpl_vars['userInfo']->value['eshop_platform'];?>
</td>
				</tr>	
				
				<tr>
					<th class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
EShopName<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</th>
					<td> <?php echo $_smarty_tpl->tpl_vars['userInfo']->value['eshop_name'];?>
</td>
				</tr>	
				
				
				<tr>
					<th class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
transaction_currency<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</th>
					<td> <?php echo $_smarty_tpl->tpl_vars['userInfo']->value['customer_currency'];?>
</td>
				</tr>	
				
				<tr>
					<th class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
logo_address<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</th>
					<td>
					
						<?php if ($_smarty_tpl->tpl_vars['userInfo']->value['customer_logo']!=''){?>
					
					
						<a  href="<?php echo $_smarty_tpl->tpl_vars['userInfo']->value['customer_logo_save_site'];?>
/index/view-logo-image/customerCode/<?php echo $_smarty_tpl->tpl_vars['userInfo']->value['customer_code'];?>
">
							<img  src="<?php echo $_smarty_tpl->tpl_vars['userInfo']->value['customer_logo_save_site'];?>
/index/view-logo-image/customerCode/<?php echo $_smarty_tpl->tpl_vars['userInfo']->value['customer_code'];?>
" height=100/>
						</a>
				 
						<!--<img src="<?php echo $_smarty_tpl->tpl_vars['userInfo']->value['customer_logo'];?>
" width="50" height="50">-->
						<?php }else{ ?>
						<!--<input type="text" id="logo" name="logo" class="" />-->
						<?php }?>
					
					
					</td>
				</tr>																													
				
			</table>

          
			
			
          
           	
		
		
		</form>
		


</div>
<script>
$('#tips').dialog({
			autoOpen: false,
			modal: false,
			bgiframe:true,
			width: 400,	
			height:500,	
			resizable: true			
			});
</script>
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

<script>
    $(function () {
     
        });
        
    function userinfovalidateCallback(form, callback, confirmMsg) {
        alert(this);
        //var $form = $(form);
        var $form = $('#infoform');
        if (!$form.valid()) {
            return false;
        }
        $form.submit();

        var _submitFn = function(){
            $.ajax({
                type: form.method || 'POST',
                url:$form.attr("action"),
                data:$form.serializeArray(),
                dataType:"json",
                cache: false,
                success: callback || DWZ.ajaxDone,
                error: DWZ.ajaxError
            });
        }

        if (confirmMsg) {
            alertMsg.confirm(confirmMsg, {okCall: _submitFn});
        } else {
            _submitFn();
        }

        return false;
    }
    function userinfocallback(json){
        if(json.ask){
            alertMsg.correct(json.message);
            window.location.reload();
        }else{
            var html = "<strong>"+json.message+"</strong>";
            if(json.error){
                html+=":<br/>";
                $.each(json.error,function(k,v){
                    html+="<span class='red'>*</span>"+v+"<br/>";
                });
            }
            alertMsg.error(html)
        }

    }
	
		$(function(){					
				var tabs_nav = $('#tabs').tabs();	
				tabs_nav.tabs('select', 1); 
				
						
		});	
		
		
function dosubmit(){
    //return false;	
	///merchant/product/add-save
    var errorHtml = '';
    if($.trim($('#cab_lastname').val())==''){
        errorHtml +='<p>姓氏必填</p>';
    }
    if($.trim($('#cab_firstname').val())==''){
        errorHtml +='<p>名字必填</p>';
    }
    if($.trim($('#cab_phone').val())==''){
        errorHtml +='<p>电话必填</p>';
    }
    if($.trim($('#country').val())==''){
        errorHtml +='<p>国家必填</p>';
    }
    if($.trim($('#cab_state').val())==''){
        errorHtml +='<p>省份必填</p>';
    }
    if($.trim($('#cab_city').val())==''){
        errorHtml +='<p>城市必填</p>';
    }
    if($.trim($('#postcode').val())==''){
        errorHtml +='<p>邮编必填</p>';
    }
    if($.trim($('#cab_street_address1').val())==''){
        errorHtml +='<p>地址必填</p>';
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