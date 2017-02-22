<link rel="stylesheet" href="/css/login.css" type="text/css"/>
<div class="fn-content fn-hidden fn-clear">
    <div class="fn-clear">
        <div class="hyzxzc_mmmmt cl">
            <{$feedbackData.message_type}>详情
            <a href="/feed-back/list" class="leftright"><返回列表</a>
        </div>
        <div class="view-content">
            <h2><{$feedbackData.message}></h2>
            <h3>
                <span>创建时间：<{$feedbackData.add_time}></span>
                <span>来源IP:<{$feedbackData.from_ip}></span>
                <span>回复状态:<{$feedbackData.ciq_status}></span>
            </h3>
            <div class="content-data"><{$feedbackData.receipt}></div>
        </div>
    </div>
</div>