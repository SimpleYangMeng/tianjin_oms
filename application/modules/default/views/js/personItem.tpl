$(function(){
    $('.statusBtn').bind('click',function(){
        var status = $(this).attr('ref');
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
        if ($(this).is(':checked')) {
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

    $('#batchSubmit').die().bind('click',function(){
        if($('#batchSelect').val()==''){
            alertTip('<{t}>PleaseSelectOperating<{/t}>','500','auto','1');
        }else{
            switch($('#batchSelect').val()){
                case "submitOrder":
                    submitOrder();
                    break;
                case "bacthConfirm":
                    bacthConfirm();
                    break;
                case "bacthDelete":
                    bacthDelete();
                    break;
                case 'movedraft':
                    movedraft();
                    break;
                case 'deleteToDraft':
                    deleteToDraft();
                    break;
                default:
                    alertTip('<{t}>InvalidParameter<{/t}>','500','auto','1');
            }
        }
    })

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

//set_tr_class($(this).parent().parent(), true);

/*批量确认*/
function bacthConfirm(){
    var checkedSizesize = $('.orderArr:checked').size();
    if(checkedSizesize<=0){
        alertTip("<{t}>PleaseSelectAtLeastOneOrder<{/t}>",'500','auto','1');
        return;
    }
    var param = $("#orderDataForm").serialize();
    $.ajax({
        type:"post",
        async:false,
        dataType:"json",
        url:"/merchant/order/confirm",
        data:param,
        success:function (json) {
            var html = ""+json.message+"";
            if(json.ask=='1'){
                alertTipclose(html);
            }else{
                if(json.error){
                    html+=":<br/>";
                    $.each(json.error,function(k,v){
                        html+=""+v+"<br/>";
                    });
                }
                alertTip(html);
            }
            $('#searchorderForm').submit();
        }
    });
}
function submitOrder(){
    var checkedSizesize = $('.orderArr:checked').size();
    if(checkedSizesize<=0){
        alertTip("<{t}>PleaseSelectAtLeastOneOrder<{/t}>",'500','auto','1');
        return;
    }
    var param = $("#orderDataForm").serialize();
    $.ajax({
        type:"post",
        async:false,
        dataType:"json",
        url:"/merchant/order/submit",
        data:param,
        success:function (json) {
            var html = ""+json.message+"";
            if(json.ask=='1'){
                if(json.error){
                    html+=":<br/>";
                    $.each(json.error,function(k,v){
                        html+=""+v+"<br/>";
                    });
                }
                alertTipclose(html);
            }else{
                if(json.error){
                    html+=":<br/>";
                    $.each(json.error,function(k,v){
                        html+=""+v+"<br/>";
                    });
                }
                alertTip(html);
            }
            $('#searchorderForm').submit();
        }
    });
}
/*删除*/
function movedraft(){
    var checkedSizesize = $('.orderArr:checked').size();
    if(checkedSizesize<=0){
        alertTip("<{t}>PleaseSelectAtLeastOneOrder<{/t}>",'500','auto','1');
        return;
    }
    var param = $("#orderDataForm").serialize();
    $.ajax({
        type:"post",
        async:false,
        dataType:"json",
        url:"/merchant/order/draft",
        data:param,
        success:function (json) {
            var html = ""+json.message+"";
            if(json.ask=='1'){
                if(json.error){
                    html+=":<br/>";
                    $.each(json.error,function(k,v){
                        html+=""+v+"<br/>";
                    });
                }
                alertTipclose(html);
            }else{
                if(json.error){
                    html+=":<br/>";
                    $.each(json.error,function(k,v){
                        html+=""+v+"<br/>";
                    });
                }
                alertTip(html);
            }
            $('#searchorderForm').submit();
        }
    });
}
function bacthDelete(){
    var checkedSizesize = $('.orderArr:checked').size();
    if(checkedSizesize<=0){
        alertTip("<{t}>PleaseSelectAtLeastOneOrder<{/t}>",'500','auto','1');
        return;
    }
    var param = $("#orderDataForm").serialize();
    $.ajax({
        type:"post",
        async:false,
        dataType:"json",
        url:"/merchant/order/delete",
        data:param,
        success:function (json) {
            var html = ""+json.message+"";
            if(json.ask=='1'){
                if(json.error){
                    html+=":<br/>";
                    $.each(json.error,function(k,v){
                        html+=""+v+"<br/>";
                    });
                }
                alertTipclose(html);
            }else{
                if(json.error){
                    html+=":<br/>";
                    $.each(json.error,function(k,v){
                        html+=""+v+"<br/>";
                    });
                }
                alertTip(html);
            }
            $('#searchorderForm').submit();
        }
    });
}
function alertTip(tip,width,height,notflash) {
  
    width = width?width:500;
    height = height?height:'auto';
    $('<div title="<{t}>tip_esc_escape<{/t}>"><p align="">' + tip + '</p></div>').dialog({
        autoOpen: true,
        width: width,
        height: height,
        modal: true,
        show:"slide",
        buttons: {
            '<{t}>close<{/t}>': function() {
                $(this).dialog('close');
                if(!(typeof(notflash)!="undefined" && notflash=='1')){
                    $('#pagerForm').submit();
                }
            }
        },
        close: function() {

        }
    });
}
function alertTipclose(tip,width,height,notflash){
    width = width?width:500;
    height = height?height:'auto';
    $('<div title="<{t}>tip_esc_escape<{/t}>"><p align="">' + tip + '</p></div>').dialog({
        autoOpen: true,
        width: width,
        height: height,
        modal: true,
        show:"slide",
        buttons: {
        '<{t}>close<{/t}>': function() {
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
function deleteToDraft(){
    var checkedSizesize = $('.orderArr:checked').size();
    if(checkedSizesize<=0){
        alertTip("<{t}>PleaseSelectAtLeastOneOrder<{/t}>",'500','auto','1');
        return;
    }
    var param = $("#orderDataForm").serialize();
    $.ajax({
        type:"post",
        async:false,
        dataType:"json",
        url:"/merchant/order/delete-to-draft",
        data:param,
        success:function (json) {
            var html = ""+json.message+"";
            if(json.ask=='1'){
                if(json.error){
                    html+=":<br/>";
                    $.each(json.error,function(k,v){
                        html+=""+v+"<br/>";
                    });
                }
                alertTipclose(html);
            }else{
                if(json.error){
                    html+=":<br/>";
                    $.each(json.error,function(k,v){
                        html+=""+v+"<br/>";
                    });
                }
                alertTip(html);
            }
            $('#searchorderForm').submit();
        }
    });
}

function batchPrintCode(){
    var checkedSizesize = $('.orderArr:checked').size();
    if(checkedSizesize<=0){
        alertTip("<{t}>PleaseSelectAtLeastOneOrder<{/t}>",'500','auto','1');
        return;
    }
    $("#orderDataForm").attr("action","/merchant/order/batch-print-label");
    $("#orderDataForm").attr("target","_blank");
    $("#orderDataForm").submit();
    $("#orderDataForm").attr("action","");
}