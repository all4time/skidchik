$(document).ready(function () {
	$(".btn_donw").click(function () {
		$(".full").slideToggle();
	});

	$(".fancybox").fancybox({
		padding: 0,
	});

	$(".toggle_search").click(function () {
		$(this).toggleClass('active');
		$(".search_drop").slideToggle();
	});

	$(".lup, .hide").click(function () {
		$(".toggleSearch").slideToggle();
	});

	$(".open").click(function () {
		$(this).toggleClass('active')
		$(this).next(".dropdown").slideToggle();
	});

	$(window).scroll(function () {
		if ($(this).scrollTop() != 0) {
			$('.crp-button-up').fadeIn();
		} else {
			$('.crp-button-up').fadeOut();
		}
	});
	$('.crp-button-up').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 1500);
	});

	$('.top').on('click', function (e) {
		var $this = $(this);
		$this.parent('.accardion_item').toggleClass('active');
		$this.next('.full').slideToggle();
		$this.parent('.accardion_item').siblings('.accardion_item').removeClass('active').find('.full').slideUp();
		e.stopPropagation();
	});

	$('.slider_reviews').owlCarousel({
		autoplay: true,
		autoplayTimeout: 2700,
		nav: true,
		dots: true,
		loop: ($('.slider_reviews').children().length) == 1 ? false : true,
		margin: 30,
		responsive: {
			320: {
				items: 1
			},
			380: {
				items: 1
			},
			480: {
				items: 1
			},
			600: {
				items: 1
			},
			768: {
				items: 1
			},
			992: {
				items: 2
			},
			1024: {
				items: 2
			},
			1170: {
				items: 2
			},
			1366: {
				items: 2
			},
			1600: {
				items: 2
			},
			1920: {
				items: 2
			}
		}
	});

	$('.slider_reviews_in').owlCarousel({
		autoplay: true,
		autoplayTimeout: 2700,
		nav: true,
		loop: ($('.slider_reviews_in').children().length) == 1 ? false : true,
		dots: false,
		margin: 0,
		responsive: {
			320: {
				items: 1
			},
			380: {
				items: 1
			},
			480: {
				items: 1
			},
			1920: {
				items: 1
			}
		}
	});

	$('.slider_gallery').owlCarousel({
		autoplay: true,
		autoplayTimeout: 2700,
		nav: true,
		dots: false,
		loop: ($('.slider_gallery').children().length) == 1 ? false : true,
		margin: 10,
		responsive: {
			320: {
				items: 1
			},
			380: {
				items: 2
			},
			480: {
				items: 2
			},
			600: {
				items: 2
			},
			768: {
				items: 3
			},
			992: {
				items: 4
			},
			1024: {
				items: 4
			},
			1170: {
				items: 4
			},
			1366: {
				items: 4
			},
			1600: {
				items: 4
			},
			1920: {
				items: 4
			}
		}
	});


	$('.slider_partners').owlCarousel({
		autoplay: true,
		autoplayTimeout: 2700,
		nav: true,
		dots: false,
		loop: ($('.slider_partners').children().length) == 1 ? false : true,
		margin: 15,
		responsive: {
			320: {
				items: 1
			},
			380: {
				items: 1
			},
			480: {
				items: 2
			},
			600: {
				items: 2
			},
			768: {
				items: 2
			},
			992: {
				items: 3
			},
			1024: {
				items: 3
			},
			1170: {
				items: 4
			},
			1366: {
				items: 4
			},
			1600: {
				items: 4
			},
			1920: {
				items: 4
			}
		}
	});

	$('.slider_catalog').owlCarousel({
		autoplay: true,
		autoplayTimeout: 2700,
		nav: true,
		dots: false,
		loop: ($('.slider_catalog').children().length) == 1 ? false : true,
		margin: 15,
		responsive: {
			320: {
				items: 1
			},
			380: {
				items: 1
			},
			480: {
				items: 2
			},
			600: {
				items: 2
			},
			768: {
				items: 2
			},
			992: {
				items: 2
			},
			1024: {
				items: 2
			},
			1170: {
				items: 3
			},
			1366: {
				items: 3
			},
			1600: {
				items: 3
			},
			1920: {
				items: 3
			}
		}
	});


	$('.bxslider').bxSlider({
		auto: true,
		pager: true,
		controls: true,
		speed: arIncorp2Options['THEME']['BIGBANNER_SLIDESSHOWSPEED'],
		pause: arIncorp2Options['THEME']['BIGBANNER_ANIMATIONSPEED'],
	});

	$('.bxslider_2').bxSlider({
		auto: false,
		controls: false,
		adaptiveHeight: true,
		pagerCustom: '#bx-pager'
	});

	$('.bxslider_2_1').bxSlider({
		mode: 'horizontal',
		slideWidth: 90,
		minSlides: 1,
		maxSlides: 3,
		moveSlides: 1,
		slideMargin: 10,
		auto: false,
		pager: false
	});


	$(window).scroll(function () {
		if (arIncorp2Options['THEME']['HEADER_FIXED'] === 'Y') {
			if ($(window).scrollTop() > 280) {
				$('.header').addClass('sticky').animate({
					top: 0
				});
				$(".header").removeClass('nosticky');
				$("body").addClass('active');
			} else {
				$('.header').removeClass('sticky').clearQueue().animate({
					top: "-280px"
				}, 0);
				$(".header").addClass('nosticky');
				$("body").removeClass('active');
			}
		}
	});
	$('ul.tabs_caption').on('click', 'li:not(.active)', function () {
		$(this)
			.addClass('active').siblings().removeClass('active')
			.closest('div.tabs').find('div.tabs_content').removeClass('active').eq($(this).index()).addClass('active');
	});

	$('#bx-pager').on('click', 'a:not(.active)', function () {
		$(this).addClass('active').siblings().removeClass('active');
	});

	$('select.sort').on('change', function () {
		location.href = $(this).val();
	});
});

