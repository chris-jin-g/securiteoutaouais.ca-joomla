/**
 * @package GiantLeapLab.TimeWorked
 * @subpackage com_timeworked
 * @version 1.3.2
 * @date January 18, 2019
 * @author Giant Leap Lab. http://www.giantleaplab.com
 * @copyright Copyright (c) 2014-2019 Giant Leap Lab
 * @license: Giant Leap Lab Proprietary Use License v1.0 http://timeworked4joomla.com/terms-and-conditions#software_license 2QFSEH59TLTKR57KWKN2TJ574BNWOT4H
 *
 * HTML structure example:
 *
 * <div class="tw-slide-switcher">
 *     <i class="fa fa-arrow-circle-up"></i>
 *     <span class="not-link">Slider title</span>
 * </div>
 * <div class="tw-slide-up-down">
 *     slider content
 * </div>
 */
(function ($) {
	/**
	 * Initialize form slider
	 * @param {string} element
	 * @param {object} options
	 * @constructor
	 */
	var FormSlider = function (element, options) {
		this.element = $(element);
		this.cookiePrefix = '';
		this.cookieExpirationTime = 10 * 365;
		this.cookiePath = '/';
		this.cookieAttribute = 'id';
		this.slideElementSelector = '.tw-slide-up-down';
        this.hideElementSelector = '.tw-hide-on-slide-up';

		this.setOptions(options);

		this.cookieName = this.cookiePrefix + this.element.attr(this.cookieAttribute);
		this.cookieValue = $.cookie(this.cookieName);
		this.slideElement = $(this.element).siblings(this.slideElementSelector);
        this.elementsToHide = $(this.element).siblings(this.hideElementSelector);

		if (this.cookieValue === ''|| this.cookieValue == undefined) {
			this.cookieValue = 'opened';
			this.setCookie();
		}

		if (this.cookieValue === 'closed') {
			this.slideElement.hide();
            this.elementsToHide.hide();
			$(this.element).find('i').removeClass('fa-arrow-circle-up').addClass('fa-arrow-circle-down');
		}

		this.element.on('click.formSlider', $.proxy(this.slide, this));
	};

	FormSlider.prototype = {
		constructor: FormSlider,

		/**
		 * Set options
		 * @param {object} options
		 */
		setOptions: function (options) {
			if (typeof options.cookiePrefix === 'string') {
				this.cookiePrefix = options.cookiePrefix;
			}

			if (typeof options.cookieExpirationTime === 'string') {
				this.cookieExpirationTime = options.cookieExpirationTime;
			}

			if (typeof options.cookiePath === 'string') {
				this.cookiePath = options.cookiePath;
			}

			if (typeof options.cookieAttribute === 'string') {
				this.cookieAttribute = options.cookieAttribute;
			}

			if (typeof options.slideElementSelector === 'string') {
				this.slideElementSelector = options.slideElementSelector;
			}
		},

		/**
		 * Change form state
		 */
		slide: function () {
			if (this.cookieValue === 'closed') {
                this.slideDown();
            } else {
                this.slideUp();
            }
		},
        
        slideDown: function () {
            this.slideElement.slideDown();
            this.elementsToHide.show();
            this.cookieValue = 'opened';
            $(this.element).find('i').addClass('fa-arrow-circle-up').removeClass('fa-arrow-circle-down');
            this.setCookie();
        },
        
        slideUp: function () {
            this.slideElement.slideUp();
            this.elementsToHide.hide();
            this.cookieValue = 'closed';
            $(this.element).find('i').addClass('fa-arrow-circle-down').removeClass('fa-arrow-circle-up');
            this.setCookie();
        },

		/**
		 * Open form without changing state
         * @deprecated Not sure why do we need this
		 */
		forceOpen: function() {
			if (this.cookieValue === 'closed') {
				this.slideElement.slideDown();
                this.elementsToHide.show();
                this.cookieValue = 'opened';
			}
		},

		/**
		 * Close form according to form state
		 */
		easyClose: function() {
			if (this.cookieValue === 'closed') {
				this.slideElement.slideUp();
                this.elementsToHide.hide();
			}
		},

		/**
		 * Set form state to cookies
		 */
		setCookie: function () {
			$.cookie(this.cookieName, this.cookieValue, {expires: this.cookieExpirationTime, path: this.cookiePath});
		}
	};

	$.fn.formSlider = function (options) {
		this.each(function () {
			var el = $(this);

			if (el.data('formSlider')) {
				el.removeData('formSlider');
			}

			el.data('formSlider', new FormSlider(el, options));
		});

		return this;
	};
})(jQuery);
