<link href="/dwz/uploadify/css/uploadify.css" rel="stylesheet" type="text/css" media="screen"/>
<div class="content-box closed-box ui-tabs ui-widget ui-widget-content ui-corner-all">
 	<div class="content-box-header">
        <h3 style="margin-left:5px"><{$action}></h3>
        <div class="clear"></div>
    </div>

	<{include file="merchant/views/product/product-create.tpl"}>
	<input type="hidden" id="currentSelectImage" />
</div>


<div id="wrap" title="<{t}>add_url_pic<{/t}>"></div>	
<script>
/*是否为合格的URL*/
function isurl(str_url){
    // var strregex = "(http|ftp|https):\/\/[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@?^=%&amp;:/~\+#]*[\w\-\@?^=%&amp;/~\+#])?";
    //var re=new RegExp(strregex);
    var regexp = new RegExp("(http[s]{0,1})://[a-zA-Z0-9\\.\\-]+\\.([a-zA-Z]{2,4})(:\\d+)?(/[a-zA-Z0-9\\.\\-~!@#$%^&amp;*+?:_/=<>]*)?", "gi");
    if (regexp.test(str_url)){
        return (true);
    }else{
        return (false);
    }
}

//本地上传
function _loadImage(serverData) {
	var imageCount	= $(".imgWrap").length;
    var imgWrap = $("<div class='imgWrap' style='position:relative;height:180px;'></div>");
    var input = $("<input type='hidden' name='image["+imageCount+"][]' value='"+serverData.src+"'>");
    var img = new Image();
    var attachedType = '<select name="attachedType[' + imageCount + '][]" style="width:100%;margin-top:5px;"><option value="">请选择附件类型</option>';
    img.src = serverData.src;
    <{foreach from=$ciqAttachedType item=name key=code}>
    attachedType += '<option value="<{$code}>"><{$name}></option>';
    <{/foreach}>
     attachedType += '</select>';
    img.onerror = function () {
        this.onload = this.onerror = null;
    };
    imgWrap.append(input);
    imgWrap.append('<img src="'+img.src+'" style="width: 140px; height: 110px;">');
	imgWrap.append('<input type="text" style="width:100%;" class="text-input" name="imageSelect['+imageCount+'][]" value="" placeholder="请输入附件名称" />'+attachedType+'<img class="deleteImage" src="/images/icons/icon_square_close.png" style="cursor:pointer;position:absolute;top: 9px;right: 9px;width:14px;height:14px;">');
    $("#pic_wrapper").append(imgWrap);
    (function(){
        $('.deleteImage').click(function() {
            $(this).closest('.imgWrap').remove();
        });
    })();
}

/*
//产品添加的回调函数
function productcall(json){
    //DWZ.ajaxDone(json);
    if(json.ask){
        alertMsg.correct(json.message);
        navTab.reload(json.forwardUrl, {navTabId: json.navTabId});
    }else{
        var html = "<strong>"+json.message+"</strong>";
        if(json.error){
            html+=":<br/>";
            $.each(json.error,function(k,v){
                html+="<span class='red'>*</span>"+v+"<br/>";
            });
        }
        alertMsg.error(html)
        //alert(html);
        //navTabPageBreak(html, json.rel);
    }
}
*/

/*新增普通产品 处理海关编码相关*/

