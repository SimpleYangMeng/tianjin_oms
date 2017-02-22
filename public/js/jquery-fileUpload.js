/**
 * file方式上传文件
 * 注意我在这里用的是ajax同步 async: false
 * @author luffy-zhao
 * <input type="file" class="file" id="file"/>
 *   <button class="button">提交</button>
 * <script type="text/javascript">
 *   readAsText.init({
 *       url:"/merchant/order/find-product",
 *       element:'.file',
 *       triggerElement: '.button'
 *   });
 *   </script>
 * @param  {[type]} f                                    [description]
 * @param  {Object} _$){                                                var _default [description]
 * @param  {[type]} loadElement:'jquery-fileUpload-load'                 };                         var _loading [description]
 * @return {[type]}                                      [description]
 */
var readAsText = (function(f, _$){
    var _default = {
      url:'', // 请求url
      element:'', // inupt[type=file] 元素
      trigger:'click', // 触发方式
      triggerElement:'', // 触发的元素
      dataType:'json',
      success: function(json){
        // console.log(json);
      },
      loadElement:'jquery-fileUpload-load'
    };
    var _loading = false;
    var _loadTriggerElement;

    var fileReader = function (file, element){
      $(_loadTriggerElement).before('<i class="icon iconfont icon-load icon-font-size-16 icon-unie62a '+_default.loadElement+'"></i>');
      var reader = new f();
      reader.readAsDataURL(file);
      reader.onload=function(){
        $.ajax({
          async: false,
          url: _default.url,
          type: 'POST',
          data:{
            data: this.result
          },
          dataType:_default.dataType,
          success:_default.success,
          complete:function(){
            _loading = false;
            $('.'+_default.loadElement).remove();
          },
          beforeSend:function(){
            element.outerHTML = element.outerHTML;
          }
        });
      };
    };

    var changeElement = function () {
      var elements = $("input[type='file']"+_default.element);
      var filecount = 0;
      if(elements.length === 0){
        alert('没找到上传控件！');
        _loading = false;
        return false;
      }
      elements.each(function(index, el) {
        var files = el.files;
        if((typeof files == 'undefined') || (files.length === 0)){
          return true;
        }
        for (var i = 0; i < files.length; i++) {
          fileReader(files[i], el);
        }
        filecount++;
      });
      if(filecount === 0){
        _loading = false;
        alert('请选择上传文件！');
      }
    };

    var _init = function(options) {
      $.extend(_default, options);
      $(_default.triggerElement).bind(_default.trigger, function(event) {
        if(_loading === true){
          return false;
        }else{
          _loading = true;
        }
        _loadTriggerElement = $(this);
        changeElement();
        return false;
      });
    };
    return {
      init:_init
    };
})(FileReader, jQuery);
