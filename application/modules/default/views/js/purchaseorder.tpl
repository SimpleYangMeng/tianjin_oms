$(function(){
    $('.statusBtn').bind('click',function(){
        var status = $(this).attr('ref');
		$('.status').size();	
        $('.status').val(status);
        $('.statusBtn').removeClass('btn-active');
        $(this).addClass('btn-active');
		$('#pagerForm #page').val(1);
        $('#pagerForm').submit();
    });
    $(".order_product").hide();
    $(".foldToggle").click(function(){
        var v = $(this).attr("value");
        if(v=="1"){
            $(".order_product").hide();
            $(this).attr("value","0");
            $(".order_product").each(function(){
               $(this).attr("status","0");
            });
        }else{
            $(".order_product").show();
            $(this).attr("value","1");
            $(".order_product").each(function(){
                $(this).attr("status","1");
            });
        }
    })
    //处理订单
    $('.ordercheckAll').die('click').live('click',function(){
        if($(this).is(':checked')) {
            $(".orderArr").attr('checked', true);
        } else {
            $(".orderArr").attr('checked', false);
        }
		 changeTrColor();
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
		
		
	}		

    

});



function showProduct(ordersCode){
    var status = $("#"+ordersCode).attr("status");
    if(status=="1"){
        $("#"+ordersCode).attr("status","0");
        $("#"+ordersCode).hide();
    }else{
        $("#"+ordersCode).attr("status","1");
        $("#"+ordersCode).show();
    }
}


function closePurchaseOrderBody(pobd_id){
    pobd_id = pobd_id||'';
	
    if(pobd_id==''){
        alertTip("<{t}>pleaseOne<{/t}>",'500','auto','1');
        return;
    }

	$('<div title="信息提示(Tips)"><p align=""><{t}>AreYouSureToDeleteSelected<{/t}></p></div>').dialog({
			autoOpen: true,
			width: 300,
			height: 'auto',
			modal: true,
			show:"slide",
			position:[200,'middle'],
			buttons: {
				'<{t}>cancel<{/t}>':function(){
					$(this).dialog("close");
					return;
				},
				'<{t}>Determine<{/t}>': function() {
					$(this).dialog("close");
					closePurchaseOrderBodyAction(pobd_id);
				}
			},
			close: function() {
					return;
			}
		});
}

function closePurchaseOrderBodyAction(pobd_id){
	pobd_id = pobd_id||'';	
    if(pobd_id==''){
        alertTip("<{t}>pleaseOne<{/t}>",'500','auto','1');
        return;
    }
   
    $.ajax({
        type:"post",
        async:false,
        dataType:"json",
        url:"/merchant/purchase-order/close-purchase-orderbody",
        data:{pobd_id:pobd_id},
        success:function (json) {
            var html = "<strong>"+json.message+"</strong>";			 	
            if(json.ask=='1'){
                alertTipclose(html);
            }else{               
                alertTip(html);
            }
            
        }
    });
}





function closePurchaseOrder(po_id){
    po_id = po_id||'';
	
    if(po_id==''){
        alertTip("<{t}>pleaseOne<{/t}>",'500','auto','1');
        return;
    }

	$('<div title="信息提示(Tips)"><p align=""><{t}>AreYouSureToDeleteSelected<{/t}></p></div>').dialog({
			autoOpen: true,
			width: 300,
			height: 'auto',
			modal: true,
			show:"slide",
			position:[200,'middle'],
			buttons: {
				'<{t}>cancel<{/t}>':function(){
					$(this).dialog("close");
					return;
				},
				'<{t}>Determine<{/t}>': function() {
					$(this).dialog("close");
					closePurchaseOrderAction(po_id);
				}
			},
			close: function() {
					return;
			}
		});
}

function closePurchaseOrderAction(po_id){
    
	po_id = po_id||'';	
    if(po_id==''){
        alertTip("<{t}>pleaseOne<{/t}>",'500','auto','1');
        return;
    }
   
    $.ajax({
        type:"post",
        async:false,
        dataType:"json",
        url:"/merchant/purchase-order/close-purchase-order",
        data:{po_id:po_id},
        success:function (json) {
            var html = "<strong>"+json.message+"</strong>";			 	
            if(json.ask=='1'){
                alertTipclose(html);
            }else{               
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