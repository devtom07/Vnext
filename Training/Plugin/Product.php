<?php
namespace Vnext\Training\Plugin;


class Product extends \Magento\Catalog\Model\Product
{
    public function getName(){
        $SKU = $this->_getData('sku');
        $changeNamebyPreference = $this->_getData('name') . $SKU;
        return $changeNamebyPreference;
    }

}