function padHselement(){
    var hscode = $('#hscode').val();
    $('#hscodeName').html('');
    <{if isset($productInfo)&&$productInfo.product_id && ($productInfo.hs_element_maps || $productInfo.hs_uom_map)}>
        var product_id = "<{$productInfo.product_id}>";       
    <{else if isset($productInfo)&&$productInfo.product_id && (!$productInfo.hs_element_maps && !$productInfo.hs_uom_map)}>
    	var product_id = '';
	<{else}>    
		var product_id = '';
    <{/if}>
	
    var valid = false;
    $.ajax({
        type:"POST",
        async:false,
        dataType:"json",
        url:"/merchant/product/get-element",
        data: {
            'hs_code':hscode,
            'product_id':product_id
        },
        success:function (json) {
            //alertTip('Reference No. existed.');
            if(product_id){
                //修改
				
                var padhtml = '<div style="float:left;border:1px solid #ccc;">';
                padhtml += '<table style="width: 300px;float:left;">'
                if(json.hs_elements!=''){
                    $.each(json.hs_elements, function (k, item) {
                        padhtml += '<tr id="product' + item.he_id + '" class="product_sku">';
                        padhtml += '<td>'+ item.he_name+'</td><td>'+'<input name="he_id['+item.he_id+']" size="25"  class="text-input fix-small-input" value="'+item.hem_detail+'">'+'</td>';
                        //padhtml += item.he_name + '<input name="he_id['+item.he_id+']" size="25" value="'+item.he_name+'">';
                        padhtml += '</tr>';
                    });
                }
                padhtml +='</table>';
                padhtml +='<table style="width: 250px;float:left;">';
                if(json.hs_uom!=''){
                    hum_quantity_law = typeof(json.hs_uom.hum_quantity_law)=="undefined"?"":json.hs_uom.hum_quantity_law;
                    padhtml +='<tr><td style="text-align:right"><{t}>legal_unit<{/t}>：<input name="pu_code_law"   class="text-input fix-small-input" value="'+hum_quantity_law+'"> '+json.hs_uom.pu_name_law+'</td></tr>';
					
                    if(json.hs_uom.pu_name_second!='' && json.hs_uom.pu_name_second!=undefined){
                        padhtml +='<tr><td style="text-align:right"><{t}>The_second_unit<{/t}>：<input name="pu_code_law"   class="text-input fix-small-input" value="'+json.hs_uom.hum_quantity_law+'"> '+json.hs_uom.pu_name_law+'</td></tr>';
                    }
                    padhtml +='<input type="hidden" name="hu_id" value="'+json.hs_uom.hu_id+'">'
                }
                padhtml +='</table><div class="clear"></div></div>';
				
                $('#hs_element').html(padhtml);
				$('#hs_element').show();
                if(json.hs_attribute!=''){
                    $('#hscodeName').html(json.hs_attribute.hs_name);
                }
            }else{
                //新增
				
                if(json.ask=='1'){
                   	padhtml='';
					padhtml += '<div style="float:left;border:1px solid #ccc;">';
                    padhtml += '<table style="width:300px;float:left;">';

                    if(json.hs_elements!=''){
                        $.each(json.hs_elements, function (k, item) {
                            padhtml += '<tr id="product' + item.he_id + '" class="product_sku">';
                            padhtml += '<td style="text-align:right">'+ item.he_name+'：<input name="he_id['+item.he_id+']" class="text-input fix-small-input"' +'">'+'</td>';
                            //padhtml += item.he_name + '<input name="he_id['+item.he_id+']" size="25">';
                            padhtml += '</tr>';
                        });
                    }
                    padhtml +='</table>';
					
                    padhtml +='<table style="width: 250px;float:left;">';					
                    if(json.hs_uom!=''){
                        hum_quantity_law = typeof(json.hs_uom.hum_quantity_law)=="undefined"?"":json.hs_uom.hum_quantity_law;

                        padhtml +='<tr><td style="text-align:right"><{t}>legal_unit<{/t}>：<input name="pu_code_law"   class="text-input fix-small-input" value="'+hum_quantity_law+'"> '+json.hs_uom.pu_name_law+'</td></tr>';


                        if(json.hs_uom.pu_code_second!='' && json.hs_uom.pu_code_second!=undefined){
                            padhtml +='<tr><td style="text-align:right"><{t}>The_second_unit<{/t}>：<input name="pu_code_second">'+json.hs_uom.pu_name_second+'</td></tr>';
                        }
                        padhtml +='<input type="hidden" name="hu_id" value="'+json.hs_uom.hu_id+'">'
                    }
                    padhtml +='</table><div class="clear"></div></div>';
					
                    $('#hs_element').html(padhtml);
					 $('#hs_element').show();
                    if(json.hs_attribute!=''){
                        $('#hscodeName').html(json.hs_attribute.hs_name);						
                    }
                }else{					
                    $("#commonProductTip").html('<{t}>hscode_not_supported<{/t}>');
                    $('#hs_element').html('');
                }
            }
        }
    });
    //showbutton();
}

