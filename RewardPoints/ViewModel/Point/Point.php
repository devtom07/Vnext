<?php

namespace Vnext\RewardPoints\ViewModel\Point;

use Vnext\RewardPoints\Model\PointFactory;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Point implements ArgumentInterface
{
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $_customerSession;
    protected $point;

    public function __construct(\Magento\Framework\App\Request\Http $request,
                                \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
                                \Magento\Customer\Model\SessionFactory $customerSession,
                                PointFactory $point
    )
    {
        $this->request = $request;
        $this->customerRepository = $customerRepository;
        $this->_customerSession = $customerSession;
        $this->point = $point;
    }
    public function getDataPoint()
    {
        $customer = $this->_customerSession->create();
        $customerId = $customer->getCustomer()->getId();
          $data = $this->point->create();
          $pointData = $data->load($customerId,'customer_id');
          return $pointData;
    }

}