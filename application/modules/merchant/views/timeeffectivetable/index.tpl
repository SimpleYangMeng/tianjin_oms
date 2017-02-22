<div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <h3  class="clearborder" style="margin-left:5px;"><{t}>export_time_effectiveness_table<{/t}></h3>        
    </div>   

	

	<div class="pageHeader">
    <form action="/merchant/export-effectiveness-table/export" method="post" id="pagerForm">       
        <div class="searchBar">
            <table>
                <tr>
      
					<td style="text-align:right;color:#000">
                        <{t}>date<{/t}>：
                    </td>
                    <td style="text-align: left;">
                        <input type="text" value=""  readonly="readonly" name="time_start" id="time_start" class="text-input width140 "/>
                        <{t}>To<{/t}>
						<input type="text" value=""  readonly="readonly" name="time_end"  id="time_end" class="text-input width140 "/>
                    </td>				
					<td style="text-align:right;color:#000">
					<{t}>the<{/t}><{t}>type<{/t}>：
					</td>
                    <td style=" text-align:left">
                        <select class="text-input width155" name="stype_s" id="stype_s">
                            <option value="0"><{t}>pleaseSelected<{/t}></option>
							
                            <option value="1"><{t}>StockingASN<{/t}></option>
							<option value="2"><{t}>StockingOrder<{/t}></option>
							<option value="3"><{t}>CollectionOrder<{/t}></option>
                        	
						</select>
							
						
						 
                    </td>
					<td style=" text-align:left">
						
				     <a type="button" class="button" id="export"><{t}>export<{/t}></a>	
						
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
			 	alert("<{t}>please_select_export_type<{/t}>");
				return;
			}
			
			var time_start = $("[name='time_start']").val();
			if(time_start==''){
			 	alert("<{t}>please_select_start_time<{/t}>");	
				return;		
			}			
			var time_end = $("[name='time_end']").val();
			if(time_end==''){
			 	alert("<{t}>please_select_end_time<{/t}>");	
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
	
	
</script>