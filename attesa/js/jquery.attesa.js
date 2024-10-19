(function ($) {
	'use strict';
	/* ----------------------------------------------------------------------------------- */
	/* Detect Mobile Browser */
	/* ----------------------------------------------------------------------------------- */
	var mobileDetect = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
	$(document).ready(function () {
		/* ----------------------------------------------------------------------------------- */
		/*  Page Loader */
		/* ----------------------------------------------------------------------------------- */
		if ($('.attesaLoader').length) {
			$('.attesaLoader').delay(600).fadeOut(1000);
		}
		/* ----------------------------------------------------------------------------------- */
		/*  Sidebar Push Button */
		/* ----------------------------------------------------------------------------------- */
		$('.hamburger-menu, .opacityBox, .close-hamburger').click(function () {
			$('.hamburger-menu, .opacityBox, body, #tertiary.widget-area').toggleClass('yesOpen');
		});
		/* ----------------------------------------------------------------------------------- */
		/*  Search Push Button */
		/* ----------------------------------------------------------------------------------- */
		$('.search-icon').click(function () {
			$('.search-icon, .search-container, body').toggleClass('yesOpenSearch');
			$('.search-container').fadeToggle(300);
			if (!mobileDetect) {
				$('.search-container .search-field').focus();
			}
		});
		/* ----------------------------------------------------------------------------------- */
		/* Menu Widget */
		/* ----------------------------------------------------------------------------------- */
		if ($('.widget ul.menu, .widget ul.product-categories').length) {
			$('.widget ul.menu, .widget ul.product-categories').find('li').each(function () {
				if ($(this).children('ul').length > 0) {
					$(this).append('<span class="indicatorBar"></span>');
				}
			});
			$('.widget ul.menu > li.menu-item-has-children .indicatorBar, .widget ul.menu > li.page_item_has_children .indicatorBar, .widget ul.product-categories > li.cat-parent .indicatorBar').click(function () {
				$(this).parent().find('> ul.sub-menu, > ul.children').toggleClass('yesOpenBar');
				$(this).toggleClass('yesOpenBar');
				var $self = $(this).parent();
				if ($self.find('> ul.sub-menu, > ul.children').hasClass('yesOpenBar')) {
					$self.find('> ul.sub-menu, > ul.children').slideDown(300);
				} else {
					$self.find('> ul.sub-menu, > ul.children').slideUp(200);
				}
			});
		}
		/* ----------------------------------------------------------------------------------- */
		/* Mobile Menu */
		/* ----------------------------------------------------------------------------------- */
		if ($(window).width() <= 1025) {
			$('.main-navigation').find('li').each(function () {
				if ($(this).children('ul').length > 0) {
					$(this).append('<span class="indicator"></span>');
				}
			});
			$('.main-navigation ul > li.menu-item-has-children .indicator, .main-navigation ul > li.page_item_has_children .indicator').click(function () {
				$(this).parent().find('> ul.sub-menu, > ul.children').toggleClass('yesOpen');
				$(this).toggleClass('yesOpen');
				var $self = $(this).parent();
				if ($self.find('> ul.sub-menu, > ul.children').hasClass('yesOpen')) {
					$self.find('> ul.sub-menu, > ul.children').slideDown(300);
				} else {
					$self.find('> ul.sub-menu, > ul.children').slideUp(200);
				}
			});
		}
		$(window).resize(function () {
			if ($(window).width() > 1025) {
				$('.main-navigation ul > li.menu-item-has-children, .main-navigation ul > li.page_item_has_children').find('> ul.sub-menu, > ul.children').slideDown(300);
			}
		});
		/* ----------------------------------------------------------------------------------- */
		/* Sub-Menu Position */
		/* ----------------------------------------------------------------------------------- */
		if (!mobileDetect) {
			$('.main-navigation').find('li').each(function () {
				if ($('ul', this).length) {
					var elm = $('ul:first', this),
					   off = elm.offset(),
					   l = off.left,
					   w = elm.width(),
					   docW = $('body').width(),
					   isEntirelyVisible = (l + w <= docW);
					if (!isEntirelyVisible) {
						$(this).addClass('invert');
					} else {
						$(this).removeClass('invert');
					}
				}
			});
		}
		/* ----------------------------------------------------------------------------------- */
		/* Open/Close menu */
		/* ----------------------------------------------------------------------------------- */
		if ($('body').hasClass('mobile_menu_pushmenu')) {
			$('.format_compat .subHead .menu-toggle, .format_featuredtitle .subHead .menu-toggle, .attesa-close-pushmenu, .opacityMenu, .subHead.attesa-elementor-menu .menu-toggle').click(function () {
				$('.attesa-main-menu-container, .opacityMenu').toggleClass('menuOpen');
			});
		} else {
			$('.format_compat .subHead .menu-toggle, .format_featuredtitle .subHead .menu-toggle, .subHead.attesa-elementor-menu .menu-toggle').click(function () {
				$('.attesa-main-menu-container').slideToggle('fast');
			});
		}
		$('#top-navigation .menu-toggle-top').click(function () {
			$('.third-navigation div > ul').slideToggle('fast');
		});
		/* ----------------------------------------------------------------------------------- */
		/* Open/Close popup format menu */
		/* ----------------------------------------------------------------------------------- */
		$('.menu-full-screen-icon').click(function () {
			if ($('.attesa-main-menu-full-screen').hasClass('yesOpenPopupMenu')) {
				$('.attesa-main-menu-full-screen, body').removeClass('yesOpenPopupMenu');
				$('html').removeClass('overflowpopup');
			} else {
				$('.attesa-main-menu-full-screen, body').addClass('yesOpenPopupMenu');
				$('html').addClass('overflowpopup');
			}
		});
		/* ----------------------------------------------------------------------------------- */
		/*  Scroll to section */
		/* ----------------------------------------------------------------------------------- */
		$('ul.menu a[href*="#"]:not([href="#"])').click(function () {
			if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
				if (target.length) {
					$('html, body').animate({
						scrollTop: target.offset().top - 60
					}, 1000);
					if (mobileDetect) {
						if ($('body').hasClass('mobile_menu_pushmenu')) {
							$('.attesa-main-menu-container, .opacityMenu').removeClass('menuOpen');
						} else if ($('body').hasClass('mobile_menu_dropdown')) {
							$('.attesa-main-menu-container').hide('fast');
						} else {
							$('.attesa-main-menu-full-screen, body').removeClass('yesOpenPopupMenu');
							$('html').removeClass('overflowpopup');
						}
					}
					return false;
				}
			}
		});
		/* ----------------------------------------------------------------------------------- */
		/*  Scroll To Top */
		/* ----------------------------------------------------------------------------------- */
		if ($('#toTop').length) {
			if (!mobileDetect || $('#toTop').hasClass('scrolltop_on')) {
				$(window).scroll(function () {
					if ($(this).scrollTop() > 700) {
						$('#toTop').addClass('visible');
					} else {
						$('#toTop').removeClass('visible');
					}
				});
				$('#toTop').click(function () {
					$('html, body').animate({ scrollTop: 0 }, 1000);
					return false;
				});
			}
		}
		/* ----------------------------------------------------------------------------------- */
		/*  Menu Fixed */
		/* ----------------------------------------------------------------------------------- */
		function setMenu() {
			if ((!mobileDetect && $('#masthead').hasClass('withSticky')) || (mobileDetect && $('#masthead').hasClass('yesMobile'))) {
				if ($('header#masthead').attr('data-logo-on-scroll')) {
					var $logoOriginal = $('.attesa-logo img').attr('src'),
						$logoOriginalSrcset = $('.attesa-logo img').attr('srcset'),
						$logoOnScroll = $('header#masthead').attr('data-logo-on-scroll');
				}
				if ($('body').is('.headerFeatImage, .attesa-full-width')) {
					if ($('body').hasClass('withOverlayMenu')) {
						$('.attesaFeatBox, body.attesa-full-width #content.site-content').css('margin-top', $('.nav-top').outerHeight() + 'px');
					} else {
						$('.attesaFeatBox, body.attesa-full-width #content.site-content').css('margin-top', $('#masthead').outerHeight() + 'px');
					}
				} else {
					$('#content.site-content').css('margin-top', $('#masthead').outerHeight() + 'px');
				}
				var $filter = $('#masthead'),
					$topHeight = $('.nav-top').outerHeight();
				if ($filter.length) {
					$(window).scroll(function () {
						if (!$filter.hasClass('menuMinor') && $(window).scrollTop() > 0) {
							$filter.addClass('menuMinor');
							if ($filter.hasClass('topbarscrollhide')) {
								$filter.css('margin-top', '-' + $topHeight + 'px');
							}
							if ($('header#masthead').attr('data-logo-on-scroll')) {
								if ($logoOnScroll && $logoOriginal) {
									$('.attesa-logo img').fadeOut(125, function () {
										$('.attesa-logo img').attr('src', $logoOnScroll);
										if ($('.attesa-logo img').attr('srcset')) {
											$('.attesa-logo img').attr('srcset', $logoOnScroll);
										}
									}).fadeIn(125);
								}
							}
							$('body').addClass('menuMinor');
						} else if ($filter.hasClass('menuMinor') && $(window).scrollTop() <= 0) {
							$filter.removeClass('menuMinor');
							$('body').removeClass('menuMinor');
							$filter.css('margin-top', '0px');
							if ($('header#masthead').attr('data-logo-on-scroll')) {
								if ($logoOnScroll && $logoOriginal) {
									$('.attesa-logo img').fadeOut(125, function () {
										$('.attesa-logo img').attr('src', $logoOriginal);
										if ($('.attesa-logo img').attr('srcset')) {
											$('.attesa-logo img').attr('srcset', $logoOriginalSrcset);
										}
									}).fadeIn(125);
								}
							}
						}
					});
				}
			} else if ($('body').is('.headerFeatImage') && $('body').hasClass('withOverlayMenu')) {
				$('#masthead').addClass('relative');
				$('.attesaFeatBox').addClass('floatLeft');
				$('#content.site-content').addClass('clear');
				$('.attesaFeatBox').css('margin-top', '-' + $('.nav-middle').outerHeight() + 'px');
			} else if ($('body').is('.attesa-full-width') && $('body').hasClass('withOverlayMenu')) {
				$('#masthead').addClass('relative');
				$('body.attesa-full-width #content.site-content').css('top', '-' + $('.nav-middle').outerHeight() + 'px');
			}
		}
		function setMenuTitle() {
			var $middleleTopHeight = $('.nav-middle-top-title').outerHeight(),
				$menuTopHeight = $('.nav-middle').outerHeight(),
				$allTopDiv = $menuTopHeight + $middleleTopHeight;
			if ((!mobileDetect && $('#masthead').hasClass('withSticky')) || (mobileDetect && $('#masthead').hasClass('yesMobile'))) {
				$('.nav-middle.format_featuredtitle').addClass('mobileFixed');
				var $filter = $('#masthead'),
					$filterMenu = $('.nav-middle'),
					$filterTop = $('.nav-top'),
					$topHeight = $('.nav-top').outerHeight(),
					$filterSpacer = $('<div />', {
						'class': 'filter-drop-spacer',
						'height': $filterMenu.outerHeight()
					}),
					$filterSpacerTop = $('<div />', {
						'class': 'filter-drop-spacer-top',
						'height': $filterTop.outerHeight()
					}),
					$ifHeightTop = 0;
				if ($filter.hasClass('topbarscrollshow')) {
					$ifHeightTop = $topHeight;
				} else {
					$ifHeightTop = 0;
				}
				if ($('body').is('.headerFeatImage, .attesa-full-width')) {
					if ($('body').hasClass('withOverlayMenu')) {
						$('.attesaFeatBox, body.attesa-full-width #content.site-content').css('margin-top', '-' + $allTopDiv + 'px');
					}
				}
				if ($filterMenu.length) {
					$(window).scroll(function () {
						if ($filter.hasClass('topbarscrollshow') && $(window).scrollTop() > $filterTop.offset().top) {
							$filterTop.addClass('fixed');
							$filterTop.before($filterSpacerTop);
						} else if ($filter.hasClass('topbarscrollshow') && $(window).scrollTop() <= $filterSpacerTop.offset().top) {
							$filterSpacerTop.remove();
							$filterTop.removeClass('fixed');
						} else if (!$filter.hasClass('menuMinor') && $(window).scrollTop() + $ifHeightTop > $filterMenu.offset().top) {
							$filterMenu.addClass('fixed');
							if ($filter.hasClass('topbarscrollshow')) {
								$filterMenu.css('top', $topHeight + 'px');
							}
							$filterMenu.addClass('menuMinor');
							$filter.addClass('menuMinor');
							$filterMenu.before($filterSpacer);
						} else if ($filter.hasClass('menuMinor') && $(window).scrollTop() + $ifHeightTop <= $filterSpacer.offset().top) {
							$filterMenu.removeClass('fixed');
							$filterMenu.removeClass('menuMinor');
							$filter.removeClass('menuMinor');
							$filterSpacer.remove();
							$filterMenu.css('top', '0px');
						}
					});
				}
			} else if ($('body').is('.headerFeatImage, .attesa-full-width') && $('body').hasClass('withOverlayMenu')) {
				$('.attesaFeatBox, body.attesa-full-width #content.site-content').css('margin-top', '-' + $allTopDiv + 'px');
			}
		}
		if ($('.nav-middle-top-title').length) {
			setMenuTitle();
		} else {
			setMenu();
		}
		/* ----------------------------------------------------------------------------------- */
		/*  Set resize */
		/* ----------------------------------------------------------------------------------- */
		$(window).resize(function () {
			if ($('.nav-middle-top-title').length) {
				setMenuTitle();
			} else {
				setMenu();
			}
		});
	});
})(jQuery);
