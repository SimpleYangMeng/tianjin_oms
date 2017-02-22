paginationTotal = 0;
paginationPageSize = 20;
paginationCurrentPage = 1;

function pageselectCallback(page_id, jq) {
    paginationCurrentPage = page_id+1;
    initData(page_id);
}

function changePageSize(obj){
    paginationPageSize = $(obj).val();
    $('#pageSizes').val($(obj).val());
    if(paginationPageSize <= 0){
        paginationPageSize = 20;
    }
    if(paginationTotal||paginationTotal<=0){
        var paginationTotal =  $('.pagination').attr('totalcount');
    }
    if(Math.ceil(paginationTotal/paginationPageSize) <= paginationCurrentPage){
       var paginationCurrentPage = Math.ceil(paginationTotal/paginationPageSize);
    }
    if(paginationCurrentPage == 0){
        paginationCurrentPage = 1;
    }
	var ajaxfun=$('.pagination').attr('ajaxfun');
	if(ajaxfun!='' && ajaxfun!=undefined){
		var total = $('.pagination').attr('totalcount');
		var opt={
                current_page:'1',
                items_per_page:paginationPageSize
            }
   		$(".pagination").pagination(total,opt);
		do_search();
	}else{
		initData(0);
	}
}

function initData(pageIndex) {
    // loading();
    var curPage=pageIndex;
    if(typeof(paginationTotal)!='undefined'){
        if(Math.ceil(paginationTotal/paginationPageSize) <= paginationCurrentPage){
            paginationCurrentPage = Math.ceil(paginationTotal/paginationPageSize);
            pageIndex = paginationCurrentPage - 1;
        }
    }else{
        //   closeLoading();
        $(".pagination").html('');
        paginationPageSize=0;
    }
    if(curPage<1) pageIndex=0;

	//$('#loadData').myLoading();
    loadData(pageIndex + 1,paginationPageSize);

    //if(paginationTotal<1){
        //$(".pagination").html(''); return ;
    //}

    if(pageIndex <0){pageIndex = 0;}
    $(".pagination").pagination(paginationTotal, {
        callback: pageselectCallback,
        items_per_page: paginationPageSize,
        num_display_entries: 6,
        current_page: pageIndex,
        num_edge_entries: 2
    });
}