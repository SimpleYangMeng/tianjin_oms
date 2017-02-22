$(function(){
    $('.statusBtn').bind('click',function(){
        var status = $(this).attr('ref');
        $('[name=receiving_status]').val(status);
        $('.statusBtn').removeClass('btn-active');
		$('#pagerForm #page').val(1);
        $(this).addClass('btn-active');		
        $('#pagerForm').submit();
    });
    //处理ASN
     $(".asncheckAll").die('click').live('click',function () {
         if ($(this).is(':checked')) {
             $(".AsnArr").attr('checked', true);
         } else {
             $(".AsnArr").attr('checked', false);
         }
		 changeTrColor();
     });

	/*伴随全选按钮是否选中而变色*/
	function changeTrColor(){
	
	
		$(".AsnArr").each(function(){
				_this = $(this);
				if($('.asncheckAll').is(':checked')){			
					set_tr_class(_this.parent().parent(), true);			
				}else{			
					set_tr_class(_this.parent().parent(), false);		
				}					
						
		});	
		
		
	}	 
    $('#batchSubmit').die().bind('click',function(){
        if($('#batchSelect').val()==''){
            alertTip("<{t}>PleaseSelectOperating<{/t}>",'500','auto','1');
        }else{
            switch($('#batchSelect').val()){
                case "bacthConfirm":
                    bacthConfirm();
                    break;
                case "movepending":
                    movepending();
                    break;
                case "movedraft":
                    movedraft();
                    break;
                default:
                    alertTip('<{t}>InvalidParameter<{/t}>','500','auto','1');
            }
        }
    })
});

 function bacthConfirm(){
     var checkedSizesize = $('.AsnArr:checked').size();
     if(checkedSizesize<=0){
         alertTip("<{t}>PleaseSelectAtLeastOneASN<{/t}>",'500','auto','1');
         return;
     }
     var param = $("#asnDataForm").serialize();
     $.ajax({
         type:"post",
         async:false,
         dataType:"json",
         url:"/merchant/receiving/confirm",
         data:param,
         success:function (json) {
             var html = ""+json.message+"";
             if(json.detailmessage){
			 	
                     $.each(json.detailmessage,function(k,v){
                         html+="<br/>"+v;
                     });				
				
			 }
			 if(json.ask=='1'){
                 alertTipClose(html);
             }else{
                 if(json.error){
                     html+=":<br/>";
                     $.each(json.error,function(k,v){
                         html+=v+"<br/>";
                     });
                 }
                 alertTip(html);
             }
             //$('#pagerForm').submit();
         }
     });
 }
 function movepending(){
     var checkedSizesize = $('.AsnArr:checked').size();
     if(checkedSizesize<=0){
         alertTip("<{t}>PleaseSelectAtLeastOneASN<{/t}>",'500','auto','1');
         return;
     }
     var param = $("#asnDataForm").serialize();
     $.ajax({
         type:"post",
         async:false,
         dataType:"json",
         url:"/merchant/receiving/pending",
         data:param,
         success:function (json) {
             var html = ""+json.message+"";
            
			 if(json.detailmessage){
			 	
                     $.each(json.detailmessage,function(k,v){
                         html+="<br/>"+v;
                     });				
				
			 }
			 
			 if(json.ask=='1'){
                 alertTipClose(html);
             }else{
                 if(json.error){
                     html+=":<br/>";
                     $.each(json.error,function(k,v){
                         html+=""+v+"<br/>";
                     });
                 }
                 alertTip(html);
             }

         }
     });
 }
 function movedraft(){
     var checkedSizesize = $('.AsnArr:checked').size();
     if(checkedSizesize<=0){
         alertTip("<{t}>PleaseSelectAtLeastOneASN<{/t}>",'500','auto','1');
         return;
     }
     var param = $("#asnDataForm").serialize();
     $.ajax({
         type:"post",
         async:false,
         dataType:"json",
         url:"/merchant/receiving/draft",
         data:param,
         success:function (json) {
             var html = ""+json.message+"";
		 		if(json.detailmessage){
			 	
                     $.each(json.detailmessage,function(k,v){
                         html+="<br/>"+v;
                     });				
				
			 	}			 
             if(json.ask=='1'){
                 alertTipClose(html);
             }else{
                 if(json.error){
                     html+=":<br/>";
                     $.each(json.error,function(k,v){
                         html+=""+v+"<br/>";
                     });
                 }
                 alertTip(html);
             }
             //$('#pagerForm').submit();
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
function alertTipClose(tip,width,height,notflash){
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
            $('#pagerForm').submit();
        }
    });
}
function deleteAsn(url){
    $('<div title="<{t}>tip_esc_escape<{/t}>"><p align=""><{t}>AreYouSureToDeleteTheASN<{/t}></p></div>').dialog({
        autoOpen: true,
        width: 300,
        height: 'auto',
        modal: true,
        show:"slide",
        buttons: {
            '<{t}>cancel<{/t}>':function(){
                $(this).dialog("close");
            },
            '<{t}>Determine<{/t}>': function() {
                $(this).dialog("close");
                $.ajax({
                    type:'POST',
                    url:url,
                    dataType:"json",
                    cache:false,
                    success:function(json){
                        if(json.ask=='1'){
                            alertTipClose(json.message);
                        }else{
                            var html = '';
                            html+=json.message;
                            alertTip(json.message,'500','auto','1');
                        }
                    },
                    error:function(){
                        alertTip('<{t}>error<{/t}>');
                    }
                });
            }
        },
        close: function() {

        }
    });

}
