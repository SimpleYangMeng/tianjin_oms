<style type="text/css">
	.welcome { height:650px; width: 1165px; background: url('/images/104.png') no-repeat center; background-size:50% auto; background-size:auto 50%; border-bottom:none ;}
</style>

<div class="content-box  ui-tabs  ui-corner-all">
    <div class="content-box-header">
        <span style="display:block; float: left;">
            <h3 class="clearborder" style="margin-left:5px;"><{t}>interface_info<{/t}></h3>
        </span>
        <span id="interface" style="display:block; float: right; padding-right: 10px;">
            <{if $customerAPIArray.ca_token }>
                <!--<a onclick="changeToken('<{$customer_id}>');" href="javascript:void(0);"><{t}>change_interface_info<{/t}></a>-->
            <{else}>
                <a onclick="requireToken('<{$customer_id}>');" href="javascript:void(0);"><{t}>request_interface_info<{/t}></a>
            <{/if}>
        </span>
        <div class="clear"></div>
    </div>
    <table cellspacing="0" cellpadding="0" class="formtable">
        <tbody>
            <tr>
                <td style="width:50px;">Token</td>
                <td id="ca_token"><{$customerAPIArray.ca_token}></td>
            </tr>
            <tr>
                <td>Key</td>
                <td id="ca_key"><{$customerAPIArray.ca_key}></td>
            </tr>
        </tbody>
    </table>
    <div class="clear"></div>
</div>

<div class="welcome btn_wrap"></div>
<!--<img src="/images/104.png" width="1164" height="640" />-->

<script type="text/javascript">
function changeToken(id){
    $.ajax({
        async:true,
        type:'POST',
        url:'/merchant/customer/change-token/id/'+id,
        dataType:'json',
        success:function(json){
            if(json.state=="1"){
                $("#ca_token").html(json.data.token);
                $("#ca_key").html(json.data.key);
                alertTip('接口变更成功!');
            }else{
                alertTip('接口变更失败!');
            }
        }
    });
}

function requireToken(id){
    $.ajax({
        async:true,
        type:'POST',
        url:'/merchant/customer/require-token/id/'+id,
        dataType:'json',
        success:function(json){
            if(json.state=="1"){
                $("#ca_token").html(json.data.token);
                $("#ca_key").html(json.data.key);
                alertTip('接口申请成功!');
                $("#interface").html('<a onclick="changeToken(\'<{$customer_id}>\');" href="javascript:void(0);">变更接口信息</a>');
            }else{
                alertTip('接口申请失败!');
            }
        }
    });
}
</script>