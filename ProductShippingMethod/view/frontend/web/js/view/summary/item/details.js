
define(
    [
        'uiComponent'
    ],
    function (Component) {
        "use strict";
        var quoteItemData = window.checkoutConfig.quoteItemData;
        return Component.extend({
            defaults: {
                template: 'Vnext_ProductShippingMethod/summary/item/details'
            },
            quoteItemData: quoteItemData,
            getValue: function(quoteItem) {
                return quoteItem.name;
            },
            getShippingValue: function(quoteItem) {
                var item = this.getItem(quoteItem.item_id);
                if(item.shipping_fee){
                    return 'Shipping Fee: $'+parseInt(item.shipping_fee);
                }else{
                    return '';
                }
            },
            getItem: function(item_id) {
                var itemElement = null;
                _.each(this.quoteItemData, function(element, index) {
                    if (element.item_id == item_id) {
                        itemElement = element;
                    }
                });
                return itemElement;
            }
        });
    }
);
