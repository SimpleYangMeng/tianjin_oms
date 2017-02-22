<?php /* Smarty version Smarty-3.1.13, created on 2016-03-03 16:08:21
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\merchant\views\receiving\receiving-import-inner.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1429656d7f0f5c89b05-65400964%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4b5a98b2439d520e6642bcf47966782a0ee1a8a9' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\merchant\\views\\receiving\\receiving-import-inner.tpl',
      1 => 1455677484,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1429656d7f0f5c89b05-65400964',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56d7f0f5ce2c87_50428105',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56d7f0f5ce2c87_50428105')) {function content_56d7f0f5ce2c87_50428105($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\block.t.php';
?><style type="text/css">
    .tableborder th{
        text-align: right;
        height: 20px;
        line-height: 20px;
        padding:5px;
    }
    .tableborder td{
        text-align: left;
        height: 20px;
        line-height: 20px;
        padding:5px;
    }
    .message-warning
    {
        color: #5f5200;
		padding:5px;
		min-height:300px;
		
    }
    .error
    {
        margin: 0;
        padding: 8px 0 0 0;
        height: 1%;
        display: block;
        clear: both;
        overflow: hidden;
        color: #FF0000;
        padding-left: 20px;
    }
</style>
<div id="detail-import-header" style="height:160px;">
	<div style="float:left;width:48%;">
	<form action="/merchant/receiving-upload/import-preview" method="post" id="detailForm" enctype="multipart/form-data">
		<table cellspacing="0" cellpadding="0" class="tableborder" style="width:100%;">
			<tr>
			<th>入库明细:</th>
			<td><input type="file" name="detailInput" id="detailInput" />
			<font style="color:red;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_select_xls_file<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</font>
			</td>
			</tr>
			<tr>
			<th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
sample_file_download<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</th>
			<td>
			<img src="/images/download.png" style="width:25px;"><span style="color:#999"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
download_templete<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</span><a  style="color:#666666;text-decoration:underline;" href="/merchant/receiving-upload/download-templete/id/1">模板</a>
			</td>
			</tr>
			<tr>
			<td colspan="2">
			<input type="submit" class="button buttonheight" value="上传" />		
			</td></tr>
		</table>
	</form>
	</div>
	<div style="float:left;width:48%;padding-left:10px;">
	<form action="/merchant/receiving-upload/boat-import-preview" method="post" id="boatForm" enctype="multipart/form-data">
		<table cellspacing="0" cellpadding="0" class="tableborder" style="width:100%;">
			<tr>
			<th>集装箱信息:</th>
			<td><input type="file" name="boatInput" id="boatInput" />
			<font style="color:red;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_select_xls_file<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</font>
			</td>
			</tr>
			<tr>
			<th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
sample_file_download<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</th>
			<td>
			<img src="/images/download.png" style="width:25px;"><span style="color:#999"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
download_templete<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</span><a  style="color:#666666;text-decoration:underline;" href="/merchant/receiving-upload/download-templete/id/2">模板</a>
			</td>
			</tr>
			<tr>
			<td colspan="2">
			<input type="submit" class="button buttonheight" value="上传" />		
			</td></tr>
		</table>
	</form>
	</div>
</div>

<div id="detail-import-body" style="display:none;">
<table cellspacing="0" cellpadding="0" class="tableborder"  style="width:100%;">
	<thead>
	<tr>
		<th colspan="7" style="text-align:left;">入库单明细</th>
	</tr>
	<tr style="background-color: rgb(170, 255, 255);">
		<th align="center" bgcolor="#AAFFFF"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
no<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
		<th align="center" bgcolor="#AAFFFF">料件号</th>
		<th align="center" bgcolor="#AAFFFF">产品名称</th>
		<th align="center" bgcolor="#AAFFFF">申报数量</th>
		<th align="center" bgcolor="#AAFFFF">法定数量</th>
		<th align="center" bgcolor="#AAFFFF">申报单价</th>
		<th align="center" bgcolor="#AAFFFF">申报总价</th>
	</tr>
	</thead>
	<tbody id='detailAjaxResult'>
	</tbody>
	<tr>
		<th colspan="7" style="text-align:left;">集装箱信息</th>
	</tr>
	<tbody id='contaAjaxResult'>
	<tr>
		<th colspan="7" style="text-align:center;">无数据</th>
	</tr>
	</tbody>
</table>
</div>

<script type="text/javascript">
$('#detailForm').on('submit', function() {
	if(!$('#detailInput').val()){
		alertTip('<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
make_sure_that_you_have_selected_a_file<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
		return false;
	}else{
		$(this).ajaxSubmit({
			type: 'POST',
			url: '/merchant/receiving-upload/import-preview',
			dataType:'json',
			success: function(json) {
				var html	= '';
				$("#detail-import-body").hide();
				if(1 == json.ask){
					var html	= '';
					var i 		= 1;
					$.each(json.data,function(key,val){
						html	+= '<tr>';
						html	+= '<td>'+i+'</td>';
						html	+= '<td>'+val.goodsId+'</td>';
						html	+= '<td>'+val.nameCn+'</td>';
						html	+= '<td>'+val.gQty+'</td>';
						html	+= '<td>'+val.qty1+'</td>';
						html	+= '<td>'+val.declPrice+'</td>';
						html	+= '<td>'+val.declTotal+'</td>';
						html	+= '</tr>';
						i++;
					});
					$("#detail-import-body").show();
				}else{
					var message = json.message+'<br/>';
					if(null != json.error){
						$.each(json.error,function(item,val){
							message += val+'<br/>';
						})
					}
					alertTip(message);
					return false;
				}
				$("#detailAjaxResult").html(html);
			}
		});
	}
	return false;
});

$('#boatForm').on('submit', function() {
	if(!$('#boatInput').val()){
		alertTip('<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
make_sure_that_you_have_selected_a_file<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
');
		return false;
	}else{
		$(this).ajaxSubmit({
			type: 'POST',
			url: '/merchant/receiving-upload/boat-import-preview',
			dataType:'json',
			success: function(json) {
				var html	= '<tr style="background-color: rgb(170, 255, 255);"><th>序号</th><th colspan="2">集装箱号</th><th colspan="2">规格</th><th colspan="2">自重</th></tr>';
				if(1 == json.ask){
					var i 		= 1;
					$.each(json.data,function(key,val){
						html	+= '<tr>';
						html	+= '<td>'+i+'</td>';
						html	+= '<td colspan="2">'+val.conta_id+'</td>';
						html	+= '<td colspan="2">'+val.conta_model+'</td>';
						html	+= '<td colspan="2">'+val.conta_wt+'</td>';
						html	+= '</tr>';
					});
					html +='<tr>';
					html += '<td colspan="7">集装箱数量:'+i+'</td>';
					html +='</tr>';
				}else{
					var message	= json.message;
					if(null != json.error){
						$.each(json.error,function(key,val){
							message	+= val+'<br/>';
						})
					}
					alertTip(message);
					return false;
				}
				$("#contaAjaxResult").html(html);
			}
		});
	}
	return false;
});

</script><?php }} ?>