$(document).on('click', '.thank_close', function (e) {
	$(".thank").hide();
});

var ww = screen.width;

$(document).ready(function () {
	$(".nav li a").each(function () {
		if ($(this).next().length > 0) {
			$(this).addClass("parent");
		};
	})

	$(".toggleMenu").click(function (e) {
		if (arIncorp2Options['THEME']['MOBILE_MENU'] == "TYPE_2") {
			e.preventDefault();
			$(".mobile_menu_container").addClass("loaded");
			$(".mobile_menu_overlay").fadeIn();
		} else {
			e.preventDefault();
			$(this).toggleClass("active");
			$(".nav").toggle();
		};
	});

	adjustMenu();
	// resize

	$(window).on("load resize", function () {
		var maxHeight = 0;
		$(".services .items").find(".item").height("auto").each(function () {
			if ($(this).height() > maxHeight) {
				maxHeight = ($(this).height());
			}
		}).height(maxHeight);
	});
	$(window).on("load resize", function () {
		var maxHeight = 0;
		$(".catalog_list .items").find(".item").height("auto").each(function () {
			if ($(this).height() > maxHeight) {
				maxHeight = ($(this).height());
			}
		}).height(maxHeight);
	});
	$(window).on("load resize", function () {
		var maxHeight = 0;
		$(".catalog_list.line .items").find(".item").height("auto").each(function () {
			if ($(this).height() > maxHeight) {
				maxHeight = ($(this).height());
			}
		}).height(maxHeight);
	});

	var bLazy = new Blazy({
		success: function (element) {
			resizeBlockCatalog();
		}
	});

	// forms
	$('*[data-event="jqm"]').jqmEx();

	$.extend($.validator.messages, {
		required: BX.message('JS_REQUIRED'),
		email: BX.message('JS_FORMAT'),
		equalTo: BX.message('JS_PASSWORD_COPY'),
		minlength: BX.message('JS_PASSWORD_LENGTH'),
		remote: BX.message('JS_ERROR')
	});

	$.validator.addMethod(
		'regexp',
		function (value, element, regexp) {
			var re = new RegExp(regexp);
			return this.optional(element) || re.test(value);
		},
		BX.message('JS_FORMAT')
	);

	$.validator.addMethod(
		'date',
		function (value, element, param) {
			var status = false;
			if (!value || value.length <= 0) {
				status = true;
			} else {
				var re = new RegExp('^([0-9]{2})(.)([0-9]{2})(.)([0-9]{4})$');
				var matches = re.exec(value);
				if (matches) {
					var composedDate = new Date(matches[5], (matches[3] - 1), matches[1]);
					status = ((composedDate.getMonth() == (matches[3] - 1)) && (composedDate.getDate() == matches[1]) && (composedDate.getFullYear() == matches[5]));
				}
			}
			return status;
		}, BX.message('JS_DATE')
	);

	$.validator.addMethod(
		'datetime',
		function (value, element, param) {
			var status = false;
			if (!value || value.length <= 0) {
				status = true;
			} else {
				var re = new RegExp('^([0-9]{2})(.)([0-9]{2})(.)([0-9]{4}) ([0-9]{1,2}):([0-9]{1,2})$');
				var matches = re.exec(value);
				if (matches) {
					var composedDate = new Date(matches[5], (matches[3] - 1), matches[1], matches[6], matches[7]);
					status = ((composedDate.getMonth() == (matches[3] - 1)) && (composedDate.getDate() == matches[1]) && (composedDate.getFullYear() == matches[5]) && (composedDate.getHours() == matches[6]) && (composedDate.getMinutes() == matches[7]));
				}
			}
			return status;
		}, BX.message('JS_DATETIME')
	);

	$.validator.addMethod(
		'extension',
		function (value, element, param) {
			param = typeof param === 'string' ? param.replace(/,/g, '|') : 'png|jpe?g|gif';
			return this.optional(element) || value.match(new RegExp('.(' + param + ')$', 'i'));
		}, BX.message('JS_FILE_EXT')
	);

	$.validator.addMethod(
		'captcha',
		function (value, element, params) {
			return $.validator.methods.remote.call(this, value, element, {
				url: arIncorp2Options['SITE_DIR'] + 'ajax/check-captcha.php',
				type: 'post',
				data: {
					captcha_word: value,
					captcha_sid: function () {
						return $(element).closest('form').find('input[name="captcha_sid"]').val();
					}
				}
			});
		},
		BX.message('JS_ERROR')
	);

	// capcha
	$('body').on('click', '.refresh', function (e) {
		e.preventDefault();
		$.ajax({
			url: arIncorp2Options['SITE_DIR'] + 'ajax/captcha.php'
		}).done(function (text) {
			$('.captcha_sid').val(text);
			$('.captcha_img').attr('src', '/bitrix/tools/captcha.php?captcha_sid=' + text);
		});
	});

	$.validator.addMethod(
		'recaptcha',
		function (value, element, param) {
			var id = $(element).closest('form').find('.g-recaptcha').attr('data-widgetid');
			if (typeof id !== 'undefined') {
				return grecaptcha.getResponse(id) != '';
			} else {
				return true;
			}
		}, BX.message('JS_RECAPTCHA_ERROR')
	);

	$.validator.addMethod(
		'processing_approval',
		function (value, element, param) {
			return $(element).is(':checked');
		}, BX.message('JS_PROCESSING_ERROR')
	);

	$.validator.addClassRules({
		'phone': {
			regexp: arIncorp2Options['THEME']['VALIDATE_PHONE_MASK']
		},
		'confirm_password': {
			equalTo: 'input[name="REGISTER\[PASSWORD\]"]',
			minlength: 6
		},
		'password': {
			minlength: 6
		},
		'datetime': {
			datetime: ''
		},
		'captcha': {
			captcha: ''
		},
		'recaptcha': {
			recaptcha: ''
		},
		'processing_approval': {
			processing_approval: ''
		}
	});

});

