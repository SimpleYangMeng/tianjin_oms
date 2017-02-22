<style type="text/css">
.images-box { min-height: 90px; border: 1px #aaaaaa dashed; box-sizing: border-box; /*overflow: scroll;*/}
.images-box > div { display: inline-block; box-orient: horizontal; box-pack: center; box-align: center; position: relative; }
.images-box > div > .img {margin: 5px; max-width: 80px; max-height: 80px; -moz-border-bottom-colors: none; -moz-border-left-colors: none; -moz-border-right-colors: none; -moz-border-top-colors: none; background-color: #fff; border-bottom-color: #3c763d; border-bottom-left-radius: 4px; border-bottom-right-radius: 4px; border-bottom-style: solid; border-bottom-width: 1px; border-image-outset: 0 0 0 0; border-image-repeat: stretch stretch; border-image-slice: 100% 100% 100% 100%; border-image-source: none; border-image-width: 1 1 1 1; border-left-color: #3c763d; border-left-style: solid; border-left-width: 1px; border-right-color: #3c763d; border-right-style: solid; border-right-width: 1px; border-top-color: #3c763d; border-top-left-radius: 4px; border-top-right-radius: 4px; border-top-style: solid; border-top-width: 1px; display: inline-block; line-height: 1.42857; max-width: 100%; padding-bottom: 4px; padding-left: 4px; padding-right: 4px; padding-top: 4px; transition-delay: 0s; transition-duration: 0.2s; transition-property: all; transition-timing-function: ease-in-out; float: left;}
.images-box > div > span.img { width: 80px; height: 80px; background-color: #3c763d; font-size: 24px; font-weight: bold; text-align: center; line-height: 80px;}
.images-box > div > .img:hover{opacity:0.2;}
.images-box > div > .opacity  {opacity:0.2;}
.images-box > div > div { position: absolute; width: 100%; box-pack: center; box-align: center; left: 0; top: 0; text-align: center; font-weight: bold; }
.images-box > div > a{ background-image: url(/images/icons/icon_missing.png); height: 17px; width: 17px; display: block; position: absolute; z-index: 99; right: 4px; top: 4px;}
</style>
<script type="text/javascript">var SKU     =   ''; var KEY = 0; var MODEL = [];</script>
<script type="text/javascript" src="/js/artTemplate/template.js"></script>
<script type="text/javascript" src="/js/html5-fileReader-upload.js"></script>
<div class="content-box  ui-tabs  ui-corner-all ui-widget ui-widget-content">
    <div class="content-box-header" style="margin-top:5px">
        <h3 style="margin-left:5px"><{t}>batch_upload_attached<{/t}></h3>
        <div class="clear"></div>
    </div>
    <form id="distributor-search-form" action="/merchant/product/get-product-supervision-type" method="post">
        <table>
            <tr>
                <th class="form_title">产品SKU</th>
                <td class="form_input"><input type="text" value="" name="product_sku" class="text-input width180"></td>
                <th class="form_title"></th>
                <td class="form_input"><span id="distributor-search-action" class="button">搜索</span></td>
            </tr>
        </table>
    </form>
</div>            
<div id="content-main">
    <div class="images-box" id="message_box" style="margin-top:15px; line-height:90px; text-align:center;">请选择产品</div>
</div>

<script id="type-supervision" type="text/html">
{{if state == '1'}}
<form>
{{each data as value i}}
<div class="content-box  ui-tabs  ui-corner-all ui-widget ui-widget-content" style="margin-top:5px;margin-bottom:10px;">
    <div class="content-box-header" style="margin-top:5px">
        <h3 style="margin-left:5px">{{value.name}}</h3>
        <div class="clear"></div>
    </div>    
    <table>
        <tr>
            <td class="form_input">
                <input type="file" value="" name="type-supervision[{{i}}]" id="type-supervision-{{i}}" data-key="{{i}}" class="text-input width180 fileInput" multiple="true">             
            </td>
            <td class="form_input"><span class="button type-supervision-submit" data-key="{{i}}" onclick="addEventSupervisionSubmit(this);">上传</span>文件上传时可以多选。</td>
        </tr>
    </table>   
    <div class="images-box" id="images-box-{{i}}">
        {{if value.data.length  > 0}}
        {{each value.data as item j}}
            {{if item.fileext == ".pdf"}}
                <div class="img-{{item.psa_id}}"><span class="img ">PDF</span><div style="display:none">上传中</div><a herf="javascript:void(0);" onclick="addEventSupervisionImageItem('{{item.psa_id}}')" alt="删除" title="删除" id="del-type-{{item.psa_id}}"></a></div>
            {{else}}
                <div class="img-{{item.psa_id}}"><img src="/default/index/view-product-supervision-attached?psa_id={{item.psa_id}}" class="img" /><div style="display:none">上传中</div><a herf="javascript:void(0);" onclick="addEventSupervisionImageItem('{{item.psa_id}}')" alt="删除" title="删除" id="del-type-{{item.psa_id}}"></a></div>
            {{/if}}
        {{/each}}
        {{/if}}
    </div>
</div>
 </form>

{{/each}}
{{else}}
<div class="images-box" id="message_box" style="margin-top:15px; line-height:90px; text-align:center;">{{error}}</div>
{{/if}}
</script>
<script id="type-box-image" type="text/html">
{{if file.type == "application/pdf"}}
    <div class="img-{{itme}}"><span class="opacity img">PDF</span><div><strong>上传中</strong></div></div>
{{else}}
    <div class="img-{{itme}}"><img  src="{{data.result}}" alt="{{file.name}}" class="opacity img" /><div><strong>上传中</strong></div></div>
{{/if}}
</script>

<script id="del-type-box-image" type="text/html">
    <a herf="javascript:void(0);" onclick="addEventSupervisionImageItem('{{psa_id}}')" alt="删除" title="删除" id="del-type-{{psa_id}}"></a>
</script>
<script type="text/javascript">


$(function () {    
    $('#distributor-search-action').click(addEventSubmit);   
    $('#distributor-search-form').submit(addEventSubmit);   
});

var addEventSubmit =    function(event) {
    $("#message_box").html('产品搜索中....');
    SKU =   $("input[name='product_sku']",'#distributor-search-form').val();
    var action      =   $('#distributor-search-form').attr('action');
    $.post(action, {product_sku:SKU}, function(json, textStatus, xhr) {
        var html = template('type-supervision', json);    
        $('#content-main').html(html);    
    },'json');
    return false;
}
var addEventSupervisionSubmit   =   function(t){
    KEY = $(t).data('key');
    var inputID =   "type-supervision-"+KEY;
    var imagesBoxID =   "images-box-"+KEY;
    // uploadFile(inputID);
    html5uploadFile.init({
        imagesBoxIDName : imagesBoxID,
        inputIDName : inputID,
        readerFile_callback : readerFile_call
    });    
    html5uploadFile.uploadFile();    
    
}

var readerFile_call = function(t , obj , box , i){
    var json = {
        data : t,
        file : obj,
        itme : i,
        key : KEY,
        sku : SKU
    }    
    var html = template('type-box-image', json);
    box.innerHTML += html; 
    $.post('/merchant/product/upload-html5', {
        product_sku : SKU,
        data : t.result , 
        key : KEY , 
        sum : i
    }, function(data, textStatus, xhr) {        
        if(data.state == '1'){
            $(box).find('.img-'+i+">.img").removeClass('opacity');
            $(box).find('.img-'+i+">div").hide();
            //del-type-box-image
            var html = template('del-type-box-image', data.data);
            $(html).appendTo($(box).find('.img-'+i));
        }else{
            $(box).find('.img-'+i+">div>strong").html(data.error);
        }
    },'json');
}

var addEventSupervisionImageItem = function(psa_id){
    $.post('/merchant/product/del-product-supervision-type', {
        psa_id : psa_id
    }, function(json, textStatus, xhr) {
        if(json.state == 1){
            $("#del-type-"+psa_id).parent().remove();
        }else{
            alert(json.error);
        }
    },'json');
}



</script>