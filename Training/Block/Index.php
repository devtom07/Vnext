<?php

namespace Vnext\Training\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Vnext\Training\Model\Student;
use Magento\Framework\Pricing\Helper\Data as priceHelper;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Index extends Template
{
    protected $customCollection;
    protected $priceHepler;
    protected $scopeConfig;

    public function __construct(Context $context, Student $customCollection, priceHelper $priceHepler, ScopeConfigInterface $scopeConfig
    )
    {
        $this->customCollection = $customCollection;
        $this->priceHepler = $priceHepler;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('Custom Pagination'));


        if ($this->getCustomCollection()) {
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager',
                'custom.history.pager'
            )->setAvailableLimit([5 => 5, 10 => 10, 15 => 15, 20 => 20])
                ->setShowPerPage(true)->setCollection(
                    $this->getCustomCollection()
                );
            $this->setChild('pager', $pager);
            $this->getCustomCollection()->load();
        }
        return $this;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
    public function getCustomCollection()
    {
        $asc = $this->scopeConfig->getValue('training/general/asc', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $page_student = $this->scopeConfig->getValue('training/general/pagination', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest()->getParam('limit') : $page_student;
        $collection = $this->customCollection->getCollection();
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);
        $name = ($this->getRequest()->getParam('name')) ? $this->getRequest()->getParam('name') : '';
        $Id = ($this->getRequest()->getParam('entity_id')) ? $this->getRequest()->getParam('entity_id') : '';
        $gender = ($this->getRequest()->getParam('gender')) ? $this->getRequest()->getParam('gender') : '';
        $dob = ($this->getRequest()->getParam('dob')) ? $this->getRequest()->getParam('dob') : '';
        $optradio = ($this->getRequest()->getParam('optradio')) ? $this->getRequest()->getParam('optradio') : '';
        if ($Id != '') {
            $collection->addFieldToFilter('entity_id', $Id);
        }
        if ($name != '') {
            $collection->addFieldToFilter('name', $name);
        }
        if ($gender != '') {
            $collection->addFieldToFilter('gender', $gender);
        }
        if (isset($asc)) {
            $collection->setOrder('entity_id', $asc);
        }
        if ($optradio != '') {
            $collection->setOrder($optradio,'desc');
        }

        if ($dob != '') {
            if ($dob == 1) {
                $year1 = date_create('2017-01-01');
                $year2 = date_create('2011-01-01');
                $collection->addFieldToFilter(
                    'dob',
                    ["gteq" => $year2],
                    ["lteq" => $year1]
                );
            } elseif ($dob == 2) {
                $year3 = date_create('2010-01-01');
                $collection->addFieldToFilter(
                    'dob',
                    ["lteq" => $year3]
                );
            }
        }
        return $collection;
    }

}
