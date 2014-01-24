$(function(){
	$.ajax({
		url: CCM_TOOLS_PATH + '/page_list',
		type: 'get',
		data: {
			bID: $('#ccm-ajax-page-list').attr('data-bid'),
			cID: $('#ccm-ajax-page-list').attr('data-cid'),
			aHandle: $('#ccm-ajax-page-list').attr('data-ahandle')
		}
	}).done(function(response){
		$('#ccm-ajax-page-list-loading').hide();
		$('#ccm-ajax-page-list').append(response);
		ccm_ajaxPageListPagination();
	});
});

var ccm_ajaxPageListPagination = function(){
	$('#ccm-ajax-page-list #pagination a').click(function(e){
		e.preventDefault();
		
		$('#ccm-ajax-page-list').empty();
		$('#ccm-ajax-page-list-loading').show();
		
		var linkurl = $(this).attr('href');
		
		$.ajax({
			url: linkurl
		}).done(function(response){
			$('#ccm-ajax-page-list-loading').hide();
			$('#ccm-ajax-page-list').append(response);
			ccm_ajaxPageListPagination();
		});
	});
}