function dosubmit(){
    //return false;	
	///merchant/product/add-save
             //alert($('#commonProductForm').serialize());
			 	var formdata =  $("#commonProductForm").serialize();
				var myoptions = {				
				url:'/merchant/product/add-save', //提交给哪个执行
				type:'POST',
				cache:false,		
				dataType:'json',
				processData:true,
				data:formdata,
				//dataType:'html',
				success: function(data){
					
					var html ="";
							//alert(data);
					if(data.ask==1){
					
						html += data.message+'</br></br>';
						if(actionLabel=='add'){
							html += '<button class="button buttonheight" onclick="parent.openMenuTab('+"\'/merchant/product/add\',\'新增产品\',\'ProductAdd\',\'1\');\""+'>继续新增产品</button>';
							
							
							var productId = data.productId || '';
							var product_sku = data.product_sku || '';
							// if(productId!=''){
							// 	html += '<button class="button buttonheight" onclick="parent.openMenuTab(\'/merchant/product/add/productId/';
							// 	html+=productId;
							// 	html+='\',\'<{t}>editproduct<{/t}>(';
							// 	html+=product_sku;
							// 	html+=')\',\'productedit';
							// 	html+=productId;
							// 	html+='\',\'1\')"><{t}>editproductcontinue<{/t}></button>';
							// }													
							//html += '<button class="button buttonheight" onclick="window.location.href=\'/merchant/product\'">返回产品列表</button>';
						}//=='add'){

						// if(actionLabel=='update'){
						// 	html += '<button class="button buttonheight" onclick="parent.openMenuTab(\'/merchant/product/add\',\'新增产品\',\'ProductAdd\',\'1\');">继续新增产品</button>';
						// 	var productId = data.productId || '';
						// 	var product_sku = data.product_sku || '';
						// 	if(productId!=''){
						// 		html += '<button class="button buttonheight" onclick="parent.openMenuTab(\'/merchant/product/add/productId/';
						// 		html+=productId;
						// 		html+='\',\'<{t}>editproduct<{/t}>(';	
						// 		html+=product_sku;						
						// 		html+=')\',\'productedit';
						// 		html+=productId;
						// 		html+='\',\'1\')"><{t}>editproductcontinue<{/t}></button>';
						// 	}													
						// 	//html += '<button class="button buttonheight" onclick="window.location.href=\'/merchant/product\'">返回产品列表</button>';
						// }//=='add'){						
								//alert(actionLabel);			
						//$("#commonProductTip").html(html);
						alertTip2(html);
					}else{							
							html+=data.message+"<br/>";	
						    if(typeof(data.error)!='undefined'){	
							$.each(data.error,function(idx,vitem){
						 		html+=vitem+"<br/>";
							});										
							}
							//alert("sdf");
						$("#commonProductTip").html(html);
                        $('#commonProductTip').dialog('open');
					}
					

					//clearTip();				
				
				
				
				
				},error:function(a,b,c){alert("system error");}
				
				}; //显示操作提示
				
				$.ajax(myoptions); 
				return false;
	
		    
}  //end of function

function alertTip2(tip,width,height,notflash) {
    width = width?width:500;
    height = height?height:'auto';
    $('<div title="<{t}>InformationTips<{/t}>"><p align="">' + tip + '</p></div>').dialog({
        autoOpen: true,
        width: width,
		position:[50,50],
        height: height,
        modal: false,
        show:"slide",
        buttons: {
            '<{t}>close<{/t}>': function() {
                $(this).dialog('close');
                if(!(typeof(notflash)!="undefined" && notflash=='1')){
                    //$('#pagerForm').submit();
                    parent.openMenuTab('/merchant/product','<{t}>ProductList<{/t}>','ProductList','1');
                }
            }
        },
        close: function() {
            //window.location.href='/merchant/product';			
			parent.openMenuTab('/merchant/product','<{t}>ProductList<{/t}>','ProductList','1');
        }
    });
}
function del_pic(index){
    $(".add_pic_"+index).remove()
}

var  alertMsg={
	error:function(str){
		alert(str);
	}

};

