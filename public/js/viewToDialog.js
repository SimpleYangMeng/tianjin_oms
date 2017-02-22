;(function ($) {
  $.fn.viewToDialog = function(options){
    var _default = {
      "dialogID":'viewToDialog-js-ID'
    };
    var obj = $(this);
    if($('#'+_default.dialogID).length == 0){
      var dialogHtml = $("<div>", {
        'id':_default.dialogID,
        'style':"display:none"
      });
      dialogHtml.appendTo('body');
    }
    $.extend(_default, options);

    obj.click(function(event) {
      var requestUir = $(this).data('url');
      var requestData = $(this).data('data');
      $.ajax({
        url: requestUir,
        type: 'GET',
        // dataType: 'html',
        data: requestData,
        success:function (html) {
          $(dialogHtml).html(html);
          dialogHtml.show();
          dialogHtml.dialog({
            width:'800',
            height:'auto',
            position:'center top'
          });
        }
      })
      .fail(function() {
        alertTip("网络错误！");
      });

    });


  }
})(jQuery);
