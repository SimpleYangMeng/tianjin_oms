<link rel="stylesheet" href="/css/login.css" type="text/css"/>
<div class="fn-content fn-hidden fn-clear">
    <div class="fn-clear">
        <div class="hyzxzc_mmmmt cl">
            公告详情
            <a href="/notice/list" class="leftright"><返回列表</a>
        </div>
        <div class="view-content">
            <h2><{$noticeData.sn_title}></h2>
            <h3>
                <span>公告编号:<{$noticeData.sn_notice_serial_no}></span>
                <span>发布时间：<{$noticeData.sn_add_time}></span>
            </h3>
            <div class="content-data"><{$noticeData.sn_info}></div>
        </div>
    </div>
</div>
<script>
function downloads(id){
	location.href="/notice/download/id/"+id;
}
</script>