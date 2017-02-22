/**
 * This jQuery plugin displays pagination links inside the selected elements.
 *
 * @author Gabriel Birke (birke *at* d-scribe *dot* de)
 * @version 1.1
 * @param {int} maxentries Number of entries to paginate
 * @param {Object} opts Several options (see README for documentation)
 * @return {Object} jQuery Object
 */
jQuery.fn.pagination = function(maxentries, opts){
	opts = jQuery.extend({
	 	first_text:"<{t}>home<{/t}>",
	    prev_text:"< <{t}>Previous<{/t}>",
        next_text:"<{t}>Next<{/t}> >",
		last_text:"<{t}>LastPage<{/t}>",
        ellipse_text:"...",
        perpage_text: '<{t}>Show<{/t}>',
        total_text: '<{t}>Total<{/t}>：',
        items_per_page:10,
		num_display_entries:5,
		num_edge_entries: 0,
		current_page:0,
		link_to:"#",
		prev_show_always:true,
		next_show_always:true,
		callback:function(){return false;}
	},opts||{});
	
	return this.each(function() {
		/**
		 * Calculate the maximum number of pages
		 */
		function numPages() {
			return Math.ceil(maxentries/opts.items_per_page);
		}
		
		/**
		 * Calculate start and end point of pagination links depending on 
		 * current_page and num_display_entries.
		 * @return {Array}
		 */
		function getInterval()  {
			var ne_half = Math.ceil(opts.num_display_entries/2);
			var np = numPages();
			var upper_limit = np-opts.num_display_entries;
			var start = current_page>ne_half?Math.max(Math.min(current_page-ne_half, upper_limit), 0):0;
			var end = current_page>ne_half?Math.min(current_page+ne_half, np):Math.min(opts.num_display_entries, np);
			return [start,end];
		}
		
		/**
		 * This is the event handling function for the pagination links. 
		 * @param {int} page_id The new page number
		 */
		function pageSelected(page_id, evt){
			current_page = page_id;
			drawLinks();
			var continuePropagation = opts.callback(page_id, panel);
			if (!continuePropagation) {
				if (evt.stopPropagation) {
					evt.stopPropagation();
				}
				else {
					evt.cancelBubble = true;
				}
			}
			return continuePropagation;
		}
		
		/**
		 * This function inserts the pagination links into the container element
		 */
		function drawLinks() {
			panel.empty();			
			var interval = getInterval();
			var np = numPages();
			// This helper function returns a handler function that calls pageSelected with the right page_id
			var getClickHandler = function(page_id) {
				return function(evt){  pageSelected(page_id,evt);return false; }
			}
			// Helper function for generating a single link (or a span tag if it'S the current page)
			var appendItem = function(page_id, appendopts){
				page_id = page_id<0?0:(page_id<np?page_id:np-1); // Normalize page id to sane value
				appendopts = jQuery.extend({text:page_id+1, classes:""}, appendopts||{});
				if(page_id == current_page || maxentries==0){
					var lnk = $("<span class='current'>"+(appendopts.text)+"</span>");
				}
				else
				{
					var lnk = $("<a>"+(appendopts.text)+"</a>")
						.bind("click", getClickHandler(page_id))
						.attr('href', opts.link_to.replace(/__id__/,page_id));												
				}
				if(appendopts.classes){lnk.addClass(appendopts.classes);}
				panel.append(lnk);
			}

            // Radys Add
			// Generate "First"-Link
			if(opts.first_text && (current_page > 0 || opts.prev_show_always)){
				appendItem(0,{text:opts.first_text, classes:"prev"});
			}

			// Generate "Previous"-Link
			if(opts.prev_text && (current_page > 0 || opts.prev_show_always)){
				appendItem(current_page-1,{text:opts.prev_text, classes:"prev"});
			}
			// Generate starting points
			if (interval[0] > 0 && opts.num_edge_entries > 0)
			{
				var end = Math.min(opts.num_edge_entries, interval[0]);
				for(var i=0; i<end; i++) {
					appendItem(i);
				}
				if(opts.num_edge_entries < interval[0] && opts.ellipse_text)
				{
					jQuery("<span>"+opts.ellipse_text+"</span>").appendTo(panel);
				}
			}
			// Generate interval links
			for(var i=interval[0]; i<interval[1]; i++) {
				appendItem(i);
			}
			// Generate ending points
			if (interval[1] < np && opts.num_edge_entries > 0)
			{
				if(np-opts.num_edge_entries > interval[1]&& opts.ellipse_text)
				{
					jQuery("<span>"+opts.ellipse_text+"</span>").appendTo(panel);
				}
				var begin = Math.max(np-opts.num_edge_entries, interval[1]);
				for(var i=begin; i<np; i++) {
					appendItem(i);
				}
				
			}
			// Generate "Next"-Link
			if(opts.next_text && (current_page < np-1 || opts.next_show_always)){
				appendItem(current_page+1,{text:opts.next_text, classes:"next"});
			}

            // Radys Add
			// Generate "Last"-Link
			if(opts.last_text && (current_page < np-1 || opts.next_show_always)){
				appendItem(np-1,{text:opts.last_text, classes:"last"});
			}
			//Ricky Add
			onlyNum=function(event){
				if(!(event.keyCode==46)&&!(event.keyCode==8)&&!(event.keyCode==37)&&!(event.keyCode==39))
				{
					if(!((event.keyCode>=48&&event.keyCode<=57)||(event.keyCode>=96&&event.keyCode<=105)))
					{
						event.returnValue=false; 
						return false;
					}
				}
			};
			var pageSizeStr = '<label>'+opts.perpage_text+'&nbsp;<input type="text" id="pageSize" value="'+opts.items_per_page+'"';
			pageSizeStr+=' style="width:25px;ime-mode:Disabled;" onchange="changePageSize(this)" onKeydown="return onlyNum(event)"/>&nbsp;</label>';
			jQuery(pageSizeStr).appendTo(panel);
			var total='<label style="margin-left:0px;padding-left:0px"><span style="padding-right:0px;margin-right:0px">'+opts.total_text+'</span><span style="font-weight:bold; margin:0;padding-left:0px">'+maxentries+'</span></label><div class="clear"></div>';
			jQuery(total).appendTo(panel);
		}
		
		// Extract current_page from options
		var current_page = opts.current_page;
		// Create a sane value for maxentries and items_per_page
		maxentries = (!maxentries || maxentries < 0)?0:maxentries;
		opts.items_per_page = (!opts.items_per_page || opts.items_per_page < 0)?1:opts.items_per_page;
		// Store DOM element for easy access from all inner functions
		var panel = jQuery(this);
		// Attach control functions to the DOM element 
		this.selectPage = function(page_id){ pageSelected(page_id);}
		this.prevPage = function(){ 
			if (current_page > 0) {
				pageSelected(current_page - 1);
				return true;
			}
			else {
				return false;
			}
		};
		this.nextPage = function(){ 
			if(current_page < numPages()-1) {
				pageSelected(current_page+1);
				return true;
			}
			else {
				return false;
			}
		};
		// When all initialisation is done, draw the links
		drawLinks();
	});
};

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
		$('#pagerForm').submit();
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
    if(curPage<1)pageIndex=0;
    //loadData(pageIndex + 1,paginationPageSize);
    //  closeLoading();
    if(paginationTotal<1){
        $(".pagination").html(''); return ;
    }
    if(pageIndex <0){pageIndex = 0;}
    $(".pagination").pagination(paginationTotal, {
        callback: pageselectCallback,
        items_per_page: paginationPageSize,
        num_display_entries: 6,
        current_page: pageIndex,
        num_edge_entries: 2
    });
}