$(window).bind('resize orientationchange', function () {
	ww = document.body.clientWidth;
	adjustMenu();
});

var adjustMenu = function () {
	if (ww < 992) {
		$(".toggleMenu").css("display", "inline-block");
		if (!$(".toggleMenu").hasClass("active")) {
			$(".nav").hide();
		} else {
			$(".nav").show();
		}


		$(".nav li").unbind('mouseenter mouseleave');
		$(".nav li a.parent").unbind('click').bind('click', function (e) {
			// must be attached to anchor element to prevent bubbling
			e.preventDefault();
			$(this).parent("li").toggleClass("hover");
		});
	} else if (ww >= 992) {
		//$(".toggleMenu").css("display", "none");
		//$(".nav").show();
		$(".nav li").removeClass("hover");
		$(".nav li a").unbind('click');
		$(".nav li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function () {
			// must be attached to li so that mouseleave is not triggered when hover over submenu
			$(this).toggleClass('hover');
		});
	}
};
HideOverlay = function () {
	$('.jqmOverlay').detach();
};
ShowOverlay = function () {
	$('<div class="jqmOverlay waiting"></div>').appendTo('body');
};

// Forms
function onLoadjqm(hash) {
	var name = $(hash.t).data('name'),
		top = (($(window).height() > hash.w.height()) ? Math.floor(($(window).height() - hash.w.height()) / 2) : 0) + 'px';
	$.each($(hash.t).get(0).attributes, function (index, attr) {
		if (/^data\-autoload\-(.+)$/.test(attr.nodeName)) {
			var key = attr.nodeName.match(/^data\-autoload\-(.+)$/)[1];
			var el = $('input[name="' + key.toUpperCase() + '"]');
			el.val($(hash.t).data('autoload-' + key)).attr('readonly', 'readonly');
			el.attr('title', el.val());
		}
	});
	if ($(hash.t).data('autohide')) {
		$(hash.w).data('autohide', $(hash.t).data('autohide'));
	}
	if (name == 'order_product') {
		if ($(hash.t).data('product')) {
			$('input[name="PRODUCT"]').val($(hash.t).data('product')).attr('readonly', 'readonly').attr('title', $('input[name="PRODUCT"]').val());
		}
	}
	if (name == 'question') {
		if ($(hash.t).data('product')) {
			$('input[name="NEED_PRODUCT"]').val($(hash.t).data('product')).attr('readonly', 'readonly').attr('title', $('input[name="NEED_PRODUCT"]').val());
		}
	}
	if ($(hash.t).data('scroll')) {
		if ($(hash.w).parent().hasClass('jqmWindowOut')) {
			$(hash.w).parent().show();
		} else {
			$(hash.w).wrap('<div class="jqmWindowOut"></div>');
		}
		$('body').css('overflow', 'hidden');

		$('.jqmWindowOut').on('click', function (e) {
			if ($(e.toElement).hasClass('jqmWindowOut')) {
				$(this).find('.jqmClose').click();
			}
		});
	}
	hash.w.addClass('show').css({
		'margin-left': '-' + Math.floor(hash.w.width() / 2) + 'px',
		'top': top,
		'opacity': 1,
		'width': hash.w.width()
	});
	$('body,html').animate({
		scrollTop: 0
	}, 800);

}

