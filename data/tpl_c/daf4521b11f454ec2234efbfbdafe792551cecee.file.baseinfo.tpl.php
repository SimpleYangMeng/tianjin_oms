<?php /* Smarty version Smarty-3.1.13, created on 2015-11-16 09:39:23
         compiled from "D:\www\import_oms\branches\tianjin\application\modules\merchant\views\customer\baseinfo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:23749564933cba6b8c6-34578952%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'daf4521b11f454ec2234efbfbdafe792551cecee' => 
    array (
      0 => 'D:\\www\\import_oms\\branches\\tianjin\\application\\modules\\merchant\\views\\customer\\baseinfo.tpl',
      1 => 1447406231,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23749564933cba6b8c6-34578952',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'userInfo' => 0,
    'customerTypeTwo' => 0,
    'customerTypeThree' => 0,
    'customerTypeSecond' => 0,
    'foo' => 0,
    'customerTypeThird' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_564933cbbeedf3_61073051',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_564933cbbeedf3_61073051')) {function content_564933cbbeedf3_61073051($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\import_oms\\branches\\tianjin\\libs\\Smarty\\plugins\\block.t.php';
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
					<th class="nowrap text_right">企业类型：</th>
					<td>
                <!--     <?php if ($_smarty_tpl->tpl_vars['userInfo']->value['customer_type']==1){?>电商企业
						<?php }elseif($_smarty_tpl->tpl_vars['userInfo']->value['customer_type']==2){?>物流企业
						<?php }elseif($_smarty_tpl->tpl_vars['userInfo']->value['customer_type']==3){?>支付企业
					<?php }?> -->
                    
                        <input type="checkbox" <?php if ($_smarty_tpl->tpl_vars['userInfo']->value['is_ecommerce']==1){?>checked = "checked"<?php }?>>电商企业
                        <input type="checkbox" <?php if ($_smarty_tpl->tpl_vars['userInfo']->value['is_shipping']==1){?>checked = "checked"<?php }?>>物流企业
                        <input type="checkbox" <?php if ($_smarty_tpl->tpl_vars['userInfo']->value['is_pay']==1){?>checked = "checked"<?php }?>>支付企业
                        <input type="checkbox" <?php if ($_smarty_tpl->tpl_vars['userInfo']->value['is_storage']==1){?>checked = "checked"<?php }?>>仓储企业
					</td>
					<!-- <td>
						<?php if ($_smarty_tpl->tpl_vars['userInfo']->value['customer_type']==1){?>
						<a class="button" onclick="add();">申请绑定功能</a>
						<?php }?>
					</td> -->

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

               <!--  <?php if ($_smarty_tpl->tpl_vars['userInfo']->value['customer_type']==1){?>
                <tr>
                    <th class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
物流仓储企业<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</th>
                    <td><?php echo $_smarty_tpl->tpl_vars['customerTypeTwo']->value;?>
</td>
                </tr>

                <tr>
					<th class="nowrap text_right"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
支付企业<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</th>
					<td><?php echo $_smarty_tpl->tpl_vars['customerTypeThree']->value;?>
</td>
				</tr>
                <?php }?> -->
			</table>

          
			
			
          
           	
		
		
		</form>
		

<!-- <div id="add" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
申请物流和支付绑定功能<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" style="display:none;">
    <div class="modelcontent" style="display: block;">
        <form id="addForm" method="POST" action="/merchant/customer/apply">
        <div>
            <table class="pageFormContent">
                <tr class="jiahuowarehouse" style="display: table-row;">
                    <td width="120" style="text-align:right"><label>物流仓储企业:</label></td>
                    <td width="" style="text-align:right">
                    <select style="width:200px;" name="customer_type_second">
                    <?php  $_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['foo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customerTypeSecond']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['foo']->key => $_smarty_tpl->tpl_vars['foo']->value){
$_smarty_tpl->tpl_vars['foo']->_loop = true;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['foo']->value['customer_code'];?>
"><?php echo $_smarty_tpl->tpl_vars['foo']->value['customer_company_name'];?>
</option>
                    <?php } ?>
                    </select>
                    </td> -->
                    <!-- <?php echo print_r($_smarty_tpl->tpl_vars['customerTypeSecond']->value);?>
 -->
<!--                 </tr>
                <tr class="jiahuowarehouse" style="display: table-row;">
                    <td width="120" style="text-align:right"><label>支付企业:</label></td>
                    <td width="" style="text-align:right">
                    <select style="width:200px;" name="customer_type_third">
                    <?php  $_smarty_tpl->tpl_vars['foo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['foo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['customerTypeThird']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['foo']->key => $_smarty_tpl->tpl_vars['foo']->value){
$_smarty_tpl->tpl_vars['foo']->_loop = true;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['foo']->value['customer_code'];?>
"><?php echo $_smarty_tpl->tpl_vars['foo']->value['customer_company_name'];?>
</option>
                    <?php } ?>
                    </select>
                    </td>
                </tr>
            </table>
        </div>
        </form>
    </div>
</div>
</div> -->

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

	function add(){
        $("#add").dialog('open');
    }		
    $('#add').dialog({
            autoOpen: false,
            modal: true,
            bgiframe:true,
            width: 550,
            height:250,
            resizable: true,
            position: ['center', 60],
            buttons:[
                {
                    text: "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
cancel<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",
                    click: function () {
                        $(this).dialog("close");
                    }
                },
                {
                    text: "<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Determine<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
",
                    click: function () {
                        var data = $("#addForm").serialize();
                        var product_sku = $("#addFormProductSku").val();
                        var warehouse_id = $("#addFormWarehouseId").val();
                        var safe_number = $("[name='safe_number']").val();
                        var errorMessage = "";
                        if(warehouse_id==""){
                            errorMessage+="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Warehouse_required<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</br>";
                        }
                        if(errorMessage!=""){
                            alertTipWrong(errorMessage);
                            return false;
                        }
                        $.ajax({
                            type:"POST",
                            async:false,
                            dataType:'json',
                            url:"/merchant/customer/apply",
                            data:data,
                            success:function(json){
                                if(json.state=="0"){
                                    var html = "";
                                    html = json.error;
                                    alert(html);
                                }else{
                                    var html = "";
                                    html = json.message;
                                    alert(html);
                                    $("#add").dialog('close');
                                }
                            }
                        })
                    }
                }
            ], close: function () {
                $(this).dialog("close");
            }
        });
</script><?php }} ?>