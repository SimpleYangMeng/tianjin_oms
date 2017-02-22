$(document).ready(function () {
    create_page_bar();
});

function create_page_bar()
{
	var total = $('.pagination').attr('totalcount');
	if($('.pagination').size()==0){ return;}
	var currencypage=$('.pagination').attr('currentpage');
	var pageSize = $('.pagination').attr('numperpage');
	var numrege = /[1-9]+[0-9]*/;
	if(!numrege.test(currencypage)){
		currencypage='1';
	}else{
		currencypage=currencypage-1;
	}
	var opt={
		current_page:currencypage,
		items_per_page:$('.pagination').attr('numperpage')
	}
	$(".pagination").pagination(total,opt);

	$('.pagination a').each(function(){
		$(this).click(function(){
			if($(this).hasClass('prev')){
				if($(this).html()=='首页'||$(this).html()=='Home'){
					$('#page').val('1');
				}else{
					$('#page').val(currencypage);
				}
			}else if($(this).hasClass('last')){
				var last = Math.ceil(total/pageSize)
				$('#page').val(last);
			}else if($(this).hasClass('next')){
				if($('.pagination a').filter('.prev').last()[0]==this){
					var last = Math.ceil(total/pageSize)
					$('#page').val(last);
				}else{
					$('#page').val($('.current').html());
				}
			}else{
				$('#page').val($(this).html());
			}
			$('#pagerForm').submit();
		});
	});
}
function pageselectCallback(page_index, jq){
	var items_per_page =  $('.pagination').attr('numperpage');
	var total = $('.pagination').attr('totalcount');
	var max_elem = Math.min((page_index+1) * items_per_page, total);
	var newcontent = '';
	return false;
}