function onHide(hash) {
	if ($(hash.w).data('autohide')) {
		eval($(hash.w).data('autohide'));
	}
	hash.w.css('opacity', 0).removeClass('show');
	hash.o.remove();
	setTimeout(function () {
		hash.w.empty();
	}, 200);
}

$.fn.jqmEx = function () {
	$(this).each(function () {
		var _this = $(this);
		var name = _this.data('name');

		if (name.length) {
			var script = arIncorp2Options['SITE_DIR'] + 'ajax/form.php';
			var paramsStr = '';
			var trigger = '';
			var arTriggerAttrs = {};
			$.each(_this.get(0).attributes, function (index, attr) {
				var attrName = attr.nodeName;
				var attrValue = _this.attr(attrName);
				trigger += '[' + attrName + '=\"' + attrValue + '\"]';
				arTriggerAttrs[attrName] = attrValue;
				if (/^data\-param\-(.+)$/.test(attrName)) {
					var key = attrName.match(/^data\-param\-(.+)$/)[1];
					paramsStr += key + '=' + attrValue + '&';
				}
			});

			var triggerAttrs = JSON.stringify(arTriggerAttrs);
			var encTriggerAttrs = encodeURIComponent(triggerAttrs);
			script += '?' + paramsStr + 'data-trigger=' + encTriggerAttrs;

			if (!$('.' + name + '_frame[data-trigger="' + encTriggerAttrs + '"]').length) {
				if (_this.attr('disabled') != 'disabled') {
					$('body').find('.' + name + '_frame[data-trigger="' + encTriggerAttrs + '"]').remove();
					$('body').append('<div class="' + name + '_frame jqmWindow" style="width:500px" data-trigger="' + encTriggerAttrs + '"></div>');
					$('.' + name + '_frame[data-trigger="' + encTriggerAttrs + '"]').jqm({
						trigger: trigger,
						onLoad: function (hash) {
							onLoadjqm(hash);
						},
						onHide: function (hash) {
							onHide(hash);
						},
						ajax: script
					});
				}
			}
		}
	});
}

// BASKET
var setBasketItemsClasses = function () {
	if (typeof (arBasketItems) !== 'undefined' && Object.keys(arBasketItems).length) {
		for (var key in arBasketItems) {
			$('[data-item]').each(function () {
				if ($(this).data('item').ID == key) {
					$(this).find('.buy_block').addClass('in');
				}
			});
		}
	}
}

var number_format = function (number, decimals, dec_point, thousands_sep) {
	number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
	var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
		s = '',
		toFixedFix = function (n, prec) {
			var k = Math.pow(10, prec);
			return '' + (Math.round(n * k) / k).toFixed(prec);
		};

	s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');

	if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	}

	if ((s[1] || '')
		.length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1).join('0');
	}

	return s.join(dec);
}

