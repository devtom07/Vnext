<?php

namespace Vnext\training\Observer;

use Magento\Catalog\Model\ProductFactory;

class ProductObserver
{
    protected $orderFactory;
    protected $productFactory;
    protected $stockRegistry;

    public function __construct(\Magento\Quote\Model\QuoteFactory $quoteFactory,
                                \Magento\Sales\Model\Order $orderFactory,
                                ProductFactory $productFactory,
                                \Magento\CatalogInventory\Api\StockRegistryInterface $stockRegistry)
    {
        $this->orderFactory = $orderFactory;
        $this->productFactory = $productFactory;
        $this->stockRegistry = $stockRegistry;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $orderId = $order->getIncrementId();
        $orderItems = $order->getAllItems();

        foreach ($orderItems as $item) {
            $sku = $item->getProduct()->getSku();
            $qty = 0;
            $stockItem = $this->stockRegistry->getStockItemBySku($sku);
            $stockItem->setQty($qty);
            $this->stockRegistry->updateStockItemBySku($sku, $stockItem);
        }

    }


}

