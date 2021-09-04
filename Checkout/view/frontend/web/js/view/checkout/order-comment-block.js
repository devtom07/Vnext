define(
    [
        'jquery',
        'uiComponent'
    ],
    function ($,component) {
        'use strict';
        return component.extend({
            defaults:{
                template: 'Vnext_Checkout/checkout/order-comment-block'
            }
        });
    }
);