var Summ = function (el, counterInputValueNew, price) {
	if (counterInputValueNew <= 0) {
		counterInputValueNew = 1;
	}
	var summ = number_format(counterInputValueNew * price, 0, '.', ' ');
	var allSumm = 0;
	el.closest('.items').find('.item').each(function () {
		var $this = $(this),
			price = parseFloat($this.find('input[name=PRICE]').val()),
			count = parseFloat($this.find('input.count').val());
		if (count <= 0) {
			count = 1;
		}
		if (!isNaN(price) && !isNaN(count)) {
			allSumm += count * price;
		}
	});
	allSumm = number_format(parseFloat(allSumm), 0, '.', ' ');
	el.closest('.item').find('.summ .price_val').text(summ);
	el.closest('.basket').find('.foot .total>span').text(allSumm);
}

var timerBasketUpdate = false;
var BasketCounter = function (el) {
	var bClassMinus = (el.hasClass('minus')),
		bClassPlus = (el.hasClass('plus')),
		bClassCount = (el.hasClass('count')),
		$buyBlock = el.closest('.buy_block'),
		$counterInput = el.closest('.counter').find('input.count'),
		counterInputValue = parseFloat($.trim($counterInput.val())),
		price = parseFloat($buyBlock.find('input[name=PRICE]').val()),
		bAjax = (el.closest('.basket').length ? true : false);

	// class minus button
	if (bClassMinus) {
		var counterInputValueNew = counterInputValue - 1;
		if (counterInputValueNew <= 0) {
			counterInputValueNew = 1;
		}
		$counterInput.val(counterInputValueNew);
		if (bAjax) {
			Summ(el, counterInputValueNew, price);
			if (timerBasketUpdate) {
				clearTimeout(timerBasketUpdate);
				timerBasketUpdate = false;
			}
			timerBasketUpdate = setTimeout(function () {
				BasketUpdate(el, counterInputValueNew);
				timerBasketUpdate = false;
			}, 700);
		}
	}
	// class plus button
	else if (bClassPlus) {
		var counterInputValueNew = counterInputValue + 1;
		var counterInputMaxCount = Math.pow(10, parseInt($counterInput.attr('maxlength'))) - 1;
		if (counterInputValueNew > counterInputMaxCount) {
			counterInputValueNew = counterInputMaxCount;
		}
		$counterInput.val(counterInputValueNew);
		if (bAjax) {
			Summ(el, counterInputValueNew, price);
			if (timerBasketUpdate) {
				clearTimeout(timerBasketUpdate);
				timerBasketUpdate = false;
			}
			timerBasketUpdate = setTimeout(function () {
				BasketUpdate(el, counterInputValueNew);
				timerBasketUpdate = false;
			}, 700);
		}
	}
	// class input
	else if (bClassCount) {
		var counterInputValueNew = counterInputValue;
		if (counterInputValueNew <= 0 || isNaN(counterInputValueNew)) {
			counterInputValueNew = 1;
		}
		el.val(counterInputValueNew);
		if (bAjax) {
			BasketUpdate(el, counterInputValueNew);
		}
	}

	var getCurUri = $.trim($('input[name=getCurUri]').val());
	if (!getCurUri && !el.closest('.basket.fly').length) {
		$buyBlock.find('.to_cart').data('quantity', counterInputValueNew);
	}
}

