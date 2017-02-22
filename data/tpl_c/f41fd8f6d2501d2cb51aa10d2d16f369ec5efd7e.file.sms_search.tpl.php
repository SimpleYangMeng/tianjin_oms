<?php /* Smarty version Smarty-3.1.13, created on 2014-07-15 22:44:36
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/order/sms_search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28200843053c53e54c69576-61442701%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f41fd8f6d2501d2cb51aa10d2d16f369ec5efd7e' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/order/sms_search.tpl',
      1 => 1398047610,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28200843053c53e54c69576-61442701',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page' => 0,
    'pageSize' => 0,
    'types' => 0,
    'key' => 0,
    'condition' => 0,
    'item' => 0,
    'result' => 0,
    'count' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53c53e54da7893_92818695',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53c53e54da7893_92818695')) {function content_53c53e54da7893_92818695($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
sms_search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>        
    </div>	
    <!--
	<div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ChargebackLog<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>        
    </div>
	-->
	
	<div class="pageHeader">
    <form action="/merchant/order/sms-search" method="post" id="pagerForm">
        <input type="hidden" name="page" value="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" id="page" />
        <input type="hidden" name="pageSize" value="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" id="pageSizes"/>

        <div class="searchBar">
            <table >		
				
                <tr>
					<th style="color:#000" class="text_right nowrap">
					&nbsp;<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
					</th>
                    <td style=" text-align:left">
                        <select class="text-input width135" name="status">
                            <option value=""><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
all<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
                            <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
								 <option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['condition']->value['status']=='0'&&$_smarty_tpl->tpl_vars['key']->value=='0'){?>selected="selected"<?php }else{ ?> <?php if ($_smarty_tpl->tpl_vars['key']->value&&$_smarty_tpl->tpl_vars['key']->value==$_smarty_tpl->tpl_vars['condition']->value['status']){?>selected="selected"<?php }?>     <?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</option>
							 <?php } ?>
                        </select>
                    </td>
                    <th style="color:#000" class="text_right nowrap">
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
/<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CustomerReference<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
                    </th>
                    <td style="text-align: left;">
                        <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['transaction_code'];?>
" name="transaction_code" class="text-input width120 "/>
                        
                    </td>
					</tr>
					
					
					<tr>

					<th  style="width:70px;color:#000" class="text_right nowrap">
					<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
createDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
					</th>
					 <td colspan="3">
 						<input type="text" class="datepicker text-input width120" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['add_time_start'];?>
" name="add_time_start" readonly="true">&nbsp;<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
&nbsp;<input type="text" class="datepicker text-input width120" value="<?php echo $_smarty_tpl->tpl_vars['condition']->value['add_time_end'];?>
" name="add_time_end" readonly="true">
					
						<a class="button" href="#" onclick="do_submit();return false;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
search<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
							 
					 </td>
					
					
                </tr>
            </table>
            
        </div>
    </form>
</div>

</div>
	
    <table class="table list" width="100%"  style="margin-top:5px;" id="finance-list-box">
        <thead>
        <tr>     
		
            <th  ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
			<th  ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CustomerReference<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th  ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
			<th  ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
consignee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
name<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th  ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
consignee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
mobilePhone<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
			<th  ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
consignee<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
identification_upload_time<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
createDate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
sms_sent_time<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
            <th ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
remark<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
        </tr>
        </thead>
        <tbody>
		<form  method="post" id='cbDataForm' enctype="multipart/form-data">
        <?php if ($_smarty_tpl->tpl_vars['result']->value!=''){?>
        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['result']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
            <tr sms_status="<?php echo $_smarty_tpl->tpl_vars['item']->value['status'];?>
" not_uploaded="<?php echo $_smarty_tpl->tpl_vars['item']->value['not_uploaded'];?>
">                
               
               
                <td>
                    <a  title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" href="/merchant/order/detail?ordersCode=<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
" class="edit" onclick="parent.openMenuTab('/merchant/order/detail?ordersCode=<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
)','orderdetail<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
');return false;"
					   >
                        <span style="color:#000000"><?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
</span>
                    </a>
                </td>
				  <td >
				<a  title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" href="/merchant/order/detail?ordersCode=<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
" class="edit" onclick="parent.openMenuTab('/merchant/order/detail?ordersCode=<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
orderDetail<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
(<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
)','orderdetail<?php echo $_smarty_tpl->tpl_vars['item']->value['order_code'];?>
');return false;"
					   >
				
				<span style="color:#000000"><?php echo $_smarty_tpl->tpl_vars['item']->value['reference_no'];?>
</span>
				</a>
				</td>
                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['typeText'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['item']->value['idcard_name'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['item']->value['mobile_tel_address'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['item']->value['idcard_upload_time'];?>
</td>
                 <td><?php echo $_smarty_tpl->tpl_vars['item']->value['pub_date'];?>
</td>
                <td>
				<?php echo $_smarty_tpl->tpl_vars['item']->value['sent_time'];?>
<br/><?php if ($_smarty_tpl->tpl_vars['item']->value['resent_time']&&$_smarty_tpl->tpl_vars['item']->value['is_repeat']=='1'){?>(<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
send_again<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:<?php echo $_smarty_tpl->tpl_vars['item']->value['resent_time'];?>
)<?php }?>
				</td>
                 <td><?php echo $_smarty_tpl->tpl_vars['item']->value['return_message'];?>
</td>
            </tr>
            <?php } ?>
        <?php }?>
		</form>
        </tbody>
    </table>
	<div class="clear"></div>
    <div class="panelBar">
        <div class="pagination" targetType="navTab" totalCount="<?php echo $_smarty_tpl->tpl_vars['count']->value;?>
" numPerPage="<?php echo $_smarty_tpl->tpl_vars['pageSize']->value;?>
" currentPage="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"  pageNumShown="10"></div>
    </div>

	
 

<script>
	$(function(){       
    	$("#finance-list-box").alterBgColor();
		 setBackgroundColor();
	});
	
	function do_submit(){	
		$('#pagerForm').attr('action','/merchant/order/sms-search');
		$('#page').val(1);
		$('#pagerForm').submit();
	}
	
	
	function setBackgroundColor(){
	
		$("#finance-list-box tbody tr").each(function(){
			_this = $(this);
			var sms_status = _this.attr('sms_status');
			if(sms_status == '2'){
				_this.css({'background-color':'#fff'});
				_this.css({'color':'#ff0000'});
				_this.find('a span').css({'color':'#ff0000'});
				_this.attr('title','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
failed_to_send_sms<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
			}
			
			var not_uploaded = _this.attr('not_uploaded');
			if(not_uploaded=='yes'){
					_this.css({'background-color':'#ffff00'});
					_this.attr('title','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
more_than_48_hours_not_to_upload_a_copy_of_ID_card<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
			}
			
			
		});		
	
	}
	
	
	
</script><?php }} ?>