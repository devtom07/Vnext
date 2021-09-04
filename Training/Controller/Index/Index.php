<?php

namespace Vnext\Training\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Action;

class Index extends Action
{
    protected $resultPageFactory;
    protected $scopeConfig;
    protected $redirectFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        RedirectFactory $redirectFactory,
        ScopeConfigInterface $scopeConfig
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->redirectFactory = $redirectFactory;
        $this->scopeConfig = $scopeConfig;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Custom Pagination'));
        $active = $this->scopeConfig->getValue('training/general/enable', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if ($active == '1') {
            return $resultPage;
        }else{
            return $this->redirectFactory->create()->setPath('404notfound');
        }

    }
}