var BasketUpdate = function (el, counterInputValueNew) {
	var itemData = el.closest('[data-item]').data('item'),
		itemData = (typeof (arBasketItems) === 'object' && typeof (arBasketItems[itemData.ID]) === 'object' ? arBasketItems[itemData.ID] : itemData),
		$buyBlock = el.closest('.buy_block'),
		scrollTop = ($('.basket.fly').length ? $('.basket.fly .items_wrap').scrollTop() : ($('.basket_top:visible').length ? $('.basket_top .items:visible').scrollTop() : ''));

	if (typeof (itemData) != 'undefined' && !isNaN(itemData.ID) && itemData.ID > 0 && !$buyBlock.hasClass('loading')) {
		$.ajax({
			url: arIncorp2Options['SITE_DIR'] + 'ajax/basket_items.php',
			data: {
				itemData: itemData,
				quantity: counterInputValueNew
			},
			beforeSend: function () {
				$buyBlock.addClass('loading');
			},
			complete: function () {
				$buyBlock.removeClass('loading');
			},
			success: function (data) {
				if (typeof (data) === 'object') {
					arBasketItems = data;
				}

				var getCurUri = $.trim($('input[name=getCurUri]').val());

				if (typeof (arIncorp2Options['THEME']['ORDER_BASKET_VIEW']) !== 'undefined' && arIncorp2Options['THEME']['ORDER_BASKET_VIEW'] === 'HEADER' && $('.basket_top').length) {
					$.ajax({
						url: arIncorp2Options['SITE_DIR'] + 'ajax/basket_items.php',
						type: 'POST',
						beforeSend: function () {
							$buyBlock.addClass('loading');
						},
						complete: function () {
							$buyBlock.removeClass('loading');
						},
						success: function (html) {
							$buyBlock.removeClass('in');

							$('.ajax_basket').html(html);
							$('.basket_top .items').scrollTop(scrollTop);

							if (!getCurUri) {
								setTimeout(function () {
									$('.basket_top .dropdown').addClass('expanded');
								}, basketShowDelay);

								setTimeout(function () {
									$('.basket_top .dropdown').removeClass('expanded');
								}, basketHideDelay);
							}
						}
					});
				}

				if (typeof (arIncorp2Options['THEME']['ORDER_BASKET_VIEW']) !== 'undefined' && arIncorp2Options['THEME']['ORDER_BASKET_VIEW'] === 'FLY' && $('.basket.fly').length) {
					$.ajax({
						url: arIncorp2Options['SITE_DIR'] + 'ajax/basket_items.php',
						type: 'POST',
						beforeSend: function () {
							$buyBlock.addClass('loading');
						},
						complete: function () {
							$buyBlock.removeClass('loading');
						},
						success: function (html) {
							$('.ajax_basket').html(html);
							$('.basket.fly .items_wrap').scrollTop(scrollTop);
						}
					});
				}

				if (getCurUri) {
					$.ajax({
						url: getCurUri,
						type: 'POST',
						beforeSend: function () {
							$buyBlock.addClass('loading');
						},
						complete: function () {
							$buyBlock.removeClass('loading');
						},
						success: function (html) {
							if ($('.basket.default').length) {
								$('.basket.default').html($(html).find('#cart'));
							}
						}

					});
				}
			}
		});
	}
}

