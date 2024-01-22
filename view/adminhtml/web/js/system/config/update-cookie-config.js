define([
    'jquery',
    'jquery/ui'
], function ($) {
    'use strict';

    $.widget('axeptio.fetch_cookies', {
        options: {
            url: '',
            elementId: '',
            fieldMapping: ''
        },

        _create: function () {
            this._on({ 'click': $.proxy(this.connect, this)});
            this.bindEvents()
        },

        bindEvents: function () {
            window.dispatchEvent(new CustomEvent('check-project-id', {}));
            $(window).on('project-id-already-configured', () => {
                this.connect(true);
            })
        },

        getSavedValue: function () {
            return $('#axeptio_integration_main_settings_cookie_version').data('saved-value');
        },

        connect: function (projectIdAlreadyConfigured = false) {
            let params = this.buildParams();

            this.resetResultMessages();

            $.ajax({
                url: this.options.url,
                showLoader: true,
                data: params,
                headers: this.options.headers || {}
            }).done((response) => {
                let cookiesFetched = {}
                if (response['success']) {
                    cookiesFetched = response['cookies'] ?? {};
                }

                $(window).trigger('cookies-fetched', {
                    cookies: cookiesFetched,
                    savedValue: this.getSavedValue()
                });

                let resultElement = $('#' + response.result_type);
                if (resultElement.length > 0) {
                    resultElement.show();
                    if (response.result_message) {
                        resultElement.html(response.result_message)
                    }
                }
            });
        },

        resetResultMessages: function () {
            $('.call-result').hide();
        },

        buildParams: function () {
            let params = {};

            $.each(JSON.parse(this.options.fieldMapping), function (key, el) {
                params[key] = $('#' + el).val();
            });

            return params;
        }
    });

    return $.axeptio.fetch_cookies;
});
