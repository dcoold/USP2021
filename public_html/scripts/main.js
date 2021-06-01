/* IIFE - Immediately Invoked Function Expression */
(function($, window, document) {
	
	var nav = $('#navigation'),
		navIcon = $('#menuToggle'),
		contactForm = $('#contactForm'),
		recipeForm = $('#recipeForm');
	
	// When the DOM is ready:
	$(function() {
		$(navIcon).click(function(){
			$(nav).toggleClass('active');
		});
		$('.button', contactForm).click(function(){
			manageMail();
		});
		$('.submit', recipeForm).click(function(){
			manageRecipe();
		});
		$('.addProduct', recipeForm).click(function(){
			console.log('ok');
			var lastRow = $(this).prev(),
				nextRowID = $(lastRow).data('nr') + 1,
				clonedRow = $(lastRow).clone();
				
			$(clonedRow).find('.ingr').attr('name', 'prd['+nextRowID+'][ingr]').val('');
			$(clonedRow).find('.qnt').attr('name', 'prd['+nextRowID+'][qnt]').val('');
			$(clonedRow).find('.msr').attr('name', 'prd['+nextRowID+'][msr]').val('');
			
			$(clonedRow).attr('data-nr', nextRowID);
			$(lastRow).after(clonedRow);
		});
	});
	
	
	// When the document is loaded:
	$(window).on('load', function(){
		
	});
	
	// When scrolling:
	$(window).on('scroll', function(){
		
	});
	
	// When resizing
	$(window).on('resize', function() {
		
	});
	
	// When the document is loaded:
	$(window).on('load scroll resize', function(){
		
	});
	
	var manageMail = function(){
				
		var formData = {};
			formData['action'] = 'manageMail';
			$('.field', contactForm).each(function(){
				formData[this.name] = this.value || '';
			});
			
		$('.response', contactForm).html('');
		
		$.ajax({
			type:"POST",
			url: '../ajax/mail.php',
			data: formData,
			success:function(response){
				if(response.type == 'success'){
					var height = $(contactForm).outerHeight();
					$(contactForm).css('height', height).children().fadeOut(300, function(){
						$(this).parent().html('<p class="response success">'+ response.data +'</p>').animate({height: 105}, 1000);
					});
				}else{
					$('.response', contactForm).addClass('error').html(response.data);
				}
				var height = $(contactForm).outerHeight();
		
			}
		});
	}	
	
	var manageRecipe = function(){
				
		var formData = {};
			formData['action'] = 'addRecipe';
			$('.field', recipeForm).each(function(){
				formData[this.name] = this.value || '';
			});
			
		$('.response', recipeForm).html('');
		
		$.ajax({
			type:"POST",
			url: '../ajax/functions-ajax.php',
			data: formData,
			success:function(response){
				console.log(response);
				if(response.type == 'success'){
					var height = $(recipeForm).outerHeight();
					$(recipeForm).css('height', height).children().fadeOut(300, function(){
						$(this).parent().html('<p class="response success">'+ response.data +'</p>').animate({height: 105}, 1000);
					});
				}else{
					$('.response', recipeForm).addClass('error').html(response.data);
				}	
			},
			complete: function(data){
				console.log(data);
			}
		});
	}
	
	var swiper = new Swiper('.swiper-container', {
		slidesPerView: 4,
		spaceBetween: 20,
		loop: true,
		slidesPerGroup: 4,
		pagination: {
			el: '.bullets',
			clickable: true,
		},
		navigation: {
			nextEl: '.post-next',
			prevEl: '.post-prev',
		},
		breakpoints: {
			720: {
			  slidesPerView: 1,
			  slidesPerGroup: 1,
			  spaceBetween: 20
			},
			1200: {
			  slidesPerView: 2,
			  slidesPerGroup: 2,
			  spaceBetween: 20
			},
			1500: {
			  slidesPerView: 3,
			  slidesPerGroup: 3,
			  spaceBetween: 20
			}
		}
    });

}(window.jQuery, window, document));