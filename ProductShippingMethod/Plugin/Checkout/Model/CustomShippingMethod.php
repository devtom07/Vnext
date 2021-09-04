<?php
namespace Vnext\ProductShippingMethod\Plugin\Checkout\Model;

class CustomShippingMethod
{
    public function __construct()
    {
    }
    public function afterGetAvailableMethods(
        \Magento\Payment\Model\MethodList $subject,
                                          $availableMethods,
        \Magento\Quote\Api\Data\CartInterface $quote = null
    )
    {


    }
}