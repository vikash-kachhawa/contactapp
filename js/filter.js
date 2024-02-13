
function filterContactList(pageNumber)
{
	var srchqry = $("#contact-filter-search-qry").val();
	var importancefilter = $("#importance-filter").val();
	var groupfilter = $("#group-filter").val();
	var categoryfilter = $("#category-filter").val();
	var relatedtofilter = $("#related-to-filter").val();
	var producttypefilter = $("#product-type-filter").val();
	var pagesizefilter = $("#result-page-size").val();

	var dataArray = 
	{
		sq : srchqry,
		if : importancefilter, 
		gf : groupfilter,
		cf : categoryfilter,
		rto : relatedtofilter,
		pt : producttypefilter,
		ps : pagesizefilter,
		pno : pageNumber
	};

	$("#contact-list-section").hide();
	$("#contact-list-loading").show();

	$("#contact-list-section").load("contactlistsection.php",dataArray,function(){
		$("#contact-list-loading").fadeOut(500,function(){
	    	$("#contact-list-section").fadeIn(100,function(){
	    		$("#contact-sort-table").tablesorter();
	    	});
	    });
	});
}

function toggleClearAllBtn()
{
	var srchqry = $("#contact-filter-search-qry").val();
	var importancefilter = $("#importance-filter").val();
	var groupfilter = $("#group-filter").val();
	var categoryfilter = $("#category-filter").val();
	var relatedtofilter = $("#related-to-filter").val();
	var producttypefilter = $("#product-type-filter").val();

	if(srchqry == "" && importancefilter == "0" && groupfilter == "0" && categoryfilter == "0" && relatedtofilter == "0" && producttypefilter == "0")
	{
		$("#clear-all-filter-btn").attr("disabled","disabled");
	}
	else
	{
		$("#clear-all-filter-btn").removeAttr("disabled");
	}
	
}

$(document).ready(function(){

	$("#contact-filter-search-qry").on("input",function () {
		filterContactList(1);
		toggleClearAllBtn();
	});

	$(document).on("change","#result-page-size",function () {
		filterContactList(1);
	});

	$("#importance-filter").on("change",function () {
		filterContactList(1);
		toggleClearAllBtn();
	});

	$("#group-filter").on("change",function () {
		filterContactList(1);
		toggleClearAllBtn();
	});

	$("#category-filter").on("change",function () {
		filterContactList(1);
		toggleClearAllBtn();
	});

	$("#related-to-filter").on("change",function () {
		filterContactList(1);
		toggleClearAllBtn();
	});

	$("#product-type-filter").on("change",function () {
		filterContactList(1);
		toggleClearAllBtn();
	});

	$("#clear-all-filter-btn").on("click",function(){

		$("#importance-filter").val("0");
		$("#group-filter").val("0");
		$("#category-filter").val("0");
		$("#related-to-filter").val("0");
		$("#product-type-filter").val("0");
		$("#contact-filter-search-qry").val("");
		toggleClearAllBtn();
		filterContactList(1);
	});

	$(document).on("click",".contact-list-prev-btn",function(){
		var prevpageval = $(this).val();
		prevpageval = parseInt(prevpageval);
		if(prevpageval > 0 && prevpageval != "")
		{
			filterContactList(prevpageval);
		}
	});

	$(document).on("click",".contact-list-next-btn",function(){
		var nextpageval = $(this).val();
		nextpageval = parseInt(nextpageval);
		if(nextpageval > 0 && nextpageval != "")
		{
			filterContactList(nextpageval);
		}
	});

	// Initial Contact Table Sort
	$("#contact-sort-table").tablesorter({
		theme: 'blackice'	
	});


});