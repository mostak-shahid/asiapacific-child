jQuery(document).ready(function($) {
	$('.middle-header .menu-item-home a').html('<i class="fa fa-home"></i>');
	$('#feed-owl').owlCarousel({
	    loop:true,
	    margin:0,
	    nav:true,
	    dots:false,
	    items:1
	});
	$(window).load(function(){
		$(".middle-header").sticky({ topSpacing: 0 });
	});
	$('.dropdown-activator').click(function(e){
		$(this).next('.dropdown').slideToggle();
	});
	$('.social-menu > li.menu-item-has-children > a').click(function(e){
		e.preventDefault();
		$(this).next('.sub-menu').slideToggle();
		$(this).closest('.menu-item').siblings().find('.sub-menu').slideUp();
	});
});