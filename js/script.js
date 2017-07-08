$(function(){
	$("#menu-btn").on("click", function(){
		$(".header-col-1, .header-col-3").slideToggle();
	});

	$("#productsWrapper").mixItUp();
});