define(
    [
        'jquery',
        'uiComponent',
        'Magento_Customer/js/customer-data'
    ],
    function ($, Component, customerData) {
        'use strict';
        return Component.extend({
            /** @inheritdoc */
            initialize: function () {
                this._super();
                customerData.reload(['current_weather'], true);
                this.customSection = customerData.get('current_weather');
            }
        });
    }
);
