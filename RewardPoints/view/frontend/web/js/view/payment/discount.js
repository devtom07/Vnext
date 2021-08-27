define([
        'ko',
        'uiComponent',
        'mage/url',
        'mage/storage',
        'Magento_Customer/js/model/customer',
        'Magento_Ui/js/model/messageList',
    ],
    function (ko, Component, urlBuilder, storage, customer,messageList) {
        'use strict';
        var check = customer.isLoggedIn()
        return Component.extend({

            defaults: {
                template: 'Vnext_RewardPoints/payment/discount'
            },
            /** @inheritdoc */
            initialize: function () {
                this._super();
                return this;
            },
            getKeyword: function () {
                var self = this;
                var serviceUrl = urlBuilder.build('rewardpoints/ajax/index');
                var data = document.getElementById('search-example').value;
                return storage.post(
                    serviceUrl,
                    JSON.stringify({'keyword': data}),
                    false
                ).done(function (response) {
                    window.location.reload();
                    alert(response.keyword);
                    }

                ).fail(function (response) {
                    // code khi fail
                });
            },
            isLoggedIn: function () {
                return customer.isLoggedIn();
            }
        });
    }
);

