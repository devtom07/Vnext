<?php

namespace Vnext\RewardPoints\Observer\Checkout;

use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Vnext\RewardPoints\Model\ResourceModel\Earningrate\CollectionFactory;

class CustomPoint implements ObserverInterface
{
    protected $earning;
    protected $logger;
    protected $point;
    protected $checkoutSession;
    protected $_collectionFactory;

    public function __construct(
        LoggerInterface $logger, CollectionFactory $earning,
        CheckoutSession $checkoutSession,
        \Vnext\RewardPoints\Model\ResourceModel\Point\CollectionFactory $point,
        \Vnext\RewardPoints\Model\ResourceModel\Moneypoint\CollectionFactory $collectionFactory
    )
    {
        $this->_collectionFactory = $collectionFactory;
        $this->checkoutSession = $checkoutSession;
        $this->logger = $logger;
        $this->earning = $earning;
        $this->point = $point;
    }

    public function execute(Observer $observer)
    {
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
            $objectManager = ObjectManager::getInstance();
            $question = $objectManager->create('Vnext\RewardPoints\Model\Point');
            $customPointId = $question->load($customerId,'customer_id')->getCustomerId();
            if (isset($customPointId)) {
                $idPoint = $question->load($customerId,'customer_id')->getId();
                $customerPoint = $question->load($customerId,'customer_id')->getPoint();
                $customerPointSpent = $question->load($customerId,'customer_id')->getData('point_spent');
                $postUpdate = $question->load($idPoint);
                $point_customer_one = $customerPoint + $earning -$point;
                $postUpdate->setPoint($point_customer_one);
                $postUpdate->setPointSpent($customerPointSpent+$point);
                $postUpdate->save();
            } else {
                $question->setPoint($earning);
                $question->setCustomerId($customerId);
                $question->setCustomerEmail($customEmail);
                $question->setPointSpent("0");
                $question->save();
            }
        }


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
}
