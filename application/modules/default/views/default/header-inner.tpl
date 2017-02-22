<style>
    .flow-steps {
        clear: both;
        display: inline-block;
        margin: 20px 0;
        overflow: hidden;
    }
    ol, ul {
        list-style: none outside none;
    }
    .flow-steps li.current {
        background-color: #FF6600;
        color: #FFFFFF;
    }
    .flow-steps .num4 li {
        width: 195px;
    }
    .flow-steps li {
        background: url("/images/flow_steps_bg.png") no-repeat scroll 100% 0 #E4E4E4;
        color: #404040;
        float: left;
        font-size: 14px;
        font-weight: bold;
        height: 23px;
        line-height: 23px;
        overflow: hidden;
        padding: 0 15px 0 0;
        text-align: center;
    }
</style>
<div class="flow-steps">
    <ol class="num4">
        <li <{if $step eq "0"}>class="current"<{/if}>><span class="first">注册账号</span></li>
        <li <{if $step eq "2"}>class="current"<{/if}>><span>邮箱验证</span></li>
        <li <{if $step eq "3"}>class="current"<{/if}>><span>完善资料</span></li>
        <li <{if $step eq "4"}>class="current"<{/if}>><span>注册完成</span></li>
    </ol>
</div>