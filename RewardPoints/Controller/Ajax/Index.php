<?php

namespace Vnext\RewardPoints\Controller\Ajax;

use Magento\Checkout\Model\Session as CheckoutSession;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    protected $json;
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $resultJsonFactory;
    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $customerSession;
    /**
     * @var \Vnext\RewardPoints\Model\ResourceModel\Spendingrate\CollectionFactory
     */
    protected $_collectionFactory;

    protected $_collection;
    /**
     * @var \Magento\Customer\Model\Session
     */
    private $checkoutSession;
    /**
     * @var \Magento\Framework\Pricing\PriceCurrencyInterface
     */
    protected $_priceCurrency;
    /**
     * @var \Vnext\RewardPoints\Model\MoneypointFactory
     */
    protected $moneypoint;
    /**
     * @var \Vnext\RewardPoints\Model\ResourceModel\Moneypoint
     */
    protected $moneypointresource;
    /**
     * @var \Magento\Framework\App\Cache\TypeListInterface
     */
    protected $_cacheTypeList;
    /**
     * @var \Vnext\RewardPoints\Model\PointFactory
     */
    protected $pointFactory;
    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $messageManager;


    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Serialize\Serializer\Json $json,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Vnext\RewardPoints\Model\ResourceModel\Spendingrate\CollectionFactory $collectionFactory,
        CheckoutSession $checkoutSession,
        \Vnext\RewardPoints\Model\MoneypointFactory $moneypoint,
        \Vnext\RewardPoints\Model\ResourceModel\Moneypoint $moneypointresource,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Vnext\RewardPoints\Model\PointFactory $pointFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager

    )
    {
        $this->messageManager = $messageManager;
        $this->pointFactory = $pointFactory;
        $this->_cacheTypeList = $cacheTypeList;
        $this->moneypointresource = $moneypointresource;
        $this->moneypoint = $moneypoint;
        $this->checkoutSession = $checkoutSession;
        $this->_collectionFactory = $collectionFactory;
        $this->customerSession = $customerSession;
        $this->json = $json;
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultJson = $this->resultJsonFactory->create();

        $id = $this->customerSession->getCustomer()->getId();
        $id_group = $this->customerSession->getCustomer()->getGroupId();
        $data = $this->getRequest()->getContent();

        $response = $this->json->unserialize($data);

        if (!$this->_collection) {
            $result = $this->_collectionFactory->create();
            $result->addFieldToFilter('customer_group_id', $id_group);
            $result->getSelect()->order('priority' . ' ' . \Magento\Framework\DB\Select::SQL_DESC);
        }

        $array = $result->getData();
        if(count($array) == 0){
            $send = array('keyword' => 'Not Found Spending Rate');
            return $resultJson->setData($send);
        }
        $discount_reserved = $array[0]['discount_reserved'];
        $spending_point = $array[0]['spending_point'];
        $point = $response['keyword'];
        //
        $id_customer = $this->customerSession->getCustomer()->getId();
        $model = $this->pointFactory->create();
        $quantity_point = $model->load($id_customer,'customer_id')->getPoint();
        if ($quantity_point<$point){
            $send = array('keyword' => 'Your bonus points are not enough');
            return $resultJson->setData($send);
        }
        //
        $rewardpoints = round(($point * $discount_reserved) / $spending_point);
        $quote = $this->checkoutSession->getQuote();
        $total = $quote->getBaseGrandTotal();
        $discount = $rewardpoints/(int)$total;
        if($discount>0.2){
            $send = array('keyword' => 'Your discount is too much for your order.Please enter less points');
            return $resultJson->setData($send);
        }
        $quote_id = $this->checkoutSession->getQuoteId();
        $money_quote = $this->moneypoint->create();
        $money_quote->setData('quote_id', $quote_id);
        $money_quote->setData('money', $rewardpoints);
        $money_quote->setData('point', $point);
        $this->moneypointresource->save($money_quote);

        $send = array('keyword' => 'Success appyle points');
        return $resultJson->setData($send);
    }


}
