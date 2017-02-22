<?php /* Smarty version Smarty-3.1.13, created on 2014-07-10 10:17:01
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/purchaseOrder/purchase-order-create.tpl" */ ?>
<?php /*%%SmartyHeaderCode:22071926553bde7b9c4b8f2-91749856%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0bec848fdfa61cbf86cf724038ca1de2bb20efcc' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/purchaseOrder/purchase-order-create.tpl',
      1 => 1404958602,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22071926553bde7b9c4b8f2-91749856',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53bde7b9d0c2b2_76329062',
  'variables' => 
  array (
    'actions' => 0,
    'receiving_code' => 0,
    'receivingDetail' => 0,
    'receiving' => 0,
    'actionLabel' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53bde7b9d0c2b2_76329062')) {function content_53bde7b9d0c2b2_76329062($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><style>
	
    #ASNForm tbody td{       
        height: 20px;
        line-height: 20px;
        padding:5px;
    }
    #ASNForm tbody th{       
        text-align:center;
    }	
	
    #subProducts .textInput{
        float:none;;
    }
</style>


<style type="text/css">
    .buttonheight{
        height: 35px;
    }
</style>

<div class="content-box ui-tabs ui-widget ui-widget-content ui-corner-all">
 	<div class="content-box-header">
        <h3 style="margin-left:5px"><?php echo $_smarty_tpl->tpl_vars['actions']->value;?>
</h3>
        <div class="clear"></div>
    </div>
	<table class="left">
		<tr>
		<td style="width:60px">
			<a href="#" id="dialog_link" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ProductInfo<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" class="dialog_link ui-state-default  ui-corner-all" ><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SelectProduct<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
		</td>
		<td><strong class="red">*</strong></td>
		<td>
		<!--
		<a href="#" id="selectasndetail" class="dialog_link ui-state-default  ui-corner-all" style="width:80px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
BulkUploadProducts<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
		!-->
		</td>		
		</tr>
	</table>



<form   action="/merchant/purchase-order/purchase-Order-Save" method="post"  id='ASNForm' name="createForm" >
    <div id="create-asn-center" >

        <table cellspacing="0" cellpadding="0" class="formtable tableborder">
            <thead>
            <tr>
                <th width='100'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
skuCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<input type="hidden" name="ASNCode" value="<?php echo $_smarty_tpl->tpl_vars['receiving_code']->value;?>
"  /></td>
                <th width='200'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pname<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
                <th width='70'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
purchase_order_quantity<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>                
                <th width='70'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
operate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
            </tr>
            </thead>
            <tbody id='asnproducts'>
            <?php if ($_smarty_tpl->tpl_vars['receivingDetail']->value!=''){?>
           
			<?php }else{ ?>
 				<tr class="norowdata">
            		<td colspan="7" style="text-align:center;"><b>未选择产品</b></td>
            	</tr>				
            <?php }?>
            </tbody>
	
           	
        </table>
        <div class="clear"></div>
        <input type="hidden" name="ASNCode" value="<?php echo $_smarty_tpl->tpl_vars['receiving_code']->value;?>
" />
        <table class="pageFormContent" border="0">
            <tbody>
         
          
            <tr class="ReferenceCode">
                <td  class="form_title"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
purchase_order_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td class="form_input"><input type="text" size="60" class="text-input fix-medium1-input " value="<?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['po_code']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['po_code'];?>
<?php }?>" name="po_code" id="po_code"> <strong class="red">*</strong><span></span></td>
            </tr>

            <tr>
                <td class="form_title"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
supplier_code<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td class="form_input">
				<input type="text" size="60" class="text-input fix-medium1-input " value="" name="supply_code" id="supply_code" readonly="readonly" /> <strong class="red">*</strong>  
                </td>
            </tr>
            
 
            <tr>
                <td class="form_title">&nbsp;</td>
                <td class="form_input">
					<a href="#"   id="select_supply_code" class="dialog_link ui-state-default dialog_link ui-corner-all" style="width:100px"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
select_supply<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>
                </td>
            </tr>          
		  
		  

            <tr>
                <td  class="form_title"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
remark<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：</td>
                <td   class="form_input"><textarea rows="2"  id="po_description" name="po_description"><?php if (isset($_smarty_tpl->tpl_vars['receiving']->value)&&$_smarty_tpl->tpl_vars['receiving']->value['po_description']){?><?php echo $_smarty_tpl->tpl_vars['receiving']->value['po_description'];?>
<?php }?></textarea></td>
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


    <div id="asndetailDialog" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
import_by_xls<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" style="display:none">
        <form action="/merchant/product/batch-input" method="post" id="asndetailForm">
            <table>
                <tr><th><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
export_xls<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:</th>
                    <td><input type="file" name="XMLForInput" />
                    </td></tr>
                <tr>
                    <th></th>
                    <td>
                        <p><img style="width:25px;" src="/images/download.png"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
download_templete<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
:<a href="/merchant/product/select-product-templete" style="text-decoration:underline;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
product_template<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a></p>
                        
                    </td>
                </tr>
            </table>

            <table cellspacing="0" cellpadding="0" class="formtable tableborder">
                <thead>
                <tr>
                    <th width='200'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
skuCode<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                    <th width='70'><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
operate<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
                </tr>
                <!--
                <tr>
                    <td colspan="10"   style="text-align:center"><strong  style="color:red">请选择产品</strong></td>
                </tr>
                -->
                </thead>
                <tbody id='batchAddTips'>

                </tbody>
				
				
				
				
            </table>

            <!--<div id="batchAddTips"></div>-->
        </form>
    </div>

</div>

<div id="dialog" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
SelectProduct<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
">
</div>
<div id="supply_dialog" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
select_supply<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
"> </div>
<div class="infoTips" id="messageTip" title="<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
InformationTips<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
">
			
</div>

<script type="text/javascript">
	var actionLabel='<?php echo $_smarty_tpl->tpl_vars['actionLabel']->value;?>
';
    function chval() {
        var errmsg = "";
        var pattern = /^\d+$/;
        $("input[name^='sku[']","#ASNForm").each(function (k, v) {
            var this_val = $(this).val();
            if (this_val == '' || this_val == '0' || !pattern.test(this_val)) {
                errmsg += '<span style="width:100%;float:left;"><img src=\"/images/no.gif\">Line ' + (k + 1) + ' ,Receive Qty Must be numeric.</span>';
            }
        });

        if (errmsg != '') {
            alertTip(errmsg);
            return false;
        }
        return true;
    }
  

    $(function () {
        //弹出产品对话框添加产品
        $(".asnactionSku").live("click", function () {
           	 var productId = $(this).attr("productId");
             var productSku = $(this).attr("productSku");
             var productName = $(this).attr("productName");        
            
            
        	if ($(this).is(':checked')){
    			if($("#asnproduct"+productId).size()==0){
    				if ($("#asnproduct" + productId).size() == 0) {
    	                var html = '';
    	                html += '<tr id="asnproduct' + productId + '" class="product_sku">';
    	                html += '<td><a  onclick="parent.openMenuTab(\'/merchant/product/detail/productId/'+productId+'\',\'产品详情('+productSku+')\',\'productdetail'+productId+'\');return false;" href="/merchant/product/detail/productId/'+productId+'" target="_blank">' + productSku + '</a><input type="hidden" name="product_sku[' + productId + ']" value="' + productSku + '"></td>';
    	                html += '<td title="'+productName+'">' + productName + '</td>';

                        html += '<td><input type="text" class="inputbox inputMinbox" name="sku[' + productId + ']"  value="1" size="6">&nbsp;<strong>*</strong></td>';                        
						html += '<td><a class="productDel" href="javascript:;" title="delete"><img src="/images/icon_del.gif"></a></td>';
    	                html += '</tr>';
    	                $("#asnproducts").append(html);
    	            }
    			}
        	}else{
    			if($("#asnproduct"+productId).size()>0){
    				$("#asnproduct"+productId).remove();
					if(typeof(keepTheInterface)!='undefined'){keepTheInterface();}
					
					 
    			}
    		}			
			if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}
			
        });

        $(".productDel").live("click", function () {
            $(this).parent().parent().remove();			
			if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}
			
        });
       
      
    });

	// 产品浏览的对话框			
	$('#dialog').dialog({
			autoOpen: false,
			modal: false,
			bgiframe:true,
			position:['center','top'],
			width: 750,	
			height:'auto',
			draggable:true,			
			resizable: true			
	});		
				
		//产品浏览
	$('#dialog_link').click(function(){	
			getProductListBoxData('asn');
			$('#dialog').dialog('open');
			return false;
	});
		
  

    /*表单提交*/
	function dosubmit(){
				var options = {
				url:'/merchant/purchase-order/purchase-Order-Save', //提交给哪个执行
				type:'POST',
				dataType:'json',
				success: function(data){
					var html ="";						
					if(data.ask==1){
						html += data.msg+'</br></br>';
						$("#messageTip").html(html);
						$( "#messageTip" ).dialog({
								autoOpen: false,
   								close: function(event, ui) {locationToList();} 
						});																	
					}else{
						$( "#messageTip" ).dialog({
   								close: null,
								autoOpen: false 
						});										
						$("#messageTip").html('');
						if (typeof(data.message) != "undefined")
						{
    						html+=data.message+"<br/>";
						}
						 				
						$.each(data.error,function(idx,vitem){
						 html+=vitem+"<br/>";
						});
						$("#messageTip").html(html);
					}
					$('#messageTip').dialog('open');
				
				}}; //显示操作提示

				$("#ASNForm").ajaxSubmit(options); 
				
				return false;
	
		    
}  //end of function



