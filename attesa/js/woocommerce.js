(function ($) {
	'use strict';
	$(window).on('load', function () {
		/* ----------------------------------------------------------------------------------- */
		/* Sticky woocommerce bar */
		/* ----------------------------------------------------------------------------------- */
		if ($('.attesa-woocommerce-sticky-product').length) {
			$(window).scroll(function () {
				var d = $('form.cart').offset().top - $('header.site-header').outerHeight(),
					z = $('form.cart').height(),
					y = $('.footer-bottom-area').offset().top,
					wS = $(window).scrollTop(),
					wH = $(window).height();
				if ( wS >= d + z && wS < (y-wH) ) {
					$('.attesa-woocommerce-sticky-product').addClass('open');
				} else {
					$('.attesa-woocommerce-sticky-product').removeClass('open');
				}
			});
			$('.attesa-woocommerce-sticky-product .attesa-sticky-button').click(function(){
				$('html,body').animate({ scrollTop: $('.woocommerce div.product').offset().top - $('header.site-header').outerHeight() - 30 }, 500);
				return false;
			});
		}
	});
	$(document).ready(function() {
		if ($('body').hasClass('attesa-ajax-add-to-cart')) {
			$('.single_add_to_cart_button').on('click', function(e) {
				if ($(this).hasClass('disabled')) {
					return;
				}
			    e.preventDefault();
			    var $thisbutton = $(this),
	                $form = $thisbutton.closest('form.cart'),
	                id = $thisbutton.val(),
	                product_qty = $form.find('input[name=quantity]').val() || 1,
	                product_id = $form.find('input[name=product_id]').val() || id,
	                variation_id = $form.find('input[name=variation_id]').val() || 0;
			    var data = {
			            action: 'attesa_woocommerce_ajax_add_to_cart',
			            security: attesaWooSettings.nonce,
			            product_id: product_id,
			            product_sku: '',
			            quantity: product_qty,
			            variation_id: variation_id,
			        };
			    $.ajax({
		            type: 'post',
		            url: wc_add_to_cart_params.ajax_url,
		            data: data,
		            beforeSend: function (response) {
		                $thisbutton.removeClass('added').addClass('loading');
		            },
		            complete: function (response) {
		            	if (response.responseJSON.error === true) {
		            		$thisbutton.text(attesaWooSettings.error);
		            		$thisbutton.addClass('error').removeClass('loading');
		            	} else {
		            		$thisbutton.text(attesaWooSettings.added_to_cart);
		            		$thisbutton.addClass('added').removeClass('loading');
		            	}
		            }, 
		            success: function (response) {
		                if (response.error && response.product_url) {
		                    window.location = response.product_url;
		                    return;
		                } else { 
		                    $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
		                } 
		            }, 
			    }); 
		    }); 
		}
	});
})(jQuery);
