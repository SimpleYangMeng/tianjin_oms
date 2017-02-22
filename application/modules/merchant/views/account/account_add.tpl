<div class="content-box closed-box ui-tabs ui-widget ui-widget-content ui-corner-all">
    <div class="content-box-header">
        <h3 style="margin-left:5px"><{t}>add_account<{/t}></h3>
        <div class="clear"></div>
    </div>

    <form id="addAcount" class="pageForm required-validate"action="/merchant/account/add">
        <fieldset>
            <table>
                <tr>
                    <td class="form_title nowrap text_right" ><{t}>user_name<{/t}>：</td>
                    <td class="form_input">
                        <input type="text" value="" placeholder="<{t}>username_require<{/t}>" size="45" class="fix-medium1-input text-input" id="account_name" name="account_name">
                        <strong>*</strong>
                    </td>
                </tr>
                <tr>
                    <td class="form_title nowrap text_right"><{t}>email_address<{/t}>：</td>
                    <td class="form_input">
                        <input type="text" placeholder="<{t}>account_email_input<{/t}>" class="fix-medium1-input required text-input " id="account_email" name="account_email" value="" size="45">
                        <strong>*</strong>
                        <span class="blue"><{t}>account_email_tips<{/t}></span>
                    </td>
                </tr>
                <tr>
                    <td class="form_title nowrap text_right" ><{t}>account_real_name<{/t}>：</td>
                    <td class="form_input">
                        <input type="text" value="" placeholder="<{t}>account_real_name_tips_input<{/t}>" size="45" class="fix-medium1-input text-input" id="account_real_name" name="account_real_name" />
                        <strong>*</strong>
                        <span class="blue"><{t}>account_real_name_tips<{/t}></span>
                    </td>
                </tr>
                <tr>
                    <td class="form_title nowrap text_right" ><{t}>account_id_code<{/t}>：</td>
                    <td class="form_input">
                        <input type="text" value="" placeholder="<{t}>account_id_code_input<{/t}>" size="45" class="fix-medium1-input text-input" id="account_id_code" name="account_id_code" />
                        <strong>*</strong>
                        <span class="blue"><{t}>account_id_code_tips<{/t}></span>
                    </td>
                </tr>
                <tr>
                    <td class="form_title nowrap text_right"><{t}>telphone<{/t}>：</td>
                    <td class="form_input">
                        <input type="text" placeholder="" class="fix-medium1-input required text-input" id="telphone" name="telphone" value="" size="45">
                        <strong>*</strong>
                    </td>
                </tr>
                <tr>
                    <td class="form_title nowrap text_right"><{t}>password<{/t}>：</td>
                    <td class="form_input">
                        <input type="password" value="" placeholder="" size="45" class="fix-medium1-input text-input" id="account_password" name="account_password">
                        <strong>* </strong>
                        <span class="blue"><{t}>change_password_tip1<{/t}></span>
                    </td>
                </tr>
                <tr>
                    <td class="form_title nowrap text_right"><{t}>confirm_password<{/t}>：</td>
                    <td class="form_input">
                        <input type="password" value="" placeholder="" size="45" class="fix-medium1-input text-input" id="confirm_password" name="confirm_password">
                        <strong>* </strong>
                         <span class="blue"><{t}>change_password_tip1<{/t}></span>
                    </td>
                </tr>
                <tr>
                    <td class="form_title"></td>
                    <td class="form_input">
                        <a onclick="dosubmit();return false;" class="button tijiao" href="javascript:void(0);"><{t}>submit<{/t}></a>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>

</div>
<script type="text/javascript">

    $(function(){
        $("#addAcount")[0].reset();

        //验证邮箱
        $('#account_email').blur(function (){
            var emialRegular = /^[a-zA-Z0-9_\.\-]+\@([a-zA-Z0-9\-]+\.)+[a-zA-Z0-9]{2,4}$/;
            if(!emialRegular.test($(this).val())){
                $(this).next().text('邮箱填写错误');
                $(this).focus();
            }else {
                $(this).next().text('');
            }
        });

        //验证身份证
        $('#account_id_code').blur(function (){
            var codeRegular = /^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/i;
            if(!codeRegular.test($(this).val())){
                $(this).next().text('身份证填写错误');
                $(this).focus();
            }else {
                $(this).next().text('');
            }
        });

        //验证电话
        $('#telphone').blur(function (){
            var telPhoneRegular = /((\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$)/;
            if(!telPhoneRegular.test($(this).val())){
                $(this).next().text('电话填写错误');
                $(this).focus();
            }else {
                $(this).next().text('');
            }
        });

    });

    function dosubmit(){
        var formdata =  $("#addAcount").serialize();
        var account_name = $("[name='account_name']").val();
        var account_email = $('[name="account_email"]').val();
        var password1 = $('[name="account_password"]').val();
        var password2 = $('[name="confirm_password"]').val();
        var account_real_name = $('[name="account_real_name"]').val();
        var account_id_code = $('[name="account_id_code"]').val();
        var errorHtml = "";
        if(account_name==""){
            errorHtml+='<{t}>username_require<{/t}></br>';
        }
        if(account_email==""){
            errorHtml+="<{t}>email_require<{/t}></br>";
        }
        if(password1==""){
            errorHtml+="<{t}>password_required<{/t}></br>";
        }
        if(password2==""){
            errorHtml+="<{t}>confirm_password_required<{/t}></br>";
        }
        if(password1!=password2){
            errorHtml+="<{t}>the_password_and_confirm_password_does_not_match<{/t}></br>";
        }
        if(account_real_name == ''){
            errorHtml+="<{t}>account_real_name_tips_input<{/t}></br>";
        }
        if(account_id_code == ''){
            errorHtml+="<{t}>account_id_code_input<{/t}></br>";
        }
        if(errorHtml!=""){
            alertTip(errorHtml);
            return false;
        }
        var myoptions = {
            url:'/merchant/account/add',
            type:'POST',
            cache:false,
            dataType:'json',
            processData:true,
            data:formdata,
            success: function(json){
                var html ="";
                if(json.ask=='0'){
                    if(typeof (json.error)!="undefined"&&json.error!=""){
                        $.each(json.error,function(k,v){
                            html+=v+'</br>';
                        })
                    }
                    alertTip(html);
                }else{
                    $("#addAcount")[0].reset();
                    alertTip(json.message);
                }
            }
        };
        $.ajax(myoptions);
        return false;
    }

</script>
