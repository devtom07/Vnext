<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Vnext\ProductShippingMethod\Model\ProductShippingTotal;

class ProductShippingTotal extends \Magento\Quote\Model\Quote\Address\Total\AbstractTotal
{
    /**
     * Collect grand total address amount
     *
     * @param \Magento\Quote\Model\Quote $quote
     * @param \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment
     * @param \Magento\Quote\Model\Quote\Address\Total $total
     * @return $this
     */
    protected $quoteValidator = null;

    public function __construct(\Magento\Quote\Model\QuoteValidator $quoteValidator
    )
    {
        $this->quoteValidator = $quoteValidator;
    }
    public function collect(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
        \Magento\Quote\Model\Quote\Address\Total $total
    ) {
        parent::collect($quote, $shippingAssignment, $total);
        $quoteItems = $quote->getAllItems();
        $price = 0;
        foreach ($quoteItems as $item ){
            $product = $item->getProduct();
            $attr = $item->getProduct()->getCustomAttribute('shipping_fee');
            if ($attr && $attr->getValue()) {
                $price += $attr->getValue();
            }
        }
        $total->setGrandTotal($total->getGrandTotal() + $price);

        return $this;
    }


    /**
     * @param \Magento\Quote\Model\Quote $quote
     * @param Address\Total $total
     * @return array|null
     */
    /**
     * Assign subtotal amount and label to address object
     *
     * @param \Magento\Quote\Model\Quote $quote
     * @param Address\Total $total
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */

    public function fetch(\Magento\Quote\Model\Quote $quote, \Magento\Quote\Model\Quote\Address\Total $total)
    {
        $quoteItems = $quote->getAllItems();
        $total = 0;
        foreach ($quoteItems as $item ){
            $product = $item->getProduct();
            $attr = $item->getProduct()->getCustomAttribute('shipping_fee');
            if ($attr && $attr->getValue()) {
                $total += $attr->getValue();
            }
        }
        return [
            'code' => 'shipping-total',
            'value' => $total
        ];
    }
}
