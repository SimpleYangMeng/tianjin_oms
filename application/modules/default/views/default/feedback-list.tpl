<link rel="stylesheet" href="/css/login.css" type="text/css"/>
<div class="fn-content fn-hidden fn-clear">
    <div class="fn-clear">
        <div class="hyzxzc_mmmmt">
            <span>咨询与投诉列表</span>
            <a href="/merchant" class="leftright"><返回</a>
        </div>
        <div class="list-content">
            <ul class="cl">
                <{if $data neq "" && $data|@count neq 0}>
                    <{foreach from=$data item=item key=key}>
                        <li class="leftloat">
                            <a href="/feed-back/view/?feedbackId=<{$item.feedback_id}>">
                                <span >[<{$item.message_type}>]</span>
                                <span>[<{$item.ciq_status}>]</span>
                                <span><{$item.message}></span>
                            </a>
                            <span class="leftright datetime"><{$item.add_time}></span>
                        </li>
                    <{/foreach}>
                <{else}>
                     <li class="center">暂无无数据</li>
                <{/if}>
            </ul>
        </div>
        <form action="" method="post" id="pagerForm">
            <input type="hidden" name="page" value="<{$page}>" id="page" />
            <input type="hidden" name="pageSize" value="<{$pageSize}>" id="pageSizes"/>
        </form>
        <div class="clear"></div>
        <div class="panelBar">
            <div class="pagination" targetType="navTab" totalCount="<{$count}>" numPerPage="<{$pageSize}>" currentPage="<{$page}>" pageNumShown="10"></div>
        </div>
    </div>
</div>