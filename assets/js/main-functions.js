jQuery(document).ready(function($){
	"use strict";

	
	
	if($('select').length){
		$('select').niceSelect();
	}
	
	if($('.progress-bar').length){
		$(".progress-bar").loading();
	}
	
	/* ---------------------------------------------------------------------- */
	/*	Carousel
	/* ---------------------------------------------------------------------- */
	
	$.fn.forest_owl_carousel = function(){
		if(typeof($.fn.owlCarousel) == 'function'){
			$(this).each(function(){
				var option;
				var data_small;
				var data_margin;
				var data_auto;
				if($(this).attr('data-slide')){
					option = $(this).attr('data-slide');
				}
				if($(this).attr('data-small-slide')){
					data_small = $(this).attr('data-small-slide');
				}
				if($(this).attr('data-margin')){
					data_margin = parseInt($(this).attr('data-margin'));
				}
				if($(this).attr('data-auto')){
					data_auto = $(this).attr('data-auto');
				}
				var owl_attr = {
					//autoPlay: 3000, //Set AutoPlay to 3 seconds
					autoplay:data_auto,
					autoplayTimeout:5000,
					loop:false,
					margin:data_margin,
					responsive:{
						0:{
							items:1
						},
						600:{
							items:data_small
						},
						1000:{
							items:option
						},
						1300:{
							items:option
						}
					}
				};
				
				$(this).owlCarousel(owl_attr);	
			});	
		}
	}

	// runs flex slider function
	$.fn.islamic_center_flexslider = function(){
		if(typeof($.fn.flexslider) == 'function'){
			$(this).each(function(){
				var flex_attr = {
					animation: 'fade',
					animationLoop: true,
					prevText: '<i class="fa fa-angle-left" ></i>', 
					nextText: '<i class="fa fa-angle-right" ></i>',
					useCSS: false
				};
				
				// slide duration
				if( $(this).attr('data-pausetime') ){
					flex_attr.slideshowSpeed = parseInt($(this).attr('data-pausetime'));
				}
				if( $(this).attr('data-slidespeed') ){
					flex_attr.animationSpeed = parseInt($(this).attr('data-slidespeed'));
				}

				// set the attribute for carousel type
				if( $(this).attr('data-type') == 'carousel' ){
					flex_attr.move = 1;
					flex_attr.animation = 'slide';
					
					if( $(this).closest('.kode-item-no-space').length > 0 ){
						flex_attr.itemWidth = $(this).width() / parseInt($(this).attr('data-columns'));
						flex_attr.itemMargin = 0;							
					}else{
						flex_attr.itemWidth = (($(this).width() + 30) / parseInt($(this).attr('data-columns'))) - 30;
						flex_attr.itemMargin = 30;	
					}		
					
					// if( $(this).attr('data-columns') == "1" ){ flex_attr.smoothHeight = true; }
				}else{
					if( $(this).attr('data-effect') ){
						flex_attr.animation = $(this).attr('data-effect');
					}
				}
				if( $(this).attr('data-columns') ){
					flex_attr.minItems = parseInt($(this).attr('data-columns'));
					flex_attr.maxItems = parseInt($(this).attr('data-columns'));	
				}				
				
				// set the navigation to different area
				if( $(this).attr('data-nav-container') ){
					var flex_parent = $(this).parents('.' + $(this).attr('data-nav-container')).prev('.kode-nav-container');
					
					if( flex_parent.find('.kode-flex-prev').length > 0 || flex_parent.find('.kode-flex-next').length > 0 ){
						flex_attr.controlNav = false;
						flex_attr.directionNav = false;
						flex_attr.start = function(slider){
							flex_parent.find('.kode-flex-next').on('click',function(){
								slider.flexAnimate(slider.getTarget("next"), true);
							});
							flex_parent.find('.kode-flex-prev').on('click',function(){
								slider.flexAnimate(slider.getTarget("prev"), true);
							});
							
							islamic_center_set_item_outer_nav();
							$(window).resize(function(){ islamic_center_set_item_outer_nav(); });
						}
					}else{
						flex_attr.controlNav = false;
						flex_attr.controlsContainer = flex_parent.find('.nav-container');	
					}
					
				}

				$(this).flexslider(flex_attr);	
			});	
		}
	}
	
	// runs countdown function
	$.fn.forest_slickslider = function(){
		if(typeof($.fn.slick) == 'function'){
			$(this).each(function(){
				
				var slick_attr = {
					dots: true,
					infinite: true,
					adaptiveHeight: true,
					arrows: false,
					autoplay: false,
					autoplaySpeed: 15000,
					slidesToShow: 1,
				};
				
				// data-dots
				if( $(this).attr('data-dots') ){
					slick_attr.dots = parseInt($(this).attr('data-dots'));
				}
				//infinite
				if( $(this).attr('data-loop') ){
					slick_attr.infinite = parseInt($(this).attr('data-loop'));
				}
				//adaptiveHeight
				if( $(this).attr('data-adaptiveHeight') ){
					slick_attr.adaptiveHeight = parseInt($(this).attr('data-adaptiveHeight'));
				}
				//arrows
				if( $(this).attr('data-arrows') ){
					slick_attr.arrows = parseInt($(this).attr('data-arrows'));
				}
				//autoplay
				if( $(this).attr('data-autoplay') ){
					slick_attr.autoplay = parseInt($(this).attr('data-autoplay'));
				}
				//autoplaySpeed
				if( $(this).attr('data-autoplaySpeed') ){
					slick_attr.autoplaySpeed = parseInt($(this).attr('data-autoplaySpeed'));
				}
				//slidesToShow
				if( $(this).attr('data-slidesToShow') ){
					slick_attr.slidesToShow = parseInt($(this).attr('data-slidesToShow'));
				}
				responsive: [
					{
						breakpoint: 768,
						settings: {
							arrows: false,
							autoplay: true,
							autoplaySpeed: 7000,
							slidesToShow: 1
						}
					},
					{
						breakpoint: 480,
						settings: {
							arrows: false,
							dots: false,
							autoplay: true,
							autoplaySpeed: 7000,
							slidesToShow: 1
						}
					}
				];
				$(this).slick(slick_attr);	
				
			});	
		}
	}
	
	
	$(window).load(function(){
		// runs bxslider when available
		$('.slickslider').forest_slickslider();
		
		$('.owl-carousel').forest_owl_carousel();
		
		$('.kode_video_list').forest_owl_carousel();

		$('.flexslider').islamic_center_flexslider();
		
		
	});
	
	if($('#slider1').length){
		$("#slider1").sliderResponsive({
			// Using default everything
			// slidePause: 5000,
			fadeSpeed: 200,
			autoPlay: "on",
			// showArrows: "off", 
			hideDots: "off", 
			hoverZoom: "on", 
			// titleBarTop: "off"
		});
	}
	
	
	if(jQuery('.slider-1x').length){
		jQuery('.slider-1x').slick({
			dots: true,
			infinite: true,
			adaptiveHeight: true,
			arrows: false,
			autoplay: false,
			autoplaySpeed: 15000,
			slidesToShow: 1,
			responsive: [
				{
					breakpoint: 768,
					settings: {
						arrows: false,
						autoplay: true,
						autoplaySpeed: 7000,
						slidesToShow: 1
					}
				},
				{
					breakpoint: 480,
					settings: {
						arrows: false,
						dots: false,
						autoplay: true,
						autoplaySpeed: 7000,
						slidesToShow: 1
					}
				}
			]
		});
	}


	if(jQuery('.slider-2x').length){
		jQuery('.slider-2x').slick({
			dots: true,
			infinite: true,
			adaptiveHeight: true,
			centerMode: false,
			arrows: false,
			autoplay: false,
			autoplaySpeed: 15000,
			slidesToShow: 1,
			responsive: [
				{
					breakpoint: 768,
					settings: {
						arrows: false,
						autoplay: true,
						autoplaySpeed: 7000,
						slidesToShow: 1
					}
				},
				{
					breakpoint: 480,
					settings: {
						arrows: false,
						dots: false,
						autoplay: true,
						autoplaySpeed: 7000,
						slidesToShow: 1
					}
				}
			]
		});
	} 
	
	
	if($('.main-slider-bxslider').length){
		$('.main-slider-bxslider').bxSlider({
			mode: 'horizontal',
			moveSlides: 1,
			fade:true,
			slideMargin: 40,
			infiniteLoop: true,
			speed: 800,
		});
	}
	
	if($('.city-banner01-slide').length){
		$('.city-banner01-slide').slick({
			slidesToShow:1,
			autoplay: true,
			fade:true,
			speed: 800,
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2,
						infinite: true,
						dots: true
					}
				},
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2
					}
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					}
				}
			]
		});
	}
	
	$('[data-search]').on('keyup', function() {
		var searchVal = $(this).val();
		var filterItems = $('[data-filter-item]');

		if ( searchVal != '' ) {
			filterItems.addClass('hidden');
			$('[data-filter-item][data-filter-name*="' + searchVal.toLowerCase() + '"]').removeClass('hidden');
		} else {
			filterItems.removeClass('hidden');
		}
	});
	
	
});