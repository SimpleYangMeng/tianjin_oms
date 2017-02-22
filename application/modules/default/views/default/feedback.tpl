<style type="text/css">
    label { display: inline; }
    /* RADIO begin */
    .regular-radio{display: none;}
    .regular-radio + label{-webkit-appearance: none;background-color: #fafafa;border: 1px solid #cacece;box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05);padding: 8px;border-radius: 50px;display: inline-block;position: relative;}
    span.label-span { margin-left: 4px; font-size: 14px;}
    .regular-radio:checked + label:after{content: ' ';width: 8px;height: 8px;border-radius: 50px;position: absolute;background: #5A99D9;box-shadow: inset 0px 0px 10px rgba(0,0,0,0.3);text-shadow: 0px;top: 4px;left: 4px;font-size: 32px;}
    .regular-radio:checked + label{background-color: #e9ecee;color: #5A99D9;border: 1px solid #adb8c0;box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05), inset 15px 10px -12px rgba(255,255,255,0.1), inset 0px 0px 10px rgba(0,0,0,0.1);}
    .regular-radio + label:active, .regular-radio:checked + label:active{box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px 1px 3px rgba(0,0,0,0.1);}
    .big-radio + label{padding: 16px;}
    .big-radio:checked + label:after{width: 24px;height: 24px;left: 4px;top: 4px;}
    /* RADIO end */
    label.form-p-label { cursor: pointer; padding: 0 0 2px; margin-right: 10px;}
    .form-p { margin: 10px 0;}
    .error{
        background: url("/images/icons/cross_circle.png") no-repeat scroll 0 1px;
    }
    .success {
        background: url("/images/icons/icon_approve.png") no-repeat scroll 0 1px;
        border: 1px solid #56924D;
    }
    #message{ width: 760px; height: 81px;resize:none;}
    .simple-feedback-title { width: 750px;}
</style>
<div class="grid-780 grid-780-pd fn-hidden fn-clear">
    <div class="flow-steps">
        <h2>咨询与投诉</h2>
    </div>
    <div class="grid-780 fn-clear">
        <div class="hyzxzc_mmmmt">请填写信息</div>
        <form id="feedbackForm" class="fm-layout" method="post" action="/feed-back/save">
            <fieldset>
                <p class="form-p cl">
                    <label class="form-label">类型<strong class="form-strong">*</strong></label>
                </p>
                <p class="form-p cl">
                    <label class="form-p-label cl leftloat">
                        <!--<input type="radio" name="type" style="margin-bottom: 5px;" value="0"><span>咨询</span>-->
                        <input type="radio" id="type-1" name="type" class="regular-radio" value="0" checked />
                        <label class="leftloat" for="type-1"></label>
                        <span  class="leftloat label-span">咨询</span>
                    </label>
                    <label class="form-p-label leftloat cl">
                        <!--<input type="radio" name="type" style="margin-bottom: 5px;" value='1'><span>投诉</span>-->
                        <input type="radio" id="type-2" name="type" class="regular-radio" value="1" />
                        <label class="leftloat" for="type-2"></label>
                        <span class="leftloat label-span">投诉</span>
                    </label>
                </p>
                <p>
                    <label class="form-label">标题<strong class="form-strong">*</strong></label>
                    <input type="text" name="title" value="" class="simple-feedback-title"/>
                </p>
                <p class="form-p">
                    <label class="form-label">描述<strong class="form-strong">*</strong></label>
                    <textarea id="message" name="message"></textarea>
                </p>
                <p class="form-p">
                    <label class="form-label">验证码
                        <strong class="form-strong">*</strong> 
                    </label>
                    <input  type="text" class=" text-input validate[required]" id="verify" name="verify" style="width: 100px;">
                    <img class="verifyChange" id="verifyImg" title="点击以更新验证码" src="/feed-back/verify-code">
                    <strong style="color: #FF0000;"><a class="verifyChange" href="javascript:void(0);">看不清？换一个</a></strong>
                </p>
                <p class="form-p">
                    <input type="button" class="button text-input" value="提交" style="width:80px;" id="formsub" />
                </p>
                <p>
                    <ul id="formInfo"></ul>
                </p>
            </fieldset>
        </form>
    </div>
</div>

<script type="text/javascript" language="javascript">

    function alertTip(tip, type) {
        $('#formInfo').empty();
        $('<li class="'+type+'">'+tip+'</li>').appendTo($('#formInfo').show());
        setTimeout(function (){
            $('#formInfo').slideUp('slow');
        }, 3000);
        return false;
    }

    function formsub(){
        var type = $("input[name='type']:checked").val();
        var message = $('#message').val();
        var verify = $('#verify').val();

        if(type=="" || typeof(type) == 'undefined'){
            alertTip("类型不能为空", 'error');
            return false;
        }
        if(message==""){
            alertTip("描述不能为空", 'error');
            return false;
        }
        if(verify==""){
            alertTip("验证码不能为空", 'error');
            return false;
        }
        if(type!=''&& message!='' && verify!=''){
            var formData = $('#feedbackForm').serialize();
            $.ajax({
                type:"POST",
                async:false,
                dataType:"json",
                data:formData,
                url:'/feed-back/save',
                success:function(json) {
                    if(json.ask == 1){
                        alertTip(json.message, 'success');
                        $('#feedbackForm')[0].reset();
                    }else {
                        $('#verifyImg').click();
                        alertTip(json.message, 'error');
                    }
                }
            });
        }else{
            alertTip("数据有误");
            return false;
        }
    }

    $(function(){
        $(".verifyChange").click(function(){
            $('#verifyImg').attr("src","/register/verify-code?"+Math.random());
        });
        $('input').die('blur');
        //$("#registerForm").validationEngine();
        $('#formsub').die('click').bind('click',formsub);
    })
</script>