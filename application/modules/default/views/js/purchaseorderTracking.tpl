$(function(){

	$('.ordercheckAll').die('click').live('click',function(){
		if($(this).is(':checked')) {
			$(".orderArr").attr('checked', true);
		} else {
			$(".orderArr").attr('checked', false);
		}
		 changeTrColor();
	});
	
});

	/*伴随全选按钮是否选中而变色*/
	function changeTrColor(){
	
	
		$(".orderArr").each(function(){
				_this = $(this);
				if($('.ordercheckAll').is(':checked')){			
					set_tr_class(_this.parent().parent(), true);			
				}else{			
					set_tr_class(_this.parent().parent(), false);		
				}					
						
		});	
		
e		
	}		

function closePurchaseOrderTrackingBody(po_tb_id,is_force){
    po_tb_id = po_tb_id||'';
	is_force = is_force||'0';
    if(po_tb_id==''){
        alertTip("<{t}>pleaseOne<{/t}>",'500','auto','1');
        return;
    }
	closePurchaseOrderTrackingBodyAction(po_tb_id,is_force);	
}

function closePurchaseOrderTrackingBodyAction(po_tb_id,is_force){
	po_tb_id = po_tb_id||'';	
	is_force = is_force||'0';	
	
	
    if(po_tb_id==''){
		if(is_force=='1'){
			alertTip("<{t}>pleaseOne<{/t}>",'500','auto','1');
		}else{
			alertTip("<{t}>pleaseOne<{/t}>",'500','auto','0');
			
		}
        
        return;
    }
	if(is_force=='1'){
		$(global_alertTip).dialog('close');	
			
	}
	
	
    $.ajax({
        type:"post",
        async:false,
        dataType:"json",
        url:"/merchant/purchase-order/close-purchase-order-tracking-body",
        data:{po_tb_id:po_tb_id,is_force:is_force},
        success:function (json) {
            var html = "<strong>"+json.message+"</strong>";			 	
            if(json.ask=='1'){
                alertTipclose(html);
            }else{  
			
			    if(json.is_overpass_error=='1'){
					html+= '<br/><br/><a  class=\"button\" href=\"\" onclick=\"closePurchaseOrderTrackingBody('+po_tb_id+',\'1\');return false;\">强制转为已审核</a>';
				}             
                alertTip(html);
            }
            
        }
    });
}

function alertTipclose(tip,width,height,notflash){
    width = width?width:500;
    height = height?height:'auto';
    $('<div title="信息提示(Tips)"><p align="">' + tip + '</p></div>').dialog({
        autoOpen: true,
        width: width,
        height: height,
        modal: true,
        show:"slide",
        buttons: {
        '关闭(Close)': function() {
        $(this).dialog('close');
        if(!(typeof(notflash)!="undefined" && notflash=='1')){
            $('#pagerForm').submit();
        }
        }
        },
        close: function() {
            //$('#searchorderForm').submit();
            $('#pagerForm').submit();
        }
    });
}