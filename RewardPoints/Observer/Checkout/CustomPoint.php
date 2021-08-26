<?php

namespace Vnext\RewardPoints\Observer\Checkout;

use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Vnext\RewardPoints\Model\PointFactory;
use Vnext\RewardPoints\Model\ResourceModel\Earningrate\CollectionFactory;

class CustomPoint implements ObserverInterface
{
    protected $earning;
    protected $logger;
    protected $_pointFactory;
    protected $checkoutSession;
    protected $_collectionFactory;

    public function __construct(
        LoggerInterface $logger,
        CollectionFactory $earning,
        CheckoutSession $checkoutSession,
        PointFactory $_pointFactory,
        \Vnext\RewardPoints\Model\ResourceModel\Moneypoint\CollectionFactory $collectionFactory
    )
    {
        $this->_collectionFactory = $collectionFactory;
        $this->checkoutSession = $checkoutSession;
        $this->logger = $logger;
        $this->earning = $earning;
        $this->_pointFactory = $_pointFactory;
    }
    public function getPoint()
    {
        $quote = $this->checkoutSession->getQuoteId();
        $result = $this->_collectionFactory->create();
        $result->addFieldToFilter('quote_id', $quote);
        $result->getSelect()->order('create_at' , \Magento\Framework\DB\Select::SQL_DESC);
        $array = $result->getData();
        if(count($array)==0){
            $point = 0;
        }else{
            $point = end($array)['point'];
        }
        return $point;
    }

    public function execute(Observer $observer)
    {
        $pointFactory = $this->_pointFactory->create();
        $order = $observer->getEvent()->getOrder();
        $point = $this->getPoint();
        $customerId = $order->getCustomerId();
        $customEmail = $order->getCustomerEmail();
        $total = $order->getSubtotal();
        $earning_point = $this->earning->create();
        $checkpoint = $earning_point->getData();
        if ($customerId != null) {
            if ($checkpoint != null){
                foreach ($earning_point as $data) {
                    $money_spent = $data->getMoneySpent();
                    $earning = round($total / $money_spent);
                }
            }else{
                $earning = 0;
            }
            $customPointId = $pointFactory->load($customerId,'customer_id')->getCustomerId();
            if (isset($customPointId)) {
                $customerPoint = $pointFactory->load($customerId,'customer_id')->getPoint();
                $customerPointSpent = $pointFactory->load($customerId,'customer_id')->getData('point_spent');
                $point_update = $customerPoint + $earning -$point;
                $pointFactory->load($customerId,'customer_id');
                $pointFactory->setPoint($point_update);
                $pointFactory->setPointSpent($customerPointSpent+$point);
                $pointFactory->save();
            } else {
                $pointFactory->setPoint($earning);
                $pointFactory->setCustomerId($customerId);
                $pointFactory->setCustomerEmail($customEmail);
                $pointFactory->setPointSpent("0");
                $pointFactory->save();
            }
        }
    }
}
