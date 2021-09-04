<?php
namespace Vnext\Training\Model\Product;


class Type extends \Magento\Bundle\Model\Product\Type
{
    const TYPE_ID = 'custom_product_type_code';
    /**
     * {@inheritdoc}
     */
    public function deleteTypeSpecificData(\Magento\Catalog\Model\Product $product)
    {

    }
}