var actionLabel = '<{$actionLabel}>';
$(function() {
    if(!flashcheck()){
        alertMsg.error('<{t}>no_installed_flash_control<{/t}>');
        window.location.href='/merchant/product/playflash';        
        return;

    }
	
    $('#file_upload').uploadify({
		'swf'      : '/dwz/uploadify/scripts/uploadify.swf',
		'uploader' : '/merchant/product/single-uploadimg',
        'buttonText': '<{t}>LocalPictures<{/t}>',
		'queueSizeLimit':20,
		'uploadLimit':20,
		'fileSizeLimit' : 300,
        'fileTypeExts': '*.jpg;*.png;*.gif',
        'formData': { '<{$session_name}>' : '<{$sessionid}>' },
        'scriptData' : { '<{$session_name}>': '<{$sessionid}>' },
        'debug':false,
        'onUploadSuccess':function(file,data,response){
            var obj = jQuery.parseJSON(data);
			//$("#"+imageId+"_input").val(obj.src);
			//$("#"+imageId).html("<img src='"+obj.src+"' width='80px' height='60px' />");
            _loadImage(obj);
            //alert(response);
            //alert( 'id: ' + file.id+ ' - 索引: ' + file.index+ ' - 文件名: ' + file.name　+ ' - 文件大小: ' + file.size+ ' - 类型: ' + file.type+ ' - 创建日期: ' + file.creationdate+ ' - 修改日期: ' + file.modificationdate+ ' - 文件状态: ' + file.filestatus　+ ' - 服务器端消息: ' + data+ ' - 是否上传成功: ' + response);
        },
        'onUploadError':function(file, errorCode, errorMsg, errorString) {
                alert('The file ' + file.name + ' could not be uploaded: ' + errorString+':errorCode:'+errorCode);
        }
    });
	
	
    //$('#submitbtn').hide();
	//修改则显示海关编码的默认值
    <{if isset($productInfo)&&$productInfo.product_id}>
    padHselement();
    <{/if}>

	/*添加网络图片的按钮事件绑定*/
    $("#uploadWebImage").click(function(event){
		
        var web_wrap = $("<div class='web_wrap'>URL:<input type='text' class='web_img_url' value='' size='45'><img alt='delete' src='/images/minus_sign.gif' class='web_wrap_del'></div> ");

        var web_wrap_add = $("<div class='web_wrap_add'><img src='/images/plus_sign.gif' class='web_wrap_add_op' title='<{t}>add_pic<{/t}>'>&nbsp;&nbsp;<input type='button'  value='OK' class='bgBtn4 addWebImageBtn' id='#addWebImageBtn'></div>");
        var web_wrapper= $("<div class='web_wrapper'></div>");
        web_wrapper.append(web_wrap_add).append(web_wrap);
        var off =  $(this).offset();
		$("#wrap").html(web_wrapper.html());
		$('#wrap').dialog('open');
		event.stopPropagation();
        //container_pop_show("添加url图片",web_wrapper.html(),false,500,off.left-200,off.top-180);
    }); //$("#uploadWebImage").click


    $(".imgWrap").live("click",function(){
        //$(this).remove();
    });
    $(".deleteImage").live("click",function(){
        $(this).parent(".imgWrap").remove();
    })
    $(".web_wrap_del").live('click',function(){
        $(this).parent().remove();
    });
    $(".web_wrap_add_op").die('click').live('click',function(){
        var web_wrap = $("<div class='web_wrap'>URL:<input type='text' class='web_img_url' value='' size='45'><img alt='delete' src='/images/minus_sign.gif' class='web_wrap_del'></div> ");
        $(this).parent().parent().append(web_wrap);
    });
    $(".addWebImageBtn").die("click").live('click',function(){        
		$(this).parent().parent().find(".web_img_url").each(function(){
            var url = $(this).val();
            if(isurl(url)){
                if($.trim(url)!=''){
                    _loadWebImage(url);
                }
            } else{
                //alert('url error');
                alertMsg.error('<{t}>address_wrong<{/t}>');
            }
        });
        container_pop_hide();
    });

    $("#barcode_type").change(function(){
        if($(this).val()=='1'){
            $('#barcodebox').show();
        }else{
            $('#barcodebox').hide();
        }
    }).change();






//网络图片上传
$('#wrap').dialog({
			autoOpen: false,
			modal: false,
			bgiframe:true,			
			width: 600,	
			draggable: true,	
			resizable: true
			
});
});
</script>