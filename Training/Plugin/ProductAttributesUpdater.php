<?php
namespace Vnext\Training\Plugin;
use Magento\Catalog\Model\Product;
class ProductAttributesUpdater
{
    public function beforeSetName(Product $subject,$name)
    {
        $name = "Anh Manh";
      return ['(' . $name . ')'];
    }
    public function afterGetName(Product $subject,$result){
        $result = "Manh nguyen";
      return '|' . $result . '|';
    }
    public function aroundSave(Product $subject, callable $proceed)
    {
        $someValue = $this->doSmthBeforeProductIsSaved();
        $returnValue = null;

        if ($this->canCallProceedCallable($someValue)) {
            $returnValue = $proceed();
        }

        if ($returnValue) {
            $this->postProductToFacebook();
        }
        return $returnValue;
    }
}
