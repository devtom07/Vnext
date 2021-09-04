define(
    [
        'uiComponent',
        'Magento_Chechout/js/model/payment/additional-validators',
        'Vnext_Checkout/js/model/checkout/order-comment-validators '
    ],
    function (Component, additionalValidator, commentValidator){
        'use strict';
        additionalValidator.registerValidator(commentValidator);
        return Component.extend({});
    }
)