$(document).ready(function () {
	$('*[data-event="jqm"]').jqmEx();

	$(document).on('click', '.minus, .plus', function (e) {
		e.stopPropagation();
		BasketCounter($(this));
	});

	var basketShowDelay = 100;
	var basketHideDelay = 1000;


	// Add2Basket
	$(document).on('click', '.to_cart', function (e) {
		e.stopPropagation();

		var $item = $(this).closest('[data-item]'),
			$buyBlock = $item.find('.buy_block'),
			itemData = $item.data('item'),
			itemQuantity = parseFloat($buyBlock.find('.to_cart').data('quantity'));

		if (isNaN(itemQuantity) || itemQuantity <= 0) {
			itemQuantity = 1;
		}

		if (!isNaN(itemData.ID) && parseInt(itemData.ID) > 0 && !$buyBlock.hasClass('loading')) {
			$.ajax({
				url: arIncorp2Options['SITE_DIR'] + 'ajax/basket_items.php',
				type: 'POST',
				data: {
					itemData: itemData,
					quantity: itemQuantity
				},
				beforeSend: function () {
					$buyBlock.addClass('loading');
				},
				complete: function () {
					$buyBlock.removeClass('loading');
				},
				success: function (html) {
					$buyBlock.addClass('in');

					var countItem = ($('.basket').length ? parseInt($('.basket .count').text()) : parseInt($('.basket_top:visible .count').text()));
					++countItem;
					$('.basket_top .count, .basket .count').text(countItem).removeClass('empted');
					$('.ajax_basket').html(html);

					if (arIncorp2Options['THEME']['USE_SALE_GOALS'] !== 'N') {
						var eventdata = {
							goal: 'goal_basket_add',
							params: {
								itemData: itemData,
								quantity: itemQuantity
							}
						};
						BX.onCustomEvent('onCounterGoals', [eventdata]);
					}

					if (typeof (arIncorp2Options['THEME']['ORDER_BASKET_VIEW']) !== 'undefined' && $.trim(arIncorp2Options['THEME']['ORDER_BASKET_VIEW']) === 'HEADER' && $('.basket_top').length) {
						if (!$('.basket_top .dropdown').hasClass('expanded')) {
							setTimeout(function () {
								$('.basket_top .dropdown').addClass('expanded');
							}, basketShowDelay);
							setTimeout(function () {
								$('.basket_top .dropdown').removeClass('expanded');
							}, basketHideDelay);
						}
					} else if (typeof (arIncorp2Options['THEME']['ORDER_BASKET_VIEW']) !== 'undefined' && $.trim(arIncorp2Options['THEME']['ORDER_BASKET_VIEW']) === 'FLY' && $('.basket.fly').length) {
						setTimeout(function () {
							if (!$('.ajax_basket').hasClass('opened')) {
								$('.ajax_basket').addClass('opened');
							}
						}, basketShowDelay);
					}
				}
			});
		}
	});

	// remove from basket
	$(document).on('click', '.remove', function () {
		var $item = $(this).closest('[data-item]'),
			$buyBlock = $item.find('.buy_block'),
			itemData = $item.data('item'),
			bRemove = 'Y',
			bRemoveAll = ($.trim($(this).closest('[data-remove_all]').data('remove_all')) === 'Y' ? 'Y' : false);
		countItem = ($('.basket').length ? parseInt($('.basket .item').length) : parseInt($('.basket_top:visible .item').length)),
			bOneItem = (countItem - 1 <= 0),
			scrollTop = ($('.basket.fly').length ? $('.basket.fly .items_wrap').scrollTop() : ($('.basket_top:visible').length ? $('.basket_top .items:visible').scrollTop() : ''));

		var _ajax = function () {
			$.ajax({
				url: arIncorp2Options['SITE_DIR'] + 'ajax/basket_items.php',
				data: {
					itemData: itemData,
					remove: bRemove,
					removeAll: bRemoveAll
				},
				beforeSend: function () {
					$buyBlock.addClass('loading');
				},
				complete: function () {
					$buyBlock.removeClass('loading');
				},
				success: function (html) {
					if (bRemoveAll) {
						$('.buy_block').removeClass('in');
						$('.basket .count, .basket_top .count').text(0).addClass('empted');
					} else {
						$('[data-item]').each(function () {
							if ($(this).data('item').ID == itemData.ID) {
								$(this).find('.buy_block').removeClass('in');
							}
						});

						var countItem = ($('.basket').length ? parseInt($('.basket .count').text()) : parseInt($('.basket_top:visible .count').text()));
						--countItem;
						$('.basket .count, .basket_top .count').text(countItem);
						if (!countItem) {
							$('.basket .count, .basket_top .count').addClass('empted');
						}
					}

					$('.ajax_basket').html(html);

					if (typeof (arIncorp2Options['THEME']['ORDER_BASKET_VIEW']) !== 'undefined' && $.trim(arIncorp2Options['THEME']['ORDER_BASKET_VIEW']) === 'HEADER' && $('.basket_top').length) {
						$('.basket_top .items').scrollTop(scrollTop);
					}

					if (typeof (arIncorp2Options['THEME']['ORDER_BASKET_VIEW']) !== 'undefined' && $.trim(arIncorp2Options['THEME']['ORDER_BASKET_VIEW']) === 'FLY' && $('.basket.fly').length) {
						$('.ajax_basket').addClass('opened');
						$('.basket.fly .items_wrap').scrollTop(scrollTop);
					}

					if (arIncorp2Options['THEME']['USE_SALE_GOALS'] !== 'N') {
						var eventdata = {
							goal: 'goal_basket_remove',
							params: {
								itemData: itemData,
								remove: bRemove,
								removeAll: bRemoveAll
							}
						};
						BX.onCustomEvent('onCounterGoals', [eventdata]);
					}

					var getCurUri = $.trim($('input[name=getCurUri]').val());
					if (getCurUri) {
						$.ajax({
							url: getCurUri,
							type: 'POST',
							beforeSend: function () {
								$buyBlock.addClass('loading');
							},
							complete: function () {
								$buyBlock.removeClass('loading');
							},
							success: function (html) {
								if ($('.basket.default').length) {
									$('.basket.default').html($(html).find('#cart'));
								}
							}
						});
					}

				}
			});
		}

		if (bRemoveAll || (typeof (itemData) !== 'undefined' && (!isNaN(itemData.ID) && itemData.ID > 0) && !$buyBlock.hasClass('loading'))) {
			if (bRemoveAll) {
				$('.basket_wrap').fadeOut(200, function () {
					$('.basket').find('.basket_empty').fadeIn(200, function () {
						_ajax();
					});
				});
			} else {
				if (bOneItem) {
					if ($item.closest('.basket_top').length) {
						$item.closest('.dropdown').animate({
							opacity: 0
						}, 200, function () {
							_ajax();
						});
					} else {
						$item.closest('.basket_wrap').fadeOut(200, function () {
							$item.closest('.basket').find('.basket_empty').fadeIn(200, function () {
								_ajax();
							});
						});
					}
				} else {
					$item.animate({
						opacity: 0
					}, 200).slideUp(200, function () {
						_ajax();
					});
				}
			}
		}
	});
});

