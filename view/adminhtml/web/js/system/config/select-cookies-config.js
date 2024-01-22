define([
    'jquery',
    'jquery/ui'
], function ($) {
    'use strict';

    $.widget('axeptio.select_cookies', {
        options: {
            defaultCookieVersion: ''
        },

        _create: function () {
            this.bindEvents();
        },

        bindEvents: function () {
            $(window).on('cookies-fetched', (event, data) => {
                this.updateSelect(data.cookies || [], data.savedValue);
            });
        },

        updateSelect: function (cookies, savedValue) {
            this.element.find('option').each((index, item) => {
                if ($(item).attr('value') !== this.options.defaultCookieVersion) {
                    $(item).remove();
                }
            })

            for (const value in cookies) {
                this.element.append(this.buildSelectOptionHtml(value, cookies[value], savedValue));
            }
        },

        buildSelectOptionHtml: function(value, name, savedValue) {
            let selected = value === savedValue ? 'selected' : '';

            return `<option value="${value}" ${selected}>${name}</option>`;
        },
    });

    return $.axeptio.select_cookies;
});
