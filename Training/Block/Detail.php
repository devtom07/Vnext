<?php
namespace Vnext\Training\Block;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Vnext\Training\Model\StudentFactory;
use Magento\Framework\Pricing\Helper\Data as priceHelper;

class Detail extends Template
{
    protected $customCollection;
    protected $collection;

    public function __construct(Context $context, StudentFactory $customCollection)
    {
        $this->customCollection = $customCollection;
        parent::__construct($context);
        $this->collection = $this->getCollection();
    }


    public function GetSutudentById()
    {
        $student=($this->getRequest()->getParam('idS'))? $this->getRequest()->getParam('idS') : '';
        if($student != ''){
            return $this->customCollection->create()->load($student);
        }
    }
}
