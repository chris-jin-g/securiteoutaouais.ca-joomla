/**
 * @package GiantLeapLab.TimeWorked
 * @subpackage com_timeworked
 * @version 1.3.2
 * @date January 18, 2019
 * @author Giant Leap Lab. http://www.giantleaplab.com
 * @copyright Copyright (c) 2014-2019 Giant Leap Lab
 * @license: Giant Leap Lab Proprietary Use License v1.0 http://timeworked4joomla.com/terms-and-conditions#software_license 2QFSEH59TLTKR57KWKN2TJ574BNWOT4H
 */
(function ($) {
	var systemNotificationContainer = '#system-message-container';

	$.TimeWorked = {
		/**
		 * Get parameter from url
		 * @param {string} uri
		 * @param {string} key url param
		 * @returns {string} parameter value
		 */
		getQueryStringParameter: function (uri, key) {
			var re = new RegExp(key + '=\.+', 'i'),
				uriArray = uri.split("&"),
				result;

			jQuery.each(uriArray, function (index, value) {
				if (value.match(re)) {
					result = value.split(key + '=')[1];
				}
			});

			return result;
		},

		/**
		 * Update parameter value in url
		 * @param {string} uri
		 * @param {string} key url param
		 * @param {string} value url param value
		 * @returns {string} modified url
		 */
		updateQueryStringParameter: function (uri, key, value) {
			var re = new RegExp('([?&])' + key + '=.*?(&|$)', 'i'),
				separator = uri.indexOf('?') !== -1 ? '&' : '?';

			if (uri.match(re)) {
				return uri.replace(re, '$1' + key + "=" + value + '$2');
			}
			else {
				return uri + separator + key + "=" + value;
			}
		},

		/**
		 * Remove parameter from url
		 * @param uri url
		 * @param key url key
		 * @returns string value
		 */
		removeQueryStringParameter: function (uri, key) {
			var re = new RegExp(key + '=.*?(&|$)', 'i');

			return uri.replace(re, '');
		},

		/**
		 * Get hostname
		 * @returns {string} hostname
		 */
		getHostname: function () {
			return location.protocol.concat("//").concat(window.location.hostname);
		},

		/**
		 * Update all chosen selectboxes on page
		 * @returns {$.TimeWorked}
		 */
		updateSelect: function () {
			(function ($) {
				$.each($('.chzn-done'), function (index, value) {
					$(value).trigger('liszt:updated');
				});
			})(jQuery);

			return this;
		},

		/**
		 * Capitalize first letter in string
		 * @param {string} string incoming text
		 * @returns {string} text with capitalized first letter
		 */
		capitaliseFirstLetter: function (string) {
			return string.charAt(0).toUpperCase() + string.slice(1);
		},

		/**
		 * Remove "selected style" from calendar and data table
		 * @returns {$.TimeWorked}
		 */
		clearSelectedDate: function () {
			(function ($) {
				$.each($('.clndr-table').find('.checked-date'), function (index, value) {
					$(this).removeClass('checked-date');
				});
				$.each($('#worklog-data').find('.checked-row'), function (index, value) {
					$(this).removeClass('checked-row').removeClass('info');
				});
			})(jQuery);

			return this;
		},

		dateFormats: {
			/**
			 * Moment.js pattern
			 */
			momentPattern: 'D MMM YYYY',

			/**
			 * Moment.js pattern for date with full month
			 */
			momentPatternFullMonth: 'D MMMM YYYY',

			/**
			 * MySQL pattern
			 */
			mysqlPattern: 'YYYY-MM-DD'
		},

		/**
		 * Moment.js language
		 */
		momentLang: '',

		/**
		 * Global variable for rejection plugin
		 */
		tmpRejected: [],

		/**
		 * Set message to notification block
		 * @param messageBlock inner message with <div/> wrapper
		 * @param type alert type from twitter bootstrap
		 * @param title header of message
		 * @returns {$.TimeWorked}
		 */
		addNotificationMessage: function (messageBlock, type, title) {
			var wrapper = $('<div/>').addClass('alert').addClass('alert-' + type)
				.append($('<a/>').addClass('close').attr('data-dismiss', 'alert').text('×'));

			if (title) {
				wrapper.append($('<h4/>').addClass('alert-heading').text($.i18n._(this.capitaliseFirstLetter(title))));
			}

			$(systemNotificationContainer).append(wrapper.append(messageBlock));

			return this;
		},

		/**
		 * Reset TimeWorked message container
		 * @returns {$.TimeWorked}
		 */
		resetMessageContainer: function () {
			$(systemNotificationContainer).text('');

			return this;
		},

		/**
		 * Show messages gathered in the JApplication object
		 * @returns {$.TimeWorked}
		 */
		addSystemMessages: function(messages) {
			if (messages) {
				$.each(messages, function(index, value) {
					var messageContainer = $('<div/>'),
						message = '';

					$.each(value, function (idx, val) {
						message += val + '<br/>';
					});

					messageContainer.append($('<p/>').html(message));
					$.TimeWorked.addNotificationMessage(messageContainer, index, index);
				});
			}

			return this;
		},

		/**
		 * Convert jQuery object to string
		 * @param {object} object jQuery object
		 * @returns {string} result string
		 */
		objectToString: function(object) {
			return object.clone().wrap('<p>').parent().html();
		},
        
        keepalive : function (refreshTime, msg) {
            var timer,
                $xhr,
                trigger = function() {
                    if ($xhr) {
                        $xhr.abort();
                    }
                    $xhr = $.get(TW_BASE_PATH + '/index.php?option=com_timeworked&view=keepalive');
                    $xhr.success(function(data){
                        if (data !== '1') {
                            $.TimeWorked.addNotificationMessage(msg, 'danger');
                            clearInterval(timer);
                        }
                    });
                };
                
            if (timer) {
                clearInterval(timer);
            }
            timer = setInterval(trigger, refreshTime);
        },
        
        dashboard : {
            drawGraphic : function(gData, days, selector) {
                var series = [],
                    $scope = $(selector).parent('.proj-graph-cont'),
                    active = null,
                    dayToDate = function(v){
                        var d = new Date();
                            d.setDate(d.getDate() - (days - v - 1));
                        return d.getDate() + ' ' + $.i18n._('month'+d.getMonth()) + ' ' + d.getFullYear();
                    },
                    secToTime = function(v) {
                        var h = Math.floor(v / 3600),
                            m = Math.floor(v % 3600 / 60);
                        return h + ':' + (m > 9 ? m : '0' + m);
                    },
                    generateTimeTicks = function(axis) {
                        var dy = 3600,
                            steps = Math.ceil(axis.datamax / dy) + 1,
                            ticks = [];
                        if (steps > 13) {
                            dy = dy * Math.ceil(steps / 12);
                            steps = Math.ceil(axis.datamax / dy) + 1;
                        }
                        for (var i = 1; i < steps; i ++) {
                            ticks.push([i*dy, secToTime(i*dy)]);
                        }
                        return ticks;
                    },
                    options = {
                        xaxis : {
                            tickFormatter : dayToDate,
                            min : 0,
                            max : days,
                            labelWidth : 42,
                            tickDecimals : 0
                        },
                        yaxis : {
                            ticks : generateTimeTicks,
                            labelWidth : 27
                        },
                        grid: {
                            hoverable: true,
                            borderWidth : {
                                top : 1,
                                bottom : 2,
                                left : 2,
                                right : 1
                            },
                            borderColor : {
                                top : '#ddd',
                                bottom : '#ddd',
                                left : '#ddd',
                                right : '#ddd'
                            }
                        },
                        selection: {
                            mode: "x"
                        },
                        legend : {
                            container: '.proj-graph-legend',
                            noColumns: 5,
                            labelFormatter : function(label, series) {
                                var checked = !active || active.indexOf(series.datasetId+'') !== -1 ? 'checked="checked"' : '';
                                return '<label><input type="checkbox" '+checked+' data-val="'+series.datasetId+'" />' + label +'</label>';
                            }
                        }
                    },
                    fillSeries = function() {
                        series = [];
                        if (gData) {
                            for (var i = 0; i < gData.length; i ++) {
                                var visible = !active || active.indexOf(i+'') !== -1,
                                    obj = {
                                        datasetId : i,
                                        data  : gData[i].data,
                                        label : gData[i].name,
                                        clickable : true,
                                        hoverable : true,
                                        points : {
                                            show : visible
                                        },
                                        lines : {
                                            show : visible
                                        }
                                    },
                                    color = typeof gData[i].color === 'string' ? gData[i].color.toLowerCase() : false;
                                if (color && color !== '#fff' && color !== '#ffffff') {
                                    obj.color = color;
                                }
                                series.push(obj);
                            }
                        }
                    };
                fillSeries();
                var plot = jQuery.plot(selector, series, options);
                var $showAll = $(selector).parent().find('.tw-graph-show-all');
                
                $(selector).bind("plotselected", function (event, ranges) {
                    $.each(plot.getXAxes(), function(_, axis) {
                        var opts = axis.options;
                        opts.min = ranges.xaxis.from;
                        opts.max = ranges.xaxis.to;
                    });
                    plot.setupGrid();
                    plot.draw();
                    plot.clearSelection();
                    $showAll.css({visibility: 'visible'});
                });

                $showAll.bind("click", function(){
                    $.each(plot.getXAxes(), function(_, axis) {
                        axis.options.min = 0;
                        axis.options.max = days;
                    });
                    plot.setupGrid();
                    plot.draw();
                    plot.clearSelection();
                    $showAll.css({visibility: 'hidden'});
                });
                
                var $tt = $('.tw-gr-tooltip').first();
                $(selector).bind("plothover", function (event, pos, item) {
                    if (item) {
                        var time = secToTime(~~item.datapoint[1]),
                            date = dayToDate(~~item.datapoint[0]),
                            html = '<span class="tw-gr-tt-project">' + item.series.label + '</span>'
                                 + '<span class="tw-gr-tt-date">' + date + '</span>'
                                 + '<span class="tw-gr-tt-time">' + time + '</span>';

                        $tt.html(html)
                           .css({
                                top: item.pageY+5, 
                                left: item.pageX+5, 
                                borderColor: item.series.color,
                                display: 'block'
                            });
                           
                    } else {
                        $tt.css('display', 'none');
                    }
                });
                var changeProjSelection = function() {
                    active = [];
                    $scope.find('.proj-graph-legend input').each(function(i,v){
                        if ($(v).is(':checked')) {
                            active.push($(v).data('val') + '');
                        }
                    });
                    fillSeries();
                    plot = jQuery.plot(selector, series, options);
                };
                $scope.find('.proj-graph-legend').on('change', 'input', changeProjSelection);
                
                $scope.on('click','.proj-graph-legend-controls .proj-select-all', function(){
                    if ($(this).hasClass('unsel')) {
                        $scope.find('.proj-graph-legend input').removeAttr('checked');
                    } else {
                        $scope.find('.proj-graph-legend input').attr('checked', 'checked');
                    }
                    changeProjSelection();
                });
            }
        }
	};
})(jQuery);
