<?php /* Smarty version Smarty-3.1.13, created on 2016-03-02 18:59:07
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\logistic\views\loadingOrder\create.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1828456d6c77b5cf183-72844268%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6aa4aeb427c70f6d232b4292aba11126d4f52f9b' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\logistic\\views\\loadingOrder\\create.tpl',
      1 => 1455677486,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1828456d6c77b5cf183-72844268',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'iePorts' => 0,
    'item' => 0,
    'formtypes' => 0,
    'formtype' => 0,
    'customer' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56d6c77b69e1b3_16331391',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56d6c77b69e1b3_16331391')) {function content_56d6c77b69e1b3_16331391($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include 'D:\\www\\tianjin_1\\oms\\branches\\main\\libs\\Smarty\\plugins\\block.t.php';
?><style type="text/css">
    .box td{
        text-align: left;
    }
    #ASNForm tbody th{
        text-align: right;
        height: 20px;
        line-height: 20px;
        padding:5px;

    }
    #ASNForm tbody td{
        text-align: left;
        height: 20px;
        line-height: 20px;
        padding:5px;
    }
    *#ASNForm tbody span.error{
        top:auto;
    }
    span.error{
        top:auto;
    }
    a.dialog_link {
        margin-bottom: 5px;
        margin-top: 5px;
        padding: 10px;
        text-align: center;
       
        float:left;
    }
    .asndetailstrong {
        color: #FF0000;
        display: block;
        float: left;
        margin-right: 20px;
        margin-top: 15px;
    }
    #subProducts .textInput{
        float:none;;
    }
</style>


<div class="content-box ui-tabs ui-widget ui-widget-content ui-corner-all asncontent" style="display:block;"> 
<div class="content-box-header">
    <h3 style="margin-left:5px">载货单新增</h3>
    <div class="clear"></div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("logistic/views/loadingOrder/import-person-item.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div class="clear"></div>
<form  action="/logistic/loading-order/create" method="post"  id='ASNForm' name="createForm" >
    <div id="create-asn-center" >
        <table class="pageFormContent">
            <tbody>
            <tr class="ReferenceCode">
				<td  class="nowarp text_right">车牌号：</td>
                <td>
                   <input name="car_no" class="text-input width155 " id="car_no">&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
                <td  class="nowarp text_right">进出口：</td>
                <td>
                    <select name="ie_type" class="required width155" id="ie_type">
                        <option value="">-Select-</option>
                        <option value="I">进口</option>
                        <option value="E">出口</option>
                    </select>&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
                <td  class="nowarp text_right">申报口岸：</td>
                <td>
                    <select name="decl_port" class="required width155" id="decl_port">
                        <option value="">-Select-</option>
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['iePorts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
						 <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['ie_port'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['ie_port_name'];?>
</option>
						<?php } ?>
                    </select>&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
				<td  class="nowarp text_right">进出口岸：</td>
                <td>
                   <select name="ie_port" class="required width155" id="ie_port">
                        <option value="">-Select-</option>
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['iePorts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
						 <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['ie_port'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['ie_port_name'];?>
</option>
						<?php } ?>
                    </select>&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
				<td  class="nowarp text_right">业务类型：</td>
                <td>
                   <select name="form_type" class="required width155">
					<option value="">-Select-</option>
					<!--
					<?php  $_smarty_tpl->tpl_vars['formtype'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['formtype']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['formtypes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['formtype']->key => $_smarty_tpl->tpl_vars['formtype']->value){
$_smarty_tpl->tpl_vars['formtype']->_loop = true;
?>
						<?php if ($_smarty_tpl->tpl_vars['formtype']->value['form_type']=='I1A'||$_smarty_tpl->tpl_vars['formtype']->value['form_type']=='I2A'){?>
							<option value="<?php echo $_smarty_tpl->tpl_vars['formtype']->value['form_type'];?>
"><?php echo $_smarty_tpl->tpl_vars['formtype']->value['form_type_name'];?>
</option>
						<?php }?>
					<?php } ?>
					-->
					<option value="I2A">保税进口-二线出区</option>
				   </select>&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
				<td  class="nowarp text_right">载货单企业内部编号：</td>
                <td>
                   <input name="ref_loader_no" class="text-input width155 " id="ref_loader_no">&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
                <td  class="nowarp text_right">总件数：</td>
                <td>
                    <input name="pack_no" class="text-input width155 " id="pack_no">&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
				<td  class="nowarp text_right">总重量：</td>
                <td>
                   <input name="total_wt" class="text-input width155 " id="total_wt">KG&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
                <td  class="nowarp text_right">车自重 ：</td>
                <td>
                    <input name="car_wt" class="text-input width155 " id="car_wt">KG&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
				<td  class="nowarp text_right">单证总数：</td>
                <td>
                   <input name="form_num" class="text-input width155 " id="form_num">&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
				<td  class="nowarp text_right">申报单位代码：</td>
                <td>
                   <input name="agent_code" class="text-input width155" value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['code'];?>
" id="agent_code" >&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
				<td  class="nowarp text_right">申报单位名称：</td>
                <td>
                   <input name="agent_name" class="text-input width155 " value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['company'];?>
" id="agent_name" >&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
				<td  class="nowarp text_right">经营单位代码：</td>
                <td>
                   <input name="trade_code" class="text-input width155" value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['code'];?>
" id="trade_code" >&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
				<td  class="nowarp text_right">经营单位名称：</td>
                <td>
                   <input name="trade_name" class="text-input width155 " value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['company'];?>
" id="trade_name" >&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
				<td  class="nowarp text_right">仓储企业单位代码：</td>
                <td>
                   <input name="wh_code" class="text-input width155" value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['code'];?>
" id="wh_code" >&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
				<td  class="nowarp text_right">仓储企业单位名称：</td>
                <td>
                   <input name="wh_name" class="text-input width155 " value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['company'];?>
" id="wh_name" >&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
				<td  class="nowarp text_right">收发货人代码：</td>
                <td>
                   <input name="owner_code" class="text-input width155" value="" id="owner_code" >&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
			<tr class="ReferenceCode">
				<td  class="nowarp text_right">收发货人名称：</td>
                <td>
                   <input name="owner_name" class="text-input width155 " value="" id="owner_name" >&nbsp;<strong class="red">*</strong>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><a  href="#" class="button tijiao" id='asnbutton'  onclick="dosubmit();return false;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
submit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
                </td>
            </tr>

            </tbody>
        </table>

    </div>

</form>
</div>
<div class="infoTips" id="messageTip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
InformationTips<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
">
</div>
<script type="text/javascript">
function dosubmit(){
	var options = {
	url:'/logistic/loading-order/create',
	type:'POST',
	dataType:'json',
	success: function(data){
		var html ="";						
		if(data.ask==1){						
			$( "#messageTip").dialog({
				autoOpen: false,
				position:[50,50],
				close: function(event, ui) {locationToList();}
			});
			$('<div title="提示(Tip)">'+data.message+'</div>').dialog({
				autoOpen: true,
				close: function(event, ui) {locationToList();},
				width: '320',
				position:[50,50],
				height: 'auto',
				modal: true,
				buttons: {
					'关闭(close)': function () {
						locationToList();
					}
				}
			});
			$("#messageTip").html(html);
		}else{
			$("#messageTip").html('');
			if (typeof(data.message) != "undefined"){
				html+=data.message+"<br/>";
			}
			$.each(data.error,function(idx,vitem){
				html+=vitem+"<br/>";
			});
			$("#messageTip").html(html);
			$('#messageTip').dialog('open');
		}				
	}};
	$("#ASNForm").ajaxSubmit(options); 
	return false;
} 
function locationToList(){
   var url = "/logistic/loading-order/list";
   parent.openMenuTab(url,"载货单列表",'载货单列表','1');
}
$('#messageTip').dialog({
	autoOpen: false,
	modal: false,
	bgiframe:true,
	position:[50,50],
	width: 400,
	position:[50,50],
	resizable: true			
});
</script><?php }} ?>