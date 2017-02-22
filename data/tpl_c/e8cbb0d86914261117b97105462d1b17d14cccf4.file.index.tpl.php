<?php /* Smarty version Smarty-3.1.13, created on 2014-07-11 16:21:28
         compiled from "/home/apache/www/import/oms/application/modules/merchant/views/timeeffectivetable/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:177946487453bf9e881aab22-16535451%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e8cbb0d86914261117b97105462d1b17d14cccf4' => 
    array (
      0 => '/home/apache/www/import/oms/application/modules/merchant/views/timeeffectivetable/index.tpl',
      1 => 1398312445,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '177946487453bf9e881aab22-16535451',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_53bf9e882106f7_19069602',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53bf9e882106f7_19069602')) {function content_53bf9e882106f7_19069602($_smarty_tpl) {?><?php if (!is_callable('smarty_block_t')) include '/home/apache/www/import/oms/libs/Smarty/plugins/block.t.php';
?><div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
export_time_effectiveness_table<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</h3>        
    </div>   

	

	<div class="pageHeader">
    <form action="/merchant/export-effectiveness-table/export" method="post" id="pagerForm">       
        <div class="searchBar">
            <table>
                <tr>
      
					<td style="text-align:right;color:#000">
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
date<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
                    </td>
                    <td style="text-align: left;">
                        <input type="text" value=""  readonly="readonly" name="time_start" id="time_start" class="text-input width140 "/>
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

						<input type="text" value=""  readonly="readonly" name="time_end"  id="time_end" class="text-input width140 "/>
                    </td>				
					<td style="text-align:right;color:#000">
					<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
the<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
type<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
：
					</td>
                    <td style=" text-align:left">
                        <select class="text-input width155" name="stype_s" id="stype_s">
                            <option value="0"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
pleaseSelected<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
							
                            <option value="1"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
StockingASN<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
							<option value="2"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
StockingOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
							<option value="3"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
CollectionOrder<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</option>
                        	
						</select>
							
						
						 
                    </td>
					<td style=" text-align:left">
						
				     <a type="button" class="button" id="export"><?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
export<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a>	
						
                    </td>
                </tr>
            </table>
            
        </div>
    </form>
</div>

</div>
<script>
	function exportdata(){
			
			var stype = $("[name='stype_s']").val();
			if(stype!='1' && stype!='2' &&  stype!='3'){			
			 	alert("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_select_export_type<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
");
				return;
			}
			
			var time_start = $("[name='time_start']").val();
			if(time_start==''){
			 	alert("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_select_start_time<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
");	
				return;		
			}			
			var time_end = $("[name='time_end']").val();
			if(time_end==''){
			 	alert("<?php $_smarty_tpl->smarty->_tag_stack[] = array('t', array()); $_block_repeat=true; echo smarty_block_t(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
please_select_end_time<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_t(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
");	
				return;		
			}
			
			$('#pagerForm').submit();
			
	
	}
	
	
	
	
	function getTimeByDateStr(dateStr){  
		var year = parseInt(dateStr.substring(0,4));  
		var month = parseInt(dateStr.substring(5,7),10)-1;  
		var day = parseInt(dateStr.substring(8,10),10);  
		return new Date(year, month, day).getTime();  
	}  	
	
	$(document).ready(function(){
		$('#export').click(function(){ exportdata(); });
		
			
		 var dates = $("#time_start,#time_end");
		 $.datepicker.setDefaults({ showButtonPanel: true, closeText: '清除', beforeShow: function (input, inst) { datepicker_CurrentInput = input; } });  
		 dates.datepicker({ 
		 	dateFormat: "yy-mm-dd",			
			showButtonPanel:true,
			'onSelect':function(selectedDate){
		 		
				if(this.id == 'time_start'){
					option = "minDate"; //最小时间  
					var selectedTime = getTimeByDateStr(selectedDate);  
					var minTime = selectedTime;  				
					targetDate = new Date(minTime);					 
					optionEnd = "maxDate";  				
					targetDateEnd = new Date(minTime+6*24*60*60*1000);
				}
				if(this.id == 'time_end'){ 
					option = "maxDate"; //最大时间  
					var selectedTime = getTimeByDateStr(selectedDate);  
					var maxTime = selectedTime;  
					targetDate = new Date(maxTime);					 
					optionEnd = "minDate";  
					targetDateEnd = new Date(maxTime-6*24*60*60*1000);				
				}
				  dates.not(this).datepicker("option", option, targetDate);    
				  dates.not(this).datepicker("option", optionEnd, targetDateEnd); 
				   	
				
		 	}
		});
		
		  $(".ui-datepicker-close").live("click", function (){
                dates.val('');
				dates.datepicker("option", 'minDate',null);
				dates.datepicker("option", 'maxDate',null);
          });	
		 
		  //$('#expDate').datepicker('option', 'minDate', new Date(arys[0],arys[1]-1,arys[2]));
		
	});
	
	
</script><?php }} ?>