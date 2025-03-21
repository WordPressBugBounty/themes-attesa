(function ($) {
	'use strict';
	var $window = $(window);
    var $document = $(document);
    var $body = $('body');

	$window.on('load', function () {
		/* ----------------------------------------------------------------------------------- */
		/* Sticky woocommerce bar */
		/* ----------------------------------------------------------------------------------- */
		var $stickyProduct = $('.attesa-woocommerce-sticky-product');
		if ($stickyProduct.length) {
			var $header = $('header.site-header');
            var $form = $('form.cart');
            var $footerArea = $('.footer-bottom-area');
            
            var formHeight = $form.height();
            var headerHeight = $header.outerHeight();

			$window.scroll(function () {
				var windowScrollTop = $window.scrollTop();
                var windowHeight = $window.height();
                var formOffset = $form.offset().top - headerHeight;
                var footerOffset = $footerArea.offset().top;
                
                if (windowScrollTop >= formOffset + formHeight && 
                    windowScrollTop < (footerOffset - windowHeight)) {
                    $stickyProduct.addClass('open');
                } else {
                    $stickyProduct.removeClass('open');
                }
			});
			$stickyProduct.find('.attesa-sticky-button').click(function() {
				var scrollTarget = $('.woocommerce div.product').offset().top - headerHeight - 30;
				$('html,body').animate({ scrollTop: scrollTarget }, 500);
				return false;
			});
		}
	});
	$document.ready(function() {
		if ($body.hasClass('attesa-ajax-add-to-cart')) {
			$('.single_add_to_cart_button').on('click', function(e) {
				var $thisbutton = $(this);
                if ($thisbutton.hasClass('disabled')) {
                    return;
                }
			    e.preventDefault();
			    var $form = $thisbutton.closest('form.cart');
                var id = $thisbutton.val();
                var product_qty = $form.find('input[name=quantity]').val() || 1;
                var product_id = $form.find('input[name=product_id]').val() || id;
                var variation_id = $form.find('input[name=variation_id]').val() || 0;
			    var data = {
                    action: 'attesa_woocommerce_ajax_add_to_cart',
                    security: attesaWooSettings.nonce,
                    product_id: product_id,
                    product_sku: '',
                    quantity: product_qty,
                    variation_id: variation_id
                };
			    $.ajax({
		            type: 'post',
		            url: wc_add_to_cart_params.ajax_url,
		            data: data,
		            beforeSend: function () {
                        $thisbutton.removeClass('added').addClass('loading');
                    },
		            complete: function (response) {
                        if (response.responseJSON && response.responseJSON.error === true) {
                            $thisbutton.text(attesaWooSettings.error).addClass('error').removeClass('loading');
                        } else {
                            $thisbutton.text(attesaWooSettings.added_to_cart).addClass('added').removeClass('loading');
                        }
                    },
		            success: function (response) {
                        if (response.error && response.product_url) {
                            window.location = response.product_url;
                            return;
                        }
                        
                        $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
                    }
			    }); 
		    }); 
		}
	});
})(jQuery);