var waitCounter = function (idCounter, delay, callback) {
	var obCounter = window['yaCounter' + idCounter];
	if (typeof obCounter == 'object') {
		if (typeof callback == 'function') {
			callback();
		}
	} else {
		setTimeout(function () {
			waitCounter(idCounter, delay, callback);
		}, delay);
	}
}

BX.addCustomEvent('onCounterGoals', function (eventdata) {
	if (arIncorp2Options['THEME']['YA_GOLAS'] === 'Y') {
		var idCounter = arIncorp2Options['THEME']['YA_COUNTER_ID'];
		idCounter = parseInt(idCounter);

		if (typeof eventdata != 'object') {
			eventdata = {
				goal: 'undefined'
			};
		}
		if (typeof eventdata.goal != 'string') {
			eventdata.goal = 'undefined';
		}

		if (idCounter) {
			try {
				waitCounter(idCounter, 50, function () {
					var obCounter = window['yaCounter' + idCounter];
					if (typeof obCounter == 'object') {
						obCounter.reachGoal(eventdata.goal);
					}
				});
			} catch (e) {
				console.error(e)
			}
		} else {
			console.info('Bad counter id!', idCounter);
		}
	}
});
var waitReCaptcha = function (delay, callback) {
	if (typeof grecaptcha == 'object' && typeof grecaptcha.render === 'function') {
		if (typeof callback == 'function') {
			callback();
		}
	} else {
		setTimeout(function () {
			waitReCaptcha(delay, callback);
		}, delay);
	}
}

var reCaptchaRender = function (response) {
	if ($('.g-recaptcha:not(.rendered)').length) {
		waitReCaptcha(50, function () {
			$('.g-recaptcha:not(.rendered)').each(function () {
				$this = $(this);
				$this.addClass('rendered')
				var id = grecaptcha.render($this[0], {
					sitekey: $this.attr('data-sitekey'),
					theme: $this.attr('data-theme'),
					size: $this.attr('data-size'),
					callback: $this.attr('data-callback'),
				});
				$this.attr('data-widgetid', id);

			});
		});
	}
}

var reCaptchaVerify = function (response) {
	$('.g-recaptcha.rendered').each(function () {
		var id = $(this).attr('data-widgetid');
		if (typeof (id) !== 'undefined') {
			if (grecaptcha.getResponse(id) != '') {
				$(this).closest('form').find('.recaptcha').valid();
			}
		}
	});
}

$(document).ready(function () {
	$('.filter-action').on('click', function () {
		$(this).toggleClass('active');
		$(this).find('.svg').toggleClass('white');
		if ($('.introtext').length) {
			var top_pos = $('.filters-wrap').position();
			$('.bx-filter').css({
				'top': top_pos.top + 40
			});
		}
		$('.bx-filter').slideToggle();
	});
});

// Only mobile
$(function () {
	if ($(window).width() < 991) {
		$('.filter_mob').append($('.bx-filter'));
	}
});

function resizeBlockCatalog() {
	var maxHeight = 0;
	$(".catalog_list .items").find(".item").height("auto").each(function () {
		if ($(this).height() > maxHeight) {
			maxHeight = ($(this).height());
		}
	}).height(maxHeight);
}

$(function () {
	$(document).on("click", ".mobile_menu_container .parent", function (e) {
		e.preventDefault();
		$(".mobile_menu_container .activity").removeClass("activity");
		$(this).siblings("ul").addClass("loaded").addClass("activity color");
	});
	$(document).on("click", ".mobile_menu_container .back", function (e) {
		e.preventDefault();
		$(".mobile_menu_container .activity").removeClass("activity");
		$(this).parent().parent().removeClass("loaded");
		$(this).parent().parent().parent().parent().addClass("activity");
	});
	$(document).on("click", ".mobile_menu_overlay", function (e) {
		$(".mobile_menu_container").removeClass("loaded");
		$(this).fadeOut(function () {
			$(".mobile_menu_container .loaded").removeClass("loaded");
			$(".mobile_menu_container .activity").removeClass("activity");
		});
	});
});