</script>	

<script>

$('#messageTip').dialog({
			autoOpen: false,
			modal: false,
			bgiframe:true,
			width: 400,
			position:[50,50],
			resizable: true,
			//close:function(){locationToList();},
			buttons: {
        		'关闭': function() {
            		$('#messageTip').dialog('close');
        	}}
			
});
function locationToList(){	
	//location.href="/merchant/receiving/listbh";
	parent.openMenuTab('/merchant/purchase-order/purchase-order-list','<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
purchase_order_list<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
','purchase-order-list','1');//
}

function getRipOfNodataRow(){
	 var dataRows = $("#asnproducts tr:not(.norowdata)").size();
	 if(dataRows>0){
	   $('.norowdata').remove();
	 }else{
	 	$('.norowdata').remove();
	 	var html='<tr class="norowdata">\n';
            html+='<td colspan="7" style="text-align:center;"><b>未选择产品</b></td></tr>';
			$("#asnproducts").append(html);			
	 }
}


 	

$(function(){
      $('#selectasndetail').click(function(){
            //$('#dialog').html();
            $("#batchAddTips").html('');
            $('[name=XMLForInput]').val('');
            $('#asndetailDialog').dialog('open');
           // $('#startUploadXLS').click(function(){
            //});
            return false;
        });		
		
		
	$('#asndetailDialog').dialog({
            autoOpen: false,
            modal: false,
			position:[50,50],
            bgiframe:true,
            width: 900,
            resizable: true,
            buttons: {
                '确定': function() {
                    var pFile=$('[name=XMLForInput]').val();
                    var postfix = pFile.substr(pFile.length-3,3).toLowerCase();
                    if(pFile==""){
                        $("#batchAddTips").html("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
FileCanNotBeEmptyPleaseSelectCorrectFile<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
");
                    }else if(postfix!='xls' && postfix!='csv' ){
                        $("#batchAddTips").html("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
OnlySupportXlsCsvDocument<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
");
                        return false;
                    }else{
                        $('#asndetailForm').ajaxSubmit({
                            target:'#output1',
                            dataType:'json',
                            success:function(json){
                                if(json.ask==1){
                                    //$(json.data).each(function(k,row){
                                        // insertProductRow(row.product_id,row.product_sku,row.product_title,row.pc_name,row.product_weight,row.product_number);

                                    //});
                                    insertProductRow(json);															
								
                                }else{
                                    $("#batchAddTips").html(json.message);
                                }
                            }
                        });
                        //$(this).dialog('close');
                    }
                }  ,
                '关闭': function() {
                    $(this).dialog('close');
                }
            },
            close: function() {

            }
        });//$('#asndetailDialog').dialog({		

});	




//批量插入产品
function insertProductRow(json){
   var product_number =  1;
    var errorHtml = '';
    $(json.data).each(function(k,row){
        var html = '';
        // insertProductRow(row.product_id,row.product_sku,row.product_title,row.pc_name,row.product_weight,row.product_number);
        if(row.is_valid=='1'){
            var productId = row.product_id;
            var productSku = row.product_sku;
            var productName = row.product_title;
            var category = row.pc_name;
            var number = row.product_number;
			var productWeight = row.product_weight;
			var productDeclare = row.product_declared_value;


            //var productWeight
            if($("#asnproduct"+productId).size()==0){
				html += '<tr id="asnproduct' + productId + '" class="product_sku">';
				html += '<td><a  onclick="parent.openMenuTab(\'/merchant/product/detail/productId/'+productId+'\',\'产品详情('+productSku+')\',\'productdetail'+productId+'\');return false;" href="/merchant/product/detail/productId/'+productId+'" target="_blank">' + productSku + '</a><input type="hidden" name="product_sku[' + productId + ']" value="' + productSku + '"></td>';
				html += '<td title="'+productName+'">' + productName + '</td>';

				html += '<td><input type="text" class="inputbox inputMinbox" name="sku[' + productId + ']" onkeyup="changeWeight('+productId+','+productWeight+',this.value)" value="'+number+'" size="6">&nbsp;<strong>*</strong></td>';
				html += '<td><input type="text" class="inputbox inputMinbox" name="declared_value[' + productId + ']" onkeyup="changeDeclare('+productId+','+'this.value)" value="'+productDeclare+'" size="6"></td>';
				html += '<td id="declare'+productId+'">'+Math.round(number*productDeclare*1000)/1000+'</td>';
				html += '<td id="sku'+productId+'">'+Math.round(number*productWeight*1000)/1000+'</td>'; 
				html += '<td><a class="productDel" href="javascript:;" title="delete"><img src="/images/icon_del.gif"></a></td>';
				html += '</tr>';
                $("#asnproducts").append(html);
				
            }
        }else{
            var error = row.errordata;
            if(error){
                $(error).each(function(ek,ed){
                    errorHtml+='<tr>';
                    errorHtml+='<td>'+ed.product_sku+'</td>';
                    errorHtml+='<td>'+ed.error+'</td>';
                    errorHtml+='</tr>';
                });
            }
            //errorHtm+=
        }
    });		

	if(typeof(getRipOfNodataRow)!='undefined'){getRipOfNodataRow();}
	 
    if(json.errordata){
        //var error = row.errordata;
        /*if(error){

        }*/
        $(json.errordata).each(function(ek,ed){
            errorHtml+='<tr>';
            errorHtml+='<td>'+ed.product_sku+'</td>';
            errorHtml+='<td>'+ed.error+'</td>';
            errorHtml+='</tr>';
        });
    }  
    $('#batchAddTips').html(errorHtml);
}

</script>


<script>


		function getPurchaseOrderData(page,pageSize,s_supplier_code,s_supplier_name,selected_supply_code){		   
	
			var page = page||1;
			var pageSize = pageSize||20;
			var supplier_code = s_supplier_code||'';
			var supplier_name = s_supplier_name||'';
			var selected_supply_code = selected_supply_code||'';
			$.post('/merchant/purchase-order/supplycode-auxiliary-input',{page:page,pageSize:pageSize,supplier_code:supplier_code,supplier_name:supplier_name,selected_supply_code:selected_supply_code},function(result){$("#supply_dialog").html(result);});
		
        }
 		var selected_supplier_code = '';
		$(function(){
					
					$('#supply_dialog').dialog({	
						autoOpen: false,
						modal: false,
						bgiframe:true,
						minWidth:850,
						position:['center','top'],
						width: 850,	
						height:'auto',
						draggable:true,			
						resizable: true			
					});
		
					$('#select_supply_code').click(function(){			
							$('#supply_dialog').dialog('open');					
							return false;
					});
					
								
					/*选择供应商的时候*/
					$(".productactionSku").live("click", function(){
								   
						var supply_code = $(this).attr("supply_code");
						selected_supplier_code = supply_code;
						$("input[name='supply_code']").val(supply_code);
						$('#supply_dialog').dialog('close');						
						
						if(typeof(keepTheInterface)!='underfined'){keepTheInterface();}
					
					});	
					var selected_supplier_code = $("input[name='supply_code']").val();
					getPurchaseOrderData(1,20,'','',selected_supplier_code);							
					
					
		});			 

</script>
<?php }} ?>